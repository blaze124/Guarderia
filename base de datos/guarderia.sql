-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2015 a las 14:31:37
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `nickname`, `password`) VALUES
(10, 'admin', '124YC6OXr.CGM'),
(12, 'ale_melero', '12cuSu5odBwag'),
(14, 'profesor', '12Hw38iDh/cOU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` int(10) unsigned NOT NULL,
  `id_noticia` int(10) unsigned NOT NULL,
  `ruta` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `id_noticia`, `ruta`) VALUES
(41, 47, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/carnaval1.jpg'),
(42, 47, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/carnaval2.jpg'),
(50, 50, 'C:/xampp/htdocs/Guarderia/imagenes/Menus/menu_octubre.jpg'),
(51, 51, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/blog.png'),
(52, 51, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/face.png'),
(53, 51, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/titulo.png'),
(54, 52, 'C:/xampp/htdocs/Guarderia/imagenes/Cursos/homer.jpg'),
(55, 52, 'C:/xampp/htdocs/Guarderia/imagenes/Cursos/portada.PNG'),
(57, 54, 'C:/xampp/htdocs/Guarderia/imagenes/Cursos/portada1.PNG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titular`, `cuerpo`, `tipo`, `privilegios`, `fecha`) VALUES
(47, 'Carnaval ', 'Noticia con varias imágenes de carnaval para probar que se acoplan bien.', 'NOV', 'PUBLICO', '2015-02-11'),
(50, 'Menu Octubre', 'Aquí os dejamos el menú que nuestro equipo de nutricionistas ha preparado para el mes de Octubre de 2012', 'COM', 'PUBLICO', '2015-02-12'),
(51, 'Noticia Privada', 'Este será el cuerpo de la noticia privada con la que vamos a probar que se hace la consulta bien.<br />\r\n<br />\r\nEsta noticia debe aparecer unicamente para usuarios registrados.', 'NOV', 'PRIVADO', '2015-02-13'),
(52, 'Curso de Test', 'Aquí se introduce el cuerpo de la noticia para comprobar que funciona todo bien.<br />\r\n<br />\r\nProbamos con saltos de línea y palabras acentuadas.<br />\r\n<br />\r\nMás saltos de línea para tener varios párrafos.<br />\r\n<br />\r\nPara terminar pegamos un párrafo con lorem ipsum para dar grosor al cuerpo:<br />\r\n"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eleifend semper tortor ut blandit. Donec aliquam, arcu quis posuere pretium, leo tellus mollis massa, non mattis urna magna efficitur tellus. Duis elementum ac odio sit amet dignissim. Fusce consequat hendrerit finibus. Donec tempor vehicula iaculis. Praesent blandit ante a est lobortis, eget sollicitudin erat consequat. Pellentesque erat neque, imperdiet a sem nec, lacinia pretium nisl. Proin odio nibh, iaculis quis justo quis, lacinia tristique nisi. Phasellus a suscipit tellus, id ultrices ligula. Vestibulum id bibendum odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus egestas, neque vel faucibus malesuada, leo metus tincidunt nisi, ut imperdiet felis nisi ac lectus. Maecenas sollicitudin vitae eros in dictum. Suspendisse lorem tellus, dictum semper leo non, sagittis lobortis purus. Suspendisse feugiat convallis commodo. Mauris feugiat aliquet urna vel dictum".', 'CUR', 'PUBLICO', '2015-03-06'),
(54, 'Curso de Profesor Privado', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper et eros at porttitor. Sed vehicula mauris neque, quis tempor enim venenatis vitae. Nullam sapien enim, malesuada in erat eget, dictum pharetra quam. Vestibulum ante massa, pretium at nisi ut, mattis finibus risus. Curabitur laoreet tellus ut blandit commodo. Suspendisse justo diam, cursus sit amet finibus ut, suscipit quis lectus. Praesent dapibus ex sed sem sollicitudin convallis. Pellentesque porta cursus tellus eget imperdiet. Nullam vel gravida justo. Proin ornare libero vitae congue venenatis. Nulla rhoncus mi diam, at cursus nisi ultrices elementum.<br />\r\n<br />\r\nPraesent tincidunt est quis rhoncus dapibus. Fusce aliquet mattis quam, tempor vestibulum dui eleifend sed. Aliquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce mollis a augue sed porta. Aliquam suscipit ac tortor a ullamcorper. Sed ac vehicula urna, et euismod tortor. Ut lacinia leo quis congue ultrices. Fusce ultricies mauris in augue facilisis, ac feugiat ipsum laoreet. Nam eu nisl id arcu maximus egestas sit amet et felis.<br />\r\n<br />\r\nPhasellus venenatis urna lacus. Mauris eget tortor odio. Nam porta leo ipsum, eget tempor mauris vulputate sit amet. Nam risus purus, faucibus ut laoreet et, laoreet vel lorem. Nam id libero id purus posuere volutpat. In hac habitasse platea dictumst. In condimentum malesuada efficitur.', 'CUR', 'PRIVADO', '2015-03-16');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `nickname`, `nombre`, `apellidos`, `email`, `telefono`, `dni`) VALUES
(2, 'ale_melero', 'Mi', 'Tutor', 'blazedecai@hotmail.com', '699885522', '12345678P');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `nombre`, `apellidos`, `DNI`, `email`, `rol`, `domicilio`, `f_nac`) VALUES
(10, 'admin', 'Administrador', 'del Sistema', '12345678Z', 'guarderia.bahiablanca@gmail.com', 'ADMIN', 'Calle Tamarindos, 14, Cádiz', '2000-01-01'),
(12, 'ale_melero', 'Alejandro', 'Melero Rodriguez', NULL, NULL, 'ALUM', 'Avenida de mi Casa,123, MiCiudad', '1991-05-24'),
(14, 'profesor', 'Profesor', 'de Pruebas Interino', '77888444L', 'alemelero12@gmail.com', 'PROF', 'Calle donde vive, 99, 1ºA', '1979-12-30');

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
