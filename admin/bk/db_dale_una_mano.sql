-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2020 a las 07:47:41
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_dale_una_mano`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `get_asistencia_evento` (`id` INT, `minimo` INT, `maximo` INT)  begin
			select coalesce((select get_hombres(id,minimo,maximo)),0) as hombres,coalesce((select get_mujeres(id,minimo,maximo)),0) as mujeres;
        end$$

CREATE PROCEDURE `get_evento` (`id` INT)  begin
    SET lc_time_names = 'es_CR';

		select *,(Select count(id_evento) from evento_jovenes where id_evento=id) as inscriptos,
        (SELECT DATE_FORMAT(e.fecha,'%W %d %M del %Y')) AS dia,
        (SELECT TIME_FORMAT(e.hora_inicio, "%h %i %p")) as inicio,
        (SELECT TIME_FORMAT(e.hora_cierre, "%h %i %p")) as cierre,
        e.nombre as nombre_evento,concat(f.nombre,' ', f.primer_apellido,' ',f.segundo_apellido) as mentor from eventos e 
        inner join facilitadores f on f.id_facilitador=e.id_facilitador 
        where id_evento=id;
	end$$

CREATE PROCEDURE `get_eventos` ()  begin
	
		select *, (select inscripciones(e.id_evento)) as inscriptos,
		(SELECT TIME_FORMAT(e.hora_inicio, "%h %i %p")) as inicio,
        (SELECT TIME_FORMAT(e.hora_cierre, "%h %i %p")) as cierre,
        e.nombre as nombre_evento,concat(m.nombre,' ', m.primer_apellido,' ',m.segundo_apellido) as mentor 
		from eventos e 
		inner join facilitadores m on m.id_facilitador=e.id_facilitador;
        end$$

CREATE PROCEDURE `get_evento_patrocinio` (`id` INT)  begin
		select * from evento_patrocinio e 
        inner join patrocinadores p on p.id_patrocinador=e.id_patrocinador
        where e.id_evento=id;
	end$$

CREATE PROCEDURE `get_joven` (`id` INT)  begin
        select *, (SELECT TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE())) as edad from jovenes where id_joven=id;
        end$$

CREATE PROCEDURE `get_voluntarios` (`id` INT)  begin
			select * from evento_jovenes e inner join
            jovenes j on j.id_joven=e.id_joven where e.id_evento=id;
		end$$

CREATE PROCEDURE `insert_asistente` (`id_evento` INT, `nombre_completo` VARCHAR(30), `genero` VARCHAR(10), `fecha_nacimiento` DATE, `telefono` VARCHAR(15), `cedula` VARCHAR(15), `tipo` VARCHAR(20))  begin
		insert into asistentes(id_evento,nombre_completo,genero,fecha_nacimiento,telefono,cedula,tipo)
        values(id_evento,nombre_completo,genero,fecha_nacimiento,telefono,cedula,tipo);
	end$$

CREATE PROCEDURE `insert_comentario` (`id` INT, `mensaje` TEXT)  begin
			insert into comentarios(id_evento,descripcion) values(id,mensaje);
		end$$

CREATE PROCEDURE `insert_evento` (`facilitador` INT, `joven` INT, `nombre` VARCHAR(30), `descripcion` TEXT, `fecha` DATE, `hora_inicio` TIME, `hora_cierre` TIME, `lugar` VARCHAR(30), `direccion_lugar` TEXT, `guia` TEXT)  begin
			insert into eventos(nombre,id_facilitador,id_joven,descripcion,fecha,hora_inicio,hora_cierre,
        lugar,direccion_lugar,archivo_guia) values(nombre,facilitador,joven,descripcion,fecha,hora_inicio,hora_cierre,
        lugar,direccion_lugar,guia);
       end$$

CREATE PROCEDURE `insert_facilitador` (IN `nombre` VARCHAR(30), IN `primer_apellido` VARCHAR(15), IN `segundo_apellido` VARCHAR(15), IN `genero` VARCHAR(10), IN `fecha_nacimiento` DATE, IN `telefono` VARCHAR(15), IN `cedula` VARCHAR(15), IN `correo` VARCHAR(50), IN `estado_civil` VARCHAR(20), IN `direccion` TEXT, IN `foto` TEXT, IN `experiencia` TEXT, IN `canton` VARCHAR(20), IN `estado` VARCHAR(15), IN `clave` VARCHAR(20), IN `copia` TEXT)  begin
		insert into facilitadores(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,telefono,cedula,correo,estado_civil,direccion,
                    foto,experiencia,canton,estado,clave,copia_cedula)
                    values(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,telefono,cedula,correo,estado_civil,direccion,
                    foto,experiencia,canton,estado,clave,copia); 
        end$$

CREATE PROCEDURE `insert_joven` (`nombre` VARCHAR(30), `primer_apellido` VARCHAR(15), `segundo_apellido` VARCHAR(15), `nombre_familiar` VARCHAR(50), `telefono_familiar` VARCHAR(15), `tipo` VARCHAR(15), `genero` VARCHAR(10), `fecha_nacimiento` DATE, `telefono` VARCHAR(15), `cedula` VARCHAR(15), `correo` VARCHAR(50), `estado_civil` VARCHAR(20), `canton` VARCHAR(20), `provincia` VARCHAR(20), `distrito` VARCHAR(20), `estado` VARCHAR(10), `fecha_registro` DATE, `centro_formacion` VARCHAR(20), `generacion` INT, `direccion` TEXT, `carta` TEXT, `foto` TEXT)  begin
			insert into jovenes(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,cedula,estado,estado_civil, provincia,distrito
                    ,canton,fecha_registro,centro_formacion, generacion,direccion,telefono,
                    nombre_familiar,telefono_familiar,tipo_conocido,correo,carta,foto)
                    values(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,cedula,estado,estado_civil, provincia,distrito
                    ,canton,fecha_registro,centro_formacion, generacion,direccion,telefono,
                    nombre_familiar,telefono_familiar,tipo,correo,carta,foto);
        end$$

CREATE PROCEDURE `insert_patrocinador` (`nombre` VARCHAR(50), `encargado` VARCHAR(50), `direccion` TEXT, `telefono` VARCHAR(15), `correo` VARCHAR(30), `cedula` VARCHAR(30), `aporte` TEXT)  begin
		insert into patrocinadores(institucion,responsable,cedula_juridica,telefono,correo,aportes,direccion)
        values(nombre,encargado,cedula,telefono,correo,aporte,direccion);
	end$$

CREATE PROCEDURE `insert_patrocinio_evento` (`evento` INT, `patrocinador` INT)  begin 
		insert into evento_patrocinio(id_evento,id_patrocinador) values(evento,patrocinador);
	end$$

CREATE PROCEDURE `insert_voluntario` (`evento` INT, `joven` INT)  begin
			insert into evento_jovenes(id_evento,id_joven) values(evento,joven);
       end$$

CREATE PROCEDURE `update_evento` (`id` INT, `facilitador` INT, `joven` INT, `nombre` VARCHAR(30), `descripcion` TEXT, `fecha` DATE, `hora_inicio` TIME, `hora_cierre` TIME, `lugar` VARCHAR(30), `direccion_lugar` TEXT, `guia` TEXT)  begin
			update eventos e set e.nombre=nombre,e.id_facilitador=id_facilitador,e.id_joven=id_joven,
            e.descripcion=descripcion,e.fecha=fecha,e.hora_inicio=hora_inicio,e.hora_cierre=hora_cierre,
        e.lugar=lugar,e.direccion_lugar=direccion_lugar,e.archivo_guia=guia where e.id_evento=id;
       end$$

CREATE PROCEDURE `update_patrocinador` (`id` INT, `nombre` VARCHAR(50), `encargado` VARCHAR(50), `direccion` TEXT, `telefono` VARCHAR(15), `correo` VARCHAR(30), `cedula` VARCHAR(30), `aporte` TEXT)  begin 
        
        update patrocinadores p set p.institucion=nombre, p.responsable=encargado, p.telefono=telefono,p.correo=correo,
        p.cedula_juridica=cedula,p.aportes=aporte, p.direccion=direccion where p.id_patrocinador=id;
		end$$

--
-- Funciones
--
CREATE FUNCTION `get_hombres` (`id` INT, `minimo` INT, `maximo` INT) RETURNS INT(11) BEGIN
	DECLARE total INT;
	Declare jovenes int;
    declare asistentes int;
	set jovenes =(Select count(id_evento) from evento_jovenes e inner join jovenes j on 
    j.id_joven=e.id_joven where id_evento=id and j.genero="Hombre" and
    (SELECT TIMESTAMPDIFF(YEAR,j.fecha_nacimiento,CURDATE())) between minimo and maximo);    
	set asistentes =(Select count(a.id_evento) from asistentes a where a.id_evento=id and
    a.genero="Hombre" and (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE())) between minimo and maximo);
    set total=jovenes + asistentes;
    return total;
	end$$

CREATE FUNCTION `get_mujeres` (`id` INT, `minimo` INT, `maximo` INT) RETURNS INT(11) BEGIN
	DECLARE total INT;
	Declare jovenes int;
    declare asistentes int;
	set total =(Select count(id_evento) from evento_jovenes e inner join jovenes j on 
    j.id_joven=e.id_joven where id_evento=id and j.genero="Mujer" and
    (SELECT TIMESTAMPDIFF(YEAR,j.fecha_nacimiento,CURDATE())) between minimo and maximo);    
	set asistentes =(Select count(a.id_evento) from asistentes a where a.id_evento=id and
    a.genero="Mujer" and (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE())) between minimo and maximo);
    set total=jovenes + asistentes;

	return total;
	end$$

CREATE FUNCTION `inscripciones` (`id` INT) RETURNS INT(11) BEGIN
	DECLARE total INT;
    Declare jovenes int;
    declare asistentes int;
	set jovenes =(Select count(id_evento) from evento_jovenes where id_evento=id);    
    set asistentes =(Select count(id_evento) from asistentes where id_evento=id);    
    set total=jovenes + asistentes;
    return total;
	end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
--

CREATE TABLE `asistentes` (
  `id_asistente` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `nombre_completo` varchar(30) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistentes`
