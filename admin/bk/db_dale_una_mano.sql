-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2020 a las 23:09:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_asistencia_evento` (`id` INT, `minimo` INT, `maximo` INT)  begin
			select coalesce((select get_hombres(id,minimo,maximo)),0) as hombres,coalesce((select get_mujeres(id,minimo,maximo)),0) as mujeres;
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_asistencia_jovenes` (IN `id` INT)  NO SQL
begin
			select * from evento_jovenes e inner join
            jovenes j on j.id_joven=e.id_joven where e.id_evento=id and 	 e.asistio=1;
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_evento` (IN `id` INT)  begin
    SET lc_time_names = 'es_CR';

		select *,(Select count(id_evento) from evento_jovenes where id_evento=id) as inscriptos,
        (SELECT DATE_FORMAT(e.fecha,'%W %d %M del %Y')) AS dia,
        (SELECT TIME_FORMAT(e.hora_inicio, "%h %i %p")) as inicio,
        (SELECT TIME_FORMAT(e.hora_cierre, "%h %i %p")) as cierre,
        e.nombre as nombre_evento,concat(u.nombre,' ', u.primer_apellido,' ',u.segundo_apellido) as mentor from eventos e 
        inner join usuarios u on u.id_usuario=e.id_usuario        where id_evento=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_eventos` ()  begin
	
		select *, (select inscripciones(e.id_evento)) as inscriptos,
		(SELECT TIME_FORMAT(e.hora_inicio, "%h %i %p")) as inicio,
        (SELECT TIME_FORMAT(e.hora_cierre, "%h %i %p")) as cierre,
        e.nombre as nombre_evento,concat(u.nombre,' ', u.primer_apellido,' ',u.segundo_apellido) as mentor 
		from eventos e 
		inner join usuarios u on u.id_usuario=e.id_usuario;
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_evento_patrocinio` (`id` INT)  begin
		select * from evento_patrocinio e 
        inner join patrocinadores p on p.id_patrocinador=e.id_patrocinador
        where e.id_evento=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_facilitadores_seguimiento` (IN `id_seguimiento` INT)  begin
				select * from usuarios_seguimiento us 
                inner join usuarios u on u.id_usuario=us.id_usuario
                where us.id_seguimiento=id_seguimiento;
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_joven` (`id` INT)  begin
        select *, (SELECT TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE())) as edad from jovenes where id_joven=id;
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_junta_directiva` ()  begin 
			select *,u.nombre as nombre_f, p.nombre as puesto from miembros_junta_directiva m 
            inner join usuarios u
             inner join puestos_directivos p 
            where m.estado=1 and p.id_puesto=m.id_puesto and u.id_usuario=m.id_usuario
            order by p.id_puesto desc;
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_observaciones` (IN `id` INT)  begin
                    SET lc_time_names = 'es_CR';

                select *, (Select DATE_FORMAT(o.fecha,'%d/%m/%Y')) AS dia from observaciones_seguimiento o
        inner join usuarios u on u.id_usuario =o.id_usuario where o.id_seguimiento=id;
                end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_recomendaciones` (IN `id` INT)  begin
                    SET lc_time_names = 'es_CR';

                select *, (Select DATE_FORMAT(r.fecha,'%d/%m/%Y')) AS dia from recomendacion_seguimiento r
        inner join usuarios u on u.id_usuario =r.id_usuario where r.id_seguimiento=id;
                end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reunion` (IN `id` INT)  begin
    SET lc_time_names = 'es_CR';

		select *,
        (SELECT DATE_FORMAT(r.fecha,'%W %d %M del %Y')) as dia,
        (SELECT TIME_FORMAT(r.hora_inicio, '%h:%i %p')) as inicio,
        (SELECT TIME_FORMAT(r.hora_final, '%h:%i %p')) as cierre
		from reuniones r INNER JOIN usuarios u on u.id_usuario=r.id_usuario
        where r.id_reunion=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_seguimiento` (IN `id_seguimiento` INT)  begin
    SET lc_time_names = 'es_CR';

				select *,(Select DATE_FORMAT(s.fecha,'%W %d %M del %Y')) AS dia from seguimientos s 
                inner join jovenes j on j.id_joven=s.id_joven
                where s.id_seguimiento=id_seguimiento;
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_seguimientos` ()  begin
				select * from seguimientos s inner join
                usuarios u on u.id_usuario= s.id_usuario; 
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_voluntarios` (IN `id` INT)  begin
			select * from evento_jovenes e inner join
            jovenes j on j.id_joven=e.id_joven where e.id_evento=id and 	 e.asistio=0;
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_agenda` (`id_reunion` INT, `actividad` VARCHAR(128), `encargado` VARCHAR(50))  begin
		insert into agenda(id_reunion,actividad,encargado) values(id_reunion,actividad,encargado);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_asistente` (`id_evento` INT, `nombre_completo` VARCHAR(30), `genero` VARCHAR(10), `fecha_nacimiento` DATE, `telefono` VARCHAR(15), `cedula` VARCHAR(15), `tipo` VARCHAR(20))  begin
		insert into asistentes(id_evento,nombre_completo,genero,fecha_nacimiento,telefono,cedula,tipo)
        values(id_evento,nombre_completo,genero,fecha_nacimiento,telefono,cedula,tipo);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_comentario` (`id` INT, `mensaje` TEXT)  begin
			insert into comentarios(id_evento,descripcion) values(id,mensaje);
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_evento` (IN `facilitador` INT, IN `joven` INT, IN `nombre` VARCHAR(30), IN `descripcion` TEXT, IN `fecha` DATE, IN `hora_inicio` TIME, IN `hora_cierre` TIME, IN `lugar` VARCHAR(30), IN `direccion_lugar` TEXT, IN `guia` TEXT, IN `categoria` INT, IN `objectivo` INT)  begin
			insert into eventos(nombre,id_usuario,id_joven,descripcion,fecha,hora_inicio,hora_cierre,
        lugar,direccion_lugar,archivo_guia,id_categoria,id_objectivo) values(nombre,facilitador,joven,descripcion,fecha,hora_inicio,hora_cierre,
        lugar,direccion_lugar,guia,categoria,objectivo);
       end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_facilitador_seguimiento` (IN `id_usuario` INT, IN `id_seguimiento` INT)  begin
				insert into usuarios_seguimiento(id_usuario,id_seguimiento) values(id_usuario,id_seguimiento);
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_joven` (IN `nombre` VARCHAR(30), IN `primer_apellido` VARCHAR(15), IN `segundo_apellido` VARCHAR(15), IN `nombre_familiar` VARCHAR(50), IN `telefono_familiar` VARCHAR(15), IN `tipo` VARCHAR(15), IN `genero` VARCHAR(10), IN `fecha_nacimiento` DATE, IN `telefono` VARCHAR(15), IN `cedula` VARCHAR(15), IN `correo` VARCHAR(50), IN `estado_civil` VARCHAR(20), IN `canton` VARCHAR(20), IN `provincia` VARCHAR(20), IN `distrito` VARCHAR(20), IN `estado` VARCHAR(10), IN `fecha_registro` DATE, IN `centro_formacion` VARCHAR(20), IN `generacion` INT, IN `direccion` TEXT, IN `carta` TEXT, IN `foto` TEXT, IN `cant` INT, IN `ayuda` BOOLEAN, IN `consentimiento` TEXT, IN `copia` TEXT)  begin
			insert into jovenes(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,cedula,estado,estado_civil, provincia,distrito ,canton,fecha_registro,sede, generacion,direccion,telefono,          nombre_familiar,telefono_familiar,tipo_conocido,correo,carta,foto,cant_miembros,ayuda_social,consentimiento,copia_cedula)
                    values(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,cedula,estado,estado_civil, provincia,distrito
                    ,canton,fecha_registro,centro_formacion, generacion,direccion,telefono,
                    nombre_familiar,telefono_familiar,tipo,correo,carta,foto,cant,ayuda,consentimiento,copia_cedula);
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_miembro` (`facilitador` INT, `puesto` VARCHAR(20))  begin
			insert into miembros_junta_directiva(id_facilitador,id_puesto) values(facilitador,puesto);
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_observacion_seguimiento` (IN `id_usuario` INT, IN `id_seguimiento` INT, IN `mensaje` TEXT)  begin
				insert into observaciones_seguimiento(id_usuario,id_seguimiento,mensaje) values(id_usuario,id_seguimiento,mensaje);
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_ocupacion` (IN `joven` INT, IN `lugar` VARCHAR(100), IN `tipo` VARCHAR(20))  NO SQL
BEGIN
    	insert into ocupacion_joven(id_joven,lugar,tipo) values(joven,lugar,tipo);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_patrocinador` (IN `nombre` VARCHAR(50), IN `encargado` VARCHAR(50), IN `direccion` TEXT, IN `telefono` VARCHAR(15), IN `correo` VARCHAR(30), IN `cedula` VARCHAR(30), IN `aporte` TEXT, IN `logo` TEXT, IN `ver` BOOLEAN)  begin
		insert into patrocinadores(institucion,responsable,cedula_juridica,telefono,correo,aportes,direccion,logo,visualizar)
        values(nombre,encargado,cedula,telefono,correo,aporte,direccion,logo,ver);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_patrocinio_evento` (`evento` INT, `patrocinador` INT)  begin 
		insert into evento_patrocinio(id_evento,id_patrocinador) values(evento,patrocinador);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_recomendacion_seguimiento` (IN `id_usuario` INT, IN `id_seguimiento` INT, IN `mensaje` TEXT)  begin
				insert into recomendacion_seguimiento(id_usuario,id_seguimiento,mensaje) values(id_usuario,id_seguimiento,mensaje);
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_reunion` (IN `numero` INT(11), IN `fecha` DATE, IN `objectivo` VARCHAR(128), IN `lugar` VARCHAR(128), IN `hora_inicio` TIME, IN `hora_final` TIME, IN `id_usuario` INT)  begin
		insert into reuniones(numero,fecha,objectivo,lugar,hora_inicio,hora_final,id_usuario) values(numero,fecha,objectivo,lugar,hora_inicio,hora_final,id_usuario);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_seguimiento` (`id_joven` INT, `fecha` DATE, `asunto` TEXT)  begin
				insert into seguimientos(id_joven,fecha,asunto) values(id_joven,fecha,asunto);
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_usuario` (IN `nombre` VARCHAR(30), IN `primer_apellido` VARCHAR(15), IN `segundo_apellido` VARCHAR(15), IN `genero` VARCHAR(10), IN `fecha_nacimiento` DATE, IN `telefono` VARCHAR(15), IN `cedula` VARCHAR(15), IN `correo` VARCHAR(50), IN `estado_civil` VARCHAR(20), IN `direccion` TEXT, IN `foto` TEXT, IN `experiencia` TEXT, IN `canton` VARCHAR(20), IN `estado` VARCHAR(15), IN `clave` VARCHAR(20), IN `copia` TEXT, IN `tipo` VARCHAR(20), IN `acceso` BOOLEAN)  begin
		insert into usuarios(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,telefono,cedula,correo,estado_civil,direccion,
                    foto,experiencia,canton,estado,clave,copia_cedula,tipo,acceso)
                    values(nombre,primer_apellido,segundo_apellido,
                    genero,fecha_nacimiento,telefono,cedula,correo,estado_civil,direccion,
                    foto,experiencia,canton,estado,clave,copia,tipo,acceso); 
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_voluntario` (IN `evento` INT, IN `joven` INT)  begin
			insert into evento_jovenes(id_evento,id_joven,asistio) values(evento,joven,0);
       end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_asistente` (IN `id` INT)  NO SQL
begin
				update asistentes  set asistio=1 where id_asistente=id;
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_evento` (IN `id` INT, IN `id_usuario` INT, IN `id_joven` INT, IN `nombre` VARCHAR(30), IN `descripcion` TEXT, IN `fecha` DATE, IN `hora_inicio` TIME, IN `hora_cierre` TIME, IN `lugar` VARCHAR(30), IN `direccion_lugar` TEXT, IN `guia` TEXT)  begin
			update eventos e set e.nombre=nombre,e.id_usuario=id_usuario,e.id_joven=id_joven,
            e.descripcion=descripcion,e.fecha=fecha,e.hora_inicio=hora_inicio,e.hora_cierre=hora_cierre,
        e.lugar=lugar,e.direccion_lugar=direccion_lugar,e.archivo_guia=guia where e.id_evento=id;
       end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_evento_joven` (IN `id` INT)  NO SQL
begin
				update evento_jovenes  set asistio=1 where id_joven=id;
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_patrocinador` (IN `id` INT, IN `nombre` VARCHAR(50), IN `encargado` VARCHAR(50), IN `direccion` TEXT, IN `telefono` VARCHAR(15), IN `correo` VARCHAR(30), IN `cedula` VARCHAR(30), IN `aporte` TEXT, IN `logo` TEXT, IN `ver` BOOLEAN)  begin 
        
        update patrocinadores p set p.institucion=nombre, p.responsable=encargado, p.telefono=telefono,p.correo=correo,
        p.cedula_juridica=cedula,p.aportes=aporte, p.direccion=direccion, p.logo=logo,p.visualizar=ver where p.id_patrocinador=id;
		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_reunion` (`id` INT, `numero` INT, `fecha` DATE, `lugar` VARCHAR(100), `objectivo` VARCHAR(128), `hora_inicio` TIME, `hora_final` TIME)  begin
			update reuniones r set r.numero=numero, r.fecha=fecha, r.lugar=lugar, r.objectivo=objectivo, r.hora_inicio=hora_inicio, r.hora_final=hora_final where r.id_reunion=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_seguimiento` (IN `id_seguimiento` INT, IN `documento` TEXT, IN `asunto` TEXT, IN `fecha` DATE, IN `id_usuario` INT)  begin
				update seguimientos  s set s.documento=documento,s.asunto=asunto,s.fecha=fecha, s.id_usuario=id_usuario where s.id_seguimiento=id_seguimiento;
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_seguimiento_documento` (`id_seguimiento` INT, `documento` TEXT)  begin
				update seguimientos  set documento=documento where id_seguimiento=id_seguimiento;
			end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_usuario` (IN `id` INT, IN `nombre` VARCHAR(30), IN `primer_apellido` VARCHAR(15), IN `segundo_apellido` VARCHAR(15), IN `genero` VARCHAR(10), IN `fecha_nacimiento` DATE, IN `telefono` VARCHAR(15), IN `cedula` VARCHAR(15), IN `correo` VARCHAR(50), IN `estado_civil` VARCHAR(20), IN `direccion` TEXT, IN `foto` TEXT, IN `experiencia` TEXT, IN `canton` VARCHAR(20), IN `estado` VARCHAR(15), IN `clave` VARCHAR(20), IN `copia` TEXT, IN `tipo` VARCHAR(20), IN `acceso` BOOLEAN)  begin
		update usuarios u set u.nombre=nombre,u.primer_apellido=primer_apellido,u.segundo_apellido=segundo_apellido,
                    u.genero=genero,u.fecha_nacimiento=fecha_nacimiento,u.telefono=telefono,u.cedula=cedula,
                    u.correo=correo,u.estado_civil=estado_civil,u.direccion=direccion,                   u.foto=foto,u.experiencia=experiencia,u.canton=canton,u.estado=estado,u.clave=clave,u.copia_cedula=copia,u.tipo=tipo, u.acceso=acceso
                    where u.id_usuario=id;
        end$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_hombres` (`id` INT, `minimo` INT, `maximo` INT) RETURNS INT(11) BEGIN
	DECLARE total INT;
	Declare jovenes int;
    declare asistentes int;
	set jovenes =(Select count(id_evento) from evento_jovenes e inner join jovenes j on 
    j.id_joven=e.id_joven where e.id_evento=id and j.genero="Hombre" and
    (SELECT TIMESTAMPDIFF(YEAR,j.fecha_nacimiento,CURDATE())) between minimo and maximo);    
	set asistentes =(Select count(a.id_evento) from asistentes a where a.id_evento=id and
    a.genero="Hombre" and (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE())) between minimo and maximo);
    set total=jovenes + asistentes;
    return total;
	end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_mujeres` (`id` INT, `minimo` INT, `maximo` INT) RETURNS INT(11) BEGIN
	DECLARE total INT;
	Declare jovenes int;
    declare asistentes int;
	set jovenes =(Select count(id_evento) from evento_jovenes e inner join jovenes j on 
    j.id_joven=e.id_joven where e.id_evento=id and j.genero="Mujer" and
    (SELECT TIMESTAMPDIFF(YEAR,j.fecha_nacimiento,CURDATE())) between minimo and maximo);    
	set asistentes =(Select count(a.id_evento) from asistentes a where a.id_evento=id and
    a.genero="Mujer" and (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE())) between minimo and maximo);
    set total=jovenes + asistentes;

	return total;
	end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `inscripciones` (`id` INT) RETURNS INT(11) BEGIN
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
-- Estructura de tabla para la tabla `acuerdos_reunion`
--

