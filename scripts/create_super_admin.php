<?php
declare(strict_types=1);

require_once __DIR__ . '/../db.php';

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

function read_hidden_password(string $prompt): string
{
    fwrite(STDOUT, $prompt);

    if (PHP_OS_FAMILY === 'Windows') {
        $command = 'powershell -NoProfile -Command "$s=Read-Host -AsSecureString; $b=[Runtime.InteropServices.Marshal]::SecureStringToBSTR($s); try {[Runtime.InteropServices.Marshal]::PtrToStringBSTR($b)} finally {[Runtime.InteropServices.Marshal]::ZeroFreeBSTR($b)}"';
        $value = shell_exec($command);
        fwrite(STDOUT, PHP_EOL);
        return trim((string) $value);
    }

    $mode = trim((string) shell_exec('stty -g 2>/dev/null'));
    if ($mode === '') {
        fwrite(STDERR, 'Ejecutá este comando desde una terminal interactiva.' . PHP_EOL);
        exit(1);
    }

    shell_exec('stty -echo');
    $value = fgets(STDIN);
    shell_exec('stty ' . escapeshellarg($mode));
    fwrite(STDOUT, PHP_EOL);

    return trim((string) $value);
}

try {
    $pdo = app_db();

    $existingSuperAdmin = $pdo->query(
        "SELECT id FROM users WHERE role = 'super_admin' LIMIT 1"
    )->fetch();

    if ($existingSuperAdmin) {
        fwrite(STDERR, 'Ya existe una cuenta Super Administrador.' . PHP_EOL);
        exit(1);
    }

    $existingUsername = $pdo->prepare(
        'SELECT id FROM users WHERE username = :username LIMIT 1'
    );
    $existingUsername->execute(['username' => 'julmago']);

    if ($existingUsername->fetch()) {
        fwrite(STDERR, 'El nombre de usuario julmago ya está ocupado.' . PHP_EOL);
        exit(1);
    }

    $password = read_hidden_password('Creá la contraseña para julmago: ');
    $confirmation = read_hidden_password('Repetí la contraseña: ');

    if (strlen($password) < 8) {
        fwrite(STDERR, 'La contraseña debe tener al menos 8 caracteres.' . PHP_EOL);
        exit(1);
    }

    if (!hash_equals($password, $confirmation)) {
        fwrite(STDERR, 'Las contraseñas no coinciden.' . PHP_EOL);
        exit(1);
    }

    $stmt = $pdo->prepare(
        "INSERT INTO users (username, password_hash, role, created_by_id)
         VALUES (:username, :password_hash, 'super_admin', NULL)"
    );
    $stmt->execute([
        'username' => 'julmago',
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    fwrite(STDOUT, 'Cuenta Super Administrador creada.' . PHP_EOL);
} catch (Throwable $error) {
    fwrite(STDERR, 'No se pudo crear la cuenta: ' . $error->getMessage() . PHP_EOL);
    exit(1);
}
