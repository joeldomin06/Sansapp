-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2021 a las 18:54:05
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SansApp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificación producto`
--

CREATE TABLE `calificación producto` (
  `Id_producto` int(5) NOT NULL COMMENT 'Identificador del producto',
  `Id_comprador` int(5) NOT NULL COMMENT 'Identificador del comprador',
  `Calificación` float NOT NULL COMMENT 'Calificación otorgado al producto según la satisfacción del comprador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calificación producto`
--

INSERT INTO `calificación producto` (`Id_producto`, `Id_comprador`, `Calificación`) VALUES
(1, 2, 4),
(2, 2, 2),
(3, 2, 3),
(4, 1, 5),
(5, 1, 4),
(6, 1, 5);

--
-- Disparadores `calificación producto`
--
-- Parece que su tabla utiliza disparadores («triggers»);
-- exportar los alias no podría funcionar correctamente en todos los casos.
--
DELIMITER $$
CREATE TRIGGER `Calificando un producto` AFTER INSERT ON `calificación producto` FOR EACH ROW UPDATE `SansApp`.`producto` SET `Calificación_promedio`=(`Calificación_promedio` * `Cantidad_calificación` + `new`.`Calificación`) / (`Cantidad_calificación` + 1), `Cantidad_calificación` = (`Cantidad_calificación` + 1) WHERE `new`.`Id_producto` = `SansApp`.`producto`.`Id_producto`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Cambiando calificación de un producto` AFTER UPDATE ON `calificación producto` FOR EACH ROW UPDATE `SansApp`.`producto` SET `Calificación_promedio`= (`Calificación_promedio` * `Cantidad_calificación` - `old`.`Calificación` + `new`.`Calificación`) / `Cantidad_calificación`  WHERE `old`.`Id_producto` = `SansApp`.`producto`.`Id_producto`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Quitando calificación a un producto` AFTER DELETE ON `calificación producto` FOR EACH ROW UPDATE `SansApp`.`producto` SET `Calificación_promedio`= (`Calificación_promedio` * `Cantidad_calificación` - `old`.`Calificación`) / (`Cantidad_calificación` - 1), `Cantidad_calificación` = (`Cantidad_calificación` - 1) WHERE `old`.`Id_producto` = `SansApp`.`producto`.`Id_producto`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro de compra`
--

CREATE TABLE `carro de compra` (
  `Nro_carro` int(4) NOT NULL COMMENT 'Identificador de cada carro de compra del\r\nusuario',
  `Id_comprador` int(5) NOT NULL COMMENT 'Identificador del comprador',
  `Precio_total_compra` int(8) NOT NULL COMMENT 'Suma de todos los productos en el carro',
  `Lugar_retiro` varchar(50) NOT NULL COMMENT 'Dirección donde se retira el (los) producto (s)',
  `Fecha` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de realización de la compra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carro de compra`
--

