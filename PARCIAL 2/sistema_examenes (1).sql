-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2026 a las 17:27:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_examenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `dni`, `nombre`, `apellido`, `email`, `telefono`, `direccion`) VALUES
(1, '96413423', 'Johan', 'Brito', 'johanjesus1arg@gmail.com', '02644622855', 'CAUCETE - BARRIO ENOE MENDOZA - M/K C/2'),
(2, '123415', 'Leo', 'Caprio', 'johanjesus1arg@gmail.com', '04123800706', 'Riverdale');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `asistencia` varchar(15) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `id_alumno`, `id_mesa`, `fecha_inscripcion`, `asistencia`, `nota`) VALUES
(1, 1, 2, '0000-00-00', NULL, NULL),
(3, 2, 2, '0000-00-00', NULL, NULL),
(4, 1, 4, '0000-00-00', 'No', 10),
(5, 2, 3, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas_examen`
--

CREATE TABLE `mesas_examen` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `materia` varchar(100) NOT NULL,
  `tipo` enum('Regular','Libre') NOT NULL,
  `titular` varchar(100) NOT NULL,
  `pvocal1` varchar(100) NOT NULL,
  `pvocal2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas_examen`
--

INSERT INTO `mesas_examen` (`id`, `fecha`, `materia`, `tipo`, `titular`, `pvocal1`, `pvocal2`) VALUES
(2, '2026-06-18', 'Programacion 3', 'Libre', 'Alicia Sepulpeda (gemela)', 'Alguien mas2', 'otro por ahi3'),
(3, '2026-06-18', 'Programacion 2', 'Regular', 'Alicia Sepulpeda', 'Alguien mas', 'otro por ahi'),
(4, '2026-06-08', 'Programacion 3', 'Libre', 'Johan Brito Profesor', 'El gemelo', 'El otro gemelo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `perfil` enum('Administrativo','Operador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `clave`, `nombre_completo`, `perfil`) VALUES
('admin', 'admin', 'Johan Jesus Brito Rodriguez', 'Administrativo'),
('lucas_diaz', 'op789', 'Lucas Díaz', 'Operador'),
('maria_lopez', 'op456', 'María López', 'Operador'),
('operador', 'op123', 'Carlos Gómez', 'Operador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_mesa` (`id_mesa`);

--
-- Indices de la tabla `mesas_examen`
--
ALTER TABLE `mesas_examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas_examen`
--
ALTER TABLE `mesas_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`id_mesa`) REFERENCES `mesas_examen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
