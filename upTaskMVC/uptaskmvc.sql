-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql:3306
-- Tiempo de generación: 15-10-2025 a las 15:01:34
-- Versión del servidor: 8.0.42
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uptaskmvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int NOT NULL,
  `proyecto` varchar(30) NOT NULL,
  `url` varchar(32) NOT NULL,
  `propietarioId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `proyecto`, `url`, `propietarioId`) VALUES
(6, ' Tienda Virtual', '4d8faca5a3f751adc85973d0d24838c9', 5),
(7, ' Hola', 'ed978adf47decb7a7e0560d12254e6b3', 5),
(8, ' Actualizacion', 'da6a9e55e58c453c51d9edabc4cb6f1d', 5),
(9, ' Tienda Virtual PRO', '9e996208bb52a7f4c9ce555123cef3a9', 5),
(10, ' Tienda Virtual PRO', '3870c4f22ea55daffbc5cce68412a49d', 6),
(11, ' Actualizacion', 'a816f32860ba9866056cc43dff026780', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `proyectoId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `estado`, `proyectoId`) VALUES
(2, ' Conexion con MP', 0, 6),
(3, 'Seguridad', 1, 6),
(4, ' Diseñar logo', 0, 7),
(5, ' Diseñar logo', 0, 10),
(6, ' Seguridad', 0, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `token` varchar(15) NOT NULL,
  `confirmado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `token`, `confirmado`) VALUES
(2, ' Natt', 'correo@correo.com', '$2y$10$7G/yeAzFBP5Gy09.Sm7BIOAMtTy52NCCjVp3dDsUIcp0dINCg60Vy', '', 1),
(3, ' Braian Hernan', 'correo2@correo.com', '$2y$10$9AqAMgD9EAnHFsZ8BS3SGOeRx3YqTPv.vLC8WghSGrHsqN/HwmDfm', '', 1),
(4, ' Braian', 'correo7@correo.com', '$2y$10$tVNgjX5dZiAJT.bbbYsbhOBZmZ9JN/D/Vyg3Q6YwKeXrUER7rWqjO', '', 1),
(5, ' Evelyn', 'admin@admin.com', '$2y$10$pYe1LFeRfQMi1NlThbJxL.fI83HSjBEMZ4TQ9TdxtDTrDDeFxRJJe', '', 1),
(6, ' Natalia', 'correo3@correo.com', '$2y$10$G.vnlToJK7k907PHPJ.R5undKa.IojVqIW2xWlAbPqvtFH5RLkChi', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietarioId` (`propietarioId`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyectoId` (`proyectoId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `usuarios_FK` FOREIGN KEY (`propietarioId`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `proyectos_FK` FOREIGN KEY (`proyectoId`) REFERENCES `proyectos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