CREATE TABLE `acuerdos_reunion` (
  `id_acuerdo` int(11) NOT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  `actividad` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `encargado` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendas`
--

CREATE TABLE `agendas` (
  `id_agenda` int(11) NOT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  `actividad` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `encargado` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_reunion`
--

CREATE TABLE `asistencia_reunion` (
  `id_asistencia` int(11) NOT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  `representa` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `encargado` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
--

CREATE TABLE `asistentes` (
  `id_asistente` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `nombre_completo` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `genero` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `cedula` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `tipo` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `asistio` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asuntos_reunion`
--

CREATE TABLE `asuntos_reunion` (
  `id_asunto` int(11) NOT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  `actividad` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_eventos`
--

CREATE TABLE `categoria_eventos` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_eventos`
--

INSERT INTO `categoria_eventos` (`id_categoria`, `nombre_categoria`, `estado`) VALUES
(1, 'Salud y bienestar', 1),
(2, 'Educación', 1),
(3, 'Cultura', 1),
(4, 'Ambiente', 1),
(5, 'Justicia Social', 1),
(6, 'Innovación, Ciencia y Tecnología', 1),
(7, 'Empleabilidad', 1),
(8, 'Recreación', 1),
(9, 'Educacion Sexual', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_joven` int(11) DEFAULT NULL,
  `id_objectivo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descripcion` text CHARACTER SET latin1 DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `lugar` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `direccion_lugar` text CHARACTER SET latin1 DEFAULT NULL,
  `archivo_guia` text CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nombre`, `id_usuario`, `id_joven`, `id_objectivo`, `id_categoria`, `descripcion`, `fecha`, `hora_inicio`, `hora_cierre`, `lugar`, `direccion_lugar`, `archivo_guia`) VALUES
(1, 'Limpieza', 1, 1, 13, 4, 'xxx', '2020-07-30', '11:05:00', '17:05:00', 'Casa de la cultura', 'xxx', 'assets/cartas/eventos/498Modulo Inventario.pdf'),
(2, 'Viveres', 1, 1, 10, 5, 'vvv', '2020-07-29', '13:00:00', '15:00:00', 'Bataan Centro', 'mmm', 'assets/cartas/eventos/953104471166_3497666590263206_286055308328839954_o.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_jovenes`
--

CREATE TABLE `evento_jovenes` (
  `id_evento` int(11) DEFAULT NULL,
  `id_joven` int(11) DEFAULT NULL,
  `asistio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evento_jovenes`
--

INSERT INTO `evento_jovenes` (`id_evento`, `id_joven`, `asistio`) VALUES
(2, 1, 0),
(2, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_patrocinio`
--

CREATE TABLE `evento_patrocinio` (
  `id_evento` int(11) DEFAULT NULL,
  `id_patrocinador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jovenes`
--

CREATE TABLE `jovenes` (
  `id_joven` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `primer_apellido` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `segundo_apellido` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `nombre_familiar` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `telefono_familiar` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `tipo_conocido` varchar(15) CHARACTER SET latin1 NOT NULL,
  `genero` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `cedula` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `estado_civil` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `canton` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `provincia` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `distrito` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `estado` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `sede` int(11) NOT NULL,
  `generacion` int(11) DEFAULT NULL,
  `direccion` text CHARACTER SET latin1 DEFAULT NULL,
  `carta` text CHARACTER SET latin1 DEFAULT NULL,
  `foto` text CHARACTER SET latin1 DEFAULT NULL,
  `cant_miembros` int(2) NOT NULL,
  `copia_cedula` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `consentimiento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ayuda_social` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jovenes`
--

INSERT INTO `jovenes` (`id_joven`, `nombre`, `primer_apellido`, `segundo_apellido`, `nombre_familiar`, `telefono_familiar`, `tipo_conocido`, `genero`, `fecha_nacimiento`, `telefono`, `cedula`, `correo`, `estado_civil`, `canton`, `provincia`, `distrito`, `estado`, `fecha_registro`, `sede`, `generacion`, `direccion`, `carta`, `foto`, `cant_miembros`, `copia_cedula`, `consentimiento`, `ayuda_social`) VALUES
(1, 'Luis', 'Castro', 'Madriz', 'Ana', '27685485', 'Hermano(a)', 'Hombre', '2004-07-23', '2768-76-76', '123', 'J@gmail.com', 'Union Libre', 'Siquirres', 'Limon', 'Siquirres', 'activo', '2020-07-29', 5, 2020, 'xxx\r\n                                ', 'assets/cartas/jovenes/Estudiante_Consultas_Siquirres.docx', 'assets/perfiles/jovenes/´portada.jpg', 0, '', '', 0),
(2, 'Pabla', 'Coelo', 'Carazo', 'Carla', '27587676', 'Madre', 'Hombre', '2005-12-31', '2768-76-76', '1213', 'mannolo@gmail.com', 'Soltero(a)', 'Alegria', 'Limon', 'Alegría', 'activo', '2020-07-29', 5, 2020, 'xx\r\n                                ', 'assets/cartas/jovenes/', 'assets/perfiles/jovenes/', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros_junta_directiva`
--

CREATE TABLE `miembros_junta_directiva` (
  `id_miembro` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_puesto` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nucleo_familiar`
--

CREATE TABLE `nucleo_familiar` (
  `id_familiar` int(11) NOT NULL,
  `id_joven` int(11) NOT NULL,
  `rol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_familiar` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jefe` tinyint(1) NOT NULL,
  `estudios` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocupacion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nucleo_familiar`
--

INSERT INTO `nucleo_familiar` (`id_familiar`, `id_joven`, `rol`, `nombre_familiar`, `jefe`, `estudios`, `ocupacion`, `estado`) VALUES
(5, 1, 'Abuelo(a)', 'Pedro', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objectivo_evento`
--

CREATE TABLE `objectivo_evento` (
  `id_objectivo` int(11) NOT NULL,
  `nombre_objectivo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `objectivo_evento`
--

INSERT INTO `objectivo_evento` (`id_objectivo`, `nombre_objectivo`, `estado`) VALUES
(1, 'Fin de la pobreza', 1),
(2, 'Cero hambre', 1),
(3, 'Salud y bienestar', 1),
(4, 'Educación de calidad', 1),
(5, 'Igualdad de género', 1),
(6, 'Agua limpia y saneamiento', 1),
(7, 'Energía asequible y no contaminante', 1),
(8, 'Trabajo decente y crecimiento económico', 1),
(9, 'Industria, innovación e infraestructura', 1),
(10, 'Reducción de las desigualdades', 1),
(11, 'Ciudades y comunidades sostenibles', 1),
(12, 'Producción y consumo responsable', 1),
(13, 'Acción por el clima', 1),
(14, 'Vida submarina', 1),
(15, 'Vida de ecosistemas terrestres', 1),
(16, 'Paz, justicia e instituciones sólidas', 1),
(17, 'Alianzas para lograr los objetivos', 1),
(18, 'Reciclaje', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_seguimiento`
--

CREATE TABLE `observaciones_seguimiento` (
  `id_observacion` int(11) NOT NULL,
  `id_seguimiento` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupacion_joven`
--

CREATE TABLE `ocupacion_joven` (
  `id_ocupacion` int(11) NOT NULL,
  `id_joven` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id_patrocinador` int(11) NOT NULL,
  `institucion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `responsable` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `cedula_juridica` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `correo` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` text CHARACTER SET latin1 DEFAULT NULL,
  `aportes` text CHARACTER SET latin1 DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visualizar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `patrocinadores`
--

INSERT INTO `patrocinadores` (`id_patrocinador`, `institucion`, `responsable`, `cedula_juridica`, `telefono`, `correo`, `direccion`, `aportes`, `estado`, `logo`, `visualizar`) VALUES
(1, 'Gollo', 'Jose Lopez', '38041074', '83595176', 'J@gmail.com', 'Pacuarito', 'Alimentación y equipamiento', 1, 'assets/logos/patrocinador/109510620545_880976058598952_1142543221888936460_n.png', 0),
(3, 'Pali', 'Josue Garza', '20393818', '83595176', 'J@gmail.com', 'Siquirres', 'Nada', 0, 'assets/logos/patrocinador/426´portada.jpg', 0),
(4, 'Aya', 'Car', '757970', ' 83595176', 'mannolo@gmail.com', 'Puerto', 'nada', 0, 'assets/logos/patrocinador/699104471166_3497666590263206_286055308328839954_o.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos_directivos`
--

CREATE TABLE `puestos_directivos` (
  `id_puesto` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendacion_seguimiento`
--

CREATE TABLE `recomendacion_seguimiento` (
  `id_recomendacion` int(11) NOT NULL,
  `id_seguimiento` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `id_reunion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `objectivo` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lugar` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`id_reunion`, `id_usuario`, `numero`, `fecha`, `objectivo`, `lugar`, `hora_inicio`, `hora_final`) VALUES
(1, 1, 2, '2020-07-31', 'efeq', 'epri', '11:50:00', '12:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `nombre_sede`, `estado`) VALUES
(5, 'Bataan', 1),
(6, 'Siquirres', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `id_seguimiento` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_joven` int(11) DEFAULT NULL,
  `asunto` text CHARACTER SET utf8mb4 NOT NULL,
  `documento` text CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `primer_apellido` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `segundo_apellido` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `genero` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `cedula` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `estado_civil` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` text CHARACTER SET latin1 DEFAULT NULL,
  `foto` text CHARACTER SET latin1 DEFAULT NULL,
  `experiencia` text CHARACTER SET latin1 DEFAULT NULL,
  `canton` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `estado` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `clave` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `copia_cedula` text CHARACTER SET latin1 NOT NULL,
  `tipo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `acceso` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `primer_apellido`, `segundo_apellido`, `genero`, `fecha_nacimiento`, `telefono`, `cedula`, `correo`, `estado_civil`, `direccion`, `foto`, `experiencia`, `canton`, `estado`, `clave`, `copia_cedula`, `tipo`, `acceso`) VALUES
(1, 'Kendrick', 'Jenkins', 'Bond', 'Hombre', '1995-08-31', '83595176', '702380402', 'kenjen041@gmail.com', 'Casado(a)', 'Siquirres', 'assets/perfiles/usuario/24210620545_880976058598952_1142543221888936460_n.png', 'No tengo', 'Siquirres', 'Activo', '123', 'null', 'Desarrollador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_seguimiento`
--

CREATE TABLE `usuarios_seguimiento` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_seguimiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acuerdos_reunion`
--
ALTER TABLE `acuerdos_reunion`
  ADD PRIMARY KEY (`id_acuerdo`),
  ADD KEY `id_reunion` (`id_reunion`);

--
-- Indices de la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_reunion` (`id_reunion`);

--
-- Indices de la tabla `asistencia_reunion`
--
ALTER TABLE `asistencia_reunion`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `id_reunion` (`id_reunion`);

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id_asistente`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `asuntos_reunion`
--
ALTER TABLE `asuntos_reunion`
  ADD PRIMARY KEY (`id_asunto`),
  ADD KEY `id_reunion` (`id_reunion`);

--
-- Indices de la tabla `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  ADD PRIMARY KEY (`id_categoria`);

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
  ADD KEY `id_facilitador` (`id_usuario`),
  ADD KEY `id_joven` (`id_joven`),
  ADD KEY `id_objectivo` (`id_objectivo`),
  ADD KEY `id_categoria` (`id_categoria`);

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
-- Indices de la tabla `jovenes`
--
ALTER TABLE `jovenes`
  ADD PRIMARY KEY (`id_joven`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `sede` (`sede`);

--
-- Indices de la tabla `miembros_junta_directiva`
--
ALTER TABLE `miembros_junta_directiva`
  ADD PRIMARY KEY (`id_miembro`),
  ADD KEY `id_facilitador` (`id_usuario`),
  ADD KEY `id_puesto` (`id_puesto`);

--
-- Indices de la tabla `nucleo_familiar`
--
ALTER TABLE `nucleo_familiar`
  ADD PRIMARY KEY (`id_familiar`),
  ADD KEY `id_joven` (`id_joven`);

--
-- Indices de la tabla `objectivo_evento`
--
ALTER TABLE `objectivo_evento`
  ADD PRIMARY KEY (`id_objectivo`);

--
-- Indices de la tabla `observaciones_seguimiento`
--
ALTER TABLE `observaciones_seguimiento`
  ADD PRIMARY KEY (`id_observacion`),
  ADD KEY `id_seguimiento` (`id_seguimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ocupacion_joven`
--
ALTER TABLE `ocupacion_joven`
  ADD PRIMARY KEY (`id_ocupacion`),
  ADD KEY `id_joven` (`id_joven`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id_patrocinador`),
  ADD UNIQUE KEY `cedula_juridica` (`cedula_juridica`);

--
-- Indices de la tabla `puestos_directivos`
--
ALTER TABLE `puestos_directivos`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `recomendacion_seguimiento`
--
ALTER TABLE `recomendacion_seguimiento`
  ADD PRIMARY KEY (`id_recomendacion`),
  ADD KEY `id_seguimiento` (`id_seguimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`id_reunion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_joven` (`id_joven`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios_seguimiento`
--
ALTER TABLE `usuarios_seguimiento`
  ADD KEY `id_seguimiento` (`id_seguimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acuerdos_reunion`
--
ALTER TABLE `acuerdos_reunion`
  MODIFY `id_acuerdo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistencia_reunion`
--
ALTER TABLE `asistencia_reunion`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id_asistente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asuntos_reunion`
--
ALTER TABLE `asuntos_reunion`
  MODIFY `id_asunto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jovenes`
--
ALTER TABLE `jovenes`
  MODIFY `id_joven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `miembros_junta_directiva`
--
ALTER TABLE `miembros_junta_directiva`
  MODIFY `id_miembro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nucleo_familiar`
--
ALTER TABLE `nucleo_familiar`
  MODIFY `id_familiar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `objectivo_evento`
--
ALTER TABLE `objectivo_evento`
  MODIFY `id_objectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `observaciones_seguimiento`
--
ALTER TABLE `observaciones_seguimiento`
  MODIFY `id_observacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ocupacion_joven`
--
ALTER TABLE `ocupacion_joven`
  MODIFY `id_ocupacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id_patrocinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puestos_directivos`
--
ALTER TABLE `puestos_directivos`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recomendacion_seguimiento`
--
ALTER TABLE `recomendacion_seguimiento`
  MODIFY `id_recomendacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `id_reunion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acuerdos_reunion`
--
ALTER TABLE `acuerdos_reunion`
  ADD CONSTRAINT `acuerdos_reunion_ibfk_1` FOREIGN KEY (`id_reunion`) REFERENCES `reuniones` (`id_reunion`);

--
-- Filtros para la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_ibfk_1` FOREIGN KEY (`id_reunion`) REFERENCES `reuniones` (`id_reunion`);

--
-- Filtros para la tabla `asistencia_reunion`
--
ALTER TABLE `asistencia_reunion`
  ADD CONSTRAINT `asistencia_reunion_ibfk_1` FOREIGN KEY (`id_reunion`) REFERENCES `reuniones` (`id_reunion`);

--
-- Filtros para la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD CONSTRAINT `asistentes_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Filtros para la tabla `asuntos_reunion`
--
ALTER TABLE `asuntos_reunion`
  ADD CONSTRAINT `asuntos_reunion_ibfk_1` FOREIGN KEY (`id_reunion`) REFERENCES `reuniones` (`id_reunion`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`),
  ADD CONSTRAINT `eventos_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_eventos` (`id_categoria`),
  ADD CONSTRAINT `eventos_ibfk_4` FOREIGN KEY (`id_objectivo`) REFERENCES `objectivo_evento` (`id_objectivo`);

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
-- Filtros para la tabla `jovenes`
--
ALTER TABLE `jovenes`
  ADD CONSTRAINT `jovenes_ibfk_1` FOREIGN KEY (`sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `miembros_junta_directiva`
--
ALTER TABLE `miembros_junta_directiva`
  ADD CONSTRAINT `miembros_junta_directiva_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `miembros_junta_directiva_ibfk_2` FOREIGN KEY (`id_puesto`) REFERENCES `puestos_directivos` (`id_puesto`);

--
-- Filtros para la tabla `nucleo_familiar`
--
ALTER TABLE `nucleo_familiar`
  ADD CONSTRAINT `nucleo_familiar_ibfk_1` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`);

--
-- Filtros para la tabla `observaciones_seguimiento`
--
ALTER TABLE `observaciones_seguimiento`
  ADD CONSTRAINT `observaciones_seguimiento_ibfk_1` FOREIGN KEY (`id_seguimiento`) REFERENCES `seguimientos` (`id_seguimiento`) ON DELETE CASCADE,
  ADD CONSTRAINT `observaciones_seguimiento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ocupacion_joven`
--
ALTER TABLE `ocupacion_joven`
  ADD CONSTRAINT `ocupacion_joven_ibfk_1` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`);

--
-- Filtros para la tabla `recomendacion_seguimiento`
--
ALTER TABLE `recomendacion_seguimiento`
  ADD CONSTRAINT `recomendacion_seguimiento_ibfk_1` FOREIGN KEY (`id_seguimiento`) REFERENCES `seguimientos` (`id_seguimiento`) ON DELETE CASCADE,
  ADD CONSTRAINT `recomendacion_seguimiento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`id_joven`) REFERENCES `jovenes` (`id_joven`),
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios_seguimiento`
--
ALTER TABLE `usuarios_seguimiento`
  ADD CONSTRAINT `usuarios_seguimiento_ibfk_1` FOREIGN KEY (`id_seguimiento`) REFERENCES `seguimientos` (`id_seguimiento`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_seguimiento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
