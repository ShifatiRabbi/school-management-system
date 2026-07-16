<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('governing-body.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('governing-body.php');
include __DIR__ . '/data/governing_body.php';

$id = input_int('id');
if ($id <= 0) {
    redirect_with_error('governing-body.php', 'Invalid member');
}
if (deleteGoverningMember($conn, $id)) {
    redirect_with_success('governing-body.php', 'Member deleted successfully');
}
redirect_with_error('governing-body.php', 'Failed to delete member');