INSERT INTO `carro de compra` (`Nro_carro`, `Id_comprador`, `Precio_total_compra`, `Lugar_retiro`, `Fecha`) VALUES
(2, 2, 6000, 'Avenida siempre viva 777', '2021-12-08 12:57:21'),
(4, 1, 10800, 'Pasaje el cordero al palo 3425', '2021-12-08 13:02:09'),
(7, 1, 920000, 'Pasaje el cordero al palo 3425', '2021-12-08 13:54:27'),
(9, 2, 40000, 'Avenida siempre viva 777', '2021-12-08 13:55:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoría`
--

CREATE TABLE `categoría` (
  `Id_categoría` int(3) NOT NULL COMMENT 'Número identificador de la categoría',
  `Nombre` varchar(30) NOT NULL COMMENT 'Nombre de la categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoría`
--

INSERT INTO `categoría` (`Id_categoría`, `Nombre`) VALUES
(1, 'Comida casera'),
(2, 'Comida rápida'),
(3, 'Electrónica'),
(4, 'Ropa invierno'),
(5, 'Bebidas'),
(6, 'Gaming');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `categoría sin producto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `categoría sin producto` (
`id_categoría` int(3)
,`nombre` varchar(30)
,`id_producto` int(5)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprador`
--

CREATE TABLE `comprador` (
  `Id_comprador` int(5) NOT NULL COMMENT 'Identificador del comprador',
  `Rol` varchar(11) NOT NULL COMMENT 'Número identificador de cada alumno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprador`
--

INSERT INTO `comprador` (`Id_comprador`, `Rol`) VALUES
(2, '200000000-0'),
(1, '201973500-4'),
(3, '256742240-0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta producto`
--

CREATE TABLE `etiqueta producto` (
  `Id_categoría` int(3) NOT NULL COMMENT 'Identificador de la categoría',
  `Id_producto` int(5) NOT NULL COMMENT 'Identificador del producto seleccionado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etiqueta producto`
--

INSERT INTO `etiqueta producto` (`Id_categoría`, `Id_producto`) VALUES
(2, 1),
(2, 3),
(2, 5),
(3, 2),
(3, 6),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `historial_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `historial_compras` (
`Rol` varchar(11)
,`Nombre` varchar(30)
,`Nombre_producto` varchar(30)
,`Precio_total` int(7)
,`cantidad_producto` int(10)
,`Fecha_compra` datetime
,`Vendedor` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `historial_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `historial_ventas` (
`Rol` varchar(11)
,`Nombre` varchar(30)
,`Nombre_producto` varchar(30)
,`Precio_total` int(7)
,`cantidad_producto` int(10)
,`Fecha_venta` datetime
,`Comprador` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observación`
--

CREATE TABLE `observación` (
  `Nro_observación` int(3) NOT NULL COMMENT 'Numeración correlativa de comentarios',
  `Id_producto` int(5) NOT NULL COMMENT 'Identificador del producto seleccionado',
  `Comentario` varchar(500) NOT NULL COMMENT 'Observación sobre el producto seleccionado',
  `Fecha_comentario` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que se comenta un producto.',
  `Id_comprador` int(5) NOT NULL COMMENT 'Identificador del comprador que realiza el\r\ncomentario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `observación`
--

INSERT INTO `observación` (`Nro_observación`, `Id_producto`, `Comentario`, `Fecha_comentario`, `Id_comprador`) VALUES
(1, 3, 'estaba un poco seco', '2021-12-08 12:57:57', 2),
(2, 1, 'estaban wenisimas', '2021-12-08 12:58:24', 2),
(3, 1, 'aunque le faltaron un poco de sal', '2021-12-08 12:58:41', 2),
(4, 2, 'ta muy caro', '2021-12-08 12:59:21', 2),
(5, 4, 'hace frio', '2021-12-08 13:03:20', 1),
(6, 5, 'poco cara pero cumple que esta helada', '2021-12-08 13:04:05', 1),
(7, 3, 'como que seco >:|', '2021-12-08 13:05:06', 1),
(8, 6, 'buen tiempo de atencion', '2021-12-08 13:57:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden de compra`
--

CREATE TABLE `orden de compra` (
  `Nro_orden` int(6) NOT NULL COMMENT 'Identificador de la orden de compra',
  `Id_producto` int(5) NOT NULL COMMENT 'Identificador de los producto seleccionado',
  `Nro_carro` int(4) NOT NULL COMMENT 'Identificador de cada carro de compra del\r\nusuario',
  `Cantidad_producto` int(10) NOT NULL COMMENT 'Cantidad del producto comprado',
  `Precio_total_producto` int(7) NOT NULL COMMENT 'Precio de la compra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden de compra`
--

INSERT INTO `orden de compra` (`Nro_orden`, `Id_producto`, `Nro_carro`, `Cantidad_producto`, `Precio_total_producto`) VALUES
(1, 3, 2, 2, 4000),
(2, 1, 2, 2, 2000),
(3, 4, 4, 3, 4500),
(4, 5, 4, 3, 6300),
(5, 6, 7, 2, 920000),
(6, 2, 9, 2, 40000);

--
-- Disparadores `orden de compra`
--
-- Parece que su tabla utiliza disparadores («triggers»);
-- exportar los alias no podría funcionar correctamente en todos los casos.
--
DELIMITER $$
CREATE TRIGGER `Actualizando un producto en una orden de compra` BEFORE UPDATE ON `orden de compra` FOR EACH ROW UPDATE `SansApp`.`Producto` SET `Cantidad_vendida`= (`Cantidad_vendida` - `old`.`Cantidad_producto`) + `new`.`Cantidad_producto`, `Cantidad_actual`= (`Cantidad_actual` + `old`.`Cantidad_producto`) - `new`.`Cantidad_producto` WHERE `old`.`Id_producto` = `SansApp`.`Producto`.`Id_producto`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Añadiendo un producto a una orden de compra` AFTER INSERT ON `orden de compra` FOR EACH ROW UPDATE `SansApp`.`producto` SET `Cantidad_actual`= (`Cantidad_actual`-`new`.`Cantidad_producto`), `Cantidad_vendida`= (`Cantidad_vendida` + `new`.`Cantidad_producto`) WHERE `new`.`Id_producto` = `SansApp`.`producto`.`Id_producto`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Quitando un producto de una orden de compra` BEFORE DELETE ON `orden de compra` FOR EACH ROW UPDATE `SansApp`.`Producto` SET `Cantidad_vendida`= (`Cantidad_vendida` - `old`.`Cantidad_producto`), `Cantidad_actual`= (`Cantidad_actual` + `old`.`Cantidad_producto`) WHERE `old`.`Id_producto` = `SansApp`.`Producto`.`Id_producto`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil` (
`Rol` varchar(11)
,`Nombre` varchar(30)
,`Correo` varchar(40)
,`Contraseña` int(4)
,`Fecha_nacimiento` date
,`Productos_Vendidos` decimal(32,0)
,`Productos_Comprados` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id_producto` int(5) NOT NULL COMMENT 'Identificador del producto',
  `Id_vendedor` int(5) NOT NULL COMMENT 'Identificador del vendedor',
  `Nombre` varchar(30) NOT NULL COMMENT 'Nombre del producto',
  `Precio` int(6) NOT NULL COMMENT 'Precio del producto',
  `Cantidad_actual` int(3) NOT NULL COMMENT 'Cantidad actual disponible del producto',
  `Cantidad_vendida` int(3) NOT NULL COMMENT 'Cantidad vendida del producto',
  `Descripción` varchar(200) NOT NULL COMMENT 'Características del producto',
  `Cantidad_calificación` int(5) NOT NULL COMMENT 'Cantidad de veces que se ha calificado el producto',
  `Calificación_promedio` float NOT NULL COMMENT 'Promedio de las calificaciones del producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id_producto`, `Id_vendedor`, `Nombre`, `Precio`, `Cantidad_actual`, `Cantidad_vendida`, `Descripción`, `Cantidad_calificación`, `Calificación_promedio`) VALUES
(1, 1, 'papas fritas', 1000, 48, 2, 'papas grandes con opcional ketchup o mayo', 1, 4),
(2, 1, 'telefono alcatel', 20000, 0, 2, 'teléfono de segunda mano, con audífonos incluidos', 1, 2),
(3, 1, 'pollo asado', 2000, 58, 2, 'pollo entero', 1, 3),
(4, 2, 'Bufanda', 1500, 17, 3, 'bufanda de lana muy comoda', 1, 5),
(5, 2, 'Bebida Cocacola', 2100, 57, 3, 'bebida coca cola 3L Fría', 1, 4),
(6, 3, 'playstation 4', 460000, 0, 2, 'playstation con 2 mandos', 1, 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `producto por categoría`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `producto por categoría` (
`Id_categoría` int(3)
,`Categoría` varchar(30)
,`Id_producto` int(5)
,`Nombre_vendedor` varchar(30)
,`Nombre` varchar(30)
,`Precio` int(6)
,`Cantidad_actual` int(3)
,`Cantidad_vendida` int(3)
,`Descripción` varchar(200)
,`Calificación_promedio` float
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos en venta del usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos en venta del usuario` (
`Rol` varchar(11)
,`Nombre` varchar(30)
,`Correo` varchar(40)
,`Fecha_nacimiento` date
,`Tipo Productos ofertados` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `top 5 productos calificados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `top 5 productos calificados` (
`Id_producto` int(5)
,`Nombre_vendedor` varchar(30)
,`Nombre` varchar(30)
,`Precio` int(6)
,`Cantidad_actual` int(3)
,`Cantidad_vendida` int(3)
,`Descripción` varchar(200)
,`Calificación_promedio` float
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `top 5 productos vendidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `top 5 productos vendidos` (
`Id_producto` int(5)
,`Nombre_vendedor` varchar(30)
,`Nombre` varchar(30)
,`Precio` int(6)
,`Cantidad_actual` int(3)
,`Cantidad_vendida` int(3)
,`Descripción` varchar(200)
,`Calificación_promedio` float
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `top 5 vendedores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `top 5 vendedores` (
`Rol` varchar(11)
,`Nombre` varchar(30)
,`Correo` varchar(40)
,`Fecha_nacimiento` date
,`Productos_vendidos` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Rol` varchar(11) NOT NULL COMMENT 'Número identificador de cada alumno',
  `Nombre` varchar(30) NOT NULL COMMENT 'Nombre del alumno',
  `Correo` varchar(40) NOT NULL COMMENT 'Medio de comunicación para verificación de\r\ncompraventa',
  `Contraseña` int(4) DEFAULT NULL COMMENT 'Contraseña de la cuenta',
  `Fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento del usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Rol`, `Nombre`, `Correo`, `Contraseña`, `Fecha_nacimiento`) VALUES
('200000000-0', 'Juanito Pérez', 'juan.perez@usm.cl', 1210, '1997-05-08'),
('201973500-4', 'joel dominguez neira', 'joel.dominguez@usm.cl', 1234, '2000-06-19'),
('256742240-0', 'Roberto Cordero', 'robcor@gmail.com', NULL, '1995-11-23');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `nuevo comprador` AFTER INSERT ON `usuario` FOR EACH ROW INSERT INTO `comprador` (`Id_comprador`, `Rol`) VALUES (NULL, `new`.`Rol`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nuevo vendedor` AFTER INSERT ON `usuario` FOR EACH ROW INSERT INTO `vendedor` (`Id_vendedor`, `Rol`) VALUES (NULL, `new`.`Rol`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `Id_vendedor` int(5) NOT NULL COMMENT 'Identificador del vendedor',
  `Rol` varchar(11) NOT NULL COMMENT 'Número identificador de cada alumno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`Id_vendedor`, `Rol`) VALUES
(2, '200000000-0'),
(1, '201973500-4'),
(3, '256742240-0');

-- --------------------------------------------------------

--
-- Estructura para la vista `categoría sin producto`
--
DROP TABLE IF EXISTS `categoría sin producto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `categoría sin producto`  AS SELECT `cat`.`Id_categoría` AS `id_categoría`, `cat`.`Nombre` AS `nombre`, `p`.`Id_producto` AS `id_producto` FROM (`categoría` `cat` join `producto` `p`) WHERE !(`cat`.`Id_categoría` in (select `etiqueta producto`.`Id_categoría` from `etiqueta producto` where `etiqueta producto`.`Id_producto` = `p`.`Id_producto`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `historial_compras`
--
DROP TABLE IF EXISTS `historial_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `historial_compras`  AS SELECT `usu`.`Rol` AS `Rol`, `usu`.`Nombre` AS `Nombre`, `pro`.`Nombre` AS `Nombre_producto`, `ord`.`Precio_total_producto` AS `Precio_total`, `ord`.`Cantidad_producto` AS `cantidad_producto`, `car`.`Fecha` AS `Fecha_compra`, `vende`.`Nombre` AS `Vendedor` FROM ((((((`usuario` `usu` left join `comprador` `com` on(`usu`.`Rol` = `com`.`Rol`)) left join `carro de compra` `car` on(`com`.`Id_comprador` = `car`.`Id_comprador`)) left join `orden de compra` `ord` on(`car`.`Nro_carro` = `ord`.`Nro_carro`)) left join `producto` `pro` on(`ord`.`Id_producto` = `pro`.`Id_producto`)) left join `vendedor` `ven` on(`pro`.`Id_vendedor` = `ven`.`Id_vendedor`)) left join `usuario` `vende` on(`ven`.`Rol` = `vende`.`Rol`)) WHERE `ord`.`Cantidad_producto` is not null ORDER BY `usu`.`Rol` ASC, `car`.`Fecha` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `historial_ventas`
--
DROP TABLE IF EXISTS `historial_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `historial_ventas`  AS SELECT `usu`.`Rol` AS `Rol`, `usu`.`Nombre` AS `Nombre`, `pro`.`Nombre` AS `Nombre_producto`, `ord`.`Precio_total_producto` AS `Precio_total`, `ord`.`Cantidad_producto` AS `cantidad_producto`, `car`.`Fecha` AS `Fecha_venta`, `compra`.`Nombre` AS `Comprador` FROM ((((((`usuario` `usu` left join `vendedor` `ven` on(`usu`.`Rol` = `ven`.`Rol`)) left join `producto` `pro` on(`ven`.`Id_vendedor` = `pro`.`Id_vendedor`)) left join `orden de compra` `ord` on(`pro`.`Id_producto` = `ord`.`Id_producto`)) left join `carro de compra` `car` on(`ord`.`Nro_carro` = `car`.`Nro_carro`)) left join `comprador` `com` on(`car`.`Id_comprador` = `com`.`Id_comprador`)) left join `usuario` `compra` on(`com`.`Rol` = `compra`.`Rol`)) WHERE `ord`.`Cantidad_producto` is not null ORDER BY `usu`.`Rol` ASC, `car`.`Fecha` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil`
--
DROP TABLE IF EXISTS `perfil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil`  AS SELECT `usuario`.`Rol` AS `Rol`, `usuario`.`Nombre` AS `Nombre`, `usuario`.`Correo` AS `Correo`, `usuario`.`Contraseña` AS `Contraseña`, `usuario`.`Fecha_nacimiento` AS `Fecha_nacimiento`, (select sum(`pro`.`Cantidad_vendida`) from (`vendedor` `ven` left join `producto` `pro` on(`ven`.`Id_vendedor` = `pro`.`Id_vendedor`)) where `usuario`.`Rol` = `ven`.`Rol`) AS `Productos_Vendidos`, (select sum(`ord`.`Cantidad_producto`) from ((`comprador` `com` left join `carro de compra` `car` on(`car`.`Id_comprador` = `com`.`Id_comprador`)) left join `orden de compra` `ord` on(`ord`.`Nro_carro` = `car`.`Nro_carro`)) where `usuario`.`Rol` = `com`.`Rol`) AS `Productos_Comprados` FROM `usuario` ORDER BY `usuario`.`Rol` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `producto por categoría`
--
DROP TABLE IF EXISTS `producto por categoría`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `producto por categoría`  AS SELECT `categoría`.`Id_categoría` AS `Id_categoría`, `categoría`.`Nombre` AS `Categoría`, `pro`.`Id_producto` AS `Id_producto`, `usu`.`Nombre` AS `Nombre_vendedor`, `pro`.`Nombre` AS `Nombre`, `pro`.`Precio` AS `Precio`, `pro`.`Cantidad_actual` AS `Cantidad_actual`, `pro`.`Cantidad_vendida` AS `Cantidad_vendida`, `pro`.`Descripción` AS `Descripción`, `pro`.`Calificación_promedio` AS `Calificación_promedio` FROM ((((`categoría` left join `etiqueta producto` `etp` on(`etp`.`Id_categoría` = `categoría`.`Id_categoría`)) left join `producto` `pro` on(`etp`.`Id_producto` = `pro`.`Id_producto`)) left join `vendedor` `ven` on(`pro`.`Id_vendedor` = `ven`.`Id_vendedor`)) left join `usuario` `usu` on(`ven`.`Rol` = `usu`.`Rol`)) WHERE `pro`.`Id_producto` is not null ORDER BY `categoría`.`Nombre` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos en venta del usuario`
--
DROP TABLE IF EXISTS `productos en venta del usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productos en venta del usuario`  AS SELECT `usuario`.`Rol` AS `Rol`, `usuario`.`Nombre` AS `Nombre`, `usuario`.`Correo` AS `Correo`, `usuario`.`Fecha_nacimiento` AS `Fecha_nacimiento`, (select count('Rol') from (`vendedor` join `producto`) where `usuario`.`Rol` = `vendedor`.`Rol` and `vendedor`.`Id_vendedor` = `producto`.`Id_vendedor`) AS `Tipo Productos ofertados` FROM `usuario` ORDER BY (select count('Rol') from (`vendedor` join `producto`) where `usuario`.`Rol` = `vendedor`.`Rol` and `vendedor`.`Id_vendedor` = `producto`.`Id_vendedor`) DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `top 5 productos calificados`
--
DROP TABLE IF EXISTS `top 5 productos calificados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top 5 productos calificados`  AS SELECT `producto`.`Id_producto` AS `Id_producto`, `usu`.`Nombre` AS `Nombre_vendedor`, `producto`.`Nombre` AS `Nombre`, `producto`.`Precio` AS `Precio`, `producto`.`Cantidad_actual` AS `Cantidad_actual`, `producto`.`Cantidad_vendida` AS `Cantidad_vendida`, `producto`.`Descripción` AS `Descripción`, `producto`.`Calificación_promedio` AS `Calificación_promedio` FROM ((`producto` left join `vendedor` `ven` on(`ven`.`Id_vendedor` = `producto`.`Id_vendedor`)) left join `usuario` `usu` on(`ven`.`Rol` = `usu`.`Rol`)) ORDER BY `producto`.`Calificación_promedio` DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `top 5 productos vendidos`
--
DROP TABLE IF EXISTS `top 5 productos vendidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top 5 productos vendidos`  AS SELECT `producto`.`Id_producto` AS `Id_producto`, `usu`.`Nombre` AS `Nombre_vendedor`, `producto`.`Nombre` AS `Nombre`, `producto`.`Precio` AS `Precio`, `producto`.`Cantidad_actual` AS `Cantidad_actual`, `producto`.`Cantidad_vendida` AS `Cantidad_vendida`, `producto`.`Descripción` AS `Descripción`, `producto`.`Calificación_promedio` AS `Calificación_promedio` FROM ((`producto` left join `vendedor` `ven` on(`ven`.`Id_vendedor` = `producto`.`Id_vendedor`)) left join `usuario` `usu` on(`ven`.`Rol` = `usu`.`Rol`)) ORDER BY `producto`.`Cantidad_vendida` DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `top 5 vendedores`
--
DROP TABLE IF EXISTS `top 5 vendedores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top 5 vendedores`  AS SELECT `usuario`.`Rol` AS `Rol`, `usuario`.`Nombre` AS `Nombre`, `usuario`.`Correo` AS `Correo`, `usuario`.`Fecha_nacimiento` AS `Fecha_nacimiento`, (select sum(`pro`.`Cantidad_vendida`) from (`vendedor` `ven` left join `producto` `pro` on(`ven`.`Id_vendedor` = `pro`.`Id_vendedor`)) where `usuario`.`Rol` = `ven`.`Rol`) AS `Productos_vendidos` FROM `usuario` ORDER BY (select sum(`pro`.`Cantidad_vendida`) from (`vendedor` `ven` left join `producto` `pro` on(`ven`.`Id_vendedor` = `pro`.`Id_vendedor`)) where `usuario`.`Rol` = `ven`.`Rol`) DESC LIMIT 0, 5 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificación producto`
--
ALTER TABLE `calificación producto`
  ADD PRIMARY KEY (`Id_producto`,`Id_comprador`),
  ADD KEY `Comentador` (`Id_comprador`);

--
-- Indices de la tabla `carro de compra`
--
ALTER TABLE `carro de compra`
  ADD PRIMARY KEY (`Nro_carro`) USING BTREE,
  ADD KEY `Carro_comprador` (`Id_comprador`);

--
-- Indices de la tabla `categoría`
--
ALTER TABLE `categoría`
  ADD PRIMARY KEY (`Id_categoría`);

--
-- Indices de la tabla `comprador`
--
ALTER TABLE `comprador`
  ADD PRIMARY KEY (`Id_comprador`),
  ADD KEY `Rol` (`Rol`);

--
-- Indices de la tabla `etiqueta producto`
--
ALTER TABLE `etiqueta producto`
  ADD PRIMARY KEY (`Id_categoría`,`Id_producto`) USING BTREE,
  ADD KEY `Etiqueta` (`Id_producto`);

--
-- Indices de la tabla `observación`
--
ALTER TABLE `observación`
  ADD PRIMARY KEY (`Nro_observación`,`Id_producto`),
  ADD KEY `Observación_producto` (`Id_producto`),
  ADD KEY `Comentario_comprador` (`Id_comprador`);

--
-- Indices de la tabla `orden de compra`
--
ALTER TABLE `orden de compra`
  ADD PRIMARY KEY (`Nro_orden`),
  ADD KEY `Orden_carro` (`Nro_carro`),
  ADD KEY `Orden_producto` (`Id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id_producto`),
  ADD KEY `Ofertador` (`Id_vendedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Rol`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`Id_vendedor`),
  ADD KEY `Rol_vendedor` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carro de compra`
--
ALTER TABLE `carro de compra`
  MODIFY `Nro_carro` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada carro de compra del\r\nusuario', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categoría`
--
ALTER TABLE `categoría`
  MODIFY `Id_categoría` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Número identificador de la categoría', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comprador`
--
ALTER TABLE `comprador`
  MODIFY `Id_comprador` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del comprador', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `observación`
--
ALTER TABLE `observación`
  MODIFY `Nro_observación` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Numeración correlativa de comentarios', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orden de compra`
--
ALTER TABLE `orden de compra`
  MODIFY `Nro_orden` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la orden de compra', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id_producto` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del producto', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `Id_vendedor` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del vendedor', AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificación producto`
--
ALTER TABLE `calificación producto`
  ADD CONSTRAINT `Comentado` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`),
  ADD CONSTRAINT `Comentador` FOREIGN KEY (`Id_comprador`) REFERENCES `comprador` (`Id_comprador`);

--
-- Filtros para la tabla `carro de compra`
--
ALTER TABLE `carro de compra`
  ADD CONSTRAINT `Carro_comprador` FOREIGN KEY (`Id_comprador`) REFERENCES `comprador` (`Id_comprador`);

--
-- Filtros para la tabla `comprador`
--
ALTER TABLE `comprador`
  ADD CONSTRAINT `Rol_comprador` FOREIGN KEY (`Rol`) REFERENCES `usuario` (`Rol`);

--
-- Filtros para la tabla `etiqueta producto`
--
ALTER TABLE `etiqueta producto`
  ADD CONSTRAINT `Categoría_etiqueta` FOREIGN KEY (`Id_categoría`) REFERENCES `categoría` (`Id_categoría`),
  ADD CONSTRAINT `Etiqueta` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`);

--
-- Filtros para la tabla `observación`
--
ALTER TABLE `observación`
  ADD CONSTRAINT `Comentario_comprador` FOREIGN KEY (`Id_comprador`) REFERENCES `comprador` (`Id_comprador`),
  ADD CONSTRAINT `Observación_producto` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`);

--
-- Filtros para la tabla `orden de compra`
--
ALTER TABLE `orden de compra`
  ADD CONSTRAINT `Orden_carro` FOREIGN KEY (`Nro_carro`) REFERENCES `carro de compra` (`Nro_carro`),
  ADD CONSTRAINT `Orden_producto` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Ofertador` FOREIGN KEY (`Id_vendedor`) REFERENCES `vendedor` (`Id_vendedor`);

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `Rol_vendedor` FOREIGN KEY (`Rol`) REFERENCES `usuario` (`Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
