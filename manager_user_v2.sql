-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 09:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminweb`
--

CREATE TABLE `adminweb` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size_product` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `description`, `create_at`, `update_at`) VALUES
(1, 'Bộ Nỉ', '../../image/cate_boNi.webp', 'Bộ Nỉ', '2024-12-22 17:23:35', '2024-12-22 17:23:35'),
(2, 'Áo Khoác', '../../image/cate_aoKhoac.webp', 'Áo Khoác', '2024-12-22 17:24:47', '2024-12-22 18:04:36'),
(3, 'Sơ mi', '../../image/cate_soMi.webp', 'Sơ mi', '2024-12-22 17:26:58', '2024-12-22 17:26:58'),
(4, 'Áo Polo', '../../image/cate_aoPolo.webp', 'Áo Polo', '2024-12-22 17:30:17', '2024-12-22 17:30:17'),
(5, 'Quần Kaki', '../../image/cate_quanKaki.webp', 'Quần Kaki', '2024-12-22 17:30:58', '2024-12-22 17:30:58'),
(6, 'Áo thun', '../../image/cate_aoThun.webp', 'Áo thun', '2024-12-22 17:31:19', '2024-12-22 17:31:19'),
(7, 'Quần Jeans', '../../image/cate_quanJean.webp', 'Quần Jeans', '2024-12-22 17:32:27', '2024-12-22 17:59:44'),
(8, 'Quần Short', '../../image/cate_quanShort.jpg', 'Quần Short', '2024-12-22 17:33:22', '2024-12-22 17:33:22'),
(9, 'Áo Len', '../../image/cate_aoLen.webp', 'Áo Len', '2024-12-22 17:33:47', '2024-12-22 17:33:47'),
(10, 'Quần Âu', '../../image/cate_quanAu.webp', 'Quần Âu', '2024-12-22 17:34:10', '2024-12-22 17:34:10'),
(11, 'Áo Blaze', '../../image/cate_aoBlaze.webp', 'Áo Blaze', '2024-12-22 17:34:24', '2024-12-22 17:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `logintoken`
--

CREATE TABLE `logintoken` (
  `id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `status` enum('Còn hàng','Hết hàng') DEFAULT 'Còn hàng',
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `category`, `price`, `old_price`, `discount`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quần âu side tab FABT008', 'FABT00801PE00SB_BL-29', 10, 500000.00, 500000.00, 0, 'Còn hàng', 'Quần âu side tab FABT008 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-22 18:08:26', '2024-12-22 18:16:49'),
(2, 'Quần âu slim fit cạp lót họa tiết FABT002', 'FABT00201PE00SB_NV-29', 10, 500000.00, 500000.00, 0, 'Còn hàng', 'Quần âu slim fit cạp lót họa tiết FABT002 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-22 18:19:34', '2024-12-22 18:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_name`, `created_at`) VALUES
(1, 1, 'Đen', '2024-12-22 18:08:26'),
(2, 2, 'Xanh Navy,Xám nhạt,Đen nhạt,Xanh đậm,Đen', '2024-12-22 18:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_main`, `created_at`) VALUES
(1, 1, '../../image/675cd2b8c65d5.webp', 0, '2024-12-22 18:08:26'),
(2, 2, '../../image/675cd3ca98566.jpg', 0, '2024-12-22 18:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_name`, `created_at`) VALUES
(1, 1, '29,30,31,32,33', '2024-12-22 18:08:26'),
(2, 2, '29,30,31,32,33', '2024-12-22 18:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone`, `password`, `forgotToken`, `activeToken`, `status`, `create_at`, `update_at`, `role`) VALUES
(1, 'Bùi Minh Chí', 'minhchi@gmail.com', '0327266665', '12345', 'NULL', 'active', 1, '2024-12-24 14:22:01', '2024-12-24 14:22:01', 'admin'),
(4, 'Nguyễn Thái Dương', 'thaiduong@gmail.com', '03223266665', '12345', 'NULL', 'active', 1, '2024-12-24 14:22:01', '2024-12-24 14:22:01', 'customer'),
(5, 'Điêu Vũ Thành Huy', 'thanhhuy@gmail.com', '0999999434', '12345', 'NULL', 'active', 1, '2024-12-24 14:32:28', '2024-12-24 14:32:28', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminweb`
--
ALTER TABLE `adminweb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintoken`
--
ALTER TABLE `logintoken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminweb`
--
ALTER TABLE `adminweb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logintoken`
--
ALTER TABLE `logintoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `logintoken`
--
ALTER TABLE `logintoken`
  ADD CONSTRAINT `logintoken_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `user` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
