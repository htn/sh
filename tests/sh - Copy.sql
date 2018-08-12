-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2018 at 07:22 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sh`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `taskid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `projectid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `name`, `taskid`, `projectid`, `userid`, `status`, `start_time`, `end_time`, `note`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
(1, 'Scan QR code accept backcover and logo', 'W1273', '6', '3', '11', '2018-07-18', '2018-07-18', '', 3, NULL, '2018-07-18 08:06:38', NULL, 0),
(2, 'Check QR code transfer backcover and logo', 'W1274', '6', '3', '11', '2018-07-18', '2018-07-18', '', 3, NULL, '2018-07-18 08:07:23', NULL, 0),
(3, 'Update data to user bc_iqc_02', 'W1275', '6', '3', '11', '2018-07-18', '2018-07-18', '', 3, NULL, '2018-07-18 08:07:48', NULL, 0),
(4, 'Get user statistic', 'W1276', '6', '3', '11', '2018-07-18', '2018-07-18', '', 3, 3, '2018-07-18 08:08:13', '2018-07-18 08:09:12', 0),
(5, 'Add function delete at accept page', 'W1277', '6', '3', '1', '2018-07-19', '2018-07-19', '', 3, NULL, '2018-07-18 08:08:40', NULL, 0),
(6, 'Change php-cloudfiles library to php-opencloud library for deleting version', 'W677', '11', '5', '8', '2018-07-17', '2018-07-19', '', 5, NULL, '2018-07-18 08:54:54', NULL, 0),
(7, 'Change query query builder in change password, group, user page', 'W1271', '8', '6', '8', '2018-07-17', '2018-07-18', '', 6, 6, '2018-07-18 09:44:14', '2018-07-18 10:04:49', 0),
(8, 'Add new process control page', 'W1278', '8', '6', '7', '2018-07-18', '2018-07-19', '', 6, 6, '2018-07-18 09:47:15', '2018-07-18 10:05:01', 0),
(9, 'Modify Release onhld RCV', 'W1260', '8', '7', '10', '2018-07-15', '2018-07-19', '', 7, NULL, '2018-07-18 10:07:37', NULL, 0),
(10, 'Modify WIP of process', 'W1283', '8', '2', '11', '2018-07-18', '2018-07-18', '', 2, NULL, '2018-07-18 10:19:17', NULL, 0),
(11, 'Protocol read logfile from machine L1FA', 'W1282', '1', '2', '7', '2018-07-18', '2018-07-19', '', 2, 2, '2018-07-18 10:20:02', '2018-07-21 13:27:55', 0),
(12, 'Fix bug add PO for setting customer shipping  Backcover Assembly', 'W1285', '6', '1', '11', '2018-07-18', '2018-07-18', '', 1, NULL, '2018-07-18 10:26:39', NULL, 0),
(13, 'Add Statistic report function do Head Map', 'W1284', '7', '1', '1', '2018-07-19', '2018-07-19', '', 1, NULL, '2018-07-18 10:27:29', NULL, 0),
(14, 'Fix bug transfer data from WD to WL Receiving', 'W1283', '6', '1', '11', '2018-07-18', '2018-07-18', '', 1, NULL, '2018-07-18 10:28:03', NULL, 0),
(15, 'Fix bug UI Weblocal for Logfil Transfer function', 'S158', '5', '1', '1', '2018-07-19', '2018-07-19', '', 1, NULL, '2018-07-18 10:29:14', NULL, 0),
(16, 'Update UI Functional test setting to the latest design (Bypass if cannot test)', 'W680', '3', '4', '11', '2018-07-18', '2018-07-18', 'Site test', 4, NULL, '2018-07-18 10:41:52', NULL, 0),
(17, 'Result search transfer ID is empty on SBE Global customer (Productivity and Phone history)', 'W681', '2', '4', '11', '2018-07-18', '2018-07-18', 'Product site', 4, NULL, '2018-07-18 10:42:35', NULL, 0),
(18, 'Add new key to Machine settings and new colums to report Intelligent Charger (view/search/export)', 'W682', '3', '4', '11', '2018-07-18', '2018-07-18', '', 4, NULL, '2018-07-18 10:43:15', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_member`
--

