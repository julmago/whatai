# WhatsApp

Primera etapa: accesos de Super Administrador, Administradores y Colaboradores.

## Requisitos

- PHP con PDO y el controlador PDO MySQL.
- MySQL.
- La base `whatai` con la tabla `users` creada desde `database/schema.sql`.

## Configuración local

1. Copiá `config.example.php` como `config.local.php`.
2. Completá usuario y contraseña de MySQL en `config.local.php`.
3. No subas `config.local.php`; está excluido por `.gitignore`.
4. Desde una terminal, en la carpeta del proyecto, ejecutá:

   ```sh
   php scripts/create_super_admin.php
   ```

   El comando crea la cuenta inicial `julmago) y solicita la contraseña sin guardarla en el repositorio.

5. Iniciá el servidor local para probar la web:

   ```sh
   php -S 127.0.0.1:8000
   ```

6. Abrí `http://127.0.0.1:8000`.

## Funcionamiento de esta etapa

- El ingreso requiere seleccionar el rol y validar el nombre de usuario y la contraseña.
- El Super Administrador puede crear Administradores.
- Cada Administrador puede crear y ver solo sus propios Colaboradores.
- Los nombres de usuario son únicos en la base de datos.
- Las contraseñas se guardan como hash.
- No incluye todavía números, chats ni conexión con WhatsApp.

La interfaz en el repositorio es textual; el diseño visual se trabajará al final.
