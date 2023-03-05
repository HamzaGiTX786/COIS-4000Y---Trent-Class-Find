-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2023 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classfind`
--

-- --------------------------------------------------------

--
-- Table structure for table `Edge`
--

CREATE TABLE `Edge` (
  `ID` int(255) NOT NULL,
  `Start_Node` varchar(255) NOT NULL,
  `End_Node` varchar(255) NOT NULL,
  `Distance` int(255) NOT NULL,
  `Image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Image`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Edge`
--

INSERT INTO `Edge` (`ID`, `Start_Node`, `End_Node`, `Distance`, `Image`) VALUES
(1, 'acm', 'tcsm', 200, NULL),
(2, 'acm', 'bhm', 235, NULL),
(3, 'acm', 'lece', 320, NULL),
(4, 'bhm', 'acm', 235, NULL),
(5, 'blm', 'ccm', 85, NULL),
(6, 'blm', 'tscm', 75, NULL),
(7, 'blm', 'fbw', 70, NULL),
(8, 'blm', 'bm', 50, NULL),
(9, 'bm', 'ccm', 40, NULL),
(10, 'bm', 'blm', 50, NULL),
(11, 'bm', 'lece', 85, NULL),
(12, 'ccm', 'bm', 40, NULL),
(13, 'ccm', 'fbw', 40, NULL),
(14, 'ccm', 'lece', 85, NULL),
(15, 'ccm', 'blm', 85, NULL),
(16, 'ccm', 'lecn', 120, NULL),
(17, 'csbm', 'ecn', 100, NULL),
(18, 'csbm', 'escs', 38, NULL),
(19, 'csbm', 'fbe', 45, NULL),
(20, 'dnam', 'lhscm', 115, NULL),
(21, 'dnam', 'oce', 140, NULL),
(22, 'dnam', 'ece', 200, NULL),
(23, 'ece', 'ecn', 60, NULL),
(24, 'ece', 'ecs', 75, NULL),
(25, 'ece', 'dnam', 200, NULL),
(26, 'ece', 'ocw', 52, NULL),
(27, 'ecn', 'ece', 60, NULL),
(28, 'ecn', 'ecs', 100, NULL),
(29, 'ecn', 'csbm', 90, NULL),
(30, 'ecn', 'ocw', 76, NULL),
(31, 'ecs', 'ece', 75, NULL),
(32, 'ecs', 'ece', 75, NULL),
(33, 'ecs', 'ecn', 100, NULL),
(34, 'escs', 'csbm', 38, NULL),
(35, 'escs', 'fbe', 28, NULL),
(36, 'fbe', 'csbm', 45, NULL),
(37, 'fbe', 'fbw', 87, NULL),
(38, 'fbe', 'escs', 28, NULL),
(39, 'fbw', 'fbe', 87, NULL),
(40, 'fbw', 'ccm', 40, NULL),
(41, 'fbw', 'blm', 70, NULL),
(42, 'lece', 'lecn', 82, NULL),
(43, 'lece', 'ccm', 85, NULL),
(44, 'lecn', 'lece', 82, NULL),
(45, 'lecn', 'ccm', 120, NULL),
(46, 'lhscm', 'dnam', 115, NULL),
(47, 'lhscm', 'oce', 160, NULL),
(48, 'lhscm', 'sce', 177, NULL),
(49, 'oce', 'ocw', 60, NULL),
(50, 'oce', 'sce', 55, NULL),
(51, 'oce', 'lhscm', 160, NULL),
(52, 'oce', 'dnam', 115, NULL),
(53, 'ocw', 'oce', 60, NULL),
(54, 'ocw', 'ece', 52, NULL),
(55, 'ocw', 'scw', 110, NULL),
(56, 'sce', 'oce', 55, NULL),
(57, 'scw', 'esce', 45, NULL),
(58, 'tscm', 'blm', 75, NULL),
(59, 'tscm', 'acm', 200, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Edge`
--
ALTER TABLE `Edge`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Edge`
--
ALTER TABLE `Edge`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
