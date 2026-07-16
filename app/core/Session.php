<?php

declare(strict_types=1);

namespace App\Core;

final class Session
{
    public static function start(array $sessionConfig): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            self::checkTimeout($sessionConfig['lifetime'] ?? 7200);
            return;
        }

        $secure = (bool)($sessionConfig['secure'] ?? false);
        $httponly = (bool)($sessionConfig['httponly'] ?? true);
        $samesite = $sessionConfig['samesite'] ?? 'Lax';
        $lifetime = (int)($sessionConfig['lifetime'] ?? 7200);

        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_samesite', $samesite);

        session_name($sessionConfig['name'] ?? 'SMSSESSID');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'secure'   => $secure,
            'httponly' => $httponly,
            'samesite' => $samesite,
        ]);

        session_start();
        self::checkTimeout($lifetime);
    }

    public static function regenerate(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    public static function destroy(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'] ?? '', (bool)$params['secure'], (bool)$params['httponly']);
        }

        session_destroy();
    }

    private static function checkTimeout(int $lifetime): void
    {
        $now = time();
        if (isset($_SESSION['_last_activity']) && ($now - (int)$_SESSION['_last_activity']) > $lifetime) {
            self::destroy();
            session_start();
            $_SESSION['_flash_error'] = 'Your session has expired due to inactivity. Please log in again.';
            return;
        }
        $_SESSION['_last_activity'] = $now;
    }
}
