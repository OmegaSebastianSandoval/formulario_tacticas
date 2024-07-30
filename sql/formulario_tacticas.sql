-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-07-2024 a las 22:42:28
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `formulario_tacticas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE IF NOT EXISTS `contenido` (
  `contenido_id` int NOT NULL AUTO_INCREMENT,
  `contenido_seccion` int DEFAULT NULL,
  `contenido_tipo` int DEFAULT NULL,
  `contenido_padre` int DEFAULT NULL,
  `contenido_columna_alineacion` int DEFAULT NULL,
  `contenido_columna` varchar(255) DEFAULT NULL,
  `contenido_columna_espacios` int DEFAULT NULL,
  `contenido_disenio` int DEFAULT NULL,
  `contenido_borde` int DEFAULT NULL,
  `contenido_estado` int DEFAULT NULL,
  `contenido_fecha` date DEFAULT NULL,
  `contenido_titulo` varchar(500) DEFAULT NULL,
  `contenido_titulo_ver` int DEFAULT NULL,
  `contenido_imagen` varchar(500) DEFAULT NULL,
  `contenido_archivo` varchar(255) DEFAULT NULL,
  `contenido_fondo_imagen` varchar(50) DEFAULT NULL,
  `contenido_fondo_imagen_tipo` int DEFAULT NULL,
  `contenido_fondo_color` varchar(100) DEFAULT NULL,
  `contenido_introduccion` text,
  `contenido_descripcion` text,
  `contenido_enlace` varchar(500) DEFAULT NULL,
  `contenido_enlace_abrir` int DEFAULT NULL,
  `contenido_vermas` varchar(100) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`contenido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_academicos`
--

DROP TABLE IF EXISTS `datos_academicos`;
CREATE TABLE IF NOT EXISTS `datos_academicos` (
  `datos_academicos_id` int NOT NULL AUTO_INCREMENT,
  `datos_academicos_formacion` varchar(255) DEFAULT NULL,
  `datos_academicos_cedula_colaborador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`datos_academicos_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_laborales`
--

