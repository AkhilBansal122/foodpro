-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2023 at 04:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodmainprojectnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` bigint UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `user_id`, `unique_id`, `title`, `images`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'BNR-00021', 'testing', '/upload/restaurent/banner/1679807119.png', 'Test', 'Active', '2023-03-25 23:34:53', '2023-04-01 03:17:57'),
(2, 2, 'BNR-00022', 'Testing', '/upload/restaurent/banner/1681054870.jpg', 'adadad', 'Inactive', '2023-04-09 15:14:36', '2023-04-09 15:41:33'),
(3, 2, 'BNR-00023', 'sdd', '/upload/restaurent/banners/168115084620.jpg', 'aad', 'Active', '2023-04-10 18:20:46', '2023-04-10 18:20:46'),
(4, 2, 'BNR-00024', 'New', '/upload/restaurent/banners/168122988027.jpg', 's', 'Active', '2023-04-11 16:18:00', '2023-04-11 16:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opeing_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `unique_id`, `user_id`, `name`, `image`, `contact1`, `contact2`, `address`, `opeing_time`, `close_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BRN-00021', 2, 'Vasali Nagar', '/upload/restaurent/branch/167810555850.jpg', '0123456789', '01234567890', 'TEsting', '07:47', '09:47', 'Inactive', '2023-03-06 06:55:58', '2023-04-08 10:26:35'),
(2, 'BRN-00022', 2, 'Branch 2', '/upload/restaurent/branch/1681143560.jpg', '1010101010', '1010101010', 'Tests', '07:03', '22:03', 'Active', '2023-03-06 07:03:32', '2023-04-10 16:19:20'),
(3, 'BRN-00023', 2, 'Branch 3', '/upload/restaurent/branch/1678106732.jpg', '8507419630', '2581470140', 'ss', '07:00', '14:00', 'Active', '2023-03-06 07:04:21', '2023-03-06 07:19:47'),
(4, 'BRN-00024', 2, 'Branch4', '/upload/restaurent/branch/1681143505.jpg', '34343434343', '343434343432', 'sssdas', '13:00', '12:59', 'Active', '2023-03-07 12:19:23', '2023-04-10 16:18:25'),
(5, 'BRN-00025', 2, 'Sharma', '/upload/restaurent/branch/167847069048.jpg', '1234567890', '1234567890', 's', '10:22', '22:20', 'Active', '2023-03-10 12:21:30', '2023-03-11 02:43:20'),
(6, 'BRN-00026', 2, 'Ram Nagar', '/upload/restaurent/branch/16786018419.jpg', '34343434344', '012345678944', 's', '12:59', '00:59', 'Active', '2023-03-12 00:47:21', '2023-04-01 05:15:29'),
(7, 'BRN-00027', 2, 'sdsd', '/upload/restaurent/branch/1681141717.jpg', '3434343434', '3454444444', 'sssdd', '12:59', '12:59', 'Inactive', '2023-04-10 15:46:13', '2023-04-10 15:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `branch_opening_closeing_time`
--

CREATE TABLE `branch_opening_closeing_time` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `opening_time` time NOT NULL,
  `closeing_time` time NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `coupon_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `coupon_code` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `final_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `shipping_price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `coupon_id`, `coupon_code`, `price`, `discount_amount`, `final_amount`, `shipping_price`, `created_at`, `updated_at`) VALUES
(15, 69, 0, 0, NULL, '0.00', '0.00', '0.00', '0.00', '2023-04-22 06:47:41', '2023-04-22 17:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `qty` bigint UNSIGNED NOT NULL DEFAULT '1',
  `product_price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '1 for veg 2  non_veg',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `type`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'veg', 'Bargers', '/upload/restaurent/menus/1677309885.jpg', 'Active', '2023-02-25 05:43:01', '2023-02-28 16:56:27'),
