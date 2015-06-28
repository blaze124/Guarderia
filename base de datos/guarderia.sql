-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2015 a las 20:54:12
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `nickname`, `password`) VALUES
(10, 'admin', '124YC6OXr.CGM'),
(18, 'alumno', '12XxC5gyBd0qQ'),
(19, 'profesor', '12KfN6iTulDVI'),
(20, 'alumno2', '1286OpF..GPh6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`id` int(255) unsigned NOT NULL,
  `evento` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `cuerpo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `evento`, `nickname`, `cuerpo`) VALUES
(1, 3, 'alumno2', 'Soy el tutor del alumno Alumno2 y me parece perfecto como se gestiona todo esto.'),
(2, 6, 'alumno2', 'me alegro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosalum`
--

CREATE TABLE IF NOT EXISTS `datosalum` (
`id` int(255) NOT NULL,
  `nickname` varchar(150) NOT NULL,
  `horario` enum('ESCOLAR','COMEDOR','COMPLETO','MATINAL') NOT NULL,
  `pago` enum('EFECTIVO','DOMICILIACION') NOT NULL,
  `fotos` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosalum`
--

INSERT INTO `datosalum` (`id`, `nickname`, `horario`, `pago`, `fotos`) VALUES
(2, 'alumno', 'ESCOLAR', 'EFECTIVO', 0),
(3, 'alumno2', 'COMPLETO', 'DOMICILIACION', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
`id` int(255) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `grupo` varchar(100) NOT NULL,
  `cuerpo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `fecha`, `grupo`, `cuerpo`) VALUES
(1, '2015-05-11', 'Amarillo', 'Hoy no hemos hecho nada de nada.<br />\r\n<br />\r\nProbamos saltos de línea y codificación para que todo sea correcto.<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultrices bibendum venenatis. Curabitur id ultrices magna. Maecenas accumsan erat quis sodales feugiat. Nunc dapibus metus scelerisque, condimentum dolor nec, feugiat lacus. Nunc id porttitor dui. Mauris non molestie lectus. Integer non tellus at sem ultricies condimentum. Donec eu purus sollicitudin, tempor dui a, ultricies magna. Phasellus pellentesque placerat suscipit. In sit amet nisi metus. Nullam finibus nisi et nulla semper lobortis. Aliquam auctor sapien et risus mattis faucibus. Aliquam erat volutpat.<br />\r\n<br />\r\nPellentesque rutrum, turpis et tristique dictum, leo lorem cursus ipsum, eu molestie mi tortor commodo purus. Sed non nunc vehicula, consequat ante eget, malesuada lorem. Nunc rutrum egestas nisi, at condimentum nulla malesuada non. Mauris non aliquam erat, vitae tempor nulla. Sed sed nisi nec lacus commodo dapibus vitae non orci. Pellentesque non urna elit. Mauris semper efficitur dolor, quis gravida nibh porttitor sit amet. Integer urna sem, ultrices sed congue sit amet, condimentum non metus. Praesent ut fermentum turpis. Aliquam tempus et nisi dignissim cursus. Maecenas sit amet tortor tempus, euismod diam nec, facilisis eros. Morbi ac sapien interdum, auctor dui sit amet, sagittis nisi. Vivamus quis ipsum sed tortor lacinia cursus. Sed ut tempor tellus.<br />\r\n<br />\r\nFusce bibendum felis eu velit auctor, in ultricies purus blandit. Pellentesque sit amet efficitur urna. Praesent in cursus lorem. Maecenas varius, metus auctor vestibulum tincidunt, ante magna dictum quam, eu hendrerit magna quam eu purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nec lacus in urna suscipit sodales. Praesent in dui tempus, pretium enim vel, dignissim felis. Phasellus molestie id arcu ac imperdiet. Maecenas nunc ligula, congue ac molestie eget, aliquet vel tellus.<br />\r\n<br />\r\nQuisque faucibus ipsum in consequat fermentum. Suspendisse potenti. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed quis ultricies mi. Curabitur aliquet, purus quis feugiat accumsan, sem purus convallis augue, finibus varius ante dui a risus. Morbi nibh mi, cursus dapibus interdum in, molestie sit amet lorem. Morbi rutrum dignissim laoreet. Aliquam at tempus orci. Cras non lobortis nunc. Nunc tincidunt sem ut augue auctor, et viverra velit imperdiet. Sed justo augue, tincidunt eu laoreet eu, maximus auctor lacus. Integer porta mauris sed est varius tempor et quis arcu. Vestibulum pharetra ligula vitae lectus facilisis, consequat consectetur lectus euismod. Nulla et sodales risus, sed gravida metus.<br />\r\n<br />\r\nNunc sed mauris pharetra, euismod massa a, auctor purus. Duis eu orci et sem pharetra bibendum. Vestibulum commodo sem faucibus auctor suscipit. Quisque tincidunt metus sit amet enim viverra condimentum. Aliquam at odio molestie, elementum tellus a, condimentum nisl. In fermentum, nisl sit amet laoreet maximus, tellus felis maximus justo, at lacinia augue urna vel lectus. In venenatis sem in fringilla lobortis. Duis mattis turpis id pulvinar mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam a molestie tellus. Maecenas volutpat est quis lacus efficitur rhoncus. Vivamus efficitur odio a nisi mollis fringilla. Phasellus ultricies leo ac libero finibus rutrum. Integer imperdiet sapien vitae purus mollis, non lacinia ante congue.'),
(3, '2015-05-19', 'Amarillo', 'Hoy estamos probando a ver cómo se hacen las inserciones en la base de datos y si se meten datos duplicados.<br />\r\n<br />\r\nLos saltos de línea y las palabras acentuadas o con eñe ya están probadas anteriormente y se sabe que funcionan perfectamente.<br />\r\n'),
(4, '2015-06-21', 'Amarillo', 'Hoy publicaremos que queremos probar el tema de los email difundidos.'),
(5, '2015-06-21', 'Amarillo', 'Hoy publicaremos que queremos probar el tema de los email difundidos.'),
(6, '2015-06-21', 'Amarillo', 'Hoy publicaremos que queremos probar el tema de los email difundidos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` int(10) unsigned NOT NULL,
  `id_noticia` int(10) unsigned NOT NULL,
  `ruta` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

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
(57, 54, 'C:/xampp/htdocs/Guarderia/imagenes/Cursos/portada1.PNG'),
(58, 55, 'C:/xampp/htdocs/Guarderia/imagenes/Menus/febrero_2015.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titular`, `cuerpo`, `tipo`, `privilegios`, `fecha`) VALUES
(47, 'Carnaval ', 'Noticia con varias imágenes de carnaval para probar que se acoplan bien.', 'NOV', 'PUBLICO', '2015-02-11'),
(50, 'Menu Octubre', 'Aquí os dejamos el menú que nuestro equipo de nutricionistas ha preparado para el mes de Octubre de 2012', 'COM', 'PUBLICO', '2015-02-12'),
(51, 'Noticia Privada', 'Este será el cuerpo de la noticia privada con la que vamos a probar que se hace la consulta bien.<br />\r\n<br />\r\nEsta noticia debe aparecer unicamente para usuarios registrados.', 'NOV', 'PRIVADO', '2015-02-13'),
(52, 'Curso de Test', 'Aquí se introduce el cuerpo de la noticia para comprobar que funciona todo bien.<br />\r\n<br />\r\nProbamos con saltos de línea y palabras acentuadas.<br />\r\n<br />\r\nMás saltos de línea para tener varios párrafos.<br />\r\n<br />\r\nPara terminar pegamos un párrafo con lorem ipsum para dar grosor al cuerpo:<br />\r\n"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eleifend semper tortor ut blandit. Donec aliquam, arcu quis posuere pretium, leo tellus mollis massa, non mattis urna magna efficitur tellus. Duis elementum ac odio sit amet dignissim. Fusce consequat hendrerit finibus. Donec tempor vehicula iaculis. Praesent blandit ante a est lobortis, eget sollicitudin erat consequat. Pellentesque erat neque, imperdiet a sem nec, lacinia pretium nisl. Proin odio nibh, iaculis quis justo quis, lacinia tristique nisi. Phasellus a suscipit tellus, id ultrices ligula. Vestibulum id bibendum odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus egestas, neque vel faucibus malesuada, leo metus tincidunt nisi, ut imperdiet felis nisi ac lectus. Maecenas sollicitudin vitae eros in dictum. Suspendisse lorem tellus, dictum semper leo non, sagittis lobortis purus. Suspendisse feugiat convallis commodo. Mauris feugiat aliquet urna vel dictum".', 'CUR', 'PUBLICO', '2015-03-06'),
(54, 'Curso de Profesor Privado', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper et eros at porttitor. Sed vehicula mauris neque, quis tempor enim venenatis vitae. Nullam sapien enim, malesuada in erat eget, dictum pharetra quam. Vestibulum ante massa, pretium at nisi ut, mattis finibus risus. Curabitur laoreet tellus ut blandit commodo. Suspendisse justo diam, cursus sit amet finibus ut, suscipit quis lectus. Praesent dapibus ex sed sem sollicitudin convallis. Pellentesque porta cursus tellus eget imperdiet. Nullam vel gravida justo. Proin ornare libero vitae congue venenatis. Nulla rhoncus mi diam, at cursus nisi ultrices elementum.<br />\r\n<br />\r\nPraesent tincidunt est quis rhoncus dapibus. Fusce aliquet mattis quam, tempor vestibulum dui eleifend sed. Aliquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce mollis a augue sed porta. Aliquam suscipit ac tortor a ullamcorper. Sed ac vehicula urna, et euismod tortor. Ut lacinia leo quis congue ultrices. Fusce ultricies mauris in augue facilisis, ac feugiat ipsum laoreet. Nam eu nisl id arcu maximus egestas sit amet et felis.<br />\r\n<br />\r\nPhasellus venenatis urna lacus. Mauris eget tortor odio. Nam porta leo ipsum, eget tempor mauris vulputate sit amet. Nam risus purus, faucibus ut laoreet et, laoreet vel lorem. Nam id libero id purus posuere volutpat. In hac habitasse platea dictumst. In condimentum malesuada efficitur.', 'CUR', 'PRIVADO', '2015-03-16'),
(55, 'Menú Febrero 2015', 'A continuación se adjunta el menú diseñado por nuestro equipo de nutricionistas para este mes de Febrero.<br />\r\n<br />\r\nEsperamos que sea del agrado de todos.', 'COM', 'PUBLICO', '2015-04-13');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `nickname`, `nombre`, `apellidos`, `email`, `telefono`, `dni`) VALUES
(3, 'alumno', 'Tutor1', 'Ap1', 'axfdghyd@77.cpm', '956777777', '76025369M'),
(4, 'alumno', 'Tutor2', 'Ap2', 'blazedecai@hotmail.com', '702335544', '72456798P'),
(5, 'alumno2', 'Tutor1', 'Apellidos Simples', 'alejandro.melerorodriguez@alum.uca.es', '699885522', '75123456M'),
(6, 'alumno2', 'Tutor2', 'Largos y Compuestos Validos', 'email1234@email.com', '956114477', '49987654N');

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
  `f_nac` date NOT NULL,
  `grupo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `nombre`, `apellidos`, `DNI`, `email`, `rol`, `domicilio`, `f_nac`, `grupo`) VALUES
(10, 'admin', 'Administrador', 'del Sistema', '12345678Z', 'guarderia.bahiablanca@gmail.com', 'ADMIN', 'Calle Tamarindos, 14, Cádiz', '2000-01-01', NULL),
(17, 'profesor', 'Profesor', 'Profesor', '49555888P', 'alemelero12@gmail.com', 'PROF', 'Plaza Céntrica, 17, 2º A, 11005, Cádiz', '1980-05-30', 'Amarillo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_alumno`
--

CREATE TABLE IF NOT EXISTS `usuario_alumno` (
`id` int(10) unsigned NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `rol` enum('ALUM','PROF','ADMIN') NOT NULL DEFAULT 'ALUM',
  `domicilio` text NOT NULL,
  `f_nac` date NOT NULL,
  `grupo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_alumno`
--

INSERT INTO `usuario_alumno` (`id`, `nickname`, `nombre`, `apellidos`, `rol`, `domicilio`, `f_nac`, `grupo`) VALUES
(1, 'alumno', 'Alumno', 'Ap1 Ap2', 'ALUM', 'Avenida de mi casa, 123, 11005, Cádiz', '2013-11-06', 'Rojo'),
(2, 'alumno2', 'Alumno2', 'Apellidos Largos y Compuestos', 'ALUM', 'Ronda Inventada, 7, 3º C, 11100, San Fernando', '2013-09-30', 'Amarillo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datosalum`
--
ALTER TABLE `datosalum`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
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
-- Indices de la tabla `usuario_alumno`
--
ALTER TABLE `usuario_alumno`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `datosalum`
--
ALTER TABLE `datosalum`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuario_alumno`
--
ALTER TABLE `usuario_alumno`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datosalum`
--
ALTER TABLE `datosalum`
ADD CONSTRAINT `datosalum_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `usuario_alumno` (`nickname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `usuario_alumno` (`nickname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
