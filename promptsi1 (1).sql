-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2026 a las 19:11:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `promptsi1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_prompt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `accion`, `descripcion`, `fecha`, `id_prompt`) VALUES
(2, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 2),
(3, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 3),
(4, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 4),
(5, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 5),
(6, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 6),
(7, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 7),
(8, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 8),
(9, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:48:44', 9),
(11, 'Creación', 'Se creó un nuevo prompt', '2026-01-11 20:59:45', 11),
(14, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:29', 6),
(15, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:31', 3),
(16, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:31', 8),
(17, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:32', 5),
(19, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:36', 11),
(20, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 22:52:36', 11),
(21, 'Actualización', 'Se actualizó información del prompt', '2026-01-11 23:00:30', 11),
(22, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:37:45', 11),
(23, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:37:45', 11),
(24, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:37:46', 11),
(25, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:37:46', 11),
(28, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:51:55', 11),
(29, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:52:06', 11),
(32, 'Actualización', 'Se actualizó información del prompt', '2026-01-12 19:52:14', 11),
(33, 'Actualización', 'Se actualizó información del prompt', '2026-01-14 20:46:26', 11),
(35, 'Creación', 'Se creó un nuevo prompt', '2026-01-15 21:17:34', 13),
(40, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 19:59:08', 11),
(41, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:17:00', 11),
(42, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:17:11', 11),
(43, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:17:36', 11),
(44, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:17:36', 11),
(45, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:17:38', 11),
(50, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:26:09', 11),
(51, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:26:22', 11),
(52, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:26:56', 11),
(53, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:27:00', 11),
(56, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:27:19', 11),
(57, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:27:26', 11),
(58, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:27:44', 11),
(59, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:27:49', 11),
(60, 'Actualización', 'Se actualizó información del prompt', '2026-01-18 20:28:08', 11),
(61, 'Creación', 'Se creó un nuevo prompt', '2026-01-20 23:52:37', 14),
(62, 'Actualización', 'Se actualizó información del prompt', '2026-01-20 23:55:56', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `color`) VALUES
(1, 'Programación', 'Prompts relacionados con desarrollo de software', '#3498db'),
(2, 'Educación', 'Prompts educativos y académicos', '#2ecc71'),
(3, 'Marketing', 'Prompts para ventas y marketing digital', '#e67e22'),
(4, 'Creatividad', 'Prompts para escritura y creación artística', '#9b59b6'),
(5, 'Productividad', 'Prompts para optimizar tareas y tiempo', '#1abc9c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compartido`
--

