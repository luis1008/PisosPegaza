-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2018 a las 10:01:34
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `azulejos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_compra`
--

CREATE TABLE `abono_compra` (
  `id_abono` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `ab_numero` int(2) NOT NULL DEFAULT '0',
  `ab_abono` double(7,2) NOT NULL DEFAULT '0.00',
  `ab_pago` varchar(100) NOT NULL DEFAULT 'CAJA',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_pedido`
--

CREATE TABLE `abono_pedido` (
  `id_abono_pedido` int(11) NOT NULL,
  `ap_abono` double(7,2) NOT NULL DEFAULT '0.00',
  `ap_numero` int(2) NOT NULL DEFAULT '0',
  `pedido_id` int(11) NOT NULL DEFAULT '0',
  `ap_pago` varchar(100) NOT NULL DEFAULT 'CAJA',
  `ap_no_cheque` varchar(50) NOT NULL DEFAULT '0',
  `ap_status_cheque` enum('VERIFICANDO','NINGUNO','APROBADO','REACHAZADO') DEFAULT 'NINGUNO',
  `ap_folio` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `abono_pedido`
--

INSERT INTO `abono_pedido` (`id_abono_pedido`, `ap_abono`, `ap_numero`, `pedido_id`, `ap_pago`, `ap_no_cheque`, `ap_status_cheque`, `ap_folio`, `created_at`, `updated_at`) VALUES
(1, 0.00, 1, 1, 'EFECTIVO', '0', 'NINGUNO', '0', '2018-07-29', '2018-07-29'),
(2, 50.00, 2, 1, 'CHEQUE', '0', 'NINGUNO', '0', '2018-07-29', '2018-07-29'),
(3, 0.00, 1, 2, 'EFECTIVO', '0', 'NINGUNO', '1', '2018-07-29', '2018-07-29'),
(4, 400.00, 2, 2, 'CHEQUE', '0', 'NINGUNO', '1', '2018-07-29', '2018-07-29'),
(5, 500.00, 3, 2, 'CHEQUE', '4698', 'NINGUNO', '1', '2018-07-29', '2018-07-29'),
(6, 0.00, 1, 3, 'EFECTIVO', '0', 'NINGUNO', '2', '2018-07-29', '2018-07-29'),
(7, 1000.00, 2, 3, 'EFECTIVO', '', 'NINGUNO', '2', '2018-07-29', '2018-07-29'),
(8, 0.00, 1, 4, 'EFECTIVO', '0', 'NINGUNO', '3', '2018-09-18', '2018-09-18'),
(9, 0.00, 1, 5, 'EFECTIVO', '0', 'NINGUNO', '4', '2018-09-18', '2018-09-18'),
(10, 250.00, 3, 3, 'EFECTIVO', '', 'NINGUNO', '2', '2018-09-18', '2018-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_prestamo`
--

CREATE TABLE `abono_prestamo` (
  `id_ab_prestamo` int(11) NOT NULL,
  `ab_abono` double(6,3) NOT NULL DEFAULT '0.000',
  `ab_pago` varchar(100) NOT NULL DEFAULT 'CAJA',
  `ab_numero` int(2) NOT NULL DEFAULT '0',
  `prestamo_id` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_gastos`
--

CREATE TABLE `catalogo_gastos` (
  `id_cat_gastos` int(11) NOT NULL,
  `catga_gastos` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `catga_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `catalogo_gastos`
--

INSERT INTO `catalogo_gastos` (`id_cat_gastos`, `catga_gastos`, `catga_status`, `created_at`, `updated_at`) VALUES
(1, 'LUZ', 1, '2018-06-06 16:21:00', '2018-06-06 16:21:00'),
(2, 'GASOLINA', 1, '2018-06-06 16:21:12', '2018-06-06 16:21:12'),
(3, 'AGUA', 1, '2018-06-06 16:21:19', '2018-06-06 16:21:19'),
(4, 'COMIDA', 1, '2018-06-06 16:21:27', '2018-06-06 16:21:27'),
(5, 'TELEFONO', 1, '2018-09-18 02:09:12', '2018-09-18 02:09:12'),
(6, 'PAPELERIA', 1, '2018-09-18 02:10:39', '2018-09-18 02:10:39'),
(7, 'TONER', 1, '2018-09-18 02:11:49', '2018-09-18 02:11:49'),
(8, 'MANTENIMIENTO', 1, '2018-09-18 02:14:13', '2018-09-18 02:14:13'),
(9, 'MECANICO', 1, '2018-09-18 02:15:06', '2018-09-18 02:15:06'),
(10, 'GASTO 3', 1, '2018-09-18 02:15:55', '2018-09-18 02:15:55'),
(11, 'GASTO 4', 1, '2018-09-18 02:20:22', '2018-09-18 02:20:22'),
(12, 'GASTO 5', 1, '2018-09-18 02:25:21', '2018-09-18 02:25:21'),
(13, 'GASTO 6', 1, '2018-09-18 02:26:07', '2018-09-18 02:26:07'),
(14, 'GASTO 7', 1, '2018-09-18 02:26:34', '2018-09-18 02:26:34'),
(15, 'GASTO 8', 1, '2018-09-18 02:27:21', '2018-09-18 02:27:21'),
(16, 'GASTO 9', 1, '2018-09-18 02:34:09', '2018-09-18 02:34:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cl_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `cl_rfc` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cl_observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `cl_correo` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cl_telefono` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cl_nombre_contacto` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cl_nombre_dueno` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cl_forma_pago` enum('EFECTIVO','CHEQUE','DEPOSITO','TRANSFERENCIA') COLLATE utf8_unicode_ci NOT NULL,
  `cl_tipo_cliente` enum('NORMAL','RIGUROSO') COLLATE utf8_unicode_ci NOT NULL,
  `cl_termino_credito` enum('CONTADO','1 DIA','1 SEMANA','1 MES','1 BIMESTRE','1 TRIMESTRE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CONTADO',
  `cl_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cl_nombre`, `cl_rfc`, `cl_observacion`, `cl_correo`, `cl_telefono`, `cl_nombre_contacto`, `cl_nombre_dueno`, `cl_forma_pago`, `cl_tipo_cliente`, `cl_termino_credito`, `cl_status`, `created_at`, `updated_at`) VALUES
(1, 'ABEL CHAVEZ CERVANTES', 'ELDV0965', 'NO HAY OBSERVACIONES', 'abel.chavez@gmail.com', '3141905632', 'ABEL CHAVEZ CERVANTES', 'ABEL CHAVEZ CERVANTES', 'EFECTIVO', 'NORMAL', 'CONTADO', 1, '2018-06-06 16:24:34', '2018-06-06 16:24:34'),
(2, 'ALONSO GUEDEA MENDEZ', 'ALGM101093AN5', 'NO HAY OBSERVACIONES', 'alonso.guedea@gmail.com', '3121149087', 'ALONSO GUEDEA MENDEZ', 'ALONSO GUEDEA MENDEZ', 'EFECTIVO', 'NORMAL', '1 MES', 1, '2018-09-18 00:13:36', '2018-09-18 00:13:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL DEFAULT '0',
  `cm_pago` enum('CONTADO','CREDITO') NOT NULL DEFAULT 'CONTADO',
  `cm_status` enum('PENDIENTE','PAGADO','ABONADO') NOT NULL DEFAULT 'PENDIENTE',
  `cm_bodega` tinyint(1) NOT NULL DEFAULT '0',
  `empleado_id` int(11) NOT NULL,
  `cm_num_entrada` varchar(100) NOT NULL,
  `cm_termino` enum('CONTADO','1 DIA','1 SEMANA','1 MES','1 BIMESTRE','1 TRIMESTRE') NOT NULL DEFAULT 'CONTADO',
  `cm_movimiento` tinyint(1) NOT NULL DEFAULT '0',
  `cm_proveedor` tinyint(1) NOT NULL DEFAULT '0',
  `cm_nota` varchar(100) NOT NULL,
  `cm_tipo` enum('MATERIA PRIMA','GASTOS') NOT NULL DEFAULT 'GASTOS',
  `cm_total` double(7,2) NOT NULL DEFAULT '0.00',
  `cm_total_abonado` double(7,2) NOT NULL DEFAULT '0.00',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `proveedor_id`, `cm_pago`, `cm_status`, `cm_bodega`, `empleado_id`, `cm_num_entrada`, `cm_termino`, `cm_movimiento`, `cm_proveedor`, `cm_nota`, `cm_tipo`, `cm_total`, `cm_total_abonado`, `created_at`, `updated_at`) VALUES
(1, 1, 'CREDITO', 'PENDIENTE', 1, 1, '123', '1 MES', 0, 1, '1', 'MATERIA PRIMA', 600.00, 0.00, '2018-07-05', '2018-07-05'),
(2, 1, 'CREDITO', 'PENDIENTE', 0, 0, '', '1 MES', 0, 1, '2', '', 10000.00, 0.00, '2018-07-05', '2018-07-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_mp`
--

CREATE TABLE `compra_mp` (
  `id_detalle` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `det_cantidad` double(7,3) NOT NULL DEFAULT '0.000',
  `det_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_subtotal` double(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra_mp`
--

INSERT INTO `compra_mp` (`id_detalle`, `compra_id`, `mp_id`, `det_cantidad`, `det_precio`, `det_subtotal`) VALUES
(1, 1, 2, 4.500, 120.00, 600.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `id_detalle` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_subtotal` double(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id_detalle`, `compra_id`, `producto_id`, `det_cantidad`, `det_precio`, `det_subtotal`) VALUES
(1, 2, 4, 10, 1000.00, 10000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `cn_nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `cn_telefono` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cn_status` tinyint(1) NOT NULL DEFAULT '1',
  `proveedor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `cn_nombre`, `cn_telefono`, `cn_status`, `proveedor_id`, `created_at`, `updated_at`) VALUES
(1, 'CESAR RAMOS BRIZUELA', '330987', 1, 1, '2018-06-06 16:05:03', '2018-06-06 16:05:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `cont_fecha_inicio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cont_fecha_fin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_caja`
--

CREATE TABLE `corte_caja` (
  `id_corte` int(11) NOT NULL,
  `crt_ingresos` double(6,3) NOT NULL DEFAULT '0.000',
  `crt_egresos` double(6,3) NOT NULL DEFAULT '0.000',
  `crt_saldo` double(6,3) NOT NULL DEFAULT '0.000',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id_cuentas` int(11) NOT NULL,
  `ct_nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ct_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cuentas`, `ct_nombre`, `ct_status`, `created_at`, `updated_at`) VALUES
(1, 'BANCO', 1, '2018-06-06 16:21:37', '2018-06-06 16:21:37'),
(2, 'CAJA', 1, '2018-06-06 16:21:43', '2018-06-06 16:21:43'),
(3, 'CHEQUE', 1, '2018-06-06 16:21:51', '2018-06-06 16:21:51'),
(4, 'VIAJES', 1, '2018-06-06 16:21:57', '2018-06-06 16:21:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_movimientos`
--

CREATE TABLE `detalle_movimientos` (
  `id_concepto` int(11) NOT NULL,
  `movimiento_temporal_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL DEFAULT '0',
  `ct_concepto` varchar(50) DEFAULT NULL,
  `ct_gasto` double(6,2) NOT NULL DEFAULT '0.00',
  `ct_nota` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_det_pedido` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL DEFAULT '0',
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `pegaza_id` int(11) NOT NULL DEFAULT '0',
  `det_prod_cantidad` int(4) NOT NULL DEFAULT '0',
  `det_prod_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_prod_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  `det_prod_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_det_pedido`, `pedido_id`, `producto_id`, `pegaza_id`, `det_prod_cantidad`, `det_prod_precio`, `det_prod_subtotal`, `det_prod_status`) VALUES
(1, 1, 6, 0, 10, 5.00, 50.00, 1),
(2, 2, 3, 0, 5, 280.00, 1400.00, 1),
(3, 3, 2, 0, 5, 250.00, 1250.00, 1),
(4, 4, 6, 0, 5, 150.00, 750.00, 1),
(5, 5, 2, 0, 5, 250.00, 1250.00, 1);

--
-- Disparadores `detalle_pedido`
--
DELIMITER $$
CREATE TRIGGER `Restar_Stock_Producto` AFTER INSERT ON `detalle_pedido` FOR EACH ROW BEGIN
Update inventario
set inventario.in_cantidad = inventario.in_cantidad - NEW.det_prod_cantidad
where inventario.producto_id = NEW.producto_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_produccion`
--

CREATE TABLE `detalle_produccion` (
  `id_detalle` int(11) NOT NULL,
  `produccion_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_produccion`
--

INSERT INTO `detalle_produccion` (`id_detalle`, `produccion_id`, `pedido_id`) VALUES
(1, 1, 3),
(2, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_requisitos`
--

CREATE TABLE `detalle_requisitos` (
  `id_detalle` int(11) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `det_cantidad` double(7,3) NOT NULL DEFAULT '0.000',
  `det_precio` double(7,4) NOT NULL DEFAULT '0.0000',
  `det_subtotal` double(7,4) NOT NULL DEFAULT '0.0000',
  `det_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_requisitos`
--

INSERT INTO `detalle_requisitos` (`id_detalle`, `mp_id`, `producto_id`, `det_cantidad`, `det_precio`, `det_subtotal`, `det_status`) VALUES
(1, 2, 6, 0.500, 120.0000, 1.2000, 1);

--
-- Disparadores `detalle_requisitos`
--
DELIMITER $$
CREATE TRIGGER `Restar_Stock_MP` AFTER INSERT ON `detalle_requisitos` FOR EACH ROW BEGIN
Update compra_mp
set compra_mp.det_cantidad = compra_mp.det_cantidad - NEW.det_cantidad
where compra_mp.mp_id = NEW.mp_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_requisito_producto`
--

CREATE TABLE `detalle_requisito_producto` (
  `id_detalle` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL DEFAULT '0',
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `det_pd_cantidad` double(7,3) NOT NULL DEFAULT '0.000',
  `det_pd_precio` double(7,4) NOT NULL DEFAULT '0.0000',
  `det_pd_subtotal` double(7,4) NOT NULL DEFAULT '0.0000',
  `det_pd_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_viaje`
--

CREATE TABLE `detalle_viaje` (
  `id_detalle` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `det_tipo` enum('COBRANZA','ENTREGA') NOT NULL DEFAULT 'ENTREGA',
  `det_status` enum('ENTREGADO','COBRADO','PENDIENTE','NO SE ENTREGO') NOT NULL DEFAULT 'PENDIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_viaje`
--

INSERT INTO `detalle_viaje` (`id_detalle`, `viaje_id`, `pedido_id`, `det_tipo`, `det_status`) VALUES
(1, 1, 1, 'ENTREGA', 'PENDIENTE'),
(2, 2, 2, 'ENTREGA', 'PENDIENTE'),
(3, 3, 2, 'COBRANZA', 'PENDIENTE'),
(4, 4, 3, 'ENTREGA', 'PENDIENTE'),
(5, 5, 3, 'COBRANZA', 'PENDIENTE'),
(6, 6, 4, 'ENTREGA', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documentos` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `acta_nacimiento` tinyint(1) NOT NULL,
  `comprobante_domicilio` tinyint(1) NOT NULL,
  `seguro_social` tinyint(1) NOT NULL,
  `curp` tinyint(1) NOT NULL,
  `ine` tinyint(1) NOT NULL,
  `licencia_conducir` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documentos`, `empleado_id`, `acta_nacimiento`, `comprobante_domicilio`, `seguro_social`, `curp`, `ine`, `licencia_conducir`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2018-06-06 16:23:10', '2018-06-06 16:23:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cl`
--

CREATE TABLE `documentos_cl` (
  `id_documentos_cl` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `hacienda` tinyint(1) NOT NULL DEFAULT '0',
  `comprobante_domicilio` tinyint(1) NOT NULL DEFAULT '0',
  `ine` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documentos_cl`
--

INSERT INTO `documentos_cl` (`id_documentos_cl`, `cliente_id`, `hacienda`, `comprobante_domicilio`, `ine`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2018-06-06 16:24:34', '2018-06-06 16:24:34'),
(2, 2, 1, 1, 1, '2018-09-18 00:13:36', '2018-09-18 00:13:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `id_domicilio` int(11) NOT NULL,
  `dom_calle` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_colonia` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_ciudad` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_codigo_postal` int(6) NOT NULL,
  `dom_status` tinyint(1) NOT NULL DEFAULT '1',
  `cliente_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id_domicilio`, `dom_calle`, `dom_colonia`, `dom_ciudad`, `dom_codigo_postal`, `dom_status`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, 'NIGROMANTE #56', 'CENTRO', 'COLIMA', 28100, 1, 1, '2018-06-06 16:24:34', '2018-06-06 16:24:34'),
(2, 'AV IGNACIO SANDOVAL', 'JARDINES DE VISTA HERMOSA', 'COLIMA', 29018, 1, 2, '2018-09-18 00:13:36', '2018-09-18 00:13:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `em_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'N/A',
  `em_curp` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_num_seg_social` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_fecha_inicio` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'PRESTAMO',
  `em_num_licencia` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_vigencia_licencia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_tipo` enum('CONTRATO','BASE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_status` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `em_nombre`, `em_telefono`, `em_curp`, `em_num_seg_social`, `em_fecha_inicio`, `em_num_licencia`, `em_vigencia_licencia`, `em_tipo`, `em_status`, `created_at`, `updated_at`) VALUES
(1, 'ARMANDO MANZANERO', '3411897632', 'GUMJ931010HCMTRR03', '123456789', '2018-06-01', '12345', '2019-07-01', 'BASE', 1, '2018-06-06 16:23:10', '2018-06-06 16:23:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fallas`
--

CREATE TABLE `fallas` (
  `id_falla` int(11) NOT NULL,
  `placas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fa_descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fa_lugar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fa_costo` double(7,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_gastos` int(11) NOT NULL,
  `ga_nota` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ga_importe` double(7,2) NOT NULL,
  `ga_concepto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ga_status` tinyint(1) NOT NULL DEFAULT '1',
  `viaje_id` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id_gastos`, `ga_nota`, `ga_importe`, `ga_concepto`, `ga_status`, `viaje_id`, `created_at`, `updated_at`) VALUES
(1, '1', 200.00, 'GASOLINA', 1, 1, '2018-07-29', '2018-07-29'),
(2, '2', 100.00, 'GASOLINA', 1, 2, '2018-07-29', '2018-07-29'),
(3, '3', 100.00, 'GASOLINA', 1, 3, '2018-07-29', '2018-07-29'),
(4, '4', 200.00, 'GASOLINA', 1, 4, '2018-07-29', '2018-07-29'),
(5, '5', 100.00, 'COMIDA', 1, 4, '2018-07-29', '2018-07-29'),
(6, '6', 100.00, 'BEBIDAS', 1, 5, '2018-09-18', '2018-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto_fijo`
--

CREATE TABLE `gasto_fijo` (
  `id_gasto_fijo` int(11) NOT NULL,
  `gf_concepto` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `gf_cantidad` double(7,3) NOT NULL,
  `gf_importe` double(7,2) NOT NULL DEFAULT '0.00',
  `gf_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  `compra_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `in_memo` text,
  `in_cantidad` double(7,3) NOT NULL DEFAULT '0.000',
  `in_operacion` enum('SUMA','RESTA') NOT NULL DEFAULT 'SUMA',
  `compra_id` int(11) NOT NULL DEFAULT '0',
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `mp_id` int(11) NOT NULL DEFAULT '0',
  `produccion_id` int(11) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `in_memo`, `in_cantidad`, `in_operacion`, `compra_id`, `producto_id`, `mp_id`, `produccion_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 10.000, 'SUMA', 2, 4, 0, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `id_materia_prima` int(11) NOT NULL,
  `mp_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `mp_precio` double(6,2) NOT NULL DEFAULT '0.00',
  `mp_cantidad` double(6,2) NOT NULL DEFAULT '0.00',
  `mp_unidad` enum('KILOS','LITROS','PIEZAS','MILILITROS','METROS') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'KILOS',
  `mp_status` tinyint(1) NOT NULL DEFAULT '1',
  `mp_observacion` text COLLATE utf8_unicode_ci,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`id_materia_prima`, `mp_nombre`, `mp_precio`, `mp_cantidad`, `mp_unidad`, `mp_status`, `mp_observacion`, `created_at`, `updated_at`) VALUES
(1, 'ARCILLA', 150.00, 25.00, 'KILOS', 1, 'NINGUNA OBSERVACIÓN.', '2018-06-06', '2018-06-06'),
(2, 'CEMENTO BLANCO', 120.00, 50.00, 'KILOS', 1, 'NINGUNA OBSERVACIÓN.', '2018-06-06', '2018-06-06'),
(3, 'CAL', 150.00, 25.00, 'KILOS', 1, 'NINGUNA OBSERVACIÓN.', '2018-07-10', '2018-07-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_temporal`
--

CREATE TABLE `movimiento_temporal` (
  `id_movimiento_temporal` int(11) NOT NULL,
  `mt_entregado` double(6,2) NOT NULL DEFAULT '0.00',
  `mt_fecha` date NOT NULL,
  `mt_firma` tinyint(1) NOT NULL DEFAULT '0',
  `mt_status` enum('PENDIENTE','FINALIZADO') NOT NULL DEFAULT 'PENDIENTE',
  `mt_gasto` double(6,2) NOT NULL DEFAULT '0.00',
  `empleado` varchar(80) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pe_importe` double(7,2) NOT NULL DEFAULT '0.00',
  `pe_total_abonado` double(7,2) NOT NULL DEFAULT '0.00',
  `pe_nota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_fecha_pedido` date NOT NULL,
  `pe_fecha_entrega` date NOT NULL,
  `pe_destino_pedido` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_destino_ciudad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_memo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_termino` enum('CONTADO','1 DIA','1 SEMANA','1 MES','1 BIMESTRE','1 TRIMESTRE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CONTADO',
  `pe_forma_pago` enum('EFECTIVO','CHEQUE','DEPOSITO','TRANSFERENCIA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EFECTIVO',
  `pe_pago_status` enum('PENDIENTE','ABONADO','PAGADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `pe_status` enum('ENTREGADO','EN PRODUCCION','PREPARADO PARA ENTREGAR','EN CAMINO A ENTREGAR','PENDIENTE PARA PRODUCCION','CANCELADO','EN CAMINO A COBRAR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE PARA PRODUCCION',
  `pe_notas_cl` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `cliente_id`, `pe_importe`, `pe_total_abonado`, `pe_nota`, `pe_fecha_pedido`, `pe_fecha_entrega`, `pe_destino_pedido`, `pe_destino_ciudad`, `pe_memo`, `pe_termino`, `pe_forma_pago`, `pe_pago_status`, `pe_status`, `pe_notas_cl`, `created_at`, `updated_at`) VALUES
(1, 1, 50.00, 50.00, '0', '2018-07-29', '2018-07-29', 'NIGROMANTE #56, CENTRO', 'COLIMA', 'ES DE PRUEBA.', 'CONTADO', 'EFECTIVO', 'PAGADO', 'ENTREGADO', 'NO HAY OBSERVACIONES', '2018-07-29 20:36:05', '2018-07-29 20:50:59'),
(2, 1, 1400.00, 1400.00, '1', '2018-07-29', '2018-07-29', 'NIGROMANTE #56, CENTRO', 'COLIMA', 'ES DE PRUEBA X2', 'CONTADO', 'EFECTIVO', 'PAGADO', 'ENTREGADO', 'NO HAY OBSERVACIONES', '2018-07-29 20:53:39', '2018-07-29 20:58:33'),
(3, 1, 1250.00, 1250.00, '2', '2018-07-29', '2018-07-29', 'NIGROMANTE #56, CENTRO', 'COLIMA', 'PRUEBA X4', 'CONTADO', 'EFECTIVO', 'PAGADO', 'ENTREGADO', 'NO HAY OBSERVACIONES', '2018-07-29 20:59:41', '2018-09-18 00:52:47'),
(4, 1, 750.00, 0.00, '3', '2018-09-18', '2018-09-18', 'NIGROMANTE #56, CENTRO', 'COLIMA', '', '1 MES', 'EFECTIVO', 'PENDIENTE', 'EN CAMINO A ENTREGAR', 'NO HAY OBSERVACIONES', '2018-09-18 00:04:47', '2018-09-18 01:41:42'),
(5, 2, 1250.00, 0.00, '4', '2018-09-18', '2018-09-18', 'AV IGNACIO SANDOVAL, JARDINES DE VISTA HERMOSA', 'COLIMA', 'ES PRUEBA.', '1 MES', 'EFECTIVO', 'PENDIENTE', 'PENDIENTE PARA PRODUCCION', 'NO HAY OBSERVACIONES', '2018-09-18 00:14:10', '2018-09-18 00:14:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `pres_cantidad` double(6,2) NOT NULL DEFAULT '0.00',
  `pres_abonado` double(6,2) NOT NULL DEFAULT '0.00',
  `pres_status` enum('PENDIENTE','APROBADO','NO APROBADO') NOT NULL DEFAULT 'PENDIENTE',
  `pres_descripcion` text NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL DEFAULT '0',
  `movimiento_temporal_id` int(11) NOT NULL DEFAULT '0',
  `pres_tipo` enum('PERSONAL','GASTO') NOT NULL,
  `pres_pago_status` enum('PAGADO','ABONADO','PENDIENTE') NOT NULL DEFAULT 'PENDIENTE',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_prestamo`, `pres_cantidad`, `pres_abonado`, `pres_status`, `pres_descripcion`, `empleado_id`, `viaje_id`, `movimiento_temporal_id`, `pres_tipo`, `pres_pago_status`, `created_at`, `updated_at`) VALUES
(1, 500.00, 0.00, 'PENDIENTE', 'ES DE PRUEBA.', 1, 0, 0, 'PERSONAL', 'PENDIENTE', '2018-07-05', '2018-07-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_produccion` int(11) NOT NULL,
  `pr_encargado` varchar(60) DEFAULT NULL,
  `pr_ayudante` varchar(60) DEFAULT NULL,
  `pr_turno` enum('MATUTINO','VESPERTINO') DEFAULT NULL,
  `pr_completo` enum('FINALIZADO','PENDIENTE','CANCELADO') NOT NULL DEFAULT 'PENDIENTE',
  `pr_memo` text,
  `pr_productos` text NOT NULL,
  `pr_materiales` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`id_produccion`, `pr_encargado`, `pr_ayudante`, `pr_turno`, `pr_completo`, `pr_memo`, `pr_productos`, `pr_materiales`, `created_at`, `updated_at`) VALUES
(1, 'ALEJANDRO RIOS ALCARAZ', 'CARLOS RUIZ CARDENAS', 'MATUTINO', 'FINALIZADO', 'NO HAY NINGÚN COMENTARIO', '5 PEGA AZULEJO', '', '2018-07-29', '2018-07-29'),
(2, 'ALEJANDRO RIOS ALCARAZ', 'CARLOS RUIZ CARDENAS', 'MATUTINO', 'FINALIZADO', 'NO HAY NINGÚN COMENTARIO', '5 JUNTEADOR NEGRO', '2.5 KILOS CEMENTO BLANCO|', '2018-09-18', '2018-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `pd_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `pd_tipo` enum('ENSAMBLADO','NO ENSAMBLADO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO ENSAMBLADO',
  `pd_cantidad` int(11) NOT NULL DEFAULT '1',
  `pd_costo` double(7,4) NOT NULL DEFAULT '0.0000',
  `pd_precio_venta` double(7,4) NOT NULL DEFAULT '0.0000',
  `pd_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `pd_nombre`, `pd_tipo`, `pd_cantidad`, `pd_costo`, `pd_precio_venta`, `pd_status`, `created_at`, `updated_at`) VALUES
(1, 'PEGAZA ORO', 'ENSAMBLADO', 1, 114.0000, 250.0000, 1, '2018-06-06', '2018-06-06'),
(2, 'PEGA AZULEJO', 'ENSAMBLADO', 1, 0.0000, 250.0000, 1, '2018-06-06', '2018-06-06'),
(3, 'LAMPARA LED', 'NO ENSAMBLADO', 1, 130.0000, 280.0000, 1, '2018-06-06', '2018-06-06'),
(4, 'LAVAVO MARMOL', 'NO ENSAMBLADO', 1, 999.9999, 999.9999, 1, '2018-06-06', '2018-06-06'),
(5, 'JUNTEADOR ROJO', 'ENSAMBLADO', 1, 0.0000, 50.0000, 1, '2018-07-03', '2018-07-03'),
(6, 'JUNTEADOR NEGRO', 'ENSAMBLADO', 1, 2.5000, 5.0000, 1, '2018-07-10', '2018-07-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `pv_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `pv_domicilio` text COLLATE utf8_unicode_ci NOT NULL,
  `pv_ciudad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pv_rfc` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pv_correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pv_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `pv_nombre`, `pv_domicilio`, `pv_ciudad`, `pv_rfc`, `pv_correo`, `pv_status`, `created_at`, `updated_at`) VALUES
(1, 'CEMEX', 'AV TERCER ANILLO PERIFERICO #23', 'VILLA DE ALVAREZ', 'ELDV0965', 'ventas@cemex.com', 1, '2018-06-06 16:05:03', '2018-06-06 16:05:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `perfil` enum('CAJA','ADMIN') NOT NULL DEFAULT 'CAJA',
  `usuario` varchar(50) NOT NULL,
  `us_status` tinyint(1) NOT NULL DEFAULT '1',
  `password` text NOT NULL,
  `remember_token` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `empleado_id`, `perfil`, `usuario`, `us_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'ADMIN', 'JORGE', 1, '$2y$10$fozx4Ah2/kvk4h1vhBo3su7sEjUQe9iQdNyKdApewGzilb9nh6lOu', 'lr01rkepirS4qXS9MhzRPsn8K90lcM7D97u5r8hyPPztZUWnHceC42FBC2wC', '2017-11-21', '2018-07-29'),
(2, 2, 'ADMIN', 'XOCHITL', 1, '$2y$10$xEIRMKVMHmXokj7/xH6RL.bKl5GudwgKwgMNZBE4qK24rPT8f7yGu', '', '2017-11-21', '2017-11-21'),
(3, 3, 'ADMIN', 'JESUS', 1, '$2y$10$oA3Vhdo3VR10mvS12hz4o.NoYzTpCVWs8n11odUJueE.A6hoEPaYS', 'jhjeePV9nxSSR38TaknICn9esfoojTclJf2HtPOCSOlzcm68gV1pUGFCw4tx', '2017-11-21', '2018-05-29'),
(4, 1, 'ADMIN', 'JCERVANTES', 1, '$2y$10$1QgCnmHt4K1yUu8Q2d/Dpeu6sV2s/HVQXED6ikQalRhxgj4kJ5Tuy', '', '2018-06-06', '2018-06-06'),
(5, 1, 'ADMIN', 'AMANZANERO', 1, '$2y$10$xNtI2Z09WhrKfT6PAdKcE.eHj65CkmbZGv.kfm4dSdnejHQGQYq2O', '', '2018-06-06', '2018-06-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `placas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vh_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vh_caracteristicas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vh_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`placas`, `vh_nombre`, `vh_caracteristicas`, `vh_status`, `created_at`, `updated_at`) VALUES
('COL-F23', 'CHEVROLET COLORADO', 'DOBLE CABINA BLANCA', 1, '2018-06-06 16:03:54', '2018-06-06 16:03:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id_viaje` int(11) NOT NULL,
  `vi_kilometraje_inicial` varchar(25) NOT NULL DEFAULT '0',
  `vi_fecha` date NOT NULL,
  `vi_kilometraje_final` varchar(25) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `vehiculo_id` varchar(50) NOT NULL,
  `vi_destino` text NOT NULL,
  `vi_viaticos` double(7,2) NOT NULL DEFAULT '0.00',
  `vi_status` tinyint(1) NOT NULL DEFAULT '0',
  `vi_observaciones` text NOT NULL,
  `gasto_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id_viaje`, `vi_kilometraje_inicial`, `vi_fecha`, `vi_kilometraje_final`, `empleado_id`, `vehiculo_id`, `vi_destino`, `vi_viaticos`, `vi_status`, `vi_observaciones`, `gasto_id`, `created_at`, `updated_at`) VALUES
(1, '12967', '2018-07-29', '13000', 1, 'COL-F23', 'COLIMA', 200.00, 1, 'ESTE VIAJE ES DE PRUEBA.', 0, '2018-07-29', '2018-07-29'),
(2, '13000', '2018-07-29', '13050', 1, 'COL-F23', 'COLIMA', 100.00, 1, 'ES DE PRUEBA X2.', 0, '2018-07-29', '2018-07-29'),
(3, '13050', '2018-07-29', '13100', 1, 'COL-F23', 'COLIMA', 100.00, 1, 'ES DE PRUEBA X3', 0, '2018-07-29', '2018-07-29'),
(4, '13100', '2018-07-29', '13150', 1, 'COL-F23', 'COLIMA', 300.00, 1, 'NADA.', 0, '2018-07-29', '2018-07-29'),
(5, '13150', '2018-09-18', '13200', 1, 'COL-F23', 'COLIMA', 100.00, 1, 'ESTE VIAJE ES DE PRUEBA.', 0, '2018-09-18', '2018-09-18'),
(6, '13200', '2018-09-18', '', 1, 'COL-F23', 'COLIMA', 150.00, 0, '', 0, '2018-09-18', '2018-09-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono_compra`
--
ALTER TABLE `abono_compra`
  ADD PRIMARY KEY (`id_abono`);

--
-- Indices de la tabla `abono_pedido`
--
ALTER TABLE `abono_pedido`
  ADD PRIMARY KEY (`id_abono_pedido`);

--
-- Indices de la tabla `abono_prestamo`
--
ALTER TABLE `abono_prestamo`
  ADD PRIMARY KEY (`id_ab_prestamo`);

--
-- Indices de la tabla `catalogo_gastos`
--
ALTER TABLE `catalogo_gastos`
  ADD PRIMARY KEY (`id_cat_gastos`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cl_rfc` (`cl_rfc`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  ADD PRIMARY KEY (`id_detalle`,`compra_id`,`mp_id`),
  ADD KEY `compra_id` (`compra_id`),
  ADD KEY `mp_id` (`mp_id`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`);

--
-- Indices de la tabla `corte_caja`
--
ALTER TABLE `corte_caja`
  ADD PRIMARY KEY (`id_corte`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id_cuentas`);

--
-- Indices de la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  ADD PRIMARY KEY (`id_concepto`,`movimiento_temporal_id`,`compra_id`),
  ADD KEY `compra_id` (`compra_id`),
  ADD KEY `movimiento_temporal_id` (`movimiento_temporal_id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_det_pedido`,`pedido_id`,`producto_id`,`pegaza_id`),
  ADD KEY `pegaza_id` (`pegaza_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indices de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  ADD PRIMARY KEY (`id_detalle`,`produccion_id`,`pedido_id`),
  ADD KEY `produccion_id` (`produccion_id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indices de la tabla `detalle_requisitos`
--
ALTER TABLE `detalle_requisitos`
  ADD PRIMARY KEY (`id_detalle`,`mp_id`,`producto_id`),
  ADD KEY `det_materia_prima_id` (`mp_id`),
  ADD KEY `det_producto_id` (`producto_id`);

--
-- Indices de la tabla `detalle_requisito_producto`
--
ALTER TABLE `detalle_requisito_producto`
  ADD PRIMARY KEY (`id_detalle`,`producto_id`,`pd_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indices de la tabla `detalle_viaje`
--
ALTER TABLE `detalle_viaje`
  ADD PRIMARY KEY (`id_detalle`,`viaje_id`,`pedido_id`),
  ADD KEY `viaje_id` (`viaje_id`,`pedido_id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documentos`);

--
-- Indices de la tabla `documentos_cl`
--
ALTER TABLE `documentos_cl`
  ADD PRIMARY KEY (`id_documentos_cl`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`id_domicilio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `em_curp` (`em_curp`);

--
-- Indices de la tabla `fallas`
--
ALTER TABLE `fallas`
  ADD PRIMARY KEY (`id_falla`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_gastos`);

--
-- Indices de la tabla `gasto_fijo`
--
ALTER TABLE `gasto_fijo`
  ADD PRIMARY KEY (`id_gasto_fijo`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`id_materia_prima`);

--
-- Indices de la tabla `movimiento_temporal`
--
ALTER TABLE `movimiento_temporal`
  ADD PRIMARY KEY (`id_movimiento_temporal`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_produccion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `pv_rfc` (`pv_rfc`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`placas`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id_viaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono_compra`
--
ALTER TABLE `abono_compra`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `abono_pedido`
--
ALTER TABLE `abono_pedido`
  MODIFY `id_abono_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `abono_prestamo`
--
ALTER TABLE `abono_prestamo`
  MODIFY `id_ab_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogo_gastos`
--
ALTER TABLE `catalogo_gastos`
  MODIFY `id_cat_gastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `corte_caja`
--
ALTER TABLE `corte_caja`
  MODIFY `id_corte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_cuentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_det_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_requisitos`
--
ALTER TABLE `detalle_requisitos`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_requisito_producto`
--
ALTER TABLE `detalle_requisito_producto`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_viaje`
--
ALTER TABLE `detalle_viaje`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documentos_cl`
--
ALTER TABLE `documentos_cl`
  MODIFY `id_documentos_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fallas`
--
ALTER TABLE `fallas`
  MODIFY `id_falla` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_gastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `gasto_fijo`
--
ALTER TABLE `gasto_fijo`
  MODIFY `id_gasto_fijo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `movimiento_temporal`
--
ALTER TABLE `movimiento_temporal`
  MODIFY `id_movimiento_temporal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
