-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-09-2012 a las 17:14:21
-- Versión del servidor: 5.5.24
-- Versión de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `luiggi_mmm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_categoria`
--

CREATE TABLE IF NOT EXISTS `app_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_categoria_56ae2a2a` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `app_categoria`
--

INSERT INTO `app_categoria` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `nombre`, `slug`, `position`) VALUES
(1, 1, '2012-09-27 15:22:40', '2012-09-27 15:22:40', 0, 0, 'regalos', 'regalos', 1),
(2, 1, '2012-09-27 15:22:56', '2012-09-27 15:22:56', 0, 0, 'favoritos del mes', 'favoritos-del-mes', 1),
(3, 1, '2012-09-27 15:23:08', '2012-09-27 15:23:08', 0, 0, 'regalos express', 'regalos-express', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_coleccion`
--

CREATE TABLE IF NOT EXISTS `app_coleccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `grupo_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `video` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_coleccion_15fb1ffa` (`grupo_id`),
  KEY `app_coleccion_6682136` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `app_coleccion`
--

INSERT INTO `app_coleccion` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `grupo_id`, `image_id`, `video`) VALUES
(1, 1, '2012-09-27 14:52:33', '2012-09-27 14:52:33', 0, 0, 1, 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_coleccionbanner`
--

CREATE TABLE IF NOT EXISTS `app_coleccionbanner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coleccion_id` int(11) DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_coleccionbanner_55250c4` (`coleccion_id`),
  KEY `app_coleccionbanner_6682136` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_coleccionenlace`
--

CREATE TABLE IF NOT EXISTS `app_coleccionenlace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `coleccion_id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `position` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_coleccionenlace_55250c4` (`coleccion_id`),
  KEY `app_coleccionenlace_56ae2a2a` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_consejo`
--

CREATE TABLE IF NOT EXISTS `app_consejo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `descrip` longtext NOT NULL,
  `image_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_consejo_6682136` (`image_id`),
  KEY `app_consejo_56ae2a2a` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_grupo`
--

CREATE TABLE IF NOT EXISTS `app_grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `descrip` longtext NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `nav_1` tinyint(1) NOT NULL,
  `nav_2` tinyint(1) NOT NULL,
  `nav_3` tinyint(1) NOT NULL,
  `nav_4` tinyint(1) NOT NULL,
  `nav_5` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_grupo_6682136` (`image_id`),
  KEY `app_grupo_56ae2a2a` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `app_grupo`
--

INSERT INTO `app_grupo` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `nombre`, `descrip`, `image_id`, `slug`, `nav_1`, `nav_2`, `nav_3`, `nav_4`, `nav_5`, `position`) VALUES
(1, 1, '2012-09-27 13:01:33', '2012-09-27 13:07:24', 0, 0, 'bebé', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero. Donec gravida euismod elit. Sed rhoncus. Vivamus nibh magna, scelerisque id, tempus in, auctor non, ipsum. Vivamus vitae metus id elit consectetuer vestibulum.</p>\r\n<p>Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 3, 'bebe', 1, 1, 1, 1, 1, 1),
(2, 1, '2012-09-27 13:01:39', '2012-09-27 14:55:05', 0, 0, 'mamá', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero. Donec gravida euismod elit. Sed rhoncus. Vivamus nibh magna, scelerisque id, tempus in, auctor non, ipsum. Vivamus vitae metus id elit consectetuer vestibulum.</p>\r\n<p>Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', NULL, 'mama', 1, 1, 1, 1, 1, 1),
(3, 1, '2012-09-27 13:01:44', '2012-09-27 14:55:30', 0, 0, 'deco', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero. Donec gravida euismod elit. Sed rhoncus. Vivamus nibh magna, scelerisque id, tempus in, auctor non, ipsum. Vivamus vitae metus id elit consectetuer vestibulum.</p>\r\n<p>Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', NULL, 'deco', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_grupobanner`
--

CREATE TABLE IF NOT EXISTS `app_grupobanner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_grupobanner_15fb1ffa` (`grupo_id`),
  KEY `app_grupobanner_6682136` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `app_grupobanner`
--

INSERT INTO `app_grupobanner` (`id`, `grupo_id`, `image_id`, `enlace`, `position`) VALUES
(1, 1, 2, '', 1),
(2, 1, 2, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_infosite`
--

CREATE TABLE IF NOT EXISTS `app_infosite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `site` varchar(60) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `pinterest` varchar(200) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `description` longtext NOT NULL,
  `ga` varchar(12) NOT NULL,
  `coordenadas` varchar(48) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_multimedia`
--

CREATE TABLE IF NOT EXISTS `app_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `app_multimedia`
--

INSERT INTO `app_multimedia` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `nombre`, `imagen`) VALUES
(1, 1, '2012-09-27 12:49:45', '2012-09-27 12:49:45', 0, 0, 'Home - Slide 1', 'multimedia/home1.jpg'),
(2, 1, '2012-09-27 13:04:42', '2012-09-27 13:04:42', 0, 0, 'Interno - slider - bebe', 'multimedia/slide1.jpg'),
(3, 1, '2012-09-27 13:06:01', '2012-09-27 13:06:01', 0, 0, 'Interno - Lateral', 'multimedia/img-bbs.jpg'),
(4, 1, '2012-09-27 14:51:05', '2012-09-27 14:51:05', 0, 0, 'tendencia', 'multimedia/img-tendencia-bg.jpg'),
(5, 1, '2012-09-27 14:51:26', '2012-09-27 14:51:26', 0, 0, 'coleccion', 'multimedia/img-seccion.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_noticia`
--

CREATE TABLE IF NOT EXISTS `app_noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `descrip` longtext NOT NULL,
  `image_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_noticia_6682136` (`image_id`),
  KEY `app_noticia_56ae2a2a` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_prensa`
--

CREATE TABLE IF NOT EXISTS `app_prensa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `image_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_prensa_6682136` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_productos`
--

CREATE TABLE IF NOT EXISTS `app_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `codigo` varchar(120) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `descrip` longtext NOT NULL,
  `image_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_productos_64c3c188` (`categoria_id`),
  KEY `app_productos_15fb1ffa` (`grupo_id`),
  KEY `app_productos_6682136` (`image_id`),
  KEY `app_productos_56ae2a2a` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `app_productos`
--

INSERT INTO `app_productos` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `categoria_id`, `grupo_id`, `nombre`, `codigo`, `precio`, `descrip`, `image_id`, `slug`, `position`) VALUES
(1, 1, '2012-09-27 16:47:15', '2012-09-27 17:03:48', 0, 0, 1, 1, 'bebédfsfds', 'CWLI1201', 12.25, '', 1, 'hola-mundo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_promocion`
--

CREATE TABLE IF NOT EXISTS `app_promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `grupo_id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descrip` longtext NOT NULL,
  `image_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_promocion_15fb1ffa` (`grupo_id`),
  KEY `app_promocion_6682136` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_seccion`
--

CREATE TABLE IF NOT EXISTS `app_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `subtitulo` varchar(120) NOT NULL,
  `nick` varchar(120) NOT NULL,
  `enlace` varchar(240) NOT NULL,
  `descrip` longtext NOT NULL,
  `position` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_seccion_7c8501cd` (`padre_id`),
  KEY `app_seccion_56ae2a2a` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `app_seccion`
--

INSERT INTO `app_seccion` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `nombre`, `subtitulo`, `nick`, `enlace`, `descrip`, `position`, `padre_id`, `slug`) VALUES
(1, 1, '2012-09-27 12:50:27', '2012-09-27 12:52:46', 0, 0, 'Home', '', 'home', '', '', 1, NULL, 'home'),
(2, 1, '2012-09-27 13:09:23', '2012-09-27 13:09:23', 0, 0, 'Lista baby shower', '', '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero.</p>\r\n<p>Etiam augue. Ut velit urna, porta a, commodo vitae, blandit vitae, odio. Ut mi arcu, placerat eu, imperdiet non, molestie quis, elit. Phasellus ligula ipsum, venenatis sit amet, feugiat eget, blandit aliquam, risus. Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 1, NULL, 'lista-baby-shower'),
(3, 1, '2012-09-27 13:10:06', '2012-09-27 13:10:06', 0, 0, 'nosotros', '', '', '', '', 1, NULL, 'nosotros'),
(4, 1, '2012-09-27 13:10:54', '2012-09-27 13:10:54', 0, 0, 'La historia', '', '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero.</p>\r\n<p>Etiam augue. Ut velit urna, porta a, commodo vitae, blandit vitae, odio. Ut mi arcu, placerat eu, imperdiet non, molestie quis, elit. Phasellus ligula ipsum, venenatis sit amet, feugiat eget, blandit aliquam, risus. Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 1, 3, 'la-historia'),
(5, 1, '2012-09-27 13:11:20', '2012-09-27 13:11:20', 0, 0, 'misión', '', '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero.</p>\r\n<p>Etiam augue. Ut velit urna, porta a, commodo vitae, blandit vitae, odio. Ut mi arcu, placerat eu, imperdiet non, molestie quis, elit. Phasellus ligula ipsum, venenatis sit amet, feugiat eget, blandit aliquam, risus. Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 1, 3, 'mision'),
(6, 1, '2012-09-27 13:11:40', '2012-09-27 13:11:40', 0, 0, 'visión', '', '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero.</p>\r\n<p>Etiam augue. Ut velit urna, porta a, commodo vitae, blandit vitae, odio. Ut mi arcu, placerat eu, imperdiet non, molestie quis, elit. Phasellus ligula ipsum, venenatis sit amet, feugiat eget, blandit aliquam, risus. Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 1, 3, 'vision'),
(7, 1, '2012-09-27 13:11:55', '2012-09-27 13:11:55', 0, 0, 'valores', '', '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus. Vivamus eget purus. Quisque nulla. Proin nonummy elit nec erat. Suspendisse molestie, orci sed molestie congue, erat pede consectetuer tellus, non ultricies turpis purus eget lorem. Fusce ut libero.</p>\r\n<p>Etiam augue. Ut velit urna, porta a, commodo vitae, blandit vitae, odio. Ut mi arcu, placerat eu, imperdiet non, molestie quis, elit. Phasellus ligula ipsum, venenatis sit amet, feugiat eget, blandit aliquam, risus. Donec mollis.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi eu tortor vel neque congue congue. Mauris quis erat. Vestibulum dictum ligula vel purus.</p>', 1, 3, 'valores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_seccionbanner`
--

CREATE TABLE IF NOT EXISTS `app_seccionbanner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion_id` int(11) DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_seccionbanner_3a4655fd` (`seccion_id`),
  KEY `app_seccionbanner_6682136` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `app_seccionbanner`
--

INSERT INTO `app_seccionbanner` (`id`, `seccion_id`, `image_id`, `enlace`, `position`) VALUES
(1, 1, 1, '', 1),
(2, 1, 1, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_tendencia`
--

CREATE TABLE IF NOT EXISTS `app_tendencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `grupo_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_tendencia_15fb1ffa` (`grupo_id`),
  KEY `app_tendencia_6682136` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `app_tendencia`
--

INSERT INTO `app_tendencia` (`id`, `active`, `created`, `modified`, `created_by`, `modified_by`, `grupo_id`, `image_id`) VALUES
(1, 1, '2012-09-27 14:51:47', '2012-09-27 14:51:47', 0, 0, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_tendenciaenlace`
--

CREATE TABLE IF NOT EXISTS `app_tendenciaenlace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `tendencia_id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `image_id` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `position` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_tendenciaenlace_a9d3922` (`tendencia_id`),
  KEY `app_tendenciaenlace_6682136` (`image_id`),
  KEY `app_tendenciaenlace_56ae2a2a` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_userprofile`
--

CREATE TABLE IF NOT EXISTS `app_userprofile` (
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `ap_pat` varchar(80) NOT NULL,
  `ap_mat` varchar(80) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_group`
--

CREATE TABLE IF NOT EXISTS `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_group_permissions`
--

CREATE TABLE IF NOT EXISTS `auth_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`permission_id`),
  KEY `auth_group_permissions_425ae3c4` (`group_id`),
  KEY `auth_group_permissions_1e014c8f` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_message`
--

CREATE TABLE IF NOT EXISTS `auth_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_message_403f60f` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_permission`
--

CREATE TABLE IF NOT EXISTS `auth_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_type_id` (`content_type_id`,`codename`),
  KEY `auth_permission_1bb8f392` (`content_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Volcado de datos para la tabla `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `name`, `content_type_id`, `codename`) VALUES
(1, 'Can add permission', 1, 'add_permission'),
(2, 'Can change permission', 1, 'change_permission'),
(3, 'Can delete permission', 1, 'delete_permission'),
(4, 'Can add group', 2, 'add_group'),
(5, 'Can change group', 2, 'change_group'),
(6, 'Can delete group', 2, 'delete_group'),
(7, 'Can add user', 3, 'add_user'),
(8, 'Can change user', 3, 'change_user'),
(9, 'Can delete user', 3, 'delete_user'),
(13, 'Can add content type', 5, 'add_contenttype'),
(14, 'Can change content type', 5, 'change_contenttype'),
(15, 'Can delete content type', 5, 'delete_contenttype'),
(16, 'Can add session', 6, 'add_session'),
(17, 'Can change session', 6, 'change_session'),
(18, 'Can delete session', 6, 'delete_session'),
(19, 'Can add log entry', 7, 'add_logentry'),
(20, 'Can change log entry', 7, 'change_logentry'),
(21, 'Can delete log entry', 7, 'delete_logentry'),
(22, 'Can add Multimedia', 8, 'add_multimedia'),
(23, 'Can change Multimedia', 8, 'change_multimedia'),
(24, 'Can delete Multimedia', 8, 'delete_multimedia'),
(25, 'Can add Seccion', 9, 'add_seccion'),
(26, 'Can change Seccion', 9, 'change_seccion'),
(27, 'Can delete Seccion', 9, 'delete_seccion'),
(28, 'Can add Banner de Seccion', 10, 'add_seccionbanner'),
(29, 'Can change Banner de Seccion', 10, 'change_seccionbanner'),
(30, 'Can delete Banner de Seccion', 10, 'delete_seccionbanner'),
(31, 'Can add info site', 11, 'add_infosite'),
(32, 'Can change info site', 11, 'change_infosite'),
(33, 'Can delete info site', 11, 'delete_infosite'),
(34, 'Can add user profile', 12, 'add_userprofile'),
(35, 'Can change user profile', 12, 'change_userprofile'),
(36, 'Can delete user profile', 12, 'delete_userprofile'),
(40, 'Can add Banner de Grupo', 14, 'add_grupobanner'),
(41, 'Can change Banner de Grupo', 14, 'change_grupobanner'),
(42, 'Can delete Banner de Grupo', 14, 'delete_grupobanner'),
(43, 'Can add Seccion', 15, 'add_categoria'),
(44, 'Can change Seccion', 15, 'change_categoria'),
(45, 'Can delete Seccion', 15, 'delete_categoria'),
(46, 'Can add Seccion', 16, 'add_productos'),
(47, 'Can change Seccion', 16, 'change_productos'),
(48, 'Can delete Seccion', 16, 'delete_productos'),
(49, 'Can add migration history', 21, 'add_migrationhistory'),
(50, 'Can change migration history', 21, 'change_migrationhistory'),
(51, 'Can delete migration history', 21, 'delete_migrationhistory'),
(52, 'Can add Grupo', 22, 'add_grupo'),
(53, 'Can change Grupo', 22, 'change_grupo'),
(54, 'Can delete Grupo', 22, 'delete_grupo'),
(55, 'Can add Tendencia', 18, 'add_tendencia'),
(56, 'Can change Tendencia', 18, 'change_tendencia'),
(57, 'Can delete Tendencia', 18, 'delete_tendencia'),
(58, 'Can add Enlace Tendencia', 23, 'add_tendenciaenlace'),
(59, 'Can change Enlace Tendencia', 23, 'change_tendenciaenlace'),
(60, 'Can delete Enlace Tendencia', 23, 'delete_tendenciaenlace'),
(61, 'Can add Coleccion', 19, 'add_coleccion'),
(62, 'Can change Coleccion', 19, 'change_coleccion'),
(63, 'Can delete Coleccion', 19, 'delete_coleccion'),
(64, 'Can add Enlace Coleccion', 24, 'add_coleccionenlace'),
(65, 'Can change Enlace Coleccion', 24, 'change_coleccionenlace'),
(66, 'Can delete Enlace Coleccion', 24, 'delete_coleccionenlace'),
(67, 'Can add Banner de coleccion', 25, 'add_coleccionbanner'),
(68, 'Can change Banner de coleccion', 25, 'change_coleccionbanner'),
(69, 'Can delete Banner de coleccion', 25, 'delete_coleccionbanner'),
(70, 'Can add Promocion', 26, 'add_promocion'),
(71, 'Can change Promocion', 26, 'change_promocion'),
(72, 'Can delete Promocion', 26, 'delete_promocion'),
(73, 'Can add Noticia', 27, 'add_noticia'),
(74, 'Can change Noticia', 27, 'change_noticia'),
(75, 'Can delete Noticia', 27, 'delete_noticia'),
(76, 'Can add Consejo', 20, 'add_consejo'),
(77, 'Can change Consejo', 20, 'change_consejo'),
(78, 'Can delete Consejo', 20, 'delete_consejo'),
(79, 'Can add Prensa', 28, 'add_prensa'),
(80, 'Can change Prensa', 28, 'change_prensa'),
(81, 'Can delete Prensa', 28, 'delete_prensa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_user`
--

CREATE TABLE IF NOT EXISTS `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `auth_user`
--

INSERT INTO `auth_user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `is_staff`, `is_active`, `is_superuser`, `last_login`, `date_joined`) VALUES
(1, 'admin', '', '', 'rbaltazarc@gmail.com', 'pbkdf2_sha256$10000$nFtmvHsqxyHC$bqUopS4fdoGTJqptEc2FS8OqRx8G1T7gRw654QjlqVk=', 1, 1, 1, '2012-09-26 12:44:47', '2012-09-19 17:23:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_user_groups`
--

CREATE TABLE IF NOT EXISTS `auth_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`),
  KEY `auth_user_groups_403f60f` (`user_id`),
  KEY `auth_user_groups_425ae3c4` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_user_user_permissions`
--

CREATE TABLE IF NOT EXISTS `auth_user_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`permission_id`),
  KEY `auth_user_user_permissions_403f60f` (`user_id`),
  KEY `auth_user_user_permissions_1e014c8f` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_admin_log`
--

CREATE TABLE IF NOT EXISTS `django_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `object_id` longtext,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) unsigned NOT NULL,
  `change_message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `django_admin_log_403f60f` (`user_id`),
  KEY `django_admin_log_1bb8f392` (`content_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `django_admin_log`
--

INSERT INTO `django_admin_log` (`id`, `action_time`, `user_id`, `content_type_id`, `object_id`, `object_repr`, `action_flag`, `change_message`) VALUES
(1, '2012-09-19 17:51:53', 1, 9, '1', 'Home', 1, ''),
(2, '2012-09-19 17:51:53', 1, 9, '5', 'Home', 1, ''),
(3, '2012-09-19 17:52:32', 1, 9, '1', 'home', 1, ''),
(4, '2012-09-19 17:52:32', 1, 9, '2', 'home', 1, ''),
(5, '2012-09-19 17:53:21', 1, 9, '3', 'dfgdfgfg', 1, ''),
(6, '2012-09-19 17:53:21', 1, 9, '4', 'dfgdfgfg', 1, ''),
(7, '2012-09-19 17:55:24', 1, 9, '5', 'dfgdfgfg', 1, ''),
(8, '2012-09-19 17:55:24', 1, 9, '6', 'dfgdfgfg', 1, ''),
(9, '2012-09-19 17:55:32', 1, 9, '7', 'sdfsdfsdfd', 1, ''),
(10, '2012-09-19 17:55:32', 1, 9, '8', 'sdfsdfsdfd', 1, ''),
(11, '2012-09-19 17:56:14', 1, 9, '9', 'asdasd', 1, ''),
(12, '2012-09-19 17:56:51', 1, 9, '10', 'fgdfgdfg', 1, ''),
(13, '2012-09-19 17:57:36', 1, 9, '1', 'HOME', 1, ''),
(26, '2012-09-20 16:51:22', 1, 8, '1', ' slider 1 -> multimedia/slide1.jpg', 1, ''),
(29, '2012-09-20 16:55:33', 1, 8, '2', ' lateral bebe -> multimedia/img-bbs.jpg', 1, ''),
(36, '2012-09-26 17:03:39', 1, 8, '3', ' bebé -> multimedia/Wallpapers-HD-fondos-de-pantalla-espacio_2.jpg', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_content_type`
--

CREATE TABLE IF NOT EXISTS `django_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_label` (`app_label`,`model`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `django_content_type`
--

INSERT INTO `django_content_type` (`id`, `name`, `app_label`, `model`) VALUES
(1, 'permission', 'auth', 'permission'),
(2, 'group', 'auth', 'group'),
(3, 'user', 'auth', 'user'),
(5, 'content type', 'contenttypes', 'contenttype'),
(6, 'session', 'sessions', 'session'),
(7, 'log entry', 'admin', 'logentry'),
(8, 'Multimedia', 'app', 'multimedia'),
(9, 'Seccion', 'app', 'seccion'),
(10, 'Banner de Seccion', 'app', 'seccionbanner'),
(11, 'info site', 'app', 'infosite'),
(12, 'user profile', 'app', 'userprofile'),
(14, 'Banner de Grupo', 'app', 'grupobanner'),
(15, 'Seccion', 'app', 'categoria'),
(16, 'Seccion', 'app', 'productos'),
(18, 'Tendencia', 'app', 'tendencia'),
(19, 'Coleccion', 'app', 'coleccion'),
(20, 'Consejo', 'app', 'consejo'),
(21, 'migration history', 'south', 'migrationhistory'),
(22, 'Grupo', 'app', 'grupo'),
(23, 'Enlace Tendencia', 'app', 'tendenciaenlace'),
(24, 'Enlace Coleccion', 'app', 'coleccionenlace'),
(25, 'Banner de coleccion', 'app', 'coleccionbanner'),
(26, 'Promocion', 'app', 'promocion'),
(27, 'Noticia', 'app', 'noticia'),
(28, 'Prensa', 'app', 'prensa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_session`
--

CREATE TABLE IF NOT EXISTS `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime NOT NULL,
  PRIMARY KEY (`session_key`),
  KEY `django_session_3da3d3d8` (`expire_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `django_session`
--

INSERT INTO `django_session` (`session_key`, `session_data`, `expire_date`) VALUES
('1d16b3dd4e2491d8dd998639da5e2602', 'NzQ4OWVkZjA1YmNkZWFlNjlmNzE4ZWQ3YzgwOWIzMjUzOTY0NjQ3ODqAAn1xAShVEl9hdXRoX3Vz\nZXJfYmFja2VuZHECVSlkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZHED\nVQ1fYXV0aF91c2VyX2lkcQSKAQF1Lg==\n', '2012-10-03 17:26:31'),
('232f9cec8dcc090ac07f87131852fce8', 'MzVkNGFlMmY2Y2Y5NzE1MDIxMjM3Y2FiYTk1YTdkZjQyZTM5NDBhZTqAAn1xAShVEl9hdXRoX3Vz\nZXJfYmFja2VuZHECVSlkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZHED\nVQ1fYXV0aF91c2VyX2lkcQSKAQF1Lg==\n', '2012-10-10 12:44:47'),
('427f432e3bb9f79a9fe80dc82d61c113', 'MzVkNGFlMmY2Y2Y5NzE1MDIxMjM3Y2FiYTk1YTdkZjQyZTM5NDBhZTqAAn1xAShVEl9hdXRoX3Vz\nZXJfYmFja2VuZHECVSlkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZHED\nVQ1fYXV0aF91c2VyX2lkcQSKAQF1Lg==\n', '2012-10-04 15:45:06'),
('5d97c96a44356b46b3441524a9b6a549', 'ODg3N2Y3YzdkZDEzNzIzOWJiZDc5YWRjOTVkMDA4NzI5NGI3YjI0NjqAAn1xAVUKdGVzdGNvb2tp\nZVUGd29ya2VkcQJzLg==\n', '2012-10-10 11:07:48'),
('74db898db3f87a19a83d69b657ffbbdc', 'MzVkNGFlMmY2Y2Y5NzE1MDIxMjM3Y2FiYTk1YTdkZjQyZTM5NDBhZTqAAn1xAShVEl9hdXRoX3Vz\nZXJfYmFja2VuZHECVSlkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZHED\nVQ1fYXV0aF91c2VyX2lkcQSKAQF1Lg==\n', '2012-10-05 14:36:56'),
('c0c75bccb3abf43e596d7d2e75aca88d', 'MzVkNGFlMmY2Y2Y5NzE1MDIxMjM3Y2FiYTk1YTdkZjQyZTM5NDBhZTqAAn1xAShVEl9hdXRoX3Vz\nZXJfYmFja2VuZHECVSlkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZHED\nVQ1fYXV0aF91c2VyX2lkcQSKAQF1Lg==\n', '2012-10-05 13:10:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pb_content_type`
--

CREATE TABLE IF NOT EXISTS `pb_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `name_plural` varchar(120) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_label` (`app_label`,`model`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `pb_content_type`
--

INSERT INTO `pb_content_type` (`id`, `name`, `name_plural`, `app_label`, `model`) VALUES
(1, 'Multimedia', 'Galería Multimedia', 'Contenido', 'multimedia'),
(2, 'Sección', 'Secciones', 'Contenido', 'seccion'),
(3, 'Grupo', 'Grupos', 'Contenido', 'grupo'),
(4, 'Categoría', 'Categorías', 'Contenido', 'categoria'),
(5, 'Producto', 'Productos', 'Contenido', 'productos'),
(6, 'Tendencia', 'Tendencias', 'Contenido', 'tendencia'),
(7, 'Banner Grupo', 'Banners Grupo', 'Banner', 'grupobanner'),
(8, 'Banner Coleccion', 'Banners Coleccion', 'Banner', 'coleccionbanner'),
(9, 'Banner Seccion', 'Banners Seccion', 'Banner', 'seccionbanner'),
(10, 'Enlace Coleccion', 'Enlaces Coleccion', 'Enlaces', 'coleccionenlace'),
(11, 'Enlace Tendencia', 'Enlaces Tendencia', 'Enlaces', 'tendenciaenlace'),
(12, 'Noticia', 'Noticias', 'Contenido', 'noticia'),
(13, 'Consejo', 'Consejos', 'Contenido', 'consejo'),
(14, 'Colección', 'Colecciones', 'Contenido', 'coleccion'),
(15, 'Prensa', 'Prensas', 'Contenido', 'prensa'),
(16, 'Promoción', 'Promociones', 'Contenido', 'promocion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pb_permission`
--

CREATE TABLE IF NOT EXISTS `pb_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_type_id` (`content_type_id`,`codename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pb_session`
--

CREATE TABLE IF NOT EXISTS `pb_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime NOT NULL,
  PRIMARY KEY (`session_key`),
  KEY `django_session_c25c2c28` (`expire_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pb_user`
--

CREATE TABLE IF NOT EXISTS `pb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pb_user`
--

INSERT INTO `pb_user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `is_staff`, `is_active`, `is_superuser`, `last_login`, `date_joined`) VALUES
(1, 'admin', 'Roger', 'Cruz Alvarez', 'rbaltazarc@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, '2012-09-05 00:00:00', '2012-09-19 14:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `south_migrationhistory`
--

CREATE TABLE IF NOT EXISTS `south_migrationhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `applied` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `app_coleccion`
--
ALTER TABLE `app_coleccion`
  ADD CONSTRAINT `image_id_refs_id_140b83d6` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`),
  ADD CONSTRAINT `grupo_id_refs_id_2b534db1` FOREIGN KEY (`grupo_id`) REFERENCES `app_grupo` (`id`);

--
-- Filtros para la tabla `app_coleccionbanner`
--
ALTER TABLE `app_coleccionbanner`
  ADD CONSTRAINT `image_id_refs_id_5fdc634e` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`),
  ADD CONSTRAINT `coleccion_id_refs_id_46bf54a3` FOREIGN KEY (`coleccion_id`) REFERENCES `app_coleccionenlace` (`id`);

--
-- Filtros para la tabla `app_coleccionenlace`
--
ALTER TABLE `app_coleccionenlace`
  ADD CONSTRAINT `coleccion_id_refs_id_7dbfe681` FOREIGN KEY (`coleccion_id`) REFERENCES `app_coleccion` (`id`);

--
-- Filtros para la tabla `app_consejo`
--
ALTER TABLE `app_consejo`
  ADD CONSTRAINT `image_id_refs_id_5878baa0` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_grupo`
--
ALTER TABLE `app_grupo`
  ADD CONSTRAINT `image_id_refs_id_432bc58c` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_grupobanner`
--
ALTER TABLE `app_grupobanner`
  ADD CONSTRAINT `grupo_id_refs_id_18baea55` FOREIGN KEY (`grupo_id`) REFERENCES `app_grupo` (`id`),
  ADD CONSTRAINT `image_id_refs_id_3f874c80` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_noticia`
--
ALTER TABLE `app_noticia`
  ADD CONSTRAINT `image_id_refs_id_70969830` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_prensa`
--
ALTER TABLE `app_prensa`
  ADD CONSTRAINT `image_id_refs_id_1fe71949` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_productos`
--
ALTER TABLE `app_productos`
  ADD CONSTRAINT `categoria_id_refs_id_a0b0c21` FOREIGN KEY (`categoria_id`) REFERENCES `app_categoria` (`id`),
  ADD CONSTRAINT `grupo_id_refs_id_22426519` FOREIGN KEY (`grupo_id`) REFERENCES `app_grupo` (`id`),
  ADD CONSTRAINT `image_id_refs_id_5033dbd4` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_promocion`
--
ALTER TABLE `app_promocion`
  ADD CONSTRAINT `grupo_id_refs_id_5d6d26e` FOREIGN KEY (`grupo_id`) REFERENCES `app_grupo` (`id`),
  ADD CONSTRAINT `image_id_refs_id_2bfe01e7` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`);

--
-- Filtros para la tabla `app_seccion`
--
ALTER TABLE `app_seccion`
  ADD CONSTRAINT `padre_id_refs_id_7ab0579b` FOREIGN KEY (`padre_id`) REFERENCES `app_seccion` (`id`);

--
-- Filtros para la tabla `app_seccionbanner`
--
ALTER TABLE `app_seccionbanner`
  ADD CONSTRAINT `image_id_refs_id_246f1ed5` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`),
  ADD CONSTRAINT `seccion_id_refs_id_1f68b3b5` FOREIGN KEY (`seccion_id`) REFERENCES `app_seccion` (`id`);

--
-- Filtros para la tabla `app_tendencia`
--
ALTER TABLE `app_tendencia`
  ADD CONSTRAINT `image_id_refs_id_27be280c` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`),
  ADD CONSTRAINT `grupo_id_refs_id_3dea25e1` FOREIGN KEY (`grupo_id`) REFERENCES `app_grupo` (`id`);

--
-- Filtros para la tabla `app_tendenciaenlace`
--
ALTER TABLE `app_tendenciaenlace`
  ADD CONSTRAINT `image_id_refs_id_295a08ea` FOREIGN KEY (`image_id`) REFERENCES `app_multimedia` (`id`),
  ADD CONSTRAINT `tendencia_id_refs_id_421263d3` FOREIGN KEY (`tendencia_id`) REFERENCES `app_tendencia` (`id`);

--
-- Filtros para la tabla `app_userprofile`
--
ALTER TABLE `app_userprofile`
  ADD CONSTRAINT `user_id_refs_id_24011469` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Filtros para la tabla `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD CONSTRAINT `group_id_refs_id_3cea63fe` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `permission_id_refs_id_5886d21f` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`);

--
-- Filtros para la tabla `auth_message`
--
ALTER TABLE `auth_message`
  ADD CONSTRAINT `user_id_refs_id_650f49a6` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Filtros para la tabla `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD CONSTRAINT `content_type_id_refs_id_728de91f` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`);

--
-- Filtros para la tabla `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD CONSTRAINT `group_id_refs_id_f116770` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `user_id_refs_id_7ceef80f` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Filtros para la tabla `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  ADD CONSTRAINT `permission_id_refs_id_67e79cb` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `user_id_refs_id_dfbab7d` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Filtros para la tabla `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD CONSTRAINT `content_type_id_refs_id_288599e6` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`),
  ADD CONSTRAINT `user_id_refs_id_c8665aa` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
