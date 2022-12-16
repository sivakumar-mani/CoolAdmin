-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 06:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snehadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `categoryId` varchar(100) NOT NULL,
  `categoryname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `categoryId`, `categoryname`) VALUES
(1, 'CAT1', '2MP HD 4SATA'),
(2, 'CAT2', '5MB 4SATA'),
(3, 'CAT3', '3MP HD'),
(4, 'CAT4', '7MP HD SATA1'),
(5, 'CAT5', '13C'),
(6, 'CAT6', 'DD'),
(7, 'CAT7', 'DDD3'),
(8, 'CAT8', '2MP HD 4SATA'),
(9, 'CAT9', '1000'),
(10, 'CAT10', '12MP'),
(11, 'CAT11', '12MP HD'),
(12, 'CAT12', '2MP HD 2SATA'),
(13, 'CAT13', '2MB HD 2SATA'),
(14, 'CAT14', 'CAMERA'),
(15, 'CAT15', 'CAMERA1'),
(16, 'CAT16', 'TEST'),
(17, 'CAT17', '12MP HD1'),
(18, 'CAT18', '2000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
