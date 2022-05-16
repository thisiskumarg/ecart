-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 01:39 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_address`
--

CREATE TABLE `bill_address` (
  `bid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `baddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_address`
--

INSERT INTO `bill_address` (`bid`, `uid`, `baddress`) VALUES
(252, 3, 'Hyderabad'),
(253, 4, 'Hyderabad'),
(254, 21, 'Hyderabad'),
(255, 22, 'Bhopal');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `lid` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_activity` varchar(200) DEFAULT NULL,
  `logged_by` varchar(200) DEFAULT NULL,
  `log_object` varchar(200) DEFAULT NULL,
  `roleid` int(11) DEFAULT NULL,
  `new_old` varchar(200) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`lid`, `log_date`, `log_activity`, `logged_by`, `log_object`, `roleid`, `new_old`) VALUES
(1, '2021-06-18 05:06:45', 'Added', '1', 'Vendor', 1, 'old'),
(2, '2021-06-18 17:29:48', 'Confirmed', '2', 'Order', 2, 'old'),
(3, '2021-06-18 17:31:34', 'Shipped', '1', 'Order', 1, 'old'),
(4, '2021-06-18 17:33:23', 'Cancelled', '1', 'Order', 1, 'old'),
(5, '2021-06-18 17:36:56', 'Processed', '1', 'Order', 1, 'old'),
(6, '2021-06-18 17:37:32', 'Confirmed', '1', 'Order', 1, 'old'),
(7, '2021-06-19 03:16:50', 'Processed', '1', 'Order', 1, 'old'),
(8, '2021-06-19 03:20:52', 'Suspended', '1', 'Verified Product', 1, 'old'),
(9, '2021-06-19 03:33:56', 'Suspended', '1', 'Verified Product', 1, 'old'),
(10, '2021-06-19 03:34:04', 'Verified', '1', 'Suspended Product', 1, 'old'),
(11, '2021-06-19 03:34:14', 'Edited', '1', 'Suspended Product', 1, 'old'),
(12, '2021-06-19 03:35:35', 'Shipped', '2', 'Order', 2, 'old'),
(13, '2021-06-20 17:48:49', 'Verified', '1', 'Non-Verified User', 1, 'old'),
(14, '2021-06-21 03:14:51', 'Suspended', '1', 'Verified Vendor', 1, 'old'),
(15, '2021-06-21 03:15:52', 'Verified', '1', 'Suspended Vendor', 1, 'old'),
(16, '2021-06-21 03:23:39', 'Verified', '1', 'Suspended Product', 1, 'old'),
(17, '2021-06-21 03:23:39', 'Verified', '1', 'Suspended Product', 1, 'old'),
(18, '2021-06-21 03:23:39', 'Verified', '1', 'Suspended Product', 1, 'old'),
(19, '2021-06-21 08:09:59', 'Processed', '1', 'Order', 1, 'old');

-- --------------------------------------------------------

--
-- Table structure for table `logsterminated`
--

CREATE TABLE `logsterminated` (
  `lid` int(11) NOT NULL,
  `l_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `a_log` varchar(100) DEFAULT NULL,
  `v_log` varchar(100) DEFAULT NULL,
  `u_log` varchar(100) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `a_new_old` varchar(100) DEFAULT NULL,
  `v_new_old` varchar(100) DEFAULT NULL,
  `u_new_old` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logsterminated`
--

INSERT INTO `logsterminated` (`lid`, `l_date`, `a_log`, `v_log`, `u_log`, `uid`, `pid`, `oid`, `userid`, `a_new_old`, `v_new_old`, `u_new_old`) VALUES
(1, '2021-06-02 13:20:48', 'New product added', NULL, NULL, 2, NULL, NULL, NULL, 'old', 'old', 'old'),
(2, '2021-06-15 10:48:45', 'New product added.', NULL, NULL, 2, NULL, NULL, NULL, 'old', 'old', 'old'),
(3, '2021-06-15 10:50:06', NULL, 'Any Non-Verified product is verified.', NULL, 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(4, '2021-06-15 12:11:44', NULL, 'Any verified product is suspended.', NULL, 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(5, '2021-06-15 12:33:26', NULL, 'Any verified product is suspended.', NULL, 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(6, '2021-06-15 14:01:43', NULL, 'Any suspended product is verified.', NULL, 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(7, '2021-06-15 14:09:12', 'One order confirmed.', NULL, 'Order Confirmed.', 2, NULL, NULL, NULL, 'old', 'old', 'old'),
(8, '2021-06-15 14:11:15', NULL, NULL, 'Any Non-Verified user is verified.', 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(9, '2021-06-15 16:42:18', NULL, 'Any verified product is removed.', NULL, 1, NULL, NULL, NULL, 'old', 'old', 'old'),
(10, '2021-06-16 04:15:41', 'New product added.', NULL, NULL, 2, NULL, NULL, NULL, 'old', 'old', NULL),
(11, '2021-06-16 04:22:06', 'New product added.', NULL, NULL, 2, NULL, NULL, NULL, 'old', 'old', NULL),
(12, '2021-06-16 04:37:13', 'New product added.', NULL, NULL, 2, 34, NULL, NULL, 'old', 'old', NULL),
(13, '2021-06-16 04:39:35', 'New product added.', NULL, NULL, 2, 35, NULL, NULL, 'old', 'old', NULL),
(14, '2021-06-16 06:11:09', NULL, 'Any Non-Verified product(s) is verified.', NULL, 1, 30, NULL, NULL, 'old', 'old', NULL),
(15, '2021-06-16 06:12:48', NULL, 'Any Non-Verified product(s) is verified.', NULL, 1, 33, NULL, NULL, 'old', 'old', NULL),
(16, '2021-06-16 06:50:55', NULL, 'Any Non-Verified product(s) is verified.', NULL, 1, 35, NULL, 2, 'old', 'old', NULL),
(17, '2021-06-16 07:14:17', NULL, 'Any suspended product(s) is verified.', NULL, 1, NULL, NULL, 24, 'old', 'old', NULL),
(18, '2021-06-16 07:15:30', NULL, 'Any verified product is suspended.', NULL, 1, NULL, NULL, NULL, 'old', 'old', NULL),
(19, '2021-06-16 07:15:50', NULL, 'Any suspended product(s) is verified.', NULL, 1, 17, NULL, 24, 'old', 'old', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_sno` int(11) NOT NULL,
  `oid` varchar(100) DEFAULT NULL,
  `odate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ovalue` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `sid` varchar(300) NOT NULL DEFAULT '1',
  `is_cancelled` int(11) NOT NULL DEFAULT 0,
  `new_old` varchar(100) NOT NULL DEFAULT 'new',
  `a_new_old` varchar(200) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_sno`, `oid`, `odate`, `ovalue`, `pid`, `uid`, `sid`, `is_cancelled`, `new_old`, `a_new_old`) VALUES
(3864, 'KUSHOP332365240521044406', '2021-05-24 05:44:06', '826', 3, 21, '1', 0, 'old', 'old'),
(3865, 'KUSHOP344311250521045741', '2021-05-25 05:57:41', '63720', 2, 21, '2', 0, 'old', 'old'),
(3866, 'KUSHOP217681280521072020', '2021-05-28 08:20:20', '78706', 2, 21, '2', 0, 'old', 'old'),
(3867, 'KUSHOP217681280521072020', '2021-05-28 08:20:20', '78706', 3, 21, '1', 0, 'old', 'old'),
(3868, 'KUSHOP217681280521072020', '2021-05-28 08:20:21', '78706', 10, 21, '1', 0, 'old', 'old'),
(3869, 'KUSHOP244575170621120924', '2021-06-17 06:39:24', '1203.6', 3, 21, '1', 0, 'old', 'old'),
(3870, 'KUSHOP244575170621120924', '2021-06-17 06:39:24', '1203.6', 10, 21, '1', 0, 'old', 'old'),
(3871, 'KUSHOP970301170621121530', '2021-06-17 06:45:30', '20201.6', 10, 22, '1', 0, 'old', 'old'),
(3872, 'KUSHOP970301170621121530', '2021-06-17 06:45:30', '20201.6', 1, 22, '1', 0, 'old', 'old'),
(3873, 'KUSHOP910726170621122341', '2021-06-17 06:53:41', '24544', 17, 22, '1', 0, 'old', 'old'),
(3874, 'KUSHOP910726170621122341', '2021-06-17 06:53:41', '24544', 1, 22, '1', 0, 'old', 'old'),
(3875, 'KUSHOP184764170621123506', '2021-06-17 07:05:06', '24544', 17, 21, '1', 0, 'old', 'old'),
(3876, 'KUSHOP184764170621123506', '2021-06-17 07:05:06', '24544', 1, 21, '1', 0, 'old', 'old'),
(3877, 'KUSHOP141038170621123859', '2021-06-17 07:08:59', '24544', 17, 21, '1', 0, 'old', 'old'),
(3878, 'KUSHOP141038170621123859', '2021-06-17 07:08:59', '24544', 1, 21, '1', 0, 'old', 'old'),
(3879, 'KUSHOP693357180621092007', '2021-06-18 03:50:07', '20201.6', 10, 22, '1', 0, 'old', 'old'),
(3880, 'KUSHOP693357180621092007', '2021-06-18 03:50:07', '20201.6', 1, 22, '1', 0, 'old', 'old'),
(3881, 'KUSHOP930997180621092615', '2021-06-18 03:56:15', '20201.6', 10, 22, '1', 0, 'old', 'old'),
(3882, 'KUSHOP930997180621092615', '2021-06-18 03:56:15', '20201.6', 1, 22, '1', 0, 'old', 'old'),
(3883, 'KUSHOP771341180621093537', '2021-06-18 04:05:37', '24544', 17, 22, '1', 0, 'old', 'old'),
(3884, 'KUSHOP771341180621093537', '2021-06-18 04:05:37', '24544', 1, 22, '1', 0, 'old', 'old');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `sid` int(11) NOT NULL,
  `ostatus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`sid`, `ostatus`) VALUES
