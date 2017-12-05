-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para azulejos
CREATE DATABASE IF NOT EXISTS `azulejos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `azulejos`;

-- Volcando estructura para tabla azulejos.abono_compra
CREATE TABLE IF NOT EXISTS `abono_compra` (
  `id_abono` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `ab_numero` int(2) NOT NULL DEFAULT '0',
  `ab_abono` double(7,2) NOT NULL DEFAULT '0.00',
  `ab_pago` enum('EFECTIVO','BANCARIA') NOT NULL DEFAULT 'EFECTIVO',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_abono`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.abono_compra: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `abono_compra` DISABLE KEYS */;
INSERT INTO `abono_compra` (`id_abono`, `compra_id`, `ab_numero`, `ab_abono`, `ab_pago`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1210.00, 'EFECTIVO', '2017-10-27', '2017-10-27'),
	(2, 5, 1, 1100.00, 'BANCARIA', '2017-10-27', '2017-10-27'),
	(3, 6, 1, 100.00, 'EFECTIVO', '2017-10-27', '2017-10-27'),
	(4, 8, 1, 360.00, 'BANCARIA', '2017-10-27', '2017-10-27'),
	(5, 9, 1, 1500.00, 'BANCARIA', '2017-10-27', '2017-10-27'),
	(6, 3, 1, 440.00, 'EFECTIVO', '2017-10-27', '2017-10-27'),
	(7, 4, 1, 250.00, 'EFECTIVO', '2017-10-27', '2017-10-27'),
	(8, 6, 2, 80.00, 'EFECTIVO', '2017-10-27', '2017-10-27');
/*!40000 ALTER TABLE `abono_compra` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.abono_pedido
CREATE TABLE IF NOT EXISTS `abono_pedido` (
  `id_abono_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `ap_abono` double(7,2) NOT NULL DEFAULT '0.00',
  `ap_numero` int(2) NOT NULL DEFAULT '0',
  `pedido_id` int(11) NOT NULL DEFAULT '0',
  `ap_pago` enum('EFECTIVO','CHEQUE','BANCARIA') NOT NULL DEFAULT 'EFECTIVO',
  `ap_no_cheque` varchar(50) NOT NULL DEFAULT '0',
  `ap_status_cheque` enum('VERIFICANDO','NINGUNO','APROBADO','REACHAZADO') DEFAULT 'NINGUNO',
  `ap_folio` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_abono_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.abono_pedido: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `abono_pedido` DISABLE KEYS */;
INSERT INTO `abono_pedido` (`id_abono_pedido`, `ap_abono`, `ap_numero`, `pedido_id`, `ap_pago`, `ap_no_cheque`, `ap_status_cheque`, `ap_folio`, `created_at`, `updated_at`) VALUES
	(1, 5000.00, 1, 39, 'BANCARIA', '', 'NINGUNO', '5962', '2017-11-02', '2017-11-02'),
	(2, 2625.00, 1, 40, 'CHEQUE', '102102102', 'VERIFICANDO', '5963', '2017-11-02', '2017-11-02'),
	(3, 2100.00, 1, 41, 'CHEQUE', '102103104', 'VERIFICANDO', '5964', '2017-11-02', '2017-11-02'),
	(4, 100.00, 1, 42, 'BANCARIA', '0', 'NINGUNO', '5964', '2017-11-02', '2017-11-02');
