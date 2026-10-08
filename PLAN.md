# Plan del proyecto WhatsApp

Documento de planificación. Lo vamos a completar por partes antes de empezar a programar.

## 1. Objetivo

- **Qué problema queremos resolver:** pendiente de definir.
- **Quiénes van a usar la web:** Super Administrador, Administradores y Colaboradores.
- **Qué resultado esperamos:** pendiente de definir.

## 2. Alcance

### Definido para esta etapa

- Preparar los accesos y los permisos de los tres tipos de usuario.
- Usar una interfaz de texto plano mientras definimos la estructura.
- Incluir el manejo de una base de datos.

### Fuera de esta etapa

- Todavía no se crearán números de WhatsApp.
- Todavía no se implementarán chats ni funciones de WhatsApp.
- El diseño visual se mejorará al final.

### Pendiente de definir

- Funciones de cada panel de acceso.
- Datos adicionales que se guardarán en la base de datos.
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
- Interfaz en texto plano durante esta etapa.

### A definir

- Pantallas y opciones disponibles para cada tipo de usuario.
- Panel principal y navegación.
- Configuración y gestión de usuarios.
- Estados vacíos, carga y error.

## 5. Información y base de datos

### Usuarios

- Se usará una sola tabla para las cuentas de usuario.
- Cada cuenta tendrá un nombre de usuario único en todo el sistema, independientemente de su rol.
- La base de datos debe impedir nombres de usuario duplicados.
- Cada cuenta tendrá una contraseña guardada de forma segura y uno de estos roles: Super Administrador, Administrador o Colaborador.
- Cada Colaborador quedará asociado al Administrador que lo creó.

### Pendiente de definir

- Datos adicionales de cada cuenta, si hicieran falta.
- Historial de acciones y reglas de conservación/eliminación.
- Motor de base de datos y modelo completo.

**Manejo de una base de datos:** confirmado.

## 6. Integraciones

- Servicios que se conectarán con la aplicación.
- Datos que entran y salen.
- Autenticación y manejo de credenciales.
- Comportamiento cuando una integración no está disponible.

**Estado:** pendiente de definir. Las funciones de WhatsApp quedan para una etapa posterior.

## 7. Acceso y permisos

### Super Administrador

- Existe una sola cuenta de Super Administrador.
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

**Estado:** pendiente; todavía no empezar a programar.

## 10. Etapas de trabajo

1. Completar el objetivo y el alcance.
2. Definir usuarios, tareas y funciones.
3. Diseñar el recorrido y las pantallas.
4. Definir la información y el modelo de datos.
5. Elegir integraciones y arquitectura.
6. Ordenar las funciones por prioridad.
7. Empezar a programar por partes.
8. Probar cada etapa y registrar lo que falta.

## 11. Decisiones confirmadas

- El trabajo de este proyecto se realizará en el repositorio `julmago/whatai`.
- La aplicación va a manejar una base de datos.
- La planificación se completa antes de empezar a programar.
- En esta etapa se trabajarán solo los accesos y permisos, sin crear funciones de WhatsApp.
- La interfaz será de texto plano al principio; el diseño visual se mejorará al final.
- Hay tres tipos de acceso: Super Administrador, Administrador y Colaborador.
- El Super Administrador solo puede crear cuentas de Administrador.
- Administradores y Colaboradores se crean con nombre de usuario y contraseña.
- Los nombres de usuario son únicos en el sistema; la base de datos debe rechazar duplicados.
- Los Colaboradores quedan asociados al Administrador que los crea.

## 12. Decisiones pendientes

Se van a ir agregando acá a medida que las definamos.
