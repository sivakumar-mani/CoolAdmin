-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 06:48 PM
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
-- Table structure for table `complaint_work_order`
--

CREATE TABLE `complaint_work_order` (
  `cwo_id` int(11) NOT NULL,
  `cwo_code` varchar(25) NOT NULL,
  `emp_code` varchar(25) NOT NULL,
  `tech_name` varchar(100) NOT NULL,
  `comp_code` varchar(25) NOT NULL,
  `cwo_date` date NOT NULL,
  `cwo_timedate` varchar(25) NOT NULL,
  `cwo_amount` int(15) NOT NULL,
  `cwo_status` varchar(25) NOT NULL,
  `cwo_material_given` varchar(10) NOT NULL,
  `cwo_remedies` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint_work_order`
--

INSERT INTO `complaint_work_order` (`cwo_id`, `cwo_code`, `emp_code`, `tech_name`, `comp_code`, `cwo_date`, `cwo_timedate`, `cwo_amount`, `cwo_status`, `cwo_material_given`, `cwo_remedies`) VALUES
(1, 'CWO1', 'EMP45', 'Kumaran K', 'OPE18', '2022-05-31', '31-05-2022 20:22:31', 1000, 'Assigned', 'Yes', 'Remedies / Reason /Remark'),
(2, 'CWO1', 'EMP45', 'Kumaran K', 'OPE18', '2022-06-01', '31-05-2022 20:27:06', 0, 'Completed', 'No', 'Remedies / Reason /Remark'),
(3, 'CWO3', 'EMP25', 'sivakumar mani', 'OTH19', '2022-06-02', '31-05-2022 20:33:41', 1000, 'Assigned', 'Yes', '     header(\'location:complaint-edit.php?compid=\'.$compcode);\r\n				exit;'),
(4, 'CWO4', 'EMP25', 'sivakumar mani', 'ENQ22', '2022-06-01', '31-05-2022 20:35:56', 1000, 'Assigned', 'Yes', 'Remedies / Reason /Remark'),
(5, 'CWO4', 'EMP33', 'sivakumar mani', 'ENQ22', '2022-06-02', '31-05-2022 20:36:39', 2000, 'Completed', 'Yes', 'Remedies / Reason /Remark'),
(6, 'CWO6', 'EMP25 sivakumar mani ', '', 'CFB26', '2022-06-01', '03-06-2022 09:12:59', 200, 'Reassigned', 'Yes', 'Remedies / Reason /RemarkRemedies / Reason /RemarkRemedies / Reason /RemarkRemedies / Reason /Remark'),
(7, 'CWO7', 'EMP45 Kumaran K', '', 'CFB29', '2022-06-05', '01-06-2022 19:05:46', 5000, 'Reassigned', 'No', 'Remedies / Reason /RemarkRemedies / Reason /RemarkRemedies / Reason /Remark'),
(8, 'CWO8', 'EMP36', 'Vijay Mani', 'CFB24', '2022-06-03', '03-06-2022 07:50:48', 1000, 'Assigned', 'No', 'Remedies /  Remedies /'),
(9, 'CWO8', 'EMP36', 'Vijay Mani', 'CFB24', '2022-06-04', '03-06-2022 07:57:54', 1000, 'Hold', 'Yes', 'not available '),
(10, 'CWO10', 'EMP25', 'sivakumar mani', 'OTH17', '2022-06-03', '03-06-2022 10:08:34', 1000, 'Assigned', 'No', 'SDAFSADSAD'),
(11, 'CWO10', 'EMP45', 'Kumaran K', 'OTH17', '2022-06-02', '03-06-2022 09:23:40', 1000, 'Assigned', 'Yes', 'Remedies '),
(12, 'CWO7', 'EMP25', 'sivakumar mani', 'CFB29', '2022-06-04', '03-06-2022 10:22:45', 1000, 'Hold', 'Yes', 'dddd'),
(13, 'CWO7', 'EMP45', 'Kumaran K', 'CFB29', '2022-06-04', '03-06-2022 10:23:42', 100, 'Reassigned', 'Yes', 'ffff'),
(14, 'CWO14', 'EMP33', 'sivakumar mani', '', '2022-06-05', '05-06-2022 19:07:10', 1000, 'Assigned', 'Yes', 'the text from wrapping, you can apply white-space: nowrap;.'),
(15, 'CWO15', 'EMP27 DDDDdd1w DDd', '', 'CFB28', '2022-06-04', '05-06-2022 19:07:52', 2000, 'Assigned', 'No', 'cwo_code cwo_codecwo_codecwo_code  '),
(16, 'CWO15', 'EMP25 sivakumar mani', '', 'CFB28', '2022-06-05', '05-06-2022 19:17:27', 5000, 'Hold', 'Yes', 'Remedies / Reason /RemarkRemedies / Reason /RemarkRemedies / Reason /Remark'),
(17, 'CWO17', 'EMP25', 'Aravind a', 'CFB27', '2022-06-01', '06-06-2022 18:31:38', 1000, 'Assigned', 'No', 'material not given'),
(18, 'CWO18', 'EMP35', 'dd dd', 'OTH20', '2022-06-01', '06-06-2022 19:23:46', 5000, 'Assigned', 'Yes', 'Tesstin gpurpose only ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint_work_order`
--
ALTER TABLE `complaint_work_order`
  ADD PRIMARY KEY (`cwo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_work_order`
--
ALTER TABLE `complaint_work_order`
  MODIFY `cwo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