/*!40000 ALTER TABLE `abono_pedido` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cl_rfc` (`cl_rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.cliente: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id_cliente`, `cl_nombre`, `cl_rfc`, `cl_observacion`, `cl_correo`, `cl_telefono`, `cl_nombre_contacto`, `cl_nombre_dueno`, `cl_forma_pago`, `cl_tipo_cliente`, `cl_termino_credito`, `cl_status`, `created_at`, `updated_at`) VALUES
	(1, 'FERRETERIA ALVAREZ', 'FTRALZ1907523', 'ENTREGO TODO BIEN.', 'FERRETERIA.ALVAREZ@GMAIL.COM', '39-81017', 'JOSE LUIS ARROYO MANCERA', 'JOSE LUIS ARROYO MANCERA', 'EFECTIVO', 'NORMAL', '1 MES', 1, '2017-10-23 17:13:35', '2017-10-23 17:13:35'),
	(2, 'PANADERIA RODRIGUEZ', 'GCR10109378', 'ENTREGO TODO COMPLETO', 'PANADERIA.RODRIGUEZ@GMAIL.COM', '3121381143', 'GERMAN CAZAREZ RODRIGUEZ', 'GERMAN CAZAREZ RODRIGUEZ', 'TRANSFERENCIA', 'NORMAL', '1 MES', 1, '2017-10-26 16:24:16', '2017-10-26 16:24:16'),
	(3, 'MAS PUBLICIDAD', 'MP189367', 'ENTREGO TODO COMPLETO', 'MASPUBLICIDAD@GMAIL.COM', '31243453363', 'KARLA HERNANDEZ LUNA', 'CAROLINA FLORES CARDENAS', 'EFECTIVO', 'RIGUROSO', '1 DIA', 1, '2017-10-27 11:49:18', '2017-10-27 11:49:18'),
	(4, 'FERRETERIA COLIMA MUNDO UNIDO', 'GOJJ920420HF036', 'ESTE SI PAGA CHIDO', 'LOL@LIVE.COM', '312-104-2444', 'PEPE', 'PEDRO ROCHA', 'EFECTIVO', 'NORMAL', 'CONTADO', 1, '2017-10-30 14:20:11', '2017-10-30 14:20:11'),
	(5, 'FERRETERIA YAOIMNG', 'YAOYAO', 'NINGUNA', 'YAO@LIVE.COM', '312-102-4489', 'LORENA', 'YAOIMNG', 'EFECTIVO', 'RIGUROSO', 'CONTADO', 1, '2017-10-30 15:41:21', '2017-10-30 15:41:21'),
	(6, 'ABARROTES LAS PALMAS DE LA VILLA', 'ASDASD', 'ASDASD', 'ASDASD@LIVE.COM', '3121068987', 'YOLA', 'PEDRO INFANTE', 'EFECTIVO', 'NORMAL', '1 MES', 1, '2017-10-30 15:47:51', '2017-10-30 15:47:51');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL DEFAULT '0',
  `cm_pago` enum('CONTADO','CREDITO') NOT NULL DEFAULT 'CONTADO',
  `cm_status` enum('PENDIENTE','PAGADO','ABONADO') NOT NULL DEFAULT 'PENDIENTE',
  `cm_bodega` tinyint(1) NOT NULL DEFAULT '0',
  `cm_termino` enum('CONTADO','1 DIA','1 SEMANA','1 MES','1 BIMESTRE','1 TRIMESTRE') NOT NULL DEFAULT 'CONTADO',
  `cm_movimiento` tinyint(1) NOT NULL DEFAULT '0',
  `cm_proveedor` tinyint(1) NOT NULL DEFAULT '0',
  `cm_tipo` enum('MATERIA PRIMA','GASTOS') NOT NULL DEFAULT 'GASTOS',
  `cm_total` double(7,2) NOT NULL DEFAULT '0.00',
  `cm_total_abonado` double(7,2) NOT NULL DEFAULT '0.00',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.compras: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`id_compra`, `proveedor_id`, `cm_pago`, `cm_status`, `cm_bodega`, `cm_termino`, `cm_movimiento`, `cm_proveedor`, `cm_tipo`, `cm_total`, `cm_total_abonado`, `created_at`, `updated_at`) VALUES
	(1, 1, 'CONTADO', 'PAGADO', 1, 'CONTADO', 0, 0, 'MATERIA PRIMA', 1210.00, 1210.00, '2017-10-27', '2017-10-27'),
	(2, 1, 'CONTADO', 'PENDIENTE', 0, 'CONTADO', 1, 0, 'MATERIA PRIMA', 12520.00, 0.00, '2017-10-27', '2017-10-27'),
	(3, 2, 'CONTADO', 'PAGADO', 1, 'CONTADO', 0, 0, 'MATERIA PRIMA', 440.00, 440.00, '2017-10-27', '2017-10-27'),
	(4, 1, 'CONTADO', 'PAGADO', 1, 'CONTADO', 0, 0, 'MATERIA PRIMA', 250.00, 250.00, '2017-10-27', '2017-10-27'),
	(5, 1, 'CONTADO', 'PAGADO', 1, 'CONTADO', 0, 0, 'MATERIA PRIMA', 1100.00, 1100.00, '2017-10-27', '2017-10-27'),
	(6, 1, 'CREDITO', 'PAGADO', 1, '1 SEMANA', 0, 0, 'MATERIA PRIMA', 180.00, 180.00, '2017-10-27', '2017-10-27'),
	(7, 2, 'CREDITO', 'PENDIENTE', 1, '1 DIA', 1, 0, 'GASTOS', 330.00, 0.00, '2017-10-27', '2017-10-27'),
	(8, 1, 'CREDITO', 'PAGADO', 0, '1 DIA', 0, 0, 'MATERIA PRIMA', 360.00, 360.00, '2017-10-27', '2017-10-27'),
	(9, 1, 'CREDITO', 'PAGADO', 1, '1 DIA', 0, 0, 'GASTOS', 1500.00, 1500.00, '2017-10-27', '2017-10-27');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.compra_cuentas
CREATE TABLE IF NOT EXISTS `compra_cuentas` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `cuentas_id` int(11) NOT NULL,
  `det_cantidad` int(5) NOT NULL DEFAULT '0',
  `det_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_detalle`,`compra_id`,`cuentas_id`),
  KEY `compra_id` (`compra_id`),
  KEY `cuentas_id` (`cuentas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.compra_cuentas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `compra_cuentas` DISABLE KEYS */;
