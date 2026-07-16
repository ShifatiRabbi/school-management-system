<?php
require_once __DIR__ . '/app/bootstrap.php';

use App\Core\Session;

Session::destroy();
redirect('login.php');
