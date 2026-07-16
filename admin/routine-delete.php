<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('routine.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('routine.php');
include __DIR__ . '/data/routine.php';

$id = input_int('id');
if ($id <= 0) {
    redirect_with_error('routine.php', 'Invalid routine');
}
if (deleteRoutine($conn, $id)) {
    redirect_with_success('routine.php', 'Routine deleted successfully');
}
redirect_with_error('routine.php', 'Failed to delete routine');