INSERT INTO `compra_cuentas` (`id_detalle`, `compra_id`, `cuentas_id`, `det_cantidad`, `det_precio`, `det_subtotal`) VALUES
	(1, 7, 2, 1, 110.00, 110.00),
	(2, 7, 2, 1, 220.00, 220.00),
	(3, 9, 1, 1, 1500.00, 1500.00);
/*!40000 ALTER TABLE `compra_cuentas` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.compra_mp
CREATE TABLE IF NOT EXISTS `compra_mp` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `det_cantidad` int(5) NOT NULL DEFAULT '0',
  `det_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_detalle`,`compra_id`,`mp_id`),
  KEY `compra_id` (`compra_id`),
  KEY `mp_id` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.compra_mp: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `compra_mp` DISABLE KEYS */;
INSERT INTO `compra_mp` (`id_detalle`, `compra_id`, `mp_id`, `det_cantidad`, `det_precio`, `det_subtotal`) VALUES
	(1, 1, 2, 3, 220.00, 660.00),
	(2, 1, 1, 5, 110.00, 550.00),
	(3, 2, 7, 34, 180.00, 6120.00),
	(4, 2, 4, 4, 250.00, 1000.00),
	(5, 2, 6, 60, 90.00, 5400.00),
	(6, 3, 2, 2, 220.00, 440.00),
	(7, 4, 4, 1, 250.00, 250.00),
	(8, 5, 1, 10, 110.00, 1100.00),
	(9, 6, 7, 1, 180.00, 180.00),
	(10, 8, 7, 2, 180.00, 360.00);
/*!40000 ALTER TABLE `compra_mp` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.contacto
CREATE TABLE IF NOT EXISTS `contacto` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `cn_nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `cn_telefono` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.contacto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` (`id_contacto`, `cn_nombre`, `cn_telefono`, `proveedor_id`, `created_at`, `updated_at`) VALUES
	(1, 'LAURA DENISSE TORRES LOPEZ', '331-187-0964', 1, '2017-10-27 11:54:26', '2017-10-27 11:54:26'),
	(2, 'mari', '434343', 2, '2017-10-27 16:51:27', '2017-10-27 16:51:27');
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.cuentas
CREATE TABLE IF NOT EXISTS `cuentas` (
  `id_cuentas` int(11) NOT NULL AUTO_INCREMENT,
  `ct_nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_cuentas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.cuentas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` (`id_cuentas`, `ct_nombre`, `created_at`, `updated_at`) VALUES
	(1, 'fdfdf', '2017-10-27 17:13:26', '2017-10-27 17:13:26'),
	(2, 'hojas', '2017-10-27 17:13:45', '2017-10-27 17:13:45');
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.detalle_movimientos
CREATE TABLE IF NOT EXISTS `detalle_movimientos` (
  `id_concepto` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_temporal_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL DEFAULT '0',
  `ct_concepto` varchar(50) DEFAULT NULL,
  `ct_gasto` double(6,2) NOT NULL DEFAULT '0.00',
  `ct_nota` varchar(15) NOT NULL,
  PRIMARY KEY (`id_concepto`,`movimiento_temporal_id`,`compra_id`),
  KEY `compra_id` (`compra_id`),
  KEY `movimiento_temporal_id` (`movimiento_temporal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.detalle_movimientos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_movimientos` DISABLE KEYS */;
INSERT INTO `detalle_movimientos` (`id_concepto`, `movimiento_temporal_id`, `compra_id`, `ct_concepto`, `ct_gasto`, `ct_nota`) VALUES
	(11, 6, 0, 'GASOLINA', 0.00, ''),
	(12, 6, 2, NULL, 0.00, ''),
	(13, 6, 7, NULL, 0.00, ''),
	(14, 6, 0, 'MOTOR', 0.00, '');
