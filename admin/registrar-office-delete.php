<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('registrar-office.php', 'Invalid request method');
}
Csrf::requireValidOrRedirect('registrar-office.php');
include __DIR__ . '/data/registrar_office.php';

$id = input_int('r_user_id');
if ($id <= 0) {
    redirect_with_error('registrar-office.php', 'Invalid user');
}
if (removeRUser($id, $conn)) {
    redirect_with_success('registrar-office.php', 'Successfully deleted!');
}
redirect_with_error('registrar-office.php', 'Unknown error occurred');
