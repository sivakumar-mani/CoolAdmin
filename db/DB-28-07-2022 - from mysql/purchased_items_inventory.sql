-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 07:38 PM
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
-- Table structure for table `purchased_items_inventory`
--

CREATE TABLE `purchased_items_inventory` (
  `pid` int(11) NOT NULL,
  `invoiceid` varchar(100) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `purchaseid` varchar(100) NOT NULL,
  `brandsname` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `serialnumber` varchar(1000) NOT NULL,
  `mrp` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `discount` int(25) NOT NULL,
  `totalprice` int(25) NOT NULL,
  `cgst` int(25) NOT NULL,
  `sgst` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_items_inventory`
--

INSERT INTO `purchased_items_inventory` (`pid`, `invoiceid`, `vendorid`, `purchaseid`, `brandsname`, `itemname`, `categoryname`, `serialnumber`, `mrp`, `quantity`, `discount`, `totalprice`, `cgst`, `sgst`) VALUES
(32, 'INV1', 'VND14', 'PIN1', 'HIKVISION', 'CAMERA', '3MP HD', 'update', 1000, 10, 0, 10000, 900, 900),
(33, 'INV1', 'VND14', 'PIN33', 'HIKVISION', 'CAMERA', '3MP HD', '333sa962543540', 1250, 10, 0, 12500, 1125, 1125),
(34, 'INV1', 'VND14', 'PIN34', 'CP PLUS', 'CAMERA', '12MP', '333sa962543540', 500, 10, 1000, 5000, 450, 450),
(35, 'INV1', 'VND14', 'PIN35', 'CP PLUS', 'CAMERA', '12MP', '333sa962543540', 1000, 10, 0, 10000, 900, 900),
(36, 'INV1', 'VND14', 'PIN36', 'CP PLUS', 'CAMERA', '12MP', '333sa962543540', 2000, 10, 0, 20000, 1800, 1800),
(37, 'INV8', 'VND14', 'PIN37', 'AJUBHA', 'DVR1', '2MP HD 2SATA', '333sa962543540', 15000, 2, 0, 30000, 2700, 2700);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchased_items_inventory`
--
ALTER TABLE `purchased_items_inventory`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchased_items_inventory`
--
ALTER TABLE `purchased_items_inventory`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