/*!40000 ALTER TABLE `detalle_movimientos` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.detalle_pedido
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_det_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL DEFAULT '0',
  `producto_id` int(11) NOT NULL DEFAULT '0',
  `pegaza_id` int(11) NOT NULL DEFAULT '0',
  `det_prod_cantidad` int(4) NOT NULL DEFAULT '0',
  `det_prod_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_prod_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  `det_prod_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_det_pedido`,`pedido_id`,`producto_id`,`pegaza_id`),
  KEY `pegaza_id` (`pegaza_id`),
  KEY `producto_id` (`producto_id`),
  KEY `pedido_id` (`pedido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.detalle_pedido: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` (`id_det_pedido`, `pedido_id`, `producto_id`, `pegaza_id`, `det_prod_cantidad`, `det_prod_precio`, `det_prod_subtotal`, `det_prod_status`) VALUES
	(21, 24, 2, 0, 5, 300.00, 1500.00, 1),
	(22, 25, 1, 0, 20, 370.00, 7400.00, 1),
	(23, 26, 4, 0, 2, 100.00, 200.00, 1),
	(24, 26, 3, 0, 8, 100.00, 800.00, 1),
	(25, 26, 4, 0, 20, 100.00, 2000.00, 1),
	(37, 38, 2, 0, 5, 400.00, 2000.00, 1),
	(38, 38, 1, 0, 3, 300.00, 900.00, 1),
	(39, 38, 3, 0, 15, 120.00, 1800.00, 1),
	(40, 39, 4, 0, 15, 100.00, 1500.00, 1),
	(41, 39, 1, 0, 20, 175.00, 3500.00, 1),
	(42, 40, 1, 0, 15, 175.00, 2625.00, 1),
	(43, 41, 1, 0, 12, 175.00, 2100.00, 1),
	(45, 43, 3, 0, 1, 150.00, 150.00, 1),
	(59, 42, 1, 0, 10, 175.00, 1750.00, 1),
	(60, 0, 4, 1, 15, 0.00, 0.00, 1),
	(61, 0, 3, 1, 20, 0.00, 0.00, 1);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.detalle_requisitos
CREATE TABLE IF NOT EXISTS `detalle_requisitos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `mp_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `det_cantidad` int(4) NOT NULL DEFAULT '0',
  `det_precio` double(7,2) NOT NULL DEFAULT '0.00',
  `det_subtotal` double(7,2) NOT NULL DEFAULT '0.00',
  `det_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_detalle`,`mp_id`,`producto_id`),
  KEY `det_materia_prima_id` (`mp_id`),
  KEY `det_producto_id` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.detalle_requisitos: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_requisitos` DISABLE KEYS */;
INSERT INTO `detalle_requisitos` (`id_detalle`, `mp_id`, `producto_id`, `det_cantidad`, `det_precio`, `det_subtotal`, `det_status`) VALUES
	(1, 3, 1, 15, 70.00, 42.00, 1),
	(2, 1, 1, 10, 110.00, 55.00, 1),
	(3, 2, 1, 20, 220.00, 88.00, 1),
	(4, 2, 3, 5, 220.00, 22.00, 1),
	(5, 4, 3, 10, 250.00, 25.00, 1),
	(6, 6, 4, 2, 90.00, 9.00, 1),
	(7, 5, 4, 2, 100.00, 4.00, 1),
	(8, 1, 4, 5, 110.00, 27.50, 1),
	(9, 2, 5, 10, 220.00, 44.00, 1),
	(10, 4, 5, 50, 250.00, 125.00, 1),
	(11, 1, 5, 10, 110.00, 55.00, 1),
	(12, 5, 5, 5, 100.00, 10.00, 1),
	(13, 2, 6, 25, 220.00, 110.00, 1),
	(14, 1, 6, 10, 110.00, 55.00, 1);
/*!40000 ALTER TABLE `detalle_requisitos` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.detalle_viaje
CREATE TABLE IF NOT EXISTS `detalle_viaje` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `det_tipo` enum('COBRANZA','ENTREGA') NOT NULL DEFAULT 'ENTREGA',
  `det_status` enum('ENTREGADO','COBRADO','PENDIENTE','NO SE ENTREGO') NOT NULL DEFAULT 'PENDIENTE',
  PRIMARY KEY (`id_detalle`,`viaje_id`,`pedido_id`),
  KEY `viaje_id` (`viaje_id`,`pedido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.detalle_viaje: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_viaje` DISABLE KEYS */;
INSERT INTO `detalle_viaje` (`id_detalle`, `viaje_id`, `pedido_id`, `det_tipo`, `det_status`) VALUES
	(5, 2, 38, 'ENTREGA', 'PENDIENTE'),
	(6, 2, 42, 'ENTREGA', 'PENDIENTE'),
	(7, 2, 24, 'COBRANZA', 'PENDIENTE'),
	(8, 2, 26, 'COBRANZA', 'PENDIENTE');
