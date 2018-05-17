-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2018 a las 20:58:35
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
(1, 500.00, 1, 1, 'CAJA', '0', 'NINGUNO', '0', '2018-05-02', '2018-05-02'),
(2, 400.00, 1, 2, 'CAJA', '0', 'NINGUNO', '1', '2018-05-02', '2018-05-02'),
(3, 500.00, 2, 1, 'CAJA', '0', 'NINGUNO', '0', '2018-05-10', '2018-05-10'),
(4, 600.00, 2, 2, '', '0', 'NINGUNO', '1', '2018-05-10', '2018-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_prestamo`
--

CREATE TABLE `abono_prestamo` (
  `id_ab_prestamo` int(11) NOT NULL,
  `ab_abono` double(6,2) NOT NULL DEFAULT '0.00',
  `ab_pago` varchar(100) NOT NULL DEFAULT 'CAJA',
  `ab_numero` int(2) NOT NULL DEFAULT '0',
  `prestamo_id` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'FERRETERIA MARISOL', 'FRMA020192HM25', 'ULTIMO PRECIO: $345', 'MARI@GMAIL.COM', '3121032699', 'YOLANDA', 'MARISOL', 'EFECTIVO', 'NORMAL', '1 MES', 1, '2017-12-19 20:36:19', '2017-12-22 22:55:06'),
(2, 'CONTRUCTOR GALINDO', 'COGA250695JMN20', 'NO HAY OBSERVACIONES', 'CONTRU-GALINDO@HOTMAIL.COM', '3121045899', 'JULIETA', 'RICARDO GALINDO', 'EFECTIVO', 'NORMAL', '1 SEMANA', 1, '2017-12-19 20:38:13', '2017-12-19 20:38:13'),
(3, '', '', 'NO HAY OBSERVACIONES', 'htc@htc', '', '', '', '', '', '', 1, '2018-02-21 12:31:06', '2018-02-21 12:31:06');

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
(1, 'JORGE GUTIERREZ', '3121044897', 1, 1, '2017-12-19 20:40:08', '2017-12-19 20:40:08'),
(2, 'LUIS GONZALEZ', '3124587799', 1, 1, '2017-12-19 20:40:08', '2017-12-22 23:30:30'),
(3, 'ARTURO SANCHEZ', '3121895577', 1, 2, '2017-12-19 20:44:12', '2017-12-19 20:44:12'),
(4, 'PEPE DEL TORO', '3121042133', 1, 2, '2017-12-22 23:31:23', '2017-12-22 23:31:23'),
(5, 'JOSE', '3121051236', 1, 3, '2017-12-28 02:17:41', '2017-12-28 02:17:41'),
(6, 'ANA DELGADO AYALA', '3121908753', 1, 4, '2018-01-11 21:31:48', '2018-01-11 21:31:48');

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

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `empleado_id`, `cont_fecha_inicio`, `cont_fecha_fin`) VALUES
(1, 4, '2017-12-14', '2018-02-24'),
(2, 3, '2017-11-20', '2018-06-30'),
(3, 3, '2018-01-01', '2018-12-01');

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
(1, 'BANCO BANORTE', 1, '2017-12-23 23:31:11', '2017-12-23 23:31:58'),
(2, 'BANCO SANTANDER', 1, '2017-12-23 23:32:18', '2017-12-23 23:32:18'),
(3, 'BANCO BANCOMER', 1, '2017-12-23 23:32:26', '2017-12-23 23:32:26'),
(4, 'BANCO HSBC', 1, '2017-12-23 23:32:34', '2017-12-23 23:32:34');

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

--
-- Volcado de datos para la tabla `detalle_movimientos`
--