--

INSERT INTO `asistentes` (`id_asistente`, `id_evento`, `nombre_completo`, `genero`, `fecha_nacimiento`, `telefono`, `cedula`, `tipo`) VALUES
(1, 2, 'Karla Perez Lopez', 'Mujer', '2001-05-04', '83595176', '475180507', 'Apoyo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_evento`, `descripcion`) VALUES
(2, 1, 'Si los arrays de entrada tienen las mismas claves de tipo string, el Ãºltimo valor para esa clave sobrescribirÃ¡ al anterior. Sin embargo, los arrays que contengan claves numÃ©ricas, el Ãºltimo valor no sobrescribirÃ¡ el valor original, sino que serÃ¡ aÃ±adido al final.\r\n\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `id_facilitador` int(11) DEFAULT NULL,
  `id_joven` int(11) DEFAULT NULL,
  `descripcion` text,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `lugar` varchar(30) DEFAULT NULL,
  `direccion_lugar` text,
  `archivo_guia` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nombre`, `id_facilitador`, `id_joven`, `descripcion`, `fecha`, `hora_inicio`, `hora_cierre`, `lugar`, `direccion_lugar`, `archivo_guia`) VALUES
(1, 'Charla Motivacional', 2, 5, 'Charla para toda persona', '2020-05-10', '09:00:00', '17:00:00', 'Salon Comunal xxxx', 'Santa Marta de Bataan', 'assets/cartas/eventos/9191448559650114_7.jpg'),
(2, 'Limpieza de Calle', 1, 8, 'Sacar Basura de las calles', '2020-05-24', '08:00:00', '17:00:00', 'Bataan Centro', '200 mts norte de BN', 'assets/cartas/eventos/749B63545_Kendrick_Jenkins_Lectura_Ingles.pdf'),
(3, 'Charla sobre el sexo', 3, 8, 'Solo mujeres', '2020-05-31', '10:00:00', '17:00:00', 'Salon Comunal xxxx', 'Galilea', 'assets/cartas/eventos/417749B63545_Kendrick_Jenkins_Lectura_Ingles (1).pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_jovenes`
--

CREATE TABLE `evento_jovenes` (
  `id_evento` int(11) DEFAULT NULL,
  `id_joven` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento_jovenes`
--

INSERT INTO `evento_jovenes` (`id_evento`, `id_joven`) VALUES
(1, 4),
(1, 3),
(1, 5),
(1, 6),
(1, 7),
(2, 10),
(2, 13),
(2, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_patrocinio`
--

CREATE TABLE `evento_patrocinio` (
  `id_evento` int(11) DEFAULT NULL,
  `id_patrocinador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento_patrocinio`
--

INSERT INTO `evento_patrocinio` (`id_evento`, `id_patrocinador`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilitadores`
--

CREATE TABLE `facilitadores` (
  `id_facilitador` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `primer_apellido` varchar(15) DEFAULT NULL,
  `segundo_apellido` varchar(15) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `direccion` text,
  `foto` text,
  `experiencia` text,
  `canton` varchar(20) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `clave` varchar(20) DEFAULT NULL,
  `copia_cedula` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facilitadores`
--

INSERT INTO `facilitadores` (`id_facilitador`, `nombre`, `primer_apellido`, `segundo_apellido`, `genero`, `fecha_nacimiento`, `telefono`, `cedula`, `correo`, `estado_civil`, `direccion`, `foto`, `experiencia`, `canton`, `estado`, `clave`, `copia_cedula`) VALUES
(1, 'Pedro', 'Castro', 'Lopez', 'Hombre', '1981-01-31', '27587676', '900921', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'assets/perfiles/facilitador/perezoso.jpg', 'No tengo', 'Siquirres', 'Activo', 'Zoids', ''),
(2, 'Jose', 'Caribe', 'Lopez', 'Hombre', '2020-05-20', '536486', '20393818', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'assets/perfiles/facilitador/1448559650114_7.jpg', 'no tiene', 'Siquirres', 'Activo', 'Zoids', ''),
(3, 'Jhon', 'Lopez', 'Santana', 'Hombre', '2000-05-15', '2768-76-76', '09173170', 'jls@yahoo.com', 'Soltero(a)', '300 mts oeste del mercado municipal', 'assets/perfiles/facilitador/861Logo Dale Una Mano.png', 'Asociacion comunal 2 aÃ±os', 'Siquirres', 'Activo', '12340', 'assets/cedulas/facilitador/71091.Introduccion al analisis cuantitativo (2).pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_eventos`
--

CREATE TABLE `galeria_eventos` (
  `id_galeria` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `galeria_eventos`
--

INSERT INTO `galeria_eventos` (`id_galeria`, `id_evento`, `foto`) VALUES
(16, 1, 'assets/galeria/1491448559650114_7.jpg'),
(17, 1, 'assets/galeria/812atras.jpeg'),
(19, 2, 'assets/galeria/6391448559650114_7.jpg'),
(20, 2, 'assets/galeria/9610perezoso.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jovenes`
--

CREATE TABLE `jovenes` (
  `id_joven` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `primer_apellido` varchar(15) DEFAULT NULL,
  `segundo_apellido` varchar(15) DEFAULT NULL,
  `nombre_familiar` varchar(50) DEFAULT NULL,
  `telefono_familiar` varchar(15) DEFAULT NULL,
  `tipo_conocido` varchar(15) NOT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `canton` varchar(20) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `distrito` varchar(20) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `centro_formacion` varchar(20) DEFAULT NULL,
  `generacion` int(11) DEFAULT NULL,
  `direccion` text,
  `carta` text,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jovenes`
--

INSERT INTO `jovenes` (`id_joven`, `nombre`, `primer_apellido`, `segundo_apellido`, `nombre_familiar`, `telefono_familiar`, `tipo_conocido`, `genero`, `fecha_nacimiento`, `telefono`, `cedula`, `correo`, `estado_civil`, `canton`, `provincia`, `distrito`, `estado`, `fecha_registro`, `centro_formacion`, `generacion`, `direccion`, `carta`, `foto`) VALUES
(1, 'Pablo', 'Goveda', 'Castro', 'Ana', '27685485', '', 'Hombre', '2008-04-28', '27587676', '900921', 'rOW@GMAIL.COM', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2006-02-27', 'Bataan', 2020, 'San Martin\r\n                                ', NULL, NULL),
(3, 'Cristian', 'Perez', 'Carazo', 'Luis', '64310832', '', 'Mujer', '2011-05-02', '89240194', '38041074', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'Limon', 'AlegrÃ­a', 'activo', '2020-05-15', 'Bataan', 2020, 'Alegria\r\n                                ', NULL, NULL),
(4, 'Kenneth', 'Jenkins', 'Bond', 'Carla', '27587676', '', 'Hombre', '1990-05-12', '27587676', '38147506', 'kenjen041@gmail.com', 'Casado(a)', 'Siquirres', 'Limon', 'Cairo', 'activo', '2020-05-23', 'Limon', 2020, 'Virginia\r\n                                ', NULL, NULL),
(5, 'Aldeano', 'Matarrita', 'Valdez', 'Ana', '27587676', '', 'Hombre', '2004-07-31', '27587676', '4121', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-02-09', 'Limon', 2020, 'Siquirres\r\n                                ', NULL, NULL),
(6, 'Aldeano', 'Caribe', 'Perez', 'Carla', '27587676', '', 'Hombre', '2009-05-01', '536486', '897867', 'rOW@GMAIL.COM', 'Soltero(a)', 'Siquirres', 'Limon', 'AlegrÃ­a', 'activo', '2020-05-19', 'Limon', 2020, 'Siquirres\r\n                                ', NULL, NULL),
(7, 'Culi', 'Carvajal', 'Valdez', 'Ana', '27587676', '', 'Hombre', '2010-04-03', '536486', '52635675', 'rOW@GMAIL.COM', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-05-22', 'Limon', 2020, 'Siquirres\r\n                                ', NULL, NULL),
(8, 'Kendrick', 'Jenkins', 'Bond', 'Amalia', '27685485', '', 'Hombre', '1995-08-31', '83595176', '702380402', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-05-05', 'Bataan', 2020, 'Siquirres\r\n                                ', NULL, NULL),
(9, 'Carlos', 'Jenkins', 'Madriz', 'Ana', '27587676', '', 'Hombre', '2018-11-23', '27587676', '141553151', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-05-09', 'Limon', 2020, 'Rio hondo\r\n                                ', NULL, NULL),
(10, 'Paty', 'Caribe', 'Valdez', 'Ana', '27587676', '', 'Hombre', '2005-05-01', ' 8359-51-76', '3563576651', 'rOW@GMAIL.COM', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-05-15', 'Limon', 2020, 'fe\r\n                                ', NULL, NULL),
(13, 'Culi', 'Caribe', 'Lopez', 'Ana', '27587676', '', 'Mujer', '1999-05-14', ' 8359-51-76', '8097656467', 'kenjen041@gmail.com', 'Soltero(a)', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-05-26', 'Bataan', 2020, 'siquirres\r\n                                ', 'assets/cartas/jovenes/B63545_Kendrick_Jenkins_Lectura_Ingles.pdf', 'assets/perfiles/jovenes/thumb-350-968069.jpg'),
(14, 'Culi', 'Perez', 'Lopez', 'Ana', '83595176', 'Amigo(a)', 'Hombre', '2000-05-01', ' 8359-51-76', '652462', 'rOW@GMAIL.COM', 'Soltero(a)', 'Siquirres', 'Limon', 'Cairo', 'activo', '2020-05-08', 'Limon', 2020, 'San Rafael\r\n                                ', 'assets/cartas/jovenes/93313883_1339509112924878_7885542144226623488_n.jpg', 'assets/perfiles/jovenes/Fabula_PavoRealEnReinoPingu.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id_patrocinador` int(11) NOT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `responsable` varchar(50) DEFAULT NULL,
  `cedula_juridica` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `direccion` text,
  `aportes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `patrocinadores`
--

INSERT INTO `patrocinadores` (`id_patrocinador`, `institucion`, `responsable`, `cedula_juridica`, `telefono`, `correo`, `direccion`, `aportes`) VALUES
(1, 'Pali', 'Jose Lope', '38041489', '27587676', 'rOW@GMAIL.COM', 'Limon enfrente del cementerio', 'Apoyo monetario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id_asistente`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_facilitador` (`id_facilitador`),
  ADD KEY `id_joven` (`id_joven`);

--
-- Indices de la tabla `evento_jovenes`
--
ALTER TABLE `evento_jovenes`
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_joven` (`id_joven`);

--
-- Indices de la tabla `evento_patrocinio`
--
ALTER TABLE `evento_patrocinio`
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_patrocinador` (`id_patrocinador`);

--
-- Indices de la tabla `facilitadores`
--
ALTER TABLE `facilitadores`
  ADD PRIMARY KEY (`id_facilitador`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `galeria_eventos`
--
ALTER TABLE `galeria_eventos`
  ADD PRIMARY KEY (`id_galeria`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `jovenes`
--
ALTER TABLE `jovenes`
  ADD PRIMARY KEY (`id_joven`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id_patrocinador`),
  ADD UNIQUE KEY `cedula_juridica` (`cedula_juridica`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id_asistente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `facilitadores`
--
ALTER TABLE `facilitadores`
  MODIFY `id_facilitador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `galeria_eventos`
--
ALTER TABLE `galeria_eventos`
  MODIFY `id_galeria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `jovenes`
--
ALTER TABLE `jovenes`
  MODIFY `id_joven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id_patrocinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD CONSTRAINT `asistentes_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_facilitador`) REFERENCES `facilitadores` (`id_facilitador`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`);

--
-- Filtros para la tabla `evento_jovenes`
--
ALTER TABLE `evento_jovenes`
  ADD CONSTRAINT `evento_jovenes_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`),
  ADD CONSTRAINT `evento_jovenes_ibfk_2` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`);

--
-- Filtros para la tabla `evento_patrocinio`
--
ALTER TABLE `evento_patrocinio`
  ADD CONSTRAINT `evento_patrocinio_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`),
  ADD CONSTRAINT `evento_patrocinio_ibfk_2` FOREIGN KEY (`id_patrocinador`) REFERENCES `patrocinadores` (`id_patrocinador`);

--
-- Filtros para la tabla `galeria_eventos`
--
ALTER TABLE `galeria_eventos`
  ADD CONSTRAINT `galeria_eventos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