/*!40000 ALTER TABLE `detalle_viaje` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.documentos
CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documentos` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) NOT NULL,
  `acta_nacimiento` tinyint(1) NOT NULL,
  `comprobante_domicilio` tinyint(1) NOT NULL,
  `seguro_social` tinyint(1) NOT NULL,
  `curp` tinyint(1) NOT NULL,
  `ine` tinyint(1) NOT NULL,
  `licencia_conducir` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_documentos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.documentos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` (`id_documentos`, `empleado_id`, `acta_nacimiento`, `comprobante_domicilio`, `seguro_social`, `curp`, `ine`, `licencia_conducir`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 1, '2017-10-23 17:10:55', '2017-10-23 17:10:55'),
	(2, 2, 1, 1, 1, 1, 1, 1, '2017-10-30 03:11:24', '2017-10-30 03:11:24'),
	(3, 3, 1, 1, 1, 1, 1, 1, '2017-10-30 03:11:35', '2017-10-30 03:11:35');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.documentos_cl
CREATE TABLE IF NOT EXISTS `documentos_cl` (
  `id_documentos_cl` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `hacienda` tinyint(1) NOT NULL DEFAULT '0',
  `comprobante_domicilio` tinyint(1) NOT NULL DEFAULT '0',
  `ine` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_documentos_cl`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.documentos_cl: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `documentos_cl` DISABLE KEYS */;
INSERT INTO `documentos_cl` (`id_documentos_cl`, `cliente_id`, `hacienda`, `comprobante_domicilio`, `ine`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, '2017-10-23 17:13:35', '2017-10-23 17:13:35'),
	(2, 2, 1, 1, 1, '2017-10-26 16:24:16', '2017-10-26 16:24:16'),
	(3, 3, 1, 1, 1, '2017-10-27 11:49:18', '2017-10-27 11:49:18'),
	(4, 4, 1, 1, 1, '2017-10-30 14:20:11', '2017-10-30 14:20:11'),
	(5, 5, 1, 1, 1, '2017-10-30 15:41:21', '2017-10-30 15:41:21'),
	(6, 6, 1, 1, 0, '2017-10-30 15:47:51', '2017-10-30 15:47:51');
/*!40000 ALTER TABLE `documentos_cl` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.domicilio
CREATE TABLE IF NOT EXISTS `domicilio` (
  `id_domicilio` int(11) NOT NULL AUTO_INCREMENT,
  `dom_calle` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_colonia` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_ciudad` text COLLATE utf8_unicode_ci NOT NULL,
  `dom_codigo_postal` int(6) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_domicilio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.domicilio: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `domicilio` DISABLE KEYS */;
INSERT INTO `domicilio` (`id_domicilio`, `dom_calle`, `dom_colonia`, `dom_ciudad`, `dom_codigo_postal`, `cliente_id`, `created_at`, `updated_at`) VALUES
	(1, 'AV J MERCED CABRERA #500', 'BUROCRATAS DEL ESTADO', 'TECOMAN', 28763, 1, '2017-10-23 17:13:35', '2017-10-23 17:13:35'),
	(2, 'AV PABLO SILVA GARCIA #800', 'SAN PABLO', 'MANZANILLO', 28956, 1, '2017-10-23 17:13:35', '2017-10-23 17:13:35'),
	(3, '5 DE MAYO #358', 'CENTRO', 'COLIMA', 28960, 2, '2017-10-26 16:24:16', '2017-10-26 16:24:16'),
	(4, 'AV NIÑOS HEROES', 'MAGISTERIAL', 'GUADALAJARA', 37096, 3, '2017-10-27 11:49:18', '2017-10-27 11:49:18'),
	(5, 'BUGAMBILIA', 'HACIENDA', 'TECOMAN', 28978, 4, '2017-10-30 14:20:11', '2017-10-30 14:20:11'),
	(6, 'FLOR NARANJO', 'ALBARRADA', 'COLIMA', 28972, 4, '2017-10-30 14:20:11', '2017-10-30 14:20:11'),
	(7, 'NARANJO #234', 'LOMAS ALTAS', 'TECOMAN', 28725, 5, '2017-10-30 15:41:21', '2017-10-30 15:41:21'),
	(8, 'SOL DE PARK #567', 'SOLIDARIDAD', 'VILLA DE ALVAREZ', 28978, 6, '2017-10-30 15:47:51', '2017-10-30 15:47:51');
