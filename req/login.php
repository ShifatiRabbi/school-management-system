<?php
/**
 * User login handler — secured with CSRF, rate limiting, and session regeneration.
 */

require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../login.php');
}

Csrf::requireValidOrRedirect('../login.php');

$uname = input_post('uname', '');
$pass  = input_post('pass', '');
$role  = input_post('role', '');

// Simple rate limiting by IP + username
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateKey = '_login_attempts';
$lockKey = '_login_locked_until';
$maxAttempts = (int)($config['security']['login_max_attempts'] ?? 8);
$lockoutSec  = (int)($config['security']['login_lockout_sec'] ?? 900);

if (!isset($_SESSION[$rateKey]) || !is_array($_SESSION[$rateKey])) {
    $_SESSION[$rateKey] = [];
}

$now = time();
if (!empty($_SESSION[$lockKey]) && $_SESSION[$lockKey] > $now) {
    redirect_with_error('../login.php', 'Too many failed attempts. Please try again later.');
}

if ($uname === '') {
    redirect_with_error('../login.php', 'Username is required');
}
if ($pass === '') {
    redirect_with_error('../login.php', 'Password is required');
}
if ($role === '') {
    redirect_with_error('../login.php', 'An error occurred');
}

$roleMap = [
    '1' => ['sql' => 'SELECT * FROM admin WHERE username = ?', 'role' => Auth::ROLE_ADMIN, 'id_field' => 'admin_id', 'redirect' => '../admin/index.php'],
    '2' => ['sql' => 'SELECT * FROM teachers WHERE username = ?', 'role' => Auth::ROLE_TEACHER, 'id_field' => 'teacher_id', 'redirect' => '../Teacher/classes.php'],
    '3' => ['sql' => 'SELECT * FROM students WHERE username = ?', 'role' => Auth::ROLE_STUDENT, 'id_field' => 'student_id', 'redirect' => '../Student/grade.php'],
    '4' => ['sql' => 'SELECT * FROM registrar_office WHERE username = ?', 'role' => Auth::ROLE_REGISTRAR, 'id_field' => 'r_user_id', 'redirect' => '../RegistrarOffice/index.php'],
];

if (!isset($roleMap[$role])) {
    redirect_with_error('../login.php', 'Incorrect Username or Password');
}

$meta = $roleMap[$role];
$stmt = $conn->prepare($meta['sql']);
$stmt->execute([$uname]);

$fail = static function () use ($rateKey, $lockKey, $maxAttempts, $lockoutSec, $ip, $uname): never {
    $bucket = $_SESSION[$rateKey][$ip] ?? 0;
    $bucket++;
    $_SESSION[$rateKey][$ip] = $bucket;
    if ($bucket >= $maxAttempts) {
        $_SESSION[$lockKey] = time() + $lockoutSec;
        $_SESSION[$rateKey][$ip] = 0;
    }
    redirect_with_error('../login.php', 'Incorrect Username or Password');
};

if ($stmt->rowCount() !== 1) {
    $fail();
}

$user = $stmt->fetch();
if (($user['username'] ?? '') !== $uname || !password_verify($pass, $user['password'] ?? '')) {
    $fail();
}

// Success — clear rate limit and establish session
unset($_SESSION[$rateKey][$ip], $_SESSION[$lockKey]);
Auth::loginUser($meta['role'], (int)$user[$meta['id_field']]);
redirect($meta['redirect']);
