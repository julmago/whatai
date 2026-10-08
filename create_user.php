<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
$user = require_user();

function return_to_dashboard(string $message): void
{
    set_flash($message);
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
    return_to_dashboard('La sesión venció. Volvé a intentarlo.');
}

if ($user['role'] === 'super_admin') {
    $newRole = 'admin';
} elseif ($user['role'] === 'admin') {
    $newRole = 'collaborator';
} else {
    http_response_code(403);
    exit('Tu rol no puede crear cuentas.');
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($username === '' || strlen($username) > 50) {
    return_to_dashboard('El nombre de usuario es obligatorio y debe tener hasta 50 caracteres.');
}

if (strlen($password) < 8) {
    return_to_dashboard('La contraseña debe tener al menos 8 caracteres.');
}

try {
    $stmt = app_db()->prepare(
        'INSERT INTO users (username, password_hash, role, created_by_id)
         VALUES (:username, :password_hash, :role, :created_by_id)'
    );
    $stmt->execute([
        'username' => $username,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $newRole,
        'created_by_id' => (int) $user['id'],
    ]);
} catch (PDOException $error) {
    if ($error->getCode() === '23000') {
        return_to_dashboard('Ese nombre de usuario ya existe. Elegí otro.');
    }

    error_log('Error al crear usuario: ' . $error->getMessage());
    return_to_dashboard('No se pudo crear la cuenta. Revisá la conexión con la base.');
} catch (Throwable $error) {
    error_log('Error al crear usuario: ' . $error->getMessage());
    return_to_dashboard('No se pudo crear la cuenta. Revisá la conexión con la base.');
}

$createdType = $newRole === 'admin' ? 'Administrador' : 'Colaborador';
return_to_dashboard($createdType . ' creado correctamente.');