/*!40000 ALTER TABLE `domicilio` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `em_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_curp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_num_seg_social` int(100) NOT NULL,
  `em_fecha_inicio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_num_licencia` int(100) NOT NULL,
  `em_vigencia_licencia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_fecha_final` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `em_tipo` enum('CONTRATO','BASE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.empleado: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`id_empleado`, `em_nombre`, `em_curp`, `em_num_seg_social`, `em_fecha_inicio`, `em_num_licencia`, `em_vigencia_licencia`, `em_fecha_final`, `em_tipo`, `em_status`, `created_at`, `updated_at`) VALUES
	(1, 'ANDRES TORRES CARDENAS', 'ATC901208HCMTRR04', 1890356, '23/10/2017', 145, '22-11-21', '', 'BASE', 1, '2017-10-23 17:10:55', '2017-10-23 17:10:55'),
	(2, 'JOSE DE JESUS GONZALEZ JUAREZ', 'GOJJ920420HCMNRS06', 0, '20/10/2015', 0, '', '', 'BASE', 1, '2017-10-29 22:10:54', '2017-10-29 22:10:58'),
	(3, 'JORGE LUIS GUTIERREZ MARTINEZ', 'GUJL920815HCMNRS02', 0, '20/10/2015', 0, '', '', 'BASE', 1, '2017-10-30 01:33:32', '2017-10-30 01:33:32');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.fallas
CREATE TABLE IF NOT EXISTS `fallas` (
  `id_fallo` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` int(100) NOT NULL,
  PRIMARY KEY (`id_fallo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.fallas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `fallas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fallas` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.gastos
CREATE TABLE IF NOT EXISTS `gastos` (
  `id_gastos` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_nota` int(200) NOT NULL,
  `importe` int(100) NOT NULL,
  `entregado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_gastos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.gastos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.materia_prima
CREATE TABLE IF NOT EXISTS `materia_prima` (
  `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT,
  `mp_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `mp_precio` double(6,2) NOT NULL DEFAULT '0.00',
  `mp_cantidad` int(2) NOT NULL DEFAULT '0',
  `mp_unidad` enum('KILOS','LITROS','PIEZAS','MILILITROS','METROS') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'KILOS',
  `mp_status` tinyint(1) NOT NULL DEFAULT '1',
  `mp_observacion` text COLLATE utf8_unicode_ci,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_materia_prima`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.materia_prima: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_prima` DISABLE KEYS */;
INSERT INTO `materia_prima` (`id_materia_prima`, `mp_nombre`, `mp_precio`, `mp_cantidad`, `mp_unidad`, `mp_status`, `mp_observacion`, `created_at`, `updated_at`) VALUES
	(1, 'cemento gris', 110.00, 20, 'KILOS', 1, 'esta completo', '2017-10-23', '2017-10-25'),
	(2, 'cemento rojo', 220.00, 50, 'KILOS', 1, 'esta completo', '2017-10-23', '2017-10-23'),
	(3, 'cal blanca', 70.00, 25, 'KILOS', 1, 'esta completa', '2017-10-23', '2017-10-23'),
	(4, 'ladrillo rojo', 250.00, 100, 'PIEZAS', 1, 'estan completos.', '2017-10-23', '2017-10-23'),
	(5, 'adhesivo', 100.00, 50, 'LITROS', 1, 'esta completa.', '2017-10-23', '2017-10-23'),
	(6, 'arena', 90.00, 20, 'METROS', 1, 'esta completa.', '2017-10-23', '2017-10-23'),
	(7, 'MORTERO', 180.00, 50, 'KILOS', 1, 'ESTA COMPLETO.', '2017-10-27', '2017-10-27');
/*!40000 ALTER TABLE `materia_prima` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.movimiento_temporal
CREATE TABLE IF NOT EXISTS `movimiento_temporal` (
  `id_movimiento_temporal` int(11) NOT NULL AUTO_INCREMENT,
  `mt_entregado` double(6,2) NOT NULL DEFAULT '0.00',
  `mt_firma` tinyint(1) NOT NULL DEFAULT '0',
  `mt_status` enum('PENDIENTE','FINALIZADO') NOT NULL DEFAULT 'PENDIENTE',
  `mt_gasto` double(6,2) NOT NULL DEFAULT '0.00',
  `empleado_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_movimiento_temporal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.movimiento_temporal: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `movimiento_temporal` DISABLE KEYS */;
INSERT INTO `movimiento_temporal` (`id_movimiento_temporal`, `mt_entregado`, `mt_firma`, `mt_status`, `mt_gasto`, `empleado_id`, `created_at`, `updated_at`) VALUES
	(6, 1500.00, 1, 'PENDIENTE', 0.00, 1, '2017-11-05', '2017-11-06');
