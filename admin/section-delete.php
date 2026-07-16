<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('section.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('section.php');
include __DIR__ . '/data/section.php';

$id = input_int('section_id');
if ($id <= 0) {
    redirect_with_error('section.php', 'Invalid section');
}

if (removeSection($id, $conn)) {
    redirect_with_success('section.php', 'Successfully deleted!');
}
redirect_with_error('section.php', 'Unknown error occurred');
