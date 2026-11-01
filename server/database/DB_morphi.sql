-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2026 a las 16:39:58
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

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`bebidasID`, `nombre`, `precio`, `cantidad`, `descripcion`, `imagen`) VALUES
(1, 'Coca-Cola', 3000, 100, 'Gaseosa de cola.', 'cocacola.jpeg'),
(2, 'Sprite', 3000, 85, 'Gaseosa de lima-limón.', 'sprite.jpeg'),
(3, 'Fanta', 3000, 75, 'Gaseosa de naranja.', 'fanta.jpeg'),
(4, 'Agua', 2500, 100, 'Agua sin gas y con gas.', 'agua.jpeg'),
(5, 'Limonada', 3500, 60, 'Jugo sabor limón con jengibre y menta.', 'limonada.avif'),
(6, 'Caffè Espresso', 2500, 95, 'Café italiano corto e intenso.', 'cafe-espreso.jpeg'),
(7, 'Cappuccino', 3800, 80, 'Espresso con leche vaporizada y espuma.', 'capuccino.jpeg'),
(8, 'Aperol Spritz', 8500, 65, 'Aperol, prosecco y soda con rodaja de naranja.', 'aperol.jpeg'),
(9, 'Bellini', 8000, 30, 'Prosecco con puré de durazno.', 'bellini.jpeg'),
(10, 'Campari', 7500, 45, 'Aperitivo amargo de color rojo intenso.', 'campari.jpeg'),
(11, 'Amaretto', 6000, 50, 'Licor dulce de almendras.', 'amaretto.webp'),
(12, 'Chianti', 12000, 20, 'Vino tinto de la Toscana.', 'chianti.webp');

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
  `total` int(10) UNSIGNED NOT NULL,
  `especificaciones` varchar(255) DEFAULT NULL
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

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`entradasID`, `nombre`, `precio`, `cantidad`, `descripcion`, `imagen`) VALUES
(1, 'Prosciutto e Melone', 8500, 45, 'Jamón crudo curado con melón fresco.', 'jamon&melon.jpeg'),
(2, 'Bruschetta', 5000, 80, 'Pan tostado con tomate, albahaca, ajo y aceite de oliva.', 'bruchetta.webp'),
(3, 'Carpaccio di Manzo', 11000, 30, 'Finas láminas de carne cruda con rúcula, parmesano y limón.', 'carpaccio.jpeg'),
(4, 'Arancini', 6500, 60, 'Bolitas de arroz rellenas de queso, empanadas y fritas.', 'arancini.jpeg'),
(5, 'Burrata', 9500, 25, 'Queso cremoso con tomates cherry y albahaca.', 'burrata.jpeg'),
(6, 'Antipasto Misto', 12000, 40, 'Tabla de jamón crudo, salame, quesos y aceitunas.', 'antipasto.jpeg'),
(7, 'Minestrone', 5500, 55, 'Sopa de verduras con legumbres y pasta pequeña.', 'minestrone.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `mesasID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`mesasID`, `nombre`, `estado`) VALUES
(1, 'Mesa 1', 1),
(2, 'Mesa 2', 1),
(3, 'Mesa 3', 1),
(4, 'Mesa 4', 1),
(5, 'Mesa 5', 1),
(6, 'Mesa 6', 1),
(7, 'Mesa 7', 1),
(8, 'Mesa 8', 1),
(9, 'Mesa 9', 1),
(10, 'Mesa 10', 1),
(11, 'Mesa 11', 1),
(12, 'Mesa 12', 1),
(13, 'Mesa 13', 1),
(14, 'Mesa 14', 1),
(15, 'Mesa 15', 1),
(16, 'Mesa 16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `ordenesID` int(11) NOT NULL,
  `detalle_ordenesID` int(11) NOT NULL,
  `mesasID` int(11) NOT NULL
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

--
-- Volcado de datos para la tabla `platos_principales`
--

INSERT INTO `platos_principales` (`platos_principalesID`, `nombre`, `precio`, `cantidad`, `descripcion`, `imagen`) VALUES
(1, 'Pizza Margherita', 13000, 90, 'Salsa de tomate, mozzarella y albahaca fresca.', 'margarita-pizza.webp'),
(2, 'Lasagna alla Bolognese', 16000, 50, 'Capas de pasta, ragú de carne, bechamel y queso gratinado.', 'lasagnea.jpeg'),
(3, 'Risotto alla Milanese', 15000, 35, 'Arroz cremoso con azafrán, manteca y parmesano.', 'risotto.jpeg'),
(4, 'Penne all\'Arrabbiata', 12500, 70, 'Penne con salsa de tomate picante, ajo y perejil.', 'fideos-penne.jpeg'),
(5, 'Ravioli de Ricota y Espinaca', 14000, 45, 'Pasta rellena de ricota y espinaca con salsa de manteca y salvia.', 'ravioles-espinaca.jpeg'),
(6, 'Fettuccine Alfredo', 14500, 60, 'Fettuccine con crema, manteca y parmesano.', 'fetuchini.jpeg'),
(7, 'Osso Buco alla Milanese', 22000, 15, 'Jarrete de ternera estofado con verduras y vino blanco.', 'osobuco.jpeg'),
(8, 'Pollo alla Parmigiana', 15500, 40, 'Pechuga empanada con salsa de tomate y mozzarella gratinada.', 'milanesa.avif');

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

--
-- Volcado de datos para la tabla `postres`
--

INSERT INTO `postres` (`postresID`, `nombre`, `precio`, `cantidad`, `descripcion`, `imagen`) VALUES
(1, 'Tiramisù', 6500, 55, 'Vainillas con café, crema de mascarpone y cacao.', 'tiramisu.jpeg'),
(2, 'Panna Cotta', 6000, 40, 'Crema cocida de leche y vainilla con salsa de frutos rojos.', 'panna-cotta.webp'),
(3, 'Cannoli Siciliani', 7000, 35, 'Tubos de masa crocante rellenos de crema de ricota.', 'cannolini.jpeg'),
(4, 'Gelato', 4500, 80, 'Helado artesanal italiano en distintos sabores.', 'gelato.jpeg'),
(5, 'Affogato', 5500, 25, 'Helado de vainilla con un espresso caliente por encima.', 'affogato.jpeg'),
(6, 'Zabaglione', 6800, 15, 'Crema tibia de yemas, azúcar y vino Marsala.', 'zabaglione.jpeg');

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
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`ordenesID`),
  ADD KEY `detalle_ordenesID` (`detalle_ordenesID`),
  ADD KEY `mesasID` (`mesasID`);

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
  MODIFY `bebidasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  MODIFY `detalle_ordenesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `entradasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `mesasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `ordenesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos_principales`
--
ALTER TABLE `platos_principales`
  MODIFY `platos_principalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `postres`
--
ALTER TABLE `postres`
  MODIFY `postresID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`detalle_ordenesID`) REFERENCES `detalle_ordenes` (`detalle_ordenesID`),
  ADD CONSTRAINT `ordenes_ibfk_2` FOREIGN KEY (`mesasID`) REFERENCES `mesas` (`mesasID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolesID`) REFERENCES `roles` (`rolesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
