-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2024 a las 21:39:15
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
-- Base de datos: `automotormvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'correo@correo.com', '$2y$12$M9bliU2aUULApltlbDgnHOTYIcaclSNyrF4Ytlxzz09kYTKKfwo86');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `modelo` int(11) NOT NULL,
  `puertas` int(11) NOT NULL,
  `motor` int(11) NOT NULL,
  `creado` date NOT NULL,
  `vendedorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `modelo`, `puertas`, `motor`, `creado`, `vendedorId`) VALUES
(7, 'cronos drive', 123444.00, '', 'El mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculo', 2023, 4, 2, '0000-00-00', 2),
(8, 'Argo drive', 123900.00, '', 'El mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculo', 2024, 5, 2, '0000-00-00', 3),
(9, 'mobi drive', 1200000.00, '', 'El mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculo', 2024, 4, 2, '0000-00-00', 2),
(10, ' argo nuevo1', 12343245.00, '732abae85f6640932d42458fb4374127.jpg', 'argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1argo nuevo1', 2023, 5, 2, '2024-12-27', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
(2, 'Braian', 'Zamudio', '1138117563'),
(3, ' Evelyn', 'Techaira', '1134577467 '),
(4, ' Evelyn', 'Techaira', '1134577467 '),
(5, ' Alejandra', 'Techeira', '1123468722 '),
(6, ' Alejandra', 'Techeira', '1123468722 '),
(7, ' Alejandra', 'Techeira', '1123468722 '),
(8, ' Lilian', 'Techeira', '1124557788 '),
(9, ' Lilian', 'Techeira', '1124557788 '),
(10, ' Lilian', 'Techeira', '1124557788 '),
(11, ' Lilian', 'Techeira', '1124557788 ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedorId` (`vendedorId`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vendedor_FK` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
