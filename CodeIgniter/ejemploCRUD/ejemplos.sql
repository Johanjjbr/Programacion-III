-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2026 a las 05:31:18
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
-- Base de datos: `ejemplos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDO` varchar(100) NOT NULL,
  `DNI` varchar(15) NOT NULL,
  `MAIL` varchar(50) NOT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID`, `NOMBRE`, `APELLIDO`, `DNI`, `MAIL`, `TELEFONO`) VALUES
(1, 'Johan', 'Alumno', '96413423', 'johanjesus1arg@gmail.com', '2654622855');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `CARGA_HORARIA` int(11) NOT NULL,
  `ANIO` int(11) NOT NULL,
  `CARRERA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`ID`, `NOMBRE`, `CARGA_HORARIA`, `ANIO`, `CARRERA`) VALUES
(1, 'Programacion', 5, 2, 'TSDS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_sistema`
--

CREATE TABLE `menu_sistema` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL,
  `IMAGEN` varchar(50) NOT NULL DEFAULT 'imagenes/not_found.png',
  `URL` varchar(50) DEFAULT NULL,
  `ORDENAMIENTO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `menu_sistema`
--

INSERT INTO `menu_sistema` (`ID`, `DESCRIPCION`, `IMAGEN`, `URL`, `ORDENAMIENTO`, `ESTATUS`) VALUES
(1, 'Inicio', 'imagenes/Customer.png', '#', 1, 0),
(2, 'Agregar Usuarios', 'imagenes/Proveedores.png', '/usuarios/nuevo', 3, 0),
(3, 'Listar Usuarios', 'imagenes/Product.png', '/usuarios', 2, 0),
(4, 'Listar Materias', 'imagenes/not_found.png', '/materias', 4, 0),
(5, 'Agregar Materias', 'imagenes/not_found.png', '/materias/nuevo', 5, 0),
(6, 'Listar Alumnos', 'imagenes/not_found.png', '/alumnos', 6, 0),
(7, 'Agregar Alumnos', 'imagenes/not_found.png', '/alumnos/nuevo', 7, 0),
(8, 'Desarrollador', 'imagenes/not_found.png', '/desarrollador', 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisosmenu`
--

CREATE TABLE `permisosmenu` (
  `ID` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `permisosmenu`
--

INSERT INTO `permisosmenu` (`ID`, `ID_USUARIO`, `ID_MENU`, `ESTATUS`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(5, 2, 1, 0),
(6, 2, 3, 0),
(7, 2, 2, 1),
(8, 3, 1, 0),
(9, 3, 3, 0),
(10, 3, 2, 1),
(11, 1, 4, 0),
(12, 1, 5, 0),
(13, 1, 6, 0),
(14, 1, 7, 0),
(15, 1, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `FECHA_REGISTRO` varchar(20) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT 0,
  `TIPO` varchar(20) NOT NULL DEFAULT 'Invitado',
  `PASSWORD` varchar(50) DEFAULT '123'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `FECHA_REGISTRO`, `ESTATUS`, `TIPO`, `PASSWORD`) VALUES
(1, 'Desarrollos', 'en PHP', 'p3@desarrollosphp.com', '2014-07-30 14:39:06', 0, 'Administrador', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Johan', 'Brito', 'johanjesus1arg@gmail.com', '2014-07-30 14:39:06', 0, 'Invitado', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'Leo', 'Caprio', 'johanjes@gmail.com', '2026-06-16 21:15:13', 0, 'Invitado', '123'),
(5, 'DANIEL', 'JORQUERA', 'johanjesuXSACSCs1arg@gmail.com', '2026-06-16 21:15:30', 0, 'Invitado', '123'),
(6, 'Leo', 'Caprio', 'johanjesus1arDASASDg@gmail.com', '2026-06-16 21:15:46', 0, 'Invitado', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `menu_sistema`
--
ALTER TABLE `menu_sistema`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permisosmenu`
--
ALTER TABLE `permisosmenu`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu_sistema`
--
ALTER TABLE `menu_sistema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisosmenu`
--
ALTER TABLE `permisosmenu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
