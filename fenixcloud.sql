-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2017 a las 05:10:33
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fenixcloud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cat_clave_int` int(11) NOT NULL,
  `cat_nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_clave_int`, `cat_nombre`) VALUES
(1, 'peliculas'),
(2, 'hogar'),
(3, 'deportes'),
(4, 'oficina'),
(5, 'animales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `letraseleccionadas`
--

CREATE TABLE `letraseleccionadas` (
  `les_clave_int` int(11) NOT NULL,
  `pas_clave_int` int(11) DEFAULT NULL,
  `les_letra` varchar(255) DEFAULT NULL,
  `les_estado` varchar(255) DEFAULT '0',
  `les_aciertos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras`
--

CREATE TABLE `palabras` (
  `pal_clave_int` int(11) NOT NULL,
  `pal_nombre` varchar(255) DEFAULT NULL,
  `cat_clave_int` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palabras`
--

INSERT INTO `palabras` (`pal_clave_int`, `pal_nombre`, `cat_clave_int`) VALUES
(1, 'iron man', 1),
(2, 'batman', 1),
(3, 'superman', 1),
(4, 'cama', 2),
(5, 'baño', 2),
(6, 'cocina', 2),
(7, 'futbol', 3),
(8, 'baloncesto', 3),
(9, 'atletismo', 3),
(10, 'perro', 5),
(11, 'gato', 5),
(12, 'lobo', 5),
(13, 'leon', 5),
(14, 'tigre', 5),
(15, 'loro', 5),
(16, 'pez', 5),
(17, 'la purga', 1),
(18, 'amor a primera vista', 1),
(19, '500 dias con ella', 1),
(20, 'cartas a julieta', 1),
(21, 'muebles', 2),
(22, 'silla', 2),
(23, 'sofa', 2),
(24, 'televisor', 2),
(25, 'nevera', 2),
(26, 'computador', 4),
(27, 'escritorio', 4),
(28, 'sillas', 4),
(29, 'mesas', 4),
(30, 'cafetera', 4),
(31, 'impresora', 4),
(32, 'lapiz', 4),
(33, 'lapicero', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabraseleccionada`
--

CREATE TABLE `palabraseleccionada` (
  `pas_clave_int` int(11) NOT NULL,
  `pal_clave_int` int(11) DEFAULT NULL,
  `pas_estado` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_clave_int`);

--
-- Indices de la tabla `letraseleccionadas`
--
ALTER TABLE `letraseleccionadas`
  ADD PRIMARY KEY (`les_clave_int`);

--
-- Indices de la tabla `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`pal_clave_int`);

--
-- Indices de la tabla `palabraseleccionada`
--
ALTER TABLE `palabraseleccionada`
  ADD PRIMARY KEY (`pas_clave_int`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_clave_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `letraseleccionadas`
--
ALTER TABLE `letraseleccionadas`
  MODIFY `les_clave_int` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `palabras`
--
ALTER TABLE `palabras`
  MODIFY `pal_clave_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `palabraseleccionada`
--
ALTER TABLE `palabraseleccionada`
  MODIFY `pas_clave_int` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