CREATE TABLE `report_member` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_member`
--

INSERT INTO `report_member` (`id`, `name`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
(1, 'Hao Nguyen', 1, 1, '2018-07-17 09:19:53', NULL, 0),
(2, 'Hoa Le', 1, NULL, '2018-07-17 09:19:56', NULL, 0),
(3, 'Hoa Nguyen', 1, NULL, '2018-07-17 09:19:56', NULL, 0),
(4, 'Huy Nguyen', 1, NULL, '2018-07-17 09:19:56', NULL, 0),
(5, 'Uy Nguyen', 1, NULL, '2018-07-17 09:19:56', NULL, 0),
(6, 'Tuan Vu', 1, NULL, '2018-07-17 09:19:56', NULL, 0),
(7, 'Thuan Nguyen', 1, NULL, '2018-07-17 09:19:56', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_project`
--

CREATE TABLE `report_project` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_project`
--

INSERT INTO `report_project` (`id`, `name`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
(1, 'ICombine', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(2, 'Intelligent Charger', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(3, 'PhoneBot', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(4, 'IValuate Gen3', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(5, 'TradIT', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(6, 'GCE-Backcover', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(7, 'GCE-WL', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(8, 'WD-HGST', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(9, 'GCS', 1, NULL, '2018-07-17 09:14:19', NULL, 0),
(10, 'IValuate Gen3', 2, NULL, '2018-07-18 03:58:03', NULL, 0),
(11, 'CDN', 2, NULL, '2018-07-18 08:54:05', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_status`
--

CREATE TABLE `report_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_status`
--

