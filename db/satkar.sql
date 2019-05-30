-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2019 at 11:44 AM
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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `publisher`, `created`) VALUES
(1, 'weq', 'qweqeq', 'qwewqewq', '2019-05-24 12:39:43'),
(2, '21e3wqd', 'qwedqwe', 'wqaeq', '2019-05-24 12:39:43'),
(3, 'wqedf', 'ewrfd', 'w3erfd', '2019-05-24 12:39:52'),
(4, '3e4rg', '3ewrf', '3werf', '2019-05-24 12:39:52'),
(5, 'ewrefg', '3erg', '3e4wrgr', '2019-05-24 12:40:28');

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
(2, 0, 1, 8, 'Gold'),
(3, 2, 2, 7, 'Ring'),
(5, 3, 5, 6, 'Womens'),
(7, 3, 3, 4, 'Jarkan'),
(14, 0, 9, 10, 'silver'),
(16, 0, 11, 12, 'Artificial'),
(17, 0, 13, 14, 'Platinum'),
(18, 0, 15, 16, 'Gold + Gems'),
(19, 0, 17, 18, 'Silver + Gems'),
(20, 0, 19, 20, 'Bronze + Gems');

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
(1, 'Tanveer Aalam', '9111199928', 'tanveer@gmail.com', 'kambal sah Majar', NULL, 1, '2018-07-25 10:18:45'),
(2, 'Krishna', '8726353211', '', 'sherpur', NULL, 1, '2018-07-25 10:29:51'),
(3, 'janvi mam', '9875142524', 'janvi@gmail.com', 'miscot', 2, 1, '2018-07-27 20:26:44'),
(4, 'Tinku', '9876782626', '', 'Purani Gudri', NULL, 1, '2019-05-04 13:54:51'),
(5, 'Arya mam', '7882727272', 'aryamam@gmail.com', 'Sherpur', NULL, 1, '2019-05-04 13:55:19'),
(6, 'Reyaj Khan', '9877263642', '', 'Kamra mohalla', NULL, 1, '2019-05-05 14:06:03'),
(7, 'Awijit', '9871124352', 'awijitsharma@gmail.com', 'Madnani lane, club road', NULL, 1, '2019-05-06 07:09:15'),
(8, 'Akash Kumar', '7892635173', 'akashsiwa@gmail.com', 'Rewa Road, Muzaffarpur', NULL, 1, '2019-05-22 14:11:39'),
(9, 'Rehana khan', '7006423453', '', 'Kamra mohalla', NULL, 1, '2019-05-25 19:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `subject`, `content`, `status`, `created`, `modified`) VALUES
(1, '123', 'efrdgbfdssADSFDV', 1, '2019-05-27 09:35:40', '0000-00-00 00:00:00'),
(2, '123', 'efrdgbfdssADSFDV', 1, '2019-05-27 09:36:23', '0000-00-00 00:00:00'),
(3, '123', 'efrdgbfdssADSFDV', 1, '2019-05-27 09:36:41', '0000-00-00 00:00:00'),
(4, '3ewr', '3erfd', 0, '2019-05-27 09:36:47', '0000-00-00 00:00:00'),
(5, '3ewr', 'testing', 0, '2019-05-27 09:37:00', '2019-05-27 09:40:27');

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
(1, 8, 'OD8144171559203070', '700.00', NULL, '700.00', 1, 0, '', '2019-05-30 07:57:50', '0000-00-00 00:00:00');

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
(2, 1, 14, 'ring', '', '', '', '', '', '', '', NULL, '700.00', NULL, '700.00', '', 0, '2019-05-30 07:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `invoice_number` varchar(200) DEFAULT NULL,
  `type` enum('cash','metal','wallet','cheque','net-banking','credit-card','debit-card') NOT NULL DEFAULT 'cash',
  `item` varchar(200) DEFAULT NULL,
  `metal_type` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `return_percentage` decimal(10,0) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `cheque_number` varchar(250) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_transaction_id` varchar(250) DEFAULT NULL,
  `comments` text,
  `status` tinyint(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_transactions`
--

INSERT INTO `order_transactions` (`id`, `order_id`, `amount_paid`, `invoice_number`, `type`, `item`, `metal_type`, `weight`, `return_percentage`, `rate`, `cheque_number`, `bank_name`, `transaction_date`, `payment_transaction_id`, `comments`, `status`, `created`) VALUES
(1, 1, '2700.00', '2271011559203070', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 07:57:50', NULL, NULL, NULL, '2019-05-30 07:57:50');

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
  `order_id` int(11) DEFAULT NULL,
  `order_number` varchar(200) DEFAULT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `metal_type` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `return_percentage` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `cheque_number` varchar(200) DEFAULT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_transaction_id` varchar(200) DEFAULT NULL,
  `type` enum('pay-dues','cash','metal','cheque','net-banking','credit-card','debit-card','return-item','cancel-order','delete-item') NOT NULL DEFAULT 'cash',
  `credit` decimal(10,2) DEFAULT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not refunded,1=refunded',
  `comments` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `customer_id`, `order_id`, `order_number`, `order_item_id`, `item`, `metal_type`, `weight`, `return_percentage`, `rate`, `cheque_number`, `bank_name`, `transaction_date`, `payment_transaction_id`, `type`, `credit`, `debit`, `balance`, `refund`, `comments`, `status`, `created`) VALUES
(1, 8, 1, 'OD8144171559203070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 07:58:02', NULL, 'delete-item', '2000.00', NULL, '2000.00', 0, 'This amount is credited because customer return some items from order on the same day', 1, '2019-05-30 07:58:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
