<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Csrf;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../contact.php');
}

Csrf::requireValidOrRedirect('../contact.php');

$full_name = input_post('full_name', '');
$email     = input_post('email', '');
$mobile    = input_post('mobile', '');
$message   = input_post('message', '');

if ($full_name === '') {
    redirect_with_error('../contact.php', 'Full name is required');
}
if ($email === '') {
    redirect_with_error('../contact.php', 'Email is required');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_with_error('../contact.php', 'Invalid email format');
}
if ($mobile === '') {
    redirect_with_error('../contact.php', 'Mobile number is required');
}
if ($message === '') {
    redirect_with_error('../contact.php', 'Message is required');
}

$sql = "INSERT INTO message (sender_full_name, sender_email, sender_mobile, message, date_time)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    mb_substr($full_name, 0, 100),
    mb_substr($email, 0, 150),
    mb_substr($mobile, 0, 20),
    mb_substr($message, 0, 2000),
    date('Y-m-d H:i:s'),
]);

redirect_with_success('../contact.php', 'Your message has been sent successfully!');
