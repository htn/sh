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

-- Dumping structure for table sh.sys_group
CREATE TABLE IF NOT EXISTS `sys_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sh.sys_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_group` DISABLE KEYS */;
INSERT INTO `sys_group` (`id`, `name`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
	(1, 'Admin', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sys_group` ENABLE KEYS */;

-- Dumping structure for table sh.sys_user
CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_delete` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sh.sys_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
INSERT INTO `sys_user` (`id`, `username`, `password`, `groupid`, `firstname`, `lastname`, `email`, `mobile_number`, `phone_number`, `address`, `description`, `avatar`, `status`, `user_created`, `user_updated`, `time_created`, `time_updated`, `is_delete`) VALUES
	(1, 'huynt', '12345', 1, 'Nguyễn Tất', 'Huy', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(2, 'nv1', '12345', 1, 'Nhân', 'Viên 1', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(3, 'nv2', '12345', 1, 'Nhân', 'Viên 2', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(4, 'nv3', '12345', 1, 'Nhân', 'Viên 3', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(5, 'nv4', '12345', 1, 'Nhân', 'Viên 4', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(6, 'nv5', '12345', 1, 'Nhân', 'Viên 5', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(7, 'nv6', '12345', 1, 'Nhân', 'Viên 6', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(8, 'nv7', '12345', 1, 'Nhân', 'Viên 7', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(9, 'nv8', '12345', 1, 'Nhân', 'Viên 8', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(10, 'nv9', '12345', 1, 'Nhân', 'Viên 9', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(11, 'nv10', '12345', 1, 'Nhân', 'Viên 10', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(12, 'nv11', '12345', 1, 'Nhân', 'Viên 11', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(13, 'nv13', '12345', 1, 'Nhân', 'Viên 13', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(14, 'nv14', '12345', 1, 'Nhân', 'Viên 14', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(15, 'nv15', '12345', 1, 'Nhân', 'Viên 15', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(16, 'nv16', '12345', 1, 'Nhân', 'Viên 16', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(17, 'nv17', '12345', 1, 'Nhân', 'Viên 17', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(18, 'nv18', '12345', 1, 'Nhân', 'Viên 18', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
	(19, 'nv19', '12345', 1, 'Nhân', 'Viên 19', 'conduongsang.info@gmail.com', '0988656070', '0988656070', 'Thủ Đức HCM Việt Nam', 'Nhân viên lập trình', 'huy.png', 1, 1, 1, '2018-06-20 15:30:33', '2018-06-20 15:30:36', 0),
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

	/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
