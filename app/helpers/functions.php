<?php

declare(strict_types=1);

/**
 * Escape output for HTML context (XSS prevention).
 */
function e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Escape for use inside HTML attributes.
 */
function e_attr(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Redirect helper.
 */
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

/**
 * Flash error redirect with URL-encoded message.
 */
function redirect_with_error(string $url, string $message): never
{
    $sep = str_contains($url, '?') ? '&' : '?';
    header('Location: ' . $url . $sep . 'error=' . rawurlencode($message));
    exit;
}

function redirect_with_success(string $url, string $message): never
{
    $sep = str_contains($url, '?') ? '&' : '?';
    header('Location: ' . $url . $sep . 'success=' . rawurlencode($message));
    exit;
}

/**
 * Safe GET string.
 */
function input_get(string $key, ?string $default = null): ?string
{
    if (!isset($_GET[$key])) {
        return $default;
    }
    return is_string($_GET[$key]) ? trim($_GET[$key]) : $default;
}

/**
 * Safe POST string.
 */
function input_post(string $key, ?string $default = null): ?string
{
    if (!isset($_POST[$key])) {
        return $default;
    }
    return is_string($_POST[$key]) ? trim($_POST[$key]) : $default;
}

/**
 * Integer from request.
 */
function input_int(string $key, string $method = 'POST', int $default = 0): int
{
    $src = $method === 'GET' ? $_GET : $_POST;
    if (!isset($src[$key])) {
        return $default;
    }
    return (int)$src[$key];
}

/**
 * CSRF field shortcut (procedural).
 */
function csrf_field(): string
{
    return \App\Core\Csrf::field();
}

function csrf_token(): string
{
    return \App\Core\Csrf::token();
}

function csrf_meta(): string
{
    return \App\Core\Csrf::meta();
}

/**
 * Display flash/alert from query string safely.
 */
function alert_from_query(): string
{
    $html = '';
    if (isset($_GET['error']) && is_string($_GET['error']) && $_GET['error'] !== '') {
        $html .= '<div class="alert alert-danger" role="alert">' . e($_GET['error']) . '</div>';
    }
    if (isset($_GET['success']) && is_string($_GET['success']) && $_GET['success'] !== '') {
        $html .= '<div class="alert alert-success" role="alert">' . e($_GET['success']) . '</div>';
    }
    if (isset($_GET['perror']) && is_string($_GET['perror']) && $_GET['perror'] !== '') {
        $html .= '<div class="alert alert-danger" role="alert">' . e($_GET['perror']) . '</div>';
    }
    if (isset($_GET['psuccess']) && is_string($_GET['psuccess']) && $_GET['psuccess'] !== '') {
        $html .= '<div class="alert alert-success" role="alert">' . e($_GET['psuccess']) . '</div>';
    }
    return $html;
}