INSERT INTO `detalle_movimientos` (`id_concepto`, `movimiento_temporal_id`, `compra_id`, `ct_concepto`, `ct_gasto`, `ct_nota`) VALUES
(1, 1, 0, 'LUZ', 300.00, '1'),
(2, 1, 0, 'AGUA', 300.00, '2'),
(3, 1, 0, 'TELEFONO', 400.00, '3'),
(4, 2, 0, 'PAPELERIA', 500.00, '6'),
(5, 3, 0, 'REFACCIONES', 500.00, '9'),
(6, 4, 0, 'PAPELERIA', 500.00, '98');

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
(1, 1, 2, 0, 2, 750.00, 1500.00, 1),
(2, 2, 1, 0, 8, 300.00, 2400.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_produccion`
--

CREATE TABLE `detalle_produccion` (
  `id_detalle` int(11) NOT NULL,
  `produccion_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 1, 2, 'COBRANZA', 'PENDIENTE'),
(3, 2, 1, 'COBRANZA', 'PENDIENTE'),
(4, 2, 2, 'COBRANZA', 'PENDIENTE');

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
(1, 1, 1, 1, 1, 1, 1, 1, '2017-12-20 01:46:39', '2017-12-20 01:46:45'),
(2, 2, 1, 1, 0, 1, 1, 0, '2017-11-21 18:13:34', '2017-12-22 18:46:55'),
(3, 3, 1, 1, 1, 1, 1, 1, '2017-11-21 18:14:09', '2017-12-22 18:43:54');

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
(1, 1, 1, 1, 1, '2017-12-19 20:36:20', '2017-12-19 20:36:20'),
(2, 2, 1, 1, 1, '2017-12-19 20:38:14', '2017-12-19 20:38:14'),
(3, 3, 0, 0, 0, '2018-02-21 12:31:06', '2018-02-21 12:31:06');

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
(1, 'FLOR DE LAUREL #122', 'LOMA ALTA', 'COLIMA', 28988, 1, 1, '2017-12-19 20:36:19', '2017-12-22 22:50:07'),
(2, 'HIDALGO #256', 'BUGAMBILIA', 'TECOMAN', 28228, 1, 2, '2017-12-19 20:38:14', '2017-12-22 22:54:19'),
(3, 'LOPEZ MATERO #345', 'FLORENCIA', 'MANZANILLO', 27578, 1, 1, '2017-12-22 22:53:15', '2017-12-22 22:54:39'),
(4, '', '', '', 0, 1, 3, '2018-02-21 12:31:06', '2018-02-21 12:31:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_egresos` int(11) NOT NULL,
  `eg_nota` text COLLATE latin1_spanish_ci NOT NULL,
  `eg_concepto` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `eg_importe` double(7,4) NOT NULL DEFAULT '0.0000',
  `viaje_id` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id_egresos`, `eg_nota`, `eg_concepto`, `eg_importe`, `viaje_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'GASOLINA', 300.0000, 1, '2018-05-02 23:23:38', '2018-05-02 23:23:38');

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
(1, 'JORGE LUIS GUTIERREZ MARTINEZ', 'N/A', 'JLGM101093HCMTRR03', '123456789', '2017-11-20', NULL, NULL, 'BASE', 1, '0000-00-00 00:00:00', '2017-12-22 17:59:04'),
(2, 'XOCHITL', 'N/A', 'GFVD020303HCMNRS05', NULL, '2017-11-20', NULL, NULL, 'BASE', 1, '2017-11-21 18:13:34', '2017-12-22 18:46:55'),
(3, 'JESUS GONZALEZ JUAREZ', 'N/A', 'GOKK020269HCMNRS05', '25436547', '2017-11-20', '1236546', '2020-06-08', 'CONTRATO', 1, '2017-11-21 18:14:09', '2017-12-23 17:13:35');

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
  `viaje_id` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id_gastos`, `ga_nota`, `ga_importe`, `ga_concepto`, `ga_status`, `viaje_id`, `created_at`, `updated_at`) VALUES
(1, '', 0.00, 'GASOLINA', 1, 0, '2018-05-02', '2018-05-02'),
(2, '', 0.00, 'LUZ', 1, 0, '2018-05-02', '2018-05-02'),
(3, '', 0.00, 'TELEFONO', 1, 0, '2018-05-02', '2018-05-02'),
(4, '', 0.00, 'COMIDA', 1, 0, '2018-05-02', '2018-05-02'),
(5, '74', 200.00, 'COMIDA', 1, 2, '2018-05-10', '2018-05-10'),
(6, '63', 300.00, 'CASETA', 1, 2, '2018-05-10', '2018-05-10');

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
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `mp_id` int(11) NOT NULL DEFAULT '0',
  `produccion_id` int(11) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'CEMENTO GRIS', 180.00, 50.00, 'KILOS', 1, 'NINGUNA OBSERVACIÓN.', '2018-04-30', '2018-04-30'),
(2, 'LADRILLO ROJO', 200.00, 100.00, 'PIEZAS', 1, 'NINGUNA OBSERVACIÓN.', '2018-04-30', '2018-04-30');

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

--
-- Volcado de datos para la tabla `movimiento_temporal`
--

INSERT INTO `movimiento_temporal` (`id_movimiento_temporal`, `mt_entregado`, `mt_fecha`, `mt_firma`, `mt_status`, `mt_gasto`, `empleado`, `created_at`, `updated_at`) VALUES
(1, 1000.00, '2018-05-10', 1, 'FINALIZADO', 1000.00, 'LUZ MARIA GOMEZ ESPARZA', '2018-05-10', '2018-05-10'),
(2, 500.00, '2018-05-10', 1, 'FINALIZADO', 500.00, 'EDUARDO LARIOS', '2018-05-10', '2018-05-10'),
(3, 500.00, '2018-05-10', 1, 'FINALIZADO', 500.00, 'SARAHI ROMERO', '2018-05-10', '2018-05-10'),
(4, 500.00, '2018-05-10', 1, 'FINALIZADO', 500.00, 'ROBERTO HERRERA BALTAZAR', '2018-05-10', '2018-05-10');

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
(1, 2, 1500.00, 1000.00, '0', '2018-05-02', '2018-05-02', 'HIDALGO #256, BUGAMBILIA', 'TECOMAN', 'NADA', '1 SEMANA', 'EFECTIVO', 'ABONADO', 'ENTREGADO', 'NO HAY OBSERVACIONES', '2018-05-02 23:13:34', '2018-05-10 15:02:17'),
(2, 1, 2400.00, 1000.00, '1', '2018-05-02', '2018-05-02', 'FLOR DE LAUREL #122, LOMA ALTA', 'COLIMA', 'NADA.', '1 MES', 'EFECTIVO', 'ABONADO', 'ENTREGADO', 'ULTIMO PRECIO: $345', '2018-05-02 23:14:08', '2018-05-10 15:02:17');

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
(1, 'PEGA AZULEJO', 'ENSAMBLADO', 1, 201.5000, 300.0000, 1, '2017-12-19', '2017-12-23'),
(2, 'PEGAZA ORO', 'ENSAMBLADO', 1, 501.4000, 750.0000, 1, '2017-12-19', '2017-12-23'),
(3, 'LLAVE PARA LAVAMANOS', 'NO ENSAMBLADO', 1, 123.0000, 321.0000, 1, '2017-12-23', '2017-12-23'),
(6, 'EJEMPLO2', 'ENSAMBLADO', 1, 590.0000, 600.0000, 1, '2017-12-23', '2017-12-23'),
(7, 'QUIMICO 1', 'ENSAMBLADO', 1, 73.0000, 100.0000, 1, '2017-12-23', '2017-12-23'),
(8, 'PEGA AZULEJO ROJO', 'ENSAMBLADO', 1, 423.0000, 500.0000, 1, '2017-12-23', '2017-12-23'),
(9, 'VASTAGO DE REGADERA', 'NO ENSAMBLADO', 1, 23.0000, 50.0000, 1, '2018-01-11', '2018-01-11'),
(10, 'EJEMPLO3', 'ENSAMBLADO', 1, 162.0000, 200.0000, 1, '2018-02-21', '2018-02-21'),
(11, 'EJEMPLO4', 'ENSAMBLADO', 1, 66.0000, 2.0000, 1, '2018-02-21', '2018-02-21'),
(12, 'EJEMPLO5', 'ENSAMBLADO', 1, 5.0000, 10.0000, 1, '2018-02-21', '2018-02-21');

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
(1, 'CEMENTO APASCO', 'PRADOS DEL NORTE #125, LOMAS DE LA HIGUERA', 'TECOMAN', 'APSC251292HS058', 'APSCO.MEXICO@GMAIL.COM', 1, '2017-12-19 20:40:08', '2017-12-19 20:40:08'),
(2, 'CEMEX CEMENTO MEXICANDO', 'INDUSTRIAL #5996 B, TONILA', 'GUADALAJARA', 'CMXE232895ASD56', 'CEMEX@HOTMAIL.COM', 1, '2017-12-19 20:44:11', '2017-12-19 20:44:11'),
(3, 'PAPELERIA SAN JOSE', 'PRADOS DEL NORTE #235, LOMAS DE LA HIGUERA', 'VILLA DE ALVAREZ', 'ASDFSD0326852', 'sanjose@gmail.com', 1, '2017-12-28 02:17:41', '2017-12-28 02:17:41'),
(4, 'FERRETERIA LA PAROTA', 'AV. BENITO JUAREZ #32, COL. CENTRO', 'COLIMA', 'FTLPT12793763', 'FERRETERIA.PAROTA@GMAIL.COM', 1, '2018-01-11 21:31:48', '2018-01-11 21:31:48');

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
(1, 1, 'ADMIN', 'JORGE', 1, '$2y$10$fozx4Ah2/kvk4h1vhBo3su7sEjUQe9iQdNyKdApewGzilb9nh6lOu', 'C4Xqbw6IyAVyr7mlhMUspNpIf900OeenUUGpicn2Bguy4H20ekjDzWF6CqLE', '2017-11-21', '2018-05-10'),
(2, 2, 'ADMIN', 'XOCHITL', 1, '$2y$10$xEIRMKVMHmXokj7/xH6RL.bKl5GudwgKwgMNZBE4qK24rPT8f7yGu', '', '2017-11-21', '2017-11-21'),
(3, 3, 'ADMIN', 'JESUS', 1, '$2y$10$oA3Vhdo3VR10mvS12hz4o.NoYzTpCVWs8n11odUJueE.A6hoEPaYS', 'We98TbWrUgQk8Ggt8XrtKYhw1RfAF7df2cOpeWEJHVmYe57eTuLZuZTRoMD7', '2017-11-21', '2017-12-20');

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
('FTP-05-06', 'TOYOTA', 'CAMIONETA BLANCA', 1, '2017-12-22 23:54:45', '2017-12-23 00:04:54'),
('ZTR-9087', 'HILUX', 'BLANCA, 4X4, DOBLE CABINA', 1, '2018-01-06 12:31:54', '2018-01-06 12:31:54');

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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id_viaje`, `vi_kilometraje_inicial`, `vi_fecha`, `vi_kilometraje_final`, `empleado_id`, `vehiculo_id`, `vi_destino`, `vi_viaticos`, `vi_status`, `vi_observaciones`, `created_at`, `updated_at`) VALUES
(1, '1997', '2018-05-02', '2500', 3, 'FTP-05-06', 'TECOMAN', 300.00, 1, 'NADA.', '2018-05-02', '2018-05-02'),
(2, '2500', '2018-05-10', '290', 3, 'FTP-05-06', 'TECOMAN', 500.00, 1, 'NADA.', '2018-05-10', '2018-05-10');

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
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egresos`);

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
  MODIFY `id_abono_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `abono_prestamo`
--
ALTER TABLE `abono_prestamo`
  MODIFY `id_ab_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_cuentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_det_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_requisitos`
--
ALTER TABLE `detalle_requisitos`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_requisito_producto`
--
ALTER TABLE `detalle_requisito_producto`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_viaje`
--
ALTER TABLE `detalle_viaje`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentos_cl`
--
ALTER TABLE `documentos_cl`
  MODIFY `id_documentos_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egresos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento_temporal`
--
ALTER TABLE `movimiento_temporal`
  MODIFY `id_movimiento_temporal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
