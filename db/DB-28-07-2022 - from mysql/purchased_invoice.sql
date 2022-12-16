-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 07:37 PM
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
-- Table structure for table `purchased_invoice`
--

CREATE TABLE `purchased_invoice` (
  `ivid` int(11) NOT NULL,
  `invoiceid` varchar(100) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `vendorcompanyname` varchar(100) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceno` varchar(25) NOT NULL,
  `billno` varchar(25) NOT NULL,
  `totalinvoiceamount` int(25) NOT NULL,
  `totalpaidamount` int(25) NOT NULL,
  `totalbalanceamount` int(25) NOT NULL,
  `totaldiscount` int(25) NOT NULL,
  `totalgst` int(25) NOT NULL,
  `docspath` varchar(600) NOT NULL,
  `docsname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_invoice`
--

INSERT INTO `purchased_invoice` (`ivid`, `invoiceid`, `vendorid`, `vendorcompanyname`, `invoicedate`, `invoiceno`, `billno`, `totalinvoiceamount`, `totalpaidamount`, `totalbalanceamount`, `totaldiscount`, `totalgst`, `docspath`, `docsname`) VALUES
(1, 'INV1', 'VND14', 'SKY VIEW NETWORK', '2022-07-31', '70011', '70011', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'monkey.webp'),
(2, 'INV2', 'VND14', 'SKY VIEW NETWORK', '2022-07-15', '1111', '222', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'chandran.png'),
(3, 'INV3', 'VND14', 'SKY VIEW NETWORK', '2022-07-23', '1000233', '222', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'neha-11830-Assignment.pdf'),
(4, 'INV4', 'VND14', 'SKY VIEW NETWORK', '2022-07-23', '1', '222', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'timetable.pdf'),
(5, 'INV5', 'VND14', 'SKY VIEW NETWORK', '2022-07-23', '70011', '70011', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'jaya.png'),
(6, 'INV6', 'VND14', 'SKY VIEW NETWORK', '2022-07-29', '70013', '7001', 0, 1000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'Demo Screens (2).pdf'),
(7, 'INV7', 'VND14', 'SKY VIEW NETWORK', '2022-07-22', '10002331', '222', 0, 5000, 0, 0, 0, '../assets/images/purchaseInvoice/', 'comparing-quantities.docx'),
(8, 'INV8', 'VND14', 'SKY VIEW NETWORK', '2022-07-22', '11111', '7001', 30000, 1000, 0, 0, 5400, '../assets/images/purchaseInvoice/', 'INTEGERS.docx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchased_invoice`
--
ALTER TABLE `purchased_invoice`
  ADD PRIMARY KEY (`ivid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchased_invoice`
--
ALTER TABLE `purchased_invoice`
  MODIFY `ivid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