DROP TABLE IF EXISTS `datos_laborales`;
CREATE TABLE IF NOT EXISTS `datos_laborales` (
  `datos_laborales_id` int NOT NULL AUTO_INCREMENT,
  `datos_laborales_empleo` varchar(255) DEFAULT NULL,
  `datos_laborales_fecha_inicio` date DEFAULT NULL,
  `datos_laborales_fecha_fin` date DEFAULT NULL,
  `datos_laborales_motivo_retiro` text,
  `datos_laborales_cedula_colaborador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`datos_laborales_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependientes`
--

DROP TABLE IF EXISTS `dependientes`;
CREATE TABLE IF NOT EXISTS `dependientes` (
  `dependiente_id` int NOT NULL AUTO_INCREMENT,
  `dependiente_nombre` varchar(255) DEFAULT NULL,
  `dependiente_parentesco` varchar(25) DEFAULT NULL,
  `dependiente_cedula_colaborador` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`dependiente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dependientes`
--

INSERT INTO `dependientes` (`dependiente_id`, `dependiente_nombre`, `dependiente_parentesco`, `dependiente_cedula_colaborador`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, 'Alicia', 'Madre 2', '1100987316'),
(4, 'Rigo', 'Padre', '1100987316'),
(5, 'Alicia', 'Madre 3', '11009873244'),
(6, 'Alicia', 'Madre2 2', '9090909');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlaces`
--

DROP TABLE IF EXISTS `enlaces`;
CREATE TABLE IF NOT EXISTS `enlaces` (
  `enlaces_id` int NOT NULL AUTO_INCREMENT,
  `enlaces_titulo` varchar(255) DEFAULT NULL,
  `enlaces_link` varchar(255) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`enlaces_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_pagina`
--

DROP TABLE IF EXISTS `info_pagina`;
CREATE TABLE IF NOT EXISTS `info_pagina` (
  `info_pagina_id` bigint NOT NULL AUTO_INCREMENT,
  `info_pagina_facebook` varchar(255) DEFAULT NULL,
  `info_pagina_instagram` varchar(255) DEFAULT NULL,
  `info_pagina_twitter` varchar(255) DEFAULT NULL,
  `info_pagina_pinterest` varchar(255) DEFAULT NULL,
  `info_pagina_youtube` varchar(255) DEFAULT NULL,
  `info_pagina_flickr` varchar(255) DEFAULT NULL,
  `info_pagina_linkedin` varchar(255) DEFAULT NULL,
  `info_pagina_google` varchar(255) DEFAULT NULL,
  `info_pagina_telefono` varchar(255) DEFAULT NULL,
  `info_pagina_whatsapp` varchar(255) DEFAULT NULL,
  `info_pagina_correos_contacto` varchar(255) DEFAULT NULL,
  `info_pagina_direccion_contacto` text,
  `info_pagina_informacion_contacto` text,
  `info_pagina_informacion_contacto_footer` text,
  `info_pagina_latitud` varchar(255) DEFAULT NULL,
  `info_pagina_longitud` varchar(255) DEFAULT NULL,
  `info_pagina_zoom` varchar(255) DEFAULT NULL,
  `info_pagina_descripcion` text,
  `info_pagina_tags` text,
  `info_pagina_robot` varchar(500) DEFAULT NULL,
  `info_pagina_sitemap` varchar(500) DEFAULT NULL,
  `info_pagina_scripts` text,
  `info_pagina_metricas` text,
  `orden` bigint DEFAULT NULL,
  `info_pagina_host` varchar(200) NOT NULL,
  `info_pagina_port` int NOT NULL,
  `info_pagina_username` varchar(200) NOT NULL,
  `info_pagina_password` varchar(200) NOT NULL,
  `info_pagina_correo_remitente` varchar(200) NOT NULL,
  `info_pagina_nombre_remitente` varchar(200) NOT NULL,
  `info_pagina_correo_oculto` varchar(200) NOT NULL,
  `info_pagina_titulo_legal` varchar(200) NOT NULL,
  `info_pagina_descripcion_legal` longtext NOT NULL,
  `info_pagina_favicon` varchar(500) NOT NULL,
  PRIMARY KEY (`info_pagina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `info_pagina`
--

INSERT INTO `info_pagina` (`info_pagina_id`, `info_pagina_facebook`, `info_pagina_instagram`, `info_pagina_twitter`, `info_pagina_pinterest`, `info_pagina_youtube`, `info_pagina_flickr`, `info_pagina_linkedin`, `info_pagina_google`, `info_pagina_telefono`, `info_pagina_whatsapp`, `info_pagina_correos_contacto`, `info_pagina_direccion_contacto`, `info_pagina_informacion_contacto`, `info_pagina_informacion_contacto_footer`, `info_pagina_latitud`, `info_pagina_longitud`, `info_pagina_zoom`, `info_pagina_descripcion`, `info_pagina_tags`, `info_pagina_robot`, `info_pagina_sitemap`, `info_pagina_scripts`, `info_pagina_metricas`, `orden`, `info_pagina_host`, `info_pagina_port`, `info_pagina_username`, `info_pagina_password`, `info_pagina_correo_remitente`, `info_pagina_nombre_remitente`, `info_pagina_correo_oculto`, `info_pagina_titulo_legal`, `info_pagina_descripcion_legal`, `info_pagina_favicon`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '<script src=\"//cdn.public.flmngr.com/FLMNFLMN/widgets.js\"></script>', '<script src=\"//cdn.public.flmngr.com/FLMNFLMN/widgets.js\"></script>', '', '', '', '', '', '', '', '', '', NULL, '1', 1, '1', '1', '1', '1', '1', '', '<script src=\"//cdn.public.flmngr.com/FLMNFLMN/widgets.js\"></script>', 'logotacticas2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

DROP TABLE IF EXISTS `ingreso`;
CREATE TABLE IF NOT EXISTS `ingreso` (
  `ingreso_id` int NOT NULL AUTO_INCREMENT,
  `ingreso_fecha_ingreso` datetime DEFAULT NULL,
  `ingreso_nombre` varchar(255) DEFAULT NULL,
  `ingreso_apellido` varchar(255) DEFAULT NULL,
  `ingreso_fecha_nacimiento` date DEFAULT NULL,
  `ingreso_lugar_nacimiento` varchar(255) DEFAULT NULL,
  `ingreso_cedula` varchar(25) DEFAULT NULL,
  `ingreso_nacionalidad` varchar(255) DEFAULT NULL,
  `ingreso_direccion_casa` varchar(255) DEFAULT NULL,
  `ingreso_telefono` varchar(25) DEFAULT NULL,
  `ingreso_telefono_casa` varchar(25) DEFAULT NULL,
  `ingreso_email` varchar(30) DEFAULT NULL,
  `ingreso_estado_civil` varchar(30) DEFAULT NULL,
  `ingreso_nombre_pareja` varchar(255) DEFAULT NULL,
  `ingreso_carnet_blanco` varchar(2) DEFAULT NULL,
  `ingreso_numero_hijos` varchar(5) DEFAULT NULL,
  `ingreso_numero_seguro_social` varchar(45) DEFAULT NULL,
  `ingreso_hobby` text,
  `ingreso_edad` varchar(5) DEFAULT NULL,
  `ingreso_sexo` varchar(45) DEFAULT NULL,
  `ingreso_carnet_verde` varchar(2) DEFAULT NULL,
  `ingreso_afiliado_seguro_social` varchar(5) DEFAULT NULL,
  `ingreso_nombre_madre` varchar(255) DEFAULT NULL,
  `ingreso_telefono_madre` varchar(25) DEFAULT NULL,
  `ingreso_nombre_padre` varchar(255) DEFAULT NULL,
  `ingreso_telefono_padre` varchar(25) DEFAULT NULL,
  `ingreso_vive_casa` varchar(45) DEFAULT NULL,
  `ingreso_fecha_solicitud` datetime DEFAULT NULL,
  `ingreso_estado_solicitud` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`),
  UNIQUE KEY `ingreso_cedula` (`ingreso_cedula`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`ingreso_id`, `ingreso_fecha_ingreso`, `ingreso_nombre`, `ingreso_apellido`, `ingreso_fecha_nacimiento`, `ingreso_lugar_nacimiento`, `ingreso_cedula`, `ingreso_nacionalidad`, `ingreso_direccion_casa`, `ingreso_telefono`, `ingreso_telefono_casa`, `ingreso_email`, `ingreso_estado_civil`, `ingreso_nombre_pareja`, `ingreso_carnet_blanco`, `ingreso_numero_hijos`, `ingreso_numero_seguro_social`, `ingreso_hobby`, `ingreso_edad`, `ingreso_sexo`, `ingreso_carnet_verde`, `ingreso_afiliado_seguro_social`, `ingreso_nombre_madre`, `ingreso_telefono_madre`, `ingreso_nombre_padre`, `ingreso_telefono_padre`, `ingreso_vive_casa`, `ingreso_fecha_solicitud`, `ingreso_estado_solicitud`) VALUES
(1, '0000-00-00 00:00:00', 'Juan Sebastian', 'Sandoval Vargas', '1998-08-09', 'San Gil', '1100987324', 'Colombiano', 'Calle 24G ', '312462434', '7249082', 'desarrollo8@gmail.com', 'Soltero', '', '1', '2', '', 'Juega', '25', 'Masculino', '1', '1', 'Alicia Vargas', '3213759041', 'Rigoberto Sandoval', '3123213213', 'Alquilada', '0000-00-00 00:00:00', ''),
(2, '0000-00-00 00:00:00', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', ''),
(3, '0000-00-00 00:00:00', 'Juan Sebastian', 'Sandoval Vargas', '2009-06-29', 'San Gil', '110098732', 'Colombiano', 'Calle 24G ', '3123123', '7249082', 'desarrollo8@gmail.com', 'Union Libre', 'Preja nombre', '1', '0', '3123123', 'jugar', '15', 'Masculino', '1', '', 'Alicia Vargas', '3123123', 'Rigoberto Sandoval', '31231231', 'Alquilada', '2024-07-26 11:29:05', '1'),
(4, '0000-00-00 00:00:00', 'Juan Sebastian', 'Sandoval Vargas', '2009-06-29', 'San Gil', '110098731', 'Colombiano', 'Calle 24G ', '3123123', '7249082', 'desarrollo8@gmail.com', 'Union Libre', 'Preja nombre', '1', '0', '3123123', 'jugar', '', 'Masculino', '1', '', 'Alicia Vargas', '3123123', 'Rigoberto Sandoval', '31231231', 'Alquilada', '2024-07-26 11:42:35', '1'),
(5, '0000-00-00 00:00:00', 'Juan Sebastian', 'Sandoval Vargas', '2009-06-29', 'San Gil', '1100987316', 'Colombiano', 'Calle 24G ', '3123123', '7249082', 'desarrollo8@gmail.com', 'Union Libre', 'Preja nombre', '1', '0', '3123123', 'jugar', '', 'Masculino', '1', '', 'Alicia Vargas', '3123123', 'Rigoberto Sandoval', '31231231', 'Alquilada', '2024-07-26 11:43:39', '1'),
(6, '0000-00-00 00:00:00', 'Juan Sebastian', 'Sandoval Vargas', '2009-07-16', 'San Gil', '11009873244', 'Colombiano', 'Calle 24G ', '34534534', '7249082', 'desarrollo8@gmail.com', 'Casado', 'Preja nombre', '1', '2', '3123123', 'jugar cel', '15', 'Femenimo', '1', '1', 'Alicia Vargas', '312312312', 'Rigoberto Sandoval', '3123123', 'Alquilada', '2024-07-26 11:52:54', '1'),
(7, '2024-07-26 12:07:52', 'Juan Sebastian', 'Sandoval Vargas', '2009-07-17', 'San Gil', '9090909', 'Colombiano', 'Calle 24G ', '123123', '312312', 'desarrollo8@gmail.com', 'Union Libre', '213gfggf', '1', '2', '3123123', '123123 jugar', '', 'Masculino', '1', '1', 'Alicia Vargas', '21312312', 'Rigoberto Sandoval', '2131231', 'Alquilada', '2024-07-26 12:33:00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `log_usuario` varchar(50) DEFAULT NULL,
  `log_tipo` varchar(50) DEFAULT NULL,
  `log_fecha` datetime DEFAULT NULL,
  `log_log` text,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`log_id`, `log_usuario`, `log_tipo`, `log_fecha`, `log_log`) VALUES
(1, 'admin', 'CREAR BANNER', '2024-07-25 16:33:39', 'Array\n(\n    [publicidad_seccion] => 2\n    [publicidad_nombre] => Logo header\n    [publicidad_nombre2] => \n    [publicidad_fecha] => 2024-07-25\n    [publicidad_nombre_ver] => \n    [publicidad_imagen] => logotacticas21.png\n    [publicidad_imagenresponsive] => logotacticas22.png\n    [publicidad_video] => \n    [publicidad_color_fondo] => \n    [publicidad_posicion] => \n    [publicidad_descripcion] => <script src=\"//cdn.public.flmngr.com/FLMNFLMN/widgets.js\"></script>\n    [publicidad_estado] => 1\n    [publicidad_click] => 0\n    [publicidad_enlace] => \n    [publicidad_tipo_enlace] => 0\n    [publicidad_texto_enlace] => \n    [publicidad_enlace_alineacion] => \n    [publicidad_id] => 1\n)\n'),
(2, 'admin', 'CREAR INGRESO', '2024-07-26 09:47:15', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 1998-08-09\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 1100987324\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 312462434\n    [ingreso_telefono_casa] => 7249082\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Soltero\n    [ingreso_nombre_pareja] => \n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 2\n    [ingreso_numero_seguro_social] => \n    [ingreso_hobby] => Juega\n    [ingreso_edad] => 25\n    [ingreso_sexo] => Masculino\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => 1\n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 3213759041\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 3123213213\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => \n    [ingreso_estado_solicitud] => \n    [ingreso_id] => 1\n)\n'),
(3, 'admin', 'CREAR INGRESO', '2024-07-26 09:49:10', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => \n    [ingreso_apellido] => \n    [ingreso_fecha_nacimiento] => \n    [ingreso_lugar_nacimiento] => \n    [ingreso_cedula] => \n    [ingreso_nacionalidad] => \n    [ingreso_direccion_casa] => \n    [ingreso_telefono] => \n    [ingreso_telefono_casa] => \n    [ingreso_email] => \n    [ingreso_estado_civil] => \n    [ingreso_nombre_pareja] => \n    [ingreso_carnet_blanco] => \n    [ingreso_numero_hijos] => \n    [ingreso_numero_seguro_social] => \n    [ingreso_hobby] => \n    [ingreso_edad] => \n    [ingreso_sexo] => \n    [ingreso_carnet_verde] => \n    [ingreso_afiliado_seguro_social] => \n    [ingreso_nombre_madre] => \n    [ingreso_telefono_madre] => \n    [ingreso_nombre_padre] => \n    [ingreso_telefono_padre] => \n    [ingreso_vive_casa] => \n    [ingreso_fecha_solicitud] => \n    [ingreso_estado_solicitud] => \n    [ingreso_id] => 2\n)\n'),
(4, 'admin', 'CREAR INGRESO', '2024-07-26 11:29:05', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 2009-06-29\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 110098732\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 3123123\n    [ingreso_telefono_casa] => 7249082\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Union Libre\n    [ingreso_nombre_pareja] => Preja nombre\n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 0\n    [ingreso_numero_seguro_social] => 3123123\n    [ingreso_hobby] => jugar\n    [ingreso_edad] => 15\n    [ingreso_sexo] => Masculino\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => \n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 3123123\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 31231231\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => 2024-07-26 11:29:05\n    [ingreso_estado_solicitud] => 1\n    [ingreso_id] => 3\n)\n'),
(5, 'admin', 'CREAR INGRESO', '2024-07-26 11:42:35', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 2009-06-29\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 110098731\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 3123123\n    [ingreso_telefono_casa] => 7249082\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Union Libre\n    [ingreso_nombre_pareja] => Preja nombre\n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 0\n    [ingreso_numero_seguro_social] => 3123123\n    [ingreso_hobby] => jugar\n    [ingreso_edad] => \n    [ingreso_sexo] => Masculino\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => \n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 3123123\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 31231231\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => 2024-07-26 11:42:35\n    [ingreso_estado_solicitud] => 1\n    [ingreso_id] => 4\n)\n'),
(6, 'admin', 'CREAR INGRESO', '2024-07-26 11:43:39', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 2009-06-29\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 1100987316\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 3123123\n    [ingreso_telefono_casa] => 7249082\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Union Libre\n    [ingreso_nombre_pareja] => Preja nombre\n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 0\n    [ingreso_numero_seguro_social] => 3123123\n    [ingreso_hobby] => jugar\n    [ingreso_edad] => \n    [ingreso_sexo] => Masculino\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => \n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 3123123\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 31231231\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => 2024-07-26 11:43:39\n    [ingreso_estado_solicitud] => 1\n    [ingreso_id] => 5\n)\n'),
(7, 'admin', 'CREAR DEPENDIENTE', '2024-07-26 11:52:54', 'Array\n(\n    [dependiente_nombre] => Alicia\n    [dependiente_parentesco] => Madre 3\n    [dependiente_cedula_colaborador] => 11009873244\n)\n'),
(8, 'admin', 'CREAR INGRESO', '2024-07-26 11:52:54', 'Array\n(\n    [ingreso_fecha_ingreso] => \n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 2009-07-16\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 11009873244\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 34534534\n    [ingreso_telefono_casa] => 7249082\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Casado\n    [ingreso_nombre_pareja] => Preja nombre\n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 2\n    [ingreso_numero_seguro_social] => 3123123\n    [ingreso_hobby] => jugar cel\n    [ingreso_edad] => 15\n    [ingreso_sexo] => Femenimo\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => 1\n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 312312312\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 3123123\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => 2024-07-26 11:52:54\n    [ingreso_estado_solicitud] => 1\n    [ingreso_id] => 6\n    [log_log] => Array\n(\n    [dependiente_nombre] => Alicia\n    [dependiente_parentesco] => Madre 3\n    [dependiente_cedula_colaborador] => 11009873244\n)\n\n    [log_tipo] => CREAR DEPENDIENTE\n)\n'),
(9, 'admin', 'CREAR DEPENDIENTE', '2024-07-26 12:33:00', 'Array\n(\n    [dependiente_nombre] => Alicia\n    [dependiente_parentesco] => Madre2 2\n    [dependiente_cedula_colaborador] => 9090909\n)\n'),
(10, 'admin', 'CREAR VIVE CON', '2024-07-26 12:33:00', 'Array\n(\n    [vive_con_nombre] => carol\n    [vive_con_parentesco] => apreja\n    [vive_con_telefono] => 3123123123\n    [vive_con_cedula_colaborador] => 9090909\n)\n'),
(11, 'admin', 'CREAR INGRESO', '2024-07-26 12:33:00', 'Array\n(\n    [ingreso_fecha_ingreso] => 2024-07-26 12:07:52\n    [ingreso_nombre] => Juan Sebastian\n    [ingreso_apellido] => Sandoval Vargas\n    [ingreso_fecha_nacimiento] => 2009-07-17\n    [ingreso_lugar_nacimiento] => San Gil\n    [ingreso_cedula] => 9090909\n    [ingreso_nacionalidad] => Colombiano\n    [ingreso_direccion_casa] => Calle 24G \n    [ingreso_telefono] => 123123\n    [ingreso_telefono_casa] => 312312\n    [ingreso_email] => desarrollo8@gmail.com\n    [ingreso_estado_civil] => Union Libre\n    [ingreso_nombre_pareja] => 213gfggf\n    [ingreso_carnet_blanco] => 1\n    [ingreso_numero_hijos] => 2\n    [ingreso_numero_seguro_social] => 3123123\n    [ingreso_hobby] => 123123 jugar\n    [ingreso_edad] => \n    [ingreso_sexo] => Masculino\n    [ingreso_carnet_verde] => 1\n    [ingreso_afiliado_seguro_social] => 1\n    [ingreso_nombre_madre] => Alicia Vargas\n    [ingreso_telefono_madre] => 21312312\n    [ingreso_nombre_padre] => Rigoberto Sandoval\n    [ingreso_telefono_padre] => 2131231\n    [ingreso_vive_casa] => Alquilada\n    [ingreso_fecha_solicitud] => 2024-07-26 12:33:00\n    [ingreso_estado_solicitud] => 1\n    [ingreso_id] => 7\n    [log_log] => Array\n(\n    [vive_con_nombre] => carol\n    [vive_con_parentesco] => apreja\n    [vive_con_telefono] => 3123123123\n    [vive_con_cedula_colaborador] => 9090909\n)\n\n    [log_tipo] => CREAR VIVE CON\n)\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

DROP TABLE IF EXISTS `publicidad`;
CREATE TABLE IF NOT EXISTS `publicidad` (
  `publicidad_id` int NOT NULL AUTO_INCREMENT,
  `publicidad_seccion` int DEFAULT NULL,
  `publicidad_nombre` varchar(500) DEFAULT NULL,
  `publicidad_fecha` date DEFAULT NULL,
  `publicidad_imagen` varchar(500) DEFAULT NULL,
  `publicidad_imagenresponsive` varchar(255) DEFAULT NULL,
  `publicidad_color_fondo` varchar(255) DEFAULT NULL,
  `publicidad_video` text,
  `publicidad_posicion` varchar(255) DEFAULT NULL,
  `publicidad_descripcion` text,
  `publicidad_estado` int DEFAULT NULL,
  `publicidad_click` int DEFAULT NULL,
  `publicidad_enlace` varchar(500) DEFAULT NULL,
  `publicidad_tipo_enlace` int DEFAULT NULL,
  `publicidad_texto_enlace` varchar(255) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`publicidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`publicidad_id`, `publicidad_seccion`, `publicidad_nombre`, `publicidad_fecha`, `publicidad_imagen`, `publicidad_imagenresponsive`, `publicidad_color_fondo`, `publicidad_video`, `publicidad_posicion`, `publicidad_descripcion`, `publicidad_estado`, `publicidad_click`, `publicidad_enlace`, `publicidad_tipo_enlace`, `publicidad_texto_enlace`, `orden`) VALUES
(1, 2, 'Logo header', '2024-07-25', 'logotacticas21.png', 'logotacticas22.png', '', '', '', '<script src=\"//cdn.public.flmngr.com/FLMNFLMN/widgets.js\"></script>', 1, 0, '', 0, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `user_date` date DEFAULT NULL,
  `user_names` varchar(255) DEFAULT NULL,
  `user_cedula` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_telefono` varchar(255) DEFAULT NULL,
  `user_level` int DEFAULT NULL,
  `user_state` int DEFAULT NULL,
  `user_user` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_delete` int DEFAULT NULL,
  `user_current_user` bigint DEFAULT NULL,
  `user_code` varchar(500) DEFAULT NULL,
  `user_empresa` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_user` (`user_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user_date`, `user_names`, `user_cedula`, `user_email`, `user_telefono`, `user_level`, `user_state`, `user_user`, `user_password`, `user_delete`, `user_current_user`, `user_code`, `user_empresa`) VALUES
(1, '2018-07-17', 'Administrador', '1232321321', 'gerencia@omegawebsystems.com', '123213123123', 1, 1, 'admin', '$2y$10$ULs0eFV/YanZb7L386//7O0wf6W4urgVrAaWDnRcSb.bLWi0ZmO8y', 1, 1, '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vive_con`
--

DROP TABLE IF EXISTS `vive_con`;
CREATE TABLE IF NOT EXISTS `vive_con` (
  `vive_con_id` int NOT NULL AUTO_INCREMENT,
  `vive_con_nombre` varchar(255) DEFAULT NULL,
  `vive_con_telefono` varchar(45) DEFAULT NULL,
  `vive_con_parentesco` varchar(25) DEFAULT NULL,
  `vive_con_cedula_colaborador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vive_con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vive_con`
--

INSERT INTO `vive_con` (`vive_con_id`, `vive_con_nombre`, `vive_con_telefono`, `vive_con_parentesco`, `vive_con_cedula_colaborador`) VALUES
(1, 'carol', '3123123123', 'apreja', '9090909');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