(1, 'Processed'),
(2, 'Confirmed'),
(3, 'Shipped'),
(4, 'Delivered'),
(5, 'Cancelled by Admin'),
(6, 'Cancelled by Vendor');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pimage` varchar(100) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `ptype` varchar(100) DEFAULT NULL,
  `pcategory` varchar(100) DEFAULT NULL,
  `pbrand` varchar(100) DEFAULT NULL,
  `pprice` varchar(100) DEFAULT NULL,
  `pquantity` varchar(100) DEFAULT NULL,
  `padd_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pdiscription` varchar(300) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `new_old` varchar(100) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pimage`, `pname`, `ptype`, `pcategory`, `pbrand`, `pprice`, `pquantity`, `padd_date`, `pdiscription`, `uid`, `is_verified`, `new_old`) VALUES
(1, 'images/mobile1.jpeg', 'Redmi Note 5 Pro', 'Mobile', 'Mobile', 'MI', '16800', '1', '2021-05-03 13:32:04', 'This is a handy product.', 2, 1, 'old'),
(2, 'images/tv2.jpg', 'Television', 'TV', 'TV', 'HP', '54000', '1', '2021-05-03 13:35:55', 'This is my laptop.', 2, 1, 'old'),
(3, 'images/jeans.jpg', 'Cargo', 'Pants', 'Jeans', 'JEANS', '700', '10', '2021-05-04 05:09:38', 'This is my cargo pant.', 2, 0, 'old'),
(10, 'images/tshirt2.jpg', 'V shaped T-Shirt', 'Case', 'T-Shirt', 'RK', '320', '72', '2021-05-04 08:05:54', 'T multi.', 24, 1, 'old'),
(17, 'images/tshirts3.jpg', 'Collection of T-Shirts', 'pt6', 'T-Shirt', 'pb6', '4000', '21', '2021-05-04 22:55:49', 'pd6', 24, 1, 'old'),
(19, 'images/tshirts4.jpg', 'pn8', 'pt8', 'T-Shirt', 'pb8', '5000', '10', '2021-05-04 22:57:01', 'pd8', 24, 1, 'old'),
(20, 'images/tv1.webp', 'pn9', 'pt9', 'TV', 'pb9', '5000', '20', '2021-05-04 22:57:22', 'pd9', 24, 1, 'old'),
(24, 'images/tshirttrans.png', 'Shirt', 'T-Shirt', 'T-Shirt', 'Sortex', '350', '20', '2021-05-20 08:36:44', 'This is Shirt.', 2, 1, 'old'),
(26, 'images/mobile1.jpeg', 'Mobiles', 'Mobile', 'Mobile', 'Mobiii', '20000', '10', '2021-05-20 08:55:11', 'This is Mobile.', 2, 0, 'old'),
(28, 'images/jeans.jpg', 'Jeans', 'Jeans', 'Jeans', 'KETO', '1500', '10', '2021-05-24 03:10:37', 'This is Jeans.', 2, 1, 'old'),
(29, 'images/watch2.jpg', 'Watch2', 'Watch', 'Watch', 'Watcheee', '500', '15', '2021-05-29 08:09:38', 'This is watch.', 2, 1, 'old'),
(30, 'images/jeans.jpg', 'Jeans', 'Jeans', 'Jeans', 'HETOCH', '1000', '10', '2021-06-02 13:20:48', 'This is new jeans.', 2, 1, 'old'),
(31, 'images/shoes2.jpg', 'Shoes', 'Army', 'Army', 'Leather', '3000', '10', '2021-06-15 10:48:45', 'Red shoes required.', 2, 1, 'old'),
(32, 'images/mobile2.webp', 'Mobile', 'Touchable Guard', 'Mobile', 'MI', '20000', '10', '2021-06-16 04:15:41', 'Good Mobile', 2, 1, 'old'),
(33, 'images/shoes3.jpg', 'Shoes', 'Shoes', 'Shoes', 'CSHOU', '2000', '10', '2021-06-16 04:22:06', 'Good One', 2, 1, 'old'),
(34, 'images/tv1.webp', 'TV', 'TV', 'TV', 'TELE', '9000', '10', '2021-06-16 04:37:13', 'Good Quality', 2, 0, 'old'),
(35, 'images/mobile3.jpg', 'Mobile', 'Mobile', 'Mobile', 'MOB', '15000', '10', '2021-06-16 04:39:35', 'Good Thing', 2, 1, 'old'),
(36, 'images/about.jpg', 'Nice', 'Nice', 'Nice', 'Nice', '50000', '5', '2021-06-18 07:06:44', 'This is nice.', 2, 0, 'old');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rid` int(11) NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `rreview` varchar(300) DEFAULT NULL,
  `new_old` varchar(100) NOT NULL DEFAULT 'new',
  `a_new_old` varchar(200) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rid`, `rdate`, `pid`, `uid`, `rreview`, `new_old`, `a_new_old`) VALUES
