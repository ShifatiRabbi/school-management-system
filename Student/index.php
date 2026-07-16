<?php
/**
 * Student dashboard — landing page after login.
 */
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;

Auth::requireStudent();
header('Location: grade.php');
exit;
