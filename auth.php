<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

function start_app_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');

    $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(): string
{
    start_app_session();

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function csrf_is_valid($submittedToken): bool
{
    start_app_session();

    return is_string($submittedToken)
        && isset($_SESSION['csrf_token'])
        && hash_equals((string) $_SESSION['csrf_token'], $submittedToken);
}

function set_flash(string $message): void
{
    start_app_session();
    $_SESSION['flash_message'] = $message;
}

function take_flash(): string
{
    start_app_session();
    $message = (string) ($_SESSION['flash_message'] ?? '');
    unset($_SESSION['flash_message']);

    return $message;
}

function require_user(): array
{
    start_app_session();

    if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }

    return $_SESSION['user'];
}
