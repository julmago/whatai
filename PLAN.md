# Plan del proyecto WhatsApp

Documento de planificación y avance. El trabajo se hará por etapas, empezando por los accesos.

## 1. Objetivo

- **Qué problema queremos resolver:** pendiente de definir.
- **Quiénes van a usar la web:** Super Administrador, Administradores y Colaboradores.
- **Qué resultado esperamos:** pendiente de definir.

## 2. Alcance

### Definido para esta etapa

- Preparar los accesos y permisos de los tres tipos de usuario.
- Usar una interfaz de texto plano.
- Incluir el manejo de una base de datos.

### Fuera de esta etapa

- Todavía no se crearán números de WhatsApp.
- Todavía no se implementarán chats ni funciones de WhatsApp.
- El diseño visual se mejorará al final.

### Pendiente de definir

- Funciones de cada panel de acceso.
- Conexiones o servicios externos.
- Qué incluirán las siguientes etapas.

## 3. Cómo se va a usar

- La pantalla inicial muestra tres tipos de acceso: Super Administrador, Administrador y Colaborador.
- Cada persona inicia sesión con nombre de usuario y contraseña.
- El Administrador define qué puede ver y manejar cada Colaborador.

**Estado:** estructura inicial definida; recorrido detallado pendiente.

## 4. Pantallas

### Definido

- Inicio con los tres tipos de acceso.
- Selector de tipo de acceso.
- Campos de nombre de usuario y contraseña.
- Interfaz en texto plano durante esta etapa.

### A definir

- Pantallas y opciones disponibles para cada tipo de usuario.
- Panel principal y navegación.
- Configuración y gestión de usuarios.
- Estados vacíos, carga y error.

## 5. Información y base de datos

### Usuarios

El modelo inicial está documentado en [database/modelo-inicial.md](database/modelo-inicial.md), y el esquema ejecutable en [database/schema.sql](database/schema.sql).

- Se usará una sola tabla para las cuentas de usuario.
- Cada cuenta tendrá un nombre de usuario único en todo el sistema, independientemente de su rol.
- Cada cuenta tendrá una contraseña guardada de forma segura y uno de estos roles: Super Administrador, Administrador o Colaborador.
- Cada Colaborador quedará asociado al Administrador que lo creó.
- El nombre de usuario elegido para la única cuenta de Super Administrador es `julmago`.
- El motor de base de datos elegido es MySQL.

### Estado actual de la base

- La base `whatai` está creada en phpMyAdmin.
- Se importó el esquema y existe la tabla `users`.
- La tabla todavía tiene 0 cuentas.

### Pendiente de definir

- Datos adicionales, historial de acciones y reglas de conservación/eliminación, si hicieran falta.
- Tecnología del servidor para conectarse a MySQL.

**Manejo de una base de datos:** confirmado.  
**Esquema MySQL:** importado.  
**Conexión y creación de cuentas:** pendientes de implementar.

## 6. Integraciones

- Servicios que se conectarán con la aplicación.
- Datos que entran y salen.
- Autenticación y manejo de credenciales.
- Comportamiento cuando una integración no está disponible.

**Estado:** pendiente de definir. Las funciones de WhatsApp quedan para una etapa posterior.

## 7. Acceso y permisos

### Super Administrador

- Existe una sola cuenta de Super Administrador.
- Su nombre de usuario será `julmago`.
- No se puede crear otra cuenta de Super Administrador desde la aplicación.
- Su única función es crear cuentas de Administrador.
- Al crear un Administrador, define su nombre de usuario y contraseña.
- No accede a los paneles ni a los datos operativos de los Administradores.

### Administrador

- Puede crear todos los Colaboradores que necesite.
- Al crear un Colaborador, define su nombre de usuario y contraseña.
- Administra sus propios Colaboradores y, en una etapa posterior, sus propios números de WhatsApp.
- No puede ver la información de otros Administradores.

### Colaborador

- Solo ve y maneja lo que su Administrador le habilite.
- El Administrador puede habilitarle un solo número o varios chats/números, según los permisos que se definan.

### Pendiente de definir

- Detalle de permisos por pantalla y acción.
- Cómo se crea inicialmente la única cuenta de Super Administrador y cómo se recupera el acceso.

## 8. Diseño y experiencia

- Durante la etapa inicial, la interfaz será de texto plano.
- El diseño visual se trabajará al final, una vez definida la estructura.
- Uso en computadora y celular, navegación y claridad de los mensajes: pendientes de definir.

## 9. Estructura técnica

Cuando estén claros el alcance, los datos y las integraciones, vamos a definir:

- Organización de archivos.
- Tecnologías de la interfaz y del servidor.
- Conexión entre la web y la base de datos.
- Configuración de desarrollo y ejecución.

**Estado:** pantalla inicial en maqueta y modelo MySQL inicial documentado; tabla `users` creada; servidor y autenticación pendientes.

## 10. Etapas de trabajo

1. Definir accesos y permisos.
2. Preparar la pantalla inicial en texto plano.
3. Documentar el modelo inicial de usuarios.
4. Preparar el esquema SQL de MySQL. **Completado.**
5. Importar el esquema en la base `whatai`. **Completado.**
6. Definir el servidor y conectar la base.
7. Implementar la creación de la cuenta Super Administrador y las cuentas de Administrador y Colaborador.
8. Probar roles, permisos y nombres de usuario únicos.
9. Agregar funciones de WhatsApp en una etapa posterior.
10. Mejorar el diseño visual al final.

## 11. Decisiones confirmadas

- El trabajo de este proyecto se realizará en el repositorio `julmago/whatai`.
- La aplicación va a manejar una base de datos MySQL.
- En esta etapa se trabajarán solo los accesos y permisos, sin crear funciones de WhatsApp.
- La interfaz será de texto plano al principio; el diseño visual se mejorará al final.
- Hay tres tipos de acceso: Super Administrador, Administrador y Colaborador.
- El Super Administrador solo puede crear cuentas de Administrador.
- El nombre de usuario del único Super Administrador será `julmago`.
- Administradores y Colaboradores se crean con nombre de usuario y contraseña.
- Los nombres de usuario son únicos en el sistema; la base de datos debe rechazar duplicados.
- Los Colaboradores quedan asociados al Administrador que los crea.
- El esquema MySQL inicial se importó en la base `whatai`.

## 12. Decisiones pendientes

Se van a ir agregando acá a medida que las definamos.
