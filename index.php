<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
start_app_session();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$message = take_flash();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso</title>
</head>
<body>
    <main>
        <h1>Acceso al sistema</h1>

        <?php if ($message !== ''): ?>
            <p role="alert"><?= h($message) ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">

            <p>
                <label for="role">Tipo de acceso</label><br>
                <select id="role" name="role" required>
                    <option value="">Seleccionar</option>
                    <option value="super_admin">Super Administrador</option>
                    <option value="admin">Administrador</option>
                    <option value="collaborator">Colaborador</option>
                </select>
            </p>

            <p>
                <label for="username">Nombre de usuario</label><br>
                <input id="username" name="username" type="text" maxlength="50" autocomplete="username" required>
            </p>

            <p>
                <label for="password">Contraseña</label><br>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
            </p>

            <button type="submit">Ingresar</button>
        </form>
    </main>
</body>
</html>
