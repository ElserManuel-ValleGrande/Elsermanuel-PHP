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