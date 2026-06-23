-- Programador: Maximiliano Faria
-- Fecha de desarrollo: Junio/2026
-- Materia: Programacion 3 de la TSDS
-- Curso: Tecnicatura Superior en Desarrollo de Software

CREATE DATABASE IF NOT EXISTS parcial_n2_2026;
USE parcial_n2_2026;

DROP TABLE IF EXISTS inscripciones;
DROP TABLE IF EXISTS mesas;
DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(15) NOT NULL UNIQUE,
    apellido VARCHAR(60) NOT NULL,
    nombre VARCHAR(60) NOT NULL,
    telefono VARCHAR(30),
    email VARCHAR(100)
);

CREATE TABLE mesas (
    id_mesa INT AUTO_INCREMENT PRIMARY KEY,
    fecha_mesa DATE NOT NULL,
    materia VARCHAR(100) NOT NULL,
    tipo_mesa ENUM('Regular','Libre') NOT NULL,
    profesor_titular VARCHAR(100) NOT NULL,
    profesor_vocal1 VARCHAR(100) NOT NULL,
    profesor_vocal2 VARCHAR(100) NOT NULL
);

CREATE TABLE inscripciones (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT NOT NULL,
    id_mesa INT NOT NULL,
    fecha_inscripcion DATE NOT NULL,
    asistencia ENUM('Presente','Ausente') NULL,
    nota INT NULL,
    CONSTRAINT fk_inscripciones_alumnos
        FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_inscripciones_mesas
        FOREIGN KEY (id_mesa) REFERENCES mesas(id_mesa)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT chk_nota CHECK (nota IS NULL OR nota BETWEEN 1 AND 10)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(40) NOT NULL UNIQUE,
    clave VARCHAR(60) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    perfil ENUM('Administrativo','Operador') NOT NULL
);

INSERT INTO usuarios (usuario, clave, nombre_completo, perfil) VALUES
('maximiliano', '1234', 'Maximiliano Faria', 'Administrativo'),
('lucia', '1234', 'Lucia Gomez', 'Operador'),
('martin', '1234', 'Martin Perez', 'Operador'),
('sofia', '1234', 'Sofia Rodriguez', 'Operador');

INSERT INTO alumnos (dni, apellido, nombre, telefono, email) VALUES
('40111222', 'Faria', 'Maximiliano', '3804000001', 'maximiliano@mail.com'),
('40222333', 'Gomez', 'Lucia', '3804000002', 'lucia@mail.com'),
('40333444', 'Perez', 'Martin', '3804000003', 'martin@mail.com'),
('40444555', 'Rodriguez', 'Sofia', '3804000004', 'sofia@mail.com');

INSERT INTO mesas (fecha_mesa, materia, tipo_mesa, profesor_titular, profesor_vocal1, profesor_vocal2) VALUES
('2026-06-10', 'Programacion III', 'Regular', 'Alicia Sepulveda', 'Marcelo Aballay', 'Ana Lopez'),
('2026-07-05', 'Base de Datos', 'Libre', 'Carlos Diaz', 'Laura Vega', 'Pedro Castro');

INSERT INTO inscripciones (id_alumno, id_mesa, fecha_inscripcion, asistencia, nota) VALUES
(1, 1, '2026-06-01', NULL, NULL),
(2, 1, '2026-06-02', NULL, NULL),
(3, 2, '2026-06-03', NULL, NULL);

