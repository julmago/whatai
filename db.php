<?php
declare(strict_types=1);

function app_db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $configPath = __DIR__ . '/config.local.php';
    if (!is_file($configPath)) {
        throw new RuntimeException('Falta crear config.local.php desde config.example.php.');
    }

    $config = require $configPath;
    $settings = $config['db'] ?? [];

    $host = (string) ($settings['host'] ?? '');
    $port = (int) ($settings['port'] ?? 3306);
    $name = (string) ($settings['name'] ?? '');
    $user = (string) ($settings['user'] ?? '');
    $password = (string) ($settings['password'] ?? '');

    if ($host === '' || $name === '' || $user === '') {
        throw new RuntimeException('La configuración de MySQL está incompleta.');
    }

    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $host, $port, $name);

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}
