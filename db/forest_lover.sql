-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2022 a las 04:19:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `forest_lover`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(3, 'php', '$2y$10$I3DtTw2YCboxclIrNwGxeOpMn.oLfcLh.ajq8jwZ9iKvkFtVFCGmS'),
(4, 'admin', '$2y$10$cxPhDYJOiTpOoWV97HYPzO6C3u10wIEPUypQ7IGVJKFbHpJfkiOU2'),
(5, 'jose', '$2y$10$biMaeru3zhlF6fMWGYS7Yud9NZLlXtFBpQHOcai/of97/vjZ4rQEq'),
(6, 'uwu', '$2y$10$vMzLKQYE4wrlcpvL9L/v3OGUET.4Rtflnaym7IucR78AsFPPXpDrW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
