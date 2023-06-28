-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 28, 2023 at 01:03 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `password` varchar(30) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `id_invitation` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `last_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `email` varchar(30) COLLATE utf16_bin NOT NULL,
  `comment` varchar(500) COLLATE utf16_bin DEFAULT NULL,
  `attendance` varchar(20) COLLATE utf16_bin NOT NULL,
  `id_event` int NOT NULL,
  PRIMARY KEY (`id_invitation`),
  KEY `FK_Event` (`id_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `new_event`
--

DROP TABLE IF EXISTS `new_event`;
CREATE TABLE IF NOT EXISTS `new_event` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `image` blob NOT NULL,
  `description` varchar(500) COLLATE utf16_bin NOT NULL,
  `address` varchar(50) COLLATE utf16_bin NOT NULL,
  `city` varchar(20) COLLATE utf16_bin NOT NULL,
  `state` varchar(20) COLLATE utf16_bin NOT NULL,
  `date` date NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `FK_EventCreator` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `new_event`
--

INSERT INTO `new_event` (`id_event`, `event_name`, `image`, `description`, `address`, `city`, `state`, `date`, `allow_comments`, `blocked`, `user_id`) VALUES
(1, 'Soner', 0x433a5c77616d7036345c746d705c7068703743462e746d70, 'This is our first event for event websystem', 'Patrisa Lumumbe 31', 'Subotica', 'Serbia', '2023-06-30', 1, 0, 0),
(2, 'Soner', 0x433a5c77616d7036345c746d705c706870313939332e746d70, 'This is our first event for event websystem', 'Patrisa Lumumbe 31', 'Subotica', 'Serbia', '2023-06-30', 1, 0, 0),
(3, 'Soner', 0x433a5c77616d7036345c746d705c706870383431362e746d70, 'This is our first event for event web system', 'Patrisa Lumumbe 31', 'Subotica', 'Serbia', '2023-06-15', 1, 0, 0),
(4, 'Car Event', 0x433a5c77616d7036345c746d705c706870333239342e746d70, 'You are welcome to our big car event', 'Sergeja Jesenjina 19', 'Subotica', 'Serbia', '2023-06-14', 1, 0, 0),
(5, 'Car Event', 0x433a5c77616d7036345c746d705c706870333645392e746d70, 'This is example', 'Mitra Bakica 23', 'Subotica', 'Serbia', '2023-06-14', 1, 0, 0),
(6, 'Car Event', 0x433a5c77616d7036345c746d705c706870324244432e746d70, 'This is example', 'Mitra Bakica 23', 'Subotica', 'Serbia', '2023-06-14', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

DROP TABLE IF EXISTS `registered_user`;
CREATE TABLE IF NOT EXISTS `registered_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `last_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `organization_name` varchar(50) COLLATE utf16_bin NOT NULL,
  `email` varchar(30) COLLATE utf16_bin NOT NULL,
  `password` varchar(75) COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`id`, `first_name`, `last_name`, `organization_name`, `email`, `password`) VALUES
