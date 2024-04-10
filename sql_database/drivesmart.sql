-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2024 at 10:42 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivesmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `first_name`, `last_name`, `password`, `email`, `is_admin`, `archived`) VALUES
(1, 'Joep', 'Swamas', '701f33b8d1366cde9cb3822256a62c01', 'joepert@hotmail.com', 0, 0),
(2, 'Egbert', 'Vogel', '098f6bcd4621d373cade4e832627b4f6', 'vogelguy@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lessonblock`
--

DROP TABLE IF EXISTS `lessonblock`;
CREATE TABLE IF NOT EXISTS `lessonblock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instructor_id` int NOT NULL,
  `vehicle_license` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `timeblock` time NOT NULL,
  `student_id` int DEFAULT NULL,
  `report` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `instructeur_id` (`instructor_id`) USING BTREE,
  KEY `auto_kenteken` (`vehicle_license`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lessonblock`
--

INSERT INTO `lessonblock` (`id`, `instructor_id`, `vehicle_license`, `date`, `timeblock`, `student_id`, `report`) VALUES
(1, 1, '92-hxk-9', '2024-04-15', '09:00:00', NULL, NULL),
(2, 1, '92-hxk-9', '2024-04-15', '10:00:00', NULL, NULL),
(3, 2, '15-tyl-2', '2024-04-15', '11:00:00', NULL, NULL),
(4, 2, '15-tyl-2', '2024-04-15', '12:00:00', NULL, NULL),
(5, 1, '92-hxk-9', '2024-04-16', '09:30:00', NULL, NULL),
(6, 1, '92-hxk-9', '2024-04-16', '10:30:00', NULL, NULL),
(7, 1, '92-hxk-9', '2024-04-18', '09:30:00', NULL, NULL),
(8, 1, '92-hxk-9', '2024-04-17', '10:30:00', 1, NULL),
(10, 1, '92-hxk-9', '2024-04-16', '10:30:00', NULL, NULL),
(12, 1, '92-hxk-9', '2024-04-08', '10:30:00', 1, 'Rijles verslag dit is een rijles verslag het ging uitstekend. Rijles verslag dit is een rijles verslag het ging uitstekend. Rijles verslag dit is een rijles verslag het ging uitstekend.'),
(9, 1, '92-hxk-9', '2024-04-10', '08:30:00', 1, NULL),
(11, 2, '92-hxk-9', '2024-04-09', '11:30:00', 1, 'Rijles verslag dit is een rijles verslag het ging uitstekend.'),
(13, 2, '92-hxk-9', '2024-04-09', '11:30:00', 1, 'Rijles verslag dit is een rijles verslag het ging uitstekend.'),
(14, 1, '92-hxk-9', '2024-04-08', '10:30:00', 2, 'Rijles verslag dit is een rijles verslag het ging uitstekend.');

-- --------------------------------------------------------

--
-- Table structure for table `stampcard`
--

DROP TABLE IF EXISTS `stampcard`;
CREATE TABLE IF NOT EXISTS `stampcard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `amount_lessons` int NOT NULL,
  `remaining_lessons` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postalcode` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone_nr` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `address`, `postalcode`, `city`, `telephone_nr`, `email`, `password`, `archived`) VALUES
(1, 'Thomas Maly', 'Pastoor Drehmannsstraat', '6049AT', 'Roermond, Herten', '06 30108668', 'thomasmaly69@gmail.com', '701f33b8d1366cde9cb3822256a62c01', 0),
(2, 'Jopie Teunen', 'Straatnaam 8', '9090PO', 'Heerlen', '06 30108668', 'jopie@hotmail.com', '701f33b8d1366cde9cb3822256a62c01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `license_plate` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `brand` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `model` varchar(50) NOT NULL,
  `fuel` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `has_cruise_control` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`license_plate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`license_plate`, `brand`, `model`, `fuel`, `has_cruise_control`, `archived`) VALUES
('92-hxk-9', 'Kia', 'Niro', 'Diesel', 1, 0),
('15-tyl-2', 'Opel', 'Asta', 'Benzine', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
