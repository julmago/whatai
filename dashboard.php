<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
$user = require_user();
$message = take_flash();

$roleLabels = [
    'super_admin' => 'Super Administrador',
    'admin' => 'Administrador',
    'collaborator' => 'Colaborador',
];
$roleLabel = $roleLabels[$user['role']] ?? 'Usuario';

$collaborators = [];
if ($user['role'] === 'admin') {
    try {
        $stmt = app_db()->prepare(
            "SELECT username FROM users
             WHERE role = 'collaborator' AND created_by_id = :creator
             ORDER BY username"
        );
        $stmt->execute(['creator' => $user['id']]);
        $collaborators = $stmt->fetchAll();
    } catch (Throwable $error) {
        error_log('Error al cargar colaboradores: ' . $error->getMessage());
        $message = 'No se pudieron cargar tus colaboradores.';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de acceso</title>
</head>
<body>
    <main>
        <h1><?= h($roleLabel) ?></h1>
        <p>Sesión iniciada como <strong><?= h((string) $user['username']) ?></strong>.</p>

        <?php if ($message !== ''): ?>
            <p role="status"><?= h($message) ?></p>
        <?php endif; ?>

        <?php if ($user['role'] === 'super_admin'): ?>
            <h2>Crear Administrador</h2>
            <p>El Super Administrador solo puede crear cuentas de Administrador.</p>
            <form action="create_user.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                <p>
                    <label for="new_username">Nombre de usuario</label><br>
                    <input id="new_username" name="username" type="text" maxlength="50" autocomplete="off" required>
                </p>
                <p>
                    <label for="new_password">Contraseña</label><br>
                    <input id="new_password" name="password" type="password" minlength="8" autocomplete="new-password" required>
                </p>
                <button type="submit">Crear Administrador</button>
            </form>
        <?php elseif ($user['role'] === 'admin'): ?>
            <h2>Crear Colaborador</h2>
            <p>Este Administrador solo puede crear y ver sus propios Colaboradores.</p>
            <form action="create_user.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                <p>
                    <label for="new_username">Nombre de usuario</label><br>
                    <input id="new_username" name="username" type="text" maxlength="50" autocomplete="off" required>
                </p>
                <p>
                    <label for="new_password">Contraseña</label><br>
                    <input id="new_password" name="password" type="password" minlength="8" autocomplete="new-password" required>
                </p>
                <button type="submit">Crear Colaborador</button>
            </form>

            <h2>Mis Colaboradores</h2>
            <?php if ($collaborators === []): ?>
                <p>Todavía no creaste Colaboradores.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($collaborators as $collaborator): ?>
                        <li><?= h((string) $collaborator['username']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <p>Tu Administrador define los permisos de tu cuenta.</p>
        <?php endif; ?>

        <form action="logout.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <button type="submit">Cerrar sesión</button>
        </form>
    </main>
</body>
</html>
