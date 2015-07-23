-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2015 a las 22:30:17
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `nickname`, `password`) VALUES
(0, 'admin', '124YC6OXr.CGM'),
(1, 'rocio_perez', '12O5C5t2A.vUc'),
(2, 'alejandro_melero', '12KIXLxrdD8og'),
(3, 'pepi.ortega', '1222bRjpxu5Ug'),
(4, 'antionio.perezgarcia', '126vRi.LcSu7Y'),
(5, 'lucia.garcialuque', '12R1FfCM3HO82'),
(6, 'carmen.garcialuque', '1231znLzchPXI'),
(7, 'carlor.medinatur', '12zN.aNmJU.wg'),
(8, 'rosario_floresgonzalez', '12aHh029U0ORI'),
(9, 'marcos_meleroalonso', '12KIXLxrdD8og'),
(10, 'estefania_costabravo', '126bhuNjKSlQQ'),
(11, 'juan.sevillano.uribarri', '12sdQe1ZJ2lMQ'),
(12, 'bea.sanchezsanchez', '12w8.e9De8Cho'),
(13, 'esther.diaz.ortega', '12xl54wcftQwY'),
(14, 'alejandra.peregrinovalle', '12gZTgTFlNpfI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`id` int(255) unsigned NOT NULL,
  `incidencia` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `cuerpo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `incidencia`, `nickname`, `cuerpo`) VALUES
(1, 1, 'marcos_meleroalonso', 'Me parece todo perfecto.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosalum`
--

CREATE TABLE IF NOT EXISTS `datosalum` (
`id` int(255) NOT NULL,
  `nickname` varchar(150) NOT NULL,
  `horario` enum('ESCOLAR','COMEDOR','COMPLETO','MATINAL') NOT NULL,
  `pago` enum('EFECTIVO','DOMICILIACION') NOT NULL,
  `fotos` tinyint(1) NOT NULL,
  `observaciones` text
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosalum`
--

INSERT INTO `datosalum` (`id`, `nickname`, `horario`, `pago`, `fotos`, `observaciones`) VALUES
(1, 'antionio.perezgarcia', 'COMEDOR', 'EFECTIVO', 1, NULL),
(2, 'lucia.garcialuque', 'COMPLETO', 'DOMICILIACION', 1, NULL),
(3, 'carmen.garcialuque', 'COMPLETO', 'DOMICILIACION', 1, NULL),
(4, 'carlor.medinatur', 'ESCOLAR', 'DOMICILIACION', 1, NULL),
(5, 'rosario_floresgonzalez', 'COMEDOR', 'EFECTIVO', 0, NULL),
(6, 'marcos_meleroalonso', 'ESCOLAR', 'DOMICILIACION', 1, NULL),
(7, 'estefania_costabravo', 'COMEDOR', 'EFECTIVO', 0, NULL),
(8, 'juan.sevillano.uribarri', 'ESCOLAR', 'EFECTIVO', 1, NULL),
(9, 'bea.sanchezsanchez', 'COMEDOR', 'EFECTIVO', 0, NULL),
(10, 'esther.diaz.ortega', 'COMEDOR', 'EFECTIVO', 1, NULL),
(11, 'alejandra.peregrinovalle', 'COMPLETO', 'DOMICILIACION', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` int(10) unsigned NOT NULL,
  `id_noticia` int(10) unsigned NOT NULL,
  `ruta` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `id_noticia`, `ruta`) VALUES
(1, 1, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/TALLERES_VERANO.jpg'),
(2, 2, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/038.jpg'),
(3, 2, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/039.jpg'),
(4, 2, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/042.jpg'),
(5, 2, 'C:/xampp/htdocs/Guarderia/imagenes/Novedades/043.jpg'),
(6, 3, 'C:/xampp/htdocs/Guarderia/imagenes/Menus/calendario-febrero.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE IF NOT EXISTS `incidencia` (
`id` int(255) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `grupo` varchar(100) NOT NULL,
  `cuerpo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`id`, `fecha`, `grupo`, `cuerpo`) VALUES
(1, '2015-07-06', 'Amarillo', 'A las 9:00 hemos desayunado todos juntos.<br />\r\n<br />\r\nDesde las 10:00 hasta las 11:30 hemos estudiado los colores.<br />\r\n<br />\r\nDe 11:30 a 13:00 hemos estado jugando en el patio.<br />\r\n<br />\r\nHemos hecho el almuerzo a las 13:00, y después, de 14:00 a 14:30 hemos estado jugando en la clase.<br />\r\n<br />\r\nNos hemos acostado a las 14:30 y hasta las 16:30 para la siesta.<br />\r\n<br />\r\n');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titular`, `cuerpo`, `tipo`, `privilegios`, `fecha`) VALUES
(1, 'Escuela de Verano', 'Este año tenemos muchos y nuevos talleres durante todo el Verano donde lo pasaremos muy bien.<br />\r\n<br />\r\n¡RESERVA YA TU PLAZA!', 'NOV', 'PUBLICO', '2015-07-06'),
(2, 'Huerto Infantil', 'Ya tenemos nuestro pequeño HUERTO INFANTIL en la Guardería Bahía Blanca, que preparamos con nuestros/as niños/as.<br />\r\n<br />\r\n¡MIRAR QUE BONITO HA QUEDADO!.<br />\r\n<br />\r\nAhora los peques lo cuidarán y verán con ilusión como crecen sus plantas.', 'NOV', 'PRIVADO', '2015-07-06'),
(3, 'Menú Febrero de 2015', 'A continuación os presentamos el menú que seguirá la guardería en el mes de Febrero.<br />\r\n<br />\r\n¡BUEN PROVECHO!', 'COM', 'PUBLICO', '2015-07-06');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `nickname`, `nombre`, `apellidos`, `email`, `telefono`, `dni`) VALUES
(1, 'antionio.perezgarcia', 'Antonio', 'Pérez Fernández', 'antonio.perezf@dominio.com', '685421346', '75489618L'),
(2, 'antionio.perezgarcia', 'Dolores', 'García Montes', 'loli.gm@dominio.com', '704668521', '76333152N'),
(3, 'lucia.garcialuque', 'Manuel', 'García Fernández', 'm.garcia@dminio.com', '699145783', '49128756H'),
(4, 'lucia.garcialuque', 'Rosario', 'Luque Huerto', 'rosalhuerto@dominio.com', '956284369', '47564689R'),
(5, 'carmen.garcialuque', 'Manuel', 'García Fernández', 'm.garcia@dminio.com', '699145783', '49128756H'),
(6, 'carmen.garcialuque', 'Rosario', 'Luque Huerto', 'rosalhuerto@dominio.com', '956284369', '47564689R'),
(7, 'carlor.medinatur', 'Ernesto', 'Medina Sevilla', 'ernestomedi@dominio.com', '956247859', '49078516G'),
(8, 'carlor.medinatur', 'Manuela', 'Tur Lopez', 'nela.tl@dominio.com', '634851624', '76219357J'),
(9, 'rosario_floresgonzalez', 'Francisco', 'Flores Benítez', 'paco.floresbeni@dominio.com', '673145976', '42036725T'),
(10, 'rosario_floresgonzalez', 'Rosario', 'González González', 'charo.gg@dominio.com', '856806472', '30598621P'),
(11, 'marcos_meleroalonso', 'Alejandro', 'Melero Rodriguez', 'alejandro.melerorodriguez@alum.uca.es', '699227481', '76089756S'),
(12, 'marcos_meleroalonso', 'Nuria', 'Alonso Roldán', 'n.alonso@dominio.com', '956741235', '35649812P'),
(13, 'estefania_costabravo', 'Juan', 'Costa Martín', 'juanillo.cm@dominio.com', '956274596', '76894561M'),
(14, 'estefania_costabravo', 'Carmen', 'Bravo Sorolla', 'c.bsorolla@dominio.com', '956274596', '49794638F'),
(15, 'juan.sevillano.uribarri', 'Manuel', 'Sevillano Jerez', 'lolo.sj@dominio.com', '632587495', '65894712V'),
(16, 'juan.sevillano.uribarri', 'Edurne', 'Uribarri López', 'edurne.ul@dominio.com', '657814923', '58749651M'),
(17, 'bea.sanchezsanchez', 'Raul', 'Sánchez González', 'raul.sangon@dominio.com', '856941374', '35489617K'),
(18, 'bea.sanchezsanchez', 'Rosario', 'Sánchez Chacón', 'rosario.sanchez@dominio.com', '64285913', '36984571O'),
(19, 'esther.diaz.ortega', 'Antonio', 'Díaz Alias', 'toni.dial@dominio.com', '956202051', '65847956L'),
(20, 'esther.diaz.ortega', 'Carmen', 'Ortega Pérez', 'c.ortega@dominio.com', '666154879', '454897612'),
(21, 'alejandra.peregrinovalle', 'Luis', 'Peregrino Suárez', 'luiti.psuarez@dominio.com', '665379468', '58496271G'),
(22, 'alejandra.peregrinovalle', 'Sandra', 'Valle Fuertes', 'sandra.valle@dominio.com', '956374586', '61458732B');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `nombre`, `apellidos`, `DNI`, `email`, `rol`, `domicilio`, `f_nac`, `grupo`) VALUES
(0, 'admin', 'Administrador', 'del Sistema', '12345678Z', 'guarderia.bahiablanca@gmail.com', 'ADMIN', 'Calle Tamarindos, 14, Cádiz', '2000-01-01', NULL),
(1, 'rocio_perez', 'Rocío', 'Pérez Fernandez', '74895623K', 'rocio.perez@dominio.com', 'PROF', 'Paseo Marítimo, Edificio Atlántico 2, G, 2º C, Cádiz', '1978-03-09', 'Rojo'),
(2, 'alejandro_melero', 'Alejandro', 'Melero Rodriguez', '76089756S', 'alejandro.melerorodriguez@alum.uca.es', 'PROF', 'Avenida Puente Zuazo, 93, San Fernando', '1991-05-24', 'Amarillo'),
(3, 'pepi.ortega', 'Josefa', 'Ortega Benítez', '76845127J', 'pepi.ortega@dominio.com', 'PROF', 'Calle Fermín Salvochea, 12, Cádiz', '1984-07-07', 'Verde');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_alumno`
--

INSERT INTO `usuario_alumno` (`id`, `nickname`, `nombre`, `apellidos`, `rol`, `domicilio`, `f_nac`, `grupo`) VALUES
(1, 'antionio.perezgarcia', 'Antonio', 'Pérez García', 'ALUM', 'Calle Tamarindos 20, 5º A', '2014-04-15', 'Rojo'),
(2, 'lucia.garcialuque', 'Lucía', 'García Luque', 'ALUM', 'Calle Santísimo Cristo de las Aguas 8, Bajo E, Cádiz', '2014-01-03', 'Rojo'),
(3, 'carmen.garcialuque', 'Carmen', 'García Luque', 'ALUM', 'Calle Santísimo Cristo de las Aguas 8, Bajo E, Cádiz', '2014-01-03', 'Rojo'),
(4, 'carlor.medinatur', 'Carlos', 'Medina Tur', 'ALUM', 'Calle Ejército de África 5, 3º B, Cádiz', '2014-07-22', 'Rojo'),
(5, 'rosario_floresgonzalez', 'Rosario', 'Flores González', 'ALUM', 'Avenida de la Constitución 9, 7º A, San Fernando', '2014-10-06', 'Rojo'),
(6, 'marcos_meleroalonso', 'Marcos', 'Melero Alonso', 'ALUM', 'Avenida Puente Zuazo, 93, San Fernando', '2012-09-14', 'Amarillo'),
(7, 'estefania_costabravo', 'Estefanía', 'Costa Bravo', 'ALUM', 'Calle Sorolla 18, 1º C, Cádiz', '2012-02-21', 'Amarillo'),
(8, 'juan.sevillano.uribarri', 'Juan', 'Sevillano Uribarri', 'ALUM', 'Avenida de Argentina 63, 2º F, Puerto Real', '2012-11-10', 'Amarillo'),
(9, 'bea.sanchezsanchez', 'Beatríz', 'Sánchez Sánchez', 'ALUM', 'Avenida de Andalucía 68, 1º B', '2012-10-08', 'Amarillo'),
(10, 'esther.diaz.ortega', 'Esther', 'Díaz Ortega', 'ALUM', 'Plaza San Antonio 13, 1º, Cádiz', '2012-12-12', 'Amarillo'),
(11, 'alejandra.peregrinovalle', 'Alejandra', 'Peregrino Valle', 'ALUM', 'Plaza de la Estación 1, 3º D, Jerez de la Frontera', '2013-09-05', 'Verde');

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
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `datosalum`
--
ALTER TABLE `datosalum`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario_alumno`
--
ALTER TABLE `usuario_alumno`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
