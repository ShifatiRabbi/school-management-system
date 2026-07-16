<?php

declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public const ROLE_ADMIN = 'Admin';
    public const ROLE_TEACHER = 'Teacher';
    public const ROLE_STUDENT = 'Student';
    public const ROLE_REGISTRAR = 'Registrar Office';

    public static function check(): bool
    {
        return isset($_SESSION['role']);
    }

    public static function role(): ?string
    {
        return $_SESSION['role'] ?? null;
    }

    public static function is(string $role): bool
    {
        return self::check() && self::role() === $role;
    }

    public static function loginRedirect(): string
    {
        $base = rtrim((string)(($GLOBALS['config']['app_url'] ?? '')), '/');
        if ($base !== '') {
            return $base . '/login.php';
        }
        // Prefer absolute path from web root when app is deployed at domain root.
        return '/login.php';
    }

    public static function requireLogin(?string $redirect = null): void
    {
        if (!self::check()) {
            header('Location: ' . ($redirect ?? self::loginRedirect()));
            exit;
        }
    }

    public static function requireRole(string $role, ?string $redirect = null): void
    {
        if (!self::is($role)) {
            header('Location: ' . ($redirect ?? self::loginRedirect()));
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        if (!isset($_SESSION['admin_id']) || !self::is(self::ROLE_ADMIN)) {
            header('Location: ' . self::loginRedirect());
            exit;
        }
    }

    public static function requireTeacher(): void
    {
        if (!isset($_SESSION['teacher_id']) || !self::is(self::ROLE_TEACHER)) {
            header('Location: ' . self::loginRedirect());
            exit;
        }
    }

    public static function requireStudent(): void
    {
        if (!isset($_SESSION['student_id']) || !self::is(self::ROLE_STUDENT)) {
            header('Location: ' . self::loginRedirect());
            exit;
        }
    }

    public static function requireRegistrar(): void
    {
        if (!isset($_SESSION['r_user_id']) || !self::is(self::ROLE_REGISTRAR)) {
            header('Location: ' . self::loginRedirect());
            exit;
        }
    }

    public static function loginUser(string $role, int $id): void
    {
        Session::regenerate();
        $_SESSION['role'] = $role;
        $_SESSION['_last_activity'] = time();

        switch ($role) {
            case self::ROLE_ADMIN:
                $_SESSION['admin_id'] = $id;
                break;
            case self::ROLE_TEACHER:
                $_SESSION['teacher_id'] = $id;
                break;
            case self::ROLE_STUDENT:
                $_SESSION['student_id'] = $id;
                break;
            case self::ROLE_REGISTRAR:
                $_SESSION['r_user_id'] = $id;
                break;
        }
    }
}
