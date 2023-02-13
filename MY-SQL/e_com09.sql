-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 01:12 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_com09`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_confirmation` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `email_confirmation`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Protyay Roy', 'Super-Admin', 0, '01869535334', 'r.protyay@yahoo.com', '$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'Yes', '21788.jpg', 1, NULL, NULL),
(2, 'Demo Roy', 'Vendor', 1, '01700121212', 'demo@gmail.com', '$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'Yes', '35053.jpeg', 1, NULL, '2022-12-15 08:44:30'),
(4, 'Vendor Test', 'Vendor', 6, '01869535338', 'test@gmail.com', '$2y$10$yMxX9cUO8s0QOvLdUEgZpelBsNl.b5o9NvJzOTjr6QkeLhvBjaDLu', 'Yes', '20821.png', 0, '2023-02-01 05:03:24', '2023-02-01 07:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_title`, `admin_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Banner 1st', 1, 'banner-2Av5wFTUs3J.png', '2023-02-02 08:55:32', '2023-02-02 08:55:32'),
(4, 'Banner 2nd', 1, 'banner-1e8TSSvH1zc.png', '2023-02-02 08:56:46', '2023-02-02 08:56:46'),
(5, 'Test Sub Banner', 1, 'banner-2wKvmSDRTsl.png', '2023-02-02 12:44:12', '2023-02-02 12:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `admin_id`, `name`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'MI', NULL, 1, NULL, NULL),
(2, 2, 'OPPO', NULL, 1, NULL, NULL),
(3, 0, 'Sumgsang', NULL, 1, NULL, NULL),
(4, 0, 'Easy', NULL, 1, NULL, NULL),
(5, 0, 'Bloom', NULL, 1, NULL, NULL),
(6, 0, 'Wash', NULL, 1, NULL, '2022-12-15 11:36:09'),
(7, 0, 'Satya Paul', NULL, 1, '2022-12-20 09:30:22', '2022-12-20 09:30:22'),
(8, 0, 'Kalanjali', NULL, 1, '2022-12-20 09:30:51', '2022-12-20 09:30:51'),
(9, 0, 'Meena Bazaar', NULL, 1, '2022-12-20 09:31:18', '2022-12-20 09:31:18'),
(10, 0, 'Bata', NULL, 1, '2022-12-23 19:17:40', '2022-12-23 19:17:40'),
(11, 0, 'Nike', NULL, 1, '2023-01-09 11:12:02', '2023-01-09 11:12:02'),
(12, 2, 'test', NULL, 0, '2023-01-20 17:17:43', '2023-01-20 17:17:43'),
(13, 2, 'admin', NULL, 0, '2023-01-20 17:31:49', '2023-01-20 17:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cookie_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` float UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cookie_id`, `user_id`, `product_id`, `size`, `quantity`, `sell_price`, `created_at`, `updated_at`) VALUES
(22, 'yfJipQX7w3ULpsxsKdBf520', NULL, 7, 'Large', '1', 10000, '2023-01-30 12:51:41', '2023-02-06 07:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `admin_id`, `name`, `discount`, `image`, `description`, `status`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `logo`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0, 'Man', 5.00, '', 'Man description', 1, 'Man-4YKbrVLOQr', 'Man', 'Man meta_description', '98726', '', NULL, NULL),
(2, 0, 1, 0, 'Woman', 2.00, '', 'Woman description', 1, 'Woman-YgBRdbgzM3', 'Woman', 'Woman meta_description', '23651', '', NULL, NULL),
(3, 0, 1, 0, 'Kids', 0.00, '', 'Kids description', 1, 'Kids-6Ygtkvwfdh', 'Kids', 'Kids meta_description', '15468', '', NULL, NULL),
(4, 0, 2, 1, 'Mobile', 10.00, '', 'Mobile description', 1, 'Mobile-QWMXhoQuwf', 'Mobile', 'Mobile meta_description', '28611', '', NULL, NULL),
(5, 0, 2, 0, 'Computer', 8.00, '', 'Computer description', 1, 'Computer-98L0xCDTau', 'Computer', 'Computer meta_description', '28341', '', NULL, NULL),
(6, 1, 1, 0, 'T-shirt', 8.00, '', 'T-shirt description', 1, 'T-shirt-Q2Nxvqvi4d', 'T-shirt', 'T-shirt meta_description', '28340', '', NULL, NULL),
(7, 1, 1, 0, 'Shirt', 8.00, '', 'Shirt description', 1, 'Shirt-BxbbU7dxXK', 'Shirt', 'Shirt meta_description', '28537', '', NULL, NULL),
(8, 1, 1, 0, 'Pant', 4.00, '', 'Pant description', 1, 'Pant-8vfPvRMudy', 'Pant', 'Pant meta_description', '28332', '', NULL, '2022-12-20 09:17:00'),
(9, 2, 1, 0, 'T-shirt', 7.00, '', 'T-shirt description', 1, 'T-shirt-7ZqNZLm1oE', 'T-shirt', 'T-shirt meta_description', '28304', '', NULL, '2022-12-20 09:17:41'),
(10, 2, 1, 0, 'Saree', 8.00, '', 'Saree description', 1, 'Saree-X4xoe9N905', 'Saree', 'Saree meta_description', '28754', '', NULL, '2022-12-15 23:47:29'),
(11, 4, 2, 0, 'Smartphone', 3.00, '', 'Smartphone', 1, 'Smartphone-LX1dESBmFL', 'Smartphone', 'Smartphone', '64321', '', '2022-12-15 23:48:43', '2022-12-23 14:44:53'),
(12, 4, 2, 0, 'Button Phone', 0.00, '', 'Button Phone', 1, 'Button Phone-TOkR0LD5a8', 'Button Phone', 'Button Phone', 'Button Phone', '', '2022-12-23 14:44:26', '2022-12-23 14:44:26'),
(13, 1, 1, 0, 'Shoes', 0.00, '', 'Shoes', 1, 'Shoes-TsCpUbjCVd', 'Shoes', 'Shoes', 'Shoes', '', '2022-12-23 19:16:19', '2022-12-23 19:16:19'),
(14, 2, 1, 0, 'Ring', 0.00, 'women-diamond-heart-ring-2K2Slts2hXY.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, consequuntur?', 1, 'Ring-JbwNgBqB5c', 'Women Ring', 'Women Ring', 'Women Ring', '', '2023-01-17 06:22:59', '2023-01-17 06:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_01_072509_create_admins_table', 1),
(6, '2022_11_05_233745_create_vendors_table', 1),
(7, '2022_11_05_234734_create_vendor_bank_details_table', 1),
(8, '2022_11_05_235500_create_vendor_business_details_table', 1),
(9, '2022_11_08_085153_create_sections_table', 1),
(10, '2022_11_09_112551_create_brands_table', 1),
(11, '2022_11_09_205950_create_categories_table', 1),
(12, '2022_11_09_210054_create_products_table', 1),
(13, '2022_11_22_212542_create_product_attributes_table', 1),
(14, '2022_12_24_230753_create_products_filters_table', 2),
(15, '2022_12_24_230842_create_products_filters_values_table', 2),
(16, '2023_01_08_001107_create_product_images_table', 3),
(17, '2023_01_08_001528_create_product_images_table', 4),
(20, '2023_01_21_194653_create_carts_table', 5),
(21, '2023_01_23_001125_create_recent_views_table', 6),
(22, '2023_02_01_144724_create_banners_table', 7),
(23, '2023_02_02_161720_create_sub_banners_table', 8),
(24, '2023_02_05_135203_create_shipping_addresses_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`) VALUES
(7, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, 'Customer Address', 'Pending', '63e13aaf9fb45', 'BDT'),
(8, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, 'Customer Address', 'Pending', '63e13ae689d54', 'BDT');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_group_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_limit_alert` int(11) NOT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shoes_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_feature` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `brand_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_code`, `product_group_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_image`, `product_video`, `stock`, `stock_limit_alert`, `product_description`, `shoes_category`, `storage`, `ram`, `fabric`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `is_feature`, `created_at`, `updated_at`) VALUES
(4, 1, 10, 9, 0, 1, 'Super-Admin', 'Dashing Saree', 'MB9904', 'MB003', 'Red', 9000, '3', '400', 'istockphoto-1277055062-1024x1024AMG0MXibb2.jpg', '', 40, 5, 'Woman dashing Saree', NULL, NULL, NULL, 'Cotton', 'Woman dashing Saree', 'Woman dashing Saree', 'Woman dashing Saree', 1, 'No', '2023-01-08 11:09:49', '2023-01-17 09:38:42'),
(5, 1, 13, 11, 1, 2, 'Vendor', 'Man Cates', 'Nike006', 'vendor', 'Red', 5000, '2', '300', '0000201272978_05_kiRWxa48iGbj.jpg', '', 10, 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sapiente quod maxime. Amet, quisquam! Dolor enim molestias aliquid optio minima, accusantium in dolorem. Error nostrum eius praesentium itaque incidunt ex quam ratione modi, quia labore animi consectetur beatae saepe mollitia ea pariatur odit, deleniti expedita, culpa voluptate? Nulla, totam quo ad praesentium repellendus numquam debitis. Unde quisquam, quis asperiores sunt error atque quibusdam minima sed at! Praesentium hic, at illo commodi debitis laudantium eveniet reprehenderit, dicta a, explicabo unde sequi fugit consequatur aperiam rerum rem minus reiciendis mollitia itaque labore harum voluptatum dolorem dolor! Voluptatibus placeat provident optio repellat culpa.', 'Cates', NULL, NULL, NULL, 'Man beautiful cates', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sapiente quod maxime. Amet, quisquam! Dolor enim molestias aliquid optio minima, accusantium in dolorem. Error nostrum eius praesentium itaque incidunt ex quam ratione modi, quia labore animi consectetur beatae saepe mollitia.', 'Man Cates', 1, 'No', '2023-01-09 11:32:16', '2023-01-09 11:32:16'),
(6, 1, 14, 7, 1, 2, 'Vendor', 'Dimond Ring', 'DR0956', 'DR000', 'White', 80000, '7', '7', 'women-diamond-heart-ring-1O1epr50kqx.jpg', '', 50, 18, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis repellendus perferendis veniam tenetur numquam sunt expedita, magnam quis ut dolorem voluptate nihil soluta commodi nesciunt nemo optio quos eveniet? Saepe quas aliquid aut explicabo reprehenderit tempore et consequatur commodi sequi consequuntur architecto labore vero ab eos, non perferendis omnis natus adipisci quis in ipsa sed ducimus exercitationem! Non nihil voluptatem optio harum iure enim in necessitatibus corrupti quo facilis rerum praesentium error, qui, aliquam similique natus eos eligendi excepturi accusamus distinctio labore nemo repudiandae ea. Porro dolores sapiente voluptatibus. Incidunt totam numquam distinctio ea rerum quo dicta nulla obcaecati iusto.', NULL, NULL, NULL, NULL, 'Women Dimond Ring', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tenetur commodi ullam maiores accusantium vitae ex in culpa ducimus obcaecati?', 'Women Ring', 1, 'No', '2023-01-17 06:39:13', '2023-01-17 06:39:13'),
(7, 1, 10, 9, 0, 1, 'Super-Admin', 'Woman Saree', 'MB9901', 'MB003', 'Blue', 7000, '0', '400', 'PRN6903-Royal-Blue-color-Georgette-saree_SR12154pxv217lk3J.jpg', '', 80, 10, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit neque beatae itaque autem pariatur enim dolorem quam labore, culpa nam, modi animi numquam porro officia quos repudiandae earum ratione laudantium reprehenderit corporis velit aperiam dolorum asperiores sint! Neque obcaecati voluptate nam porro illo minus, ipsum enim iste modi natus sed optio consequuntur, corporis fuga ea unde doloribus quibusdam quas eveniet eligendi quasi vel veritatis! Quam blanditiis commodi velit natus voluptatem quaerat, odio sed a! Harum soluta cum temporibus quas ipsa.', NULL, NULL, NULL, 'Cotton', 'Woman Dashing Saree', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi non architecto soluta dolorem vero molestias porro. Natus ea eum eligendi, quasi vel voluptate? Architecto, ratione?', 'MB2', 1, 'No', '2023-01-17 10:08:14', '2023-01-22 05:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters`
--

CREATE TABLE `products_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters`
--

INSERT INTO `products_filters` (`id`, `cat_ids`, `filter_name`, `filter_column`, `status`, `created_at`, `updated_at`) VALUES
(3, '1,6,7,8,2,9,10,3', 'Fabric', 'fabric', 1, '2022-12-25 15:44:32', '2022-12-25 15:44:32'),
(4, '4,11,5', 'Ram', 'ram', 1, '2022-12-25 15:45:43', '2022-12-25 15:45:43'),
(5, '4,11,5', 'Storage', 'storage', 1, '2022-12-25 15:46:22', '2022-12-25 15:46:22'),
(6, '1,13,2,3', 'Shoes Category', 'shoes_category', 1, '2023-01-01 17:18:22', '2023-01-01 17:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters_values`
--

CREATE TABLE `products_filters_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters_values`
--

INSERT INTO `products_filters_values` (`id`, `filter_id`, `filter_value`, `status`, `created_at`, `updated_at`) VALUES
(1, '3', 'cotton', 1, NULL, NULL),
(2, '3', 'polester', 1, NULL, '2022-12-25 16:19:20'),
(3, '4', '4 GB', 1, NULL, NULL),
(4, '4', '8 GB', 1, NULL, NULL),
(5, '5', '64 GB', 1, NULL, NULL),
(6, '5', '128 GB', 1, NULL, '2022-12-25 17:39:16'),
(7, '4', '6 GB', 1, '2022-12-25 18:03:33', '2022-12-25 18:03:33'),
(8, '6', 'Sneakers', 1, '2023-01-01 17:20:18', '2023-01-01 17:20:18'),
(9, '6', 'Cates', 1, '2023-01-01 17:20:48', '2023-01-01 17:20:48'),
(10, '6', 'Sports & Outdoor Shoes', 1, '2023-01-01 17:21:31', '2023-01-01 17:21:31'),
(11, '6', 'Formal Shoes', 1, '2023-01-01 17:22:00', '2023-01-01 17:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_limit_alert` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Error reading data for table e_com09.product_attributes: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `e_com09`.`product_attributes`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(20, 4, 'istockphoto-1045841868-1024x1024Q0FbrSHuLN.jpg', '2023-01-16 19:58:27', '2023-01-16 19:58:27'),
(23, 5, 'pahang-malaysia-february-9-2018-260nw-1023664333zrtXltEUgl.webp', '2023-01-17 04:59:19', '2023-01-17 04:59:19'),
(24, 5, 'photo-1542291026-7eec264c27ffFBL5rtcqiT.jfif', '2023-01-17 04:59:20', '2023-01-17 04:59:20'),
(25, 6, 'women-diamond-heart-ring-2q7DknnTaAN.jpg', '2023-01-17 06:42:38', '2023-01-17 06:42:38'),
(26, 6, 'women-diamond-heart-ring-33QmU5S2YGT.jpg', '2023-01-17 06:42:39', '2023-01-17 06:42:39'),
(30, 7, 'free-silk-samruddhi-unstitched-original-imagg9yefbykq3nznB0mIB0yOl.webp', '2023-01-22 06:09:41', '2023-01-22 06:09:41'),
(31, 7, 'ce4e3b892eb207ddf1f42857d8e1787cadhIKCKLc9.jpg', '2023-01-22 06:09:42', '2023-01-22 06:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `recent_views`
--

CREATE TABLE `recent_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cookie_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recent_views`
--

INSERT INTO `recent_views` (`id`, `cookie_id`, `product_id`, `created_at`, `updated_at`) VALUES
(8, 'yfJipQX7w3ULpsxsKdBf520', 6, '2023-01-23 06:04:30', '2023-01-23 06:04:30'),
(9, 'yfJipQX7w3ULpsxsKdBf520', 7, '2023-01-23 06:04:46', '2023-01-23 06:04:46'),
(10, 'yfJipQX7w3ULpsxsKdBf520', 5, '2023-01-23 06:05:32', '2023-01-23 06:05:32'),
(11, 'yfJipQX7w3ULpsxsKdBf520', 4, '2023-01-25 05:32:41', '2023-01-25 05:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `admin_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Clothing', NULL, 1, NULL, '2022-12-15 10:10:58'),
(2, 1, 'Electronics', NULL, 1, NULL, NULL),
(4, 2, 'Accecories', 'x-blade-56ozFyqQlH3.png', 0, '2022-12-15 10:12:07', '2023-01-20 18:22:18'),
(6, 1, 'Others', NULL, 1, '2022-12-15 11:32:08', '2022-12-15 11:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobil` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobil`, `country`, `state`, `address`, `zip`, `created_at`, `updated_at`) VALUES
(1, 3, 'Demo', 'Roy', 'demo@gmail.com', '01869535334', 'Bangladesh', 'Jhenaidah', 'Singi,kaligonj', '7350', '2023-02-05 11:12:52', '2023-02-05 11:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_banners`
--

CREATE TABLE `sub_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_banners`
--

INSERT INTO `sub_banners` (`id`, `sub_banner_title`, `admin_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Sub-banner1', 1, 'stack-developerslIC6Tm3qfM.png', '2023-02-02 12:51:25', '2023-02-02 12:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobil` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `mobil`, `country`, `state`, `address`, `zip`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Protyay', 'Roy', 'r.protyay@gmail.com', NULL, '$2y$10$cfAa5WFd6vFFmH7fjyptmuO4almXCK595nl8wqj./pAEZai/T7u7K', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-30 13:16:15', '2023-01-30 13:16:15'),
(3, 'Demo', 'Roy', 'demo@gmail.com', NULL, '$2y$10$zD2NtlQXZBCgaC7ZjH2li.bHwzZna/nRg.jA5AlOwQsbXmjcJ9Nky', '01869535334', 'Bangladesh', 'Jhenaidah', 'Singi,kaligonj', 7350, NULL, 1, '2023-01-31 10:18:36', '2023-02-05 11:59:14'),
(4, 'Demo', 'Test', 'demo1@gmail.com', NULL, '$2y$10$cVlN6nqRLmBSwppBkST7uu/rMS/1EBDSw0QM0v4vpvPLxlMDZSrvm', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-02-05 09:30:35', '2023-02-05 09:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `password`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'demo@gmail.com', '$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'Kaliganj', 'Jhenaidah', 'Khulna', 'Bangladesh', '123456', '01700121212', 1, NULL, NULL),
(6, 'Vendor Test', 'test@gmail.com', '$2y$10$gx1ZMo5ChRlcStcjrd3G2ONgbO/BVXUDWcqee0ds5Q297uQjEqQ5G', 'dhaka,dhaka', 'Jessore', 'Jessore', 'Bangladesh', '12345ad', '01869535338', 0, '2023-02-01 05:03:24', '2023-02-01 07:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bank_details`
--

CREATE TABLE `vendor_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` tinyint(4) NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_bank_details`
--

INSERT INTO `vendor_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_name`, `account_number`, `bank_ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Demo Roy', 'Sonali Bank', '141235', '121214', NULL, NULL),
(2, 6, 'test vendor', 'test final', 'test', 'dryj', '2023-02-01 06:45:27', '2023-02-01 06:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_business_details`
--

CREATE TABLE `vendor_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` tinyint(4) NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_business_details`
--

INSERT INTO `vendor_business_details` (`id`, `vendor_id`, `shop_name`, `shop_email`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `address_proof`, `address_proof_image`, `business_license_number`, `gst_number`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Demo Enterprise', 'DemoEnterprise@gmail.com', 'Jessore', 'Jessore', 'Khulna', 'Bangladesh', '458697', '01900000000', 'www.DemoEnterprise.com', '253331', '77401.jpg', '65412623', '2254', '7895', NULL, NULL),
(4, 6, 'test', 'testbusiness@gmail.com', 'test', 'test', 'test', 'test', 'test', '01869535334', 'test', 'test', '45980.png', 'test', 'test', 'test', '2023-02-01 07:07:46', '2023-02-01 07:07:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters`
--
ALTER TABLE `products_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_views`
--
ALTER TABLE `recent_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_banners`
--
ALTER TABLE `sub_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendor_bank_details`
--
ALTER TABLE `vendor_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_business_details`
--
ALTER TABLE `vendor_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_filters`
--
ALTER TABLE `products_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `recent_views`
--
ALTER TABLE `recent_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_banners`
--
ALTER TABLE `sub_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor_bank_details`
--
ALTER TABLE `vendor_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_business_details`
--
ALTER TABLE `vendor_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