INSERT INTO `report_status` (`id`, `name`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
(1, '0%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(2, '10%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(3, '20%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(4, '30%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(5, '40%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(6, '50%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(7, '60%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(8, '70%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(9, '80%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(10, '90%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(11, '100%', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(12, 'Pending', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(13, 'Cancel', 1, NULL, '2018-07-17 09:16:54', NULL, 0),
(14, 'Delay', 1, NULL, '2018-07-17 09:16:54', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_group`
--

CREATE TABLE `sys_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `customer` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isadmin` int(11) DEFAULT '0',
  `params` varchar(5000) DEFAULT NULL,
  `time_create` datetime NOT NULL,
  `user_create` varchar(25) NOT NULL,
  `user_update` varchar(25) NOT NULL,
  `time_update` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_group`
--

INSERT INTO `sys_group` (`id`, `name`, `customer`, `status`, `isadmin`, `params`, `time_create`, `user_create`, `user_update`, `time_update`, `is_delete`) VALUES
(1, 'Admin group', 1, 1, 1, '{\"2\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"3\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"4\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"11\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"12\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"13\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"14\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"21\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"22\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"23\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"24\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"25\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"31\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"32\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"}}', '2013-07-01 08:57:48', 'admin', 'admin', '2018-05-03 03:30:37', 0),
(2, 'Support group', 1, 0, 0, '{\"2\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"3\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"4\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"11\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"12\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"13\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"14\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"15\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"16\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"},\"21\":{\"view\":\"\",\"add\":\"\",\"edit\":\"\",\"delete\":\"\"}}', '2017-08-13 09:06:53', 'admin', 'admin', '2018-05-08 09:17:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

CREATE TABLE `sys_menu` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(225) NOT NULL,
  `classicon` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `params` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`id`, `name`, `route`, `classicon`, `parent`, `params`, `ordering`, `is_delete`) VALUES
(1, 'HỆ THỐNG', 'p-system', 'ico_system', 0, '', 1, 0),
(2, 'Cấu hình', 'sysconfig', 'ico_config', 1, 'view,add,edit,delete', 1, 0),
(3, 'Nhóm quyền', 'sysgroup', 'ico_group', 1, 'view,add,edit,delete', 2, 0),
(4, 'Tài khoản', 'sysusers', 'ico_user', 1, 'view,add,edit,delete', 3, 0),
(10, 'BÁO CÁO', 'p-report', 'ico_menu_owner', 0, '', 1, 0),
(11, 'Báo cáo ngày', 'report', 'ico_pages', 10, 'view,add,edit,delete', 1, 0),
(12, 'Báo cáo năm', 'reportyear', 'ico_pages', 10, 'view,add,edit,delete', 3, 0),
(13, 'Thống kê', 'statistical', 'ico_pages', 10, 'view,add,edit,delete', 2, 0),
(14, 'Xuất excel', 'exportexcel', 'ico_pages', 10, 'view,add,edit,delete', 6, 0),
(20, 'BÀI VIẾT', 'p-catalog', 'ico_menu_news', 0, '', 1, 0),
(21, 'Danh mục bài viết', 'productcatalog', 'ico_pages', 20, 'view,add,edit,delete', 1, 0),
(22, 'Chi tiết bài viết', 'product', 'ico_menu_news', 20, 'view,add,edit,delete', 2, 0),
(23, 'Tôn giáo', 'product', 'ico_menu_news', 20, 'view,add,edit,delete', 2, 0),
(24, 'Phật giáo', 'sysuser', 'ico_menu_news', 23, 'view,add,edit,delete', 1, 0),
(25, 'Nho giáo', 'nhogiao', 'ico_menu_news', 23, 'view,add,edit,delete', 2, 0),
(30, 'TỔNG HỢP', 'p-catalog', 'ico_menu_news', 0, '', 1, 0),
(31, 'Chăm sóc sức khỏe', 'nhogiao', 'ico_menu_news', 30, 'view,add,edit,delete', 2, 0),
(32, 'Sách hay', 'nhogiao', 'ico_menu_news', 30, 'view,add,edit,delete', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`id`, `username`, `password`, `groupid`, `firstname`, `lastname`, `email`, `mobile_number`, `phone_number`, `address`, `description`, `avatar`, `status`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
(1, 'huynt', '12345', 1, 'Nguyễn Tất', 'Huy', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(2, 'nv1', '12345', 2, 'Nhân', 'Viên 1', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(3, 'nv2', '12345', 3, 'Nhân', 'Viên 2', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(4, 'nv3', '12345', 1, 'Nhân', 'Viên 3', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(5, 'nv4', '12345', 2, 'Nhân', 'Viên 4', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(6, 'nv5', '12345', 2, 'Nhân', 'Viên 5', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(7, 'nv6', '12345', 3, 'Nhân', 'Viên 6', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(8, 'nv7', '12345', 2, 'Nhân', 'Viên 7', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(9, 'nv8', '12345', 2, 'Nhân', 'Viên 8', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(10, 'nv9', '12345', 2, 'Nhân', 'Viên 9', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(11, 'nv10', '12345', 2, 'Nhân', 'Viên 10', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(12, 'nv11', '12345', 1, 'Nhân', 'Viên 11', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(13, 'nv13', '12345', 1, 'Nhân', 'Viên 13', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(14, 'nv14', '12345', 1, 'Nhân', 'Viên 14', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(15, 'nv15', '12345', 1, 'Nhân', 'Viên 15', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(16, 'nv16', '12345', 2, 'Nhân', 'Viên 16', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(17, 'nv17', '12345', 1, 'Nhân', 'Viên 17', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(18, 'nv18', '12345', 1, 'Nhân', 'Viên 18', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(19, 'nv19', '12345', 3, 'Nhân', 'Viên 19', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(20, 'nv110', '12345', 1, 'Nhân', 'Viên 110', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(21, 'nv111', '12345', 1, 'Nhân', 'Viên 111', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(22, 'nv134', '12345', 1, 'Nhân', 'Viên 134', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(23, 'nv144', '12345', 1, 'Nhân', 'Viên 144', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(24, 'nv154', '12345', 1, 'Nhân', 'Viên 154', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(25, 'nv164', '12345', 1, 'Nhân', 'Viên 164', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(26, 'nv174', '12345', 1, 'Nhân', 'Viên 174', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(27, 'nv184', '12345', 1, 'Nhân', 'Viên 184', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(28, 'nv194', '12345', 1, 'Nhân', 'Viên 194', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(29, 'nv1104', '12345', 1, 'Nhân', 'Viên 1104', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
(30, 'nv1114', '12345', 1, 'Nhân', 'Viên 1114', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `friendlyurl` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `seo` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(500) CHARACTER SET utf8 NOT NULL,
  `focus` tinyint(4) NOT NULL DEFAULT '0',
  `content` text CHARACTER SET utf8 NOT NULL,
  `time_write` date NOT NULL,
  `author` varchar(100) CHARACTER SET utf8 NOT NULL,
  `images` text CHARACTER SET utf8 NOT NULL,
  `video` varchar(255) NOT NULL DEFAULT '',
  `active` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(4) NOT NULL DEFAULT '0',
  `user_create` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time_create` datetime NOT NULL,
  `user_update` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time_update` datetime NOT NULL,
  `date_create` datetime NOT NULL,
  `isdelete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `cat_id`, `title`, `friendlyurl`, `seo`, `description`, `focus`, `content`, `time_write`, `author`, `images`, `video`, `active`, `display`, `user_create`, `time_create`, `user_update`, `time_update`, `date_create`, `isdelete`) VALUES
(1, 5, 'Short tour', 'short-tour', '#', 'Tóm tắt', 0, '<p>Chi tiết nội dung</p>\n', '2018-04-05', 'admin', 'test7.png', '', 0, 1, 'admin', '2018-04-05 00:48:57', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 5, 'Long tour', 'long-tour', '#', 'Tóm tắt nội dung', 0, '<p>Nội dung đầy đủ</p>\n', '2018-04-05', 'admin', 'child_tour1.jpg', '', 0, 1, 'admin', '2018-04-05 01:24:56', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 6, 'Half day bicycle voyage (morning)', 'half-day-bicycle-voyage-morning', '#', 'Tóm tắt nội dung half day bicycle voyage (morning)', 0, '<p>Nội dung chi tiết&nbsp;half day bicycle voyage (morning)</p>\n', '2018-04-05', 'admin', 'child_tour2.jpg', '', 0, 1, 'admin', '2018-04-05 01:26:04', 'admin', '2018-04-05 01:29:22', '0000-00-00 00:00:00', 0),
(4, 6, 'Half day bicycle voyage (afternoon)', 'half-day-bicycle-voyage-afternoon', '#', 'Tóm tắt nội dung half day bicycle voyage (afternoon)', 0, '<p>Chi tiết nội dung&nbsp;half day bicycle voyage (afternoon)</p>\n', '2018-04-05', 'Admin', 'child_tour3.jpg', '', 0, 1, 'admin', '2018-04-05 01:28:51', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tours_categories`
--

CREATE TABLE `tours_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(15) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `friendlyurl` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `group` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '1',
  `display` tinyint(4) NOT NULL DEFAULT '1',
  `show` int(11) NOT NULL DEFAULT '0',
  `images` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `focus` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` varchar(25) NOT NULL,
  `time_created` datetime DEFAULT NULL,
  `user_updated` varchar(25) NOT NULL DEFAULT '',
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tours_categories`
--

INSERT INTO `tours_categories` (`id`, `code`, `name`, `friendlyurl`, `parent`, `status`, `group`, `active`, `order`, `display`, `show`, `images`, `description`, `content`, `focus`, `user_created`, `time_created`, `user_updated`, `time_updated`, `is_delete`) VALUES
(1, '', 'Mekong Delta', 'mekong-delta', 0, 1, 0, 1, 1, 1, 1, 'mekong2.jpeg', 'Custom Tour - Private Tour <br>\r\nBest Rates - Best Services', 'MEKONG PACKAGES', 0, 'admin', '2017-11-26 08:26:08', 'admin', '2018-04-07 11:05:41', 0),
(2, '', 'Can Tho City', 'can-tho-city', 0, 1, 0, 1, 2, 1, 2, 'banner1.jpeg', 'Mekong river life!', 'Life in the Mekong Delta revolves much around the river, and many of the villages are often accessible by rivers and canals rather than by road. Let\'s book our boat trips to discover it...', 0, 'admin', '2017-11-26 08:28:06', 'admin', '2018-04-07 11:07:04', 0),
(3, '', 'Ho Chi Minh City', 'ho-chi-minh-city', 0, 1, 0, 1, 3, 1, 3, 'tphcm1.jpg', 'What an experience!', 'Ho Chi Minh is the city of contrasts. The rich and the poor, the old and the new, the eastern and western cultures all thrown together in utter chaos. Let us make your time in Ho Chi Minh City and had the privilege of exploring several different corners, gaining more insight into Vietnamese culture and lifestyle...', 0, 'admin', '2017-11-26 08:28:23', 'admin', '2018-04-07 11:13:23', 0),
(4, '', 'Other Services', 'other-services', 0, 1, 0, 1, 4, 1, 2, 'other1.jpg', 'For your requirement!', 'For the best transportation from Ho Chi Minh airport, Mekong Delta and Cu Chi tunnels, please contact us.', 0, 'admin', '2018-04-04 22:05:25', 'admin', '2018-04-07 11:13:53', 0),
(5, '', 'Floating market tour', 'floating-market-tour', 2, 1, 0, 1, 1, 1, 0, 'test6.png', 'Đây là mô tả', '', 0, 'admin', '2018-04-04 22:08:17', '', NULL, 0),
(6, '', 'Bicycle voyages', 'bicycle-voyages', 2, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(7, '', 'Việt Nam', 'vn', 0, 1, 0, 1, 1, 1, 1, 'mekong2.jpeg', 'Custom Tour - Private Tour <br>\r\nBest Rates - Best Services', 'MEKONG PACKAGES', 0, 'admin', '2017-11-26 08:26:08', 'admin', '2018-04-07 11:05:41', 0),
(8, '', 'USA', 'can-tho-city', 0, 1, 0, 1, 2, 1, 2, 'banner1.jpeg', 'Mekong river life!', 'Life in the Mekong Delta revolves much around the river, and many of the villages are often accessible by rivers and canals rather than by road. Let\'s book our boat trips to discover it...', 0, 'admin', '2017-11-26 08:28:06', 'admin', '2018-04-07 11:07:04', 0),
(9, '', 'Lịch sử', 'bicycle-voyages', 7, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(10, '', 'Văn hóa', 'bicycle-voyages', 7, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(11, '', 'Bang hội', 'bicycle-voyages', 8, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(12, '', 'Galaxy', 'can-tho-city', 0, 1, 0, 1, 2, 1, 2, 'banner1.jpeg', 'Mekong river life!', 'Life in the Mekong Delta revolves much around the river, and many of the villages are often accessible by rivers and canals rather than by road. Let\'s book our boat trips to discover it...', 0, 'admin', '2017-11-26 08:28:06', 'admin', '2018-04-07 11:07:04', 0),
(13, '', 'Lịch sử cổ đại', 'bicycle-voyages', 9, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(14, '', 'Lịch sử cận đại', 'bicycle-voyages', 9, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0),
(15, '', 'Lịch sử hiện đại', 'bicycle-voyages', 9, 1, 0, 1, 1, 1, 0, 'test8.png', 'Mô tả', '', 0, 'admin', '2018-04-05 00:51:27', '', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_member`
--
ALTER TABLE `report_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_project`
--
ALTER TABLE `report_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_status`
--
ALTER TABLE `report_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_group`
--
ALTER TABLE `sys_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent` (`parent`),
  ADD KEY `idx_router` (`route`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours_categories`
--
ALTER TABLE `tours_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `report_member`
--
ALTER TABLE `report_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report_project`
--
ALTER TABLE `report_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report_status`
--
ALTER TABLE `report_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sys_group`
--
ALTER TABLE `sys_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tours_categories`
--
ALTER TABLE `tours_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
