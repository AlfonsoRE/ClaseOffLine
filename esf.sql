-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2025 a las 04:47:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
DROP DATABASE IF EXISTS ESF;
CREATE DATABASE ESF;
USE ESF;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `esf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_anuncios`
--

CREATE TABLE `archivos_anuncios` (
  `id` int(11) NOT NULL,
  `id_anuncios` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `archivo` mediumblob DEFAULT NULL,
  `ruta` varchar(120) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_material`
--

CREATE TABLE `archivos_material` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `archivo` mediumblob DEFAULT NULL,
  `ruta` varchar(120) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_tarea`
--

CREATE TABLE `archivos_tarea` (
  `id` int(11) NOT NULL,
  `id_tareas` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `archivo` mediumblob DEFAULT NULL,
  `ruta` varchar(120) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `materia` varchar(120) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_estudiantes`
--

CREATE TABLE `clase_estudiantes` (
  `id` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `status` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_comentario` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionarios`
--

CREATE TABLE `cuestionarios` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_clase` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionarios_contenido`
--

CREATE TABLE `cuestionarios_contenido` (
  `id` int(11) NOT NULL,
  `id_cuestionario` int(11) NOT NULL,
  `pregunta` text DEFAULT NULL,
  `opcion1` varchar(1000) DEFAULT NULL,
  `opcion2` varchar(1000) DEFAULT NULL,
  `opcion3` varchar(1000) DEFAULT NULL,
  `opcion4` varchar(1000) DEFAULT NULL,
  `respuesta` varchar(1000) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlaces_anuncios`
--

CREATE TABLE `enlaces_anuncios` (
  `id` int(11) NOT NULL,
  `id_anuncios` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace_material`
--

CREATE TABLE `enlace_material` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace_tarea`
--

CREATE TABLE `enlace_tarea` (
  `id` int(11) NOT NULL,
  `id_tareas` int(11) NOT NULL,
  `enlace` varchar(120) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cuestionario`
--

CREATE TABLE `historial_cuestionario` (
  `id` int(11) NOT NULL,
  `id_cuestionario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `calificacion` decimal(10,0) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tareas`
--

CREATE TABLE `historial_tareas` (
  `id` int(11) NOT NULL,
  `id_tareas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `calificacion` decimal(10,0) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `archivo` blob DEFAULT NULL,
  `ruta` varchar(120) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `valor` decimal(10,0) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `fecha_entrega` datetime NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------


CREATE TABLE bitacora_sincronizacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tabla VARCHAR(50) NOT NULL,            -- Nombre de la tabla afectada
    id_registro INT NOT NULL,               -- ID del registro afectado
    tipo_cambio ENUM('INSERT','UPDATE','DELETE') NOT NULL, -- Operación realizada
    datos JSON DEFAULT NULL,                -- Información completa (opcional)
    fecha_cambio DATETIME DEFAULT CURRENT_TIMESTAMP
);


--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `rol` enum('usuario','administrador') NOT NULL,
  `status` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_inicio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Triggers para la sincronización
--
-- INSERT
DELIMITER //
CREATE TRIGGER trg_usuarios_insert
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('usuarios', NEW.id, 'INSERT', JSON_OBJECT(
        'nombre', NEW.nombre,
        'email', NEW.email,
        'rol', NEW.rol,
        'status', NEW.status,
        'fecha_inicio', NEW.fecha_inicio
    ));
END;
//
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trg_usuarios_update
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('usuarios', NEW.id, 'UPDATE', JSON_OBJECT(
        'nombre', NEW.nombre,
        'email', NEW.email,
        'rol', NEW.rol,
        'status', NEW.status,
        'fecha_inicio', NEW.fecha_inicio
    ));
END;
//
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trg_usuarios_delete
AFTER DELETE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('usuarios', OLD.id, 'DELETE', JSON_OBJECT(
        'nombre', OLD.nombre,
        'email', OLD.email,
        'rol', OLD.rol,
        'status', OLD.status,
        'fecha_inicio', OLD.fecha_inicio
    ));
END;
//
DELIMITER ;

-- INSERT
DELIMITER //
CREATE TRIGGER trg_material_insert
AFTER INSERT ON material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('material', NEW.id, 'INSERT', JSON_OBJECT(
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'id_tema', NEW.id_tema
    ));
END;
//
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trg_material_update
AFTER UPDATE ON material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('material', NEW.id, 'UPDATE', JSON_OBJECT(
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'id_tema', NEW.id_tema
    ));
END;
//
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trg_material_delete
AFTER DELETE ON material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('material', OLD.id, 'DELETE', JSON_OBJECT(
        'titulo', OLD.titulo,
        'descripcion', OLD.descripcion,
        'id_tema', OLD.id_tema
    ));
END;
//
DELIMITER ;

-- INSERT
DELIMITER //
CREATE TRIGGER trg_temas_insert
AFTER INSERT ON temas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('temas', NEW.id, 'INSERT', JSON_OBJECT(
        'titulo', NEW.titulo,
        'id_clase', NEW.id_clase
    ));
END;
//
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trg_temas_update
AFTER UPDATE ON temas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('temas', NEW.id, 'UPDATE', JSON_OBJECT(
        'titulo', NEW.titulo,
        'id_clase', NEW.id_clase
    ));
END;
//
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trg_temas_delete
AFTER DELETE ON temas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('temas', OLD.id, 'DELETE', JSON_OBJECT(
        'titulo', OLD.titulo,
        'id_clase', OLD.id_clase
    ));
END;
//
DELIMITER ;


-- INSERT
DELIMITER //
CREATE TRIGGER trg_tareas_insert
AFTER INSERT ON tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('tareas', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tema', NEW.id_tema,
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'valor', NEW.valor,
        'fecha', NEW.fecha,
        'fecha_entrega', NEW.fecha_entrega,
        'id_clase', NEW.id_clase
    ));
END;
//
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trg_tareas_update
AFTER UPDATE ON tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('tareas', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tema', NEW.id_tema,
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'valor', NEW.valor,
        'fecha', NEW.fecha,
        'fecha_entrega', NEW.fecha_entrega,
        'id_clase', NEW.id_clase
    ));
END;
//
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trg_tareas_delete
AFTER DELETE ON tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('tareas', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tema', OLD.id_tema,
        'titulo', OLD.titulo,
        'descripcion', OLD.descripcion,
        'valor', OLD.valor,
        'fecha', OLD.fecha,
        'fecha_entrega', OLD.fecha_entrega,
        'id_clase', OLD.id_clase
    ));
