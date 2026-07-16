<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireRegistrar();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('student.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('student.php');

include __DIR__ . '/data/student.php';

$id = input_int('student_id');
if ($id <= 0) {
    redirect_with_error('student.php', 'Invalid student');
}

if (removeStudent($id, $conn)) {
    redirect_with_success('student.php', 'Successfully deleted!');
}
redirect_with_error('student.php', 'Unknown error occurred');