(2, 2, 'veg', 'Lunchsssss', '/upload/restaurent/menus/1677312228.jpg', 'Active', '2023-02-25 08:03:48', '2023-03-01 16:23:53'),
(3, 2, 'veg', 'Dinner', '/upload/restaurent/menus/1677312240.jpg', 'Active', '2023-02-25 08:04:00', '2023-03-01 16:23:51'),
(4, 2, 'veg', 'Dinner', '/upload/restaurent/menus/1677312260.jpg', 'Inactive', '2023-02-25 08:04:20', '2023-03-01 16:46:36'),
(5, 2, 'non_veg', 'alert danger', '/upload/restaurent/menus/1677312607.jpg', 'Active', '2023-02-25 08:10:07', '2023-03-01 16:46:20'),
(6, 2, 'non_veg', 'TestIng', '/upload/restaurent/menus/1677390423.jpg', 'Inactive', '2023-02-26 05:47:03', '2023-03-01 16:23:40'),
(7, 2, 'veg', 'TestIng', '/upload/restaurent/menus/1677390439.jpg', 'Active', '2023-02-26 05:47:19', '2023-03-01 16:29:41'),
(8, 2, 'veg', 'Lunchs', '/upload/restaurent/menus/1677390726.jpg', 'Inactive', '2023-02-26 05:52:06', '2023-03-01 16:29:31'),
(9, 2, 'veg', 'Lunchss', '/upload/restaurent/menus/1677390923.jpg', 'Active', '2023-02-26 05:55:23', '2023-04-13 20:47:10'),
(10, 2, 'veg', 'sssss33', '/upload/restaurent/menus/1681400462.jpg', 'Active', '2023-04-13 21:11:02', '2023-04-13 21:18:57'),
(11, 2, 'veg', 'Deepak Barger', '/upload/restaurent/menus/1682185008.png', 'Active', '2023-04-22 23:06:48', '2023-04-22 23:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `chat_groups`
--

CREATE TABLE `chat_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `group_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_msgs`
--

CREATE TABLE `chat_msgs` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_rooms_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_group_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_name` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL, NULL, NULL, '2023-04-22 16:18:55', '2023-04-22 16:18:55'),
(2, 0, NULL, NULL, NULL, NULL, '2023-04-22 16:19:19', '2023-04-22 16:19:19'),
(3, 0, NULL, NULL, NULL, NULL, '2023-04-22 16:23:20', '2023-04-22 16:23:20'),
(4, 0, NULL, NULL, NULL, NULL, '2023-04-22 16:25:38', '2023-04-22 16:25:38'),
(5, 0, NULL, 'aaaaa@gmail.com', 'sdfghjkl;', 'wehgj,.', '2023-04-22 16:26:04', '2023-04-22 16:26:04'),
(6, 0, NULL, 'aaaaa@gmail.com', 'sdfghjkl;', 'wehgj,.', '2023-04-22 16:26:44', '2023-04-22 16:26:44'),
(7, 0, 'Priyanka', 'Priyanka@gmail.com', 'Hello', 'HIiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', '2023-04-22 16:27:06', '2023-04-22 16:27:06'),
(8, 0, NULL, NULL, NULL, NULL, '2023-04-22 16:35:09', '2023-04-22 16:35:09'),
(9, 67, NULL, NULL, NULL, NULL, '2023-04-22 17:10:10', '2023-04-22 17:10:10'),
(10, 67, NULL, NULL, NULL, NULL, '2023-04-22 17:11:38', '2023-04-22 17:11:38'),
(11, 67, NULL, NULL, NULL, NULL, '2023-04-22 17:36:38', '2023-04-22 17:36:38'),
(12, 67, 'test', 'test@yopmail.com', 'adas', 'asdad', '2023-04-22 17:36:51', '2023-04-22 17:36:51'),
(13, 67, NULL, NULL, NULL, NULL, '2023-04-22 23:11:13', '2023-04-22 23:11:13'),
(14, 67, 'Deepak', 'deepak@gmail.com', 'tst', 'test', '2023-04-22 23:11:36', '2023-04-22 23:12:16'),
(15, 67, NULL, NULL, NULL, NULL, '2023-04-23 10:50:56', '2023-04-23 10:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `user_id`, `slug`, `title`, `description`, `images`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'about-us', 'About Us', 'eyJpdiI6Im5PR3VGVUplRVhjWExNbjFpV3N1Umc9PSIsInZhbHVlIjoiWFJudFlOME1QT2RpK0tCVmIxLy82ZzNtbUdDcW1VQ3NFNTdVVUtmcS9yOTQ1akQ3YVlKRFJ4dmppRTRORVVEM2JUN214dmxvV3RNNlRKNnIrd2x6eHNIYlpuOEplN0UrdnlzVWNCTS82SFBqVFJvM0I2TzBEcitKdzFRQzhwVTRUVmlUSGhvQ3ZWR1JzeXBSM2E3eHlWb1Rpb1pZaENmNWJXVHp3Qmd1UVBSajcwdlY3cjRmWnphNVcrTFlqSHVxLzdNU2ZBWU9HdUNPNEhhMktadzlKZlZPeEVDZWtQOHd1Ti8reEZYWkNTeDk0M3UraW1ObmgzSGZBOXJMTFU2bVd1eG1sQTV1RDEyNVFMRTViWkJHRTdPS1B5ZWdtVlVWSVQrM2s2WWVRS1hKYVNwOS8xZGhBd2RNTTQvRnU5TlM2NEtjZGFhUk5wT0NWdmc5b3NyV2VEWWZFOE1PbWRyZjF4RkxDaG1LcmU0b1pnMXNraGJFUm1kYTJjY2hYeWtlVUNpeHZTNllpWEx3NnZOQkNEVkNJbngzdmNMc1VPVWJ3QnBKSjkrRTUrVE42V2Rva0hvSWNvaFIxSjZoRnpTTDZSQmpBUm83dFVyaEtjc2o1KzBmbGZPd3I4S3RicUhHU0thYzZ0dEZSM0lwNi81Y3pldDh3dmdBWDV5OHNFMnVrSXRSNmxOWmIzVHpWQmpZcVptdmR1ZkR1YzMxRVV1MDdLMzJ5elA0Wk53WHA1c1hlUU00a2dFVGhLcDd2LzBNdGNTZkRhb1hwQXlNbEFWNlEvMnFTUWJYbUNyOXZWbU9nKzA5dmZCN1RwQnhOZzFWakVFT1VxazcveWNpTjdUVllqZ0RKUk1sNHYxOERzajBlVTFCQXp0OEUvQ2FkbUFmUUFhZ1JEcHpidStMSU9MNHlyRTQrZkdiNHVQK3UvWE1lYUd6LzI2enVLQVZ3ME50cSs2eHI0NytvdDh2MXY0c3pLSmEyUUZiWjNPVEs3UFJpWVc3N1VBeng5ZUtneGE3WHgrREc0djBZcDlmdFUzby9KUWlZQjl5S05BbDQ0b3duUzBFN3NXSlpzaDhuYkgvd2hCa2libVN5bVIxZ2xLRkk1eVFyL29hMDVXVXJXZVJZcytFdzg3NDlKWmFZNm1OMnNRVldIcVhUczEzalpWQW9wY0o0OWoycmNtcDdUMkFsaVpFQkVtOU9PZ2hRbW54OFgwenFJOGNOTnE1Tmxxa2xnaVVnNDN1SXk3ZTMrN1FDbHp3NFNIOXRsSy9Rd3BjUitTdEczMjNZbXlyQlAyWm80YXg1OUpEMkVaWjJKRGg4L1BCNko1ZmZIY0h1RFIxNDJtRnI2NzAvRzcvcCtDR29wMEo5Q1JHUHAvdnJBUXlLWWUzWE9DWmFFVTJVbmZqa24rbnJGbjRGeTErN0JFMGJvZ1FacHdtUVpDTTB0OWF6T1hDRE80KzBLQmkxTGZSZmg1bnZLNE45cFZLVWw1TXJ4V0x2ZmNhb2tsMlJ6Z1pqOGM2b3NZV1VFRGZGeGVreGR3bzUyQlB1V3VVS3ZaNDR5dHRhV0t2RjlXeFJJYXlVOGtvMGZya0QrV0RPbjg5WEhlNThoaG5RVlhZcFBlQkd6aHlWUjV3QnFySGRnZlJCSGxUWThmTy9iNGZyQnZNZENscXowK0E4M1F0U3c4SmNlaERVUVhLMFo3aGxaTGpkcnNKUWpMOWhHM1dZQTVPS2NuSTk3cGV2V0NNUFNhWlMrUU5vdWJzUkI0OVZ6UUlQNjMyakN2T2xvc1lXQ01hV0tSQjJGTHVwRlM1MXRhMm0wbjdCTTRSTjB3ZHV1bjZybFNMV0NkWno4dmxib3JURzFYeHdEazgyOWc5bGw5bUlBejJRYzJCV0dESGZTdjU0TlBxL1BaaUVETWhhQUpWNmc2L3B3SFJLOFc5d1lOa0pXTUdXOFRZVEtFSitSTklld1hmK0YwOXc0L3VjNGROYXpOcEVnZi9meldwL0swUThhRWpTejhOZWloZC9TRUhJak10VytQUXFsaHBUd3N4U3RyZk5FNW9zYnVFNm42RVJxdUlVdz09IiwibWFjIjoiOTllMTFiODA4ZTFkMDk4YzRjMjY0ZmM3MTIyODJhOTc2MDc1ZjA0ZTI4MTU0YTIxMTBiNDYwZWRlZDMwMTc2MyIsInRhZyI6IiJ9', '', 'Active', '2023-02-03 17:10:11', '2023-04-15 17:04:37'),
(2, 2, 'privacy-policy', 'Privacy Policy', 'eyJpdiI6Img5Tnp3Y1IwRVNMSFZ0Z1Z0SExpMGc9PSIsInZhbHVlIjoib0dadmoyOHkrZlFQb0JMTytXcks0SzZSWW1lRnRQU2xGNWtzcU9iVGR2MmViZ3BGK3dvUnlqMElaM0duT0ZuajRwUDBtbE94MXozdUkyaHpaTjFvMFhKTTI3SGFLaEZRaUhOSllxYzdPZzNxaEs4MVJ5WHoxbmVmTlFtOHBIOGg3eFlGcGZFc2hZRDJSZDNGMUFSQkNXNXJoNWovNnpWTE9EZWthN0VrNXNQeElxR3ZPVWNvM2hpQVdsbnFoOGtzejNxQTEweTBkY0FzS2JZRnRjNlBRYXpEOEF4ZmFnU1lJalQwY2N6bmFGcFcydlZyeXJCVjVsZHV0LzdEZ2VkQzhwTDlBVDVsMzNJM2dZU0tLODFJMnZLazVzOEJiUFgvc0RoTUxnYWMwNjJ6a0Y3RXFETStRV29DWCtXUkIxRWJ3a2h1MTg5TnE3Qmd5K3A0ZTI3a3o2RFJzZGplZXVBamFISVViYjZBUmpyQlhpK1diRkYwM3hIdHNIY0phRUdPYStmQlZTc1dzdk44Unk5TURXTDU3VUx5VnpDRGRtZHJQaEFHblB5VlJGMGI3Q3RvZ2hFSXpTam16TEdwQ2NuMWhEYlhjZkk1ZHhVcEZ4eHZCc2RTRjQ1ZUlzL1Q4Qm1ZZExKU0FrN3NYR0pQYnVyamhtOGduUFNxY21oblNCM2hPY253MzkxOFM2M1ZIcFBqR05HUzVQREJoSm5uSmlRbklISVF3WXZZOFJNRmdLaTFEYlVSRUVJU2FLVWFQcmpjSUtBbUoweEtHYjJFUS92SWxEdlZXR2M3SHdibzdUZExpaXNBWXBrL3g5MmQ1dUxXMHBNSkRWSm9rR1Z2UW13Y20zUVVEMnQrUXYreEpkU1JnUHRGUHBzTzVpekxsLzVtUXd1cnZhSjlJQytqTWtXMFQ1Z0tZd3BFeWd4d1JFdEFwNW8xOUUrZVNjbXpmSHhhd0pqaXN1bFVFWkdFbWd6WjZERnF5amt0SWRXUW8vSmdNRWRHTDlRQlE2d1lOV1V3bDJZQ0Yrem1SWkQzTTdxMW1CZzkzdUpsbTVRcm9aS3Jwa2FCTzZONWNJRW1UcWNPczJseWI0UituTVdwOVNRL05pOVNzMjl6TzJvTlNrUlMxUUMxR1FYaFFBR0JZRGdITlZjMmM1UXpCQlRVa0ZqeDQzWjhuYlBUTGptZmgyRHJXQU1VUFJaODdPL1hPdFJoNWhoK2pyQmxRaytWWUJLZ2NMTWFqdWdzYy9HeUNoL2dMU203UTlBWUdlTytSSGgvIiwibWFjIjoiNWYxMGFlYzYwMjA2MGQ4ZDA3ODBjNTVjZjAzNmFlMDhmOTA3MjNlMWNlYzY4ODFlMGExMjg1MTlhNzYyYThhMyIsInRhZyI6IiJ9', '', 'Active', '2023-02-03 17:10:11', '2023-02-07 14:24:59'),
(3, 2, 'terms-conditions', 'Terms Conditions', 'eyJpdiI6ImxFTkp5VFVwc2VLSERFYXNZbVFKNlE9PSIsInZhbHVlIjoiRVpFMDUxKzhrVlE4dWtVejNGZG9OSmU1UG8xZXdQV2dUVVp6elJOdDk3QmFNRFVyR1BIUi81Qi9IQXQyYUQraTMwUzJUZVFnV1BmY0xlU0FSaU05Zm85NThTa3ZMQWZTVTdJamdxcHJ5Ly9weUZiVnhQKzZNR2lhb0FtV3hxd2lCbDU4TzY4QW5IVndwZjQrTWhiWHhJcU5Icy9wSDZ3cmVXd0JUS2xYeG5tRThsUnA2V001ZXljdHlTODh3SU5RRERWbncyZDMrQzFJYTE1czEvQ21YdDNqYjR2Y21kbGUrQXdsRjhka0ducTJSNFZRd3JJM1JGT2NjaEVZQ3AxdmZuVDdCNFdSS0dFNUtTdkZ3cFBBNC9ha2hmZ2ZkOFc5R29Od2JlamZzYjRGbW5hbVF5NGFvRzVScXZNZjlwMk91ZStrZlgyd2k2UXRSVW40K0N3cXlvVnRlMWI2RUw5RUN5UElIRTFzcU5CcVJ1THBaUmNtWW0wdUJaNmN0Y0oxZlIvb1JSMTUyTm1KV1hWTmtkeVlLdXZqUEVzLzZteHNGNmRmTVVtWVAyUGtBVWFhcWd4MSsvYjBVTm1jQzVobGlZUE5FYk9VSUQwK2RmdnVSeUtZdFg1aTM0VDFOYXowa0NCbnZUYWl5aGpQcTl1Q21uUXJ5aWhMQjFtdHkvbVU1RVNHZk8xVmhLYWt1dWYvR0tQc0JaajhERzFkU1k3aTFyY0lZbVdIT3lCRjc0TWM4MGxaYVBVU2lReEtEcUFpWHFtUVpndy9scmxwa1lhNHZjbkNpaXBQLzhCSllKODRZdWk5TjRkU1JGZmJKbkF0TFRmL052RTRCUmc1YjF6YVRneThJUEN4SVU0bis0bXBKekQ0cUlDRExNV05lMEU3b0tSM1Z4bTFXaEFOZDFkcW5FcFNQamZFSlVudWRRbmd3cllZbTkrSFYvMFZoZUxNd1crVTB6eHk0Zm41R1BjQVByNXE2ZGdRVjZJalJkeTlKWWpoOHZOMVg5OTkvckhvQjRJOGltWHArQ3BoSFl2MnNCaDY4NVdWZTg3aWJMeFJNY0FBYnYvRmR1ak5IUjFXdk96ZHpVM0M4UWVrUWY4MTkydktIUm5EVVZTc0lMcmZaMTVTZzBZUVVxNW1lQ2hCWFNsdmFraFFKR2VNRWozdG5tS1J1eWFCUzFDOVU0dmtZVmZGQjQ5dnl3SDJPT2tRWlg3bWliOVVPV0FYMDdvaXpXLytZeitNc2pxVUdLYXowaGw5ZENoTVRiSkhML1luTW1pMmcvait2WG42OG54QnZNVjJaUT09IiwibWFjIjoiODk2NWZkODVhOWQ5ZDcxMWQxNzNiNjg4NGZhY2QzMzUyNTg3MmY5ODNmNTZlYmQ2NDA5MDc3ZDJlY2EyYTgyNCIsInRhZyI6IiJ9', '', 'Active', '2023-02-03 17:10:11', '2023-03-02 17:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL DEFAULT '1',
  `qty_num` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `qty_opt` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` varchar(250) NOT NULL,
  `total_cr` decimal(50,2) NOT NULL DEFAULT '0.00',
  `total_dr` decimal(50,2) NOT NULL DEFAULT '0.00',
  `total_available` decimal(50,2) NOT NULL DEFAULT '0.00',
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `product_id`, `qty_num`, `qty_opt`, `price`, `total_cr`, `total_dr`, `total_available`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '1', 'kg', '100', '7.00', '0.00', '7.00', 'Active', '2023-04-23 15:01:21', '2023-04-23 17:23:41'),
(2, 2, 1, '1', 'Quintal', '100', '14.00', '0.00', '14.00', 'Active', '2023-04-23 15:11:20', '2023-04-23 17:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `inventories_requests`
--

CREATE TABLE `inventories_requests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL DEFAULT '1',
  `qty` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('Pending','Accept','Delivered','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventories_requests`
--

INSERT INTO `inventories_requests` (`id`, `user_id`, `product_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 67, 1, '1', 'Pending', '2023-04-23 21:55:36', '2023-04-23 21:55:36'),
(2, 67, 1, '1', 'Pending', '2023-04-23 21:56:13', '2023-04-23 21:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_trackings`
--

CREATE TABLE `inventory_trackings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL DEFAULT '1',
  `inventory_id` int NOT NULL,
  `cr_qty` decimal(50,2) NOT NULL,
  `dr_qty` decimal(50,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory_trackings`
--

INSERT INTO `inventory_trackings` (`id`, `user_id`, `product_id`, `inventory_id`, `cr_qty`, `dr_qty`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '5.00', '0.00', '2023-04-23 15:01:22', '2023-04-23 15:01:22'),
(2, 2, 1, 1, '1.00', '0.00', '2023-04-23 15:09:22', '2023-04-23 15:09:22'),
(3, 2, 1, 2, '5.00', '0.00', '2023-04-23 15:11:20', '2023-04-23 15:11:20'),
(4, 2, 1, 2, '5.00', '0.00', '2023-04-23 17:11:50', '2023-04-23 17:11:50'),
(5, 2, 1, 2, '1.00', '0.00', '2023-04-23 17:13:21', '2023-04-23 17:13:21'),
(6, 2, 1, 2, '1.00', '0.00', '2023-04-23 17:14:33', '2023-04-23 17:14:33'),
(7, 2, 1, 2, '1.00', '0.00', '2023-04-23 17:15:35', '2023-04-23 17:15:35'),
(8, 2, 1, 2, '1.00', '0.00', '2023-04-23 17:23:11', '2023-04-23 17:23:11'),
(9, 2, 1, 1, '1.00', '0.00', '2023-04-23 17:23:41', '2023-04-23 17:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_04_075007_create_tables_table', 2),
(7, '2023_03_05_092109_create_branch_models_table', 3),
(11, '2023_03_06_055122_create_branch_opening_closeing_time', 4),
(13, '2023_03_10_163456_create_aboutuses_table', 6),
(16, '2023_03_10_163114_create_services_table', 7),
(17, '2023_03_10_163537_create_banners_table', 8),
(37, '2014_10_12_100000_create_password_resets_table', 9),
(38, '2023_03_12_153746_is_customer', 9),
(39, '2023_03_19_050845_create_carts_table', 10),
(40, '2023_03_19_050900_create_carts_items_table', 10),
(41, '2023_03_21_150156_create_chat_groups_table', 10),
(42, '2023_03_21_150209_create_chat_rooms_table', 10),
(43, '2023_03_21_150217_create_chat_msgs_table', 10),
(44, '2023_03_23_153015_create_orders_table', 11),
(45, '2023_03_23_153027_create_order_items_table', 11),
(46, '2023_03_24_145312_create_transations_table', 11),
(47, '2023_03_24_152553_add_transation_id_orders_table', 11),
(48, '2023_03_26_081727_add_assign_chef_id_table', 12),
(51, '2023_03_26_083031_add_unique_id_table', 13),
(52, '2023_03_26_090555_add_unique_id_table', 14),
(53, '2023_03_26_102802_add_icon_table', 15),
(55, '2023_03_26_171159_add_prepared_time_table', 16),
(57, '2023_03_28_152404_add_column_device_key', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `table_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `coupon_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `coupon_code` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `final_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `shipping_price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `order_in_process` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 pendding 1 assign 2 accept 3 Prepared 4 deliverd',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transation_id` text COLLATE utf8mb4_unicode_ci,
  `assign_chef_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `unique_id` text COLLATE utf8mb4_unicode_ci,
  `prepared_time` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `user_id`, `branch_id`, `coupon_id`, `coupon_code`, `price`, `discount_amount`, `final_amount`, `shipping_price`, `order_in_process`, `created_at`, `updated_at`, `transation_id`, `assign_chef_id`, `unique_id`, `prepared_time`) VALUES
(12, 'TBL-002672671', 70, 2, 0, NULL, '50.00', '5.00', '45.00', '0.00', 4, '2023-04-20 16:50:36', '2023-04-22 13:19:55', '10', 68, 'ODR-000012', NULL),
(14, 'TBL-002672671', 70, 2, 0, NULL, '120.00', '12.00', '108.00', '0.00', 3, '2023-04-22 12:42:58', '2023-04-22 15:11:39', '12', 71, 'ODR-000014', '22:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `qty` bigint UNSIGNED NOT NULL DEFAULT '1',
  `product_price` decimal(50,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `user_id`, `product_id`, `qty`, `product_price`, `created_at`, `updated_at`) VALUES
(16, 12, 70, 5, 1, '50.00', '2023-04-20 16:50:36', '2023-04-20 16:50:36'),
(18, 14, 70, 3, 1, '120.00', '2023-04-22 12:42:58', '2023-04-22 12:42:58');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('superadmin@yopmail.com', '$2y$10$ju3NAOnfmFeMMe9wM.qcievmXQHU.e3qrwPtVEwdAC5SZ4YO69jfW', '2023-02-21 12:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'priyanka', 'Active', '2023-04-19 14:07:37', '2023-04-19 14:31:56'),
(2, 2, 'priyanka', 'Inactive', '2023-04-19 14:08:21', '2023-04-19 14:31:10'),
(3, 2, 'dfghj', 'Active', '2023-04-19 14:13:01', '2023-04-19 14:32:03'),
(4, 2, 'dfghjkdfsdsA', 'Active', '2023-04-19 14:22:56', '2023-04-19 14:32:09'),
(5, 2, 'test11111111', 'Inactive', '2023-04-19 14:28:24', '2023-04-19 14:28:51'),
(6, 2, 'vjhyuvgvg', 'Active', '2023-04-19 14:31:34', '2023-04-19 14:31:34'),
(7, 2, 'das', 'Active', '2023-04-19 16:22:28', '2023-04-19 16:22:28'),
(8, 2, 'sdadasdsa', 'Active', '2023-04-19 22:02:44', '2023-04-22 23:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `unique_id`, `title`, `description`, `status`, `created_at`, `updated_at`, `icon`) VALUES
(1, 2, 'BNR-00021', 'Services', 'sasd', 'Inactive', '2023-04-01 03:19:23', '2023-04-09 15:56:19', '/upload/restaurent/service/168033896316.jpg'),
(2, 2, 'BNR-00022', 'services2', 'asa', 'Active', '2023-04-01 03:19:49', '2023-04-22 17:33:31', '/upload/restaurent/service/168033898946.png'),
(3, 2, 'BNR-00023', 'test', 'sdsd', 'Active', '2023-04-09 16:13:54', '2023-04-09 16:13:54', '/upload/restaurent/service/16810568344.jpg'),
(4, 2, 'BNR-00024', 'ss', 's', 'Active', '2023-04-09 16:19:30', '2023-04-22 17:33:25', '/upload/restaurent/service/1681057192.png');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(50,2) NOT NULL,
  `discount` decimal(50,2) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `unique_id`, `category_id`, `user_id`, `name`, `image`, `images`, `description`, `price`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SM-0001', 3, 2, 'testss', '/upload/restaurent/sub_menus/1677350487.jpg', '/upload/restaurent/sub_menus/167740944440.jpg,/upload/restaurent/sub_menus/167741069113.jpg,/upload/restaurent/sub_menus/167741069134.jpg,', '23.00', '203.00', '24.00', 'Active', '2023-02-25 18:05:09', '2023-02-28 17:50:57'),
(2, 'SM-0002', 2, 2, 'test', '/upload/restaurent/sub_menus/167740680826.jpg', '/upload/restaurent/sub_menus/16774068083.jpg,/upload/restaurent/sub_menus/167740680812.jpg,', 'test', '100.00', '100.00', 'Active', '2023-02-26 10:20:08', '2023-03-01 17:05:52'),
(3, 'SM-0003', 1, 2, 'Chiz Barger', '/upload/restaurent/sub_menus/167808755736.jpg', '/upload/restaurent/sub_menus/167808755739.jpg,/upload/restaurent/sub_menus/167808755736.jpg,', 'testing Burger', '120.00', '0.00', 'Active', '2023-03-06 07:25:57', '2023-03-06 07:25:57'),
(4, 'SM-0004', 1, 2, 'Normal Barger', '/upload/restaurent/sub_menus/167808759840.jpg', '/upload/restaurent/sub_menus/167808759940.jpg,/upload/restaurent/sub_menus/167808759940.jpg,', 'tets', '60.00', '0.00', 'Active', '2023-03-06 07:26:39', '2023-04-01 12:53:29'),
(5, 'SM-0005', 1, 2, 'test', '/upload/restaurent/sub_menus/168140393731.jpg', '/upload/restaurent/sub_menus/168140393718.jpg,/upload/restaurent/sub_menus/168140393737.jpg,', 'ss', '50.00', '10.00', 'Active', '2023-04-13 22:08:57', '2023-04-13 22:08:57'),
(6, 'SM-0006', 10, 2, 'dd', '/upload/restaurent/sub_menus/1681498347.jpg', '/upload/restaurent/sub_menus/168149811121.jpg,/upload/restaurent/sub_menus/168149811143.jpg,', 'sss\r\nsdad', '50.00', '10.00', 'Active', '2023-04-13 23:18:16', '2023-04-15 00:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'manager id\r\n',
  `restaurent_id` tinyint DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `unique_id`, `restaurent_id`, `user_id`, `qrcode`, `status`, `created_at`, `updated_at`) VALUES
(13, 'TBL-002672671', 2, 67, 'qrimages/RES-0002/MAN-000267/table/TBL-002672671.svg', 'Active', '2023-04-15 14:31:43', '2023-04-15 14:31:43'),
(14, 'TBL-002671326714', 2, 67, 'qrimages/RES-0002/MAN-000267/table/TBL-002671326714.svg', 'Active', '2023-04-15 14:31:59', '2023-04-15 14:31:59'),
(15, 'TBL-002671326715', 2, 67, 'qrimages/RES-0002/MAN-000267/table/TBL-002671326715.svg', 'Active', '2023-04-15 14:31:59', '2023-04-15 14:31:59'),
(16, 'TBL-002671526716', 2, 67, 'qrimages/RES-0002/MAN-000267/table/TBL-002671526716.svg', 'Active', '2023-04-22 23:20:53', '2023-04-22 23:20:53'),
(17, 'TBL-002671526717', 2, 67, 'qrimages/RES-0002/MAN-000267/table/TBL-002671526717.svg', 'Active', '2023-04-22 23:20:53', '2023-04-22 23:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `transations`
--

CREATE TABLE `transations` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unique_id` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transations`
--

INSERT INTO `transations` (`id`, `order_id`, `from_id`, `to_id`, `status`, `created_at`, `updated_at`, `unique_id`) VALUES
(10, 12, 70, 2, 'Successfully', '2023-04-20 16:50:36', '2023-04-20 16:50:36', 'TRN-000010'),
(12, 14, 70, 2, 'Successfully', '2023-04-22 12:42:58', '2023-04-22 12:42:58', 'TRN-000012');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `branch_id` int DEFAULT '0',
  `unique_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Restaurent Name\r\n',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL COMMENT '1 for super admin\r\n2 for restaurent\r\n3 for manager\r\n4 for cife',
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upassword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_gst` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FSSAI` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'license copy if you have',
  `pen_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT ' if you have',
  `aadhar_card` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GST` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `other_mobile_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `local_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `permanent_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `no_of_table` int DEFAULT '0',
  `fetch_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `slug`, `branch_id`, `unique_id`, `user_id`, `name`, `email`, `email_verified_at`, `is_admin`, `firstname`, `lastname`, `image`, `password`, `upassword`, `bill_gst`, `remember_token`, `FSSAI`, `pen_card`, `aadhar_card`, `GST`, `other_mobile_number`, `mobile_number`, `created_at`, `updated_at`, `status`, `local_address`, `permanent_address`, `no_of_table`, `fetch_token`, `fcm_token`) VALUES
(1, NULL, 0, NULL, 0, 'Super Admin', 'superadmin@yopmail.com', NULL, 1, '', '', NULL, '$2y$10$JX5AmBl5eyhsnQZ3qXGaoO5BM/duSoqwAEN8W4USmoW6NDjp0OKYW', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '2023-02-21 12:06:27', '2023-04-08 10:26:55', 'Active', '', '', 0, NULL, NULL),
(2, NULL, 0, 'RES-0002', 0, 'Restaurent', 'admin@yopmail.com', NULL, 2, 'dd', 'ss', NULL, '$2y$10$JX5AmBl5eyhsnQZ3qXGaoO5BM/duSoqwAEN8W4USmoW6NDjp0OKYW', '', 1, NULL, '/upload/restaurent/FSSAI/1680801486.png', 'BNZAA2318J', '232323232323', '12', '8229842442', '8829842472', '2023-02-21 12:06:27', '2023-04-07 15:15:00', 'Active', 'sss', 'a', 0, NULL, NULL),
(67, NULL, 2, 'MAN-000267', 2, 'Restaurent', 'manager2@yopmail.com', NULL, 3, 'shyam', 'sharma', '/upload/restaurent/manager/168131585838.jpg', '$2y$10$JX5AmBl5eyhsnQZ3qXGaoO5BM/duSoqwAEN8W4USmoW6NDjp0OKYW', 'Admin@12345', 0, NULL, NULL, 'BNZAA2318J', '232323232323', NULL, '2222222222', '4444444444', '2023-04-12 16:10:58', '2023-04-22 17:50:53', 'Active', 's', 's', 5, NULL, NULL),
(68, NULL, 2, 'CHEFS-0006768', 67, 'Restaurent', 'chef@yopmail.com', NULL, 4, 'Kishan', 'Sharma', '', '$2y$10$.2VWfooMo9ao/RxFNqhMteu29jMurCHRQqtVAJNxJIMSd7Imbxsd.', 'Admin@12345', 0, NULL, NULL, 'BNZAA2318J', '123456789034', NULL, '33333333333', '2222222222', '2023-04-17 16:51:19', '2023-04-17 16:51:19', 'Active', 'sd', 'dd', 0, NULL, NULL),
(69, NULL, 2, 'CUS-00069', 2, 'Cust', 'customer@yopmail.com', NULL, 5, 'vishal', 'Sharma', '', '$2y$10$.2VWfooMo9ao/RxFNqhMteu29jMurCHRQqtVAJNxJIMSd7Imbxsd.', 'Admin@12345', 0, NULL, NULL, 'BNZAA2318J', '123456789034', NULL, '33333333334', '2222222224', '2023-04-17 16:51:19', '2023-04-17 16:51:19', 'Active', 'sd', 'dd', 0, NULL, NULL),
(70, NULL, 2, 'CUS-00070', 2, 'customer1Sharma', 'customer1@yopmail.com', NULL, 5, 'customer1', 'Sharma', NULL, '$2y$10$fWUcWKlEUFxe9MyufgEFlOTvH4XYle1GwsRG9KntL1Zr0ESwmKP7a', 'Admin@12345', 0, NULL, NULL, NULL, NULL, NULL, NULL, '1212121212', '2023-04-20 15:37:56', '2023-04-20 15:37:56', 'Active', NULL, NULL, 0, NULL, NULL),
(71, NULL, 2, 'CHEFS-0006771', 67, 'Restaurent', 'vishal@yopmail.com', NULL, 4, 'vishal', 'sharma', '', '$2y$10$ymwvHHBw4rOjk0ZU9aFCW.ztGniNKnI6raqdZ/cB3OsZDgSGSKeda', 'Admin@12345', 0, NULL, NULL, 'BNZAA2318J', '232323232323', NULL, '2222222222', '3333333333', '2023-04-21 16:33:46', '2023-04-21 16:33:46', 'Active', 'ss', 'ss', 0, NULL, NULL),
(73, NULL, 0, 'WHE-00073', 2, NULL, 'rahul@yopmail.com', NULL, 6, 'rahul', 'sharma', '/upload/restaurent/warehouse/1682239198.jpg', '$2y$10$osVVBZwgnRYsvX.YVqOtR.VfRgvBDHbVxpybtUfnELZohKeVKaLcG', 'Admin@12345', 0, NULL, NULL, 'BNZAA2318J', '3434343434', NULL, '3333333333', '2222222222', '2023-04-23 08:39:58', '2023-04-23 08:40:05', 'Active', 'ss', 'ss', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aboutus_user_id_foreign` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_user_id_foreign` (`user_id`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branchs_user_id_foreign` (`user_id`);

--
-- Indexes for table `branch_opening_closeing_time`
--
ALTER TABLE `branch_opening_closeing_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_opening_closeing_time_user_id_foreign` (`user_id`),
  ADD KEY `branch_opening_closeing_time_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_groups`
--
ALTER TABLE `chat_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_groups_customer_id_foreign` (`customer_id`),
  ADD KEY `chat_groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_msgs`
--
ALTER TABLE `chat_msgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_msgs_chat_rooms_id_foreign` (`chat_rooms_id`),
  ADD KEY `chat_msgs_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_rooms_chat_group_id_foreign` (`chat_group_id`),
  ADD KEY `chat_rooms_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories_requests`
--
ALTER TABLE `inventories_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_trackings`
--
ALTER TABLE `inventory_trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_items_order_id_foreign` (`order_id`),
  ADD KEY `orders_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_user_id_foreign` (`user_id`);

--
-- Indexes for table `transations`
--
ALTER TABLE `transations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transations_order_id_foreign` (`order_id`),
  ADD KEY `transations_from_id_foreign` (`from_id`),
  ADD KEY `transations_to_id_foreign` (`to_id`);

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
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `branch_opening_closeing_time`
--
ALTER TABLE `branch_opening_closeing_time`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chat_groups`
--
ALTER TABLE `chat_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_msgs`
--
ALTER TABLE `chat_msgs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventories_requests`
--
ALTER TABLE `inventories_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_trackings`
--
ALTER TABLE `inventory_trackings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transations`
--
ALTER TABLE `transations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD CONSTRAINT `aboutus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branchs`
--
ALTER TABLE `branchs`
  ADD CONSTRAINT `branchs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branch_opening_closeing_time`
--
ALTER TABLE `branch_opening_closeing_time`
  ADD CONSTRAINT `branch_opening_closeing_time_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branchs` (`id`),
  ADD CONSTRAINT `branch_opening_closeing_time_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_groups`
--
ALTER TABLE `chat_groups`
  ADD CONSTRAINT `chat_groups_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_msgs`
--
ALTER TABLE `chat_msgs`
  ADD CONSTRAINT `chat_msgs_chat_rooms_id_foreign` FOREIGN KEY (`chat_rooms_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_msgs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD CONSTRAINT `chat_rooms_chat_group_id_foreign` FOREIGN KEY (`chat_group_id`) REFERENCES `chat_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transations`
--
ALTER TABLE `transations`
  ADD CONSTRAINT `transations_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transations_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transations_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