/*!40000 ALTER TABLE `movimiento_temporal` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla azulejos.pedidos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id_pedido`, `cliente_id`, `pe_importe`, `pe_total_abonado`, `pe_nota`, `pe_fecha_pedido`, `pe_fecha_entrega`, `pe_destino_pedido`, `pe_destino_ciudad`, `pe_memo`, `pe_termino`, `pe_forma_pago`, `pe_pago_status`, `pe_status`, `created_at`, `updated_at`) VALUES
	(24, 5, 1500.00, 0.00, '5958', '2017-10-29', '2017-11-06', 'NARANJO #234 LOMAS ALTAS ', 'TECOMAN', 'SE ENTREGARA EN OBRA', 'CONTADO', 'EFECTIVO', 'PENDIENTE', 'EN CAMINO A COBRAR', '2017-10-30 22:49:16', '2017-10-30 22:49:16'),
	(25, 4, 7400.00, 0.00, '5959', '2017-10-27', '2017-11-02', 'BUGAMBILIA HACIENDA ', 'TECOMAN', 'EN OBRA', '1 SEMANA', 'CHEQUE', 'PENDIENTE', 'PENDIENTE PARA PRODUCCION', '2017-10-30 22:51:27', '2017-10-30 22:51:27'),
	(26, 1, 3000.00, 0.00, '5960', '2017-10-28', '2017-11-05', 'AV PABLO SILVA GARCIA #800, SAN PABLO', 'MANZANILLO', 'SE ENTREGARA EN LA OBRA', '1 MES', 'EFECTIVO', 'PENDIENTE', 'EN CAMINO A COBRAR', '2017-10-31 00:55:37', '2017-10-31 00:55:37'),
	(38, 4, 4700.00, 0.00, '5961', '2017-11-01', '2017-11-10', 'FLOR NARANJO, ALBARRADA', 'COLIMA', 'NOSE QUE PONER', '1 MES', 'EFECTIVO', 'PENDIENTE', 'EN CAMINO A ENTREGAR', '2017-11-02 02:12:06', '2017-11-02 02:12:06'),
	(39, 5, 5000.00, 0.00, '5962', '2017-11-02', '2017-11-02', 'NARANJO #234, LOMAS ALTAS', 'TECOMAN', 'OLOLO', 'CONTADO', 'DEPOSITO', 'PAGADO', 'ENTREGADO', '2017-11-02 02:16:13', '2017-11-02 02:16:13'),
	(40, 1, 2625.00, 0.00, '5963', '2017-11-02', '2017-11-11', 'AV J MERCED CABRERA #500, BUROCRATAS DEL ESTADO', 'TECOMAN', 'LOLOLO', 'CONTADO', 'CHEQUE', 'PAGADO', 'ENTREGADO', '2017-11-02 02:17:42', '2017-11-02 02:17:42'),
	(41, 1, 2100.00, 0.00, '5964', '2017-11-02', '2017-11-11', 'AV J MERCED CABRERA #500, BUROCRATAS DEL ESTADO', 'TECOMAN', 'ASDASD', 'CONTADO', 'CHEQUE', 'PAGADO', 'ENTREGADO', '2017-11-02 02:26:26', '2017-11-02 02:26:26'),
	(42, 1, 1750.00, 0.00, '5964', '2017-10-31', '2017-11-05', 'AV PABLO SILVA GARCIA #800, SAN PABLO', 'MANZANILLO', 'OTRA COSA MODIFICADA', 'CONTADO', 'DEPOSITO', 'ABONADO', 'EN CAMINO A ENTREGAR', '2017-11-02 02:29:21', '2017-11-02 21:38:34');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.pedido_pegaza
CREATE TABLE IF NOT EXISTS `pedido_pegaza` (
  `id_pegaza` int(11) NOT NULL AUTO_INCREMENT,
  `pp_memo` text NOT NULL,
  `pp_nota` varchar(50) NOT NULL DEFAULT '0',
  `pp_status` enum('PENDIENTE','EN PRODUCCION','COMPLETADO','CANCELADO') NOT NULL DEFAULT 'PENDIENTE',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_pegaza`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.pedido_pegaza: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `pedido_pegaza` DISABLE KEYS */;
INSERT INTO `pedido_pegaza` (`id_pegaza`, `pp_memo`, `pp_nota`, `pp_status`, `created_at`, `updated_at`) VALUES
	(1, 'LOL', '0101', 'PENDIENTE', '2017-11-03', '2017-11-03');
