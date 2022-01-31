-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2022 a las 22:09:30
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comalex`
--
CREATE DATABASE IF NOT EXISTS `comalex` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `comalex`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `monthly_sales` (IN `iduser` INT)  SELECT MONTHNAME(date) AS month, COUNT(*) AS quantity FROM sales WHERE sales.user_id = iduser and MONTH (date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP) GROUP BY(MONTH(date))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_monthly_sales` ()  SELECT MONTHNAME(date) AS month, COUNT(*) AS quantity FROM sales WHERE MONTH (date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP) GROUP BY(MONTH(date))$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'MABE', '2022-01-29 09:15:12', '2022-01-30 09:59:36'),
(2, 'SAMSUNG', '2022-01-30 10:00:43', '2022-01-30 10:00:43'),
(3, 'INDEFINIDO', '2022-01-31 01:55:35', '2022-01-31 01:55:35'),
(4, 'SONY', '2022-02-01 01:45:10', '2022-02-01 01:45:10'),
(5, 'PANASONIC', '2022-02-01 01:45:23', '2022-02-01 01:45:23'),
(6, 'HP', '2022-02-01 01:45:44', '2022-02-01 01:45:44'),
(7, 'LENOVO', '2022-02-01 01:45:51', '2022-02-01 01:45:51'),
(8, 'PARAISO', '2022-02-01 01:52:46', '2022-02-01 01:52:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buys`
--

CREATE TABLE `buys` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `buys`
--

INSERT INTO `buys` (`id`, `order_id`, `date`, `state`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-01-29', 'ATENDIDO', '2022-01-29 10:09:08', '2022-01-29 10:09:13'),
(2, 2, '2022-01-30', 'PENDIENTE', '2022-01-30 10:09:41', '2022-01-30 10:09:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int(10) UNSIGNED NOT NULL,
  `number_document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `document_type_id`, `number_document`, `telephone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'JHEIZER ENRIQUE ZELADA RIOS', 1, '70221404', '988184173', 'Chepen', '2022-01-29 09:17:23', '2022-01-29 09:17:23'),
(2, 'LUCIA KIHARA ALVAREZ CHANCAN', 1, '74859623', '968545458', 'Ciudad de Dios', '2022-01-31 21:55:01', '2022-01-31 21:55:01'),
(3, 'DAVID SANTIAGO TORRES ARQUINIO', 1, '75485695', '958645879', 'CHEPEN', '2022-02-01 01:56:49', '2022-02-01 01:56:49'),
(4, 'GISELA RONDOY RIVAS', 1, '74859658', '965487589', 'CHEPEN', '2022-02-01 01:57:31', '2022-02-01 01:57:31'),
(5, 'ROSA RIOS HENRIQUEZ', 1, '18213550', '978456895', 'GUADALUPE', '2022-02-01 02:00:07', '2022-02-01 02:00:07'),
(6, 'JUAN CARLOS CERDAN RUIZ', 1, '19323589', '954587458', 'GUADALUPE', '2022-02-01 02:01:03', '2022-02-01 02:01:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`id`, `document`, `created_at`, `updated_at`) VALUES
(1, 'DNI', '2022-01-29 09:15:12', '2022-01-29 09:15:12'),
(2, 'RUC', '2022-01-29 09:15:12', '2022-01-29 09:15:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int(10) UNSIGNED NOT NULL,
  `number_document` int(15) UNSIGNED NOT NULL,
  `date_birth` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workstation_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `lastname`, `document_type_id`, `number_document`, `date_birth`, `email`, `telephone`, `address`, `workstation_id`, `created_at`, `updated_at`) VALUES
(1, 'Omar', 'Salazar Lozano', 1, 19802345, '1980-03-13', 'omars@gmail.com', '988841787', 'Av. 28 Julio 235', 1, '2022-01-29 09:15:12', '2022-01-29 09:15:12'),
(2, 'Daniel', 'Romero Chalán', 1, 45781236, '1998-06-24', 'danielr@gmail.com', '954876325', 'Calle San Pedro #254', 2, '2022-01-30 09:56:07', '2022-01-30 09:56:22'),
(3, 'Angel', 'Martinez Marchena', 1, 84521525, '2000-06-20', 'angelm@hotmail.com', '988584858', 'CHEPEN', 2, '2022-01-31 21:49:22', '2022-01-31 21:51:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_01_11_000000_create_workstations_table', 1),
(2, '2014_10_11_000001_create_document_types_table', 1),
(3, '2014_10_11_000002_create_employees_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2022_01_21_212540_create_suppliers_table', 1),
(9, '2022_01_22_152718_create_brands_table', 1),
(10, '2022_01_22_210828_create_orders_table', 1),
(11, '2022_01_22_211655_create_product_categories_table', 1),
(12, '2022_01_22_213011_create_voucher_types_table', 1),
(13, '2022_01_23_151430_create_products_table', 1),
(14, '2022_01_23_152835_create_buys_table', 1),
(15, '2022_01_23_202834_create_clients_table', 1),
(16, '2022_01_23_211109_create_order_details_table', 1),
(17, '2022_01_23_211748_create_sales_table', 1),
(18, '2022_01_23_212101_create_sale_details_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `supplier_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-01-29', '2022-01-29 10:02:59', '2022-01-29 10:02:59'),
(2, 1, 2, '2022-01-30', '2022-01-30 10:09:34', '2022-01-30 10:09:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_quantity` int(8) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, '2022-01-30 10:02:59', '2022-01-30 10:02:59'),
(2, 1, 2, 2, '2022-01-30 10:02:59', '2022-01-30 10:02:59'),
(3, 2, 3, 5, '2022-01-30 10:09:34', '2022-01-30 10:09:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_categories_id` int(10) UNSIGNED NOT NULL,
  `stock` int(8) UNSIGNED NOT NULL,
  `unit_price` decimal(15,2) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `product_categories_id`, `stock`, `unit_price`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'HORNO', 'HORNO DE GAS', 1, 13, '200.00', 1, '2022-01-29 09:16:50', '2022-02-01 02:03:03'),
(2, 'COCINA', 'COCINA DE GAS', 1, 14, '500.00', 1, '2022-01-30 08:24:23', '2022-02-01 02:03:02'),
(3, 'TELEVISOR', '50\"', 1, 5, '1500.00', 2, '2022-01-30 09:58:25', '2022-01-31 22:24:49'),
(4, 'JUEGO DE SALA', 'JUEGO DE SALA PARA EL HOGAR', 5, 12, '250.00', 3, '2022-01-31 01:56:12', '2022-02-01 01:50:44'),
(5, 'LAPTOP HP', '8GB RAM, 512 SDD', 3, 7, '2500.00', 6, '2022-02-01 01:48:06', '2022-02-01 02:04:33'),
(6, 'LAPTOP LENOVO', '4GB RAM, 256 SDD', 3, 6, '1800.00', 7, '2022-02-01 01:49:06', '2022-02-01 01:49:06'),
(7, 'BICICLETA', 'CON RUEDAS', 4, 6, '150.00', 3, '2022-02-01 01:49:32', '2022-02-01 02:03:36'),
(8, 'SCOOTER', 'RUEDAS CON LUCES', 4, 5, '120.00', 3, '2022-02-01 01:50:19', '2022-02-01 01:50:19'),
(9, 'MICROONDAS', 'MEDIANO', 2, 6, '500.00', 1, '2022-02-01 01:51:22', '2022-02-01 02:03:03'),
(10, 'COLCHON 2 PLAZAS', '2 PLAZAS', 6, 9, '350.00', 8, '2022-02-01 01:53:13', '2022-02-01 02:03:59'),
(11, 'COLCHON 1 PLAZA', '1 PLAZA', 6, 8, '240.00', 8, '2022-02-01 01:54:00', '2022-02-01 02:04:12'),
(12, 'EQUIPO DE VIDEO', 'CON 2 PARLANTES', 1, 3, '560.00', 4, '2022-02-01 01:54:26', '2022-02-01 02:02:28'),
(13, 'EQUIPO DE SONIDO', '2 PARLANTES Y MICROFONO', 1, 5, '650.00', 5, '2022-02-01 01:55:01', '2022-02-01 02:02:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_categories`
--

INSERT INTO `product_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'ELECTRODOMESTICOS', '2022-01-29 09:15:12', '2022-01-30 09:59:09'),
(2, 'COCINA', '2022-01-30 09:59:26', '2022-02-01 01:47:11'),
(3, 'LAPTOPS', '2022-02-01 01:46:24', '2022-02-01 01:46:24'),
(4, 'NIÑOS', '2022-02-01 01:46:54', '2022-02-01 01:46:54'),
(5, 'SALA', '2022-02-01 01:47:04', '2022-02-01 01:47:04'),
(6, 'DORMITORIO', '2022-02-01 01:47:25', '2022-02-01 01:47:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` decimal(15,2) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `hash` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta_qr` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta_pdf` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunat` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `voucher_type_id` int(10) UNSIGNED NOT NULL,
  `total` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `code`, `client_id`, `user_id`, `hash`, `ruta_qr`, `ruta_pdf`, `sunat`, `date`, `voucher_type_id`, `total`, `created_at`, `updated_at`) VALUES
(7, '1.00', 1, 1, 'HOV1MCCt31JxuHJvx74SPEYGkHM=', 'public/qrs/B001-7.svg', 'public/sunat/B001-7.pdf', '1', '2022-01-31', 1, '700.00', '2022-01-31 22:24:34', '2022-02-01 01:31:39'),
(8, '2.00', 2, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '1750.00', '2022-01-31 22:24:49', '2022-01-31 22:24:49'),
(9, '3.00', 3, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '560.00', '2022-02-01 02:02:28', '2022-02-01 02:02:28'),
(10, '4.00', 4, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '650.00', '2022-02-01 02:02:42', '2022-02-01 02:02:42'),
(11, '5.00', 6, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '1200.00', '2022-02-01 02:03:03', '2022-02-01 02:03:03'),
(12, '6.00', 5, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '500.00', '2022-02-01 02:03:36', '2022-02-01 02:03:36'),
(13, '7.00', 4, 1, NULL, NULL, NULL, '0', '2022-01-31', 1, '2500.00', '2022-02-01 02:04:33', '2022-02-01 02:04:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(8) UNSIGNED NOT NULL,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(9, 7, 1, 1, '200.00', '2022-01-31 22:24:34', '2022-01-31 22:24:34'),
(10, 7, 2, 1, '500.00', '2022-01-31 22:24:34', '2022-01-31 22:24:34'),
(11, 8, 4, 1, '250.00', '2022-01-31 22:24:49', '2022-01-31 22:24:49'),
(12, 8, 3, 1, '1500.00', '2022-01-31 22:24:49', '2022-01-31 22:24:49'),
(13, 9, 12, 1, '560.00', '2022-02-01 02:02:28', '2022-02-01 02:02:28'),
(14, 10, 13, 1, '650.00', '2022-02-01 02:02:42', '2022-02-01 02:02:42'),
(15, 11, 2, 1, '500.00', '2022-02-01 02:03:03', '2022-02-01 02:03:03'),
(16, 11, 1, 1, '200.00', '2022-02-01 02:03:03', '2022-02-01 02:03:03'),
(17, 11, 9, 1, '500.00', '2022-02-01 02:03:03', '2022-02-01 02:03:03'),
(18, 12, 7, 1, '150.00', '2022-02-01 02:03:36', '2022-02-01 02:03:36'),
(19, 12, 10, 1, '350.00', '2022-02-01 02:03:36', '2022-02-01 02:03:36'),
(20, 13, 5, 1, '2500.00', '2022-02-01 02:04:33', '2022-02-01 02:04:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int(10) UNSIGNED NOT NULL,
  `number_document` decimal(15,2) UNSIGNED NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `document_type_id`, `number_document`, `telephone`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Juan $ CIA', 2, '20457812361.00', '985236415', 'Jr. Athaulpa Mz. A Lt. 12 - Trujillo', 'juanc@hotmail.com', '2022-01-30 09:57:14', '2022-01-30 09:57:14'),
(2, 'Importaciones Hersil S.A', 2, '20152365845.00', '968457235', 'Av. Los Frutales 220', 'import@gmail.com', '2022-01-30 09:57:39', '2022-01-30 09:57:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `employee_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', '$2y$10$DKF8lPZe3xjezYKXesHdB.LPVBt7fyZCJvDBcFdmOpPLRyOkMpHry', 1, NULL, '2022-01-29 09:15:13', '2022-01-29 09:15:13'),
(2, 'DANIEL', '$2y$10$5wdAmnqq81q1PxupZvY2p.dtjtmYtlsiIJR2H5le4uFpTC8qNwba2', 2, NULL, '2022-01-30 09:56:07', '2022-01-30 09:56:07'),
(3, 'ANGEL', '$2y$10$.Ioh2WCxEu7fhx37vgnLTe5hFCGE65q6uyE2zgWvxVf9SHhvtguZm', 3, NULL, '2022-01-31 21:49:23', '2022-01-31 21:49:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voucher_types`
--

CREATE TABLE `voucher_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `voucher_types`
--

INSERT INTO `voucher_types` (`id`, `type`, `serie`, `code`, `created_at`, `updated_at`) VALUES
(1, 'BOLETA', 'B001', '03', '2022-01-29 09:15:12', '2022-01-29 09:15:12'),
(2, 'FACTURA', 'F001', '03', '2022-01-29 09:15:12', '2022-01-29 09:15:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workstations`
--

CREATE TABLE `workstations` (
  `id` int(10) UNSIGNED NOT NULL,
  `work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `workstations`
--

INSERT INTO `workstations` (`id`, `work`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR', '2022-01-29 09:15:12', '2022-01-29 09:15:12'),
(2, 'VENDEDOR', '2022-01-29 09:15:12', '2022-01-29 09:15:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buys_order_id_foreign` (`order_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_document_type_id_foreign` (`document_type_id`);

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_types_document_unique` (`document`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_document_type_id_foreign` (`document_type_id`),
  ADD KEY `employees_workstation_id_foreign` (`workstation_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_supplier_id_foreign` (`supplier_id`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_categories_id_foreign` (`product_categories_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indices de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_client_id_foreign` (`client_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`),
  ADD KEY `sales_voucher_type_id_foreign` (`voucher_type_id`);

--
-- Indices de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_document_type_id_foreign` (`document_type_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD KEY `users_employee_id_foreign` (`employee_id`);

--
-- Indices de la tabla `voucher_types`
--
ALTER TABLE `voucher_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `workstations`
--
ALTER TABLE `workstations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `buys`
--
ALTER TABLE `buys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `voucher_types`
--
ALTER TABLE `voucher_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `workstations`
--
ALTER TABLE `workstations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_workstation_id_foreign` FOREIGN KEY (`workstation_id`) REFERENCES `workstations` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_product_categories_id_foreign` FOREIGN KEY (`product_categories_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_voucher_type_id_foreign` FOREIGN KEY (`voucher_type_id`) REFERENCES `voucher_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
