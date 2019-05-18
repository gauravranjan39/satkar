-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 09:14 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satkar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `lft`, `rght`, `name`) VALUES
(2, 0, 1, 10, 'Gold'),
(3, 2, 2, 9, 'Ring'),
(4, 3, 3, 6, 'Mens'),
(5, 3, 7, 8, 'Womens'),
(7, 4, 4, 5, 'Jarkan'),
(14, 0, 11, 12, 'silver'),
(16, 0, 13, 14, 'Artificial'),
(17, 0, 15, 16, 'Platinum'),
(18, 0, 17, 18, 'Gold + Gems'),
(19, 0, 19, 20, 'Silver + Gems'),
(20, 0, 21, 22, 'Bronze + Gems');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `reference_id`, `status`, `created`) VALUES
(1, 'Tanveer Aalam', '9111199928', 'tanveer@gmail.com', 'club road', NULL, 1, '2018-07-25 10:18:45'),
(2, 'Krishna', '8726353211', '', 'sherpur', NULL, 1, '2018-07-25 10:29:51'),
(3, 'janvi mam', '9875142524', 'janvi@gmail.com', 'miscot', 2, 1, '2018-07-27 20:26:44'),
(4, 'Tinku', '9876782626', '', 'Purani Gudri', NULL, 1, '2019-05-04 13:54:51'),
(5, 'Arya mam', '7882727272', 'aryamam@gmail.com', 'Sherpur', NULL, 1, '2019-05-04 13:55:19'),
(6, 'Reyaj Khan', '9877263642', '', 'Kamra mohalla', NULL, 1, '2019-05-05 14:06:03'),
(7, 'Awijit', '9871124352', 'awijitsharma@gmail.com', 'Madnani lane, club road', NULL, 1, '2019-05-06 07:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=draft,1=confirm, 2=cancelled, 3=partial cancelled',
  `payment_status` tinyint(1) NOT NULL COMMENT '0=completed,1=pending',
  `comments` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_number`, `total`, `discount`, `grand_total`, `status`, `payment_status`, `comments`, `created`, `modified`) VALUES
(1, 1, 'OD1264621557947014', NULL, NULL, '165423.00', 1, 1, '', '2019-05-15 19:03:34', '0000-00-00 00:00:00'),
(2, 7, 'OD7317211558009161', NULL, NULL, '150236.00', 1, 1, '', '2019-05-16 12:19:21', '0000-00-00 00:00:00'),
(3, 5, 'OD5136021558204269', NULL, NULL, '19300.00', 1, 1, '', '2019-05-18 18:31:09', '0000-00-00 00:00:00'),
(4, 2, 'OD2231011558204881', NULL, NULL, '2736.00', 1, 1, '', '2019-05-18 18:41:21', '0000-00-00 00:00:00'),
(5, 1, 'OD1218721558205144', NULL, NULL, '7920.00', 1, 1, '', '2019-05-18 18:45:44', '0000-00-00 00:00:00'),
(6, 6, 'OD6253881558205415', NULL, NULL, '9000.00', 1, 1, '', '2019-05-18 18:50:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `weight` varchar(250) DEFAULT NULL,
  `rate` varchar(100) DEFAULT NULL,
  `making_charge` varchar(20) DEFAULT NULL,
  `purity` varchar(20) DEFAULT NULL,
  `gems_name` varchar(255) DEFAULT NULL,
  `gems_rate` varchar(255) DEFAULT NULL,
  `gems_weight` varchar(200) DEFAULT NULL,
  `gems_price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `comments` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=confirm,1=cancelled',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `category_id`, `name`, `weight`, `rate`, `making_charge`, `purity`, `gems_name`, `gems_rate`, `gems_weight`, `gems_price`, `total`, `discount`, `grand_total`, `comments`, `status`, `created`) VALUES
(1, 1, 2, 'necklace', '43.674', '3200', '450', '', '', '', '', NULL, '159410.10', NULL, '159410.10', '', 0, '2019-05-15 19:03:34'),
(2, 1, 16, 'necklace', '', '', '', '', '', '', '', NULL, '6012.78', NULL, '6012.78', '', 0, '2019-05-15 19:03:34'),
(3, 2, 2, 'necklace', '22.500', '3200', '400', '', '', '', '', NULL, '81000.00', NULL, '81000.00', '', 0, '2019-05-16 12:19:21'),
(4, 2, 2, 'ring', '3.760', '3200', '400', '', '', '', '', NULL, '13536.00', NULL, '13536.00', '', 0, '2019-05-16 12:19:21'),
(5, 2, 2, 'Chain', '14.630', '3200', '450', '', '', '', '', NULL, '53399.50', NULL, '53399.50', '', 0, '2019-05-16 12:19:21'),
(6, 2, 16, 'necklace', '', '', '', '', '', '', '', NULL, '2300.00', NULL, '2300.00', '', 0, '2019-05-16 12:19:22'),
(7, 3, 2, 'Ring', '4.570', '3200', '450', '', '', '', '', NULL, '16680.50', '80.50', '16600.00', '', 0, '2019-05-18 18:31:09'),
(8, 3, 16, 'necklace', '', '', '', '', '', '', '', NULL, '2700.00', NULL, '2700.00', '', 0, '2019-05-18 18:31:09'),
(9, 4, 14, 'payal', '57', '40', '8', '', '', '', '', NULL, '2736.00', NULL, '2736.00', '', 0, '2019-05-18 18:41:21'),
(10, 5, 14, 'payal', '165', '40', '8', '', '', '', '', NULL, '7920.00', NULL, '7920.00', '', 0, '2019-05-18 18:45:44'),
(11, 6, 2, 'Ring', '2.500', '3200', '400', '', '', '', '', NULL, '9000.00', NULL, '9000.00', '', 0, '2019-05-18 18:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `invoice_number` varchar(200) DEFAULT NULL,
  `type` enum('cash','metal','wallet','cheque','net-banking','card') NOT NULL DEFAULT 'cash',
  `item` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `return_percentage` decimal(10,0) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `cheque_number` varchar(250) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `payment_transaction_id` varchar(250) DEFAULT NULL,
  `comments` text,
  `status` tinyint(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_transactions`
--

INSERT INTO `order_transactions` (`id`, `order_id`, `amount_paid`, `invoice_number`, `type`, `item`, `weight`, `return_percentage`, `rate`, `cheque_number`, `bank_name`, `transaction_date`, `payment_transaction_id`, `comments`, `status`, `created`) VALUES
(1, 1, '44000.00', '2233511557947014', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-15 19:03:34'),
(2, 2, '35000.00', '2878221558009162', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 12:19:22'),
(3, 2, '37000.00', '1171421558009473', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 12:24:33'),
(4, 2, '25000.00', '1838721558009505', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 12:25:05'),
(5, 2, '15000.00', '2806921558118657', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 18:44:17'),
(6, 3, '17000.00', '1118731558204270', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-18 18:31:10'),
(8, 5, '1920.00', '1184851558205372', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-18 18:49:32'),
(9, 6, '5000.00', '2794861558205439', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-18 18:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `trade_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `trade_name`, `address`, `status`, `created`) VALUES
(1, 'vicky', '7766551122', 'vicky@gmail.com', 'R.P Alankar', 'garibnath mandir road', 1, '2018-07-18 12:27:34'),
(2, 'Mani', '9876543210', 'mani@gmail.com', 'Mani company', 'tola road', 1, '2018-07-18 12:34:57'),
(3, 'Vinod', '9182938818', 'vinod@gmail.com', 'DurgaLaxmi', 'clubRoad', 1, '2018-07-20 12:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `hash_token` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `address`, `username`, `password`, `email`, `status`, `hash_token`, `role`, `created`) VALUES
(1, 'gaurav', '9872137829', 'muzafafrpur', 'gaurav', '2a0143b5f42b00035a430b57d37d035ac3295a6c', 'gauravranjan39@gmail.com', 1, NULL, '1', '2018-07-14 11:28:40'),
(2, 'ranjan', '9888909001', 'patna', 'gaurav12', '0cfb18e96e649305e887e89a0308e02797240cd0', 'admin@gmail.com', 1, NULL, '1', '2018-07-14 11:32:05'),
(3, 'gaurav ranjan', '7277568289', 'purani bazar', NULL, '2a0143b5f42b00035a430b57d37d035ac3295a6c', 'gauravr39@gmail.com', 1, NULL, '1', '2018-07-14 21:45:59'),
(4, 'testing', '9898989888', 'purani bazar', NULL, '2a0143b5f42b00035a430b57d37d035ac3295a6c', 'test@gmail.com', 1, 'ranjan', '1', '2018-07-14 21:52:57'),
(5, 'final test', '9876543210', 'final ', NULL, '2e2a5ed8775931f4c4811675013af8c7155b5092', 'finaltest@satkar.com', 1, '1531761415', '1', '2018-07-14 22:00:07'),
(6, 'token', '9817262322', 'patna', NULL, 'c507d31b18711594052eef43de328db537426479', 'token@gmail.com', 1, '1531598513', '1', '2018-07-14 22:01:53'),
(7, 'Satkar', '9898989888', 'delhi', NULL, '518d937c68432fa867261f2591d3cd7f3dcde629', 'finaltest@satkar.com', 1, '1531761446', '1', '2018-07-16 18:54:43'),
(8, 'final test', '9898989888', 'final address', NULL, '4fa23b586d814ca413dc9f2185aecd4621f63a54', 'finaltest@satkar.com', 1, '1531761458', '1', '2018-07-16 18:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not refunded,1=refunded',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
