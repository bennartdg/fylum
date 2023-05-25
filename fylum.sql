-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fylum
CREATE DATABASE IF NOT EXISTS `fylum` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `fylum`;

-- Dumping structure for table fylum.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_email` varchar(50) NOT NULL,
  `account_password` varchar(50) NOT NULL,
  `account_level` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_email` (`account_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.accounts: ~4 rows (approximately)
INSERT INTO `accounts` (`account_id`, `account_email`, `account_password`, `account_level`) VALUES
	(1, 'ancient@gmail.com', 'ancient123', 'ancient'),
	(2, 'atha@gmail.com', 'atha123', 'king'),
	(3, 'haikal@gmail.com', 'haikal123', 'fyler'),
	(4, 'google@gmail.com', 'google123', 'king');

-- Dumping structure for table fylum.ancients
CREATE TABLE IF NOT EXISTS `ancients` (
  `ancient_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_email` varchar(50) NOT NULL,
  `ancient_name` varchar(50) NOT NULL,
  `ancient_balance` int(11) NOT NULL,
  PRIMARY KEY (`ancient_id`),
  KEY `FK__ancients` (`account_email`),
  CONSTRAINT `FK__ancients` FOREIGN KEY (`account_email`) REFERENCES `accounts` (`account_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.ancients: ~1 rows (approximately)
INSERT INTO `ancients` (`ancient_id`, `account_email`, `ancient_name`, `ancient_balance`) VALUES
	(1, 'ancient@gmail.com', 'Ancient', 0);

-- Dumping structure for table fylum.fylers
CREATE TABLE IF NOT EXISTS `fylers` (
  `fyler_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_email` varchar(50) NOT NULL DEFAULT '',
  `fyler_name` varchar(50) NOT NULL DEFAULT '',
  `fyler_cate` varchar(50) NOT NULL DEFAULT '',
  `fyler_desc` varchar(500) NOT NULL DEFAULT '',
  `fyler_age` int(11) NOT NULL,
  `fyler_add` varchar(50) NOT NULL DEFAULT '',
  `fyler_balance` int(11) NOT NULL,
  `fyler_photo` varchar(50) NOT NULL DEFAULT '',
  `fyler_project` int(11) NOT NULL,
  PRIMARY KEY (`fyler_id`),
  KEY `FK__fylers` (`account_email`),
  CONSTRAINT `FK__fylers` FOREIGN KEY (`account_email`) REFERENCES `accounts` (`account_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2002 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.fylers: ~1 rows (approximately)
INSERT INTO `fylers` (`fyler_id`, `account_email`, `fyler_name`, `fyler_cate`, `fyler_desc`, `fyler_age`, `fyler_add`, `fyler_balance`, `fyler_photo`, `fyler_project`) VALUES
	(2001, 'haikal@gmail.com', 'Muhammad Haikal', 'Graphic Designer', 'Hi there! I am Muhammad Haikal, a graphic designer with 2+ years of work experience. I have the necessary skills you need for social media, landing pages, logos, brochures, and any kind of design you wish with eye-catching and informative design. I always try my best to deliver more than my customer\'s expectations.', 19, 'Jl. Burung Gereja', 0, 'haikal.jpg', 0);

-- Dumping structure for table fylum.kings
CREATE TABLE IF NOT EXISTS `kings` (
  `king_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_email` varchar(50) NOT NULL DEFAULT '',
  `king_name` varchar(50) NOT NULL DEFAULT '',
  `king_desc` varchar(500) NOT NULL,
  `king_add` varchar(500) NOT NULL DEFAULT '',
  `king_balance` int(11) NOT NULL,
  `king_photo` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`king_id`),
  KEY `FK_kings` (`account_email`),
  CONSTRAINT `FK_kings` FOREIGN KEY (`account_email`) REFERENCES `accounts` (`account_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.kings: ~2 rows (approximately)
INSERT INTO `kings` (`king_id`, `account_email`, `king_name`, `king_desc`, `king_add`, `king_balance`, `king_photo`) VALUES
	(1001, 'atha@gmail.com', 'Hasnaura Atha', 'Startup', 'Taman Kopo Katapang', 1000000, 'atha.jpg'),
	(1002, 'google@gmail.com', 'Google', 'The biggest company in The World', '1600 Amphitheatre Parkway in Mountain View, California', 0, 'google.jpg');

-- Dumping structure for table fylum.portos
CREATE TABLE IF NOT EXISTS `portos` (
  `porto_id` int(11) NOT NULL AUTO_INCREMENT,
  `fyler_id` int(11) NOT NULL,
  `porto_name` varchar(50) NOT NULL,
  `porto_desc` varchar(500) NOT NULL,
  `porto_date` date NOT NULL,
  `porto_photo` varchar(50) NOT NULL,
  PRIMARY KEY (`porto_id`),
  KEY `FK_portos` (`fyler_id`),
  CONSTRAINT `FK_portos` FOREIGN KEY (`fyler_id`) REFERENCES `fylers` (`fyler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3002 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.portos: ~1 rows (approximately)
INSERT INTO `portos` (`porto_id`, `fyler_id`, `porto_name`, `porto_desc`, `porto_date`, `porto_photo`) VALUES
	(3001, 2001, 'My Pertamina Redesign', 'Redesign Application UI of MyPertamina', '2022-02-20', 'mypertamina.jpg');

-- Dumping structure for table fylum.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `king_id` int(11) NOT NULL,
  `fyler_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_desc` varchar(500) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_cost` int(11) NOT NULL,
  `project_tax` int(11) NOT NULL,
  `project_fee` int(11) NOT NULL,
  `project_status` varchar(50) NOT NULL,
  `project_deliv` varchar(50) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `FK_project_king` (`king_id`),
  KEY `FK_project_fyler` (`fyler_id`),
  CONSTRAINT `FK_project_fyler` FOREIGN KEY (`fyler_id`) REFERENCES `fylers` (`fyler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_project_king` FOREIGN KEY (`king_id`) REFERENCES `kings` (`king_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.projects: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
