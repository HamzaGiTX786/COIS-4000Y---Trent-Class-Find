-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2023 at 07:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamzasalimattarwala`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userId` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `major` varchar(1000) NOT NULL,
  `Joining_date` date NOT NULL,
  `Grad_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userId`, `username`, `password`, `email`, `fname`, `lname`, `major`, `Joining_date`, `Grad_date`) VALUES
(1, 'hamzasalimattarwala', '$2y$10$re7fJ78Wg4NUxgn6nGzs3eHK/9pjlKnm23kZp6p9JJt38LxnIZNfW', 'attarwalahamza@gmail.com', 'Hamza', 'Attarwala', '', '0000-00-00', '0000-00-00'),
(2, 'Hola', '$2y$10$k5cEMblygVYTdOEAc9k/feg.I9vKjpmVe4TJ9NKr0SDmYz8lpMr4i', 'some@something.com', 'K', 'B', '', '0000-00-00', '0000-00-00'),
(3, 'shebang', '$2y$10$Det58kFQXwzLNtplu9VnxuH0UGQTpaM3CW/n8cmlYE.8EIiyFV8Yi', 'to@do.com', 'She', 'Bang', '', '0000-00-00', '0000-00-00'),
(5, 'h', '$2y$10$ygsgnYQwUm9SKDHzciQK..BcKMviOtbApplxJgvhsAcaLBKoiAkhe', 'att@tod.com', 'Ham', 'ZA', 'cs', '2022-10-11', '0000-00-00'),
(6, 'test', '$2y$10$0/Td5gGV6iZgSonIrAfvyuesCNdgof4EtxdwIjuxfOWVHVWX7lIQC', 'test@justtesting.com', 'Test', 'lastname', 'CS', '2019-09-01', '0000-00-00'),
(7, 'random', '$2y$10$hFEf.tG8rPcPLDqGiKFS0OA28wEiTkSDNsuLiWCMGvLB.BE7MMrcm', 'sas@hdfgdf.com', 'rand', 'test', 'CS', '2022-11-18', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