(25, '2021-05-24 05:41:57', 3, 21, 'Good', 'old', 'old'),
(26, '2021-05-25 03:44:00', 3, 21, 'This is Good.', 'old', 'old'),
(27, '2021-05-27 06:20:37', 3, 1, 'Good', 'old', 'old'),
(28, '2021-05-27 06:31:00', 28, 1, 'Good', 'old', 'old'),
(29, '2021-05-27 06:46:49', 29, 1, 'Good Thing.', 'old', 'old'),
(30, '2021-05-29 06:09:59', 10, 21, 'Good thing.', 'old', 'old'),
(39, '2021-05-29 06:22:49', 10, 21, 'Very Good', 'old', 'old'),
(40, '2021-06-01 07:16:52', 22, 2, 'Good', 'old', 'old'),
(41, '2021-06-01 07:19:32', 3, 2, 'That is good.', 'old', 'old'),
(42, '2021-06-14 11:42:24', 1, 1, 'This is good.', 'old', 'old'),
(43, '2021-06-18 04:11:25', 10, 22, 'Good from me', 'old', 'old'),
(44, '2021-06-18 04:11:44', 1, 22, 'Good One', 'old', 'old');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `rolename`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `shop_cart`
--

CREATE TABLE `shop_cart` (
  `cid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `pimage` varchar(100) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `pprice` varchar(100) DEFAULT NULL,
  `pquantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_cart`
--

INSERT INTO `shop_cart` (`cid`, `uid`, `pid`, `pimage`, `pname`, `pprice`, `pquantity`) VALUES
(3240, 4, 9, 'images/mobile3.jpg', 'Newspaper', '5', 4),
(3241, 4, 9, 'images/mobile3.jpg', 'Newspaper', '5', 6),
(3263, 4, 19, 'images/tshirts4.jpg', 'pn8', '5000', 1),
(3304, 1, 2, 'images/tv2.jpg', 'Television', '54000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `TransactionSno` int(11) NOT NULL,
  `TransactionId` varchar(50) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `ProductType` varchar(250) DEFAULT NULL,
  `ProductTypeId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `ProductInfo` varchar(250) DEFAULT NULL,
  `AmountPaid` float(11,2) DEFAULT NULL,
  `CustomerName` varchar(150) DEFAULT NULL,
  `CustomerMobile` varchar(20) DEFAULT NULL,
  `CustomerEmail` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `Mode` varchar(100) DEFAULT NULL,
  `PG_TYPE` varchar(100) DEFAULT NULL,
  `bank_ref_num` varchar(100) DEFAULT NULL,
  `MoneyId` varchar(250) DEFAULT NULL,
  `UnMappedStatus` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`TransactionSno`, `TransactionId`, `UserId`, `Status`, `ProductType`, `ProductTypeId`, `ProductId`, `ProductInfo`, `AmountPaid`, `CustomerName`, `CustomerMobile`, `CustomerEmail`, `address`, `Mode`, `PG_TYPE`, `bank_ref_num`, `MoneyId`, `UnMappedStatus`) VALUES
