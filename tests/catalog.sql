-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sh.tours
CREATE TABLE IF NOT EXISTS `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `isdelete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sh.tours: ~4 rows (approximately)
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` (`id`, `cat_id`, `title`, `friendlyurl`, `seo`, `description`, `focus`, `content`, `time_write`, `author`, `images`, `video`, `active`, `display`, `user_create`, `time_create`, `user_update`, `time_update`, `date_create`, `isdelete`) VALUES
	(1, 5, 'Short tour', 'short-tour', '#', 'Tóm tắt', 0, '<p>Chi tiết nội dung</p>\n', '2018-04-05', 'admin', 'test7.png', '', 0, 1, 'admin', '2018-04-05 00:48:57', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(2, 5, 'Long tour', 'long-tour', '#', 'Tóm tắt nội dung', 0, '<p>Nội dung đầy đủ</p>\n', '2018-04-05', 'admin', 'child_tour1.jpg', '', 0, 1, 'admin', '2018-04-05 01:24:56', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(3, 6, 'Half day bicycle voyage (morning)', 'half-day-bicycle-voyage-morning', '#', 'Tóm tắt nội dung half day bicycle voyage (morning)', 0, '<p>Nội dung chi tiết&nbsp;half day bicycle voyage (morning)</p>\n', '2018-04-05', 'admin', 'child_tour2.jpg', '', 0, 1, 'admin', '2018-04-05 01:26:04', 'admin', '2018-04-05 01:29:22', '0000-00-00 00:00:00', 0),
	(4, 6, 'Half day bicycle voyage (afternoon)', 'half-day-bicycle-voyage-afternoon', '#', 'Tóm tắt nội dung half day bicycle voyage (afternoon)', 0, '<p>Chi tiết nội dung&nbsp;half day bicycle voyage (afternoon)</p>\n', '2018-04-05', 'Admin', 'child_tour3.jpg', '', 0, 1, 'admin', '2018-04-05 01:28:51', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;

-- Dumping structure for table sh.tours_categories
CREATE TABLE IF NOT EXISTS `tours_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table sh.tours_categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `tours_categories` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tours_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
