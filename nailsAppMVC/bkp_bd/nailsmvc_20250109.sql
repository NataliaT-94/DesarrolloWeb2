-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2025 a las 01:19:01
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
-- Base de datos: `nailsmvc`
--
CREATE DATABASE IF NOT EXISTS `nailsmvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nailsmvc`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuarioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `hora`, `usuarioId`) VALUES
(1, '2025-01-04', '20:55:38', 1),
(2, '2025-01-23', '12:06:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citasservicios`
--

CREATE TABLE `citasservicios` (
  `id` int(11) NOT NULL,
  `citaId` int(11) NOT NULL,
  `servicioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
(1, 'Acrilicas', 20.00),
(2, 'Semipermanente', 15.00),
(3, 'Encapsuladas', 25.00),
(4, 'Kapping en gel o acrilicas', 25.00),
(5, 'Esculpidas en gel o acrilicas', 30.00),
(6, 'Extension de uñas en gel o acrilicas', 10.00),
(7, 'Dipping', 20.00),
(8, 'Acrilicas', 25.00),
(9, 'Softgel', 30.00),
(10, 'Manicuria Completa', 50.00),
(11, 'Aplicacion de piedras, glitters o strass, c/u', 10.00),
(12, 'Decoracion por uña', 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `admin`, `confirmado`, `token`) VALUES
(1, 'Natalia', 'Techaira', 'correo@correo.com', '', '1123567483', 0, 1, ''),
(2, ' Alejandra', 'Techeira', 'correo7@correo.com', '$2y$10$MVNyLOGc2aLLNh1KO3NNoumVzVkQkiDukq5kg.R19ZpFbqKRHvdvi', '11345678', 0, 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`);

--
-- Indices de la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citaId` (`citaId`),
  ADD KEY `fk_servicioId` (`servicioId`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `usuarios_FK` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  ADD CONSTRAINT `citas_FK` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `fk_servicioId` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