(1551, '53458b93ad937b7baec8', 3, NULL, 'Donation', NULL, NULL, 'Donation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `umobile` varchar(100) DEFAULT NULL,
  `uemail` varchar(100) DEFAULT NULL,
  `upassword` varchar(100) DEFAULT NULL,
  `usignup_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uaddress` varchar(300) DEFAULT NULL,
  `roleid` int(11) NOT NULL DEFAULT 3,
  `uimage` varchar(100) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `new_old` varchar(100) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `umobile`, `uemail`, `upassword`, `usignup_date`, `uaddress`, `roleid`, `uimage`, `is_verified`, `new_old`) VALUES
(1, 'Admin', '9695448506', 'admin@k.com', 'k', '2021-05-02 06:08:50', 'Hyderabad', 1, 'images/Screenshot (75).png', 1, 'old'),
(2, 'Vendor1', '7254885513', 'v1@a.com', 'a', '2021-05-02 07:42:51', 'Hyderabad', 2, 'images/teacher.png', 1, 'old'),
(8, 'User2', '35764635654', 'u2@u.com', 'u2', '2021-05-20 08:15:51', 'Hyderabad', 3, 'images/mobile1.jpeg', 1, 'old'),
(9, 'User3', '3547654165', 'u3@u.com', 'u3', '2021-05-20 08:18:23', 'Hyderabad', 3, 'images/mobile2.webp', 2, 'old'),
(11, 'User5', '6876516876', 'u5@u.com', 'u5', '2021-05-20 08:19:45', 'Hyderabad', 3, 'images/online-shopping.jpg', 2, 'old'),
(17, 'User9', '54765168', 'u9@u.com', 'u9', '2021-05-20 08:59:34', 'Hyderabad', 3, 'images/shop-img.jpg', 1, 'old'),
(18, 'User8', '65765164', 'u8@u.com', 'u8', '2021-05-20 09:00:08', 'Hyderabad', 3, 'images/shop-img.jpg', 0, 'old'),
(19, 'User7', '6875106546', 'u7@u.com', 'u7', '2021-05-20 09:00:38', 'Hyderabad', 3, 'images/tshirts3.jpg', 0, 'old'),
(20, 'User', '65765457', 'user@gmail.com', 'user', '2021-05-22 08:39:15', 'HYyy', 3, 'images/mobile1.jpeg', 0, 'old'),
(21, 'Arun Kumar', '7654654656', 'arun@u.com', 'arun', '2021-05-23 22:05:55', 'Hyderabad', 3, 'images/teacher.png', 1, 'old'),
(22, 'Lokesh', '8545632158', 'lokesh@u.com', 'lokesh', '2021-05-25 04:51:43', 'Bhopal', 3, 'images/teacher.png', 1, 'old'),
(23, 'Sir', '574654134', 'sir@g.com', 's', '2021-05-25 06:03:53', 'Hyd', 3, 'images/mobile2.webp', 1, 'old'),
(24, 'Vendor2', '7554575457', 'v2@d.com', 'd', '2021-05-29 08:53:32', 'Kannauj', 2, 'images/shop-img.jpg', 1, 'old'),
(25, 'V3', '7954631525', 'v3@v.com', 'v3', '2021-06-14 11:38:17', 'Hyderabad', 2, 'images/teacher.png', 1, 'new'),
(26, 'Golu', '8575956545', 'v@g.com', 'g', '2021-06-18 05:06:45', 'Bhopal', 2, NULL, 1, 'new');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_address`
--
ALTER TABLE `bill_address`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `logsterminated`
--
ALTER TABLE `logsterminated`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_sno`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `shop_cart`
--
ALTER TABLE `shop_cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD KEY `TransactionSno` (`TransactionSno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_address`
--
ALTER TABLE `bill_address`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logsterminated`
--
ALTER TABLE `logsterminated`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3885;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_cart`
--
ALTER TABLE `shop_cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3326;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `TransactionSno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1552;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
