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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.accounts: ~11 rows (approximately)
INSERT INTO `accounts` (`account_id`, `account_email`, `account_password`, `account_level`) VALUES
	(1, 'ancient@gmail.com', 'ancient123', 'ancient'),
	(2, 'atha@gmail.com', 'atha123', 'king'),
	(3, 'haikal@gmail.com', 'haikal123', 'fyler'),
	(4, 'google@gmail.com', 'google123', 'king'),
	(5, 'ben@gmail.com', 'ben123', 'fyler'),
	(6, 'hilmy@gmail.com', 'hilmy123', 'fyler'),
	(7, 'ramdhan@gmail.com', 'ramdhan123', 'fyler'),
	(21, 'nike@gmail.com', 'nike123', 'king'),
	(22, 'fahri@gmail.com', 'fahri123', 'fyler'),
	(26, 'alfius@gmail.com', 'alfius123', 'fyler'),
	(27, 'ramzi@gmail.com', 'ramzi123', 'fyler');

-- Dumping structure for table fylum.ancients
CREATE TABLE IF NOT EXISTS `ancients` (
  `ancient_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_email` varchar(50) NOT NULL,
  `ancient_name` varchar(50) NOT NULL,
  `ancient_balance` int(11) NOT NULL,
  PRIMARY KEY (`ancient_id`),
  KEY `FK__ancients` (`account_email`),
  CONSTRAINT `FK__ancients` FOREIGN KEY (`account_email`) REFERENCES `accounts` (`account_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.ancients: ~0 rows (approximately)
INSERT INTO `ancients` (`ancient_id`, `account_email`, `ancient_name`, `ancient_balance`) VALUES
	(10, 'ancient@gmail.com', 'Ancient', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=2009 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.fylers: ~7 rows (approximately)
INSERT INTO `fylers` (`fyler_id`, `account_email`, `fyler_name`, `fyler_cate`, `fyler_desc`, `fyler_age`, `fyler_add`, `fyler_balance`, `fyler_photo`, `fyler_project`) VALUES
	(2001, 'haikal@gmail.com', 'Muhammad Haikal', 'Graphic Designer', 'Hi there! I am Muhammad Haikal, a graphic designer with 2+ years of work experience. I have the necessary skills you need for social media, landing pages, logos, brochures, and any kind of design you wish with eye-catching and informative design. I always try my best to deliver more than my customer\'s expectations.', 19, 'Bandung, Indonesia', 0, 'haikal.jpg', 0),
	(2002, 'ben@gmail.com', 'Bennart Gunawan', 'Graphic Designer', 'As a graphic designer, I am a creative individual with a deep passion for creating captivating visual works. I possess strong artistic abilities and a trained eye to capture small details that may be overlooked by others.', 20, 'Bandung, Indonesia', 0, '2022_1015_15220400.jpg', 0),
	(2003, 'hilmy@gmail.com', 'Hilmy Aiman', 'Photographer', '\r\nAs a photographer, I am a storyteller who captures moments and emotions through the lens of a camera. With a keen eye for detail and a passion for visual aesthetics, I strive to create captivating images that evoke emotions, tell stories, and leave a lasting impact on viewers.', 19, 'Bandung, Indonesia', 0, 'hilmy.png', 0),
	(2004, 'ramdhan@gmail.com', 'Ramdhan Mahfuzh', 'Architecture Designer', 'As an architecture designer, I am a creative professional who combines artistic vision with technical knowledge to shape and transform the built environment.', 20, 'Sumedang, Indonesia', 0, 'ramdhan.png', 0),
	(2006, 'fahri@gmail.com', 'R. Moh. Fahri Aqila', 'Photographer', 'Fahri is a photographer who possesses a deep passion for capturing the world through his lens. With a keen eye for detail and a love for storytelling, he strives to create images that evoke emotions, document moments, and tell compelling narratives.', 19, 'Subang, Indonesia', 0, 'fahri.jpg', 0),
	(2007, 'alfius@gmail.com', 'Alfius Stevanus Ginting', 'Graphic Designer', 'My name is Alfius, and I possess a unique blend of creativity, technical skills, and a profound understanding of how architecture impacts people lives.', 20, 'Medan, Indonesia', 0, 'alfius.jpg', 0),
	(2008, 'ramzi@gmail.com', 'Ramzi Mubarak', 'Architecture Designer', 'I see architecture as a means to shape the world we inhabit, creating environments that inspire, engage, and uplift. With a strong appreciation for aesthetics, functionality, and sustainability, I strive to develop designs that seamlessly blend form and purpose.', 19, 'Bandung, Indonesia', 0, 'ramzi.png', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.kings: ~3 rows (approximately)
INSERT INTO `kings` (`king_id`, `account_email`, `king_name`, `king_desc`, `king_add`, `king_balance`, `king_photo`) VALUES
	(1001, 'atha@gmail.com', 'Hasnaura Atha', 'Startup', 'Taman Kopo Katapang', 1000000, 'atha.png'),
	(1002, 'google@gmail.com', 'Google', 'The biggest company in The World', '1600 Amphitheatre Parkway in Mountain View, California', 5000000, 'google.jpg'),
	(1003, 'nike@gmail.com', 'Nike', 'Sports', 'Beaverton, One Bowerman Drive, United States.', 0, 'seo-title.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=3004 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.portos: ~3 rows (approximately)
INSERT INTO `portos` (`porto_id`, `fyler_id`, `porto_name`, `porto_desc`, `porto_date`, `porto_photo`) VALUES
	(3001, 2001, 'My Pertamina', 'Redesign Application UI of MyPertamina', '2022-02-20', 'mypertamina1.png'),
	(3002, 2001, 'Cloud Edge', 'Making a Brand Landing Page', '2022-02-21', '2610482_A-Landing_Page.jpg'),
	(3003, 2001, 'Nyepi\'s Poster', 'Creating a Poster for Nyepi\'s Day', '2022-02-22', '4.jpg');

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
  `project_deliv` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `FK_project_king` (`king_id`),
  KEY `FK_project_fyler` (`fyler_id`),
  CONSTRAINT `FK_project_fyler` FOREIGN KEY (`fyler_id`) REFERENCES `fylers` (`fyler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_project_king` FOREIGN KEY (`king_id`) REFERENCES `kings` (`king_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5005 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table fylum.projects: ~4 rows (approximately)
INSERT INTO `projects` (`project_id`, `king_id`, `fyler_id`, `project_name`, `project_desc`, `project_start`, `project_end`, `project_cost`, `project_tax`, `project_fee`, `project_status`, `project_deliv`) VALUES
	(5001, 1002, 2001, 'Website Design', 'You are gong to make website design of Brand New Google Website. Be Creative and Think outside the box.', '2023-05-07', '2023-06-06', 5000000, 500000, 4500000, 'unread', ''),
	(5002, 1002, 2001, 'Banner Design', 'You are gong to make banner of Brand New Google Website. Be Creative and Think outside the box.', '2023-05-01', '2023-06-01', 2000000, 200000, 1800000, 'ongoing', NULL),
	(5003, 1002, 2001, 'Design Logo', 'You are gong to make Logo of Brand New Google Website. Be Creative and Think outside the box.', '2023-04-01', '2023-04-15', 3000000, 300000, 1700000, 'finished', NULL),
	(5004, 1001, 2001, 'Design Logo', 'Please make my school task brand logo, i hope you can help me, with my few money', '2023-04-01', '2023-04-02', 50000, 5000, 45000, 'declined', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
