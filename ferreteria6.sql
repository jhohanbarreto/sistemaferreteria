-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2020 a las 03:52:15
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreteria6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `fecha`) VALUES
(1, 'Desague', '2020-06-30 13:28:17'),
(2, 'Agua', '2020-06-30 13:28:17'),
(3, 'Luz', '2020-06-30 13:28:17'),
(4, 'Construccion', '2020-06-30 13:28:17'),
(5, 'Herramientas', '2020-06-30 13:28:17'),
(6, 'Limpieza', '2020-06-30 13:28:17'),
(7, 'Madera', '2020-06-30 13:28:17'),
(8, 'Tornillos y otros', '2020-06-30 13:28:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `ruc` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `documento` text NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `direccion` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `ruc`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(2, 0, 'luis gutirres', '72256598', 'jhohan_bc_20@hotmail.com', '(454) 545-4545', 'av.villa maria', '1998-02-05', 54, '2020-06-30 20:47:53', '2020-06-16 04:39:22'),
(3, 0, 'pedro suarez', '74256598', 'genviv96@hotmail.com', '(254) 446-6552', 'AVENIDA SANTA ROSA 226', '1995-05-10', 35, '2020-06-30 20:48:32', '2020-06-16 18:34:43'),
(4, 0, 'jhohan barreto', '72256595', 'jhohanrobinson@gmail.com', '(156) 666-6666', 'av.villa marialima', '2000-10-10', 21, '2020-06-30 20:46:50', '2020-06-16 18:36:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '1001', 'TUBO DE 6 pulgadas  DESAGUE NARANJA', 'vistas/img/productos/1001/396.jpg', 2, 58, 85, 0, '2020-06-30 19:22:25'),
(2, 1, '1002', 'TUBO DE 4 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1002/343.jpg', 20, 15, 20, 0, '2020-06-30 19:22:25'),
(3, 1, '1003', 'TUBO DE 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1003/491.jpg', 2, 7, 10, 0, '2020-06-30 19:22:25'),
(4, 1, '1004', 'CODO 4 pulgadas x90 grados  DESAGUE NICOLL', 'vistas/img/productos/1004/401.jpg', 33, 4, 6, 0, '2020-06-30 19:22:25'),
(5, 1, '1005', 'CODO 4 pulgadas x45 grados  DESAGUE NICOLL', 'vistas/img/productos/1005/342.jpg', 24, 4, 6, 0, '2020-06-30 19:22:25'),
(6, 1, '1006', 'CODO 4 pulgadas A 2 pulgadas x90 grados  DESAGUE NICOLL', 'vistas/img/productos/1006/304.jpg', 5, 7, 9, 0, '2020-06-30 19:22:25'),
(7, 1, '1007', 'CODO 2 pulgadas x90 grados  DESAGUE NICOLL', 'vistas/img/productos/1007/824.jpg', 86, 1, 3, 0, '2020-06-30 19:22:25'),
(8, 1, '1008', 'CODO 2 pulgadas x45 grados  DESAGUE NICOLL', 'vistas/img/productos/1008/237.jpg', 56, 1, 3, 0, '2020-06-30 19:22:25'),
(9, 1, '1009', 'TEE 4 pulgadas x 4 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1009/486.jpg', 27, 6, 8, 0, '2020-06-30 19:22:25'),
(10, 1, '1010', 'TEE 4 pulgadas x 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1010/495.png', 29, 4, 8, 0, '2020-06-30 19:22:25'),
(11, 1, '1011', 'TEE 4 pulgadas x 4 pulgadas  SANITARIA DESAGUE NICOLL', 'vistas/img/productos/1011/628.png', 14, 10, 12, 0, '2020-06-30 19:22:25'),
(12, 1, '1012', 'TEE 2 pulgadas x 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1012/104.png', 80, 2, 4, 0, '2020-06-30 19:22:25'),
(13, 1, '1013', 'YEE 4 pulgadas x 4 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1013/955.png', 25, 9, 11, 0, '2020-06-30 19:22:25'),
(14, 1, '1014', 'YEE 4 pulgadas x 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1014/530.png', 13, 5, 7, 0, '2020-06-30 19:22:25'),
(15, 1, '1015', 'YEE 2 pulgadas x 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1015/253.png', 57, 2, 4, 0, '2020-06-30 19:22:25'),
(16, 1, '1016', 'REDUCCION 4 pulgadas A 2 pulgadas  DESAGUE NICOLL', 'vistas/img/productos/1016/506.png', 27, 3, 4, 0, '2020-06-30 19:22:25'),
(17, 1, '1017', 'TRAMPA DE 2 pulgadas ', 'vistas/img/productos/1017/163.jpg', 2, 3, 6, 0, '2020-06-30 19:22:25'),
(18, 1, '1018', 'TRAMPA DE 2 pulgadas  NICOLL', 'vistas/img/productos/1018/854.png', 4, 0, 15, 0, '2020-06-30 19:22:25'),
(19, 1, '1019', 'CEMENTO BLANCO 1KG', 'vistas/img/productos/1019/103.jpg', 2, 1, 3, 0, '2020-06-30 19:22:25'),
(20, 1, '1020', 'TUBO DE 4 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1020/781.png', 17, 12, 17, 0, '2020-06-30 19:22:25'),
(21, 1, '1021', 'TUBO DE 2 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1021/364.png', 0, 6, 8, 0, '2020-06-30 19:22:25'),
(22, 1, '1022', 'CODO 4 pulgadas x90 grados  DESAGUE ECONOMICO', 'vistas/img/productos/1022/307.jpg', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(23, 1, '1023', 'CODO 2 pulgadas x90 grados  DESAGUE ECONOMICO', 'vistas/img/productos/1023/108.jpg', 4, 0, 2, 0, '2020-06-30 19:22:25'),
(24, 1, '1024', 'TEE 4 pulgadas x4 grados  DESAGUE ECONOMICO', 'vistas/img/productos/1024/683.jpg', 14, 3, 6, 0, '2020-06-30 19:22:25'),
(25, 1, '1025', 'TEE 4 pulgadas x2 grados  DESAGUE ECONOMICO', 'vistas/img/productos/1025/679.png', 0, 2, 6, 0, '2020-06-30 19:22:25'),
(26, 1, '1026', 'TEE 2 pulgadas x2 grados  DESAGUE ECONOMICO', 'vistas/img/productos/1026/156.png', 11, 1, 3, 0, '2020-06-30 19:22:25'),
(27, 1, '1027', 'YEE 4 pulgadas x 4 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1027/348.png', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(28, 1, '1028', 'YEE 4 pulgadas x 2 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1028/368.png', 2, 3, 6, 0, '2020-06-30 19:22:25'),
(29, 1, '1029', 'YEE 2 pulgadas x 2 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1029/483.png', 18, 1, 3, 0, '2020-06-30 19:22:25'),
(30, 1, '1030', 'UNION 4 pulgadas  NICOLL', 'vistas/img/productos/1030/391.jpg', 22, 1, 2, 0, '2020-06-30 19:22:25'),
(31, 1, '1031', 'UNION 2 pulgadas  NICOLL', 'vistas/img/productos/1031/513.png', 5, 0, 1, 0, '2020-06-30 19:22:25'),
(32, 1, '1032', 'TAPON 4 pulgadas  ECONOMICO', 'vistas/img/productos/1032/605.png', 3, 1, 3, 0, '2020-06-30 19:22:25'),
(33, 1, '1033', 'TAPON 2 pulgadas  ECONOMICO', 'vistas/img/productos/1033/400.png', 5, 0, 2, 0, '2020-06-30 19:22:25'),
(34, 1, '1034', 'REDUCCION 2 pulgadas A 1 pulgadas  DESAGUE ECONOMICO', 'vistas/img/productos/1034/405.png', 1, 0, 1, 0, '2020-06-30 19:22:25'),
(35, 2, '2001', 'TUBO DE 1 pulgadas  AGUA C/R NICOLL', '', 8, 18, 22, 0, '2020-06-30 19:22:25'),
(36, 2, '2002', 'TUBO DE 3/4 pulgadas  AGUA NICOLL', '', 16, 14, 18, 0, '2020-06-30 19:22:25'),
(37, 2, '2003', 'TUBO DE 1/2 pulgadas  AGUA NICOLL', '', 26, 8, 13, 0, '2020-06-30 19:22:25'),
(38, 2, '2004', 'CODO 1 pulgadas x90 grados  AGUA NICOLL', '', 12, 2, 4, 0, '2020-06-30 19:22:25'),
(39, 2, '2005', 'CODO 3/4 pulgadas x90 grados  AGUA NICOLL', '', 76, 1, 3, 0, '2020-06-30 19:22:25'),
(40, 2, '2006', 'CODO 1/2 pulgadas x90 grados  AGUA NICOLL', '', 161, 0, 2, 0, '2020-06-30 19:22:25'),
(41, 2, '2007', 'CODO 1/2 pulgadas x45 grados  AGUA NICOLL', '', 25, 0, 2, 0, '2020-06-30 19:22:25'),
(42, 2, '2008', 'TEE 3/4 pulgadas  AGUA NICOLL', '', 43, 1, 3, 0, '2020-06-30 19:22:25'),
(43, 2, '2009', 'TEE 1/2 pulgadas  AGUA NICOLL', '', 52, 1, 3, 0, '2020-06-30 19:22:25'),
(44, 2, '2010', 'TEE 1 pulgadas  AGUA NICOLL', '', 3, 0, 0, 0, '2020-06-30 19:22:25'),
(45, 2, '2011', 'TEE 1/2 pulgadas  AGUA ECONOMICO', '', 24, 0, 0, 0, '2020-06-30 19:22:25'),
(46, 2, '2012', 'TEE 1/2 pulgadas  AGUA ECONOMICO MIXTO', '', 18, 0, 0, 0, '2020-06-30 19:22:25'),
(47, 2, '2013', 'UNION 3/4 pulgadas  AGUA NICOLL', '', 71, 1, 2, 0, '2020-06-30 19:22:25'),
(48, 2, '2014', 'UNION 3/4 pulgadas  AGUA NICOLL PVC MIXTA', '', 3, 0, 2, 0, '2020-06-30 19:22:25'),
(49, 2, '2015', 'UNION 1/2 pulgadas  AGUA NICOLL', '', 78, 0, 2, 0, '2020-06-30 19:22:25'),
(50, 2, '2016', 'UNION 1/2 pulgadas  AGUA ECONOMICA', '', 67, 0, 0, 0, '2020-06-30 19:22:25'),
(51, 2, '2017', 'UNION 1 pulgadas  AGUA NICOLL', '', 9, 1, 2, 0, '2020-06-30 19:22:25'),
(52, 2, '2018', 'REDUCCION 3/4 A 1/2 pulgadas  AGUA NICOLL', '', 140, 1, 2, 0, '2020-06-30 19:22:25'),
(53, 2, '2019', 'REDUCCION 3/4 A 1/2 pulgadas  AGUA NICOLL TUBO', '', 13, 0, 2, 0, '2020-06-30 19:22:25'),
(54, 2, '2020', 'REDUCCION 1 pulgadas  A 3/4  AGUA NICOLL TUBO', '', 8, 1, 2, 0, '2020-06-30 19:22:25'),
(55, 2, '2021', 'ADAPTADOR DE 1/2 pulgadas  AGUA NICOLL TUBO', '', 179, 0, 1, 0, '2020-06-30 19:22:25'),
(56, 2, '2022', 'ADAPTADOR DE 1/2 pulgadas  AGUA NICOLL FABRICA', '', 128, 0, 1, 0, '2020-06-30 19:22:25'),
(57, 2, '2023', 'ADAPTADOR DE 1 pulgadas  AGUA NICOLL', '', 4, 0, 0, 0, '2020-06-30 19:22:25'),
(58, 2, '2024', 'TAPON MACHO DE 1/2 pulgadas  AGUA NICOLL', '', 121, 0, 1, 0, '2020-06-30 19:22:25'),
(59, 2, '2025', 'TAPON HEMBRA DE 1/2 pulgadas  AGUA NICOLL', '', 99, 0, 1, 0, '2020-06-30 19:22:25'),
(60, 2, '2026', 'TAPON HEMBRA DE 1/2 pulgadas  AGUA NICOLL MIXTA', '', 97, 0, 0, 0, '2020-06-30 19:22:25'),
(61, 2, '2027', 'TAPON HEMBRA DE 3/4 pulgadas  AGUA NICOLL', '', 11, 0, 1, 0, '2020-06-30 19:22:25'),
(62, 2, '2028', 'TAPON HEMBRA DE 1 pulgadas  AGUA NICOLL', '', 29, 0, 1, 0, '2020-06-30 19:22:25'),
(63, 2, '2029', 'TAPON HEMBRA DE 1 pulgadas  AGUA NICOLL MIXTA', '', 10, 0, 0, 0, '2020-06-30 19:22:25'),
(64, 2, '2030', 'NIPLE 1/2 x 1/2 pulgadas  AGUA NICOLL', '', 49, 0, 1, 0, '2020-06-30 19:22:25'),
(65, 2, '2031', 'NIPLE 1/2 x 1 pulgadas  AGUA NICOLL BLANCO', '', 100, 0, 1, 0, '2020-06-30 19:22:25'),
(66, 2, '2032', 'NIPLE 3/4 x 1 pulgadas  AGUA NICOLL', '', 23, 0, 0, 0, '2020-06-30 19:22:25'),
(67, 2, '2033', 'NIPLE 1/2 x 2 pulgadas  AGUA NICOLL.', '', 5, 0, 0, 0, '2020-06-30 19:22:25'),
(68, 2, '2034', 'UNION 1/2 pulgadas  AGUA CON ROSCA.', '', 28, 0, 1, 0, '2020-06-30 19:22:25'),
(69, 2, '2035', 'UNION 1/2 pulgadas  AGUA MIXTO.', '', 27, 0, 1, 0, '2020-06-30 19:22:25'),
(70, 2, '2036', 'UNION 1/2 pulgadas  AGUA LISO', '', 24, 0, 0, 0, '2020-06-30 19:22:25'),
(71, 2, '2037', 'CODO DE 1/2 pulgadas  AGUA ECONOMICO', '', 67, 0, 1, 0, '2020-06-30 19:22:25'),
(72, 2, '2038', 'CODO DE 1/2 pulgadas  AGUA ECONOMICO MIXTO  LISO Y R.', '', 69, 0, 0, 0, '2020-06-30 19:22:25'),
(73, 2, '2039', 'CODO DE 1/2 pulgadas  AGUA ECONOMICO MIXTO  ROSCA', '', 9, 0, 0, 0, '2020-06-30 19:22:25'),
(74, 2, '2040', 'UNION DE MAGUERA', '', 74, 0, 1, 0, '2020-06-30 19:22:25'),
(75, 2, '2041', 'UNION DE MAGUERA Y CAÑO', '', 12, 0, 0, 0, '2020-06-30 19:22:25'),
(76, 2, '2042', 'CODO DE BRONCE DE 1/2 pulgadas  LIVIANA', '', 7, 2, 4, 0, '2020-06-30 19:22:25'),
(77, 2, '2043', 'CODO DE BRONCE DE 1/2 pulgadas  PESADA', '', 10, 4, 6, 0, '2020-06-30 19:22:25'),
(78, 2, '2044', 'CODO DE F. GALVANIZADO DE 1/2 pulgadas  ', '', 23, 0, 2, 0, '2020-06-30 19:22:25'),
(79, 2, '2045', 'UNION UNIVERSAL DE 1/2 pulgadas  PAVCO', '', 34, 1, 3, 0, '2020-06-30 19:22:25'),
(80, 2, '2046', 'UNION UNIVERSAL DE 1/2 pulgadas  CAJA', '', 3, 0, 0, 0, '2020-06-30 19:22:25'),
(81, 2, '2047', 'UNION UNIVERSAL DE 3/4 pulgadas  PAVCO', '', 17, 0, 0, 0, '2020-06-30 19:22:25'),
(82, 2, '2048', 'LLAVE DE PASO PVC DE 1/2 pulgadas  CAJA', '', 26, 1, 3, 0, '2020-06-30 19:22:25'),
(83, 2, '2049', 'LLAVE DE PASO PVC DE 1/2 pulgadas  ENBOLSADO EC.', '', 7, 0, 0, 0, '2020-06-30 19:22:25'),
(84, 2, '2050', 'LLAVE DE PASO PVC DE 1/2 pulgadas  PAVCO', '', 29, 0, 0, 0, '2020-06-30 19:22:25'),
(85, 2, '2051', 'LLAVE DE PASO PVC DE 3/4 pulgadas  PAVCO', '', 10, 0, 0, 0, '2020-06-30 19:22:25'),
(86, 2, '2052', 'LLAVE DE PASO BR DE 3/4', '', 2, 0, 0, 0, '2020-06-30 19:22:25'),
(87, 2, '2053', 'LLAVE DE PASO  SIMBALL BR DE 1/2', '', 1, 0, 0, 0, '2020-06-30 19:22:25'),
(88, 2, '2054', 'LLAVE DE PASO BR DE 1/2 pulgadas  KONRAP', '', 11, 4, 6, 0, '2020-06-30 19:22:25'),
(89, 2, '2055', 'LLAVE DE PASO BR DE 1/2 pulgadas  DIRON ROJO', '', 1, 7, 12, 0, '2020-06-30 19:22:25'),
(90, 2, '2056', 'LLAVE DE PASO BR DE 1/2 pulgadas  SUMPOOL', '', 1, 9, 14, 0, '2020-06-30 19:22:25'),
(91, 2, '2057', 'CAÑO JARDIN 1/2 pulgadas  AZUL', '', 6, 4, 9, 0, '2020-06-30 19:22:25'),
(92, 2, '2058', 'CAÑO JARDIN 1/2 pulgadas  FERROS ROJO', '', 5, 5, 10, 0, '2020-06-30 19:22:25'),
(93, 2, '2059', 'CAÑO JARDIN 1/2 pulgadas  KROSS', '', 2, 0, 20, 0, '2020-06-30 19:22:25'),
(94, 2, '2060', 'CAÑO JARDIN 1/2 pulgadas  ASURIN', '', 2, 0, 25, 0, '2020-06-30 19:22:25'),
(95, 2, '2061', 'SUMIDERO 2 pulgadas  BR', '', 5, 1, 4, 0, '2020-06-30 19:22:25'),
(96, 2, '2062', 'REGUISTRO 2 pulgadas  BR', '', 26, 2, 4, 0, '2020-06-30 19:22:25'),
(97, 2, '2063', 'REGUISTRO 4 pulgadas  BR', '', 3, 0, 0, 0, '2020-06-30 19:22:25'),
(98, 2, '2064', 'REGUISTRO 6 pulgadas  BR', '', 3, 17, 21, 0, '2020-06-30 19:22:25'),
(99, 2, '2065', 'CINTA TEFLON ROJO', '', 46, 0, 1, 0, '2020-06-30 19:22:25'),
(100, 2, '2066', 'PEGAMENTO 1/32 AZUL', '', 28, 6, 9, 0, '2020-06-30 19:22:25'),
(101, 2, '2067', 'PEGAMENTO 1/16 AZUL', '', 5, 10, 14, 0, '2020-06-30 19:22:25'),
(102, 2, '2068', 'PEGAMENTO 1/4 AZUL', '', 0, 26, 30, 0, '2020-06-30 19:22:25'),
(103, 2, '2069', 'PEGAMENTO 1/16 BLANCO', '', 7, 5, 8, 0, '2020-06-30 19:22:25'),
(104, 2, '2070', 'PEGAMENTO 1/4 BLANCO', '', 1, 0, 0, 0, '2020-06-30 19:22:25'),
(105, 2, '2071', 'LLAVE DE DUCHA NACIONAL', '', 4, 13, 16, 0, '2020-06-30 19:22:25'),
(106, 2, '2072', 'DUCHA NACIONAL', '', 5, 11, 15, 0, '2020-06-30 19:22:25'),
(107, 2, '2073', 'DUCHA PVC', '', 11, 0, 0, 0, '2020-06-30 19:22:25'),
(108, 2, '2074', 'ANILLO DE CERA CON GUIA', '', 12, 2, 7, 0, '2020-06-30 19:22:25'),
(109, 2, '2075', 'ANILLO DE CERA SIN GUIA', '', 7, 2, 5, 0, '2020-06-30 19:22:25'),
(110, 2, '2076', 'JUEGO TRAMPA BOTELLA DES.PVC LAVATORIO', '', 1, 0, 0, 0, '2020-06-30 19:22:25'),
(111, 2, '2077', 'DUCHA CON AGUA CALIENTE', '', 3, 0, 30, 0, '2020-06-30 19:22:25'),
(112, 2, '2078', 'LLAVE COCINA FAVINZA CUELLO DE GANZO', '', 1, 0, 25, 0, '2020-06-30 19:22:25'),
(113, 2, '2079', 'LLAVE COCINA GALUZA CUELLO DE GANZO', '', 3, 0, 30, 0, '2020-06-30 19:22:25'),
(114, 2, '2080', 'TUBO DE BASTO INODORO ', '', 9, 0, 7, 0, '2020-06-30 19:22:25'),
(115, 2, '2081', 'SED ACCESORIOS INODORO TANUQE', '', 3, 0, 10, 0, '2020-06-30 19:22:25'),
(116, 2, '2082', 'SED ACCESORIOS LAVADERO', '', 1, 0, 10, 0, '2020-06-30 19:22:25'),
(117, 2, '2083', 'TUBO DE BASTO LABADERO', '', 20, 0, 0, 0, '2020-06-30 19:22:25'),
(118, 2, '2084', 'PALANCA INODORO', '', 8, 0, 0, 0, '2020-06-30 19:22:25'),
(119, 3, '3001', 'TUBO DE 1 pulgadas  LUZ NICOLL', '', 0, 3, 5, 0, '2020-06-30 19:22:25'),
(120, 3, '3002', 'TUBO DE 3/4 pulgadas  LUZ NICOLL', '', 0, 2, 3, 0, '2020-06-30 19:22:25'),
(121, 3, '3003', 'CURVA DE 3/4 pulgadas  LUZ NICOLL', '', 0, 0, 0, 0, '2020-06-30 19:22:25'),
(122, 3, '3004', 'CURVA DE 1 pulgadas  LUZ NICOLL', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(123, 3, '3005', 'CAJA RECTANGULAR PAVCO', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(124, 3, '3006', 'CAJA OCTOGONAL PAVCO', '', 0, 1, 1, 0, '2020-06-30 19:22:25'),
(125, 3, '3007', 'SPOT LIGHET', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(126, 3, '3008', 'SPOT PVC', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(127, 3, '3009', 'TUBO DE 3/4 pulgadas  LUZ ECONOMICA', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(128, 3, '3010', 'CAJA RECTANGULAR ECONOMICA', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(129, 3, '3011', 'CAJA OCTOGONAL ECONOMICA', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(130, 3, '3012', 'CAJA PARA MEDIDOR', '', 0, 11, 18, 0, '2020-06-30 19:22:25'),
(131, 3, '3013', 'CURVA DE 3/4 pulgadas  LUZ ECONOMICO', '', 0, 0, 0, 0, '2020-06-30 19:22:25'),
(132, 3, '3014', 'SOKET COLGANTE CASTIL', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(133, 3, '3015', 'INTERRUPTOR  SAPITO', 'vistas/img/productos/3015/764.jpg', 0, 0, 2, 0, '2020-06-30 19:22:25'),
(134, 3, '3016', 'TOMATRIPLE VISIBLE', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(135, 3, '3017', 'FOCO LED 12W', '', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(136, 3, '3018', 'FOCO DE 36W', '', 0, 3, 7, 0, '2020-06-30 19:22:25'),
(137, 3, '3019', 'FOCO LED 20W', '', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(138, 3, '3020', 'DICROICO  LED 7W', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(139, 3, '3021', 'ENCHUFE COLOR', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(140, 3, '3022', 'ENCHUFE NEGRO', '', 0, 0, 2, 0, '2020-06-30 19:22:25'),
(141, 3, '3023', 'INTERRUPTOR SIMPLE', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(142, 3, '3024', 'TOMACORRIENTE DOBLE', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(143, 3, '3025', 'TOMACORRIENTE MIXTO', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(144, 3, '3026', 'SOQUET OVAL', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(145, 3, '3027', 'SOQUET ECONOMICO', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(146, 3, '3028', 'EXTENCION COLOR 3.00M', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(147, 3, '3029', 'EXTENCION AMARILLA 5.00M', '', 0, 7, 11, 0, '2020-06-30 19:22:25'),
(148, 3, '3030', 'ROLLO NRO 14', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(149, 3, '3031', 'ROLLO NRO 12', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(150, 3, '3032', 'TABLERO DE 12 POLOS PVC', '', 0, 11, 16, 0, '2020-06-30 19:22:25'),
(151, 3, '3033', 'TABLERO DE 8 POLOS PVC', '', 0, 7, 12, 0, '2020-06-30 19:22:25'),
(152, 3, '3034', 'CINTA AISLANTE RLL CHICA', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(153, 3, '3035', 'CINTA AISLANTE RLL CGRANDE', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(154, 3, '3036', 'LLAVE DE 2 X 16A', '', 0, 15, 18, 0, '2020-06-30 19:22:25'),
(155, 3, '3037', 'LLAVE DE 2 X 25A', '', 0, 15, 18, 0, '2020-06-30 19:22:25'),
(156, 3, '3038', 'INTERRUPTOR DOBLE', '', 0, 3, 5, 0, '2020-06-30 19:22:25'),
(157, 3, '3039', 'WINCHA PASA CABLE DE 10m', '', 0, 7, 12, 0, '2020-06-30 19:22:25'),
(158, 3, '3040', 'WINCHA PASA CABLE DE 15m', '', 0, 9, 15, 0, '2020-06-30 19:22:25'),
(159, 3, '3041', 'WINCHA PASA CABLE DE 5m', '', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(160, 3, '3042', 'ADAPTADORES', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(161, 3, '3043', 'ROLLO MELLIZO', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(162, 3, '3044', 'MULTIPLES', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(163, 4, '4001', 'CEMENTO SOL VERDE TIPO I', '', 1, 22, 22, 0, '2020-06-30 19:22:25'),
(164, 4, '4002', 'CEMENTO APU', '', 1, 19, 20, 0, '2020-06-30 19:22:25'),
(165, 4, '4003', 'CEMENTO ANDINO TIPO I', '', 1, 0, 21, 0, '2020-06-30 19:22:25'),
(166, 4, '4004', 'FIERRO DE 3/4 pulgadas  ACERO AREQUIPA', '', 1, 64, 65, 0, '2020-06-30 19:22:25'),
(167, 4, '4005', 'FIERRO DE 5/8 pulgadas  ACERO AREQUIPA', '', 1, 43, 44, 0, '2020-06-30 19:22:25'),
(168, 4, '4006', 'FIERRO DE 1/2 pulgadas  ACERO AREQUIPA', '', 1, 28, 29, 0, '2020-06-30 19:22:25'),
(169, 4, '4007', 'FIERRO DE 3/8 pulgadas  ACERO AREQUIPA', '', 1, 15, 17, 0, '2020-06-30 19:22:25'),
(170, 4, '4008', 'FIERRO DE 1/4 pulgadas  ACERO AREQUIPA', '', 1, 6, 7, 0, '2020-06-30 19:22:25'),
(171, 4, '4009', 'ALAMBRE RECOCIDO NRO 16', '', 150, 3, 4, 0, '2020-06-30 19:22:25'),
(172, 4, '4010', 'ALAMBRE RECOCIDO NRO 8', '', 50, 3, 4, 0, '2020-06-30 19:22:25'),
(173, 4, '4011', 'CLAVO ALBAÑIL PRODAC 4 pulgadas ', '', 30, 3, 4, 0, '2020-06-30 19:22:25'),
(174, 4, '4012', 'CLAVO ALBAÑIL PRODAC 3 pulgadas ', '', 30, 3, 4, 0, '2020-06-30 19:22:25'),
(175, 4, '4013', 'CLAVO ALBAÑIL PRODAC 2 pulgadas ', '', 30, 3, 4, 0, '2020-06-30 19:22:25'),
(176, 4, '4014', 'CLAVO ALBAÑIL PRODAC 21/2 pulgadas ', '', 30, 3, 4, 0, '2020-06-30 19:22:25'),
(177, 4, '4015', 'ARENA GRUESA', '', 10, 27, 35, 0, '2020-06-30 19:22:25'),
(178, 4, '4016', 'ARENA FINA', '', 10, 27, 35, 0, '2020-06-30 19:22:25'),
(179, 4, '4017', 'HORMIGON', '', 10, 27, 35, 0, '2020-06-30 19:22:25'),
(180, 4, '4018', 'PIEDRA CHANCADA DE 1/2 pulgadas ', '', 10, 37, 45, 0, '2020-06-30 19:22:25'),
(181, 4, '4019', 'PIEDRA DE ZANJA', '', 10, 36, 45, 0, '2020-06-30 19:22:25'),
(182, 4, '4020', 'LADRILLO KK 18 HUECOS CON POLVO', '', 1, 460, 520, 0, '2020-06-30 19:22:25'),
(183, 4, '4021', 'LADRILLO KK 18 HUECOS FORTALEZA', '', 1, 0, 580, 0, '2020-06-30 19:22:25'),
(184, 4, '4022', 'LADRILLO KK 18 HUECOS PIRAMIDE', '', 1, 0, 650, 0, '2020-06-30 19:22:25'),
(185, 4, '4023', 'LADRILLO KK 18 HUECOS LARK', '', 1, 585, 650, 0, '2020-06-30 19:22:25'),
(186, 4, '4024', 'LADRILLO PANDERETA POLVO', '', 1, 0, 390, 0, '2020-06-30 19:22:25'),
(187, 4, '4025', 'LADRILLO PANDERETA ', '', 1, 0, 440, 0, '2020-06-30 19:22:25'),
(188, 4, '4026', 'LADRILLO DE TECHO', '', 1, 1650, 1720, 0, '2020-06-30 19:22:25'),
(189, 5, '5001', 'MANGUERA 1/2 pulgadas  DUPLEX ', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(190, 5, '5002', 'MANGUERA 5/8 pulgadas  PSD DUPLEX ', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(191, 5, '5003', 'MANGUERA 1/4 pulgadas  TRANSPARENTE', '', 0, 0, 0, 0, '2020-06-30 19:22:25'),
(192, 5, '5004', 'ABRAZADERAS ', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(193, 5, '5005', 'RAFIA ROLLO', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(194, 5, '5006', 'GUANTE FIERRERO', '', 0, 3, 6, 0, '2020-06-30 19:22:25'),
(195, 5, '5007', 'GUANTE CUERO', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(196, 5, '5008', 'OREGERA', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(197, 5, '5009', 'LENTES', '', 0, 1, 4, 0, '2020-06-30 19:22:25'),
(198, 5, '5010', 'LAMPA TRAMONTINA', '', 0, 17, 20, 0, '2020-06-30 19:22:25'),
(199, 5, '5011', 'BARRETA DE 1 grados ', '', 0, 14, 20, 0, '2020-06-30 19:22:25'),
(200, 5, '5012', 'PICO', '', 0, 17, 20, 0, '2020-06-30 19:22:25'),
(201, 5, '5013', 'PUNTA 5/8 pulgadas ', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(202, 5, '5014', 'PUNTA 3/4 pulgadas ', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(203, 5, '5015', 'CINCEL 5/8 pulgadas ', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(204, 5, '5016', 'CINCEL 3/4 pulgadas ', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(205, 5, '5017', 'TORTOL CORRUGADO 3/8 pulgadas ', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(206, 5, '5018', 'TORTOL LISO 3/8 pulgadas ', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(207, 5, '5019', 'COMBITA NRO 4', '', 0, 7, 10, 0, '2020-06-30 19:22:25'),
(208, 5, '5020', 'CILINDRO', '', 0, 28, 32, 0, '2020-06-30 19:22:25'),
(209, 5, '5021', 'BATEA', '', 0, 14, 18, 0, '2020-06-30 19:22:25'),
(210, 5, '5022', 'TRAMPA DOBLAR FE', '', 0, 5, 10, 0, '2020-06-30 19:22:25'),
(211, 5, '5023', 'FORTACHO 25X15', '', 0, 9, 15, 0, '2020-06-30 19:22:25'),
(212, 5, '5024', 'FORTACHO 20X30', '', 0, 12, 18, 0, '2020-06-30 19:22:25'),
(213, 5, '5025', 'BUGGI FIJI', '', 0, 110, 130, 0, '2020-06-30 19:22:25'),
(214, 5, '5026', 'MARTILLO TRAMONTINA', '', 0, 17, 20, 0, '2020-06-30 19:22:25'),
(215, 5, '5027', 'MARTILLO ELO', '', 0, 8, 15, 0, '2020-06-30 19:22:25'),
(216, 5, '5028', 'MARTILLO DE GOMA', '', 0, 6, 9, 0, '2020-06-30 19:22:25'),
(217, 5, '5029', 'ALICATE DE 8 pulgadas  KAMASA', '', 0, 8, 15, 0, '2020-06-30 19:22:25'),
(218, 5, '5030', 'ALICATE DE 8 pulgadas  ELO', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(219, 5, '5031', 'ALICATE DE CORTE', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(220, 5, '5032', 'TIRALINEA', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(221, 5, '5033', 'TIRALINEA SIMPLE', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(222, 5, '5034', 'WINCHA DE 3M', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(223, 5, '5035', 'WINCHA DE 5M', '', 0, 3, 6, 0, '2020-06-30 19:22:25'),
(224, 5, '5036', 'WINCHA DE 5M STANLEY', '', 0, 15, 18, 0, '2020-06-30 19:22:25'),
(225, 5, '5037', 'WINCHA DE 3M STANLEY', '', 0, 9, 13, 0, '2020-06-30 19:22:25'),
(226, 5, '5038', 'WINCHA DE 7.5M', '', 0, 9, 12, 0, '2020-06-30 19:22:25'),
(227, 5, '5039', 'WINCHA TRUPER DE 5M', '', 0, 11, 16, 0, '2020-06-30 19:22:25'),
(228, 5, '5040', 'ESPATULA DE 2 pulgadas ', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(229, 5, '5041', 'ESPATULA DE 3 pulgadas ', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(230, 5, '5042', 'ESPATULA DE 4 pulgadas ', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(231, 5, '5043', 'ESPATULA DE 5 pulgadas ', '', 0, 3, 5, 0, '2020-06-30 19:22:25'),
(232, 5, '5044', 'LAPIZ CARPINTERO', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(233, 5, '5045', 'HOJA CIERRE ELO', '', 0, 0, 3, 0, '2020-06-30 19:22:25'),
(234, 5, '5046', 'HOJA CIERRE SADFLEX', '', 0, 3, 5, 0, '2020-06-30 19:22:25'),
(235, 5, '5047', 'NIVEL 12 pulgadas ', '', 0, 7, 10, 0, '2020-06-30 19:22:25'),
(236, 5, '5048', 'NIVEL 18 pulgadas ', '', 0, 15, 18, 0, '2020-06-30 19:22:25'),
(237, 5, '5049', 'NIVEL 24 pulgadas ', '', 0, 11, 15, 0, '2020-06-30 19:22:25'),
(238, 5, '5050', 'DESARMADOR 206', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(239, 5, '5051', 'DESARMADOR 205', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(240, 5, '5052', 'DESARMADOR 6 X 6 KM', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(241, 5, '5053', 'DESARMADOR 6 X 4 KM', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(242, 5, '5054', 'PLOMADA PUNTA', '', 0, 4, 9, 0, '2020-06-30 19:22:25'),
(243, 5, '5055', 'PLOMADA CILINDRO', '', 0, 7, 12, 0, '2020-06-30 19:22:25'),
(244, 5, '5056', 'ESCUADRA 6 A16', '', 0, 10, 14, 0, '2020-06-30 19:22:25'),
(245, 5, '5057', 'ESCUADRA 10 pulgadas  KM', '', 0, 8, 12, 0, '2020-06-30 19:22:25'),
(246, 5, '5058', 'ESCUADRA 12 pulgadas  ECO', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(247, 5, '5059', 'LIJA MADERA NRO 100', '', 0, 1, 1, 0, '2020-06-30 19:22:25'),
(248, 5, '5060', 'LIJA MADERA NRO 120', '', 0, 1, 1, 0, '2020-06-30 19:22:25'),
(249, 5, '5061', 'LIJA ACERO NRO 100', '', 0, 1, 2, 0, '2020-06-30 19:22:25'),
(250, 5, '5062', 'DISCO PARA FE DE 7 pulgadas NORTON', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(251, 5, '5063', 'DISCO PARA FE DE 4 1/2 pulgadas NORTON', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(252, 5, '5064', 'DISCO PARA FE DE 4 1/2 pulgadas  DEWALL', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(253, 5, '5065', 'DISCO PARA FE DE 14 pulgadas NORTON', '', 0, 13, 18, 0, '2020-06-30 19:22:25'),
(254, 5, '5066', 'DISCO PARA MADERA DE 4 1/2 pulgadas  ', '', 0, 5, 9, 0, '2020-06-30 19:22:25'),
(255, 5, '5067', 'DISCO PARA MADERA DE 7 pulgadas  ', '', 0, 9, 14, 0, '2020-06-30 19:22:25'),
(256, 5, '5068', 'DISCO PARA CONCRETO DE 7 pulgadas  ', '', 0, 12, 18, 0, '2020-06-30 19:22:25'),
(257, 5, '5069', 'DISCO PARA CONCRETO DE 4 pulgadas  ', '', 0, 4, 9, 0, '2020-06-30 19:22:25'),
(258, 5, '5070', 'SET DE CANDADOS', '', 0, 40, 80, 0, '2020-06-30 19:22:25'),
(259, 5, '5071', 'CANTADO DE 40 FORTE', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(260, 5, '5072', 'CORDEL PESCAR NRO 70', '', 0, 5, 8, 0, '2020-06-30 19:22:25'),
(261, 5, '5073', 'PLANCHA PULIR AZUL', '', 0, 5, 9, 0, '2020-06-30 19:22:25'),
(262, 5, '5074', 'PLANCHA PULIR ROJO', '', 0, 7, 12, 0, '2020-06-30 19:22:25'),
(263, 5, '5075', 'PLANCHA BATIR MADERA', '', 0, 5, 9, 0, '2020-06-30 19:22:25'),
(264, 5, '5076', 'PLANCHA BATIR GOMA', '', 0, 6, 10, 0, '2020-06-30 19:22:25'),
(265, 5, '5077', 'BARILEJO 7 pulgadas ', '', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(266, 5, '5078', 'ARCO KM', '', 0, 9, 13, 0, '2020-06-30 19:22:25'),
(267, 5, '5079', 'LUNA PARA CARRETA', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(268, 5, '5080', 'RODILLO 9  pulgadas  MELON', '', 0, 9, 13, 0, '2020-06-30 19:22:25'),
(269, 5, '5081', 'RODILLO 12 pulgadas  MELON', '', 0, 11, 15, 0, '2020-06-30 19:22:25'),
(270, 5, '5082', 'BROCHA 21/2 pulgadas ', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(271, 5, '5083', 'BROCHA 3 pulgadas ', '', 0, 2, 4, 0, '2020-06-30 19:22:25'),
(272, 5, '5084', 'SILICONA CHICA', '', 0, 2, 5, 0, '2020-06-30 19:22:25'),
(273, 5, '5085', 'SILICONA TUBO', '', 0, 4, 7, 0, '2020-06-30 19:22:25'),
(274, 5, '5086', 'PEGAMENTO INSTANTANEA', '', 0, 7, 15, 0, '2020-06-30 19:22:25'),
(275, 5, '5087', 'PEGAMENTO CHESE', '', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(276, 5, '5088', 'PEGAMENTO SUPER BLU', '', 0, 3, 6, 0, '2020-06-30 19:22:25'),
(277, 5, '5089', 'CINTA EMBALAJE X20', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(278, 5, '5090', 'CINTA EMBALAJE X 90', '', 0, 1, 4, 0, '2020-06-30 19:22:25'),
(279, 5, '5091', 'ESCUTER', '', 0, 0, 1, 0, '2020-06-30 19:22:25'),
(281, 5, '5093', 'LLAVE MIXTA NRO 10', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(282, 5, '5094', 'LLAVE MIXTA NRO 11', '', 0, 1, 3, 0, '2020-06-30 19:22:25'),
(283, 5, '5095', 'LLAVE MIXTA NRO 12', '', 0, 1, 4, 0, '2020-06-30 19:22:25'),
(284, 5, '5096', 'LLAVE MIXTA NRO 13', 'vistas/img/productos/5096/792.jpg', 36, 2, 5, 0, '2020-06-30 19:22:25'),
(285, 5, '5097', 'LLAVE MIXTA NRO 14', 'vistas/img/productos/5097/213.jpg', 34, 2, 6, 0, '2020-06-30 19:22:25'),
(286, 5, '5098', 'LLAVE MIXTA NRO 15', 'vistas/img/productos/5098/408.jpg', 32, 0, 6, 0, '2020-06-30 19:22:25'),
(287, 5, '5099', 'CERRADURA POMO DORMITORIO ANDINA', 'vistas/img/productos/5099/790.jpg', 30, 0, 20, 0, '2020-06-30 19:22:25'),
(288, 5, '5100', 'CERRADURA CA CROMADO', 'vistas/img/productos/5100/228.jpg', 39, 0, 15, 0, '2020-06-30 19:22:25'),
(289, 5, '5101', 'CERRADURA  TRAVEZ 111', 'vistas/img/productos/5101/397.jpg', 29, 0, 35, 0, '2020-06-30 19:22:25'),
(290, 5, '5102', 'CERRADURA  CANTOL 270', 'vistas/img/productos/5102/524.jpg', 28, 0, 50, 0, '2020-06-30 19:22:25'),
(291, 5, '5103', 'CERRADURA  FORTE CLASICA 226', 'vistas/img/productos/5103/640.jpg', 42, 0, 50, 0, '2020-06-30 19:22:25'),
(292, 5, '5104', 'CERRADURA  FORTE BLINDADA 338', 'vistas/img/productos/5104/233.jpg', 50, 0, 60, 0, '2020-06-30 19:22:25'),
(293, 5, '5105', 'CERRADURA  FORTE BLINDADA 940', 'vistas/img/productos/5105/741.jpg', 44, 0, 70, 0, '2020-06-30 19:22:25'),
(294, 6, '6001', 'ESCOBA LORITO', 'vistas/img/productos/6001/539.jpg', 18, 5, 8, 0, '2020-06-30 19:22:25'),
(295, 6, '6002', 'ESCOBA TUDE', 'vistas/img/productos/6002/859.jpg', 23, 7, 11, 0, '2020-06-30 19:22:25'),
(296, 6, '6003', 'ESCOBA HUDE GRANDE', 'vistas/img/productos/6003/865.jpg', 12, 8, 12, 0, '2020-06-30 19:22:25'),
(297, 6, '6004', 'ESCOBA DE PAJA', 'vistas/img/productos/6004/160.jpg', 26, 7, 10, 0, '2020-06-30 19:22:25'),
(298, 6, '6005', 'RECOGEDOR', 'vistas/img/productos/6005/766.jpg', 6, 1, 5, 0, '2020-06-30 19:22:25'),
(299, 6, '6006', 'KRESO 1 LTRO', 'vistas/img/productos/6006/303.jpg', 22, 2, 5, 0, '2020-06-30 19:22:25'),
(300, 6, '6007', 'ACIDO 1 LTRO', 'vistas/img/productos/6007/873.jpg', 33, 3, 7, 0, '2020-06-30 19:22:25'),
(301, 6, '6008', 'TINNER GALON', 'vistas/img/productos/6008/806.jpg', 25, 11, 14, 0, '2020-06-30 19:22:25'),
(302, 6, '6009', 'TINNER 1 LTRO', 'vistas/img/productos/6009/822.jpg', 27, 4, 7, 0, '2020-06-30 19:22:25'),
(303, 6, '6010', 'TINNER MEDIO LTRO', 'vistas/img/productos/6010/320.jpg', 35, 2, 4, 0, '2020-06-30 19:22:25'),
(304, 6, '6011', 'LIMPIA MUEBLES', 'vistas/img/productos/6011/153.jpg', 25, 12, 15, 0, '2020-06-30 19:22:25'),
(305, 6, '6012', 'ESPREY COLOR MADERA', 'vistas/img/productos/6012/431.jpg', 27, 4, 8, 0, '2020-06-30 19:22:25'),
(306, 6, '6013', 'HISOPO', 'vistas/img/productos/6013/764.jpg', 20, 1, 3, 0, '2020-06-30 19:22:25'),
(307, 6, '6014', 'DESATORADOR', 'vistas/img/productos/6014/608.jpg', 29, 1, 3, 0, '2020-06-30 19:22:25'),
(308, 6, '6015', 'SAPOLIO MOSCA PULGA', 'vistas/img/productos/6015/581.jpg', 6, 6, 9, 0, '2020-06-30 19:22:25'),
(309, 6, '6016', 'PLUMERO', 'vistas/img/productos/6016/391.jpg', 8, 1, 3, 0, '2020-06-30 19:22:25'),
(310, 6, '6017', 'TRAPEADOR TOTE', 'vistas/img/productos/6017/919.jpg', 13, 1, 3, 0, '2020-06-30 19:22:25'),
(311, 6, '6018', 'TRAPEADOR FELPA', 'vistas/img/productos/6018/395.jpg', 25, 3, 5, 0, '2020-06-30 19:22:25'),
(312, 6, '6019', 'SODA CAUSTICA DE 500GR', 'vistas/img/productos/6019/969.jpg', 45, 2, 4, 0, '2020-06-30 19:22:25'),
(313, 6, '6020', 'ESPONJA', 'vistas/img/productos/6020/928.jpg', 35, 1.5, 2.1, 0, '2020-06-30 19:22:25'),
(314, 6, '6021', 'TIZA', 'vistas/img/productos/6021/448.jpg', 0, 4, 8, 0, '2020-06-30 19:22:25'),
(315, 6, '6022', 'SAPOLIO LAVA PLATOS', 'vistas/img/productos/6022/728.jpg', 0, 5, 7, 0, '2020-06-30 19:22:25'),
(316, 6, '6023', 'RAFIA ROLLO', 'vistas/img/productos/6023/125.jpg', 0, 0.5, 0.7, 0, '2020-06-30 19:22:25'),
(317, 6, '6024', 'TRAPO LIMPIEZA', 'vistas/img/productos/6024/452.jpg', 0, 0.5, 0.7, 0, '2020-06-30 19:22:25'),
(318, 7, '7001', 'PARANTE ECUALIPTO 2.50m', '', 10, 5, 8, 0, '2020-06-30 19:22:25'),
(319, 7, '7002', 'PARANTE ECUALIPTO 3.00m', '', 10, 6, 9, 0, '2020-06-30 19:22:25'),
(320, 7, '7003', 'PARANTE MEDIANO ECUALIPTO 2.50m', '', 10, 4, 7, 0, '2020-06-30 19:22:25'),
(321, 7, '7004', 'PARANTE MEDIANO ECUALIPTO 3.00m', '', 10, 5, 8, 0, '2020-06-30 19:22:25'),
(322, 7, '7005', 'CAÑA O BAMBU 8.0M', '', 6, 23, 30, 0, '2020-06-30 19:22:25'),
(323, 7, '7006', 'MANDARO ECUALIPTO 5.00m', '', 6, 12, 16, 0, '2020-06-30 19:22:25'),
(324, 7, '7007', 'MANDARILLA ECUALIPTO 500m', '', 14, 10, 13, 0, '2020-06-30 19:22:25'),
(325, 7, '7008', 'MANDARILLA ECUALIPTO 6 00m', '', 42, 12, 16, 0, '2020-06-30 19:22:25'),
(326, 7, '7009', 'TABLA 30CM X 1 pulgadas ', 'vistas/img/productos/7009/819.jpg', 32, 16, 20, 0, '2020-06-30 19:22:25'),
(327, 7, '7010', 'TRIPLAY 4MM', 'vistas/img/productos/7010/952.png', 15, 23, 27, 0, '2020-06-30 19:22:25'),
(328, 7, '7011', 'CALAMINA 3 60M', 'vistas/img/productos/7011/137.jpg', 25, 16, 18, 0, '2020-06-30 19:22:25'),
(329, 7, '7012', 'TERMITECHO', 'vistas/img/productos/7012/721.jpg', 35, 10, 15, 1, '2020-06-30 19:22:25'),
(330, 7, '7013', 'MADERA   ', 'vistas/img/productos/7013/838.jpg', 43, 55, 75, 3, '2020-06-30 19:22:25'),
(331, 8, '8001', 'CLAVO DE ACERO DE 3 PULGADAS', 'vistas/img/productos/8001/760.jpg', 41, 6, 12, 4, '2020-06-30 19:22:25'),
(332, 8, '8002', 'BROCA PARA CONCRETO DE 12 pulgadas ', 'vistas/img/productos/8002/481.jpg', 81, 13, 18, 3, '2020-06-30 19:22:25'),
(333, 8, '8003', 'CLAVO DE MADERA 1 PULGADA', 'vistas/img/productos/8003/471.jpg', 37, 6, 12, 3, '2020-06-30 19:22:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proforma`
--

CREATE TABLE `proforma` (
  `id_proforma` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `codigo` float NOT NULL,
  `compra` text NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proforma`
--

INSERT INTO `proforma` (`id_proforma`, `id_cliente`, `id_usuario`, `codigo`, `compra`, `impuesto`, `neto`, `total`, `fecha`) VALUES
(42, 2, 2, 700001, '[{\"id_producto\":\"329\",\"descripcion\":\"TERMITECHO\",\"cantidad\":\"1\",\"stock\":\"35\",\"precio\":\"15\",\"total\":\"15\"}]', 2.1, 15, 17.1, '2020-07-01 01:48:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `foto` text NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(2, 'Soporte', 'admin', '$2a$07$asxx54ahjppf45sd87a5auydEGPaS9GfvG4fyj3ej.1DXP1QEwf.G', 'Administrador', '', 1, '2020-06-30 19:06:25', '2020-06-16 03:54:50'),
(5, 'Yesenia', 'yesenia', '$2a$07$asxx54ahjppf45sd87a5auWTa8xwAQ8OdnTjMcD9CK3WzVJfigK6e', 'Administrador', 'vistas/img/usuarios/yesenia/585.jpg', 1, '2020-06-21 20:36:31', '2020-06-30 21:35:23'),
(7, 'Walter', 'walter', '$2a$07$asxx54ahjppf45sd87a5au63wZwJ9h1Hw7YW5cxCpujtCLISiKtb2', 'Vendedor', 'vistas/img/usuarios/walter/914.jpg', 1, '0000-00-00 00:00:00', '2020-06-30 21:38:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `productos` text NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text NOT NULL,
  `tipo_comprobante` varchar(50) NOT NULL,
  `registro_unico` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `codigo`, `id_cliente`, `id_usuario`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `tipo_comprobante`, `registro_unico`, `fecha`) VALUES
(17, 70001, 3, 2, '[{\"id_producto\":\"332\",\"descripcion\":\"BROCA PARA CONCRETO DE 12 pulgadas \",\"cantidad\":\"1\",\"stock\":\"81\",\"precio\":\"18\",\"total\":\"18\"},{\"id_producto\":\"331\",\"descripcion\":\"CLAVO DE ACERO DE 3 PULGADAS\",\"cantidad\":\"1\",\"stock\":\"43\",\"precio\":\"12\",\"total\":\"12\"}]', 4.2, 30, 34.2, 'TC-414141414', 'Factura', '1414141', '2020-07-01 01:46:13'),
(18, 10001, 4, 2, '[{\"id_producto\":\"331\",\"descripcion\":\"CLAVO DE ACERO DE 3 PULGADAS\",\"cantidad\":\"1\",\"stock\":\"42\",\"precio\":\"12\",\"total\":\"12\"},{\"id_producto\":\"330\",\"descripcion\":\"MADERA   \",\"cantidad\":\"1\",\"stock\":\"44\",\"precio\":\"75\",\"total\":\"75\"},{\"id_producto\":\"329\",\"descripcion\":\"TERMITECHO\",\"cantidad\":\"1\",\"stock\":\"35\",\"precio\":\"15\",\"total\":\"15\"}]', 15.3, 102, 117.3, 'Efectivo', 'Boleta', '', '2020-07-01 01:46:50'),
(19, 70002, 2, 2, '[{\"id_producto\":\"331\",\"descripcion\":\"CLAVO DE ACERO DE 3 PULGADAS\",\"cantidad\":\"1\",\"stock\":\"41\",\"precio\":\"12\",\"total\":\"12\"},{\"id_producto\":\"330\",\"descripcion\":\"MADERA   \",\"cantidad\":\"1\",\"stock\":\"43\",\"precio\":\"75\",\"total\":\"75\"}]', 12.18, 87, 99.18, 'TC-141414', 'Factura', '141414', '2020-07-01 01:47:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proforma`
--
ALTER TABLE `proforma`
  ADD PRIMARY KEY (`id_proforma`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT de la tabla `proforma`
--
ALTER TABLE `proforma`
  MODIFY `id_proforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `proforma`
--
ALTER TABLE `proforma`
  ADD CONSTRAINT `proforma_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `proforma_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
