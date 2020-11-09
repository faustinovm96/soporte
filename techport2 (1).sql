-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2020 a las 22:22:35
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techport2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `tipo_persona` varchar(45) DEFAULT NULL,
  `tipo_doc` varchar(45) DEFAULT NULL,
  `nombre_razon_social` varchar(50) DEFAULT NULL,
  `direccion` varchar(65) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `documento`, `tipo_persona`, `tipo_doc`, `nombre_razon_social`, `direccion`, `celular`, `email`) VALUES
(4, '0000000', NULL, NULL, 'Roza Meltrozo', 'Barrio Paranambu Ita', '(0972) 145-369', 'rozamel192@gmail.com'),
(5, '1111111', NULL, NULL, 'Devora Meltrozo', 'Barrio Sportivo', '(0983) 645-214', 'devoram123@gmail.com'),
(6, '2222222', NULL, NULL, 'Francisco Irala', 'Barrio Nuevo amanecer', '(0971) 423-698', 'firala@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_inf`
--

CREATE TABLE `equipos_inf` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `numero_serie` varchar(30) DEFAULT NULL,
  `accesorios` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `id_tecnico` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `problema` text,
  `causas` text,
  `solucion` text,
  `estado` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `descripcion` text,
  `costo` double DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `descripcion`, `costo`, `estado`) VALUES
(13, 'Reinstalación de Sistema Operativo y todos los programas', 200000, NULL),
(14, 'Instalación de Programas Utilitarios', 50000, NULL),
(15, 'Instalación de Paquete Office', 50000, NULL),
(16, 'Configuración de Impresora', 40000, NULL),
(17, 'Recuperación de datos', 400000, NULL),
(18, 'Cambio de display', 300000, NULL),
(19, 'Limpieza de Gabinete', 80000, NULL),
(20, 'Limpieza de notebook', 180000, NULL),
(21, 'Recarga de cartucho de tinta negra 2ml', 30000, NULL),
(22, 'Recarga de tinta de cartucho de negra 4ml', 60000, NULL),
(23, 'Recarga de cartucho de tinta negra 6ml', 90000, NULL),
(24, 'Recarga de cartucho de tinta tricolor 2ml', 35000, NULL),
(25, 'Recarga de cartucho de tinta tricolor 4ml', 70000, NULL),
(26, 'Recarga de cartucho de tinta tricolor 6ml', 95000, NULL),
(27, 'Limpieza de Impresora HP', 70000, NULL),
(28, 'Limpieza de Impresora Epson', 250000, NULL),
(29, 'Limpieza de Impresora Brother', 300000, NULL),
(30, 'Recarga de Toner Ricoh Original', 150000, NULL),
(31, 'Recarga de Toner Toshiba Original', 180000, NULL),
(32, 'Mantenimiento general de Fotocopiadora Ricoh', 300000, NULL),
(33, 'Mantenimiento general de fotocopiadora toshiba', 400000, NULL),
(34, 'Reparación de puertos', 200000, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_tec`
--

CREATE TABLE `soporte_tec` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `causas` text,
  `solucion` text,
  `estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `soporte_tec`
--

INSERT INTO `soporte_tec` (`id`, `id_pedido`, `causas`, `solucion`, `estado`) VALUES
(1, 8, 'Bateria muerta', 'Cambiar Cooler', 'Terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id` int(11) NOT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `perfil` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `ultimo_login` timestamp NULL DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `documento`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha_registro`) VALUES
(1, '5555555', 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', NULL, 1, '2020-11-08 17:49:59', NULL),
(3, '0000000', 'Luis Alberto Torres', 'luis', '$2a$07$asxx54ahjppf45sd87a5auwx8lyuZ.kds4dac831wJ6GwzvInb.wG', 'Administrador', '', 1, NULL, NULL),
(4, '0000000', 'Ariel Paredes', 'ariel', '$2a$07$asxx54ahjppf45sd87a5au9lEeMRfIlOWY2TMKKaGQNt7t8IazUBW', 'Administrador', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `productos` text,
  `impuesto` float DEFAULT NULL,
  `neto` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `metodo_pago` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos_inf`
--
ALTER TABLE `equipos_inf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipos_informaticos_clientes1_idx` (`id_cliente`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_clientes1_idx` (`id_cliente`),
  ADD KEY `fk_pedidos_usuarios1_idx` (`id_usuario`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte_tec`
--
ALTER TABLE `soporte_tec`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ventas_clientes1_idx` (`id_cliente`),
  ADD KEY `fk_ventas_usuarios1_idx` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `equipos_inf`
--
ALTER TABLE `equipos_inf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `soporte_tec`
--
ALTER TABLE `soporte_tec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos_inf`
--
ALTER TABLE `equipos_inf`
  ADD CONSTRAINT `fk_equipos_informaticos_clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedidos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuarios1` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
