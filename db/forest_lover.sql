-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2022 a las 03:51:09
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
-- Estructura de tabla para la tabla `bosque`
--

CREATE TABLE `bosque` (
  `id_bosque` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripción` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bosque_especie`
--

CREATE TABLE `bosque_especie` (
  `id_bosque_especie` int(11) NOT NULL,
  `id_bosque` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bosque_etiqueta`
--

CREATE TABLE `bosque_etiqueta` (
  `id_bosque_etiqueta` int(11) NOT NULL,
  `id_bosque` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bosque_imagen`
--

CREATE TABLE `bosque_imagen` (
  `id_bosque_imagen` int(11) NOT NULL,
  `id_bosque` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bosque_like`
--

CREATE TABLE `bosque_like` (
  `id_bosque_like` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_bosque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id_etiqueta` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta_especie`
--

CREATE TABLE `etiqueta_especie` (
  `id_etiqueta_especie` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta_imagen`
--

CREATE TABLE `etiqueta_imagen` (
  `id_etiqueta_imagen` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `fecha_publicacion` datetime NOT NULL DEFAULT current_timestamp(),
  `file` longblob NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_especie`
--

CREATE TABLE `imagen_especie` (
  `id_imagen_especie` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_like`
--

CREATE TABLE `imagen_like` (
  `id_imagen_like` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `fecha_inscripcion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fecha_inscripcion`) VALUES
(3, 'php', '$2y$10$I3DtTw2YCboxclIrNwGxeOpMn.oLfcLh.ajq8jwZ9iKvkFtVFCGmS', '2022-01-16 15:41:00'),
(4, 'admin', '$2y$10$cxPhDYJOiTpOoWV97HYPzO6C3u10wIEPUypQ7IGVJKFbHpJfkiOU2', '2022-01-16 15:41:00'),
(5, 'monaka', 'monaka', '2022-01-16 15:41:00'),
(6, 'uwu', '$2y$10$vMzLKQYE4wrlcpvL9L/v3OGUET.4Rtflnaym7IucR78AsFPPXpDrW', '2022-01-16 15:41:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bosque`
--
ALTER TABLE `bosque`
  ADD PRIMARY KEY (`id_bosque`);

--
-- Indices de la tabla `bosque_especie`
--
ALTER TABLE `bosque_especie`
  ADD PRIMARY KEY (`id_bosque_especie`),
  ADD KEY `id_bosque` (`id_bosque`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Indices de la tabla `bosque_etiqueta`
--
ALTER TABLE `bosque_etiqueta`
  ADD PRIMARY KEY (`id_bosque_etiqueta`),
  ADD KEY `id_bosque` (`id_bosque`),
  ADD KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `bosque_imagen`
--
ALTER TABLE `bosque_imagen`
  ADD PRIMARY KEY (`id_bosque_imagen`),
  ADD KEY `id_bosque` (`id_bosque`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `bosque_like`
--
ALTER TABLE `bosque_like`
  ADD PRIMARY KEY (`id_bosque_like`),
  ADD KEY `id_bosque` (`id_bosque`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_imagen` (`id_imagen`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id_especie`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `etiqueta_especie`
--
ALTER TABLE `etiqueta_especie`
  ADD PRIMARY KEY (`id_etiqueta_especie`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `etiqueta_imagen`
--
ALTER TABLE `etiqueta_imagen`
  ADD PRIMARY KEY (`id_etiqueta_imagen`),
  ADD KEY `id_etiqueta` (`id_etiqueta`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `imagen_especie`
--
ALTER TABLE `imagen_especie`
  ADD PRIMARY KEY (`id_imagen_especie`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `imagen_like`
--
ALTER TABLE `imagen_like`
  ADD PRIMARY KEY (`id_imagen_like`),
  ADD KEY `id_imagen` (`id_imagen`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bosque`
--
ALTER TABLE `bosque`
  MODIFY `id_bosque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bosque_especie`
--
ALTER TABLE `bosque_especie`
  MODIFY `id_bosque_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bosque_etiqueta`
--
ALTER TABLE `bosque_etiqueta`
  MODIFY `id_bosque_etiqueta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bosque_imagen`
--
ALTER TABLE `bosque_imagen`
  MODIFY `id_bosque_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bosque_like`
--
ALTER TABLE `bosque_like`
  MODIFY `id_bosque_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `etiqueta_especie`
--
ALTER TABLE `etiqueta_especie`
  MODIFY `id_etiqueta_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiqueta_imagen`
--
ALTER TABLE `etiqueta_imagen`
  MODIFY `id_etiqueta_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `imagen_especie`
--
ALTER TABLE `imagen_especie`
  MODIFY `id_imagen_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen_like`
--
ALTER TABLE `imagen_like`
  MODIFY `id_imagen_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bosque_especie`
--
ALTER TABLE `bosque_especie`
  ADD CONSTRAINT `bosque_especie_ibfk_1` FOREIGN KEY (`id_bosque`) REFERENCES `bosque` (`id_bosque`),
  ADD CONSTRAINT `bosque_especie_ibfk_2` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`);

--
-- Filtros para la tabla `bosque_etiqueta`
--
ALTER TABLE `bosque_etiqueta`
  ADD CONSTRAINT `bosque_etiqueta_ibfk_1` FOREIGN KEY (`id_bosque`) REFERENCES `bosque` (`id_bosque`),
  ADD CONSTRAINT `bosque_etiqueta_ibfk_2` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id_etiqueta`);

--
-- Filtros para la tabla `bosque_imagen`
--
ALTER TABLE `bosque_imagen`
  ADD CONSTRAINT `bosque_imagen_ibfk_1` FOREIGN KEY (`id_bosque`) REFERENCES `bosque` (`id_bosque`),
  ADD CONSTRAINT `bosque_imagen_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`);

--
-- Filtros para la tabla `bosque_like`
--
ALTER TABLE `bosque_like`
  ADD CONSTRAINT `bosque_like_ibfk_1` FOREIGN KEY (`id_bosque`) REFERENCES `bosque` (`id_bosque`),
  ADD CONSTRAINT `bosque_like_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `etiqueta_especie`
--
ALTER TABLE `etiqueta_especie`
  ADD CONSTRAINT `etiqueta_especie_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`),
  ADD CONSTRAINT `etiqueta_especie_ibfk_2` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id_etiqueta`);

--
-- Filtros para la tabla `etiqueta_imagen`
--
ALTER TABLE `etiqueta_imagen`
  ADD CONSTRAINT `etiqueta_imagen_ibfk_1` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id_etiqueta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etiqueta_imagen_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen_especie`
--
ALTER TABLE `imagen_especie`
  ADD CONSTRAINT `imagen_especie_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id_especie`),
  ADD CONSTRAINT `imagen_especie_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`);

--
-- Filtros para la tabla `imagen_like`
--
ALTER TABLE `imagen_like`
  ADD CONSTRAINT `imagen_like_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imagen_like_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
