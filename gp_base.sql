-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2025 a las 23:41:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gp_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `codigo_equipo` varchar(8) NOT NULL,
  `nombre_equipo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `numero_control` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`codigo_equipo`, `nombre_equipo`, `descripcion`, `numero_control`) VALUES
('asdfgh', 'Team Recursivo', 'Realizar tareas de monica', 21011062),
('elkks', 'EquipoUmizumi', 'Aqui es el mejor equipo', 21011062),
('puesno', 'Elshaca', 'noseee', 21011062);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(10) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(10) NOT NULL,
  `nombre_materia` varchar(255) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(10) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_estado` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL,
  `id_equipo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id_tarea` int(10) NOT NULL,
  `nombre_tarea` varchar(255) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_estado` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL,
  `id_proyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numero_control` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numero_control`, `password`, `nombre`, `apellido`) VALUES
(21011062, 'pass2024', 'Jose Alfredo', 'Ventura Gallardo'),
(21011063, 'pass2024', 'Alan Emmanuel', 'Arias Rodriguez'),
(21011064, 'pass2024', 'Axel', 'Sanchez Salvador'),
(21011065, 'pass2024', 'Diana Laura', 'Florencio Jimenez'),
(21011066, 'pass2024', 'Felipe', 'Rodriguez Fernandez'),
(21011067, 'pass2024', 'Maria', 'Gonzalez Lopez'),
(21011068, 'pass2024', 'Carlos', 'Martinez Ruiz'),
(21011069, 'pass2024', 'Sofia', 'Hernandez Diaz'),
(21011070, 'pass2024', 'Jorge', 'Perez Castro'),
(21011071, 'pass2024', 'Lucia', 'Gomez Torres');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`codigo_equipo`),
  ADD KEY `FKEquipo838511` (`numero_control`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `FKProyecto834268` (`id_equipo`),
  ADD KEY `FKProyecto959381` (`id_materia`),
  ADD KEY `FKProyecto988823` (`id_estado`),
  ADD KEY `FKProyecto400427` (`id_usuario`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `FKTarea36264` (`id_proyecto`),
  ADD KEY `FKTarea738554` (`id_materia`),
  ADD KEY `FKTarea209651` (`id_estado`),
  ADD KEY `FKTarea621254` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numero_control`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FKEquipo838511` FOREIGN KEY (`numero_control`) REFERENCES `usuario` (`numero_control`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `FKProyecto400427` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`numero_control`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKProyecto834268` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`codigo_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKProyecto959381` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKProyecto988823` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `FKTarea209651` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKTarea36264` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKTarea621254` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`numero_control`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKTarea738554` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
