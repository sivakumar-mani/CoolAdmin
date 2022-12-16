-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 09:12 AM
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
-- Table structure for table `account_ledger`
--

CREATE TABLE `account_ledger` (
  `ac_trans_id` int(11) NOT NULL,
  `ac_trans_date` date NOT NULL,
  `ac_trans_type` varchar(25) NOT NULL,
  `ac_trans_mode` varchar(25) NOT NULL,
  `trans_name` varchar(100) NOT NULL,
  `ac_trans_details` varchar(256) NOT NULL,
  `ac_trans_no` varchar(100) NOT NULL,
  `ac_amount` int(50) NOT NULL,
  `ac_balance` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_ledger`
--

INSERT INTO `account_ledger` (`ac_trans_id`, `ac_trans_date`, `ac_trans_type`, `ac_trans_mode`, `trans_name`, `ac_trans_details`, `ac_trans_no`, `ac_amount`, `ac_balance`) VALUES
(66, '2022-05-29', 'Debit', 'Merchant App', 'Gpay', 'test amount for cash', 22232, 5000, 0),
(63, '2022-05-17', 'Credit', 'Cheque', 'Indian bank', 'dfdff', 22232, 100, 0),
(64, '2022-05-22', 'Debit', 'Merchant App', 'gpay', 'amount cpdfds  to rajesh ', 4343434, 100, 0),
(65, '2022-05-23', 'Credit', 'Cheque', 'Indian bank', 'amount received for jodjgdsj ', 22232, 100000, 0),
(67, '2022-07-27', 'Debit', 'Cash', 'indian', 'dasfasdas', 22232, 5000, 0),
(68, '2022-07-27', 'Credit', 'Merchant App', 'gpay', 'test', 434343, 10000, 0),
(69, '2022-07-26', 'Credit', 'Cash', 'cash voucher', 'tests', 434343, 5000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_ledger`
--
ALTER TABLE `account_ledger`
  ADD PRIMARY KEY (`ac_trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_ledger`
--
ALTER TABLE `account_ledger`
  MODIFY `ac_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
