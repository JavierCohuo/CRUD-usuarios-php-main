-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2024 a las 15:18:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
CREATE DATABASE control_escolar_db;
USE control_escolar_db;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_escolar_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NULL DEFAULT current_timestamp(),
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `modulo` varchar(3) NOT NULL DEFAULT '041',
  `semestre` int(1) DEFAULT NULL,
  `sede_subsede` varchar(30) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `curp` varchar(18) DEFAULT NULL,
  `lugar_nacimiento` varchar(50) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otro') DEFAULT 'Otro',
  `estado_civil` varchar(20) DEFAULT NULL,
  `domicilio_particular` text DEFAULT NULL,
  `telefono_celular` varchar(10) DEFAULT NULL,
  `telefono_fijo` varchar(10) DEFAULT NULL,
  `escuela_de_procedencia` varchar(60) DEFAULT NULL,
  `ubicacion_de_escuela` text DEFAULT NULL,
  `status` enum('activo','baja') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `fecha_inscripcion`, `nombre`, `apellido`, `modulo`, `semestre`, `sede_subsede`, `email`, `curp`, `lugar_nacimiento`, `fecha_nacimiento`, `edad`, `genero`, `estado_civil`, `domicilio_particular`, `telefono_celular`, `telefono_fijo`, `escuela_de_procedencia`, `ubicacion_de_escuela`, `status`) VALUES
(678, '2024-04-23 12:52:23', 'Mariana', 'Lopez Marquez', '041', 1, 'Calkiní', 'holasoymar@gmail.com', 'sghjklssssbhj', 'Campeche', '2024-04-05', 21, 'Femenino', 'Soltero', 'mi casa', '9876543236', '9878767657', 'Cobach', 'En donde está', 'baja'),
(67544, '2024-04-23 02:41:56', 'hola', 'Duran', '041', 3, 'Campeche', 'teeegaso@gmail.com', 'kjkhgfghjklkjhg', 'Campeche', '2024-04-06', 21, 'Masculino', 'Casado', 'mi casa', '9876543236', '9878767657', 'Cobach', 'En donde está', 'baja'),
(67549, '2024-04-19 17:36:41', 'JAVIER', 'AA', '041', 4, 'Calkiní', '123momn@gmail.com', 'FOMM020913MCCLRRA8', 'Campeche', '2024-04-10', 21, 'Masculino', 'Casado', 'mi casa', '9876543236', '9878767657', 'Cobach', 'En donde está', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_materia`
--

CREATE TABLE `alumno_materia` (
  `alumno_id` int(11) NOT NULL,
  `clave_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno_materia`
--

INSERT INTO `alumno_materia` (`alumno_id`, `clave_materia`) VALUES
(67544, 98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrias`
--

CREATE TABLE `maestrias` (
  `maestria_id` int(11) NOT NULL,
  `nombre_maestria` varchar(70) NOT NULL,
  `total_semestres` int(1) DEFAULT NULL,
  `alumno_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestrias`
--

INSERT INTO `maestrias` (`maestria_id`, `nombre_maestria`, `total_semestres`, `alumno_matricula`) VALUES
(5, 'maestria 5', 6, 67549);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestria_materias`
--

CREATE TABLE `maestria_materias` (
  `maestria_id` int(11) DEFAULT NULL,
  `clave_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestria_materias`
--

INSERT INTO `maestria_materias` (`maestria_id`, `clave_materia`) VALUES
(5, 98),
(5, 98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `clave_materia` int(11) NOT NULL,
  `nombre_materia` varchar(70) NOT NULL,
  `alumno_matricula` int(11) DEFAULT NULL,
  `maestria_id` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `creditos` int(11) NOT NULL,
  `calificacion` float DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`clave_materia`, `nombre_materia`, `alumno_matricula`, `maestria_id`, `num_semestre`, `creditos`, `calificacion`, `profesor_id`) VALUES
(98, 'psicología', 67544, 5, 5, 10, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `profesor_id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`profesor_id`, `nombre`) VALUES
(1, 'hilda'),
(2, 'kjh'),
(3, 'hola'),
(4, 'aaa'),
(5, 'Jorge'),
(6, 'hello');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `user_type` enum('profesor','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `titulo`, `email`, `contrasena`, `user_type`) VALUES
(2, 'Angeles', NULL, 'pikapikagow@gmail.com', '$2y$10$js4.O108t4Q5Z1skIFGOIu1cPh/KhTCgxnIlgRAxz3pLpyP10HWwi', 'administrador'),
(3, 'Mercedes', NULL, 'teeegaso@gmail.com', '$2y$10$u1Nx8cEkwu4nHbK/nWCbJOGA7Sip9kqnG11AkZ/Tkd6DKCOZvgAhm', 'profesor'),
(4, 'javier', NULL, '123momn@gmail.com', '$2y$10$DKo8nI9LQhRzrOsVrY.AJ.YEn5ZA14e/ZOtuThm0jT.ZHGShYz6fK', 'administrador'),
(5, 'Cohuo', NULL, 'loquese@gmail.com', '$2y$10$6.VnCwzUdYSZkqFInwHEBOHKaJGlFdtBySFJTYtPL3DtatM7d6Zbq', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `curp` (`curp`);

--
-- Indices de la tabla `alumno_materia`
--
ALTER TABLE `alumno_materia`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `maestrias`
--
ALTER TABLE `maestrias`
  ADD PRIMARY KEY (`maestria_id`),
  ADD KEY `alumno_matricula` (`alumno_matricula`);

--
-- Indices de la tabla `maestria_materias`
--
ALTER TABLE `maestria_materias`
  ADD KEY `maestria_id` (`maestria_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`clave_materia`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `maestrias`
--
ALTER TABLE `maestrias`
  MODIFY `maestria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `clave_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_materia`
--
ALTER TABLE `alumno_materia`
  ADD CONSTRAINT `alumno_materia_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`matricula`);

--
-- Filtros para la tabla `maestrias`
--
ALTER TABLE `maestrias`
  ADD CONSTRAINT `maestrias_ibfk_1` FOREIGN KEY (`alumno_matricula`) REFERENCES `alumnos` (`matricula`);

--
-- Filtros para la tabla `maestria_materias`
--
ALTER TABLE `maestria_materias`
  ADD CONSTRAINT `maestria_materias_ibfk_1` FOREIGN KEY (`maestria_id`) REFERENCES `maestrias` (`maestria_id`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`profesor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
