-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 07:28 PM
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
-- Table structure for table `cwo_support_docs`
--

CREATE TABLE `cwo_support_docs` (
  `attach_id` int(11) NOT NULL,
  `cwo_code` varchar(25) NOT NULL,
  `comp_code` varchar(25) NOT NULL,
  `sender_emp_code` varchar(25) NOT NULL,
  `uploded_emp_code` varchar(25) NOT NULL,
  `send_staff_name` varchar(100) NOT NULL,
  `uploded_staff_name` varchar(100) NOT NULL,
  `doc_received_date` date NOT NULL,
  `doc_updated_date` date NOT NULL,
  `docs_img_path` varchar(1000) NOT NULL,
  `docs_img_name` varchar(250) NOT NULL,
  `attach_comments` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cwo_support_docs`
--

INSERT INTO `cwo_support_docs` (`attach_id`, `cwo_code`, `comp_code`, `sender_emp_code`, `uploded_emp_code`, `send_staff_name`, `uploded_staff_name`, `doc_received_date`, `doc_updated_date`, `docs_img_path`, `docs_img_name`, `attach_comments`) VALUES
(1, 'CWO6', 'CFB26', 'EMP25 sivakumar mani  ', 'EMP45 Kumaran K', 'sivakumar mani', 'Kumaran K', '2022-06-02', '2022-06-07', '../assets/images/cwo/', 'banner.jpg', 'test'),
(2, 'CWO6', '', 'EMP25', 'EMP35', 'Aravind a', 'dd dd', '2022-06-03', '2022-06-08', '../assets/images/cwo/', 'carosuel.html', 'tes t   rweww siva'),
(3, 'CWO17', '', 'EMP45', 'EMP25', 'Kumaran K', 'Aravind a', '2022-06-08', '2022-06-28', '../assets/images/cwo/', 'modal.html', 'eese test'),
(4, 'CWO17', '', 'EMP25', 'EMP45', ' ', 'Kumaran K', '2022-06-08', '2022-06-15', '../assets/images/cwo/', 'carosuel.html', 'wdwa wewa wew qwewrwe test'),
(5, 'CWO18', 'OTH20', 'EMP33', 'EMP25', ' ', ' ', '2022-06-05', '2022-06-10', '../assets/images/cwo/', '', 'Remark Remark Remark'),
(6, 'CWO15', 'CFB28', 'EMP27', 'EMP25', 'DDDDdd1w', 'Aravind', '2022-06-08', '2022-06-08', '../assets/images/cwo/', '', 'Remark'),
(7, 'CWO15', 'CFB28', 'EMP27', 'EMP27', 'DDDDdd1w', 'DDDDdd1w', '2022-06-02', '2022-06-08', '../assets/images/cwo/', 'banner.jpg', 'EMP27 DDDDdd1w DDd  dd'),
(8, 'CWO24', 'CFB34', 'EMP25', '', 'Aravind', 'EMP28', '2022-07-27', '2022-07-28', '../assets/images/cwo/', 'Demo Screens (2).pdf', 'Remark'),
(9, 'CWO24', 'CFB34', '', '', 'EMP28 ddd', 'EMP28 ddd', '2022-07-22', '2022-07-27', '../assets/images/cwo/', 'neha-11830-Assignment.pdf', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cwo_support_docs`
--
ALTER TABLE `cwo_support_docs`
  ADD PRIMARY KEY (`attach_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cwo_support_docs`
--
ALTER TABLE `cwo_support_docs`
  MODIFY `attach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
