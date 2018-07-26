-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 04:24 PM
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
(1, 'SYSTEM', 'psystem', 'ico_system', 0, '', 1, 0),
(2, 'Config', 'config', 'ico_config', 1, 'view,add,edit,delete', 1, 1),
(3, 'Groups', 'groups', 'ico_group', 1, 'view,add,edit,delete', 2, 0),
(4, 'Users', 'users', 'ico_user', 1, 'view,add,edit,delete', 3, 0),
(10, 'SETUP', 'psetup', 'ico_menu_owner', 0, '', 1, 0),
(11, 'Machine Type', 'machines', 'ico_pages', 10, 'view,add,edit,delete', 1, 1),
(12, 'Issue Type', 'issuetype', 'ico_pages', 10, 'view,add,edit,delete', 3, 0),
(13, 'Available Issue', 'availableissue', 'ico_pages', 10, 'view,add,edit,delete', 4, 1),
(14, 'Fix Issue', 'fixissue', 'ico_pages', 10, 'view,add,edit,delete', 5, 1),
(15, 'Priority', 'priority', 'ico_pages', 10, 'view,add,edit,delete', 2, 0),
(16, 'Assign User', 'assignuser', 'ico_pages', 10, 'view,add,edit,delete', 6, 0),
(20, 'REPORT', 'preport', 'ico_menu_news', 0, '', 1, 0),
(21, 'Report', 'report', 'ico_pages', 20, 'view,add,edit,delete', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent` (`parent`),
  ADD KEY `idx_router` (`route`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
