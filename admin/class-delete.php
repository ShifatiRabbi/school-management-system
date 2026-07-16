<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('class.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('class.php');
include __DIR__ . '/data/class.php';

$id = input_int('class_id');
if ($id <= 0) {
    redirect_with_error('class.php', 'Invalid class');
}

if (removeClass($id, $conn)) {
    redirect_with_success('class.php', 'Successfully deleted!');
}
redirect_with_error('class.php', 'Unknown error occurred');
