-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2026 a las 00:32:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `brito_johan_db1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `nombre`) VALUES
(1, 'Literatura Clasica'),
(2, 'Programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_editorial`
--

CREATE TABLE `tbl_editorial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_editorial`
--

INSERT INTO `tbl_editorial` (`id`, `nombre`) VALUES
(1, 'Editorial Alfa'),
(2, 'Editorial Rama');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_civil`
--

CREATE TABLE `tbl_estado_civil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estado_civil`
--

INSERT INTO `tbl_estado_civil` (`id`, `nombre`) VALUES
(2, 'soltero'),
(3, 'divorciado'),
(4, 'casados'),
(5, 'soltero'),
(6, 'divorciado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_libros`
--

CREATE TABLE `tbl_libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_libros`
--

INSERT INTO `tbl_libros` (`id`, `titulo`, `id_categoria`, `id_editorial`, `isbn`, `descripcion`, `fecha_ingreso`) VALUES
(1, 'El principito\r\n', 1, 1, '9789877671735', 'El Principito, escrito por Antoine de Saint-Exupéry, es una obra que narra la historia de un piloto cuyo avión sufre una avería en el desierto del Sahara. Allí conoce a un misterioso niño proveniente de otro asteroide. A través de sus relatos, el libro critica la superficialidad del mundo adulto y reflexiona sobre el amor, la amistad y el sentido de la vida. ', '2026-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais`
--

CREATE TABLE `tbl_pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pais`
--

INSERT INTO `tbl_pais` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Chile'),
(3, 'Uruguay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_prestamos`
--

CREATE TABLE `tbl_prestamos` (
  `id` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_devolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_prestamos`
--

INSERT INTO `tbl_prestamos` (`id`, `id_socio`, `id_libro`, `fecha_entrega`, `fecha_devolucion`) VALUES
(1, 1, 1, '2026-06-10', '2026-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincia`
--

CREATE TABLE `tbl_provincia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_provincia`
--

INSERT INTO `tbl_provincia` (`id`, `nombre`, `id_pais`) VALUES
(1, 'San Juan', 1),
(2, 'Mendoza', 1),
(3, 'Córdoba', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sexo`
--

CREATE TABLE `tbl_sexo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_sexo`
--

INSERT INTO `tbl_sexo` (`id`, `nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'No Binario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_socios`
--

CREATE TABLE `tbl_socios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nro_doc` varchar(20) NOT NULL,
  `id_tipo_doc` int(11) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `id_estado_civil` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `direccion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_socios`
--

INSERT INTO `tbl_socios` (`id`, `nombre`, `nro_doc`, `id_tipo_doc`, `id_sexo`, `id_estado_civil`, `id_pais`, `id_provincia`, `localidad`, `direccion`) VALUES
(1, 'Johan Brito', '96413423', 1, 1, 2, 1, 1, 'Caucete ', 'Barrio Enoe Mendoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_doc`
--

CREATE TABLE `tbl_tipo_doc` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_doc`
--

INSERT INTO `tbl_tipo_doc` (`id`, `nombre`) VALUES
(1, 'DNI'),
(2, 'Pasaporte'),
(3, 'LC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_editorial`
--
ALTER TABLE `tbl_editorial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_estado_civil`
--
ALTER TABLE `tbl_estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_editorial` (`id_editorial`);

--
-- Indices de la tabla `tbl_pais`
--
ALTER TABLE `tbl_pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_prestamos`
--
ALTER TABLE `tbl_prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_socio` (`id_socio`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `tbl_provincia`
--
ALTER TABLE `tbl_provincia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `tbl_sexo`
--
ALTER TABLE `tbl_sexo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_socios`
--
ALTER TABLE `tbl_socios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nro_doc` (`nro_doc`),
  ADD KEY `id_tipo_doc` (`id_tipo_doc`),
  ADD KEY `id_sexo` (`id_sexo`),
  ADD KEY `id_estado_civil` (`id_estado_civil`),
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- Indices de la tabla `tbl_tipo_doc`
--
ALTER TABLE `tbl_tipo_doc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_editorial`
--
ALTER TABLE `tbl_editorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_civil`
--
ALTER TABLE `tbl_estado_civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_pais`
--
ALTER TABLE `tbl_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_prestamos`
--
ALTER TABLE `tbl_prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_provincia`
--
ALTER TABLE `tbl_provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_sexo`
--
ALTER TABLE `tbl_sexo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_socios`
--
ALTER TABLE `tbl_socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_doc`
--
ALTER TABLE `tbl_tipo_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  ADD CONSTRAINT `tbl_libros_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id`),
  ADD CONSTRAINT `tbl_libros_ibfk_2` FOREIGN KEY (`id_editorial`) REFERENCES `tbl_editorial` (`id`);

--
-- Filtros para la tabla `tbl_prestamos`
--
ALTER TABLE `tbl_prestamos`
  ADD CONSTRAINT `tbl_prestamos_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `tbl_socios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_prestamos_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `tbl_libros` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_provincia`
--
ALTER TABLE `tbl_provincia`
  ADD CONSTRAINT `tbl_provincia_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `tbl_pais` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_socios`
--
ALTER TABLE `tbl_socios`
  ADD CONSTRAINT `tbl_socios_ibfk_1` FOREIGN KEY (`id_tipo_doc`) REFERENCES `tbl_tipo_doc` (`id`),
  ADD CONSTRAINT `tbl_socios_ibfk_2` FOREIGN KEY (`id_sexo`) REFERENCES `tbl_sexo` (`id`),
  ADD CONSTRAINT `tbl_socios_ibfk_3` FOREIGN KEY (`id_estado_civil`) REFERENCES `tbl_estado_civil` (`id`),
  ADD CONSTRAINT `tbl_socios_ibfk_4` FOREIGN KEY (`id_pais`) REFERENCES `tbl_pais` (`id`),
  ADD CONSTRAINT `tbl_socios_ibfk_5` FOREIGN KEY (`id_provincia`) REFERENCES `tbl_provincia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