/*!40000 ALTER TABLE `pedido_pegaza` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.prestamo
CREATE TABLE IF NOT EXISTS `prestamo` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `pres_cantidad` double(6,2) NOT NULL DEFAULT '0.00',
  `pres_status` enum('PENDIENTE','LISTO','NO APROBADO') NOT NULL DEFAULT 'PENDIENTE',
  `pres_descripcion` text NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `viaje_id` int(11) NOT NULL DEFAULT '0',
  `movimiento_temporal_id` int(11) NOT NULL DEFAULT '0',
  `pres_tipo` enum('PERSONAL','GASTO') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.prestamo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.produccion
CREATE TABLE IF NOT EXISTS `produccion` (
  `id_produccion` int(11) NOT NULL AUTO_INCREMENT,
  `pr_encargado` varchar(60) NOT NULL,
  `pr_ayudante` varchar(60) NOT NULL,
  `pr_turno` enum('MATUTINO','VESPERTINO') NOT NULL,
  `pr_completo` tinyint(1) NOT NULL DEFAULT '0',
  `pr_recibido` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_produccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.produccion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `produccion` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `pd_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `pd_tipo` enum('ENSAMBLADO','NO ENSAMBLADO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO ENSAMBLADO',
  `pd_costo` double(7,2) NOT NULL DEFAULT '0.00',
  `pd_precio_venta` double(7,2) NOT NULL DEFAULT '0.00',
  `pd_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.producto: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id_producto`, `pd_nombre`, `pd_tipo`, `pd_costo`, `pd_precio_venta`, `pd_status`, `created_at`, `updated_at`) VALUES
	(1, 'pegapiso gris', 'ENSAMBLADO', 185.00, 370.00, 1, '2017-10-23', '2017-10-23'),
	(2, 'lampara led', 'NO ENSAMBLADO', 100.00, 220.00, 1, '2017-10-23', '2017-10-23'),
	(3, 'pegapiso rojo', 'ENSAMBLADO', 47.00, 100.00, 1, '2017-10-23', '2017-10-23'),
	(4, 'pegapiso azul', 'ENSAMBLADO', 40.50, 100.00, 1, '2017-10-23', '2017-10-23');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `pv_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `pv_domicilio` text COLLATE utf8_unicode_ci NOT NULL,
  `pv_ciudad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pv_rfc` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pv_correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pv_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `pv_rfc` (`pv_rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.proveedor: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`id_proveedor`, `pv_nombre`, `pv_domicilio`, `pv_ciudad`, `pv_rfc`, `pv_correo`, `pv_status`, `created_at`, `updated_at`) VALUES
	(1, 'HOLCIM APASCO', 'CARRT. TECOMAN-MADRID #1', 'TECOMAN, COL.', 'HOLAPA189034', 'VENTAS@APASCO.COM', 1, '2017-10-27 11:54:26', '2017-10-27 11:54:26'),
	(2, 'promapesa', 'conocido', 'ñpurblo', 'rere', '', 1, '2017-10-27 16:51:27', '2017-10-27 16:51:27');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) NOT NULL,
  `perfil` enum('CAJA','ADMIN') NOT NULL DEFAULT 'CAJA',
  `usuario` varchar(50) NOT NULL,
  `us_status` tinyint(1) NOT NULL DEFAULT '1',
  `password` text NOT NULL,
  `remember_token` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `empleado_id`, `perfil`, `usuario`, `us_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 2, 'ADMIN', 'JESUS', 1, '$2y$10$mLGX6NgHqayQwXLYhA6kU.RCDzixb3t8HKYlQP6YJeUM3Lld31BuO', 'tsrAeH9K6WPHmpAmdxjjWxFc4biHAlQ3IOcWtunxPq4kLbBSvCOKeboYeyFK', '2017-10-29', '2017-10-30'),
	(2, 3, 'ADMIN', 'JORGE', 1, '$2y$10$mLGX6NgHqayQwXLYhA6kU.RCDzixb3t8HKYlQP6YJeUM3Lld31BuO', 'tXPbtpFcZse7lVTq1b0egHPrUWHs1ewvQk8yIDiBuNp7vaPyR5fdImlgIa3r', '2017-10-30', '2017-10-30');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.vehiculo
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `placas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vh_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vh_caracteristicas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vh_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`placas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla azulejos.vehiculo: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` (`placas`, `vh_nombre`, `vh_caracteristicas`, `vh_status`, `created_at`, `updated_at`) VALUES
	('FTP-102-11', 'TOYOTA BLANCA', 'CAMION GRANDE PARA LLEVAR PRODUCCION', 1, '2017-11-03 01:01:35', '2017-11-03 01:01:40');
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;

-- Volcando estructura para tabla azulejos.viaje
CREATE TABLE IF NOT EXISTS `viaje` (
  `id_viaje` int(11) NOT NULL AUTO_INCREMENT,
  `vi_kilometraje_inicial` varchar(25) NOT NULL DEFAULT '0',
  `vi_kilometraje_final` varchar(25) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `vehiculo_id` varchar(50) NOT NULL,
  `vi_destino` text NOT NULL,
  `vi_viaticos` double(7,2) NOT NULL DEFAULT '0.00',
  `vi_status` tinyint(1) NOT NULL DEFAULT '0',
  `vi_observaciones` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id_viaje`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla azulejos.viaje: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` (`id_viaje`, `vi_kilometraje_inicial`, `vi_kilometraje_final`, `empleado_id`, `vehiculo_id`, `vi_destino`, `vi_viaticos`, `vi_status`, `vi_observaciones`, `created_at`, `updated_at`) VALUES
	(2, '15700', '15850', 2, 'FTP-102-11', 'MANZANILLO', 1000.00, 0, '', '2017-11-03', '2017-11-03');
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
