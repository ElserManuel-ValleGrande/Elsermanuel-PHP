# 📚 Sistema de Gestión de Cursos en PHP

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 🔍 Descripción

Aplicación web desarrollada en PHP puro (sin frameworks) que implementa un completo sistema de gestión de cursos académicos. La aplicación sigue el patrón arquitectónico MVC (Modelo-Vista-Controlador) para mantener un código limpio, modular y fácil de mantener.

## ✨ Características principales

- **Sistema de autenticación completo** (registro, login, logout)
- **Panel de administración** personalizado para cada usuario
- **CRUD completo de cursos** con paginación dinámica mediante AJAX
- **Gestión de perfil de usuario** (cambio de contraseña, eliminación de cuenta)
- **Seguridad mejorada** con encriptación de contraseñas mediante bcrypt
- **Interfaz responsiva** adaptada a dispositivos móviles y escritorio

## 🛠️ Requisitos del proyecto

Este proyecto fue desarrollado cumpliendo los siguientes requisitos:

- Aplicación PHP sin uso de frameworks
- Base de datos MySQL
- Mínimo 4 páginas funcionales
- Sistema de autenticación completo
- CRUD de cursos con campos: Id, nombre, abreviación, aula, descripción e ícono
- Paginación con recarga dinámica de contenido
- Implementación del patrón arquitectónico MVC

## 📋 Estructura del proyecto

```
/Elsermanuel-PHP/
├── /app/                   # Controladores para gestión de lógica
│   ├── CursoController.php         # Controlador para acciones sobre cursos
│   └── UsuarioController.php       # Controlador para acciones sobre usuarios
├── /models/                # Modelos (ORM) para la interacción con la base de datos
│   ├── curso.php
│   └── usuario.php
├── /views/                 # Vistas HTML y formularios
│   ├── crear_curso.php
│   ├── dashboard.php
│   ├── editar_curso.php
│   ├── login.php
│   └── registro.php
├── /assets/                # Recursos estáticos como CSS, JS, imágenes
│   └── css/
│       ├── curso.css
│       ├── dashboard-style.css
│       ├── styles-login.css
│       └── styles-registro.css
├── /config/                # Configuración general (base de datos, constantes, etc.)
│   └── database.php
├── /utils/                 # Funciones auxiliares, helpers (crear si lo necesitas)
├── /sql/                   # Scripts SQL para la base de datos
│   └── database.sql
├── index.php               # Punto de entrada principal de la app
├── test_db.php             # Script de prueba de conexión BD (podría ir a utils/)
└── README.md               # Documentación del proyecto

```

## 📸 Capturas de pantalla

### Login y Registro

<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <div style="width: 48%;">
        <h4>Página de Login</h4>
        <img src="https://github.com/user-attachments/assets/f6131820-79ac-472a-a063-1d76733de5a0" alt="Login del sistema" width="100%">
        <p><em>En este paso se creó un login interactivo donde se solicita el correo y contraseña registrados. También incluye una opción para registrarse si el usuario aún no tiene cuenta.</em></p>
    </div>
    <div style="width: 48%;">
        <h4>Registro de Usuario</h4>
        <img src="https://github.com/user-attachments/assets/26cf3b07-1ac4-425c-927c-43e8d35f38e4" alt="Formulario de registro" width="100%">
        <p><em>Se implementó un formulario básico para registro que captura los datos necesarios: nombre, correo electrónico y contraseña.</em></p>
    </div>
</div>

### Gestión de Cursos

<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <div style="width: 48%;">
        <h4>Dashboard de Cursos</h4>
        <img src="https://github.com/user-attachments/assets/20fd4538-e6e6-41b9-9a2c-dbd90f3ea4c5" alt="Dashboard del usuario" width="100%">
        <p><em>Cuando el usuario se autentica correctamente, accede a una página personalizada donde dispone de varias opciones: cambiar contraseña, crear curso, eliminar cuenta o cerrar sesión.</em></p>
    </div>
    <div style="width: 48%;">
        <h4>Listado Paginado</h4>
        <img src="https://github.com/user-attachments/assets/c04ecf98-2d6f-45f1-8ffd-b443fbcde858" alt="Listado de cursos con paginación" width="100%">
        <p><em>Sistema de paginación dinámica con carga asíncrona mediante AJAX</em></p>
    </div>
</div>

<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <div style="width: 48%;">
        <h4>Creación de Cursos</h4>
        <img src="https://github.com/user-attachments/assets/81c09932-c95c-4965-a22f-3e2234d5d416" alt="Formulario de creación de curso" width="100%">
        <p><em>Formulario con validación de campos y carga de imagen para el ícono</em></p>
    </div>
    <div style="width: 48%;">
        <h4>Gestión de Cursos</h4>
        <img src="https://github.com/user-attachments/assets/cbf92ce5-3977-4c15-9c28-ebfb65b117e3" alt="Curso añadido con opciones de edición" width="100%">
        <p><em>Opciones de edición y eliminación con confirmación para evitar acciones involuntarias</em></p>
    </div>
</div>

### Gestión de Usuario

<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <div style="width: 48%;">
        <h4>Cambio de Contraseña</h4>
        <img src="https://github.com/user-attachments/assets/ad3f2129-3f06-42e1-99e0-a1736e27fdee" alt="Formulario de cambio de contraseña" width="100%">
        <p><em>Sistema seguro de actualización de credenciales con doble verificación</em></p>
    </div>
    <div style="width: 48%;">
        <h4>Eliminación de Cuenta</h4>
        <img src="https://github.com/user-attachments/assets/de2cad8b-2f1c-4d76-9c23-98f5c50fb7fc" alt="Opción de eliminación de cuenta" width="100%">
        <p><em>Proceso de eliminación con advertencia y confirmación para prevenir pérdidas de datos</em></p>
    </div>
</div>

## 💾 Base de datos

El sistema utiliza una base de datos MySQL con dos tablas principales:

```sql
CREATE DATABASE testEdulink;
USE testEdulink;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    abreviacion VARCHAR(50) NOT NULL,
    aula VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen LONGBLOB,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


/*test*/
INSERT INTO usuarios (nombre, email, password) VALUES  
('Juan Pérez', 'juan@example.com', '$2y$10$EjemploDeContraseñaCifrada');

INSERT INTO cursos (usuario_id, nombre, abreviacion, aula, descripcion, icono) VALUES 
(1, 'Matemáticas Avanzadas', 'MATE-101', 'Aula 5', 'Curso de matemáticas superiores', 'icono1.png'),
(1, 'Programación en PHP', 'PHP-202', 'Aula 3', 'Curso básico de PHP', 'icono2.png');
```

## 🔒 Seguridad implementada

- Encriptación de contraseñas utilizando PASSWORD_BCRYPT
- Protección contra inyección SQL mediante consultas preparadas (prepared statements)
- Validación y sanitización de entradas de usuario
- Control de sesiones seguro
- Restricción de acceso a rutas protegidas

## 📦 Instalación

1. Clona este repositorio en tu servidor web local o remoto
   ```bash
   git clone https://github.com/ElserManuel-ValleGrande/Elsermanuel-PHP.git
      cd Elsermanuel-PHP

   ```

2. Importa la estructura de la base de datos desde el archivo `sql/database.sql`

3. Configura los parámetros de conexión en `config/database.php`
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'sistema_cursos');
   ```

4. Accede a la aplicación desde tu navegador
   ```
   http://localhost/sistema-gestion-cursos/
   ```

---

⭐ Desarrollado con ❤️ por [ElserManuel](https://github.com/ElserManuel) ⭐
