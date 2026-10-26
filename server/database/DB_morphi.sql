-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2026 a las 15:11:56
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
-- Base de datos: `sistemas_operativos_clase_30_morphi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `bebidasID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ordenes`
--

CREATE TABLE `detalle_ordenes` (
  `detalle_ordenesID` int(11) NOT NULL,
  `entradasID` int(11) NOT NULL,
  `platos_principalesID` int(11) NOT NULL,
  `bebidasID` int(11) NOT NULL,
  `postresID` int(11) NOT NULL,
  `total` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `entradasID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `mesasID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos_principales`
--

CREATE TABLE `platos_principales` (
  `platos_principalesID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postres`
--

CREATE TABLE `postres` (
  `postresID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rolesID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rolesID`, `nombre`, `descripcion`) VALUES
(1, 'Mozo', 'Persona que atiende a los clientes y recibe ordenes'),
(2, 'Chef', 'Persona que ve las ordenes, cocina y termina ordenes'),
(3, 'Admin', 'Persona que puede crear editar y eliminar productos del menu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuariosID` int(11) NOT NULL,
  `rolesID` int(11) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuariosID`, `rolesID`, `clave`) VALUES
(1, 1, '$2y$10$NtPLS4eEUOyJ7HzIio0oR.TErqjHLRu4TnEonCxnY7W3Tw2CkrPy2'),
(2, 2, '$2y$10$R.QK9IF2.ZcoaZBlHv8NOODgHYiHuJ/38VXXBD6vsVhenHwCKLLE2'),
(3, 3, '$2y$10$DGqM2vuP7P4CANycZ.CQc.PW3BMnMEt2uVtCIG4hGVyvLLGwpOHGC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`bebidasID`);

--
-- Indices de la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  ADD PRIMARY KEY (`detalle_ordenesID`),
  ADD KEY `entradasID` (`entradasID`),
  ADD KEY `platos_principalesID` (`platos_principalesID`),
  ADD KEY `bebidasID` (`bebidasID`),
  ADD KEY `postresID` (`postresID`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`entradasID`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`mesasID`);

--
-- Indices de la tabla `platos_principales`
--
ALTER TABLE `platos_principales`
  ADD PRIMARY KEY (`platos_principalesID`);

--
-- Indices de la tabla `postres`
--
ALTER TABLE `postres`
  ADD PRIMARY KEY (`postresID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rolesID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuariosID`),
  ADD KEY `rolesID` (`rolesID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `bebidasID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  MODIFY `detalle_ordenesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `entradasID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `mesasID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos_principales`
--
ALTER TABLE `platos_principales`
  MODIFY `platos_principalesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postres`
--
ALTER TABLE `postres`
  MODIFY `postresID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rolesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuariosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  ADD CONSTRAINT `detalle_ordenes_ibfk_1` FOREIGN KEY (`entradasID`) REFERENCES `entradas` (`entradasID`),
  ADD CONSTRAINT `detalle_ordenes_ibfk_2` FOREIGN KEY (`platos_principalesID`) REFERENCES `platos_principales` (`platos_principalesID`),
  ADD CONSTRAINT `detalle_ordenes_ibfk_3` FOREIGN KEY (`bebidasID`) REFERENCES `bebidas` (`bebidasID`),
  ADD CONSTRAINT `detalle_ordenes_ibfk_4` FOREIGN KEY (`postresID`) REFERENCES `postres` (`postresID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolesID`) REFERENCES `roles` (`rolesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
