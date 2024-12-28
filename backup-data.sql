-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

--
-- Dumping data for table `adminweb`
--

INSERT INTO `adminweb` (`id`, `email`, `password`, `create_at`) VALUES
(1, 'duongvq392@gmail.com', 'duongvq3124!', '2024-12-24 21:00:46');

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `product_name`, `price`, `old_price`, `image_url`, `color`, `size_product`, `quantity`, `created_at`) VALUES
(5, 4, 'Quần âu slim-fit cạp trơn - DABT900', 349.00, 500.00, 'http://localhost/btl-php/image/675cd6be79fd1.webp', 'Đen', '29', 1, '2024-12-23 06:43:55'),
(6, 4, 'Quần âu slim-fit cạp trơn - DABT900', 349.00, 500.00, 'http://localhost/btl-php/image/675cd6be79fd1.webp', 'Đen nhạt', '29', 1, '2024-12-23 06:46:29'),
(7, 4, 'Quần âu slim-fit cạp trơn - DABT900', 349.00, 500.00, 'http://localhost/btl-php/image/675cd6be79fd1.webp', 'Đen nhạt', '32', 2, '2024-12-23 06:57:47'),
(8, 25, 'Quần kaki dài basic cạp tender FABK001', 349.00, 500.00, 'http://localhost/btl-php/image/ac-kaki2.webp', 'Xanh da trời đậm', '33', 2, '2024-12-23 12:59:00');

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
(2, 'Quần âu slim fit cạp lót họa tiết FABT002', 'FABT00201PE00SB_NV-29', 10, 500000.00, 500000.00, 0, 'Còn hàng', 'Quần âu slim fit cạp lót họa tiết FABT002 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-22 18:19:34', '2024-12-22 18:19:34'),
(3, 'Quần âu slim fit điều chỉnh cạp trơn EABT016', 'EABT01601PE00SB_NV-33', 10, 500000.00, 500000.00, 0, 'Còn hàng', 'Quần âu slim fit điều chỉnh cạp trơn EABT016 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-22 23:18:58', '2024-12-22 23:18:58'),
(4, 'Quần âu slim-fit cạp trơn - DABT900', 'DABT90001PE00SB_BL-29 ', 10, 349000.00, 500000.00, 30, 'Còn hàng', 'Quần âu slim-fit cạp trơn - DABT900 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-22 23:20:33', '2024-12-22 23:20:33'),
(13, 'Quần âu slim-fit cạp trơn FABT003', 'FABT00301PE00SB_DNV-33 ', 10, 500000.00, 499998.00, 0, 'Còn hàng', 'Quần âu nam slim-fit cạp trơn - FABT003 với form dáng slimfit cạp lót họa tiết chuẩn chỉnh, kết hợp điểm nhấn tinh tế và hack dáng một cách tự nhiên. Quần âu mới nhà TORANO mang lại một vẻ ngoài lịch thiệp, bảnh bao cho những anh chàng công sở.', '2024-12-23 14:51:51', '2024-12-23 14:51:51'),
(14, 'Quần âu slimfit cạp điều chỉnh, gấu LV FABT005', 'FABT00501PE00SB_GR-29', 10, 500000.00, 500000.00, 0, 'Còn hàng', 'Quần âu slimfit cạp điều chỉnh, gấu LV FABT005 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-23 17:56:02', '2024-12-23 17:56:02'),
(15, 'Quần âu vải kẻ dọc cạp tender FABT011', 'FABT01101PE09SB_BL-29', 10, 550000.00, 550000.00, 0, 'Còn hàng', 'Quần âu vải kẻ dọc cạp tender FABT011 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát.', '2024-12-23 18:06:51', '2024-12-23 18:06:51'),
(16, 'Quần âu vải kẻ dọc FABT010', 'FABT01001PE09SB_GR-29', 10, 550000.00, 550000.00, 0, 'Còn hàng', 'Quần âu vải kẻ dọc FABT010 là mẫu quần âu nam cao cấp chính hãng Torano. Chất vải dày dặn, mềm mịn và không nhăn nhàu lại cực thì thoáng mát. Sản phẩm khi kết hợp cùng áo blazer Torano FWTV001 sẽ tạo thành 1 set đồ lịch lãm, trẻ trung, tôn lên vẻ nam tính cho anh em.', '2024-12-23 18:08:42', '2024-12-23 18:08:42'),
(17, 'Quần jeans basic FABJ003', 'FABJ00301CT00RB_DNV-29', 7, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans nam TORANO dáng basic FABJ003\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:18:08', '2024-12-23 18:18:08'),
(18, 'Quần Jeans basic slim EABJ012', 'EABJ01201CT00SB_LG-29', 7, 399000.00, 500000.00, 20, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans basic slim EABJ012\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:28:01', '2024-12-23 18:28:01'),
(19, 'Quần Jeans basic slim FABJ007', 'FABJ00701KG00SB_DBU-29', 7, 299000.00, 500000.00, 40, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans basic slim FABJ007\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:31:41', '2024-12-23 18:31:41'),
(20, 'Quần Jeans basic slim FABJ008', 'FABJ00801CT00SB_DBU-29', 7, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans basic slim FABJ008\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:33:10', '2024-12-23 18:33:10'),
(21, 'Quần Jeans basic slim FABJ015', 'FABJ01501CT16SB_BL-29', 7, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans basic slim FABJ015\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:34:26', '2024-12-23 18:34:26'),
(22, 'Quần Jeans rách FABJ016', 'FABJ01601CT19RB_DBU-29', 7, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans rách FABJ016\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:35:54', '2024-12-23 18:35:54'),
(23, 'Quần Jeans xước slim FABJ010', 'FABJ01001CT18SB_BU-29', 7, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Jeans xước slim FABJ010\r\nChất liệu: Jeans dày dặn, siêu bền, không phai màu\r\nMàu sắc: Xanh da trời nhạt, Darknavy, Xanh da trời đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:37:35', '2024-12-23 18:37:35'),
(24, 'Quần dài kaki basic chun cạp FABK002', 'FABK00201CT00SB_BL-29', 5, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần dài kaki basic chun cạp FABK002 \r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:51:33', '2024-12-23 18:51:33'),
(25, 'Quần kaki dài basic cạp tender FABK001', 'FABK00101CT00SB_DBU-29', 5, 349000.00, 500000.00, 30, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần kaki dài basic cạp tender FABK001\r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:53:27', '2024-12-23 18:53:27'),
(26, 'Quần kaki dài basic FABK908', 'FABK90801CT00SB_NV-29', 5, 500000.00, 500000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần kaki dài basic FABK908\r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 18:55:53', '2024-12-23 18:55:53'),
(27, 'Quần kaki dài basic vải hiệu ứng EABK022', 'EABK02201CT01SB_BL-29', 5, 500000.00, 500000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần kaki dài basic vải hiệu ứng EABK022\r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 19:02:44', '2024-12-23 19:02:44'),
(28, 'Quần kaki dài basic vải vân bổ sườn DABK603', 'DABK60301CT00SB_DBE-29', 5, 480000.00, 480000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần kaki dài basic vải vân bổ sườn DABK603\r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 19:47:08', '2024-12-23 19:47:08'),
(29, 'Quần Kaki Jogger túi ốp FABK042', 'FABK04203CT00RB_DCR-29', 5, 520000.00, 520000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần Kaki Jogger túi ốp FABK042\r\nChất liệu: Kaki dày dặn, siêu bền, không phai màu\r\nMàu sắc: Đen, Dark navy, Trắng kem đậm\r\nPhom dáng: basic hơi ôm', '2024-12-23 19:48:23', '2024-12-23 19:48:23'),
(30, 'Short gió basic in phản quang FSBW002', 'FSBW00202PE00SB_DCB-S', 8, 150000.00, 150000.00, 0, 'Còn hàng', 'Short gió basic in phản quang FSBW002 HOT HIT cả về chất lượng lẫn thiết kế. Đây là một trong những mẫu short nam được ưa chuộng nhất hiện nay. TORANO luôn mong muốn mang đến sản phẩm tốt nhất tới khách hàng.', '2024-12-23 19:57:15', '2024-12-23 19:57:15'),
(31, 'Quần short bộ can gấu FSBS005 - FSTP032', 'FSBS00502CV32SB_DNV-XL', 8, 320000.00, 320000.00, 0, 'Còn hàng', 'Quần short nỉ basic cạp âu FSBS001 là mẫu quần short nam cao cấp mới nhất được sản xuất với công nghệ hiện đại nhất hiện nay. Quần short nam TORANO được may từ chất liệu vải cao cấp, thấm hút mồ hôi cực tốt và co giãn vừa phải, không bai không xù sau một thời gian dài sử dụng.', '2024-12-23 20:03:17', '2024-12-23 20:03:17'),
(32, 'Quần short nỉ basic cạp âu FSBS001', 'FSBS00102PE00SB_CR-S', 8, 320000.00, 320000.00, 0, 'Còn hàng', 'Quần short nỉ basic cạp âu FSBS001 là mẫu quần short nam cao cấp mới nhất được sản xuất với công nghệ hiện đại nhất hiện nay. Quần short nam TORANO được may từ chất liệu vải cao cấp, thấm hút mồ hôi cực tốt và co giãn vừa phải, không bai không xù sau một thời gian dài sử dụng.', '2024-12-23 20:09:37', '2024-12-23 20:09:37'),
(33, 'Quần short kaki basic FSBK019', 'FSBK01902CA00RB_BL-29', 8, 380000.00, 380000.00, 0, 'Còn hàng', 'Quần short kaki basic FSBK019 HOT HIT cả về chất lượng lẫn thiết kế. Đây là một trong những mẫu short nam được ưa chuộng nhất hiện nay. TORANO luôn mong muốn mang đến sản phẩm tốt nhất tới khách hàng.', '2024-12-23 20:11:24', '2024-12-23 20:11:24'),
(34, 'Quần short nỉ moi giả in họa tiết Horse FSBS003', 'FSBS00302CV00RB_GR-S', 8, 320000.00, 320000.00, 0, 'Còn hàng', 'Quần short nỉ moi giả in họa tiết Horse FSBS003 là mẫu quần short nam cao cấp mới nhất được sản xuất với công nghệ hiện đại nhất hiện nay. Quần short nam TORANO được may từ chất liệu vải cao cấp, thấm hút mồ hôi cực tốt và co giãn vừa phải, không bai không xù sau một thời gian dài sử dụng. ', '2024-12-23 20:12:48', '2024-12-23 20:12:48'),
(35, 'Short khaki basic gấu LV chiết ly, phối quai nhê FSBK016', 'FSBK01602CT00SB_BL-29', 8, 360000.00, 360000.00, 0, 'Còn hàng', 'Short khaki basic gấu LV chiết ly, phối quai nhê FSBK016 HOT HIT cả về chất lượng lẫn thiết kế. Đây là một trong những mẫu short nam được ưa chuộng nhất hiện nay. TORANO luôn mong muốn mang đến sản phẩm tốt nhất tới khách hàng.', '2024-12-23 20:14:39', '2024-12-23 20:14:39'),
(36, 'Short đũi cạp thường basic, gập gấu FSBI002', 'FSBI00202CA00SB_MS-29', 8, 349000.00, 450000.00, 22, 'Còn hàng', 'Quần short đũi cạp thường basic, gập gấu FSBI002 HOT HIT cả về chất lượng lẫn thiết kế. Đây là một trong những mẫu short nam được ưa chuộng nhất hiện nay. TORANO luôn mong muốn mang đến sản phẩm tốt nhất tới khách hàng.', '2024-12-23 20:15:59', '2024-12-23 20:15:59'),
(37, 'Quần short khaki cạp chun basic, diễu gấu FSBK010', 'FSBK01002CT00RB_LMS-29', 8, 279000.00, 420000.00, 34, 'Còn hàng', 'Quần short kaki cạp chun basic, diễu gấu FSBK010 HOT HIT cả về chất lượng lẫn thiết kế. Đây là một trong những mẫu short nam được ưa chuộng nhất hiện nay. TORANO luôn mong muốn mang đến sản phẩm tốt nhất tới khách hàng.', '2024-12-23 20:17:34', '2024-12-23 20:17:34'),
(38, 'Áo khoác phao 3 lớp lót bông cổ cao FWCF005', 'FWCF00531PE00MB_DNV-S', 2, 990000.00, 990000.00, 0, 'Còn hàng', 'Miền Bắc chuyển rét, anh em đã tự tin đón gió Đông với phao béo vừa ấm áp, vừa trẻ trung và nổi bật từ TORANO chưa? Thiết kế phóng khoáng với bề mặt chống nước cải tiến gấp 2 lần và chần bông 3 lớp giữ nhiệt sẽ khiến anh em không thể bỏ lỡ.', '2024-12-23 20:31:32', '2024-12-23 20:31:32'),
(39, 'Áo khoác 3 lớp lót bông mũ liền FWCP002', 'FWCP00251PE00SB_BL-S', 2, 890000.00, 890000.00, 0, 'Còn hàng', 'Miền Bắc chuyển rét, anh em đã tự tin đón gió Đông với phao 3 lớp vừa ấm áp, vừa trẻ trung và nổi bật từ TORANO chưa? Thiết kế phóng khoáng với bề mặt chống nước cải tiến gấp 2 lần và chần bông 3 lớp giữ nhiệt sẽ khiến anh em không thể bỏ lỡ.', '2024-12-23 20:32:43', '2024-12-23 20:32:43'),
(40, 'Áo khoác cardigan nỉ basic FWCS006', 'FWCS00691CV00RB_BL-S', 2, 590000.00, 590000.00, 0, 'Còn hàng', 'Áo khoác cardigan nỉ basic FWCS006\r\n▪️ Được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n▪️ Sản phẩm thuộc dòng Áo cardigan nỉ cao cấp do TORANO sản xuất', '2024-12-23 20:37:39', '2024-12-23 20:37:39'),
(41, 'Áo khoác Puffer cổ cao FWCF004', 'FWCF00431PE00RB_BL-L', 2, 699000.00, 990000.00, 29, 'Còn hàng', 'Miền Bắc chuyển rét, anh em đã tự tin đón gió Đông với phao béo vừa ấm áp, vừa trẻ trung và nổi bật từ TORANO chưa? Thiết kế phóng khoáng với bề mặt chống nước cải tiến gấp 2 lần và chần bông 3 lớp giữ nhiệt sẽ khiến anh em không thể bỏ lỡ.', '2024-12-23 20:45:31', '2024-12-23 20:45:31'),
(42, 'Áo khoác nỉ lót chần bông thêu logo Horse ngực FWCS002', 'FWCS00261CT00RB_LG-S', 2, 690000.00, 690000.00, 0, 'Còn hàng', 'Áo khoác nỉ lót chần bông thêu logo Horse ngực FWCS002\r\n▪️ Được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n▪️ Sản phẩm thuộc dòng Áo khoác nỉ cao cấp do TORANO sản xuất', '2024-12-23 20:47:12', '2024-12-23 20:47:12'),
(43, 'Áo khoác gió 1 lớp mũ liền EWCW007', 'EWCW00751PE00SB_LG-M', 2, 249000.00, 500000.00, 50, 'Còn hàng', 'Áo khoác gió TORANO công nghệ Smart-Tech, cản gió, chống thấm nước, mũ liền, có thể gấp gọn EWCW007\r\n▪️ Được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n▪️ Phiên bản sử dụng công nghệ chống nước HYPER-TEX mới nhất 2024', '2024-12-23 20:48:36', '2024-12-23 20:48:36'),
(44, 'Áo khoác gió 2 lớp mũ tháo rời EWCW001', 'EWCW00181PE00SB_LG-S', 2, 399000.00, 600000.00, 34, 'Còn hàng', 'Áo Khoác Gió Nam TORANO công nghệ cao cấp Heattech, chồng thấm, cản bụi, bản gió, giữ ấm EWCW001\r\n▪️ Được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n▪️ Phiên bản sử dụng công nghệ chống nước HYPER-TEX mới nhất 2024', '2024-12-23 20:49:52', '2024-12-23 20:49:52'),
(45, 'Áo khoác gió 1 lớp logo ngực EWCW010', 'EWCW01051PE00RB_LBE-S', 2, 399000.00, 600000.00, 34, 'Còn hàng', 'Áo khoác gió nam TORANO 1 lớp logo ngực chống thấm, cản bụi, cản gió, giữ ấm EWCW010\r\n▪️ Được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n▪️ Phiên bản sử dụng công nghệ chống nước HYPER-TEX mới nhất 2024', '2024-12-23 20:51:06', '2024-12-23 20:51:06'),
(46, 'Áo nỉ Hoodie trơn thêu logo ngực Dog FWTW017', 'FWTW01751TC13RB_BE-L', 1, 590000.00, 590000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ Hoodie trơn thêu logo ngực Dog FWTW017\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:05:23', '2024-12-23 21:05:23'),
(47, 'Áo nỉ Hoodie in tràn họa tiết TRN FWTW002', 'FWTW00251TC04RB_BL-L', 1, 650000.00, 650000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ Hoodie in tràn họa tiết TRN FWTW002\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:06:54', '2024-12-23 21:06:54'),
(48, 'Áo nỉ họa tiết in logo Glory FWTW012', 'FWTW01211CV06RB_DCB-S ', 1, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ họa tiết in logo Glory FWTW012\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:08:02', '2024-12-23 21:08:02'),
(49, 'Áo nỉ họa tiết thêu logo ngực Read and Grow FWTW008', 'FWTW00811CV13RB_BL-S', 1, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ họa tiết thêu logo ngực Read and Grow FWTW008\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:09:08', '2024-12-23 21:09:08'),
(50, 'Áo nỉ họa tiết thêu logo Voyage FWTW010', 'FWTW01011CV06RB_DNV-S', 1, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ họa tiết thêu logo Voyage FWTW010\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:10:59', '2024-12-23 21:10:59'),
(51, 'Áo nỉ can phối màu tay, in logo Horse ngực FWTW005', 'FWTW00511CV32RB_BBR-S', 1, 480000.00, 480000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ can phối màu tay, in logo Horse ngực FWTW005\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:12:10', '2024-12-23 21:12:10'),
(52, 'Áo nỉ bộ can phối tay FWTW001', 'FWTW00111TC32RB_GR-S', 1, 319000.00, 420000.00, 24, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo nỉ bộ can phối tay FWTW001\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:14:32', '2024-12-23 21:15:14'),
(53, 'Quần nỉ bộ can phối FWBS001', 'FWBS00101TC32RB_GR-S', 1, 349000.00, 500000.00, 30, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Quần nỉ bộ can phối FWBS001\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:16:42', '2024-12-23 21:16:42'),
(54, 'Áo len trơn cổ tròn thêu logo FWTE001', 'FWTE00111AC00SB_DMS-S', 9, 420000.00, 420000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo len trơn cổ tròn thêu logo FWTE001\r\nChất liệu: Nỉ\r\nPhom dáng: Regular', '2024-12-23 21:20:55', '2024-12-23 21:20:55'),
(55, 'Sơ mi dài tay trơn dệt hiệu ứng EATB017', 'EATB01701CT01SB_WH-38', 3, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo sơ mi TORANO dài tay trơn dệt hiệu ứng EATB017\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:36:09', '2024-12-23 21:36:09'),
(56, 'Áo sơ mi dài tay trơn Bamboo DATB614', 'DATB61471BA00SB_LLB-38', 3, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Áo sơ mi TORANO dài tay trơn dệt hiệu ứng EATB017\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:38:32', '2024-12-23 21:38:32'),
(57, 'Sơ mi dài tay trơn Bamboo hiệu ứng EATB050', 'EATB05071BA01SB_LG-38', 3, 450000.00, 450000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay trơn Bamboo hiệu ứng EATB050\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:46:41', '2024-12-23 21:46:41'),
(58, 'Sơ mi dài tay trơn FATB002', 'FATB00271PE00SB_DNV-38 ', 3, 329000.00, 450000.00, 27, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay trơn FATB002\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:51:06', '2024-12-23 21:51:06'),
(59, 'Sơ mi dài tay kẻ Oxford FATB035', 'FATB03571CA09XB_CBB-S', 3, 500000.00, 500000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay kẻ Oxford FATB035\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:52:57', '2024-12-23 21:52:57'),
(60, 'Sơ mi dài tay kẻ dọc FATB052', 'FATB05271CA09RB_LG-S ', 3, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay kẻ dọc FATB052\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:54:26', '2024-12-23 21:54:26'),
(61, 'Sơ mi dài tay kẻ dọc FATB050', 'FATB05071TC09RB_CRB-S', 3, 480000.00, 480000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay kẻ dọc FATB050\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 21:58:54', '2024-12-23 21:58:54'),
(62, 'Sơ mi dài tay kẻ dọc, 1 túi ngực FATB043', 'FATB04371CA09RB_BWH-S', 3, 550000.00, 550000.00, 0, 'Còn hàng', 'THÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Sơ mi dài tay kẻ dọc, 1 túi ngực FATB043\r\nChất liệu: Bamboo\r\nMàu sắc: Trắng\r\nPhom dáng: Slimfit hơi ôm', '2024-12-23 22:00:51', '2024-12-23 22:00:51'),
(63, 'Áo Polo len basic FSTP073', 'FSTP07372CA00SB_DNV-S', 4, 450000.00, 450000.00, 0, 'Còn hàng', 'Ưu tiên hàng đầu dành cho mùa thu này, chắc chắn là những chiếc áo Knit Polo như Polo len basic Torano FSTP073 với chất liệu dệt kim thoáng mát. Bên cạnh đó là thiết kế đơn giản cúc ẩn tinh tế, dễ dàng mix match được nhiều outfit phù hợp nhiều hoàn cảnh.', '2024-12-23 22:30:37', '2024-12-23 22:30:37'),
(64, 'Áo Polo trơn bo kẻ FSTP003', 'FSTP00372TC00SB_DGN-S', 4, 299000.00, 420000.00, 29, 'Còn hàng', 'Áo Polo trơn bo kẻ FSTP003 chính hãng Torano với chất vải cho độ dày dặn,co giãn tốt và quan trọng độ bền màu cao. Giặt ko đổ lông hay bay màu, thấm hút mồ hôi và thoải mái không gò bó khi vận động. Đây là mẫu áo polo nam chất lượng chính hãng mà giá tốt nhất tại Torano.', '2024-12-23 22:32:10', '2024-12-23 22:32:10'),
(65, 'Áo Polo can phối thân FSTP004', 'FSTP00472TC32SB_RGR-S', 4, 299000.00, 450000.00, 34, 'Còn hàng', 'Áo Polo nam can phối thân FSTP004 là mẫu áo nam chính hãng Torano được sản xuất dựa trên công nghệ hiện đại. Chất vải cho độ dày dặn, co giãn tốt và quan trọng độ bền màu cao. Giặt không đổ lông hay bay màu, thấm hút mồ hôi và thoải mái không gò bó khi vận động.', '2024-12-24 09:46:54', '2024-12-24 09:46:54'),
(66, 'Áo polo dệt kẻ ngang FSTP039', 'FSTP03972CT07SB_DNV-S ', 4, 450000.00, 450000.00, 0, 'Còn hàng', 'Áo polo dệt kẻ ngang FSTP039 chính hãng Torano với chất vải cho độ dày dặn,co giãn tốt và quan trọng độ bền màu cao. Giặt ko đổ lông hay bay màu, thấm hút mồ hôi và thoải mái không gò bó khi vận động. Đây là mẫu áo polo nam chất lượng chính hãng mà giá tốt nhất tại Torano.', '2024-12-24 09:48:03', '2024-12-24 09:48:13'),
(67, 'Áo polo dệt kẻ ngang FSTP023', 'FSTP02372CT07SB_NVC-S', 4, 450000.00, 450000.00, 0, 'Còn hàng', 'Áo polo dệt kẻ ngang FSTP023 chính hãng Torano với chất vải cho độ dày dặn,co giãn tốt và quan trọng độ bền màu cao. Giặt ko đổ lông hay bay màu, thấm hút mồ hôi và thoải mái không gò bó khi vận động. Đây là mẫu áo polo nam chất lượng chính hãng mà giá tốt nhất tại Torano.', '2024-12-24 10:00:34', '2024-12-24 10:07:35'),
(68, 'Áo polo họa tiết cánh tay TRN FSTP014', 'FSTP01472CT22SB_WH-S', 4, 420000.00, 420000.00, 0, 'Còn hàng', 'Áo polo họa tiết cánh tay TORANO FSTP014 với chất vải cho độ dày dặn,co giãn tốt và quan trọng độ bền màu cao. Giặt không đổ lông hay bay màu, thấm hút mồ hôi và thoải mái không gò bó khi vận động. Đây là mẫu áo polo nam chất lượng chính hãng mà giá tốt nhất tại Torano.', '2024-12-24 10:06:55', '2024-12-24 10:07:14');

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
(103, 1, 'Đen', '2024-12-23 17:59:12'),
(104, 2, 'Xanh Navy', '2024-12-23 17:59:27'),
(105, 2, 'Xám nhạt', '2024-12-23 17:59:27'),
(106, 2, 'Đen nhạt', '2024-12-23 17:59:27'),
(107, 2, 'Xám đậm', '2024-12-23 17:59:27'),
(108, 2, 'Đen', '2024-12-23 17:59:27'),
(109, 3, 'Xanh Navy', '2024-12-23 17:59:40'),
(110, 3, 'Xám nhạt', '2024-12-23 17:59:40'),
(111, 3, 'Đen nhạt', '2024-12-23 17:59:40'),
(112, 3, 'Xám đậm', '2024-12-23 17:59:40'),
(113, 3, 'Đen', '2024-12-23 17:59:40'),
(114, 4, 'Đen', '2024-12-23 17:59:52'),
(115, 4, 'Đen nhạt', '2024-12-23 17:59:52'),
(116, 4, 'Xanh navy', '2024-12-23 17:59:52'),
(117, 4, 'Xám', '2024-12-23 17:59:52'),
(118, 4, 'Xanh đá đậm', '2024-12-23 17:59:52'),
(119, 4, 'Xám đậm', '2024-12-23 17:59:52'),
(120, 13, 'Dark Navy', '2024-12-23 18:00:03'),
(121, 13, 'Đen', '2024-12-23 18:00:03'),
(122, 13, 'Đen nhạt', '2024-12-23 18:00:03'),
(123, 13, 'Xám', '2024-12-23 18:00:03'),
(124, 13, 'Be', '2024-12-23 18:00:03'),
(133, 14, 'Xám', '2024-12-23 18:04:14'),
(134, 14, 'Xanh rêu nhạt', '2024-12-23 18:04:14'),
(135, 14, 'Xanh đá đậm', '2024-12-23 18:04:14'),
(136, 14, 'Đen', '2024-12-23 18:04:14'),
(137, 15, 'Đen', '2024-12-23 18:06:51'),
(138, 15, 'Xám', '2024-12-23 18:06:51'),
(139, 16, 'Xám', '2024-12-23 18:08:42'),
(140, 17, 'Dark Navy', '2024-12-23 18:18:08'),
(141, 17, 'Xanh da trời đậm', '2024-12-23 18:18:08'),
(142, 17, 'Xanh da trời nhạt', '2024-12-23 18:18:08'),
(143, 18, 'Xám nhạt', '2024-12-23 18:28:01'),
(144, 18, 'Đen nhạt', '2024-12-23 18:28:01'),
(145, 18, 'DarkNavy', '2024-12-23 18:28:01'),
(146, 18, 'Xám đậm', '2024-12-23 18:28:01'),
(147, 18, 'Xanh da trời đậm', '2024-12-23 18:28:01'),
(148, 18, 'Xanh da trời', '2024-12-23 18:28:01'),
(149, 18, 'Đen', '2024-12-23 18:28:01'),
(150, 19, 'Xanh da trời đậm', '2024-12-23 18:31:41'),
(151, 19, 'Xanh da trời', '2024-12-23 18:31:41'),
(152, 20, 'Xanh da trời đậm', '2024-12-23 18:33:10'),
(153, 21, 'Đen', '2024-12-23 18:34:26'),
(155, 23, 'Xanh da trời đậm', '2024-12-23 18:37:35'),
(156, 22, 'Xanh da trời đậm', '2024-12-23 18:38:31'),
(157, 24, 'Đen', '2024-12-23 18:51:33'),
(158, 24, 'Dark Navy', '2024-12-23 18:51:33'),
(159, 24, 'Trắng kem đậm', '2024-12-23 18:51:33'),
(160, 25, 'Xanh da trời đậm', '2024-12-23 18:53:27'),
(161, 25, 'Đen', '2024-12-23 18:53:27'),
(162, 25, 'Dark Navy', '2024-12-23 18:53:27'),
(163, 25, 'Xám nhạt', '2024-12-23 18:53:27'),
(164, 25, 'Trắng kem đậm', '2024-12-23 18:53:27'),
(165, 26, 'Xanh navy', '2024-12-23 18:55:53'),
(166, 26, 'Xám nhạt', '2024-12-23 18:55:53'),
(167, 26, 'Đen', '2024-12-23 18:55:53'),
(168, 27, 'Đen', '2024-12-23 19:02:44'),
(169, 27, 'Xanh navy', '2024-12-23 19:02:44'),
(170, 27, 'Xanh cổ vịt', '2024-12-23 19:02:44'),
(171, 27, 'Be đậm', '2024-12-23 19:02:44'),
(172, 27, 'Trắng kem', '2024-12-23 19:02:44'),
(173, 27, 'Trắng', '2024-12-23 19:02:44'),
(174, 28, 'Be đậm', '2024-12-23 19:47:08'),
(175, 28, 'Phối Xám - Be', '2024-12-23 19:47:08'),
(176, 28, 'Xanh rêu nhạt', '2024-12-23 19:47:08'),
(177, 28, 'Xám', '2024-12-23 19:47:08'),
(178, 28, 'Xanh navy', '2024-12-23 19:47:08'),
(179, 28, 'Đen', '2024-12-23 19:47:08'),
(180, 29, 'Trắng kem đậm', '2024-12-23 19:48:23'),
(181, 30, 'Xanh đá đậm', '2024-12-23 19:57:15'),
(182, 30, 'Xám', '2024-12-23 19:57:15'),
(183, 30, 'Dark Navy', '2024-12-23 19:57:15'),
(184, 30, 'Đen', '2024-12-23 19:57:15'),
(185, 31, 'Dark Navy', '2024-12-23 20:03:17'),
(186, 31, 'Đen', '2024-12-23 20:03:17'),
(187, 31, 'Trắng kem', '2024-12-23 20:03:17'),
(188, 32, 'Trắng kem', '2024-12-23 20:09:37'),
(189, 32, 'Đen', '2024-12-23 20:09:37'),
(190, 33, 'Đen', '2024-12-23 20:11:24'),
(191, 33, 'Trắng', '2024-12-23 20:11:24'),
(192, 34, 'Xám', '2024-12-23 20:12:48'),
(193, 34, 'Trắng kem', '2024-12-23 20:12:48'),
(194, 34, 'Đen', '2024-12-23 20:12:48'),
(195, 35, 'Đen', '2024-12-23 20:14:39'),
(196, 35, 'Trắng kem', '2024-12-23 20:14:39'),
(197, 36, 'Xanh rêu', '2024-12-23 20:15:59'),
(198, 36, 'Be', '2024-12-23 20:15:59'),
(199, 36, 'Đen', '2024-12-23 20:15:59'),
(200, 36, 'Xanh navy', '2024-12-23 20:15:59'),
(201, 36, 'Xám nhạt', '2024-12-23 20:15:59'),
(202, 36, 'Trắng kem', '2024-12-23 20:15:59'),
(203, 36, 'Trắng', '2024-12-23 20:15:59'),
(204, 37, 'Xanh rêu nhạt', '2024-12-23 20:17:34'),
(205, 37, 'Đen', '2024-12-23 20:17:34'),
(206, 37, 'Dark Navy', '2024-12-23 20:17:34'),
(207, 37, 'Xám', '2024-12-23 20:17:34'),
(208, 37, 'Be', '2024-12-23 20:17:34'),
(209, 37, 'Trắng kem', '2024-12-23 20:17:34'),
(210, 38, 'Dark Navy', '2024-12-23 20:31:32'),
(211, 38, 'Xanh rêu', '2024-12-23 20:31:32'),
(212, 38, 'Đen', '2024-12-23 20:31:32'),
(213, 38, 'Be', '2024-12-23 20:31:32'),
(214, 39, 'Đen', '2024-12-23 20:32:43'),
(215, 40, 'Đen', '2024-12-23 20:37:39'),
(216, 40, 'Nâu nhạt', '2024-12-23 20:37:39'),
(217, 41, 'Đen', '2024-12-23 20:45:31'),
(218, 41, 'Xám', '2024-12-23 20:45:31'),
(219, 41, 'Be nhạt', '2024-12-23 20:45:31'),
(220, 41, 'Xanh navy', '2024-12-23 20:45:31'),
(221, 41, 'Be', '2024-12-23 20:45:31'),
(222, 42, 'Xám nhạt', '2024-12-23 20:47:12'),
(223, 43, 'Xám nhạt', '2024-12-23 20:48:36'),
(224, 43, 'Xanh đá đậm', '2024-12-23 20:48:36'),
(225, 43, 'Xanh navy', '2024-12-23 20:48:36'),
(226, 43, 'Dark Navy', '2024-12-23 20:48:36'),
(227, 43, 'Đen', '2024-12-23 20:48:36'),
(228, 44, 'Xám nhạt', '2024-12-23 20:49:52'),
(229, 44, 'Xanh rêu đậm', '2024-12-23 20:49:52'),
(230, 44, 'Be', '2024-12-23 20:49:52'),
(231, 44, 'Dark Navy', '2024-12-23 20:49:52'),
(232, 44, 'Đen', '2024-12-23 20:49:52'),
(233, 44, 'Xanh đá đậm', '2024-12-23 20:49:52'),
(234, 44, 'Xám đậm', '2024-12-23 20:49:52'),
(235, 45, 'Be nhạt', '2024-12-23 20:51:06'),
(236, 45, 'Đen', '2024-12-23 20:51:06'),
(237, 46, 'Be', '2024-12-23 21:05:23'),
(238, 47, 'Đen', '2024-12-23 21:06:54'),
(239, 48, 'Xanh đá đậm', '2024-12-23 21:08:02'),
(240, 49, 'Đen', '2024-12-23 21:09:08'),
(241, 50, 'Dark Navy', '2024-12-23 21:10:59'),
(242, 51, 'Phối Đen - Nâu', '2024-12-23 21:12:10'),
(249, 52, 'Xám', '2024-12-23 21:15:14'),
(250, 52, 'Dark Navy', '2024-12-23 21:15:14'),
(251, 52, 'Trắng kem đậm', '2024-12-23 21:15:14'),
(252, 52, 'Đen', '2024-12-23 21:15:14'),
(253, 52, 'Nâu nhạt', '2024-12-23 21:15:14'),
(254, 52, 'Xám đậm', '2024-12-23 21:15:14'),
(255, 53, 'Xám', '2024-12-23 21:16:42'),
(256, 53, 'Dark Navy', '2024-12-23 21:16:42'),
(257, 53, 'Trắng kem đậm', '2024-12-23 21:16:42'),
(258, 53, 'Đen', '2024-12-23 21:16:42'),
(259, 53, 'Nâu nhạt', '2024-12-23 21:16:42'),
(260, 53, 'Xám đậm', '2024-12-23 21:16:42'),
(261, 54, 'Xanh rêu đậm', '2024-12-23 21:20:55'),
(262, 54, 'Be', '2024-12-23 21:20:55'),
(263, 54, 'Dark Navy', '2024-12-23 21:20:55'),
(264, 54, 'Trắng', '2024-12-23 21:20:55'),
(265, 54, 'Đen', '2024-12-23 21:20:55'),
(266, 55, 'Trắng', '2024-12-23 21:36:09'),
(267, 56, 'Xanh da trời phai', '2024-12-23 21:38:32'),
(268, 56, 'Trắng', '2024-12-23 21:38:32'),
(269, 56, 'Xanh navy', '2024-12-23 21:38:32'),
(270, 56, 'Đen', '2024-12-23 21:38:32'),
(271, 57, 'Xám nhạt', '2024-12-23 21:46:41'),
(272, 57, 'Xanh da trời nhạt', '2024-12-23 21:46:41'),
(273, 57, 'Xanh ngọc', '2024-12-23 21:46:41'),
(274, 57, 'Xanh navy', '2024-12-23 21:46:41'),
(275, 57, 'Hồng', '2024-12-23 21:46:41'),
(276, 57, 'Trắng kem', '2024-12-23 21:46:41'),
(277, 57, 'Trắng', '2024-12-23 21:46:41'),
(278, 58, 'Dark Navy', '2024-12-23 21:51:06'),
(279, 58, 'Xanh da trời nhạt', '2024-12-23 21:51:06'),
(280, 58, 'Xanh đá nhạt', '2024-12-23 21:51:06'),
(281, 58, 'Trắng kem', '2024-12-23 21:51:06'),
(282, 58, 'Trắng', '2024-12-23 21:51:06'),
(283, 59, 'Xanh đá', '2024-12-23 21:52:57'),
(284, 60, 'Xám nhạt', '2024-12-23 21:54:26'),
(285, 61, 'Phối đen - trắng kem', '2024-12-23 21:58:54'),
(286, 62, 'Phối đen - trắng', '2024-12-23 22:00:51'),
(287, 62, 'Phối Xanh lá cây - Trắng', '2024-12-23 22:00:51'),
(288, 63, 'Dark Navy', '2024-12-23 22:30:37'),
(289, 63, 'Trắng', '2024-12-23 22:30:37'),
(290, 64, 'Xanh lá cây đậm', '2024-12-23 22:32:10'),
(291, 64, 'Đen', '2024-12-23 22:32:10'),
(292, 64, 'Dark Navy', '2024-12-23 22:32:10'),
(293, 64, 'Xám', '2024-12-23 22:32:10'),
(294, 64, 'Xám nhạt', '2024-12-23 22:32:10'),
(295, 64, 'Xám đậm', '2024-12-23 22:32:10'),
(296, 64, 'Trắng kem', '2024-12-23 22:32:10'),
(297, 64, 'Trắng', '2024-12-23 22:32:10'),
(298, 65, 'Phối kem - xám', '2024-12-24 09:46:54'),
(299, 65, 'Phối xám - đen', '2024-12-24 09:46:54'),
(300, 65, 'Phối kem - navy', '2024-12-24 09:46:54'),
(303, 66, 'Dark Navy', '2024-12-24 09:54:51'),
(304, 66, 'Trắng', '2024-12-24 09:54:51'),
(308, 68, 'Trắng', '2024-12-24 10:07:14'),
(309, 67, 'Phối kem - navy', '2024-12-24 10:07:35'),
(310, 67, 'Phối Trắng - Đen', '2024-12-24 10:07:35');

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
(1, 1, '../../image/ac-au1.webp', 0, '2024-12-22 18:08:26'),
(2, 2, '../../image/ac-au2.jpg', 0, '2024-12-22 18:19:34'),
(3, 3, '../../image/ac-au3.webp', 0, '2024-12-22 23:18:58'),
(4, 4, '../../image/ac-au4.webp', 0, '2024-12-22 23:20:33'),
(10, 13, '../../image/ac-au5.jpg', 0, '2024-12-23 14:51:51'),
(11, 14, '../../image/ac-au6.webp', 0, '2024-12-23 17:56:02'),
(12, 15, '../../image/ac-au7.jpg', 0, '2024-12-23 18:06:51'),
(13, 16, '../../image/ac-au8.webp', 0, '2024-12-23 18:08:42'),
(14, 17, '../../image/ac-j1.jpg', 0, '2024-12-23 18:18:08'),
(15, 18, '../../image/ac-j2.jpg', 0, '2024-12-23 18:28:01'),
(16, 19, '../../image/ac-j3.jpg', 0, '2024-12-23 18:31:41'),
(17, 20, '../../image/ac-j4.webp', 0, '2024-12-23 18:33:10'),
(18, 21, '../../image/ac-j5.webp', 0, '2024-12-23 18:34:26'),
(19, 22, '../../image/ac-j6.webp', 0, '2024-12-23 18:35:54'),
(20, 23, '../../image/ac-j7.webp', 0, '2024-12-23 18:37:35'),
(21, 24, '../../image/ac-kaki1.webp', 0, '2024-12-23 18:51:33'),
(22, 25, '../../image/ac-kaki2.webp', 0, '2024-12-23 18:53:27'),
(23, 26, '../../image/ac-kaki3.png', 0, '2024-12-23 18:55:53'),
(24, 27, '../../image/ac-kaki4.webp', 0, '2024-12-23 19:02:44'),
(25, 28, '../../image/ac-kaki5.webp', 0, '2024-12-23 19:47:08'),
(26, 29, '../../image/ac-kaki6.webp', 0, '2024-12-23 19:48:23'),
(27, 30, '../../image/ac-short1.webp', 0, '2024-12-23 19:57:15'),
(28, 31, '../../image/ac-short2.webp', 0, '2024-12-23 20:03:17'),
(29, 32, '../../image/ac-short3.webp', 0, '2024-12-23 20:09:37'),
(30, 33, '../../image/ac-short4.webp', 0, '2024-12-23 20:11:24'),
(31, 34, '../../image/ac-short5.jpg', 0, '2024-12-23 20:12:48'),
(32, 35, '../../image/ac-short6.webp', 0, '2024-12-23 20:14:39'),
(33, 36, '../../image/ac-short7.jpg', 0, '2024-12-23 20:15:59'),
(34, 37, '../../image/ac-short8.webp', 0, '2024-12-23 20:17:34'),
(35, 38, '../../image/ac-khoac1.webp', 0, '2024-12-23 20:31:32'),
(36, 39, '../../image/ac-khoac2.webp', 0, '2024-12-23 20:32:43'),
(37, 40, '../../image/ac-khoac3.webp', 0, '2024-12-23 20:37:39'),
(38, 41, '../../image/ac-khoac4.webp', 0, '2024-12-23 20:45:31'),
(39, 42, '../../image/ac-khoac5.webp', 0, '2024-12-23 20:47:12'),
(40, 43, '../../image/ac-khoac6.webp', 0, '2024-12-23 20:48:36'),
(41, 44, '../../image/ac-khoac7.webp', 0, '2024-12-23 20:49:52'),
(42, 45, '../../image/ac-khoac8.webp', 0, '2024-12-23 20:51:06'),
(43, 46, '../../image/ac-ni1.webp', 0, '2024-12-23 21:05:23'),
(44, 47, '../../image/ac-ni2.webp', 0, '2024-12-23 21:06:54'),
(45, 48, '../../image/ac-ni3.webp', 0, '2024-12-23 21:08:02'),
(46, 49, '../../image/ac-ni4.webp', 0, '2024-12-23 21:09:08'),
(47, 50, '../../image/ac-ni5.webp', 0, '2024-12-23 21:10:59'),
(48, 51, '../../image/ac-ni6.webp', 0, '2024-12-23 21:12:10'),
(49, 52, '../../image/ac-ni7.jpg', 0, '2024-12-23 21:14:32'),
(50, 53, '../../image/ac-ni8.jpg', 0, '2024-12-23 21:16:42'),
(51, 54, '../../image/ac-len1.webp', 0, '2024-12-23 21:20:55'),
(52, 55, '../../image/ac-somi1.webp', 0, '2024-12-23 21:36:09'),
(53, 56, '../../image/ac-somi2.webp', 0, '2024-12-23 21:38:32'),
(54, 57, '../../image/ac-somi3.webp', 0, '2024-12-23 21:46:41'),
(55, 58, '../../image/ac-somi4.webp', 0, '2024-12-23 21:51:06'),
(56, 59, '../../image/ac-somi5.webp', 0, '2024-12-23 21:52:57'),
(57, 60, '../../image/ac-somi6.jpg', 0, '2024-12-23 21:54:26'),
(58, 61, '../../image/ac-somi7.webp', 0, '2024-12-23 21:58:54'),
(59, 62, '../../image/ac-somi8.webp', 0, '2024-12-23 22:00:51'),
(60, 63, '../../image/ac-polo1.webp', 0, '2024-12-23 22:30:37'),
(61, 64, '../../image/ac-polo2.jpg', 0, '2024-12-23 22:32:10'),
(62, 65, '../../image/ac-polo3.jpg', 0, '2024-12-24 09:46:54'),
(63, 66, '../../image/ac-polo4.webp', 0, '2024-12-24 09:48:03'),
(64, 67, '../../image/ac-polo5.webp', 0, '2024-12-24 10:00:34'),
(65, 68, '../../image/ac-polo6.webp', 0, '2024-12-24 10:06:55');

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
(118, 1, '29', '2024-12-23 17:59:12'),
(119, 1, '30', '2024-12-23 17:59:12'),
(120, 1, '31', '2024-12-23 17:59:12'),
(121, 1, '32', '2024-12-23 17:59:12'),
(122, 1, '33', '2024-12-23 17:59:12'),
(123, 2, '29', '2024-12-23 17:59:27'),
(124, 2, '30', '2024-12-23 17:59:27'),
(125, 2, '31', '2024-12-23 17:59:27'),
(126, 2, '32', '2024-12-23 17:59:27'),
(127, 2, '33', '2024-12-23 17:59:27'),
(128, 3, '29', '2024-12-23 17:59:40'),
(129, 3, '30', '2024-12-23 17:59:40'),
(130, 3, '31', '2024-12-23 17:59:40'),
(131, 3, '32', '2024-12-23 17:59:40'),
(132, 3, '33', '2024-12-23 17:59:40'),
(133, 4, '29', '2024-12-23 17:59:52'),
(134, 4, '30', '2024-12-23 17:59:52'),
(135, 4, '31', '2024-12-23 17:59:52'),
(136, 4, '32', '2024-12-23 17:59:52'),
(137, 4, '33', '2024-12-23 17:59:52'),
(138, 13, '29', '2024-12-23 18:00:03'),
(139, 13, '30', '2024-12-23 18:00:03'),
(140, 13, '31', '2024-12-23 18:00:03'),
(141, 13, '32', '2024-12-23 18:00:03'),
(142, 13, '33', '2024-12-23 18:00:03'),
(153, 14, '29', '2024-12-23 18:04:14'),
(154, 14, '30', '2024-12-23 18:04:14'),
(155, 14, '31', '2024-12-23 18:04:14'),
(156, 14, '32', '2024-12-23 18:04:14'),
(157, 14, '33', '2024-12-23 18:04:14'),
(158, 15, '29', '2024-12-23 18:06:51'),
(159, 15, '30', '2024-12-23 18:06:51'),
(160, 15, '31', '2024-12-23 18:06:51'),
(161, 15, '32', '2024-12-23 18:06:51'),
(162, 15, '33', '2024-12-23 18:06:51'),
(163, 16, '29', '2024-12-23 18:08:42'),
(164, 16, '30', '2024-12-23 18:08:42'),
(165, 16, '31', '2024-12-23 18:08:42'),
(166, 16, '32', '2024-12-23 18:08:42'),
(167, 16, '33', '2024-12-23 18:08:42'),
(168, 17, '29', '2024-12-23 18:18:08'),
(169, 17, '30', '2024-12-23 18:18:08'),
(170, 17, '31', '2024-12-23 18:18:08'),
(171, 17, '32', '2024-12-23 18:18:08'),
(172, 17, '33', '2024-12-23 18:18:08'),
(173, 18, '29', '2024-12-23 18:28:01'),
(174, 18, '30', '2024-12-23 18:28:01'),
(175, 18, '31', '2024-12-23 18:28:01'),
(176, 18, '32', '2024-12-23 18:28:01'),
(177, 18, '33', '2024-12-23 18:28:01'),
(178, 19, '29', '2024-12-23 18:31:41'),
(179, 19, '30', '2024-12-23 18:31:41'),
(180, 19, '31', '2024-12-23 18:31:41'),
(181, 19, '32', '2024-12-23 18:31:41'),
(182, 19, '33', '2024-12-23 18:31:41'),
(183, 20, '29', '2024-12-23 18:33:10'),
(184, 20, '30', '2024-12-23 18:33:10'),
(185, 20, '31', '2024-12-23 18:33:10'),
(186, 20, '32', '2024-12-23 18:33:10'),
(187, 20, '33', '2024-12-23 18:33:10'),
(188, 21, '29', '2024-12-23 18:34:26'),
(189, 21, '30', '2024-12-23 18:34:26'),
(190, 21, '31', '2024-12-23 18:34:26'),
(191, 21, '32', '2024-12-23 18:34:26'),
(192, 21, '33', '2024-12-23 18:34:26'),
(198, 23, '29', '2024-12-23 18:37:36'),
(199, 23, '30', '2024-12-23 18:37:36'),
(200, 23, '31', '2024-12-23 18:37:36'),
(201, 23, '32', '2024-12-23 18:37:36'),
(202, 23, '33', '2024-12-23 18:37:36'),
(203, 22, '29', '2024-12-23 18:38:31'),
(204, 22, '30', '2024-12-23 18:38:31'),
(205, 22, '31', '2024-12-23 18:38:31'),
(206, 22, '32', '2024-12-23 18:38:31'),
(207, 22, '33', '2024-12-23 18:38:31'),
(208, 24, '29', '2024-12-23 18:51:33'),
(209, 24, '30', '2024-12-23 18:51:33'),
(210, 24, '31', '2024-12-23 18:51:33'),
(211, 24, '32', '2024-12-23 18:51:33'),
(212, 24, '33', '2024-12-23 18:51:33'),
(213, 25, '29', '2024-12-23 18:53:27'),
(214, 25, '30', '2024-12-23 18:53:27'),
(215, 25, '31', '2024-12-23 18:53:27'),
(216, 25, '32', '2024-12-23 18:53:27'),
(217, 25, '33', '2024-12-23 18:53:27'),
(218, 26, '29', '2024-12-23 18:55:53'),
(219, 26, '30', '2024-12-23 18:55:53'),
(220, 26, '31', '2024-12-23 18:55:53'),
(221, 26, '32', '2024-12-23 18:55:53'),
(222, 26, '33', '2024-12-23 18:55:53'),
(223, 27, '29', '2024-12-23 19:02:44'),
(224, 27, '30', '2024-12-23 19:02:44'),
(225, 27, '31', '2024-12-23 19:02:44'),
(226, 27, '32', '2024-12-23 19:02:44'),
(227, 27, '33', '2024-12-23 19:02:44'),
(228, 28, '29', '2024-12-23 19:47:08'),
(229, 28, '30', '2024-12-23 19:47:08'),
(230, 28, '31', '2024-12-23 19:47:08'),
(231, 28, '32', '2024-12-23 19:47:08'),
(232, 28, '33', '2024-12-23 19:47:08'),
(233, 29, '29', '2024-12-23 19:48:23'),
(234, 29, '30', '2024-12-23 19:48:23'),
(235, 29, '31', '2024-12-23 19:48:23'),
(236, 29, '32', '2024-12-23 19:48:23'),
(237, 29, '33', '2024-12-23 19:48:23'),
(238, 30, 'S', '2024-12-23 19:57:15'),
(239, 30, 'M', '2024-12-23 19:57:15'),
(240, 30, 'L', '2024-12-23 19:57:15'),
(241, 31, 'S', '2024-12-23 20:03:17'),
(242, 31, 'M', '2024-12-23 20:03:17'),
(243, 31, 'L', '2024-12-23 20:03:17'),
(244, 32, 'S', '2024-12-23 20:09:37'),
(245, 32, 'M', '2024-12-23 20:09:37'),
(246, 32, 'L', '2024-12-23 20:09:37'),
(247, 33, 'S', '2024-12-23 20:11:24'),
(248, 33, 'M', '2024-12-23 20:11:24'),
(249, 33, 'L', '2024-12-23 20:11:24'),
(250, 34, 'S', '2024-12-23 20:12:48'),
(251, 34, 'M', '2024-12-23 20:12:48'),
(252, 34, 'L', '2024-12-23 20:12:48'),
(253, 35, 'S', '2024-12-23 20:14:39'),
(254, 35, 'M', '2024-12-23 20:14:39'),
(255, 35, 'L', '2024-12-23 20:14:39'),
(256, 36, 'S', '2024-12-23 20:15:59'),
(257, 36, 'M', '2024-12-23 20:15:59'),
(258, 36, 'L', '2024-12-23 20:15:59'),
(259, 37, '29', '2024-12-23 20:17:34'),
(260, 37, '30', '2024-12-23 20:17:34'),
(261, 37, '31', '2024-12-23 20:17:34'),
(262, 37, '32', '2024-12-23 20:17:34'),
(263, 37, '33', '2024-12-23 20:17:34'),
(264, 38, 'S', '2024-12-23 20:31:32'),
(265, 38, 'M', '2024-12-23 20:31:32'),
(266, 38, 'L', '2024-12-23 20:31:32'),
(267, 39, 'S', '2024-12-23 20:32:43'),
(268, 39, 'M', '2024-12-23 20:32:43'),
(269, 39, 'L', '2024-12-23 20:32:43'),
(270, 40, 'S', '2024-12-23 20:37:39'),
(271, 40, 'M', '2024-12-23 20:37:39'),
(272, 40, 'L', '2024-12-23 20:37:39'),
(273, 41, 'S', '2024-12-23 20:45:31'),
(274, 41, 'M', '2024-12-23 20:45:31'),
(275, 41, 'L', '2024-12-23 20:45:31'),
(276, 42, 'S', '2024-12-23 20:47:12'),
(277, 42, 'M', '2024-12-23 20:47:12'),
(278, 42, 'L', '2024-12-23 20:47:12'),
(279, 43, 'S', '2024-12-23 20:48:36'),
(280, 43, 'M', '2024-12-23 20:48:36'),
(281, 43, 'L', '2024-12-23 20:48:36'),
(282, 44, 'S', '2024-12-23 20:49:52'),
(283, 44, 'M', '2024-12-23 20:49:52'),
(284, 44, 'L', '2024-12-23 20:49:52'),
(285, 45, 'S', '2024-12-23 20:51:06'),
(286, 45, 'M', '2024-12-23 20:51:06'),
(287, 45, 'L', '2024-12-23 20:51:06'),
(288, 46, 'S', '2024-12-23 21:05:23'),
(289, 46, 'M', '2024-12-23 21:05:23'),
(290, 46, 'L', '2024-12-23 21:05:23'),
(291, 47, 'S', '2024-12-23 21:06:54'),
(292, 47, 'M', '2024-12-23 21:06:54'),
(293, 47, 'L', '2024-12-23 21:06:54'),
(294, 48, 'S', '2024-12-23 21:08:02'),
(295, 48, 'M', '2024-12-23 21:08:02'),
(296, 48, 'L', '2024-12-23 21:08:02'),
(297, 49, 'S', '2024-12-23 21:09:08'),
(298, 49, 'M', '2024-12-23 21:09:08'),
(299, 49, 'L', '2024-12-23 21:09:08'),
(300, 50, 'S', '2024-12-23 21:10:59'),
(301, 50, 'M', '2024-12-23 21:10:59'),
(302, 50, 'L', '2024-12-23 21:10:59'),
(303, 51, 'S', '2024-12-23 21:12:10'),
(304, 51, 'M', '2024-12-23 21:12:10'),
(305, 51, 'L', '2024-12-23 21:12:10'),
(309, 52, 'S', '2024-12-23 21:15:14'),
(310, 52, 'M', '2024-12-23 21:15:14'),
(311, 52, 'L', '2024-12-23 21:15:14'),
(312, 53, 'S', '2024-12-23 21:16:42'),
(313, 53, 'M', '2024-12-23 21:16:42'),
(314, 53, 'L', '2024-12-23 21:16:42'),
(315, 54, 'S', '2024-12-23 21:20:55'),
(316, 54, 'M', '2024-12-23 21:20:55'),
(317, 54, 'L', '2024-12-23 21:20:55'),
(318, 55, 'S', '2024-12-23 21:36:09'),
(319, 55, 'M', '2024-12-23 21:36:09'),
(320, 55, 'L', '2024-12-23 21:36:09'),
(321, 56, 'S', '2024-12-23 21:38:32'),
(322, 56, 'M', '2024-12-23 21:38:32'),
(323, 56, 'L', '2024-12-23 21:38:32'),
(324, 57, 'S', '2024-12-23 21:46:41'),
(325, 57, 'M', '2024-12-23 21:46:41'),
(326, 57, 'L', '2024-12-23 21:46:41'),
(327, 58, 'S', '2024-12-23 21:51:06'),
(328, 58, 'M', '2024-12-23 21:51:06'),
(329, 58, 'L', '2024-12-23 21:51:06'),
(330, 59, 'S', '2024-12-23 21:52:57'),
(331, 59, 'M', '2024-12-23 21:52:57'),
(332, 59, 'L', '2024-12-23 21:52:57'),
(333, 60, 'S', '2024-12-23 21:54:26'),
(334, 60, 'M', '2024-12-23 21:54:26'),
(335, 60, 'L', '2024-12-23 21:54:26'),
(336, 61, 'S', '2024-12-23 21:58:54'),
(337, 61, 'M', '2024-12-23 21:58:54'),
(338, 61, 'L', '2024-12-23 21:58:54'),
(339, 62, 'S', '2024-12-23 22:00:51'),
(340, 62, 'M', '2024-12-23 22:00:51'),
(341, 62, 'L', '2024-12-23 22:00:51'),
(342, 63, 'S', '2024-12-23 22:30:37'),
(343, 63, 'M', '2024-12-23 22:30:37'),
(344, 63, 'L', '2024-12-23 22:30:37'),
(345, 64, 'S', '2024-12-23 22:32:10'),
(346, 64, 'M', '2024-12-23 22:32:10'),
(347, 64, 'L', '2024-12-23 22:32:10'),
(348, 65, 'S', '2024-12-24 09:46:54'),
(349, 65, 'M', '2024-12-24 09:46:54'),
(350, 65, 'L', '2024-12-24 09:46:54'),
(354, 66, 'S', '2024-12-24 09:54:51'),
(355, 66, 'M', '2024-12-24 09:54:51'),
(356, 66, 'L', '2024-12-24 09:54:51'),
(363, 68, 'S', '2024-12-24 10:07:14'),
(364, 68, 'M', '2024-12-24 10:07:14'),
(365, 68, 'L', '2024-12-24 10:07:14'),
(366, 67, 'S', '2024-12-24 10:07:35'),
(367, 67, 'M', '2024-12-24 10:07:35'),
(368, 67, 'L', '2024-12-24 10:07:35');

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
  `role` varchar(50) DEFAULT 'customer',
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone`, `password`, `role`, `forgotToken`, `activeToken`, `status`, `create_at`, `update_at`) VALUES
(1, 'Nguyễn Thái Dương', 'duongvq@gmail.com', '0967083126', 'duongvq3124!', 'customer', NULL, NULL, 0, '2024-12-24 21:19:52', '2024-12-24 21:19:52'),
(2, 'Nguyễn Thái Dương', 'duongvq392@gmail', '0967083126', 'duongvq3124!', 'admin', NULL, 'active', 1, '2024-12-24 21:30:56', '2024-12-24 21:38:03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
