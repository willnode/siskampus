-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for unwaha_master
CREATE DATABASE IF NOT EXISTS `unwaha_master` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `unwaha_master`;

-- Dumping structure for table unwaha_master.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `nid` varchar(50) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table unwaha_master.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(50) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `angkatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`nim`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table unwaha_master.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`username`) USING BTREE,
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


-- Dumping database structure for unwaha_tugasakhir
CREATE DATABASE IF NOT EXISTS `unwaha_tugasakhir` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `unwaha_tugasakhir`;

-- Dumping structure for table unwaha_tugasakhir.pembimbing
CREATE TABLE IF NOT EXISTS `pembimbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tema` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nid` (`nid`),
  KEY `tema` (`tema`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table unwaha_tugasakhir.pendaftar
CREATE TABLE IF NOT EXISTS `pendaftar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pembimbing` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table unwaha_tugasakhir.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`username`) USING BTREE,
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
