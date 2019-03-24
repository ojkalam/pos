-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 07:09 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Xiomi', 'xiomi', '2018-11-15 00:26:09', '2018-11-15 00:26:09'),
(3, 'Akij', 'akij', '2018-11-15 00:27:15', '2018-11-15 00:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_register_datas`
--

CREATE TABLE `cash_register_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_register_id` int(11) NOT NULL,
  `time_opened` datetime NOT NULL,
  `time_closed` datetime DEFAULT NULL,
  `total_sales_amount` int(11) DEFAULT NULL,
  `item_sold` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `short_description`, `created_at`, `updated_at`) VALUES
(2, 'uncategorized', 'uncategorized', 'All uncategorized products', '2018-11-14 23:35:23', '2018-11-14 23:35:23'),
(4, 'Home Care', 'home-care', 'lorem ipsum dolar emet', NULL, NULL),
(5, 'Cosmetics', 'cosmetics', 'sdfd', '2018-11-24 12:27:02', '2018-11-24 12:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('supplier','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `type`, `name`, `contact_id`, `email`, `phone`, `country`, `city`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'supplier', 'Tipu Sultan', 'SUP-0001', 'tipu@mail.com', '178798789', 'BD', 'Dhaka', 'sdfsd', NULL, NULL),
(2, 'customer', 'Abul Kalam', 'CUS-0002', 'kalam@mail.com', '178798789', 'BD', 'Dhaka', 'sdfsd', NULL, NULL),
(3, 'customer', 'Jamal Khan', 'CUS-0003', 'wedran@gmail.com', '8801970983522', 'BD', 'COMILLA', 'sdfsd', '2018-11-26 03:35:01', '2018-11-26 03:35:01'),
(4, 'customer', 'Abdur Rahim', 'CUS-0004', 'tipu5040@gmail.com', '8801521450823', 'BD', 'Dhaka', 'sdsdfs sdfsd', '2018-11-26 03:35:30', '2018-11-26 03:35:30'),
(5, 'supplier', 'Sultan Mahmud', 'SUP-0005', 'wedran@gmail.com', '01521450823', 'BD', 'Dhaka', 'sd', '2018-11-26 03:35:58', '2018-11-26 03:35:58'),
(6, 'supplier', 'Sattar Khan', 'SUP-0006', 'wedran@gmail.com', '324324 23423', 'BDa', 'COMILLA', 'sd', '2018-11-26 03:36:25', '2018-11-26 03:36:25'),
(7, 'customer', 'Sohel', 'CUS-0007', 'tipu5040@gmail.com', '01521450823', 'Bangldesh', 'Dhaka', 'sd', '2018-12-20 05:12:13', '2018-12-21 20:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `discount_offers`
--

CREATE TABLE `discount_offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `offer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_in_percent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_offers`
--

INSERT INTO `discount_offers` (`id`, `offer_name`, `value_in_percent`, `created_at`, `updated_at`) VALUES
(1, '1 Thousand UP', 3, '2018-12-20 06:00:25', '2018-12-20 06:00:25'),
(3, 'Eid-Offer', 5, '2018-12-20 16:08:20', '2018-12-20 16:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_15_035153_create_category_table', 1),
(4, '2018_11_15_035433_create_product_table', 1),
(5, '2018_11_15_041928_create_brands_table', 1),
(6, '2018_11_15_041954_create_taxes_table', 1),
(14, '2018_11_22_021146_create_contacts_table', 2),
(15, '2018_11_25_025535_create_sells_table', 2),
(16, '2018_11_26_035826_create_sell_products_table', 2),
(17, '2018_12_04_050336_create_notifications_table', 3),
(18, '2018_12_08_181621_create_sale_targets_table', 4),
(19, '2018_12_08_185758_create_purchases_table', 4),
(20, '2018_12_08_185841_create_purchase_products_table', 4),
(21, '2018_12_08_190035_create_cash_registers_table', 4),
(22, '2018_12_08_190330_create_cash_register_datas_table', 5),
(23, '2018_12_08_200741_create_discount_offers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('16902459-7d8b-428e-921f-ab137f1a53c9', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"Ponds | SKU: p1243 | Product quantity is below 2 or equal\"}', '2018-12-22 06:12:41', '2018-12-21 16:20:59', '2018-12-22 06:12:41'),
('1f88a636-b97d-4a84-986b-394bccca01bc', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"Noddles family pack | SKU: 1545 | Product quantity is below 1 or equal\"}', '2018-12-22 06:12:49', '2018-12-22 06:05:12', '2018-12-22 06:12:49'),
('4164c5f0-7400-4391-8a9f-041f2bcbca6a', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"ACI Aerosol Insect Spray | SKU: aci-101 | Product quantity is below 3 or equal\"}', '2018-12-18 17:46:45', '2018-12-17 02:08:13', '2018-12-18 17:46:45'),
('485dd76b-a8ea-4171-bd70-b6875bb9e1b7', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"Dettol Handwash 200 M | SKU: dt-111 |  Product out of stock\"}', '2018-12-18 18:02:45', '2018-12-17 02:07:23', '2018-12-18 18:02:45'),
('52d20210-2642-45f8-b5f7-51c2d99e130b', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"7up | SKU: up123 | Product quantity is below 2 or equal\"}', '2018-12-22 06:12:49', '2018-12-05 03:54:17', '2018-12-22 06:12:49'),
('728bab13-4a17-47f7-853f-5a9b4aa4698f', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"7up | SKU: up123 |  Product out of stock\"}', '2018-12-05 12:35:37', '2018-12-05 04:45:52', '2018-12-05 12:35:37'),
('8160173e-2487-42ad-af2f-613e71dc54c5', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"pran | SKU: ui | Product quantity is below 0 or equal\"}', '2018-12-05 03:48:20', '2018-12-05 02:36:04', '2018-12-05 03:48:20'),
('d7447f85-9fad-448b-9502-a5114870ce43', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"pran | SKU: ui | Product quantity is below 2 or equal\"}', '2018-12-05 03:48:20', '2018-12-05 02:34:59', '2018-12-05 03:48:20'),
('d977c876-8490-402e-8a6f-d585eade0603', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"7up | SKU: up123 | Product quantity is below 5 or equal\"}', NULL, '2019-02-11 03:38:20', '2019-02-11 03:38:20'),
('ded2eb97-897b-4db7-ba1e-31142aa11d01', 'App\\Notifications\\ProductOutOfStock', 5, 'App\\User', '{\"product_info\":\"USB hub | SKU: 1545 |  Product out of stock\"}', '2018-12-05 03:48:20', '2018-12-05 02:37:57', '2018-12-05 03:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tipu@gmail.com', '$2y$10$mi7i2TDPPwPrblyMe1UWfukCFgL8pI3SIIs6jJc78ehtkLbwjwinm', '2018-11-15 12:38:15'),
('tipu5040@gmail.com', '$2y$10$FeYfFD2u3A0mIwIEzCgIT.j8Jzt27OF3ho8OMeUn2vJjT5cd7ibP6', '2018-11-16 12:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `p_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) DEFAULT NULL,
  `tax_id` tinyint(4) DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `alert_quantity` int(11) DEFAULT '0',
  `default_purchase_price` int(11) NOT NULL,
  `profit_percent` int(11) DEFAULT NULL,
  `sell_price_inc_tax` int(11) NOT NULL,
  `p_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `p_name`, `category_id`, `brand_id`, `tax_id`, `sku`, `stock_quantity`, `alert_quantity`, `default_purchase_price`, `profit_percent`, `sell_price_inc_tax`, `p_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'USB hub', 2, 1, 5, '1545', 0, 2, 350, 5, 386, 'usb-hub-2018-11-155beceb6cadcb5.jpg', 'sd fsdf sdfsd', '2018-11-15 03:43:40', '2018-12-05 02:37:57'),
