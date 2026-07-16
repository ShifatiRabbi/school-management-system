<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('notices.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('notices.php');
include __DIR__ . '/data/notice.php';

$id = input_int('id');
if ($id <= 0) {
    redirect_with_error('notices.php', 'Invalid notice');
}
if (deleteNotice($conn, $id)) {
    redirect_with_success('notices.php', 'Notice deleted successfully');
}
redirect_with_error('notices.php', 'Failed to delete notice');
