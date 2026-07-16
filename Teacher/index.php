<?php
/**
 * Teacher dashboard — landing page after login.
 */
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Auth;

Auth::requireTeacher();
header('Location: classes.php');
exit;
