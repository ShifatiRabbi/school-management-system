<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('course.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('course.php');
include __DIR__ . '/data/subject.php';

$id = input_int('course_id');
if ($id <= 0) {
    $id = input_int('subject_id');
}
if ($id <= 0) {
    redirect_with_error('course.php', 'Invalid course');
}

if (removeSubject($id, $conn)) {
    redirect_with_success('course.php', 'Successfully deleted!');
}
redirect_with_error('course.php', 'Unknown error occurred');
