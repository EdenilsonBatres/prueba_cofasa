-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2023 a las 08:25:23
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_carnaval`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `estatus`) VALUES
(1, 'Uno', 1),
(2, 'Dos', 1),
(3, 'Tres', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `direccion`, `fecha_nacimiento`, `telefono`, `email`, `id_categoria`, `estatus`) VALUES
(2, 'test', 'TestUno', 'san francisco', '2023-03-02', 22331122, 'test@test.com', 1, 1),
(3, 'Maira', 'Mejia', 'con san francisco, Sonsonate', '1999-06-16', 7323, 'maira@gmai.com', 3, 0),
(4, 'Esperanza', 'Martinez', 'colonia las lomas', '2001-01-06', 22113232, 'esperanza@gmail.com', 2, 1),
(5, 'mariza', 'Reyes', 'san jose', '2023-03-02', 77992211, 'mari@rey.com', 2, 0),
(6, 'Maria', 'Sanchez', 'alemania', '2023-02-26', 72721222, 'mari@sanc.com', 3, 1),
(7, 'test', 'TestUno', 'san francisco', '2023-03-02', 22331122, 'test@test.com', 1, 1),
(8, 'test', 'TestUno', 'san francisco', '2023-03-02', 22331122, 'test@test.com', 1, 0),
(9, 'wendy', 'segura', 'sonsonate', '2023-02-28', 72729999, 'wen@sec.com', 3, 1),
(10, 'Maira', 'Alvarenga', 'sonsonate', '2023-02-26', 78999912, 'mari@alv.com', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `num_factura` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`num_factura`, `id_cliente`, `fecha`, `estatus`) VALUES
(1, 4, '2023-03-11', 0),
(2, 6, '2023-03-08', 1),
(3, 10, '2023-03-03', 1),
(4, 9, '2023-02-28', 0),
(5, 4, '2023-03-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `stock`, `estatus`) VALUES
(1, 'maiz', '32.00', 12, 0),
(2, 'Arroz', '16.00', 2, 1),
(3, 'manzanas', '600.00', 20, 1),
(4, 'peras', '600.00', 1000, 1),
(5, 'sandias', '700.00', 10500, 1),
(6, 'uvas verdes', '600.00', 10000, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_cliente_categoria` (`id_categoria`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_producto` (`id_producto`),
  ADD KEY `fk_detalle_factura` (`id_factura`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`num_factura`),
  ADD KEY `fk_factura_cliente` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `num_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `fk_detalle_factura` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`num_factura`),
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
