-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 14, 2024 lúc 09:36 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `xuong-laravel-admin`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `catelogues`
--

CREATE TABLE `catelogues` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `catelogues`
--

INSERT INTO `catelogues` (`id`, `name`, `cover`, `is_active`, `created_at`, `updated_at`) VALUES
(9, 'áo phông nam', 'catelogues/5vw4ICBrVGzZRkqxNnxxtIJraPMVCmZhVzIZ5nRY.png', 1, '2024-06-13 20:06:27', '2024-06-13 20:06:38'),
(10, 'Váy Nữ', 'catelogues/hauafgXwNfkd92sDdKkKZa3RGLCP7Hf7mRsQiexp.png', 1, '2024-06-13 20:17:59', '2024-06-13 22:39:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(51, '2014_10_12_100000_create_password_resets_table', 1),
(52, '2019_08_19_000000_create_failed_jobs_table', 1),
(53, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(54, '2024_06_12_065531_create_products_table', 1),
(55, '2024_06_12_065558_create_catelogues_table', 1),
(60, '2024_06_12_065710_create_product_sizes_table', 2),
(61, '2024_06_12_065723_create_product_colors_table', 2),
(62, '2024_06_12_065731_create_product_variants_table', 2),
(63, '2024_06_12_071151_create_product_galleries_table', 3),
(64, '2024_06_14_061051_create_tags_table', 4),
(65, '2024_06_14_061234_create_product_tag_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `catelogue_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_regular` double NOT NULL,
  `price_sale` double DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'chất liệu',
  `user_manual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hướng dẫn sử dụng',
  `view_count` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_hot_deal` tinyint(1) NOT NULL DEFAULT '0',
  `is_good_deal` tinyint(1) NOT NULL DEFAULT '0',
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `catelogue_id`, `name`, `slug`, `sku`, `img_thumbnail`, `price_regular`, `price_sale`, `description`, `content`, `material`, `user_manual`, `view_count`, `is_active`, `is_hot_deal`, `is_good_deal`, `is_new`, `is_home`, `created_at`, `updated_at`) VALUES
(1, 9, 'Áo Phông Boy Phố', 'ao-phong-boy-pho-apbp001', 'APBP001', 'products/2e17talH4toxSUDuCOBc10LVvN7uWtSMwxYQhpCN.png', 200000, 150000, 'hihi', 'hiih', 'hihi', 'hihi', 0, 1, 0, 1, 0, 1, '2024-06-14 01:02:39', '2024-06-14 01:02:39'),
(2, 10, 'Chân Váy Đen', 'chan-vay-den-cvd001', 'CVD001', 'products/1oecTDIwfP4r8Yhryc9gl5dtakQsewGCw7he9mZC.png', 270000, 199999, 'hhh', 'hhhh', 'hhh', 'hhh', 0, 1, 0, 1, 0, 0, '2024-06-14 01:54:58', '2024-06-14 01:54:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_colors`
--

INSERT INTO `product_colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '#000000', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(2, '#33FF33', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(3, '#EE0000', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(4, '#FF3366', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(5, '#330099', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(6, '#FF6600', '2024-06-14 00:47:58', '2024-06-14 00:47:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://antimatter.vn/wp-content/uploads/2022/10/hinh-anh-gai-xinh-de-thuong-dep-nhat-viet-nam.jpg', NULL, NULL),
(2, 1, 'https://clipnong.us/wp-content/uploads/2022/08/thuy-hang-2k1-lo-clip-nong6.jpg', NULL, NULL),
(3, 2, 'https://antimatter.vn/wp-content/uploads/2022/10/hinh-anh-gai-xinh-de-thuong-dep-nhat-viet-nam.jpg', NULL, NULL),
(4, 2, 'https://clipnong.us/wp-content/uploads/2022/08/thuy-hang-2k1-lo-clip-nong6.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(2, 'M', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(3, 'XL', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(4, 'XXl', '2024-06-14 00:47:58', '2024-06-14 00:47:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 1),
(1, 10),
(2, 3),
(2, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_color_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_size_id` bigint UNSIGNED NOT NULL,
  `quantity` bigint UNSIGNED NOT NULL DEFAULT '0',
  `price` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_color_id`, `product_id`, `product_size_id`, `quantity`, `price`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(2, 1, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(3, 2, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(4, 3, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(5, 4, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(6, 5, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(7, 6, 1, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(8, 0, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(9, 1, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(10, 2, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(11, 3, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(12, 4, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(13, 5, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(14, 6, 1, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(15, 0, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(16, 1, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(17, 2, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(18, 3, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(19, 4, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(20, 5, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(21, 6, 1, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(22, 0, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(23, 1, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(24, 2, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(25, 3, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(26, 4, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(27, 5, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(28, 6, 1, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(29, 0, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(30, 1, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(31, 2, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(32, 3, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(33, 4, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(34, 5, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(35, 6, 2, 1, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(36, 0, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(37, 1, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(38, 2, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(39, 3, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(40, 4, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(41, 5, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(42, 6, 2, 2, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(43, 0, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(44, 1, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(45, 2, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(46, 3, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(47, 4, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(48, 5, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(49, 6, 2, 3, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(50, 0, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(51, 1, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(52, 2, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(53, 3, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(54, 4, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(55, 5, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL),
(56, 6, 2, 4, 100, 500000, 'https://th.bing.com/th/id/OIP.yBBdNUNfsFoteVthqAkAywHaJ3?rs=1&pid=ImgDetMain', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A quidem.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(2, 'Ullam ut.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(3, 'Dolore.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(4, 'Nihil.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(5, 'Assumenda.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(6, 'Eveniet.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(7, 'Officia.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(8, 'Est et.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(9, 'Nesciunt.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(10, 'Qui.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(11, 'Illum et.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(12, 'Deleniti.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(13, 'Est.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(14, 'Ut aut ad.', '2024-06-14 00:47:58', '2024-06-14 00:47:58'),
(15, 'Quae.', '2024-06-14 00:47:58', '2024-06-14 00:47:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `catelogues`
--
ALTER TABLE `catelogues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catelogues_name_unique` (`name`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_price_regular_unique` (`price_regular`),
  ADD KEY `products_catelogue_id_foreign` (`catelogue_id`);

--
-- Chỉ mục cho bảng `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_colors_name_unique` (`name`);

--
-- Chỉ mục cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_galleries_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sizes_name_unique` (`name`);

--
-- Chỉ mục cho bảng `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_id`,`tag_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_unique` (`product_id`,`product_color_id`,`product_size_id`),
  ADD KEY `product_variants_product_color_id_foreign` (`product_color_id`),
  ADD KEY `product_variants_product_size_id_foreign` (`product_size_id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `catelogues`
--
ALTER TABLE `catelogues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_catelogue_id_foreign` FOREIGN KEY (`catelogue_id`) REFERENCES `catelogues` (`id`);

--
-- Các ràng buộc cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD CONSTRAINT `product_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_color_id_foreign` FOREIGN KEY (`product_color_id`) REFERENCES `product_colors` (`id`),
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
