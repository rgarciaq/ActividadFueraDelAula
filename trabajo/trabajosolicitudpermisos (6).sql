-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2021 a las 11:35:32
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajosolicitudpermisos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`) VALUES
(1, '1 dam'),
(2, '2 dam');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(100) NOT NULL,
  `nrp` varchar(100) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `idDto` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `nombre`, `dni`, `nrp`, `domicilio`, `telefono`, `idDto`) VALUES
(1, 'paco', '11111111R', '11111111R', 'c pizarra', '333555333', ''),
(2, 'perico', '11111111T', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dto`
--

CREATE TABLE `dto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dto`
--

INSERT INTO `dto` (`id`, `nombre`) VALUES
(1, 'Matematicas'),
(2, 'Lenguaje'),
(3, 'ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichero`
--

CREATE TABLE `fichero` (
  `id` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fichero`
--

INSERT INTO `fichero` (`id`, `idPermiso`, `nombre`) VALUES
(1, 1, 'Cursos.php'),
(2, 1, 'Docente.php'),
(3, 1, 'Dto.php'),
(4, 1, 'Fichero.php'),
(5, 1, 'Permiso.php'),
(6, 1, 'PermisoCurso.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `idprofesor` int(100) NOT NULL,
  `nombreAcitivdad` varchar(100) NOT NULL,
  `diaActividad` date NOT NULL,
  `Horario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `idprofesor`, `nombreAcitivdad`, `diaActividad`, `Horario`) VALUES
(1, 1, 'ir a algun sitio en navalmoral', '2021-12-03', 'diurno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisocurso`
--

CREATE TABLE `permisocurso` (
  `idPermiso` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `hora` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisocurso`
--

INSERT INTO `permisocurso` (`idPermiso`, `idCurso`, `hora`) VALUES
(1, 1, '1'),
(1, 1, '3'),
(1, 1, '5'),
(1, 2, '1'),
(1, 2, '3'),
(1, 2, '5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dto`
--
ALTER TABLE `dto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fichero`
--
ALTER TABLE `fichero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisocurso`
--
ALTER TABLE `permisocurso`
  ADD PRIMARY KEY (`idPermiso`,`idCurso`,`hora`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dto`
--
ALTER TABLE `dto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fichero`
--
ALTER TABLE `fichero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
