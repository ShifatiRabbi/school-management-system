<?php

declare(strict_types=1);

/**
 * Application bootstrap.
 * Include this once at the start of every request entry point.
 */

$root = dirname(__DIR__);

// Autoload simple App\* classes
spl_autoload_register(static function (string $class) use ($root): void {
    if (!str_starts_with($class, 'App\\')) {
        return;
    }
    $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 4));
    $path = $root . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $relative . '.php';
    // Map App\Core\X -> app/core/X.php (case-insensitive on Windows)
    $candidates = [
        $root . '/app/' . strtolower(dirname(str_replace('\\', '/', substr($class, 4)))) . '/' . basename(str_replace('\\', '/', $class)) . '.php',
        $path,
    ];
    // Explicit map for our structure
    $map = [
        'App\\Core\\Database' => $root . '/app/core/Database.php',
        'App\\Core\\Session'   => $root . '/app/core/Session.php',
        'App\\Core\\Auth'      => $root . '/app/core/Auth.php',
        'App\\Core\\Csrf'      => $root . '/app/core/Csrf.php',
        'App\\Core\\Security'  => $root . '/app/core/Security.php',
        'App\\Helpers\\Validator' => $root . '/app/helpers/Validator.php',
        'App\\Helpers\\Upload'    => $root . '/app/helpers/Upload.php',
    ];
    if (isset($map[$class]) && is_file($map[$class])) {
        require_once $map[$class];
        return;
    }
    foreach ($candidates as $candidate) {
        if (is_file($candidate)) {
            require_once $candidate;
            return;
        }
    }
});

/** @var array $config */
$config = require $root . '/app/config/config.php';
$GLOBALS['config'] = $config;

date_default_timezone_set($config['timezone'] ?? 'Asia/Dhaka');

\App\Core\Security::configureErrorHandling((bool)$config['app_debug']);
\App\Core\Security::sendHeaders();
\App\Core\Session::start($config['session']);

require_once $root . '/app/helpers/functions.php';

$conn = \App\Core\Database::connect($config['db']);