CREATE TABLE `compartido` (
  `id` int(11) NOT NULL,
  `destinatario` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_prompt` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_prompt` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favorito`
--

INSERT INTO `favorito` (`id`, `id_usuario`, `id_prompt`, `fecha`) VALUES
(1, 4, 11, '2026-01-18 21:04:17'),
(3, 5, 14, '2026-01-20 23:53:49'),
(4, 5, 13, '2026-01-20 23:54:52'),
(6, 5, 11, '2026-01-20 23:54:53'),
(7, 1, 11, '2026-01-26 16:35:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prompt`
--

CREATE TABLE `prompt` (
  `id` int(11) NOT NULL,
  `titulo_contenido` varchar(150) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `ia_destino` varchar(100) DEFAULT NULL,
  `es_favoritado` tinyint(1) NOT NULL DEFAULT 0,
  `version_actual` int(11) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prompt`
--

INSERT INTO `prompt` (`id`, `titulo_contenido`, `descripcion`, `fecha_creacion`, `ia_destino`, `es_favoritado`, `version_actual`, `id_categoria`, `idUsuario`) VALUES
(2, 'Explicar POO', 'Explica programación orientada a objetos con ejemplos simples', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 2, 0),
(3, 'Plan de marketing digital', 'Diseña una estrategia de marketing digital para una cafetería', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 3, 0),
(4, 'Historia corta de ciencia ficción', 'Escribe un cuento corto de ciencia ficción futurista', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 4, 0),
(5, 'Organizar tareas diarias', 'Crea un sistema para organizar tareas diarias', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 5, 0),
(6, 'Optimizar consultas SQL', 'Mejora el rendimiento de consultas SQL', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 1, 0),
(7, 'Crear examen de matemáticas', 'Genera un examen de álgebra básica', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 2, 0),
(8, 'Texto publicitario', 'Redacta un texto publicitario para redes sociales', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 3, 0),
(9, 'Poema motivacional', 'Escribe un poema corto y motivacional', '2026-01-11 20:48:44', 'ChatGPT', 0, 1, 4, 0),
(11, 'Creacion de trigger en SQL SERVER', 'solicitud para la creacion de un trigger que automatice la actualizacion del stock de los productos disponibles', '2026-01-11 20:59:45', 'Gemini', 0, 1, 1, 0),
(13, 'diseño css para php', 'un diseño que sea tranquilo con colores calidos para un pagina web de una cafeteria', '2026-01-15 21:17:34', 'Claude', 0, 1, 1, 0),
(14, 'diagrama de flujo', 'informacion general de los diagramas de flujo', '2026-01-20 23:52:37', 'Claude', 0, 2, 1, 0);

--
-- Disparadores `prompt`
--
DELIMITER $$
CREATE TRIGGER `TR_Prompt_Insert_Actividad` AFTER INSERT ON `prompt` FOR EACH ROW BEGIN
    INSERT INTO Actividad (accion, descripcion, fecha, id_prompt)
    VALUES ('Creación', 'Se creó un nuevo prompt', NOW(), NEW.id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_Prompt_Update_Actividad` AFTER UPDATE ON `prompt` FOR EACH ROW BEGIN
    INSERT INTO Actividad (accion, descripcion, fecha, id_prompt)
    VALUES ('Actualización', 'Se actualizó información del prompt', NOW(), NEW.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prompt_etiqueta`
--

CREATE TABLE `prompt_etiqueta` (
  `id_prompt` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') DEFAULT 'usuario',
  `estado` tinyint(1) DEFAULT 1,
  `fechaCreacion` datetime DEFAULT current_timestamp(),
  `ultimoAcceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `password`, `rol`, `estado`, `fechaCreacion`, `ultimoAcceso`) VALUES
(1, 'Yery', 'Eguez', 'yery@gmail.com', '$2y$10$XuISblONHe2IqrBq5hQ6MewEE5xk8i1lXnKhlaf9nnGk.lo0WKdGK', 'admin', 1, '2026-01-14 19:03:16', NULL),
(4, 'jairo', 'flores', 'jairo@gmail.com', '$2y$10$IwIQspZP27nfogGrZUgdBO4pAYUR8O/TbRt56kzsa1deFZ5NvQHj6', 'usuario', 1, '2026-01-18 20:23:24', NULL),
(5, 'alexis', 'santivañez', 'alexis@gmail.com', '$2y$10$SWBxiu4TAPnlzKH1K2drMONzJ2wl5H.5YAow2T5wy7qHFfPVZMfRK', 'usuario', 1, '2026-01-20 23:50:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `version`
--

CREATE TABLE `version` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_prompt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `version`
--

INSERT INTO `version` (`id`, `numero`, `contenido`, `fecha`, `id_prompt`) VALUES
(1, 1, 'diseñame un trigger que me automatice la cantidad de stock de los productos al momento de realizar una venta o una compra de productos, cuando se vende se tiene que disminuir el stock y cuando se compra tiene que ahumentar la cantidad de productos', '2026-01-11 20:59:45', 11),
(4, 1, 'hazme un diseño para una pagina de una cafeteria con colores calidos y atractivos', '2026-01-15 21:17:34', 13),
(5, 1, 'dame un breve concepto de lo que un diagrama de flujo', '2026-01-20 23:52:37', 14),
(6, 2, 'dame un breve concepto de lo que un diagrama de flujo', '2026-01-20 23:55:56', 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Actividad_Prompt` (`id_prompt`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compartido`
--
ALTER TABLE `compartido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Compartido_Prompt` (`id_prompt`),
  ADD KEY `fk_compartido_usuario` (`idUsuario`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_prompt`),
  ADD KEY `id_prompt` (`id_prompt`);

--
-- Indices de la tabla `prompt`
--
ALTER TABLE `prompt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Prompt_Categoria` (`id_categoria`);

--
-- Indices de la tabla `prompt_etiqueta`
--
ALTER TABLE `prompt_etiqueta`
  ADD PRIMARY KEY (`id_prompt`,`id_etiqueta`),
  ADD KEY `FK_PE_Etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Version_Prompt` (`id_prompt`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compartido`
--
ALTER TABLE `compartido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `prompt`
--
ALTER TABLE `prompt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `version`
--
ALTER TABLE `version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `FK_Actividad_Prompt` FOREIGN KEY (`id_prompt`) REFERENCES `prompt` (`id`);

--
-- Filtros para la tabla `compartido`
--
ALTER TABLE `compartido`
  ADD CONSTRAINT `FK_Compartido_Prompt` FOREIGN KEY (`id_prompt`) REFERENCES `prompt` (`id`),
  ADD CONSTRAINT `fk_compartido_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`id_prompt`) REFERENCES `prompt` (`id`);

--
-- Filtros para la tabla `prompt`
--
ALTER TABLE `prompt`
  ADD CONSTRAINT `FK_Prompt_Categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `prompt_etiqueta`
--
ALTER TABLE `prompt_etiqueta`
  ADD CONSTRAINT `FK_PE_Etiqueta` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id`),
  ADD CONSTRAINT `FK_PE_Prompt` FOREIGN KEY (`id_prompt`) REFERENCES `prompt` (`id`);

--
-- Filtros para la tabla `version`
--
ALTER TABLE `version`
  ADD CONSTRAINT `FK_Version_Prompt` FOREIGN KEY (`id_prompt`) REFERENCES `prompt` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
