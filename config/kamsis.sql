-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hostel
CREATE DATABASE IF NOT EXISTS `hostel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hostel`;

-- Dumping structure for table hostel.blocks
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `floor_list` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.blocks: ~0 rows (approximately)
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` (`id`, `name`, `floor_list`, `is_active`) VALUES
	(1, 'HANG TUAH', '["G","1","2","3"]', 0);
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;

-- Dumping structure for table hostel.inventories
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `is_active` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.inventories: ~0 rows (approximately)
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` (`id`, `name`, `remark`, `is_active`) VALUES
	(1, 'KERUSI', '                                        ', 0),
	(2, 'MEJA BELAJAR', 'TESTING FDSD                      ', 0);
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;

-- Dumping structure for table hostel.rents
CREATE TABLE IF NOT EXISTS `rents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_sub_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `check_in_on` datetime DEFAULT NULL,
  `check_out_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.rents: ~0 rows (approximately)
/*!40000 ALTER TABLE `rents` DISABLE KEYS */;
INSERT INTO `rents` (`id`, `room_sub_id`, `student_id`, `session_id`, `remark`, `check_in_on`, `check_out_on`) VALUES
	(1, 1, 1, 2, NULL, '2021-04-26 16:07:00', '2021-04-26 16:07:51');
/*!40000 ALTER TABLE `rents` ENABLE KEYS */;

-- Dumping structure for table hostel.rent_remark
CREATE TABLE IF NOT EXISTS `rent_remark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_sub_inventory_id` int(11) NOT NULL,
  `rent_id` int(11) NOT NULL,
  `cin_ok` smallint(6) NOT NULL DEFAULT '0',
  `cin_remark` varchar(255) DEFAULT NULL,
  `cin_photo` varchar(255) DEFAULT NULL,
  `cout_ok` smallint(6) DEFAULT '0',
  `cout_remark` varchar(255) DEFAULT NULL,
  `cout_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.rent_remark: ~0 rows (approximately)
/*!40000 ALTER TABLE `rent_remark` DISABLE KEYS */;
INSERT INTO `rent_remark` (`id`, `room_sub_inventory_id`, `rent_id`, `cin_ok`, `cin_remark`, `cin_photo`, `cout_ok`, `cout_remark`, `cout_photo`) VALUES
	(1, 1, 1, 0, 'Kerusi patah', NULL, 0, NULL, NULL),
	(2, 2, 1, 1, NULL, NULL, 0, 'meja patah', NULL);
/*!40000 ALTER TABLE `rent_remark` ENABLE KEYS */;

-- Dumping structure for table hostel.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `block_id` int(10) unsigned NOT NULL,
  `floor` varchar(50) NOT NULL DEFAULT '',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.rooms: ~0 rows (approximately)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `block_id`, `floor`, `is_active`, `name`) VALUES
	(1, 1, 'G', 1, 'A'),
	(2, 1, 'G', 1, 'G-01'),
	(11, 1, 'G', 1, 'G-02');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Dumping structure for table hostel.room_subs
CREATE TABLE IF NOT EXISTS `room_subs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL DEFAULT '0',
  `code` char(50) NOT NULL DEFAULT '',
  `is_active` int(11) NOT NULL DEFAULT '0',
  `current_student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.room_subs: ~0 rows (approximately)
/*!40000 ALTER TABLE `room_subs` DISABLE KEYS */;
INSERT INTO `room_subs` (`id`, `room_id`, `code`, `is_active`, `current_student_id`) VALUES
	(1, 1, '', 1, 1);
/*!40000 ALTER TABLE `room_subs` ENABLE KEYS */;

-- Dumping structure for table hostel.room_sub_inventories
CREATE TABLE IF NOT EXISTS `room_sub_inventories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_sub_id` int(10) unsigned NOT NULL,
  `inventory_id` int(10) unsigned NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.room_sub_inventories: ~0 rows (approximately)
/*!40000 ALTER TABLE `room_sub_inventories` DISABLE KEYS */;
INSERT INTO `room_sub_inventories` (`id`, `room_sub_id`, `inventory_id`, `remark`) VALUES
	(1, 1, 1, NULL);
/*!40000 ALTER TABLE `room_sub_inventories` ENABLE KEYS */;

-- Dumping structure for table hostel.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_current` tinyint(4) NOT NULL DEFAULT '0',
  `year1` year(4) NOT NULL,
  `year2` year(4) NOT NULL,
  `semester` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.sessions: ~3 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `name`, `is_current`, `year1`, `year2`, `semester`) VALUES
	(1, '2017/2018 SEM1', 1, '2017', '2018', 1),
	(2, '2017/2018 SEM2', 0, '2017', '2018', 2),
	(3, '2020/2021 SEM1', 0, '2020', '2021', 1);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table hostel.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.staff: ~0 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `email`, `password`, `fullname`, `role`) VALUES
	(1, 'S01@staff.utem.edu.my', '$2y$10$oqjr3Nrs.jt9HRiQsX0ovOeKFeiTjhjjnf.RwbPiCVHoiD6ZvDKiO', 'STAFF', 'admin'),
	(2, 'S02@staff.utem.edu.my', '$2y$10$oqjr3Nrs.jt9HRiQsX0ovOeKFeiTjhjjnf.RwbPiCVHoiD6ZvDKiO', 'STFF', 'staff');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table hostel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `matric_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verify_token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `matric_number` (`matric_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table hostel.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `matric_number`, `password`, `fullname`, `phone_number`, `verified_at`, `verify_token`) VALUES
	(1, 'B03@student.utem.edu.my', 'B03', '$2y$10$oqjr3Nrs.jt9HRiQsX0ovOeKFeiTjhjjnf.RwbPiCVHoiD6ZvDKiO', 'STUDENT EXAMPLE', '0105960686', NULL, 'SDFHJDF');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
