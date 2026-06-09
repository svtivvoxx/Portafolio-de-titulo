-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2026 a las 01:42:26
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
-- Base de datos: `panaderia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `fecha`) VALUES
(1, 'Productos ', 'sfnaskfsafasfa', '2026-06-05 16:23:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `orden_compra` varchar(50) NOT NULL,
  `monto` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `orden_compra`, `monto`, `estado`, `fecha`) VALUES
(1, 'OC-10001', 12500, 'Aprobado', '2026-06-05 14:42:08'),
(401139912, 'orden_401139912', 0, 'Pendiente', '2026-06-08 03:15:41'),
(697298015, 'orden_697298015', 0, 'Aprobado', '2026-06-08 03:11:19'),
(998306188, 'orden_998306188', 4200, 'Aprobado', '2026-06-08 03:17:41'),
(1068294462, 'orden_1068294462', 10622, 'Pendiente', '2026-06-08 05:15:58'),
(1239822411, 'orden_1239822411', 17767, 'Pendiente', '2026-06-08 05:38:50'),
(1442243517, 'orden_1442243517', 16767, 'Pendiente', '2026-06-09 03:36:45'),
(1734558632, 'orden_1734558632', 5555, 'Aprobado', '2026-06-08 05:50:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT 'default-pan.jpg',
  `categoria` enum('Sin Gluten','Vegano','Integral') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`) VALUES
(7, 'Soja vegana', NULL, 2222, 'default-pan.jpg', 'Vegano'),
(9, 'Pan de molde 100% integral', NULL, 5555, 'default-pan.jpg', 'Integral'),
(10, 'Pan sin gluten ', NULL, 3000, 'default-pan.jpg', 'Sin Gluten'),
(11, 'Pan integral', NULL, 6990, 'default-pan.jpg', 'Integral'),
(12, 'Pan masa madre sin gluten', NULL, 8990, 'default-pan.jpg', 'Sin Gluten'),
(13, 'Queso vegano', NULL, 7980, 'default-pan.jpg', 'Vegano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` enum('cliente','interno','admin') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `fecha_registro`, `rol`) VALUES
(1, 'Sebastian hernandez', 'Zenxo2002@gmail.com', '$2y$10$ZCR1dqyMohhUw63pOG/yyuFH.d7KXXrP3BE2UgpSuTXYrPo7Wxvae', '2026-05-24 19:55:00', 'cliente'),
(4, 'Administrador Olivia', 'admin@olivia.cl', '$2y$10$NiteNWupZwhy1ftA84XPzOw9.x1aNtkwJnQRerTR9BZNQi3m89Vi6', '2026-06-05 14:08:58', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1734558633;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
