-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 12:46 PM
-- Server version: 8.0.27-0ubuntu0.21.04.1
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `single-leg`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`sonu`@`localhost` PROCEDURE `checkLike` (`wherePostId` INTEGER(11), `whereUserId` VARCHAR(15))  BEGIN
	SELECT isLike  FROM posts_like WHERE post_id = wherePostId and user_id = whereUserId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `api_registration`
--

CREATE TABLE `api_registration` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `beneficiary_name` varchar(60) NOT NULL,
  `ifsc` varchar(14) NOT NULL,
  `bank_id` varchar(90) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `state_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('23056d1285e9542a209102b133c5bc22', '::1', 1636257601, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235373630313b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('2498fce151693ec3e67de937d6ec9d47', '::1', 1636257601, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235373630313b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('42449abaa2158a73bca7230dd52c8cac', '::1', 1636255599, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235353539393b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('4f332b9335e76fbe4cd5efebbb276543', '::1', 1636294861, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239343433363b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a223230633466663732383036343962326362346562666463336163653966313531223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('5tqgvlfu6e3i5ldqfvgobh56lc', '::1', 1636367843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363336373834333b),
('6d4bf8c05854c92d6cac8a49a37b97a4', '::1', 1636346106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334363130363b),
('7eshg04qobopj2iud1bb2dka5u', '::1', 1636441177, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434313137373b),
('7our8bfcrtu9smn7a47i69ms0r', '::1', 1636441649, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434313230373b),
('8912dfdbf5beb6a63c4aeaa90f2ea671', '::1', 1636253323, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235333332333b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('ae1cbb71ccb1347e6717c5c51ca979fe', '::1', 1636254882, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235343838323b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b737563636573737c733a33303a224163636f756e7420416374697661746564205375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('b2bi1kigrh34r5hogusr744lsq', '::1', 1636365967, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363336353339363b),
('cab3edd7c2e80bb818a5e78c841825e6', '::1', 1636346125, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334363132353b),
('d13406fa61998644e8b1efeb392174de', '::1', 1636256990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363235363939303b61646d696e5f69647c733a353a2261646d696e223b61646d696e5f726f6c657c733a353a2241444d494e223b7365637572655f69647c733a33323a226638343738306561343063353864623534633136353162366530366332343436223b7365637572655f61646d696e5f69647c733a31333a227365637572655f61646d696e32223b757365725f69647c733a353a2261646d696e223b726f6c657c733a313a224d223b),
('d388oeu798pvqgqf618ccs664c', '::1', 1636366186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363336363138363b),
('dda6aed32fb96711539074f87999d37c', '::1', 1636294436, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239343433363b),
('g0kqfiobhe5ooatoe434ddj8ft', '::1', 1636367854, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363336373834333b);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_url` varchar(600) NOT NULL,
  `post_id` int NOT NULL,
  `comment` varchar(500) NOT NULL,
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `profile_url`, `post_id`, `comment`, `isActive`, `created_at`) VALUES
(1, '', '', 1, 'This is testing', 1, '2021-10-18 16:36:05'),
(2, '', '', 1, 'This is testing', 1, '2021-10-18 16:38:59'),
(3, '', '', 1, 'This is testing', 1, '2021-10-18 16:39:54'),
(4, '', '', 1, 'This is testing', 1, '2021-10-18 16:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `permotion`
--

CREATE TABLE `permotion` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `url` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permotion2`
--

CREATE TABLE `permotion2` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `url` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `profile_url` varchar(600) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `image` varchar(600) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `likes` int NOT NULL,
  `comments` int NOT NULL,
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `profile_url`, `name`, `user_id`, `image`, `text`, `likes`, `comments`, `isActive`, `created_at`) VALUES
(1, '', '', 'admin', 'as1634551279.png', '', 1, 2, 1, '2021-10-18 15:31:19'),
(2, '', '', 'admin', 'uploads/as1634551305.png', '', 0, 0, 1, '2021-10-18 15:31:45'),
(3, '', '', 'admin', 'uploads/as1634551529.png', '', 0, 0, 1, '2021-10-18 15:35:29'),
(4, '', 'MLM SOFT SOLUTIONS', 'admin', 'uploads/as1634704283', '', 0, 0, 1, '2021-10-20 10:01:23'),
(5, '', 'MLM SOFT SOLUTIONS', 'admin', 'uploads/as1634704345.png', '', 22, 0, 1, '2021-10-20 10:02:25'),
(6, '', 'MLM SOFT SOLUTIONS', 'admin', 'uploads/as1634704358', 'asdad', 0, 0, 1, '2021-10-20 10:02:38'),
(7, '', 'MLM SOFT SOLUTIONS', 'admin', '', 'asdad', 1, 0, 1, '2021-10-20 10:04:36'),
(8, '', 'MLM SOFT SOLUTIONS', 'admin', '', 'asdad', 0, 0, 1, '2021-10-20 14:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts_like`
--

CREATE TABLE `posts_like` (
  `id` int NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `post_id` int NOT NULL,
  `isLike` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts_like`
--

INSERT INTO `posts_like` (`id`, `user_id`, `post_id`, `isLike`, `created_at`) VALUES
(5, 'admin', 5, 1, '2021-10-20 12:11:01'),
(6, 'admin', 7, 1, '2021-10-20 12:57:32'),
(7, 'admin', 28, 1, '2021-10-20 13:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `timmer` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `timmer`, `created_at`) VALUES
(1, 30, '2021-11-08 16:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_achievers`
--

CREATE TABLE `tbl_achievers` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_beneficiary`
--

CREATE TABLE `tbl_add_beneficiary` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `beneficiary_bank` varchar(60) NOT NULL,
  `beneficiary_name` varchar(60) NOT NULL,
  `beneficiary_account_no` varchar(60) NOT NULL,
  `beneficiary_branch` varchar(255) NOT NULL,
  `beneficiary_ifsc` varchar(30) NOT NULL,
  `beneficiary_mobile` varchar(20) NOT NULL,
  `account_ifsc` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_add_beneficiary`
--

INSERT INTO `tbl_add_beneficiary` (`id`, `user_id`, `beneficiary_bank`, `beneficiary_name`, `beneficiary_account_no`, `beneficiary_branch`, `beneficiary_ifsc`, `beneficiary_mobile`, `account_ifsc`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '', '', '', '', '', '', '2021-10-04 08:24:26', '2021-10-04 08:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `master_key` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `access` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `withdraw_status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `user_id`, `password`, `phone`, `master_key`, `role`, `access`, `email`, `name`, `withdraw_status`, `created_at`) VALUES
(1, 'admin', 'admin', '', '7777', 'A', '', '', 'Linear Pay', 0, '2020-11-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_details`
--

CREATE TABLE `tbl_bank_details` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `totalBalance` float NOT NULL DEFAULT '0',
  `nominee_name` varchar(50) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(50) NOT NULL,
  `account_holder_name` varchar(20) NOT NULL,
  `aadhar` varchar(50) NOT NULL,
  `pan` varchar(50) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `bank_account` varchar(40) NOT NULL,
  `kyc_status` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank_details`
--

INSERT INTO `tbl_bank_details` (`id`, `user_id`, `totalBalance`, `nominee_name`, `bank_name`, `bank_account_number`, `account_holder_name`, `aadhar`, `pan`, `ifsc_code`, `bank_account`, `kyc_status`, `created_at`) VALUES
(1, 'admin', 125, '', NULL, '', '', '', '', '', '', 0, '2021-11-06 20:32:41'),
(2, 'PSB883001', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:08:00'),
(3, 'PSB115008', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:10:10'),
(4, '383052', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:19:41'),
(5, '586884', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:22:45'),
(6, '701199', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:45:05'),
(7, '435735', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:46:26'),
(8, '336861', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:48:07'),
(9, '853919', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:48:24'),
(10, '698205', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:48:35'),
(11, '775307', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:48:45'),
(12, '397419', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:49:02'),
(13, '287196', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:49:25'),
(14, '572397', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-07 08:49:39'),
(15, '474788', 0, '', NULL, '', '', '', '', '', '', 0, '2021-11-08 15:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cron`
--

CREATE TABLE `tbl_cron` (
  `id` int NOT NULL,
  `cron_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_double_roi`
--

CREATE TABLE `tbl_double_roi` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `level` int NOT NULL,
  `days` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_downline_count`
--

CREATE TABLE `tbl_downline_count` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `position` varchar(5) NOT NULL,
  `downline_id` varchar(20) NOT NULL,
  `level` int NOT NULL,
  `paid_status` int NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `activeDate` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_downline_count`
--

INSERT INTO `tbl_downline_count` (`id`, `user_id`, `position`, `downline_id`, `level`, `paid_status`, `amount`, `activeDate`, `created_at`) VALUES
(1, 'admin', '', 'PSB883001', 1, 0, 0, NULL, '2021-11-07 08:08:00'),
(2, 'PSB883001', '', 'PSB115008', 1, 0, 0, NULL, '2021-11-07 08:10:10'),
(3, 'admin', '', 'PSB115008', 2, 0, 0, NULL, '2021-11-07 08:10:10'),
(4, 'PSB115008', '', '383052', 1, 1, 25, NULL, '2021-11-07 08:19:41'),
(5, 'PSB883001', '', '383052', 2, 1, 25, NULL, '2021-11-07 08:19:41'),
(6, 'admin', '', '383052', 3, 1, 25, NULL, '2021-11-07 08:19:41'),
(7, '383052', '', '586884', 1, 1, 25, '2021-11-07 08:22:58', '2021-11-07 08:22:45'),
(8, 'PSB115008', '', '586884', 2, 1, 25, '2021-11-07 08:22:58', '2021-11-07 08:22:45'),
(9, 'PSB883001', '', '586884', 3, 1, 25, '2021-11-07 08:22:58', '2021-11-07 08:22:45'),
(10, 'admin', '', '586884', 4, 1, 25, '2021-11-07 08:22:58', '2021-11-07 08:22:45'),
(11, '586884', '', '701199', 1, 1, 25, '2021-11-07 08:45:17', '2021-11-07 08:45:05'),
(12, '383052', '', '701199', 2, 1, 25, '2021-11-07 08:45:17', '2021-11-07 08:45:05'),
(13, 'PSB115008', '', '701199', 3, 1, 25, '2021-11-07 08:45:17', '2021-11-07 08:45:05'),
(14, 'PSB883001', '', '701199', 4, 1, 25, '2021-11-07 08:45:17', '2021-11-07 08:45:05'),
(15, 'admin', '', '701199', 5, 1, 25, '2021-11-07 08:45:17', '2021-11-07 08:45:05'),
(16, 'admin', '', '435735', 1, 1, 25, '2021-11-07 08:46:40', '2021-11-07 08:46:26'),
(17, 'admin', '', '336861', 1, 1, 25, '2021-11-07 08:50:24', '2021-11-07 08:48:07'),
(18, 'admin', '', '853919', 1, 1, 25, '2021-11-07 08:50:35', '2021-11-07 08:48:24'),
(19, 'admin', '', '698205', 1, 1, 25, '2021-11-07 08:50:48', '2021-11-07 08:48:35'),
(20, 'admin', '', '775307', 1, 1, 25, '2021-11-07 08:50:59', '2021-11-07 08:48:45'),
(21, 'admin', '', '397419', 1, 1, 25, '2021-11-07 08:51:10', '2021-11-07 08:49:02'),
(22, 'admin', '', '287196', 1, 1, 25, '2021-11-07 08:51:22', '2021-11-07 08:49:25'),
(23, 'admin', '', '572397', 1, 1, 25, '2021-11-07 08:51:34', '2021-11-07 08:49:39'),
(24, 'admin', '', '474788', 1, 0, 0, NULL, '2021-11-08 15:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_epins`
--

CREATE TABLE `tbl_epins` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `epin` varchar(100) NOT NULL,
  `amount` int NOT NULL,
  `status` int NOT NULL,
  `sender_id` varchar(50) NOT NULL,
  `used_for` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_epins`
--

INSERT INTO `tbl_epins` (`id`, `user_id`, `epin`, `amount`, `status`, `sender_id`, `used_for`, `created_at`) VALUES
(1, 'admin', '3e3106faab596d72c71674228c0aa443', 25, 1, '', 'PSB147693', '2021-11-06 20:33:25'),
(2, 'admin', '3f9f9974b15e202853f78818da81d7b5', 25, 1, '', 'PSB883001', '2021-11-06 20:33:25'),
(3, 'admin', '05b754aae73a0ff2c5b144a9731ceb7f', 25, 1, '', 'PSB115008', '2021-11-06 20:33:25'),
(4, 'admin', '125ea333c3c6a830962472b813280634', 25, 1, '', '383052', '2021-11-06 20:33:25'),
(5, 'admin', '9f1720f2b0a8a9f3790f5b886d1adc68', 25, 1, '', '586884', '2021-11-06 20:33:25'),
(6, 'admin', '0ed37bd7cc6622661d58bf4cd210e22f', 25, 1, '', '701199', '2021-11-06 20:33:25'),
(7, 'admin', '13d8277cf2231b65aa393b81c85a33c2', 25, 1, '', '435735', '2021-11-06 20:33:25'),
(8, 'admin', 'd27a082324d4dacbd192e7d84267008c', 25, 1, '', '336861', '2021-11-06 20:33:25'),
(9, 'admin', '0ca50c0333373c17a0291b7e36f40315', 25, 1, '', '853919', '2021-11-06 20:33:25'),
(10, 'admin', 'e090b87d8c9d33f4fef44fc02112e2a6', 25, 1, '', '698205', '2021-11-06 20:33:25'),
(11, 'admin', '1f022f00a1b0332c721979dc2cc9b850', 25, 1, '', '775307', '2021-11-07 08:50:05'),
(12, 'admin', '8597359a33878d3b4a8da81e6d7c8ca4', 25, 1, '', '397419', '2021-11-07 08:50:05'),
(13, 'admin', '0dd3b65de8eaec04141c9287528fe5f2', 25, 1, '', '287196', '2021-11-07 08:50:05'),
(14, 'admin', 'a721fd5def7eabc2b1ee4a96f0642c89', 25, 1, '', '572397', '2021-11-07 08:50:05'),
(15, 'admin', '42980e9ae7ee09cf80496e100bcb0067', 25, 0, '', '', '2021-11-07 08:50:05'),
(16, 'admin', '5afc7614b1cee6889dbd4f633aa84e77', 25, 0, '', '', '2021-11-07 08:50:05'),
(17, 'admin', 'da3255fe87407b7e7852364fe26b5764', 25, 0, '', '', '2021-11-07 08:50:05'),
(18, 'admin', '5418e7d1974098b1c56d24540963da23', 25, 0, '', '', '2021-11-07 08:50:05'),
(19, 'admin', '93606de0447618ded4d07c4808068ade', 25, 0, '', '', '2021-11-07 08:50:05'),
(20, 'admin', '286ee2155505f2d581a203bc5d5d0245', 25, 0, '', '', '2021-11-07 08:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_franchise`
--

CREATE TABLE `tbl_franchise` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pin_code` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_wallet`
--

CREATE TABLE `tbl_income_wallet` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_income_wallet`
--

INSERT INTO `tbl_income_wallet` (`id`, `user_id`, `amount`, `type`, `description`, `level`, `created_at`) VALUES
(1, 'admin', 0.25, 'direct_income', 'Direct Income from Activation of Member PSB147693', 0, '2021-11-06 20:36:54'),
(7, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member PSB883001', 0, '2021-11-07 08:09:08'),
(8, 'PSB115008', 0.2, 'direct_income', 'Direct Income from Activation of Member 383052', 0, '2021-11-07 08:19:55'),
(9, '383052', 0.2, 'direct_income', 'Direct Income from Activation of Member 586884', 0, '2021-11-07 08:22:58'),
(10, '586884', 0.2, 'direct_income', 'Direct Income from Activation of Member 701199', 0, '2021-11-07 08:45:17'),
(11, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 435735', 0, '2021-11-07 08:46:40'),
(12, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 336861', 0, '2021-11-07 08:50:24'),
(13, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 853919', 0, '2021-11-07 08:50:35'),
(14, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 698205', 0, '2021-11-07 08:50:48'),
(15, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 775307', 0, '2021-11-07 08:50:59'),
(16, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 397419', 0, '2021-11-07 08:51:10'),
(17, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 287196', 0, '2021-11-07 08:51:22'),
(18, 'admin', 0.2, 'direct_income', 'Direct Income from Activation of Member 572397', 0, '2021-11-07 08:51:34'),
(19, 'admin', 25, 'fast_income', 'Fast Income at 10 directs', 0, '2021-11-07 09:02:39'),
(22, 'admin', 250, 'club_income', 'Club Income at Second Level', 0, '2021-11-07 09:25:38'),
(24, 'admin', -50, 'upgrade_deduction', 'Deducted for upgrade', 0, '2021-11-07 19:47:52'),
(25, 'admin', -25, 'withdraw_request', 'Deducted for upgrade', 0, '2021-11-07 19:47:52'),
(26, 'admin', -100, 'upgrade_deduction', 'Deducted for upgrade', 0, '2021-11-07 19:48:47'),
(27, 'admin', -50, 'withdraw_request', 'Deducted for upgrade', 0, '2021-11-07 19:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_money_transfer`
--

CREATE TABLE `tbl_money_transfer` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `beneficiaryid` varchar(50) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `operatortxnid` varchar(30) NOT NULL,
  `joloorderid` varchar(30) NOT NULL,
  `userorderid` varchar(30) NOT NULL,
  `payable_amount` varchar(30) NOT NULL,
  `tds` varchar(30) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `duration` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `news` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_non_working_wallet`
--

CREATE TABLE `tbl_non_working_wallet` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `bv` int NOT NULL,
  `commision` int NOT NULL,
  `direct_income` varchar(50) NOT NULL,
  `level_income` varchar(100) NOT NULL,
  `products` varchar(255) NOT NULL,
  `capping` int NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `title`, `description`, `price`, `bv`, `commision`, `direct_income`, `level_income`, `products`, `capping`, `image`, `created_at`) VALUES
(1, 'Activation Package of Rs. 10/-', 'Activation Package of Rs. 10/-', 10, 0, 0, '0.2', '', '', 0, '', '2021-04-14 13:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_request`
--

CREATE TABLE `tbl_payment_request` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_point_matching_income`
--

CREATE TABLE `tbl_point_matching_income` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `left_bv` int NOT NULL,
  `right_bv` int NOT NULL,
  `amount` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pool`
--

CREATE TABLE `tbl_pool` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `upline_id` varchar(30) NOT NULL,
  `level1` int NOT NULL,
  `level2` int NOT NULL,
  `level3` int NOT NULL,
  `level4` int NOT NULL,
  `level5` int NOT NULL,
  `level6` int NOT NULL,
  `level7` int NOT NULL,
  `down_node` int NOT NULL,
  `income_status` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popup`
--

CREATE TABLE `tbl_popup` (
  `id` int NOT NULL,
  `media` varchar(5000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repurchase_income`
--

CREATE TABLE `tbl_repurchase_income` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roi`
--

CREATE TABLE `tbl_roi` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `level` int NOT NULL,
  `days` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider_images`
--

CREATE TABLE `tbl_slider_images` (
  `id` int NOT NULL,
  `image` varchar(50) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_counter`
--

CREATE TABLE `tbl_sms_counter` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `message` varchar(300) NOT NULL,
  `response` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_counter`
--

INSERT INTO `tbl_sms_counter` (`id`, `user_id`, `message`, `response`, `created_at`) VALUES
(1, 'PSB147693', 'Dear+test%2C+Your+Account+Successfully+created.+User+ID%3A+PSB147693+Password%3A+470177+Txn+Password%3A+6101+For+more+detail+visit+http%3A%2F%2Flocalhost%2Fprojects%2Fclient-single-leg%2Fclient-single-leg%2F', 'ERR: Your SMS credit balance is not sufficient for you to shoot these much SMS OR Your validity has expired. Kindly get your account recharged with more credits and/or get your validity period extended.', '2021-11-06 20:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support_message`
--

CREATE TABLE `tbl_support_message` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(3000) NOT NULL,
  `status` int NOT NULL,
  `remark` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `tasks` int NOT NULL,
  `redeem` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_counter`
--

CREATE TABLE `tbl_task_counter` (
  `id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `task_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_links`
--

CREATE TABLE `tbl_task_links` (
  `id` int NOT NULL,
  `link` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sponser_id` varchar(20) NOT NULL,
  `master_key` int NOT NULL,
  `paid_status` int NOT NULL,
  `package_id` int NOT NULL,
  `package_amount` int NOT NULL,
  `retopup_count` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `postal_code` int NOT NULL,
  `directs` int NOT NULL,
  `upgrade_directs` int NOT NULL DEFAULT '0',
  `paid_team_count` int NOT NULL,
  `after_paid_users` int NOT NULL,
  `total_user_after_paid` int NOT NULL,
  `upgrade_total_user_after_paid` int NOT NULL DEFAULT '0',
  `single_leg_status` int NOT NULL,
  `double_leg_status` int NOT NULL DEFAULT '0',
  `image` varchar(30) NOT NULL,
  `refferal_count` int NOT NULL,
  `courtesy_title` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL,
  `disabled` int NOT NULL,
  `withdraw_status` int NOT NULL,
  `fake_id` int NOT NULL DEFAULT '0',
  `royalty_status` int NOT NULL DEFAULT '0',
  `leadership_status` int NOT NULL DEFAULT '0',
  `reward_status` int NOT NULL DEFAULT '0',
  `fastIncome` float NOT NULL DEFAULT '0',
  `upgrade_status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `topup_date` datetime NOT NULL,
  `upgrade_date` timestamp NULL DEFAULT NULL,
  `timmer` datetime DEFAULT NULL,
  `task` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_id`, `password`, `sponser_id`, `master_key`, `paid_status`, `package_id`, `package_amount`, `retopup_count`, `name`, `phone`, `first_name`, `last_name`, `address`, `email`, `country`, `city`, `state`, `country_code`, `postal_code`, `directs`, `upgrade_directs`, `paid_team_count`, `after_paid_users`, `total_user_after_paid`, `upgrade_total_user_after_paid`, `single_leg_status`, `double_leg_status`, `image`, `refferal_count`, `courtesy_title`, `role`, `disabled`, `withdraw_status`, `fake_id`, `royalty_status`, `leadership_status`, `reward_status`, `fastIncome`, `upgrade_status`, `created_at`, `topup_date`, `upgrade_date`, `timmer`, `task`) VALUES
(1, 'admin', 'mlm_company', '', 7777, 1, 1, 10, 0, 'Linear Pay', '123456789', '', '', '', 'linearpay@gmail.com', '', '', '', '', 0, 10, 0, 12, 0, 2, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 25, 2, '2021-10-04 08:24:10', '2021-11-01 08:24:10', '2021-10-04 08:24:10', '2021-11-09 12:31:07', 0),
(2, 'PSB147693', '470177', 'admin', 6101, 1, 1, 10, 0, 'test', '9876543210', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 2, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-06 20:32:41', '2021-11-06 20:36:54', '0000-00-00 00:00:00', NULL, 0),
(3, 'PSB883001', '802870', 'admin', 7120, 1, 1, 10, 0, 'test1', '9876543210', '', '', '', 'test1@gmail.com', '', '', '', '', 0, 1, 0, 3, 0, 1, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:08:00', '2021-11-07 08:09:08', '0000-00-00 00:00:00', NULL, 0),
(4, 'PSB115008', '335055', 'PSB883001', 5178, 1, 1, 10, 0, 'test2', '9876543210', '', '', '', 'test2@gmail.com', '', '', '', '', 0, 1, 0, 3, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:10:10', '2021-11-07 08:18:59', '0000-00-00 00:00:00', NULL, 0),
(5, '383052', '992492', 'PSB115008', 2051, 1, 1, 10, 0, 'test3', '9876543211', '', '', '', 'test3@gmail.com', '', '', '', '', 0, 1, 0, 2, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:19:41', '2021-11-07 08:19:55', '0000-00-00 00:00:00', NULL, 0),
(6, '586884', '551105', '383052', 4274, 1, 1, 10, 0, 'test4', '9876543212', '', '', '', 'test4@gmail.com', '', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:22:45', '2021-11-07 08:22:58', '0000-00-00 00:00:00', NULL, 0),
(7, '701199', '395381', '586884', 8731, 1, 1, 10, 0, 'test5', '9876543212', '', '', '', 'test5@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:45:05', '2021-11-07 08:45:17', NULL, NULL, 0),
(8, '435735', '532714', 'admin', 6835, 1, 1, 10, 0, 'test5', '9876543213', '', '', '', 'test5@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:46:26', '2021-11-07 08:46:40', NULL, NULL, 0),
(9, '336861', '842750', 'admin', 8583, 1, 1, 10, 0, 'test6', '9876543211', '', '', '', 'test6@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:48:07', '2021-11-07 08:50:24', NULL, NULL, 0),
(10, '853919', '505024', 'admin', 9413, 1, 1, 10, 0, 'test', '9876543212', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:48:24', '2021-11-07 08:50:35', NULL, NULL, 0),
(11, '698205', '647977', 'admin', 3580, 1, 1, 10, 0, 'test', '9876543213', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:48:35', '2021-11-07 08:50:48', NULL, NULL, 0),
(12, '775307', '547761', 'admin', 4491, 1, 1, 10, 0, 'test', '9876543214', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:48:45', '2021-11-07 08:50:59', NULL, NULL, 0),
(13, '397419', '435538', 'admin', 6202, 1, 1, 10, 0, 'test', '9876543213', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:49:02', '2021-11-07 08:51:10', NULL, NULL, 0),
(14, '287196', '251008', 'admin', 8223, 1, 1, 10, 0, 'test', '9876543212', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:49:25', '2021-11-07 08:51:22', NULL, NULL, 0),
(15, '572397', '872536', 'admin', 7546, 1, 1, 10, 0, 'test', '9876543212', '', '', '', 'test@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-07 08:49:39', '2021-11-07 08:51:34', NULL, NULL, 0),
(16, '474788', '250298', 'admin', 4457, 0, 0, 10, 0, 'inder sein', '9815376872', '', '', '', 'indersein416@gmail.com', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-08 15:26:56', '0000-00-00 00:00:00', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraw`
--

CREATE TABLE `tbl_withdraw` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `tds` float NOT NULL,
  `admin_charges` float NOT NULL,
  `fund_conversion` float NOT NULL,
  `payable_amount` float NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` int NOT NULL,
  `remark` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraw_transaction`
--

CREATE TABLE `tbl_withdraw_transaction` (
  `id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_callback`
--

CREATE TABLE `test_callback` (
  `id` int NOT NULL,
  `post_data` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_registration`
--
ALTER TABLE `api_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `ci_session`
--
ALTER TABLE `ci_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`),
  ADD KEY `id` (`id`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `data` (`data`(3072));

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `isActive` (`isActive`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `sortname` (`sortname`),
  ADD KEY `name` (`name`),
  ADD KEY `phonecode` (`phonecode`);

--
-- Indexes for table `permotion`
--
ALTER TABLE `permotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `name` (`name`),
  ADD KEY `phone` (`phone`),
  ADD KEY `status` (`status`),
  ADD KEY `url` (`url`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `permotion2`
--
ALTER TABLE `permotion2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `name` (`name`),
  ADD KEY `phone` (`phone`),
  ADD KEY `status` (`status`),
  ADD KEY `url` (`url`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `isActive` (`isActive`),
  ADD KEY `likes` (`likes`),
  ADD KEY `comments` (`comments`);

--
-- Indexes for table `posts_like`
--
ALTER TABLE `posts_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `isLike` (`isLike`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timmer` (`timmer`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `tbl_achievers`
--
ALTER TABLE `tbl_achievers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_add_beneficiary`
--
ALTER TABLE `tbl_add_beneficiary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `beneficiary_bank` (`beneficiary_bank`),
  ADD KEY `beneficiary_name` (`beneficiary_name`),
  ADD KEY `beneficiary_account_no` (`beneficiary_account_no`),
  ADD KEY `beneficiary_branch` (`beneficiary_branch`),
  ADD KEY `beneficiary_ifsc` (`beneficiary_ifsc`),
  ADD KEY `beneficiary_mobile` (`beneficiary_mobile`),
  ADD KEY `account_ifsc` (`account_ifsc`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bank_details`
--
ALTER TABLE `tbl_bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userIndex` (`user_id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nominee_name` (`nominee_name`),
  ADD KEY `bank_account_number` (`bank_account_number`),
  ADD KEY `account_holder_name` (`account_holder_name`),
  ADD KEY `aadhar` (`aadhar`),
  ADD KEY `pan` (`pan`),
  ADD KEY `ifsc_code` (`ifsc_code`),
  ADD KEY `bank_account` (`bank_account`),
  ADD KEY `kyc_status` (`kyc_status`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `cron_name` (`cron_name`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_double_roi`
--
ALTER TABLE `tbl_double_roi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `amount` (`amount`),
  ADD KEY `type` (`type`),
  ADD KEY `remark` (`remark`),
  ADD KEY `status` (`status`),
  ADD KEY `level` (`level`),
  ADD KEY `days` (`days`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_downline_count`
--
ALTER TABLE `tbl_downline_count`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `position` (`position`),
  ADD KEY `downline_id` (`downline_id`),
  ADD KEY `level` (`level`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_epins`
--
ALTER TABLE `tbl_epins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `epin` (`epin`),
  ADD KEY `amount` (`amount`),
  ADD KEY `status` (`status`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `used_for` (`used_for`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_franchise`
--
ALTER TABLE `tbl_franchise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_income_wallet`
--
ALTER TABLE `tbl_income_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type` (`type`),
  ADD KEY `id` (`id`),
  ADD KEY `amount` (`amount`),
  ADD KEY `description` (`description`),
  ADD KEY `level` (`level`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_money_transfer`
--
ALTER TABLE `tbl_money_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `beneficiaryid` (`beneficiaryid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `amount` (`amount`),
  ADD KEY `status` (`status`),
  ADD KEY `operatortxnid` (`operatortxnid`),
  ADD KEY `joloorderid` (`joloorderid`),
  ADD KEY `userorderid` (`userorderid`),
  ADD KEY `payable_amount` (`payable_amount`),
  ADD KEY `tds` (`tds`),
  ADD KEY `desc` (`desc`),
  ADD KEY `time` (`time`),
  ADD KEY `duration` (`duration`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `news` (`news`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_non_working_wallet`
--
ALTER TABLE `tbl_non_working_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `description` (`description`),
  ADD KEY `price` (`price`),
  ADD KEY `bv` (`bv`),
  ADD KEY `commision` (`commision`),
  ADD KEY `direct_income` (`direct_income`),
  ADD KEY `level_income` (`level_income`),
  ADD KEY `products` (`products`),
  ADD KEY `capping` (`capping`),
  ADD KEY `image` (`image`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_payment_request`
--
ALTER TABLE `tbl_payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_point_matching_income`
--
ALTER TABLE `tbl_point_matching_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pool`
--
ALTER TABLE `tbl_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_repurchase_income`
--
ALTER TABLE `tbl_repurchase_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roi`
--
ALTER TABLE `tbl_roi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `amount` (`amount`),
  ADD KEY `type` (`type`),
  ADD KEY `remark` (`remark`),
  ADD KEY `status` (`status`),
  ADD KEY `level` (`level`),
  ADD KEY `days` (`days`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_slider_images`
--
ALTER TABLE `tbl_slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_counter`
--
ALTER TABLE `tbl_sms_counter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `message` (`message`),
  ADD KEY `response` (`response`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `tbl_support_message`
--
ALTER TABLE `tbl_support_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_counter`
--
ALTER TABLE `tbl_task_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_links`
--
ALTER TABLE `tbl_task_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponserIndex` (`sponser_id`),
  ADD KEY `userIndex` (`user_id`),
  ADD KEY `directs` (`directs`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `id` (`id`),
  ADD KEY `password` (`password`),
  ADD KEY `master_key` (`master_key`),
  ADD KEY `paid_status` (`paid_status`),
  ADD KEY `package_amount` (`package_amount`),
  ADD KEY `retopup_count` (`retopup_count`),
  ADD KEY `name` (`name`),
  ADD KEY `phone` (`phone`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `address` (`address`),
  ADD KEY `email` (`email`),
  ADD KEY `country` (`country`),
  ADD KEY `city` (`city`),
  ADD KEY `state` (`state`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `paid_team_count` (`paid_team_count`),
  ADD KEY `after_paid_users` (`after_paid_users`),
  ADD KEY `total_user_after_paid` (`total_user_after_paid`),
  ADD KEY `single_leg_status` (`single_leg_status`),
  ADD KEY `image` (`image`),
  ADD KEY `refferal_count` (`refferal_count`),
  ADD KEY `courtesy_title` (`courtesy_title`),
  ADD KEY `role` (`role`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `withdraw_status` (`withdraw_status`),
  ADD KEY `fake_id` (`fake_id`),
  ADD KEY `royalty_status` (`royalty_status`),
  ADD KEY `leadership_status` (`leadership_status`),
  ADD KEY `reward_status` (`reward_status`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `topup_date` (`topup_date`);

--
-- Indexes for table `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdraw_transaction`
--
ALTER TABLE `tbl_withdraw_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type` (`type`),
  ADD KEY `id` (`id`),
  ADD KEY `amount` (`amount`),
  ADD KEY `description` (`description`),
  ADD KEY `level` (`level`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permotion`
--
ALTER TABLE `permotion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permotion2`
--
ALTER TABLE `permotion2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts_like`
--
ALTER TABLE `posts_like`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_add_beneficiary`
--
ALTER TABLE `tbl_add_beneficiary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bank_details`
--
ALTER TABLE `tbl_bank_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_double_roi`
--
ALTER TABLE `tbl_double_roi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_downline_count`
--
ALTER TABLE `tbl_downline_count`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_epins`
--
ALTER TABLE `tbl_epins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_income_wallet`
--
ALTER TABLE `tbl_income_wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_money_transfer`
--
ALTER TABLE `tbl_money_transfer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_non_working_wallet`
--
ALTER TABLE `tbl_non_working_wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roi`
--
ALTER TABLE `tbl_roi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sms_counter`
--
ALTER TABLE `tbl_sms_counter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_support_message`
--
ALTER TABLE `tbl_support_message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_withdraw_transaction`
--
ALTER TABLE `tbl_withdraw_transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
