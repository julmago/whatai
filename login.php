<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
start_app_session();

function back_to_login(string $message): void
{
    set_flash($message);
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
    back_to_login('La sesión venció. Volvé a ingresar.');
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$role = (string) ($_POST['role'] ?? '');

$allowedRoles = ['super_admin', 'admin', 'collaborator'];
if ($username === '' || $password === '' || !in_array($role, $allowedRoles, true)) {
    back_to_login('Revisá el tipo de acceso, el usuario y la contraseña.');
}

try {
    $stmt = app_db()->prepare(
        'SELECT id, username, password_hash, role
         FROM users
         WHERE username = :username
         LIMIT 1'
    );
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
} catch (Throwable $error) {
    error_log('Error de acceso a MySQL: ' . $error->getMessage());
    back_to_login('No se pudo validar el acceso. Revisá la configuración del servidor.');
}

if (!$user || !password_verify($password, (string) $user['password_hash']) || $role !== $user['role']) {
    back_to_login('El tipo de acceso, el usuario o la contraseña no son correctos.');
}

session_regenerate_id(true);
$_SESSION['user'] = [
    'id' => (int) $user['id'],
    'username' => (string) $user['username'],
    'role' => (string) $user['role'],
];

header('Location: dashboard.php');
exit;
