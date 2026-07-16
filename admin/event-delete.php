<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('events.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('events.php');
include __DIR__ . '/data/event.php';

$id = input_int('id');
if ($id <= 0) {
    redirect_with_error('events.php', 'Invalid event');
}
if (deleteEvent($conn, $id)) {
    redirect_with_success('events.php', 'Event deleted successfully');
}
redirect_with_error('events.php', 'Failed to delete event');
