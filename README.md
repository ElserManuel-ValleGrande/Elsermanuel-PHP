# Documentación de Proyecto PHP

## Enunciado
Crear una aplicación en PHP (sin Framework) con MySQL que cumpla con lo siguiente:
- Debe tener 4 páginas como mínimo.
- Debe tener un Login, y una opción para que un usuario nuevo se pueda registrar sin haber iniciado sesión.
- Debe tener una opción para hacer logout.
- Una vez el usuario se haya logueado, crear una opción para que pueda cambiar su contraseña.
- Al iniciar sesión, la página de inicio debe ser un CRUD de cursos que tenga como campos: Id, nombre, abreviación, aula, descripción, ícono. La tabla de listado de cursos debe tener una paginación que haga una petición cada vez que se cambie de página.
- Debe tener una opción para eliminar su propia cuenta, y automáticamente debe eliminar los cursos asociados a ese usuario.
- Se debe utilizar el patrón MVC.

## Implementación

### 1. Creación del Login
En este paso se creó un login interactivo donde se solicita el correo y contraseña registrados. También incluye una opción para registrarse si el usuario aún no tiene cuenta.

![Login del sistema](https://github.com/user-attachments/assets/f6131820-79ac-472a-a063-1d76733de5a0)

### 2. Registro de Usuario
Se implementó un formulario básico para registro que captura los datos necesarios: nombre, correo electrónico y contraseña.

![Formulario de registro](https://github.com/user-attachments/assets/26cf3b07-1ac4-425c-927c-43e8d35f38e4)

Para garantizar la seguridad, se utiliza `PASSWORD_BCRYPT` para encriptar las contraseñas en la base de datos.

![Encriptación de contraseñas](https://github.com/user-attachments/assets/f3c2e956-688a-4928-aefe-c664061d315c)

### 3. Dashboard del Usuario
Cuando el usuario se autentica correctamente, accede a una página personalizada donde dispone de varias opciones: cambiar contraseña, crear curso, eliminar cuenta o cerrar sesión.

![Dashboard del usuario](https://github.com/user-attachments/assets/20fd4538-e6e6-41b9-9a2c-dbd90f3ea4c5)

El sistema muestra los cursos en un listado con paginación. Se ha configurado para mostrar un máximo de 6 cursos por página, implementando un sistema de paginación que realiza una nueva petición al servidor cada vez que se cambia de página.

![Listado de cursos con paginación](https://github.com/user-attachments/assets/c04ecf98-2d6f-45f1-8ffd-b443fbcde858)

### 4. Creación de Cursos
Al seleccionar la opción de crear curso, se despliega un formulario que permite ingresar la información necesaria: nombre, abreviación, aula, descripción y un ícono o imagen representativa.

![Formulario de creación de curso](https://github.com/user-attachments/assets/81c09932-c95c-4965-a22f-3e2234d5d416)

Una vez creado, el curso se añade a la tabla principal, donde se ofrecen opciones para editarlo o eliminarlo. Esto completa la funcionalidad CRUD (Crear, Leer, Actualizar, Eliminar) requerida para la gestión de cursos.

![Curso añadido con opciones de edición](https://github.com/user-attachments/assets/cbf92ce5-3977-4c15-9c28-ebfb65b117e3)

### 5. Cambio de Contraseña
El sistema incluye una función para que los usuarios puedan actualizar su contraseña. El proceso es sencillo: el usuario debe introducir la nueva contraseña dos veces para confirmarla. Una vez validado, el sistema actualiza automáticamente la credencial en la base de datos.

![Formulario de cambio de contraseña](https://github.com/user-attachments/assets/ad3f2129-3f06-42e1-99e0-a1736e27fdee)

### 6. Eliminación de Cuenta
Se ha implementado una opción que permite al usuario eliminar completamente su cuenta del sistema. Este proceso realiza un borrado físico total, eliminando tanto los datos del usuario como todos los cursos asociados a dicha cuenta.

![Opción de eliminación de cuenta](https://github.com/user-attachments/assets/de2cad8b-2f1c-4d76-9c23-98f5c50fb7fc)

El sistema aplica correctamente el patrón MVC (Modelo-Vista-Controlador) para mantener una estructura organizada del código, separando la lógica de negocio, la presentación y el control de flujo de la aplicación.

