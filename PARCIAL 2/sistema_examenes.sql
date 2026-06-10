CREATE DATABASE IF NOT EXISTS sistema_examenes
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE sistema_examenes;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(100) NOT NULL,
    perfil ENUM('Administrativo', 'Operador') NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS alumnos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(15) NOT NULL,
    direccion VARCHAR(100) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    email VARCHAR(80) DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY dni (dni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS mesas_examen (
    id INT(11) NOT NULL AUTO_INCREMENT,
    fecha DATE NOT NULL,
    materia VARCHAR(80) NOT NULL,
    tipo ENUM('regular', 'libre') NOT NULL,
    titular VARCHAR(100) NOT NULL,
    vocal1 VARCHAR(100) NOT NULL,
    vocal2 VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS inscripciones (
    id INT(11) NOT NULL AUTO_INCREMENT,
    alumno_id INT(11) NOT NULL,
    mesa_id INT(11) NOT NULL,
    asistencia VARCHAR(2) DEFAULT NULL,
    nota DECIMAL(4,2) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY alumno_id (alumno_id),
    KEY mesa_id (mesa_id),
    CONSTRAINT inscripciones_ibfk_1 FOREIGN KEY (alumno_id) REFERENCES alumnos (id) ON DELETE CASCADE,
    CONSTRAINT inscripciones_ibfk_2 FOREIGN KEY (mesa_id) REFERENCES mesas_examen (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios (usuario, clave, perfil, nombre_completo) VALUES
('admin', '123456', 'Administrativo', 'Juan Pérez (Admin)'),
('operador', '123456', 'Operador', 'María Gómez (Operador)');

INSERT INTO alumnos (nombre, apellido, dni, direccion, telefono, email) VALUES
('Carlos', 'López', '30123456', 'Av. Siempre Viva 742', '1145678901', 'carlos.lopez@email.com'),
('Ana', 'Martínez', '31234567', 'Calle Falsa 123', '1156789012', 'ana.martinez@email.com'),
('Pedro', 'Ramírez', '32345678', 'Belgrano 500', '1167890123', 'pedro.ramirez@email.com'),
('Laura', 'Fernández', '33456789', 'San Martín 800', '1178901234', 'laura.fernandez@email.com'),
('Santiago', 'García', '34567890', 'Rivadavia 300', '1189012345', 'santiago.garcia@email.com');

INSERT INTO mesas_examen (fecha, materia, tipo, titular, vocal1, vocal2) VALUES
('2026-05-15', 'Programación I', 'regular', 'Prof. Gómez', 'Prof. López', 'Prof. Díaz'),
('2026-06-10', 'Base de Datos', 'libre', 'Prof. Martínez', 'Prof. García', 'Prof. Rodríguez'),
('2026-07-20', 'Matemática', 'regular', 'Prof. Fernández', 'Prof. Álvarez', 'Prof. Pérez'),
('2026-08-05', 'Programación II', 'libre', 'Prof. Díaz', 'Prof. Gómez', 'Prof. López');

INSERT INTO inscripciones (alumno_id, mesa_id, asistencia, nota) VALUES
(1, 1, 'Si', 8.50),
(2, 1, 'No', NULL),
(3, 2, 'Si', 6.00);
