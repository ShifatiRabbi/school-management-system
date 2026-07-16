<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('news.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('news.php');
include __DIR__ . '/data/news.php';

$id = input_int('id');
if ($id <= 0) {
    redirect_with_error('news.php', 'Invalid news item');
}
if (deleteNews($conn, $id)) {
    redirect_with_success('news.php', 'News deleted successfully');
}
redirect_with_error('news.php', 'Failed to delete news');
