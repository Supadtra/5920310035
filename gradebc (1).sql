-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 06:16 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradebc`
--

-- --------------------------------------------------------

--
-- Table structure for table `gradebc`
--

CREATE TABLE `gradebc` (
  `ID` int(10) NOT NULL,
  `Code` varchar(7) COLLATE utf32_unicode_ci NOT NULL,
  `Year` int(4) NOT NULL,
  `Seme` int(1) NOT NULL,
  `Grade` varchar(1) COLLATE utf32_unicode_ci NOT NULL,
  `Creator` varchar(100) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `gradebc`
--

INSERT INTO `gradebc` (`ID`, `Code`, `Year`, `Seme`, `Grade`, `Creator`) VALUES
(592031001, '748-111', 2560, 1, 'A', 'project.blockchain2563@gmail.com'),
(592031002, '748-111', 2560, 1, 'D', 'project.blockchain2563@gmail.com'),
(592031003, '748-555', 2560, 1, 'A', 'project.blockchain2563@gmail.com'),
(592031004, '748-111', 2560, 1, 'A', 'project.blockchain2563@gmail.com'),
(592031005, '748-111', 2560, 1, 'B', 'project.blockchain2563@gmail.com'),
(592031006, '748-111', 2560, 1, 'B', 'project.blockchain2563@gmail.com'),
(592031007, '748-111', 2560, 1, 'B', 'project.blockchain2563@gmail.com'),
(592031008, '748-111', 2560, 1, 'B', 'project.blockchain2563@gmail.com'),
(592031009, '748-111', 2560, 1, 'C', 'project.blockchain2563@gmail.com'),
(592031010, '748-111', 2560, 1, 'C', 'project.blockchain2563@gmail.com'),
(592031001, '748-222', 2560, 2, 'B', 'project.blockchain2563@gmail.com'),
(592031002, '748-222', 2560, 2, 'B', 'project.blockchain2563@gmail.com'),
(592031003, '748-222', 2560, 2, 'B', 'project.blockchain2563@gmail.com'),
(592031004, '748-222', 2560, 2, 'B', 'project.blockchain2563@gmail.com'),
(592031005, '748-222', 2560, 2, 'C', 'project.blockchain2563@gmail.com'),
(592031006, '748-222', 2560, 2, 'C', 'project.blockchain2563@gmail.com'),
(592031007, '748-222', 2560, 2, 'C', 'project.blockchain2563@gmail.com'),
(592031008, '748-222', 2560, 2, 'C', 'project.blockchain2563@gmail.com'),
(592031009, '748-222', 2560, 2, 'A', 'project.blockchain2563@gmail.com'),
(592031010, '748-222', 2560, 2, 'A', 'project.blockchain2563@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
