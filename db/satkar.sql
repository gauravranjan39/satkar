-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2019 at 09:58 PM
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
  `total` varchar(50) DEFAULT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `grand_total` varchar(50) NOT NULL,
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
(1, 1, 'OD1234781557429721', NULL, NULL, '132601', 1, 1, '', '2019-05-09 15:52:01', '0000-00-00 00:00:00'),
(2, 5, 'OD5153561557430818', NULL, NULL, '9000', 1, 1, '', '2019-05-09 19:40:18', '0000-00-00 00:00:00');

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
  `gems_price` varchar(200) DEFAULT NULL,
  `total` varchar(200) NOT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `grand_total` varchar(200) NOT NULL,
  `comments` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=confirm,1=cancelled',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `category_id`, `name`, `weight`, `rate`, `making_charge`, `purity`, `gems_name`, `gems_rate`, `gems_weight`, `gems_price`, `total`, `discount`, `grand_total`, `comments`, `status`, `created`) VALUES
(1, 1, 2, 'necklace', '32.672', '3200', '450', '750', '', '', '', '', '119252.80', '252', '119000.80', '', 0, '2019-05-09 15:52:01'),
(2, 1, 2, 'ring', '3.760', '3200', '450', '', '', '', '', '', '13724.00', '124', '13600.00', '', 0, '2019-05-09 15:52:01'),
(3, 2, 2, 'Ring', '2.500', '3200', '400', '', '', '', '', '', '9000.00', '', '9000.00', '', 0, '2019-05-09 19:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount_paid` varchar(200) NOT NULL,
  `invoice_number` varchar(200) DEFAULT NULL,
  `comments` text,
  `status` tinyint(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_transactions`
--

INSERT INTO `order_transactions` (`id`, `order_id`, `amount_paid`, `invoice_number`, `comments`, `status`, `created`) VALUES
(1, 1, '35000', '1247111557429721', NULL, NULL, '2019-05-09 15:52:01'),
(2, 2, '5000', '64521557430819', NULL, NULL, '2019-05-09 19:40:19');

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
  `credit` decimal(7,2) NOT NULL,
  `debit` decimal(7,2) NOT NULL,
  `balance` decimal(7,2) NOT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not refunded,1=refunded',
  `status` tinyint(1) NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