(1, 'Jovana', 'Jovanovic', 'Dormeo', 'jovanovicn@gmail.com', '$2y$10$jOE92XCOeaOdlYLUtfhAIuQG/gxz98mDUpd92g3WHGPzoRVpIG0fm'),
(2, 'Milica', 'Milojkovic', '', 'milicamilo@gmail.com', '$2y$10$uDoG3M7dEQRu3njkeZ9qnegxkU.WrJ.hR7tSS.S6LAgf7gWaBqkze'),
(3, 'Ana', 'Misic', 'Trade DOO', 'anamisic@gmail.com', '$2y$10$ddqYWby3T1RhBm3uMuzG1.0U538DE3tCVmZIiejXTL1AuI.4a8khu'),
(4, 'Ines', 'Muslimovic', 'Bosnia DOO', 'inesmuslim@gmail.com', '$2y$10$hlvnfn3L66e1s.dV2.Ght.ORxicF3SZFqGBORqGllHrG0dqYRVOvm'),
(5, 'Milovan', 'Poljakovic', '', 'milovanp@gmail.com', '$2y$10$WJK8nDn9mQ7im91gef0ZX.fFub0W9EtnB9uEJT7Yfc70vPb.4E7MG'),
(6, 'Nenad', 'Okanovic', 'Oki Trans', 'okanovicn@gmail.com', '$2y$10$OyyL.m5eLIY.AeWDVRvhB.kQdAsiM0FrwiYvSRfkFbSC.9LJP8/za'),
(7, 'Mirjana', 'Savic', '', 'savicm@gmail.com', '$2y$10$UPqUeQJallL0Tlglf0n1vOvwK80Bsl4JPMzOBjVfqjfccyzAKhnka'),
(8, 'Natasa', 'Mujic', '', 'mujicnatasa99@gmail.com', '$2y$10$I3ubjepNm5dqxqKKTJLDj./o5ysuCup5DdOrxo6CzTac.P.PUY3hq'),
(9, 'Ivona', 'Boros', 'VTS DOO', 'ivonuskaboros@gmail.com', '$2y$10$ygkuoB.xvDb9bt5ZB4TKT.NEzMJypE07uRZZMRLuXaZzM8tsqChRC'),
(10, 'Piroska', 'Stanic', 'Mreze DOO', 'piroska@gmail.com', '$2y$10$2//khld/s1VP.48LFnMNVe.PtJAKbsoVtGpHNDvROdomx4IUCFcOO'),
(11, 'Milojka', 'Milojkovic', '', 'milojka@gmail.com', '$2y$10$eL6sn.PK.rvIHi8vjr6Dj.7BowpZCHRx5nvny2DuuGvFMD1ZR8HT2'),
(12, 'Milojka', 'Milojkovic', '', 'milojka@gmail.com', '$2y$10$hveosn7.BCe3zh.S3uFl0eIzfn3SD9B9e1HyLfScBMvuLmff2Axre'),
(13, 'Nadezda', 'Jovovic', 'Jovovic DOO', 'jovovicnada@gmail.com', '$2y$10$aMY8ErUcQUdbf3IAOAdaEejZhvRtVirBBPSjGpfd6N0b8xXYBiI6C'),
(14, 'Nadezda', 'Jovovic', 'Jovovic DOO', 'jovovicnada@gmail.com', '$2y$10$APnjdiFynB4CMO7ahGuMT.PCWnLDlXNLXYidTyEXnK7XYIcqr8I1y'),
(34, 'Jeremija', 'Krstic', 'jeremija DOO', 'jeremija@gmail.com', '$2y$10$RjQHASTWJZYyvMORvKZka.fAi0.4BaMpin3XINcg.fqQFClmrWB5a'),
(17, 'Milena', 'Mandic', '', 'mandicmilena@gmail.com', '$2y$10$T7HczAOLuTmB5xPq0jEdReTlUmPsCGNtwKZ8TpJok4b/nXIm5Emoa'),
(21, 'Jovana', 'Milojkovic', '', '26121014@vts.su.ac.rs', '$2y$10$.yX5V1xBi7/FVOxlcbcGxun3JtnbJhaq1/vWdJv7MWPlMdz4cWS9G'),
(20, 'Sanjika', 'Peic Tukuljac', 'Sanji Baci DOO', 'sanjika@gmail.com', '$2y$10$K75s72aAT0SPqWTKBVC53.resF2aP1Z84bOptJjZW0s2UPJ/VGNd.'),
(22, 'Jelisaveta', 'Sablic', '', 'jelisavetaseka@gmail.com', '$2y$10$JuIyd3XwrGmtAvhdZ4oWquaSR5S4GHkQW0CFLJsCy0iYCI6dWH416'),
(25, 'Sanja', 'Miskovic', '', 'sanjam@gmail.com', '$2y$10$edvomK78jVHdprLCfLhHUO.GzgBwYOxAoXjnX2qjaiNWbXLRg6Il2'),
(26, 'Jovica', 'Jovicic', '', 'jovicic@gmail.com', '$2y$10$O5p0R7Uc87X8clznPII9KuSGcTn0BRCOMGW25Zb8RS1O3M4bkhBZy'),
(27, 'Neda', 'Medaric', '', 'medaricneda@gmail.com', '$2y$10$2KEsJaqVf5eWw0mqZQohMuynjaHC4qqN27VQTIqTDLFK9NO5/q66W'),
(29, 'Verica', 'Bulovic', 'VERKA DOO', 'bulovicv@gmail.com', '$2y$10$9ICRLd48pnvZipyTCZuTY.DBcf2Rnq0EU5E.hPLSNfQDJCxMDF.PW'),
(33, 'Jeremija', 'Krstic', 'jeremija DOO', 'jeremija@gmail.com', '$2y$10$5W84DtW6JPSm.OBzyNCOf.X9GCs1hmoTWETelBSxbV3LG6vDLGnLe');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `last_name` varchar(30) COLLATE utf16_bin NOT NULL,
  `email` varchar(30) COLLATE utf16_bin NOT NULL,
  `id_event` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `FK_Event` (`id_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
