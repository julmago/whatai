# Modelo inicial de la base de datos

Este modelo corresponde solo a la etapa de accesos. No incluye números, chats ni datos de WhatsApp.

Se eligió **MySQL**. El esquema inicial está en [schema.sql](schema.sql).

## Tabla: users

| Campo | Requerido | Regla |
|---|---:|---|
| `id` | Sí | Identificador único de la cuenta. |
| `username` | Sí | Único en todo el sistema, sin importar el rol. |
| `password_hash` | Sí | Guarda el hash de la contraseña, nunca la contraseña en texto plano. |
| `role` | Sí | Solo puede ser `super_admin`, `admin` o `collaborator`. |
| `created_by_id` | No | Referencia a otra cuenta de `users): indica quién creó al usuario. La cuenta inicial no tiene creador. |

## Reglas de cuentas

- La única cuenta Super Administrador se configura inicialmente con el nombre de usuario `julmago`.
- No se puede crear otra cuenta con el rol `super_admin`.
- El Super Administrador solo puede crear cuentas con rol `admin`.
- Un Administrador solo puede crear cuentas con rol `collaborator`.
- Cada Colaborador queda asociado al Administrador que lo creó.
- Ningún nombre de usuario puede repetirse, aunque las cuentas tengan roles distintos.
- La aplicación compara el rol guardado en la base de datos; elegir un tipo de acceso en la pantalla no cambia el rol de la cuenta.
- Las reglas de quién puede crear cada rol las valida el servidor.
- La contraseña inicial de `julmago` se configurará de forma segura cuando implementemos el servidor; no se guarda en GitHub.

## Pendiente

- Definir si hacen falta campos adicionales, como estado de cuenta o fecha de creación.
- Elegir la tecnología del servidor para conectar con MySQL.