END;
//
DELIMITER ;


-- INSERT
DELIMITER //
CREATE TRIGGER trg_cuestionarios_insert
AFTER INSERT ON cuestionarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tema', NEW.id_tema,
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'id_clase', NEW.id_clase,
        'fecha_creacion', NEW.fecha_creacion
    ));
END;
//
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trg_cuestionarios_update
AFTER UPDATE ON cuestionarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tema', NEW.id_tema,
        'titulo', NEW.titulo,
        'descripcion', NEW.descripcion,
        'id_clase', NEW.id_clase,
        'fecha_creacion', NEW.fecha_creacion
    ));
END;
//
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trg_cuestionarios_delete
AFTER DELETE ON cuestionarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tema', OLD.id_tema,
        'titulo', OLD.titulo,
        'descripcion', OLD.descripcion,
        'id_clase', OLD.id_clase,
        'fecha_creacion', OLD.fecha_creacion
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_clases_insert
AFTER INSERT ON clases
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clases', NEW.id, 'INSERT', JSON_OBJECT(
        'nombre', NEW.nombre,
        'materia', NEW.materia,
        'descripcion', NEW.descripcion,
        'codigo', NEW.codigo,
        'id_usuario', NEW.id_usuario
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_clases_update
AFTER UPDATE ON clases
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clases', NEW.id, 'UPDATE', JSON_OBJECT(
        'nombre', NEW.nombre,
        'materia', NEW.materia,
        'descripcion', NEW.descripcion,
        'codigo', NEW.codigo,
        'id_usuario', NEW.id_usuario
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_clases_delete
AFTER DELETE ON clases
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clases', OLD.id, 'DELETE', JSON_OBJECT(
        'nombre', OLD.nombre,
        'materia', OLD.materia,
        'descripcion', OLD.descripcion,
        'codigo', OLD.codigo,
        'id_usuario', OLD.id_usuario
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_anuncios_insert
AFTER INSERT ON anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('anuncios', NEW.id, 'INSERT', JSON_OBJECT(
        'id_clase', NEW.id_clase,
        'id_usuario', NEW.id_usuario,
        'mensaje', NEW.mensaje,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_anuncios_update
AFTER UPDATE ON anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('anuncios', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_clase', NEW.id_clase,
        'id_usuario', NEW.id_usuario,
        'mensaje', NEW.mensaje,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_anuncios_delete
AFTER DELETE ON anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('anuncios', OLD.id, 'DELETE', JSON_OBJECT(
        'id_clase', OLD.id_clase,
        'id_usuario', OLD.id_usuario,
        'mensaje', OLD.mensaje,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_archivos_anuncios_insert
AFTER INSERT ON archivos_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_anuncios', NEW.id, 'INSERT', JSON_OBJECT(
        'id_anuncios', NEW.id_anuncios,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_archivos_anuncios_update
AFTER UPDATE ON archivos_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_anuncios', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_anuncios', NEW.id_anuncios,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_archivos_anuncios_delete
AFTER DELETE ON archivos_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_anuncios', OLD.id, 'DELETE', JSON_OBJECT(
        'id_anuncios', OLD.id_anuncios,
        'nombre', OLD.nombre,
        'archivo', TO_BASE64(OLD.archivo),
        'ruta', OLD.ruta,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_archivos_material_insert
AFTER INSERT ON archivos_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_material', NEW.id, 'INSERT', JSON_OBJECT(
        'id_material', NEW.id_material,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_archivos_material_update
AFTER UPDATE ON archivos_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_material', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_material', NEW.id_material,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_archivos_material_delete
AFTER DELETE ON archivos_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_material', OLD.id, 'DELETE', JSON_OBJECT(
        'id_material', OLD.id_material,
        'nombre', OLD.nombre,
        'archivo', TO_BASE64(OLD.archivo),
        'ruta', OLD.ruta,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_archivos_tarea_insert
AFTER INSERT ON archivos_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_tarea', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_archivos_tarea_update
AFTER UPDATE ON archivos_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_tarea', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'nombre', NEW.nombre,
        'archivo', TO_BASE64(NEW.archivo),
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_archivos_tarea_delete
AFTER DELETE ON archivos_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('archivos_tarea', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tareas', OLD.id_tareas,
        'nombre', OLD.nombre,
        'archivo', TO_BASE64(OLD.archivo),
        'ruta', OLD.ruta,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_clase_estudiantes_insert
AFTER INSERT ON clase_estudiantes
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clase_estudiantes', NEW.id, 'INSERT', JSON_OBJECT(
        'id_clase', NEW.id_clase,
        'id_estudiante', NEW.id_estudiante,
        'status', NEW.status,
        'fecha_inscripcion', NEW.fecha_inscripcion
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_clase_estudiantes_update
AFTER UPDATE ON clase_estudiantes
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clase_estudiantes', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_clase', NEW.id_clase,
        'id_estudiante', NEW.id_estudiante,
        'status', NEW.status,
        'fecha_inscripcion', NEW.fecha_inscripcion
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_clase_estudiantes_delete
AFTER DELETE ON clase_estudiantes
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('clase_estudiantes', OLD.id, 'DELETE', JSON_OBJECT(
        'id_clase', OLD.id_clase,
        'id_estudiante', OLD.id_estudiante,
        'status', OLD.status,
        'fecha_inscripcion', OLD.fecha_inscripcion
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_comentarios_insert
AFTER INSERT ON comentarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('comentarios', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tarea', NEW.id_tarea,
        'id_usuario', NEW.id_usuario,
        'comentario', NEW.comentario,
        'fecha_comentario', NEW.fecha_comentario
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_comentarios_update
AFTER UPDATE ON comentarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('comentarios', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tarea', NEW.id_tarea,
        'id_usuario', NEW.id_usuario,
        'comentario', NEW.comentario,
        'fecha_comentario', NEW.fecha_comentario
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_comentarios_delete
AFTER DELETE ON comentarios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('comentarios', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tarea', OLD.id_tarea,
        'id_usuario', OLD.id_usuario,
        'comentario', OLD.comentario,
        'fecha_comentario', OLD.fecha_comentario
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_cuestionarios_contenido_insert
AFTER INSERT ON cuestionarios_contenido
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios_contenido', NEW.id, 'INSERT', JSON_OBJECT(
        'id_cuestionario', NEW.id_cuestionario,
        'pregunta', NEW.pregunta,
        'opcion1', NEW.opcion1,
        'opcion2', NEW.opcion2,
        'opcion3', NEW.opcion3,
        'opcion4', NEW.opcion4,
        'respuesta', NEW.respuesta,
        'fecha_creacion', NEW.fecha_creacion
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_cuestionarios_contenido_update
AFTER UPDATE ON cuestionarios_contenido
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios_contenido', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_cuestionario', NEW.id_cuestionario,
        'pregunta', NEW.pregunta,
        'opcion1', NEW.opcion1,
        'opcion2', NEW.opcion2,
        'opcion3', NEW.opcion3,
        'opcion4', NEW.opcion4,
        'respuesta', NEW.respuesta,
        'fecha_creacion', NEW.fecha_creacion
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_cuestionarios_contenido_delete
AFTER DELETE ON cuestionarios_contenido
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('cuestionarios_contenido', OLD.id, 'DELETE', JSON_OBJECT(
        'id_cuestionario', OLD.id_cuestionario,
        'pregunta', OLD.pregunta,
        'opcion1', OLD.opcion1,
        'opcion2', OLD.opcion2,
        'opcion3', OLD.opcion3,
        'opcion4', OLD.opcion4,
        'respuesta', OLD.respuesta,
        'fecha_creacion', OLD.fecha_creacion
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_enlaces_anuncios_insert
AFTER INSERT ON enlaces_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlaces_anuncios', NEW.id, 'INSERT', JSON_OBJECT(
        'id_anuncios', NEW.id_anuncios,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_enlaces_anuncios_update
AFTER UPDATE ON enlaces_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlaces_anuncios', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_anuncios', NEW.id_anuncios,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_enlaces_anuncios_delete
AFTER DELETE ON enlaces_anuncios
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlaces_anuncios', OLD.id, 'DELETE', JSON_OBJECT(
        'id_anuncios', OLD.id_anuncios,
        'enlace', OLD.enlace,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_enlace_material_insert
AFTER INSERT ON enlace_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_material', NEW.id, 'INSERT', JSON_OBJECT(
        'id_material', NEW.id_material,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_enlace_material_update
AFTER UPDATE ON enlace_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_material', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_material', NEW.id_material,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_enlace_material_delete
AFTER DELETE ON enlace_material
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_material', OLD.id, 'DELETE', JSON_OBJECT(
        'id_material', OLD.id_material,
        'enlace', OLD.enlace,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_enlace_tarea_insert
AFTER INSERT ON enlace_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_tarea', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_enlace_tarea_update
AFTER UPDATE ON enlace_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_tarea', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'enlace', NEW.enlace,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_enlace_tarea_delete
AFTER DELETE ON enlace_tarea
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('enlace_tarea', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tareas', OLD.id_tareas,
        'enlace', OLD.enlace,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_historial_cuestionario_insert
AFTER INSERT ON historial_cuestionario
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_cuestionario', NEW.id, 'INSERT', JSON_OBJECT(
        'id_cuestionario', NEW.id_cuestionario,
        'id_usuario', NEW.id_usuario,
        'calificacion', NEW.calificacion,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_historial_cuestionario_update
AFTER UPDATE ON historial_cuestionario
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_cuestionario', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_cuestionario', NEW.id_cuestionario,
        'id_usuario', NEW.id_usuario,
        'calificacion', NEW.calificacion,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_historial_cuestionario_delete
AFTER DELETE ON historial_cuestionario
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_cuestionario', OLD.id, 'DELETE', JSON_OBJECT(
        'id_cuestionario', OLD.id_cuestionario,
        'id_usuario', OLD.id_usuario,
        'calificacion', OLD.calificacion,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


-- TRIGGER INSERT
DELIMITER //
CREATE TRIGGER trg_historial_tareas_insert
AFTER INSERT ON historial_tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_tareas', NEW.id, 'INSERT', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'id_usuario', NEW.id_usuario,
        'calificacion', NEW.calificacion,
        'nombre', NEW.nombre,
        'archivo', NEW.archivo,
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER UPDATE
DELIMITER //
CREATE TRIGGER trg_historial_tareas_update
AFTER UPDATE ON historial_tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_tareas', NEW.id, 'UPDATE', JSON_OBJECT(
        'id_tareas', NEW.id_tareas,
        'id_usuario', NEW.id_usuario,
        'calificacion', NEW.calificacion,
        'nombre', NEW.nombre,
        'archivo', NEW.archivo,
        'ruta', NEW.ruta,
        'fecha', NEW.fecha
    ));
END;
//
DELIMITER ;

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER trg_historial_tareas_delete
AFTER DELETE ON historial_tareas
FOR EACH ROW
BEGIN
    INSERT INTO bitacora_sincronizacion (tabla, id_registro, tipo_cambio, datos)
    VALUES ('historial_tareas', OLD.id, 'DELETE', JSON_OBJECT(
        'id_tareas', OLD.id_tareas,
        'id_usuario', OLD.id_usuario,
        'calificacion', OLD.calificacion,
        'nombre', OLD.nombre,
        'archivo', OLD.archivo,
        'ruta', OLD.ruta,
        'fecha', OLD.fecha
    ));
END;
//
DELIMITER ;


--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_usuario` (`id_usuario`);

-- Indices de la tabla `archivos_anuncios`
--
ALTER TABLE `archivos_anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anuncios` (`id_anuncios`);

--
-- Indices de la tabla `archivos_material`
--
ALTER TABLE `archivos_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `archivos_tarea`
--
ALTER TABLE `archivos_tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tareas` (`id_tareas`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `clase_estudiantes`
--
ALTER TABLE `clase_estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tarea` (`id_tarea`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `cuestionarios_contenido`
--
ALTER TABLE `cuestionarios_contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuestionario` (`id_cuestionario`);

--
-- Indices de la tabla `enlaces_anuncios`
--
ALTER TABLE `enlaces_anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anuncios` (`id_anuncios`);

--
-- Indices de la tabla `enlace_material`
--
ALTER TABLE `enlace_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `enlace_tarea`
--
ALTER TABLE `enlace_tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tareas` (`id_tareas`);

--
-- Indices de la tabla `historial_cuestionario`
--
ALTER TABLE `historial_cuestionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuestionario` (`id_cuestionario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `historial_tareas`
--
ALTER TABLE `historial_tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tareas` (`id_tareas`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `archivos_anuncios`
--
ALTER TABLE `archivos_anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `archivos_material`
--
ALTER TABLE `archivos_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `archivos_tarea`
--
ALTER TABLE `archivos_tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `clase_estudiantes`
--
ALTER TABLE `clase_estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `cuestionarios_contenido`
--
ALTER TABLE `cuestionarios_contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `enlaces_anuncios`
--
ALTER TABLE `enlaces_anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `enlace_material`
--
ALTER TABLE `enlace_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `enlace_tarea`
--
ALTER TABLE `enlace_tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `historial_cuestionario`
--
ALTER TABLE `historial_cuestionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `historial_tareas`
--
ALTER TABLE `historial_tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_anuncios`
--
ALTER TABLE `archivos_anuncios`
  ADD CONSTRAINT `archivos_anuncios_ibfk_1` FOREIGN KEY (`id_anuncios`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_material`
--
ALTER TABLE `archivos_material`
  ADD CONSTRAINT `archivos_material_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_tarea`
--
ALTER TABLE `archivos_tarea`
  ADD CONSTRAINT `archivos_tarea_ibfk_1` FOREIGN KEY (`id_tareas`) REFERENCES `tareas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clase_estudiantes`
--
ALTER TABLE `clase_estudiantes`
  ADD CONSTRAINT `clase_estudiantes_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clase_estudiantes_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD CONSTRAINT `cuestionarios_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuestionarios_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuestionarios_contenido`
--
ALTER TABLE `cuestionarios_contenido`
  ADD CONSTRAINT `cuestionarios_contenido_ibfk_1` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `enlaces_anuncios`
--
ALTER TABLE `enlaces_anuncios`
  ADD CONSTRAINT `enlaces_anuncios_ibfk_1` FOREIGN KEY (`id_anuncios`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `enlace_material`
--
ALTER TABLE `enlace_material`
  ADD CONSTRAINT `enlace_material_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `enlace_tarea`
--
ALTER TABLE `enlace_tarea`
  ADD CONSTRAINT `enlace_tarea_ibfk_1` FOREIGN KEY (`id_tareas`) REFERENCES `tareas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_cuestionario`
--
ALTER TABLE `historial_cuestionario`
  ADD CONSTRAINT `historial_cuestionario_ibfk_1` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_cuestionario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_tareas`
--
ALTER TABLE `historial_tareas`
  ADD CONSTRAINT `historial_tareas_ibfk_1` FOREIGN KEY (`id_tareas`) REFERENCES `tareas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_tareas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
