-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2024 a las 18:31:40
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
-- Base de datos: `bienesraices_crud`
--
CREATE DATABASE IF NOT EXISTS `bienesraices_crud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bienesraices_crud`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `banio` int(11) NOT NULL,
  `estacionamiento` int(11) NOT NULL,
  `creado` date NOT NULL,
  `vendedorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `banio`, `estacionamiento`, `creado`, `vendedorId`) VALUES
(14, 'Casa en el bosque', 15000000.00, '91722bdce801f18c2577b05b338a43f0.jpg', 'Casa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosqueCasa en el bosque', 3, 2, 1, '0000-00-00', 1),
(15, 'casa en la playa', 130000.00, '59c66c1c7101838e6d5d66e8190fa146.jpg', 'casa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playacasa en la playa', 4, 3, 2, '0000-00-00', 2),
(16, 'Casa ', 12000000.00, 'f410d5ee37c46d438f8a82137910b8b3.jpg', 'Casa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa GrandeCasa Grande', 4, 3, 2, '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'correo@correo.com', '$2y$10$zdvCfk3lv5KP5xOD3GEqO.Eq1zqzui6WrwBUc8IXn3splfgWhltum'),
(2, 'correo@correo.com', '$2y$10$L23tt4myvoSUXHE/3z2p6.Vi5gYCcviZBn2d3Hgn/A2.kkmFPuxoW'),
(3, 'correo@correo.com', '$2y$10$.oCRh3VL80RFbjhz2P5gwOjsDOuiNrD6CEBZw1I7frbCv3aHe94OC');

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
(1, 'Natt', 'Techeira', '123456789'),
(2, 'Braian', 'Zamudio', '987654321');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedorId` (`vendedorId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `vendedor_FK` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
