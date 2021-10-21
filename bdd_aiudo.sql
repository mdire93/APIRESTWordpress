-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 20:33:01
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdd_aiudo`
--
CREATE DATABASE IF NOT EXISTS `bdd_aiudo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdd_aiudo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `usuario` varchar(500) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `apellidos` varchar(500) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `credencial` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario`, `nombre`, `apellidos`, `pass`, `credencial`) VALUES
(1, 'mdire', 'Míriam', 'Díaz Redondo', 'a5fc07e5a4aeb84f12a6046f5facf41c', '1b2ab6644b3ad67bdd1f35e6774f1700'),
(2, 'pep', 'Pepe', 'Díaz', 'a5fc07e5a4aeb84f12a6046f5facf41c', 'e885d567f57b0f87333c25f7f3a1e381');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacliente`
--

CREATE TABLE `cuentacliente` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentacliente`
--

INSERT INTO `cuentacliente` (`id`, `id_cliente`, `id_cuenta`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 3),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `cuenta` varchar(500) NOT NULL,
  `titular` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `cuenta`, `titular`) VALUES
(1, 'dfN7564d65465fs4d564f56s', 1),
(2, 'gfhg455644fgh846545g4f6', 1),
(3, 'ghjfg4r8rrrrrrrrd454f6g46d4f5gdfc', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpagos`
--

CREATE TABLE `historialpagos` (
  `id` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `id_cuentacliente` int(11) NOT NULL,
  `cantidad` varchar(500) NOT NULL,
  `fecha` varchar(500) NOT NULL,
  `operacion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historialpagos`
--

INSERT INTO `historialpagos` (`id`, `id_cuenta`, `id_cuentacliente`, `cantidad`, `fecha`, `operacion`) VALUES
(40, 1, 1, '2.5045,5', '21-10-2021 06:32:26', 'Ingreso'),
(41, 1, 1, '2.5045,5', '21-10-2021 06:38:04', 'Ingreso'),
(42, 1, 1, '2.5045,5', '21-10-2021 06:38:49', 'Ingreso'),
(43, 1, 1, '23.399,33', '21-10-2021 08:32:16', 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamocliente`
--

CREATE TABLE `prestamocliente` (
  `id` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamocliente`
--

INSERT INTO `prestamocliente` (`id`, `id_prestamo`, `id_cliente`) VALUES
(31, 1, 2),
(32, 1, 1),
(33, 2, 2),
(34, 2, 1),
(35, 2, 1),
(36, 2, 1),
(37, 2, 1),
(38, 2, 1),
(39, 1, 1),
(40, 1, 1),
(41, 1, 1),
(42, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `cantidad` varchar(500) NOT NULL,
  `tae` varchar(500) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `duracion` varchar(500) NOT NULL,
  `devolver` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `cantidad`, `tae`, `nombre`, `duracion`, `devolver`) VALUES
(1, '2.5045,5', '4.36 %', 'Préstamo reformas de hogar', '2 años', '3.162,15€'),
(2, '10.561,5', '5.14 %', 'Préstamo coche eléctrico', '2 años y 2 meses', '23.399,33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentacliente`
--
ALTER TABLE `cuentacliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titular` (`titular`);

--
-- Indices de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuentacliente` (`id_cuentacliente`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `prestamocliente`
--
ALTER TABLE `prestamocliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuentacliente`
--
ALTER TABLE `cuentacliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `prestamocliente`
--
ALTER TABLE `prestamocliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentacliente`
--
ALTER TABLE `cuentacliente`
  ADD CONSTRAINT `cuentacliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuentacliente_ibfk_2` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`titular`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD CONSTRAINT `historialpagos_ibfk_1` FOREIGN KEY (`id_cuentacliente`) REFERENCES `cuentacliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `historialpagos_ibfk_2` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamocliente`
--
ALTER TABLE `prestamocliente`
  ADD CONSTRAINT `prestamocliente_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamocliente_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
