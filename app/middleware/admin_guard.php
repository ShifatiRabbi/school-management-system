<?php

declare(strict_types=1);

/**
 * Shared guard for admin state-changing endpoints.
 * Assumes bootstrap already loaded.
 */

use App\Core\Auth;
use App\Core\Csrf;

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Csrf::requireValidOrRedirect('../index.php');
}
