-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 06:44 PM
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
-- Table structure for table `complaint_register`
--

CREATE TABLE `complaint_register` (
  `comp_id` int(11) NOT NULL,
  `comp_code` varchar(25) NOT NULL,
  `comp_name` varchar(256) NOT NULL,
  `comp_subject` varchar(256) NOT NULL,
  `comp_email` varchar(256) NOT NULL,
  `comp_bankname` varchar(256) NOT NULL,
  `comp_branch` varchar(256) NOT NULL,
  `comp_baddress` varchar(256) NOT NULL,
  `comp_number` varchar(15) DEFAULT NULL,
  `comp_date` date NOT NULL,
  `comp_datetime` varchar(30) NOT NULL,
  `comp_status` varchar(15) NOT NULL,
  `comp_msg` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint_register`
--

INSERT INTO `complaint_register` (`comp_id`, `comp_code`, `comp_name`, `comp_subject`, `comp_email`, `comp_bankname`, `comp_branch`, `comp_baddress`, `comp_number`, `comp_date`, `comp_datetime`, `comp_status`, `comp_msg`) VALUES
(18, 'OPE18', 'siddhesh', 'Open', 'TEST@GMAIL.COM', 'INDIAN BANK', 'URAPAKKAM  ', '2 2nd Street Arkeeswarar Colony', '3444444444', '2022-04-02', '02-04-2022 14:02:53', 'Completed', 'something shaped like a human a clothes store dummy'),
(19, '', 'Sivakumar mani', 'others', 'sivakumar.pmani@gmail.com', 'City union bank', 'URAPAKKAM ', 'VIJAYALAKSHMI K\r\nTnt Sundar, 6th Cross Street, Arkeeswarar Colony', '09962543540', '2022-04-02', '02-04-2022 19:43:15', 'Assigned', '6-C, 1st Floor, SS Classic Apt, LIC colony, 2nd Cross Street, Pammal'),
(24, 'CFB24', 'Sivakumar ', 'complaint', 'sivakumar.pmani@gmail.com', 'City union bank', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-05-16', '16-05-2022 13:03:23', 'Hold', '2 2nd Street Arkeeswarar Colony'),
(22, 'ENQ22', 'Mythili', 'enquiry', 'mythili.msiva@gmail.com', 'City union bank', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '9962543541', '2022-04-04', '04-04-2022 16:36:49', 'Completed', 'Tea podiu'),
(23, 'COM23', 'Sivakumar ', 'complaint', 'sivakumar.pmani@gmail.com', 'City union bank', 'chromept ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-04-09', '09-04-2022 13:50:44', 'Completed', 'gdggdfgfdg'),
(16, 'COM16', 'siddhesh', 'complaint', 'TEST@GMAIL.COM', 'INDIAN BANK', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '3444444444', '2022-04-02', '02-04-2022 13:09:03', 'Assigned', 'something shaped like a human a clothes store dummy'),
(20, 'OTH20', 'Prakatheeshwaran', 'others', 'sivakumar.pmani@gmail.com', 'City union bank', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-04-02', '02-04-2022 20:09:38', 'Assigned', 'NCERT Solutions for Class 7 Maths Exercise 12.2 Chapter 12 Algebraic Expressions in simple PDF are available here. Adding and subtracting like terms and adding and subtracting general algebraic expressions are the two topics covered in t'),
(17, 'OTH17', 'Siddheshwar', 'others', 'TEST@GMAIL.COM', 'INDIAN BANK', 'URAPAKKAM  ', '2 2nd Street Arkeeswarar Colony', '3444444444', '2022-04-02', '02-04-2022 13:14:38', 'Assigned', 'something shaped like a human a clothes store dummy'),
(25, ' ', 'Prakatheeshwaran', 'complaint', 'sivakumar.pmani@gmail.com', 'City union bank', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-05-16', '16-05-2022 22:53:02', 'Assigned', '2 2nd Street Arkeeswarar Colony'),
(26, 'CFB26', 'Sivakumar ', 'complaint', 'sivakumar.pmani@gmail.com', 'City union bank', 'URAPAKKAM ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-05-16', '16-05-2022 22:54:00', 'Reassigned', 'sdsds'),
(27, 'CFB27', 'Sivakumar ', 'complaint', 'sivakumar.pmani@gmail.com', 'City union bank', 'chromept ', '2 2nd Street Arkeeswarar Colony', '09962543540', '2022-05-18', '18-05-2022 13:31:03', 'Assigned', '2 2nd Street Arkeeswarar Colony'),
(28, 'CFB28', 'Sivakumar Mani', 'Feedback', 'timecablevision@gmail.com', 'Icici bank', 'cenotaph ', '4, cenotaph road, chennai ', '9884543540', '2022-05-18', '18-05-2022 14:00:56', 'Reassigned', 'i would like to check this'),
(29, 'CFB29', 'Mythili sivakumar', 'enquiry', 'mythili.msiva@gmail.com', 'Kodak', 'Mount road ', 'mount road, chennai', '00000000', '2022-05-18', '18-05-2022 18:56:15', 'Reassigned', 'this is thetest message from siva'),
(30, 'CFB30', '', '', '', '', ' ', '', '', '2022-05-29', '29-05-2022 23:14:02', 'Open', ''),
(31, 'CFB31', '', '', '', '', ' ', '', '', '2022-05-29', '29-05-2022 23:14:04', 'Open', ''),
(32, 'CFB32', '', '', '', '', ' ', '', '', '2022-05-29', '29-05-2022 23:14:06', 'Open', ''),
(33, 'CFB33', '', '', '', '', ' ', '', '', '2022-05-29', '29-05-2022 23:14:08', 'Open', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint_register`
--
ALTER TABLE `complaint_register`
  ADD PRIMARY KEY (`comp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_register`
--
ALTER TABLE `complaint_register`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
