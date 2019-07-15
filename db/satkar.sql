-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 07:53 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(200) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `mobile`, `username`, `password`, `status`, `type`, `created`, `modified`) VALUES
(2, 'gauravranjan39@gmail.com', '', 'gaurav', '2a0143b5f42b00035a430b57d37d035ac3295a6c', 1, 'super_admin', '2019-06-11 22:15:40', '2019-07-02 19:19:55'),
(3, 'jewellerssatkar@gmail.com', '', 'satkar', '2a0143b5f42b00035a430b57d37d035ac3295a6c', 1, 'super_admin', '2019-06-11 22:24:28', '2019-07-02 19:20:00');

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
(1, 'Tanveer Aalam', '9111199928', 'tanveer@gmail.com', 'kambal sah Majar, muzaffarpur,bihar', NULL, 1, '2018-07-25 10:18:45'),
(2, 'Krishna', '8726353211', '', 'sherpur', NULL, 1, '2018-07-25 10:29:51'),
(3, 'janvi mam', '9875142524', 'janvi@gmail.com', 'miscot', 2, 1, '2018-07-27 20:26:44'),
(4, 'Tinku', '9876782626', '', 'purani gudri, muzaffarpur', NULL, 1, '2019-05-04 13:54:51'),
(5, 'Arya mam', '7882727272', 'aryamam@gmail.com', 'Sherpur', NULL, 1, '2019-05-04 13:55:19'),
(6, 'Reyaj Khan', '9877263642', '', 'Kamra mohalla', NULL, 1, '2019-05-05 14:06:03'),
(7, 'Awijit', '9871124352', 'awijitsharma@gmail.com', 'Madnani lane, club road', NULL, 1, '2019-05-06 07:09:15'),
(8, 'Akash Kumar', '7892635175', 'akashsiwa@gmail.com', 'Rewa Road, Muzaffarpur', NULL, 1, '2019-05-22 14:11:39'),
(9, 'Rehana khan', '7006423453', '', 'Kamra mohalla', NULL, 1, '2019-05-25 19:35:28'),
(10, 'Ashish Kandoi', '9334657162', 'ashishkandoi@gmail.com', 'Purani bazar,shukla road', 8, 1, '2019-06-02 23:53:00'),
(11, 'Angoori khatun', '7892635173', 'angorikhatun123@gmail.com', 'Banaras bank chowk, muzaffarpur', NULL, 1, '2019-06-03 15:53:19'),
(12, 'Manish Kumar', '9568325678', 'manish@gmail.com', 'Rewa Road, colony no.4, Muzaffarpur, Buhar', 8, 1, '2019-06-12 22:53:35'),
(13, 'test comments', '9793625737', 'test@gmail.com', 'test address', 9, 1, '2019-06-18 23:49:23'),
(14, 'Ashish Kumar', '9111199922', 'ashish@gmail.com', 'Bela road, IDPL, muzaffarpur', 2, 1, '2019-06-27 22:06:31');

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
  `payment_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=completed,1=pending',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=hide,1=show',
  `comments` text,
  `cancel_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_number`, `total`, `discount`, `grand_total`, `status`, `payment_status`, `is_show`, `comments`, `cancel_date`, `created`, `modified`) VALUES
(1, 8, '8197981559417573', '10900.00', NULL, '0.00', 2, 0, 1, 'Test for the summary page...', '2019-06-25 18:38:55', '2019-06-01 19:32:53', '0000-00-00 00:00:00'),
(2, 3, '3177761559503106', '2500.00', NULL, '0.00', 2, 0, 1, '', '0000-00-00 00:00:00', '2019-06-02 19:18:26', '0000-00-00 00:00:00'),
(3, 11, '1136791559676738', '20600.00', NULL, '18300.00', 3, 0, 1, 'First online orders for Angoori.', '2019-06-25 18:38:55', '2019-06-04 19:32:18', '0000-00-00 00:00:00'),
(4, 2, '2162361559678372', '7920.00', NULL, '0.00', 2, 0, 1, '', '2019-06-25 18:47:15', '2019-06-04 19:59:32', '2019-06-25 18:47:15'),
(5, 5, '574461559755834', '27485.00', NULL, '27200.50', 1, 0, 0, '', '2019-06-25 18:38:55', '2019-06-05 17:30:34', '0000-00-00 00:00:00'),
(6, 3, '335361559756763', '29786.00', NULL, '29600.00', 1, 1, 0, '', '2019-06-25 18:38:55', '2019-06-05 17:46:03', '0000-00-00 00:00:00'),
(7, 3, '3209301559935583', '2500.00', NULL, '2500.00', 1, 1, 1, '', '2019-06-25 18:38:55', '2019-06-07 19:26:23', '0000-00-00 00:00:00'),
(8, 3, '348601559935790', '16452.00', NULL, '16300.00', 1, 1, 0, '', '2019-06-25 18:38:55', '2019-06-07 19:29:50', '0000-00-00 00:00:00'),
(9, 3, '348371559936320', '2500.00', NULL, '2500.00', 0, 1, 1, '', '2019-06-25 18:38:55', '2019-06-07 19:38:40', '0000-00-00 00:00:00'),
(10, 3, '3109201559936358', '7900.00', NULL, '7900.00', 0, 1, 1, '', '2019-06-25 18:38:55', '2019-06-07 19:39:18', '0000-00-00 00:00:00'),
(11, 11, '11300061559938542', '22934.20', NULL, '22934.00', 1, 1, 0, '', '2019-06-25 18:38:55', '2019-06-07 20:15:42', '0000-00-00 00:00:00'),
(12, 1, '1301601560003433', '84000.00', NULL, '83500.00', 3, 1, 0, '', '2019-06-26 18:20:52', '2019-06-08 14:17:13', '0000-00-00 00:00:00'),
(13, 11, '11156591561487848', '1200.00', NULL, '0.00', 2, 0, 1, '', '2019-06-25 18:40:48', '2019-06-25 18:37:28', '0000-00-00 00:00:00');

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
  `cancel_date` datetime NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `category_id`, `name`, `weight`, `rate`, `making_charge`, `purity`, `gems_name`, `gems_rate`, `gems_weight`, `gems_price`, `total`, `discount`, `grand_total`, `comments`, `status`, `cancel_date`, `created`) VALUES
(1, 1, 14, 'necklace', '', '', '', '', '', '', '', NULL, '7400.00', NULL, '7400.00', '', 1, '0000-00-00 00:00:00', '2019-06-01 19:32:53'),
(2, 1, 14, 'hathsankar', '', '', '', '', '', '', '', NULL, '3200.00', '150.00', '3050.00', '', 1, '0000-00-00 00:00:00', '2019-06-01 19:39:14'),
(4, 1, 14, 'Ring', '', '', '', '', '', '', '', NULL, '300.00', '50.00', '250.00', '', 1, '0000-00-00 00:00:00', '2019-06-01 20:26:16'),
(5, 2, 16, 'necklace', '', '', '', '', '', '', '', NULL, '2500.00', '100.00', '2400.00', '', 1, '0000-00-00 00:00:00', '2019-06-02 19:18:27'),
(6, 3, 2, 'Ring', '4.570', '3200', '411', '', '', '', '', NULL, '16502.27', '102.27', '16400.00', '', 0, '0000-00-00 00:00:00', '2019-06-04 19:32:19'),
(7, 3, 16, 'necklace', '', '', '', '', '', '', '', NULL, '2300.00', '100.00', '2200.00', '', 1, '0000-00-00 00:00:00', '2019-06-04 19:32:19'),
(8, 3, 14, 'hathsankar', '', '', '', '', '', '', '', NULL, '1900.00', NULL, '1900.00', '', 0, '0000-00-00 00:00:00', '2019-06-04 19:32:53'),
(9, 4, 14, 'payal', '165', '40', '8', '', '', '', '', NULL, '7920.00', '220.00', '7700.00', '', 1, '0000-00-00 00:00:00', '2019-06-04 19:59:32'),
(10, 5, 2, 'Earing', '7.530', '3200', '450', '916', '', '', '', NULL, '27484.50', '284.50', '27200.00', '', 0, '0000-00-00 00:00:00', '2019-06-05 17:30:34'),
(11, 6, 2, 'Ring', '7.530', '3200', '450', '', '', '', '', NULL, '27484.50', NULL, '27485.00', '', 0, '0000-00-00 00:00:00', '2019-06-05 17:46:03'),
(12, 6, 14, 'Hathsankar', '', '', '', '', '', '', '', NULL, '2300.80', '186.00', '2115.00', '', 0, '0000-00-00 00:00:00', '2019-06-05 17:46:03'),
(13, 7, 16, 'necklace', '', '', '', '', '', '', '', NULL, '2500.00', NULL, '2500.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 19:26:24'),
(14, 8, 2, 'Tika', '4.570', '3200', '400', '', '', '', '', NULL, '16452.00', '152.00', '16300.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 19:29:51'),
(15, 9, 14, 'hathsankar', '', '', '', '', '', '', '', NULL, '2500.00', NULL, '2500.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 19:38:40'),
(16, 10, 14, 'payal', '165', '40', '8', '', '', '', '', NULL, '7920.00', '20.00', '7900.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 19:39:19'),
(17, 11, 2, 'Ring', '1.311', '3200', '411', '', '', '', '', NULL, '4734.02', NULL, '4734.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 20:15:42'),
(18, 11, 2, 'Earing', '4.577', '3200', '400', '', '', '', '', NULL, '16477.20', NULL, '16477.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 20:16:37'),
(19, 11, 14, 'Hathsankar', '', '', '', '', '', '', '', NULL, '1723.00', NULL, '1723.00', '', 0, '0000-00-00 00:00:00', '2019-06-07 20:16:37'),
(20, 12, 2, 'necklace', '22.572', '3200', '400', '', '', '', '', NULL, '81259.20', '100.00', '81159.00', '', 0, '0000-00-00 00:00:00', '2019-06-08 14:17:13'),
(21, 12, 14, 'Hathsankar', '', '', '', '', '', '', '', NULL, '2341.00', NULL, '2341.00', '', 0, '0000-00-00 00:00:00', '2019-06-08 14:17:13'),
(22, 12, 16, 'Ring', '', '', '', '', '', '', '', NULL, '400.00', NULL, '400.00', '', 1, '2019-06-26 23:50:52', '2019-06-08 14:18:10'),
(23, 13, 16, 'necklace', '', '', '', '', '', '', '', NULL, '1200.00', NULL, '1200.00', '', 1, '0000-00-00 00:00:00', '2019-06-25 18:37:28');

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
  `total_amount` decimal(10,2) NOT NULL,
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

INSERT INTO `order_transactions` (`id`, `order_id`, `amount_paid`, `invoice_number`, `type`, `total_amount`, `item`, `metal_type`, `weight`, `return_percentage`, `rate`, `cheque_number`, `bank_name`, `transaction_date`, `payment_transaction_id`, `comments`, `status`, `created`) VALUES
(1, 1, '5500.00', '849811559455794', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:09:54'),
(2, 1, '1200.00', '736311559455826', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:10:26'),
(3, 1, '200.00', '1842311559456315', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:18:36'),
(4, 1, '100.00', '1821211559456320', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:18:40'),
(5, 1, '400.00', '2690511559456328', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:18:48'),
(6, 1, '200.00', '2977311559456333', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:18:53'),
(7, 1, '200.00', '1859011559456347', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:07'),
(8, 1, '250.00', '2937611559456354', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:14'),
(9, 1, '350.00', '83111559456359', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:19'),
(10, 1, '100.00', '2296911559456364', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:24'),
(11, 1, '100.00', '1522311559456386', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:46'),
(12, 1, '200.00', '2375611559456392', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:52'),
(13, 1, '200.00', '735811559456396', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:19:56'),
(14, 1, '100.00', '2986011559456401', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:20:01'),
(15, 1, '300.00', '3027511559456407', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 06:20:07'),
(16, 2, '1200.00', '2427321559503118', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 19:18:38'),
(17, 2, '1200.00', '452621559503615', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-02 19:26:55'),
(18, 3, '5500.00', '898631559676867', 'cash', '0.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-04 19:34:27'),
(19, 3, '3600.00', '2636931559677211', 'metal', '0.00', 'Nose pin, Tops', 'gold', '1.780', '65', '2700', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-04 19:40:11'),
(20, 3, '2400.00', '622831559677570', 'cheque', '0.00', '', '', '', NULL, '', '345TREW234', 'HDFC', '2019-06-03 05:00:00', '', 'cheque payment', NULL, '2019-06-04 19:46:10'),
(21, 3, '300.00', '2891031559677891', 'metal', '0.00', 'Nosepin', 'gold', '0.230', '55', '2600', '', '', '2019-06-04 19:51:31', '', '', NULL, '2019-06-04 19:51:31'),
(22, 3, '8700.00', '1558031559677958', 'cheque', '0.00', '', '', '', NULL, '', '234RDERT', 'HDFC', '2019-06-04 09:05:00', '', '', NULL, '2019-06-04 19:52:38'),
(23, 4, '7700.00', '922141559678592', 'cheque', '0.00', '', '', '', NULL, '', '3456TRE45', 'HDFC', '2019-06-03 10:50:00', '', '', NULL, '2019-06-04 20:03:12'),
(24, 6, '15600.00', '1371961559756803', 'cash', '0.00', '', '', '', NULL, '', '', '', '2019-06-05 17:46:43', '', '', NULL, '2019-06-05 17:46:43'),
(25, 5, '5200.00', '3254251559822552', 'cash', '5200.00', '', '', '', NULL, '', '', '', '2019-06-06 12:02:32', '', '', NULL, '2019-06-06 12:02:32'),
(26, 5, '22000.50', '1125951559822592', 'cheque', '25000.50', '', '', '', NULL, '', 'SD5432WDF', 'HDFC', '2019-06-05 10:05:00', '', '', NULL, '2019-06-06 12:03:12'),
(27, 7, '1200.00', '1928371559935595', 'cash', '1200.00', '', '', '', NULL, '', '', '', '2019-06-07 19:26:35', '', '', NULL, '2019-06-07 19:26:35'),
(28, 8, '15000.00', '2310081559935816', 'cash', '15000.00', '', '', '', NULL, '', '', '', '2019-06-07 19:30:16', '', '', NULL, '2019-06-07 19:30:16'),
(29, 9, '1200.00', '972291559936334', 'cash', '1200.00', '', '', '', NULL, '', '', '', '2019-06-07 19:38:54', '', '', NULL, '2019-06-07 19:38:54'),
(30, 10, '6500.00', '6797101559936368', 'cash', '6500.00', '', '', '', NULL, '', '', '', '2019-06-07 19:39:28', '', '', NULL, '2019-06-07 19:39:28'),
(31, 11, '12034.00', '1477111559938634', 'cash', '12034.00', '', '', '', NULL, '', '', '', '2019-06-07 20:17:14', '', '', NULL, '2019-06-07 20:17:14'),
(32, 12, '25900.00', '5527121560003558', 'cash', '25900.00', '', '', '', NULL, '', '', '', '2019-06-08 14:19:18', '', '', NULL, '2019-06-08 14:19:18'),
(33, 7, '200.00', '2885371560100139', 'cash', '200.00', '', '', '', NULL, '', '', '', '2019-06-09 17:08:59', '', '', NULL, '2019-06-09 17:08:59'),
(34, 11, '9200.00', '29975111560249669', 'wallet', '9200.00', '', '', '', NULL, '', '', '', '0000-00-00 00:00:00', '', '', NULL, '2019-06-11 10:41:09'),
(35, 11, '700.00', '20484111560249893', 'wallet', '700.00', '', '', '', NULL, '', '', '', '2019-06-11 10:44:53', '', '', NULL, '2019-06-11 10:44:53'),
(36, 6, '4000.00', '2292361560878132', 'net-banking', '4000.00', '', '', '', NULL, '', '', 'ICICI', '2019-06-15 10:00:00', '34TD345REWQ234', '', NULL, '2019-06-18 17:15:32'),
(37, 12, '7000.00', '17436121561485861', 'debit-card', '7000.00', '', '', '', NULL, '', '', 'SBI', '2019-06-25 12:30:00', '765RTJHG7898', '', NULL, '2019-06-25 18:04:21'),
(38, 13, '600.00', '30248131561487860', 'cash', '600.00', '', '', '', NULL, '', '', '', '2019-06-25 18:37:40', '', '', NULL, '2019-06-25 18:37:41'),
(39, 6, '2400.00', '1911461561654916', 'wallet', '2400.00', '', '', '', NULL, '', '', '', '2019-06-27 17:01:56', '', '', NULL, '2019-06-27 17:01:56');

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
(2, 'Mani', '7277568289', 'mani@gmail.com', 'Mani company', 'tola road', 1, '2018-07-18 12:34:57'),
(3, 'Vinod', '9182938818', 'vinod@gmail.com', 'DurgaLaxmi', 'clubRoad', 1, '2018-07-20 12:57:22'),
(4, 'Test name', '9867238762', 'rohtakjewel@gmail.com', 'Rohtak Jewellers', 'kucha mahajani, new delhi', 1, '2019-06-12 22:29:16'),
(5, 'Test name', '9867238762', 'rohtakjewel@gmail.com', 'Rohtak Jewellers', 'kucha mahajani, new delhi', 1, '2019-06-12 22:29:16'),
(6, 'final test', '7890987678', 'rohtakjewel1232@gmail.com', 'Rohtak Jewellers', 'kucha mahajani, new delhi', 1, '2019-06-12 22:29:44');

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
  `type` enum('user','admin') NOT NULL DEFAULT 'user',
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `address`, `username`, `password`, `email`, `status`, `hash_token`, `type`, `role`, `created`) VALUES
(1, 'gaurav', '9872137829', 'muzafafrpur', 'gaurav', '2a0143b5f42b00035a430b57d37d035ac3295a6c', 'gauravranjan39@gmail.com', 1, NULL, 'admin', '1', '2018-07-14 11:28:40'),
(9, 'Satkar Jewellers', '9708104752', 'Purani bazar, sabji mandi', 'satkar@gmail.com', '2a0143b5f42b00035a430b57d37d035ac3295a6c', 'satkar@gmail.com', 1, '1560194762', 'user', '1', '2019-06-11 00:56:02');

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
  `type` enum('pay-dues','cash','metal','cheque','net-banking','credit-card','debit-card','return-item','cancel-order','delete-item','add-item') NOT NULL DEFAULT 'cash',
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
(1, 8, 1, '8197981559417573', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-02 06:41:22', NULL, 'return-item', '1750.00', NULL, '1750.00', 0, NULL, 1, '2019-06-02 06:41:22'),
(2, 8, 1, '8197981559417573', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-02 19:08:21', NULL, 'cancel-order', '7650.00', NULL, '9400.00', 0, NULL, 1, '2019-06-02 19:08:21'),
(3, 11, 3, '1136791559676738', NULL, NULL, NULL, NULL, NULL, NULL, '234RDERT', 'HDFC', '2019-06-04 09:05:00', NULL, 'cheque', '7000.00', NULL, '7000.00', 0, '', 1, '2019-06-04 19:52:38'),
(4, 11, 3, '1136791559676738', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-04 19:54:23', NULL, 'return-item', '2200.00', NULL, '9200.00', 0, NULL, 1, '2019-06-04 19:54:23'),
(5, 2, 4, '2162361559678372', NULL, NULL, NULL, NULL, NULL, NULL, '3456TRE45', 'HDFC', '2019-06-03 10:50:00', NULL, 'cheque', '7300.00', NULL, '7300.00', 0, '', 1, '2019-06-04 20:03:12'),
(6, 5, 5, '574461559755834', NULL, NULL, NULL, NULL, NULL, NULL, 'SD5432WDF', 'HDFC', '2019-06-05 10:05:00', NULL, 'cheque', '3000.00', NULL, '3000.00', 0, '', 1, '2019-06-06 12:03:12'),
(7, 11, 11, '11300061559938542', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 10:41:09', NULL, 'pay-dues', NULL, '9200.00', '0.00', 0, NULL, 1, '2019-06-11 10:41:09'),
(8, 11, NULL, NULL, NULL, '', '', '', NULL, NULL, '', '', '2019-06-11 10:44:35', '', 'cash', '700.00', NULL, '700.00', 0, '', 1, '2019-06-11 10:44:35'),
(9, 11, 11, '11300061559938542', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 10:44:53', NULL, 'pay-dues', NULL, '700.00', '0.00', 0, NULL, 1, '2019-06-11 10:44:53'),
(10, 8, NULL, NULL, NULL, '', '', '', NULL, NULL, '', '', '2019-06-12 17:48:17', '', 'cash', '12000.00', NULL, '21400.00', 0, 'Advance payment for new order', 1, '2019-06-12 17:48:17'),
(11, 3, 2, '3177761559503106', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-25 18:35:28', NULL, 'cancel-order', '2400.00', NULL, '2400.00', 0, NULL, 1, '2019-06-25 18:35:28'),
(12, 2, 4, '2162361559678372', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-25 18:47:15', NULL, 'cancel-order', '7700.00', NULL, '15000.00', 0, NULL, 1, '2019-06-25 18:47:15'),
(13, 3, 6, '335361559756763', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-27 17:01:55', NULL, 'pay-dues', NULL, '2400.00', '0.00', 0, NULL, 1, '2019-06-27 17:01:55'),
(14, 11, NULL, NULL, NULL, '', '', '', NULL, NULL, '', '', '2019-07-12 19:03:24', '', 'cash', '13000.00', NULL, '13000.00', 0, 'Advance payment', 1, '2019-07-12 19:03:24'),
(17, 8, NULL, NULL, NULL, '', '', '', NULL, NULL, '', '', '2019-07-15 17:40:30', '', 'cash', NULL, '1400.00', '20000.00', 0, 'Return with cash', 1, '2019-07-15 17:40:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD CONSTRAINT `order_transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `wallets_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