(2, 'Pran', 5, 2, 15, 'p-1234', 50, 3, 600, 9, 752, 'fdf-2018-11-155bed00d27b35b.jpg', 'ghjy', '2018-11-15 05:14:58', '2018-12-05 02:36:04'),
(5, 'Noddles family pack', 4, NULL, NULL, '1545', 1, 4, 456, 5, 479, 'sdf-2018-11-205bf3cad5ab3ba.JPG', NULL, '2018-11-20 08:50:29', '2018-12-22 06:05:12'),
(8, '7up', 4, NULL, NULL, 'up123', 5, 5, 60, NULL, 66, 'default.png', NULL, '2018-12-03 04:10:58', '2019-02-11 03:38:20'),
(9, 'Ponds', 5, NULL, 5, 'p1243', 20, 3, 350, 5, 386, 'default.png', NULL, '2018-12-03 04:12:01', '2018-12-21 16:21:00'),
(10, 'ACI Aerosol Insect Spray', 4, NULL, 5, 'aci-101', 12, 3, 170, 2, 182, 'aci-aerosol-insect-spray-2018-12-175c1703ffef607.jpg', NULL, '2018-12-17 02:03:43', '2019-02-11 03:38:20'),
(11, 'Dettol Handwash 200 M', 4, NULL, 5, 'dt-111', 9, 5, 85, 2, 90, 'dettol-handwash-200-m-2018-12-175c17048933fd6.jpg', NULL, '2018-12-17 02:06:01', '2018-12-21 16:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `contact_id`, `purchase_date`, `purchase_quantity`, `total_amount`, `notes`, `created_at`, `updated_at`) VALUES
(3, 11, 5, '2018-12-21', 2, '170.00', NULL, '2018-12-20 19:57:34', '2018-12-20 19:57:34'),
(4, 5, 1, '2018-12-21', 3, '1368.00', NULL, '2018-12-20 20:17:12', '2018-12-20 20:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_targets`
--

CREATE TABLE `sale_targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `target_amount` int(11) NOT NULL,
  `total_gain` int(11) DEFAULT NULL,
  `difference` int(11) DEFAULT NULL,
  `total_item_sold` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_targets`
--

INSERT INTO `sale_targets` (`id`, `start_date`, `end_date`, `status`, `target_amount`, `total_gain`, `difference`, `total_item_sold`, `created_at`, `updated_at`) VALUES
(3, '2018-12-07', '2018-12-14', 0, 45454, NULL, NULL, NULL, '2018-12-18 13:04:45', '2018-12-18 13:51:20'),
(4, '2018-12-14', '2018-12-30', 1, 30000, NULL, NULL, NULL, '2018-12-18 13:05:05', '2018-12-21 17:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `pay_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `due` decimal(8,2) NOT NULL DEFAULT '0.00',
  `pay_status` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `invoice_id`, `contact_id`, `sale_date`, `pay_method`, `total_amount`, `paid`, `due`, `pay_status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'INV0001', 2, '2018-10-17', 'cash', '500.00', '500.00', '0.00', 1, 'lroema sdf sdsd', '2018-10-16 18:00:00', NULL),
(2, 'INV0002', 4, '2018-10-24', 'card', '400.00', '400.00', '0.00', 0, 'lroema sdf sdsd', '2018-10-23 18:00:00', NULL),
(5, 'INV0004', 4, '2018-11-13', 'cash', '5060.00', '5000.00', '60.00', 0, 'ghj gjhg jhgj', '2018-11-12 22:47:07', '2018-12-03 22:47:07'),
(6, 'INV0005', 3, '2018-09-12', 'cash', '2738.00', '2738.00', '0.00', 0, 'dsfd', '2018-09-12 14:59:43', '2018-12-04 14:59:43'),
(8, 'INV0007', 3, '2018-09-20', 'cash', '1544.00', '1544.00', '0.00', 0, 'dfd', '2018-09-20 01:47:52', '2018-12-05 01:47:52'),
(9, 'INV0008', 3, '2018-10-25', 'cash', '752.00', '752.00', '0.00', 0, NULL, '2018-10-25 01:56:37', '2018-12-05 01:56:37'),
(10, 'INV0009', 4, '2018-11-23', 'cash', '2874.00', '344.00', '2530.00', 0, 'sdf s', '2018-11-23 02:00:28', '2018-12-05 02:00:28'),
(12, 'INV0011', 2, '2018-12-05', 'cash', '386.00', '344.00', '42.00', 0, NULL, '2018-12-05 02:06:36', '2018-12-05 02:06:36'),
(13, 'INV0012', 2, '2018-12-05', 'cash', '3008.00', '50.00', '2958.00', 0, NULL, '2018-12-05 02:07:24', '2018-12-05 02:07:24'),
(14, 'INV0013', 4, '2018-12-14', 'cash', '752.00', '752.00', '0.00', 1, NULL, '2018-12-05 02:08:57', '2018-12-05 02:08:57'),
(15, 'INV0014', 2, '2018-10-18', 'cash', '2874.00', '2874.00', '0.00', 0, NULL, '2018-10-18 02:11:22', '2018-12-05 02:11:22'),
(16, 'INV0015', 4, '2018-12-05', 'cash', '958.00', '343.00', '615.00', 0, NULL, '2018-12-05 02:20:30', '2018-12-05 02:20:30'),
(17, 'INV0016', 2, '2018-12-05', 'cash', '479.00', '324.00', '155.00', 0, NULL, '2018-12-05 02:23:21', '2018-12-05 02:23:21'),
(19, 'INV0018', 2, '2018-12-05', 'cash', '51.00', '50.00', '1.00', 0, NULL, '2018-12-05 02:30:30', '2018-12-05 02:30:30'),
(20, 'INV0019', 3, '2018-12-05', 'cash', '51.00', '50.00', '1.00', 0, 'sdfsdf sdf', '2018-12-05 02:31:52', '2018-12-05 02:31:52'),
(23, 'INV0022', 3, '2018-12-05', 'cash', '386.00', '343.00', '43.00', 0, 'as', '2018-12-05 02:37:57', '2018-12-05 02:37:57'),
(25, 'INV0024', 4, '2018-12-07', 'cash', '394.00', '343.00', '51.00', 0, NULL, '2018-12-07 03:29:26', '2018-12-05 03:29:26'),
(30, 'INV0029', 4, '2018-12-17', 'cash', '1274.00', '1274.00', '0.00', 0, 'eew we', '2018-12-17 02:08:13', '2018-12-17 02:08:13'),
(31, 'INV0030', 2, '2018-12-19', 'cash', '1136.00', '1136.00', '0.00', 0, 'asd sdf sdsd sd', '2018-12-19 17:15:47', '2018-12-19 17:15:47'),
(32, 'INV0031', 3, '2018-12-19', 'card', '1340.00', '1340.00', '0.00', 1, 'dfs', '2018-12-19 17:18:15', '2018-12-19 17:18:15'),
(34, 'INV0033', 3, '2018-12-20', 'card', '1158.00', '1158.00', '0.00', 1, NULL, '2018-12-20 13:12:09', '2018-12-20 13:12:09'),
(35, 'INV0034', 7, '2018-12-20', 'cash', '1158.00', '1100.10', '57.90', 0, 'final payment', '2018-12-20 16:14:55', '2018-12-20 16:14:55'),
(36, 'INV0035', 2, '2018-12-21', 'cash', '476.00', '461.72', '14.28', 0, NULL, '2018-12-21 16:21:00', '2018-12-21 16:21:00'),
(37, 'INV0036', 7, '2018-12-22', 'cash', '182.00', '182.00', '0.00', 1, NULL, '2018-12-22 04:07:00', '2018-12-22 04:07:00'),
(38, 'INV0037', 7, '2018-12-22', 'cash', '182.00', '182.00', '0.00', 1, NULL, '2018-12-22 04:07:00', '2018-12-22 04:07:00'),
(39, 'INV0038', 7, '2018-12-22', 'cash', '958.00', '929.26', '28.74', 0, NULL, '2018-12-22 06:05:12', '2018-12-22 06:05:12'),
(40, 'INV0039', 7, '2018-12-22', 'cash', '3960.00', '3960.00', '0.00', 1, NULL, '2018-12-22 06:16:54', '2018-12-22 06:16:54'),
(41, 'INV0040', 3, '2019-02-11', 'cash', '1422.00', '1350.90', '71.10', 0, NULL, '2019-02-11 03:38:20', '2019-02-11 03:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `sell_products`
--

CREATE TABLE `sell_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell_products`
--

INSERT INTO `sell_products` (`id`, `sell_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, NULL),
(2, 1, 2, 4, NULL, NULL),
(3, 2, 2, 7, NULL, NULL),
(4, 2, 5, 10, NULL, NULL),
(7, 5, 1, 50, '2018-12-03 22:47:07', '2018-12-03 22:47:07'),
(8, 5, 2, 5, '2018-12-03 22:47:07', '2018-12-03 22:47:07'),
(9, 6, 9, 33, '2018-12-04 14:59:43', '2018-12-04 14:59:43'),
(10, 7, 2, 4, '2018-12-04 18:22:39', '2018-12-04 18:22:39'),
(11, 8, 1, 4, '2018-12-05 01:47:52', '2018-12-05 01:47:52'),
(12, 9, 2, 1, '2018-12-05 01:56:37', '2018-12-05 01:56:37'),
(13, 10, 5, 6, '2018-12-05 02:00:28', '2018-12-05 02:00:28'),
(15, 12, 1, 1, '2018-12-05 02:06:36', '2018-12-05 02:06:36'),
(16, 13, 2, 4, '2018-12-05 02:07:24', '2018-12-05 02:07:24'),
(17, 14, 2, 1, '2018-12-05 02:08:57', '2018-12-05 02:08:57'),
(18, 15, 5, 6, '2018-12-05 02:11:22', '2018-12-05 02:11:22'),
(19, 16, 5, 2, '2018-12-05 02:20:30', '2018-12-05 02:20:30'),
(20, 17, 5, 1, '2018-12-05 02:23:21', '2018-12-05 02:23:21'),
(21, 18, 6, 340, '2018-12-05 02:25:35', '2018-12-05 02:25:35'),
(22, 19, 6, 1, '2018-12-05 02:30:30', '2018-12-05 02:30:30'),
(23, 20, 6, 1, '2018-12-05 02:31:52', '2018-12-05 02:31:52'),
(24, 21, 2, 3, '2018-12-05 02:34:59', '2018-12-05 02:34:59'),
(25, 22, 2, 2, '2018-12-05 02:36:04', '2018-12-05 02:36:04'),
(26, 23, 1, 1, '2018-12-05 02:37:57', '2018-12-05 02:37:57'),
(27, 24, 7, 340, '2018-12-05 03:27:25', '2018-12-05 03:27:25'),
(28, 25, 7, 1, '2018-12-05 03:29:26', '2018-12-05 03:29:26'),
(29, 25, 6, 1, '2018-12-05 03:29:26', '2018-12-05 03:29:26'),
(33, 29, 11, 30, '2018-12-17 02:07:23', '2018-12-17 02:07:23'),
(34, 30, 10, 7, '2018-12-17 02:08:13', '2018-12-17 02:08:13'),
(35, 31, 10, 2, '2018-12-19 17:15:47', '2018-12-19 17:15:47'),
(36, 31, 9, 2, '2018-12-19 17:15:47', '2018-12-19 17:15:47'),
(37, 32, 10, 1, '2018-12-19 17:18:15', '2018-12-19 17:18:15'),
(38, 32, 9, 3, '2018-12-19 17:18:15', '2018-12-19 17:18:15'),
(39, 33, 9, 20, '2018-12-20 04:51:07', '2018-12-20 04:51:07'),
(40, 34, 9, 3, '2018-12-20 13:12:09', '2018-12-20 13:12:09'),
(41, 35, 9, 2, '2018-12-20 16:14:55', '2018-12-20 16:14:55'),
(42, 35, 9, 1, '2018-12-20 16:14:55', '2018-12-20 16:14:55'),
(43, 36, 9, 1, '2018-12-21 16:21:00', '2018-12-21 16:21:00'),
(44, 36, 11, 1, '2018-12-21 16:21:00', '2018-12-21 16:21:00'),
(45, 37, 10, 1, '2018-12-22 04:07:00', '2018-12-22 04:07:00'),
(46, 38, 10, 1, '2018-12-22 04:07:00', '2018-12-22 04:07:00'),
(47, 39, 5, 2, '2018-12-22 06:05:12', '2018-12-22 06:05:12'),
(48, 40, 8, 60, '2018-12-22 06:16:54', '2018-12-22 06:16:54'),
(49, 41, 8, 5, '2019-02-11 03:38:20', '2019-02-11 03:38:20'),
(50, 41, 10, 6, '2019-02-11 03:38:20', '2019-02-11 03:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_name`, `tax_rate`, `created_at`, `updated_at`) VALUES
(1, 'Value Added Tax', 15, '2018-11-15 02:26:38', '2018-11-15 02:26:38'),
(2, 'income tax', 5, '2018-11-15 02:27:10', '2018-11-15 02:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Md Abul Kalam', 'admin@mail.com', '$2y$10$RihqN0DW2FdfssRlEgACkO1Uly7o4W84qCfblRa6vD1ub3X5m2hZy', 'admin', 'YubWJn6P8wL69J2lToDleqibhnRhwXE33Lt3TMyH4duokDTGsVqvt0br8ceX', NULL, NULL),
(6, 'Tipu Sultan', 'kalam123@gmail.com', '$2y$10$ZjwlNiF2..3uwkwua5Rm2e4ErHfuvlkHRREjSAfY3XVGSR.MUyfH6', 'cashier', 'kqW1MLOva8EuGA93VbYHw3GqzvsGbVe3kWKKdal251mfn7T4qVVn2IANYRoU', '2018-12-20 04:36:50', '2018-12-20 04:36:50'),
(7, 'Demo Name', 'demo@gmail.com', '$2y$10$57l5c7.zU/dKqNb25f91Au9v.xPBEYFJyjzpRhvn.tDzyqHYaPNvi', 'admin', 'uQh2Ued6eE2kZorgyUyVjYn8Lc28sHyRBui2ayeyjDlBnIP0Yx7AL9rM1Ofq', '2018-12-21 17:43:36', '2018-12-21 17:43:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_register_datas`
--
ALTER TABLE `cash_register_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_offers`
--
ALTER TABLE `discount_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_targets`
--
ALTER TABLE `sale_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_products`
--
ALTER TABLE `sell_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_register_datas`
--
ALTER TABLE `cash_register_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discount_offers`
--
ALTER TABLE `discount_offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_targets`
--
ALTER TABLE `sale_targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sell_products`
--
ALTER TABLE `sell_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
