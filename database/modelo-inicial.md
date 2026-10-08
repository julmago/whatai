# Modelo inicial de la base de datos

Este modelo corresponde solo a la etapa de accesos. No incluye números, chats ni datos de WhatsApp.

## Tabla: usuarios

| Campo | Requerido | Regla |
|---|---:|---|
| `id` | Sí | Identificador único de la cuenta. |
| `nombre_usuario` | Sí | Único en todo el sistema, sin importar el rol. |
| `contrasena_hash` | Sí | Guarda el hash de la contraseña, nunca la contraseña en texto plano. |
| `rol` | Sí | Solo puede ser `super_admin`, `admin` o `colaborador`. |
| `creado_por_id` | No | Referencia a otra cuenta de esta tabla: indica quién creó al usuario. El Super Administrador inicial no tiene creador. |

## Reglas de cuentas

- La única cuenta Super Administrador se crea inicialmente con el nombre de usuario `julmago`.
- No se puede crear otra cuenta con el rol `super_admin`.
- El Super Administrador solo puede crear cuentas con rol `admin`.
- Un Administrador solo puede crear cuentas con rol `colaborador`.
- Cada Colaborador queda asociado al Administrador que lo creó.
- Ningún nombre de usuario puede repetirse, aunque las cuentas tengan roles distintos.
- La aplicación compara el rol guardado en la base de datos; elegir un tipo de acceso en la pantalla no cambia el rol de la cuenta.

## Pendiente antes de crear el esquema SQL

- Elegir el motor de base de datos y adaptar los tipos y restricciones a ese motor.
- Definir cómo se establecerá de forma segura la contraseña inicial de `julmago`.
- Definir si hacen falta campos adicionales, como estado de cuenta o fecha de creación.

