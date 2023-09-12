-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 05:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queue_up_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` varchar(40) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_description` varchar(100) DEFAULT NULL,
  `create_at` varchar(30) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `create_at`) VALUES
('1', 'กระเป๋า', NULL, '2023-02-19 13:41:50'),
('2', 'เสื้อผ้า', NULL, '2023-02-19 13:41:50'),
('3', 'อาหาร', '-', '2023-02-19 13:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` varchar(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `entrepreneur_id` varchar(10) NOT NULL,
  `text` text DEFAULT NULL,
  `chat_image` text DEFAULT NULL,
  `sender` varchar(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `new` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `customer_id`, `entrepreneur_id`, `text`, `chat_image`, `sender`, `date`, `time`, `new`) VALUES
('CHAT0001', 'CA0023', 'EN0001', 'HI', NULL, 'CA0023', '2023-03-26', '14:36:45', 1),
('CHAT0004', 'CA0024', 'EN0001', 'สวัสดีครับ', NULL, 'CA0024', '2023-04-01', '13:49:05', 1),
('CHAT0005', 'CA0024', 'EN0001', 'สวัสดีครับ ต้องการสอบถามเรื่องอะไรครับ', NULL, 'EN0001', '2023-04-01', '13:50:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password_customer` varchar(200) CHARACTER SET utf8 NOT NULL,
  `name_customer` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address_customer` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email_customer` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone_customer` varchar(20) CHARACTER SET utf8 NOT NULL,
  `img_customer` varchar(200) CHARACTER SET utf8 NOT NULL,
  `status_customer` int(1) DEFAULT NULL,
  `date_create_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `username_customer`, `password_customer`, `name_customer`, `address_customer`, `email_customer`, `phone_customer`, `img_customer`, `status_customer`, `date_create_customer`) VALUES
('CA0002', 'bettyb', '$2y$10$wzz5.QSqiNfrc2JKuYK5huJHEvry340XZlspPACOJLf0TmU3yu30.', 'Betty B. McMillan\n', '62 Limer Street', 'bettymcm@mail.com', '7014445450', 'assets/frontend/img/default.png', 1, '1552202266'),
('CA0001', 'oscarharrison', '$2y$10$PO4viVqheGgw7HPeozUih.V6qK4aWKbACLMe9UWOoSaJ8pSdaiISG', 'Oscar A. Harrison', '59 Pine Tree Lane', 'oscar.harrison69@mail.com', '0455658500', 'assets/frontend/img/default.png', 1, '1552199781'),
('CA0003', 'ruffner', '$2y$10$N6imN8KmAhuw9rH.iJxGLeVaRCG.27UmhHVF7MaICMhYlm.TGJ9iy', 'Pearl R. Ruffner', '93 Steele Street', 'ruffp@mail.com', '9458001455', 'assets/frontend/img/default.png', 1, '1552397128'),
('CA0005', 'ellington', '$2y$10$PYDzqnOpzeGSo0ngK40Q1.M77oxnQ7fvhMYpI2q/JoZFS5r.g5FPG', 'Robert N. Ellington', '31 Andell Road', 'robelli@mail.com', '0147410147', 'assets/frontend/img/default.png', 1, '1554340197'),
('CA0004', 'danielw', '$2y$10$hHamfvIRbCNYiAvS289f0uj.T6kUfpfxTUcI210SLRqdTrxj4zyxG', 'Daniel Winkles', '52 Coplin Avenue', 'danielw@mail.com', '021212545', 'assets/frontend/img/default.png', 1, '1554017732'),
('CA0006', 'tiffewis', '$2y$10$pwr/ZSCVcya8JOV1Xt13qeRzhz.nLsJGWYcWWZJgR5DFLUfjJeaGO', 'Tiffany G. Lewis', '72 Raintree Boulevard', 'tiffewis101@mail.com', '0978542255', 'assets/frontend/img/default.png', 1, '1554385261'),
('CA0007', 'emestcoy', '$2y$10$Z7yJqwWa0pCPtGb5sVYf9epvdjT97BD9U4guma.EhKU3JS9H675lG', 'Ernest E. McCoy', '42 Sunburst Drive', 'ernest@mail.com', '0898765345', 'assets/frontend/img/default.png', 1, '1554534514'),
('CA0008', 'demoaccount', '$2y$10$N1GVdIFWQ967xcLsVEb1ROH1ESfMew4mqjHoGSGIJ/0Qsf9oO/xOO', 'Demo Account', 'Demo Address', 'demo@mail.com', '7000000020', 'assets/frontend/img/default.png', 1, '1634359787'),
('CA0009', 'johnwatson', '$2y$10$2HJ6mUfIPHpJ87BKQEv7YuMjT8nX9W8CJFqG5jAnekEJhJMv2MFGy', 'John Watson', '1145 Bleck St', 'john@mail.com', '7778885540', 'assets/frontend/img/default.png', 1, '1642506186'),
('CA0010', 'christine', '$2y$10$Al3FDFQOSTQEQBvnQc45fe8NHRQ5OtGkgF6LnYplEzJqMEfy2Au0q', 'Christine Moore', '114 Test Address', 'christine@mail.com', '7774445454', 'assets/frontend/img/default.png', 1, '1672227893'),
('CA0011', 'ellen', '$2y$10$I5m6NM5hPzyeAS5cT6CBtuD5Xc5xSJytC6GOu.51LsLidi/7UPZz.', 'Ellen', '554 Southern Cross St', 'ellen@mail.com', '7774545555', 'assets/frontend/img/default.png', 1, '1672229233'),
('CA0012', 'andie', '$2y$10$sFXYN8pGoGA24LwQrHuBW.uQuOWuVzcNu0yRbqaBgEDJq0OZRThCq', 'Andie Sand', '114 Allace Avenue', 'andie@mail.com', '7458885454', 'assets/frontend/img/default.png', 1, '1672235116'),
('CA0013', 'robert', '$2y$10$C5Faofquq/6Sckw0ERuLK.6qXSAFQpU1QMDuAU/UWglUN4X6mJYSi', 'Robert C. Frazier', '11 Haymond Rocks Road', 'robert@mail.com', '7778545699', 'assets/frontend/img/default.png', 1, '1672247531'),
('CA0014', 'delbert', '$2y$10$H/24vkHCSs2vLXxiwwUEq.7sUYSeT61wU18PSAbfIHz63HisAFD6K', 'Delbert Rochelle', '81 Single Street', 'delbert@mail.com', '7850001414', 'assets/frontend/img/default.png', 1, '1672333316'),
('CA0015', 'ruthrusso', '$2y$10$WDBh38OmnT.3v2.7sQ/8C./0mGMUIRLsXTzZlJeWGgWBTEQPq6Gou', 'Ruth Russo', '17 Olive Street', 'ruth@mail.com', '7854545454', 'assets/frontend/img/default.png', 1, '1672336612'),
('CA0016', 'montoya', '$2y$10$IRBkQQZ4Kw5iKu7bsOwkA.5D3xj9mbCKA0Lvo3myKwmJvKrhZHsIS', 'Carl J. Montoya', '70 Cerullo Road', 'carl@mail.com', '7350001455', 'assets/frontend/img/default.png', 1, '1672388181'),
('CA0017', 'diana', '$2y$10$R5EOyPHwynjwPkzZEwUKjO/YwAdhsaGVIvUEyvgTygTd19G3qHhkC', 'Diana Kirk', '105 Fairmont Avenue', 'diana@mail.com', '7450001010', 'assets/frontend/img/default.png', 1, '1672401155'),
('CA0018', 'agnes', '$2y$10$qIBv6Y2PnV4AqV5kG3M6gO4UzfvkFiMAvXcPJT.D1igRkQd8uuMu.', 'Agnes Wonka', '65 Cherry Ridge Drive', 'agnes@mail.com', '7312580010', 'assets/frontend/img/default.png', 1, '1672401850'),
('CA0019', 'marysmith', '$2y$10$KokpNWTZSwXXLDpjqZXWgekm7Oi3E2gKF1Iaui0dsG9a.id4FMBBC', 'Mary Smith', '43 Saint Francis Way', 'mary@mail.com', '7412555545', 'assets/frontend/img/default.png', 1, '1672402552'),
('CA0020', 'thomas', '$2y$10$qQbkAXlNidPmAJQQpmxDOOxVpuEZUs/DS.49ukgekOwzXhBwrFS.O', 'Thomas Ford', '87 Hudson Street', 'thomasf@mail.com', '7140002569', 'assets/frontend/img/default.png', 1, '1672402730'),
('CA0021', 'shane', '$2y$10$ovPI98iJNIbf8XKzPzy3.e7pQKf4OooU/QoAEXlwxC3e8N42ZUWNG', 'Shane Gustin', '27 Duff Avenue', 'shane@mail.com', '7410140025', 'assets/frontend/img/default.png', 1, '1672414382'),
('CA0022', 'steven', '$2y$10$FNs3qmXmq.fM/lwmCEdnG.dq8FJ2HNnZAFQ6Z9crWGUZYvJ3E3CBG', 'Steven Bast', '58 Crestview Terrace', 'basteven@mail.com', '4501450000', 'assets/frontend/img/default.png', 1, '1672414504'),
('CA0023', 'williams', '$2y$10$lZbkc8bqwvCOcrcLKPY3IugNqsS.eUMN9uam1VH.L0VVwxvgaVuEu', 'Will Williams', '47 Wilson Street', 'williams@mail.com', '7014698500', 'CA0023-1679813335.jpg', 1, '1672417879'),

-- --------------------------------------------------------

--
-- Table structure for table `entrepreneurs`
--

CREATE TABLE `entrepreneurs` (
  `entrepreneur_id` varchar(10) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `store_name` varchar(45) NOT NULL,
  `store_address` text NOT NULL,
  `store_image` varchar(50) DEFAULT 'default.png',
  `phone_number` varchar(10) NOT NULL,
  `bank_account` varchar(45) NOT NULL,
  `bank_account_name` varchar(100) NOT NULL,
  `number_bank_account` varchar(20) NOT NULL,
  `create_at` varchar(45) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrepreneurs`
--

INSERT INTO `entrepreneurs` (`entrepreneur_id`, `firstname`, `lastname`, `email`, `password`, `store_name`, `store_address`, `store_image`, `phone_number`, `bank_account`, `bank_account_name`, `number_bank_account`, `create_at`) VALUES
('EN0001', 'พงศกร', 'หงษ์วิไล', 'indie_store@mail.com', '$2y$10$Bi42oZh.ka68HI4rIdBLdOWgyt3BHCCiQ.bB3TNY.IUzG4rqVJQga', 'indie_store', '18/1 บางแสนสาย 4 ใต้ ซอย 2 ตำบลแสนสุข อำเภอเมืองชลบุรี ชลบุรี 20130', 'EN0001-1679813007.png', '120938', 'กรุงไทย', 'พงศกร หงษ์วิไล', '1209457825', '2023-02-19 13:11:07'),
('EN0002', 'ปราณี', 'วิไล', 'POGShop@mail.com', '$2y$10$Bi42oZh.ka68HI4rIdBLdOWgyt3BHCCiQ.bB3TNY.IUzG4rqVJQga', 'POGs Shop', 'test', 'default.png', '12341', 'ไทยพาณิชย์', 'ปราณี วิไล', '1235423452', '2023-02-19 13:11:07'),
('EN0003', 'สมชาย', 'วงเหล้า', 'coco_2020@mail.com', '$2y$10$Bi42oZh.ka68HI4rIdBLdOWgyt3BHCCiQ.bB3TNY.IUzG4rqVJQga', 'coco_2020', 'tetst', 'default.png', '12414', 'กรุงศรี', 'สมชาย วงเหล้า', '123521451', '2023-02-19 13:11:07'),
('EN0004', 'testen', 'testen', 'testen@mail.com', '$2y$10$Bi42oZh.ka68HI4rIdBLdOWgyt3BHCCiQ.bB3TNY.IUzG4rqVJQga', 'testen', 'testen', 'default.png', '12131', '12131', 'testen', '12131', '2023-02-19 15:19:14'),

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(30) NOT NULL,
  `order_status_id` varchar(45) NOT NULL DEFAULT 'ORD_S001',
  `quantity` int(30) NOT NULL,
  `pickup_id` varchar(45) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `payment_status` varchar(45) NOT NULL DEFAULT 'ยังไม่ได้ชำระเงิน',
  `payment_proof` varchar(60) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `parcel_delivery_company_id` varchar(10) DEFAULT 'PDC000',
  `shipping_tracking` varchar(45) DEFAULT NULL,
  `product_id` varchar(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `entrepreneur_id` varchar(10) NOT NULL,
  `create_at` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `new` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status_id`, `quantity`, `pickup_id`, `pickup_date`, `payment_status`, `payment_proof`, `shipping_address`, `parcel_delivery_company_id`, `shipping_tracking`, `product_id`, `customer_id`, `entrepreneur_id`, `create_at`, `new`) VALUES
('ODR0001', 'ORD_S002', 3, 'PU001', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0001-1677117929.jpg', '', 'PDC000', NULL, 'P0006', 'CA0024', 'EN0003', '2023-02-23 09:05:29', 0),
('ODR0002', 'ORD_S004', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0002-1677132788.jpg', '(+66) 638081875\nP.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ ต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC001', 'SDOF5207726318', 'P0001', 'CA0024', 'EN0001', '2023-02-23 13:13:08', 0),
('ODR0004', 'ORD_S004', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0004-1678069240.jpg', NULL, 'PDC002', 'test', 'P0002', 'CA0025', 'EN0001', '2023-03-06 09:20:40', 0),
('ODR0006', 'ORD_S004', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0006-1678096433.jpg', NULL, 'PDC001', 'test', 'P0003', 'CA0025', 'EN0001', '2023-03-06 16:53:53', 0),
('ODR0007', 'ORD_S002', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0007-1678096674.jpg', NULL, 'PDC000', NULL, 'P0003', 'CA0024', 'EN0001', '2023-03-06 16:57:54', 0),
('ODR0008', 'ORD_S004', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0008-1678168904.jpg', '(+66) 638081875\nP.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ ต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC001', 'SDOF5207726318', 'P0003', 'CA0024', 'EN0005', '2023-03-07 13:01:44', 0),
('ODR0009', 'ORD_S002', 1, 'PU001', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0009-1678291004.jpg', NULL, 'PDC000', NULL, 'P0004', 'CA0025', 'EN0002', '2023-03-08 22:56:44', 0),
('ODR0010', 'ORD_S004', 1, 'PU002', '0000-00-00', 'ชำระเงินแล้ว', 'ODR0010-1678691480.jpg', NULL, 'PDC001', '12312123', 'P0007', 'CA0024', 'EN0004', '2023-03-13 14:11:20', 0),
('ODR0011', 'ORD_S002', 1, 'PU001', '2023-03-14', 'ชำระเงินแล้ว', 'ODR0011-1678714740.jpg', NULL, 'PDC000', NULL, 'P0001', 'CA0024', 'EN0001', '2023-03-13 20:39:00', 0),
('ODR0012', 'ORD_S006', 1, 'PU001', '2023-03-14', 'ชำระเงินแล้ว', 'ODR0012-1678716171.jpg', '(+66) 638081875\r\nP.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ ต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC000', NULL, 'P0001', 'CA0024', 'EN0001', '2023-03-13 21:02:51', 0),
('ODR0013', 'ORD_S004', 2, 'PU002', NULL, 'ชำระเงินแล้ว', 'ODR0013-1678946889.jpg', '(+66) 638081875\r\nP.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ ต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC001', 'SDOF5207726318', 'P0003', 'CA0024', 'EN0001', '2023-03-16 13:08:09', 0),
('ODR0018', 'ORD_S007', 1, 'PU001', '2023-03-26', 'ชำระเงินแล้ว', 'ODR0018-1679728029.jpg', NULL, 'PDC000', NULL, 'P0005', 'CA0024', 'EN0003', '2023-03-25 14:07:09', 0),
('ODR0022', 'ORD_S003', 2, 'PU001', '2023-03-27', 'ชำระเงินแล้ว', 'ODR0022-1679815060.jpg', NULL, 'PDC000', NULL, 'P0002', 'CA0024', 'EN0001', '2023-03-26 14:17:40', 0),
('ODR0023', 'ORD_S002', 2, 'PU001', '2023-03-27', 'ชำระเงินแล้ว', 'ODR0023-1679818015.jpg', NULL, 'PDC000', NULL, 'P0002', 'CA0031', 'EN0001', '2023-03-26 15:06:55', 0),
('ODR0024', 'ORD_S004', 1, 'PU002', NULL, 'ชำระเงินแล้ว', 'ODR0024-1679818717.jpg', 'P.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ \r\nต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC001', 'SDOF5207726318', 'P0003', 'CA0031', 'EN0001', '2023-03-26 15:18:37', 0),
('ODR0025', 'ORD_S001', 1, 'PU002', NULL, 'ชำระเงินแล้ว', 'ODR0025-1679819552.jpg', 'P.S. อพาร์ทเม้นท์, 57 ซ.ซีไซด์ ถ.บางแสนสาย 4 ใต้ \r\nต.แสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', 'PDC001', 'SDOF5207726318', 'P0003', 'CA0031', 'EN0001', '2023-03-26 15:32:32', 0),
('ODR0026', 'ORD_S001', 1, 'PU001', '2023-04-04', 'ชำระเงินแล้ว', 'ODR0026-1680530197.jpg', NULL, 'PDC000', NULL, 'P0002', 'CA0024', 'EN0001', '2023-04-03 20:56:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` varchar(30) NOT NULL,
  `order_status_name` varchar(40) NOT NULL,
  `order_status_description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_name`, `order_status_description`, `create_at`) VALUES
('ORD_S001', 'รอร้านค้าอนุมัติ', '', '2023-02-20 14:05:19'),
('ORD_S002', 'ร้านค้าอนุมัติคำสั่งจองแล้ว', '', '2023-02-20 14:05:19'),
('ORD_S003', 'ร้านค้ากำลังเตรียมสินค้า', '', '2023-02-20 14:05:19'),
('ORD_S004', 'ร้านค้าจัดส่งสินค้าแล้ว', '', '2023-02-22 13:06:19'),
('ORD_S005', 'ลูกค้าได้รับสินค้าแล้ว', '', '2023-02-28 11:45:53'),
('ORD_S006', 'ถูกปฏิเสธจากร้านค้า', '', '2023-02-28 11:46:13'),
('ORD_S007', 'ร้านค้าเตรียมสินค้าเสร็จแล้ว', '', '2023-03-13 13:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_delivery_companies`
--

CREATE TABLE `parcel_delivery_companies` (
  `company_id` varchar(10) NOT NULL,
  `company_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parcel_delivery_companies`
--

INSERT INTO `parcel_delivery_companies` (`company_id`, `company_name`) VALUES
('PDC000', ''),
('PDC001', 'Kerry'),
('PDC002', 'ไปรษณีย์ไทย');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE `pickup` (
  `pickup_id` varchar(10) NOT NULL,
  `pickup_option` varchar(45) NOT NULL,
  `pickup_description` varchar(100) NOT NULL,
  `create_at` varchar(30) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pickup`
--

INSERT INTO `pickup` (`pickup_id`, `pickup_option`, `pickup_description`, `create_at`) VALUES
('PU001', 'รับที่ร้านค้า', 'ให้ลูกค้าที่ทำการสั่งสินค้าไปรับที่ร้านค้า', '2023-02-19 13:42:12'),
('PU002', 'จัดส่งถึงที่', 'ร้านค้าทำการจัดส่งสินค้าให้กับลูกค้า', '2023-02-19 13:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `product_price` int(5) NOT NULL,
  `pickup_id` varchar(45) DEFAULT NULL,
  `shipping_cost` int(3) NOT NULL,
  `quantity` int(2) NOT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `entrepreneur_id` varchar(100) DEFAULT NULL,
  `create_at` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image`, `product_price`, `pickup_id`, `shipping_cost`, `quantity`, `category_id`, `entrepreneur_id`, `create_at`, `status`) VALUES
('P0001', 'กระเป๋าสะพายไหล่', 'แมทช์กับเสื้อผ้าสไตล์แอคทีฟได้อย่างลงตัว \nพร้อมกระเป๋าด้านในใช้สะดวกที่จุของได้มาก', 'P0001.jpg', 590, 'PU002', 35, 10, '1', 'EN0001', '2023-02-19 13:42:24', 'open'),
('P0002', 'เสื้อยืด คอกลม', 'เนื้อผ้าหนาเป็นพิเศษสามารถใส่ได้โดยไม่ต้องสวมทับอีกชั้น พร้อมลายทางแคบสวมใส่ได้หลายโอกาส', 'P0002.jpg', 490, 'PU001', 50, 10, '2', 'EN0001', '2023-02-19 13:42:24', 'open'),
('P0003', 'T-shirt', 'เสื้อยืดทรงหลวมมาพร้อมเนื้อผ้าที่ทนทานในสไตล์ชิลๆ', 'P0003.jpg', 399, 'PU002', 45, 3, '2', 'EN0001', '2023-02-19 13:42:24', 'open'),
('P0004', 'ขนมครก', 'ขนมครก ขนมไทยโบราณ', 'P0004.jpg', 40, 'PU001', 0, 5, '3', 'EN0002', '2023-02-19 13:42:24', 'open'),
('P0005', 'ชอร์ตเค้ก (Shortcake)', 'สตรอเบอรี่ชอร์ตเค้ก เค้กชนิดนี้นิยมซื้อมาเพื่อการเฉลิมฉลองในโอกาสต่างๆ อย่างวันเกิด หรือวันคริสต์มาส\r\nสตรอเบอรี่ชอร์ตเค้ก เค้กชนิดนี้นิยมซื้อมาเพื่อการเฉลิมฉลองในโอกาสต่างๆ อย่างวันเกิด หรือวันคริสต์มาส\r\nสตรอเบอรี่ชอร์ตเค้ก เค้กชนิดนี้นิยมซื้อมาเพื่อการเฉลิมฉลองในโอกาสต่างๆ อย่างวันเกิด หรือวันคริสต', 'P0005.jpg', 79, 'PU001', 0, 4, '3', 'EN0003', '2023-02-19 13:42:24', 'open'),
('P0006', 'ลูกชิ้นทอด', 'ลูกชิ้นทอด อร่อยๆ', 'P0006.jpg', 12, 'PU001', 0, 4, '3', 'EN0003', '2023-02-19 13:42:24', 'open'),
('P0007', 'รองเท้าผ้าใบ', 'สีพื้นในดีไซน์ทันสมัย ออกแบบมาเพื่อความสบายโดยใส่ใจในรายละเอียดที่เล็กที่สุด', 'P0007-1679819769.png', 990, 'PU002', 40, 2, '2', 'EN0001', '2023-03-26 15:36:09', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` varchar(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `order_rating` int(1) NOT NULL,
  `entrepreneur_id` varchar(10) NOT NULL,
  `store_rating` int(1) NOT NULL,
  `comment` text DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `customer_id`, `order_id`, `order_rating`, `entrepreneur_id`, `store_rating`, `comment`, `create_at`) VALUES
('RT0001', 'CA0024', 'ORD0001', 5, 'EN0003', 5, 'ดีมาก', '2023-03-06 02:42:32'),
('RT0002', 'CA0025', 'ODR0004', 5, 'EN0001', 5, 'เนื้อผ้าดี ใส่สบายครับ', '2023-03-06 04:51:42'),
('RT0003', 'CA0025', 'ODR0006', 5, 'EN0001', 5, 'good', '2023-03-06 09:56:09'),
('RT0004', 'CA0024', 'ODR0007', 3, 'EN0001', 4, 'OK', '2023-03-06 09:58:10'),
('RT0006', 'CA0025', 'ODR0003', 5, 'EN0001', 5, 'ดีมาก', '2023-03-08 15:53:36'),
('RT0007', 'CA0025', 'ODR0009', 4, 'EN0002', 5, 'อร่อยมากครับ', '2023-03-08 15:58:28'),
('RT0008', 'CA0024', 'ODR0008', 4, 'EN0001', 4, 'ดีครับ', '2023-03-13 07:01:40'),
('RT0009', 'CA0024', 'ODR0010', 5, 'EN0004', 5, '', '2023-03-13 07:11:34'),
('RT0010', 'CA0024', 'ODR0002', 5, 'EN0001', 5, 'very good', '2023-03-13 09:41:24'),
('RT0011', 'CA0024', 'ODR0013', 4, 'EN0001', 5, 'ดีมาก', '2023-03-16 06:24:49'),
('RT0016', 'CA0024', 'ODR0017', 5, 'EN0001', 5, 'รองเท้าผ้าใบใส่สบาย', '2023-03-25 06:45:12'),
('RT0018', 'CA0024', 'ODR0018', 5, 'EN0003', 5, 'แซ่บหลาย', '2023-03-25 07:08:18'),
('RT0019', 'CA0023', 'ODR0020', 5, 'EN0001', 5, 'ใส่สบายผ้าหนาแต่ใส่แล้วไม่ร้อนเนื้อผ้านุ่มซักรีดง่าย', '2023-03-26 06:49:27'),
('RT0020', 'CA0031', 'ODR0023', 5, 'EN0001', 5, 'ดีมากครับ', '2023-03-26 08:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `token_customer`
--

CREATE TABLE `token_customer` (
  `id_token` int(11) NOT NULL,
  `name_token` varchar(256) DEFAULT NULL,
  `email_token` varchar(50) DEFAULT NULL,
  `date_create_token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_customer`
--

INSERT INTO `token_customer` (`id_token`, `name_token`, `email_token`, `date_create_token`) VALUES
(1, '65a01b40a0cc44076458f9d00ce94720', 'demo@mail.com', 1634359787),
(2, 'dd79d52fe9968f73fc66a1d481778655', 'john@mail.com', 1642506186),
(3, 'cd7b785a63c58898bfed23bab186ee1d', 'christine@mail.com', 1672227893),
(4, '616b4176a96b190073514fd3c154c2e0', 'ellen@mail.com', 1672229234),
(5, '87702b38ef9a5b80a98c077c43073182', 'andie@mail.com', 1672235116),
(6, '02a2fcb0be5250471a94142ed81d04df', 'robert@mail.com', 1672247531),
(7, '6f531b65df037f2f7ba0fb78231e577d', 'delbert@mail.com', 1672333316),
(8, '9d40b5ed83fc9cb3ce68f7050d69ee6a', 'ruth@mail.com', 1672336612),
(9, '0cb29395d911e02aba3a746691d7f5cf', 'carl@mail.com', 1672388181),
(10, '276466e9d4a5d8003fde3aa3990f46ae', 'demo@mail.com', 1672396084),
(11, '36c79fa8f57a423a794d8421be08e024', 'diana@mail.com', 1672401155),
(12, '51f91e83a25741a3626f99d0dbf0f5a0', 'agnes@mail.com', 1672401850),
(13, '2ec7e10ab13703d8817a2e74f712f45a', 'mary@mail.com', 1672402552),
(14, '3fed0f58dd880c8fa5f606e7a2b878bf', 'thomasf@mail.com', 1672402730),
(15, 'ca46de539fd1c62fa3614d0b18539233', 'shane@mail.com', 1672414382),
(16, 'a98db0cf72281841d03067c42ab953ac', 'basteven@mail.com', 1672414504),
(17, '6a05822bb349381f20ba0b464559879b', 'williams@mail.com', 1672417879)

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `entrepreneurs`
--
ALTER TABLE `entrepreneurs`
  ADD PRIMARY KEY (`entrepreneur_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `parcel_delivery_companies`
--
ALTER TABLE `parcel_delivery_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`pickup_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `token_customer`
--
ALTER TABLE `token_customer`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `token_customer`
--
ALTER TABLE `token_customer`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
