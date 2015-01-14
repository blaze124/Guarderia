-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2015 a las 19:49:39
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `guarderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE IF NOT EXISTS `acceso` (
`id` int(10) unsigned NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `nickname`, `password`) VALUES
(3, 'ale_melero', '983dd484'),
(4, 'nico', '4aba7510'),
(5, 'alum', '8b398dea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` int(10) unsigned NOT NULL,
  `id_noticia` int(10) unsigned NOT NULL,
  `ruta` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `id_noticia`, `ruta`) VALUES
(12, 19, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/homer.jpg'),
(14, 21, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/cod_header.png'),
(15, 22, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/portada.PNG'),
(16, 23, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/'),
(17, 24, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/fondo_deadpool_-_copia.jpg'),
(18, 25, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/'),
(19, 26, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/homer1.jpg'),
(21, 30, 'C:/xampp/htdocs/Guarderia/imagenes/Cursos/cod_header1.png'),
(22, 31, 'C:/xampp/htdocs/Guarderia/imagenes/Menus/fondo_deadpool.jpg'),
(24, 33, 'C:/xampp/htdocs/Guarderia/imagenes/Menus/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
`id` int(10) unsigned NOT NULL,
  `titular` text NOT NULL,
  `cuerpo` text NOT NULL,
  `tipo` enum('NOV','CUR','COM') NOT NULL DEFAULT 'NOV',
  `privilegios` enum('PUBLICO','PRIVADO') NOT NULL DEFAULT 'PUBLICO',
  `fecha` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titular`, `cuerpo`, `tipo`, `privilegios`, `fecha`) VALUES
(17, 'Prueba', 'asdfadfadf', 'NOV', 'PUBLICO', '2015-01-05'),
(18, 'Prueba', 'asdfasdfasdf', 'NOV', 'PUBLICO', '2015-01-05'),
(19, 'asdfasfa', 'sdfasdfasdfasdfasdfasdf', 'NOV', 'PUBLICO', '2015-01-05'),
(21, 'as', 'asdfasdfasdfasdfasdfasdf', 'NOV', 'PUBLICO', '2015-01-05'),
(22, 'asdf', 'asdfasdfasdfa', 'NOV', 'PUBLICO', '2015-01-05'),
(23, 'asd', 'ffaasdd', 'NOV', 'PUBLICO', '2015-01-05'),
(24, 'Prueba', 'asdfasdfasdfad', 'NOV', 'PUBLICO', '2015-01-05'),
(25, 'asd', 'asd', 'NOV', 'PUBLICO', '2015-01-05'),
(26, 'afdsfasdf', 'asdfasdfasdfa', 'NOV', 'PUBLICO', '2015-01-05'),
(28, 'paddu', 'fasdfasdfasd', 'NOV', 'PUBLICO', '2015-01-05'),
(29, 'noticion', 'asdfasdfasdfa', 'CUR', 'PUBLICO', '2015-01-05'),
(30, 'noticion2', 'asdfasdfasdfasdfa', 'CUR', 'PUBLICO', '2015-01-05'),
(31, 'fjaosdfh', 'àsdfasdfasdfasdf', 'COM', 'PUBLICO', '2015-01-05'),
(33, 'ytrds', 'hgfds', 'COM', 'PUBLICO', '2015-01-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
`id` int(10) unsigned NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `dni` varchar(9) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `nickname`, `nombre`, `apellidos`, `email`, `telefono`, `dni`) VALUES
(1, 'alum', 'tutorcete', 'tutelador', 'chocapic@gmail.com', '956887766', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(10) unsigned NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `DNI` varchar(11) DEFAULT NULL,
  `email` text,
  `rol` enum('ALUM','PROF','ADMIN') NOT NULL DEFAULT 'ALUM',
  `domicilio` text NOT NULL,
  `f_nac` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `nombre`, `apellidos`, `DNI`, `email`, `rol`, `domicilio`, `f_nac`) VALUES
(3, 'ale_melero', 'Alejandro', 'Melero Rodriguez', '76089756A', 'alemelero12@gmail.com', 'ADMIN', 'Avenida de mi casa 123', '1991-05-24'),
(4, 'nico', 'nico', 'nico', '76089757A', 'alemelero13@gmail.com', 'PROF', 'Avenida de mi casa 123', '1991-05-24'),
(5, 'alum', 'alum', 'alum', NULL, NULL, 'ALUM', 'Avenida de mi casa 123', '2007-07-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nickname` (`nickname`,`dni`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
