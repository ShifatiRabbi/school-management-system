<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('teacher.php', 'Invalid request method');
}

Csrf::requireValidOrRedirect('teacher.php');

include __DIR__ . '/data/teacher.php';

$id = input_int('teacher_id');
if ($id <= 0) {
    redirect_with_error('teacher.php', 'Invalid teacher');
}

if (removeTeacher($id, $conn)) {
    redirect_with_success('teacher.php', 'Successfully deleted!');
}

redirect_with_error('teacher.php', 'Unknown error occurred');
