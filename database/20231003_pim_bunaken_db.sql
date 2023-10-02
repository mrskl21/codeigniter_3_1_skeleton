-- --------------------------------------------------------
-- Host:                         lasahido.id
-- Server version:               8.0.33-0ubuntu0.20.04.2 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table msc_pkk_mapanget_db.auth_permissions
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table msc_pkk_mapanget_db.auth_permissions: ~6 rows (approximately)
INSERT INTO `auth_permissions` (`id`, `title`, `description`) VALUES
	(1, 'auth-users', ''),
	(2, 'auth-roles', ''),
	(3, 'auth-permissions', ''),
	(18, 'ref-settings', ''),
	(34, 'data-worker', ''),
	(36, 'data-parent', '');

-- Dumping structure for table msc_pkk_mapanget_db.auth_roles
CREATE TABLE IF NOT EXISTS `auth_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table msc_pkk_mapanget_db.auth_roles: ~3 rows (approximately)
INSERT INTO `auth_roles` (`id`, `title`, `description`) VALUES
	(1, 'Admin', '<p>admin</p>'),
	(2, 'Petugas Posyandu', '<p>Petugas Posyandu</p>'),
	(3, 'Orang Tua', '<p>Orang Tua</p>');

-- Dumping structure for table msc_pkk_mapanget_db.auth_roles_has_permissions
CREATE TABLE IF NOT EXISTS `auth_roles_has_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `roles_id` int NOT NULL,
  `permissions_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table msc_pkk_mapanget_db.auth_roles_has_permissions: ~9 rows (approximately)
INSERT INTO `auth_roles_has_permissions` (`id`, `roles_id`, `permissions_id`) VALUES
	(175, 1, 3),
	(176, 1, 2),
	(177, 1, 1),
	(178, 1, 36),
	(179, 1, 34),
	(180, 1, 18),
	(181, 2, 1),
	(182, 2, 34),
	(183, 3, 36);

-- Dumping structure for table msc_pkk_mapanget_db.auth_users
CREATE TABLE IF NOT EXISTS `auth_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roles_id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table msc_pkk_mapanget_db.auth_users: ~7 rows (approximately)
INSERT INTO `auth_users` (`id`, `username`, `password`, `roles_id`, `email`, `fullname`, `photo`, `status`, `created_at`) VALUES
	(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin@manadokota.go.id', 'Admin', NULL, 1, 1647086807),
	(3, '198807282020122009', '233be4cbd193d3e9cdcfa8d77526f7dd', 2, 'nakes@manadokota.go.id', 'dr. Paulina Rongkonusa', NULL, 1, 1647758521),
	(4, 'ortu', '469eb28221c8e6d092ddafacb87799bf', 3, 'ortu@mail.com', 'Orang Tua 1', NULL, 1, 1692872157),
	(5, '198405112008032001', '233be4cbd193d3e9cdcfa8d77526f7dd', 2, 'nakes@manadokota.go.id', 'Lidya Linda, SST', NULL, 1, 1692886716),
	(6, '197604282010012001', '233be4cbd193d3e9cdcfa8d77526f7dd', 2, 'nakes@manadokota.go.id', 'Srihartati Tubagus, SST', NULL, 1, 1692886763),
	(7, '198308012009032003', '233be4cbd193d3e9cdcfa8d77526f7dd', 2, 'nakes@manadokota.go.id', 'Ivon Tambuwun, SKM', NULL, 1, 1692886808),
	(8, '199308252019082003', '233be4cbd193d3e9cdcfa8d77526f7dd', 2, 'nakes@manadokota.go.id', 'Melisa Mardjola, SKP, Ns', NULL, 1, 1692886862);

-- Dumping structure for table msc_pkk_mapanget_db.data_child
CREATE TABLE IF NOT EXISTS `data_child` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` int NOT NULL,
  `birthdate` date NOT NULL,
  `photo` varchar(200) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `kk` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table msc_pkk_mapanget_db.data_child: ~2 rows (approximately)
INSERT INTO `data_child` (`id`, `parent_id`, `name`, `gender`, `birthdate`, `photo`, `nik`, `kk`) VALUES
	(1, 4, 'Budi', 1, '2019-10-30', 'avatar-1.png', '71717171717', '17717171717'),
	(2, 4, 'Ani', 0, '2023-08-24', 'avatar-4.png', '13719831', '1231412');

-- Dumping structure for table msc_pkk_mapanget_db.data_medical
CREATE TABLE IF NOT EXISTS `data_medical` (
  `id` int NOT NULL AUTO_INCREMENT,
  `worker_id` int NOT NULL,
  `child_id` int NOT NULL,
  `datetime` int NOT NULL,
  `note` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table msc_pkk_mapanget_db.data_medical: ~2 rows (approximately)
INSERT INTO `data_medical` (`id`, `worker_id`, `child_id`, `datetime`, `note`, `photo`) VALUES
	(1, 2, 1, 1692883001, 'testing\r\ntesting', ''),
	(2, 2, 1, 1692883109, 'tes', 'logo-siladen1.png');

-- Dumping structure for table msc_pkk_mapanget_db.ref_settings
CREATE TABLE IF NOT EXISTS `ref_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `last_update` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table msc_pkk_mapanget_db.ref_settings: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
