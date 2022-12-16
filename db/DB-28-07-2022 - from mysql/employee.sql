-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 09:31 AM
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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(25) NOT NULL,
  `emp_fname` varchar(25) NOT NULL,
  `emp_lname` varchar(25) NOT NULL,
  `emp_marital_status` varchar(10) NOT NULL,
  `emp_sname` varchar(100) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_doj` date NOT NULL,
  `emp_dor` date NOT NULL,
  `emp_mobileno` int(50) NOT NULL,
  `emp_amobileno` int(50) NOT NULL,
  `emp_paddress` varchar(250) NOT NULL,
  `emp_taddress` varchar(250) NOT NULL,
  `emp_salary` int(50) NOT NULL,
  `emp_office_email` varchar(250) NOT NULL,
  `emp_bank_details` varchar(250) NOT NULL,
  `emp_office_notes` varchar(250) NOT NULL,
  `emp_dept` varchar(100) NOT NULL,
  `emp_status` varchar(100) NOT NULL,
  `emp_qualification` varchar(100) NOT NULL,
  `emp_profile_img_path` varchar(1000) NOT NULL,
  `emp_profile_img_name` varchar(250) NOT NULL,
  `emp_aadhar` int(15) NOT NULL,
  `emp_desig` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_code`, `emp_fname`, `emp_lname`, `emp_marital_status`, `emp_sname`, `emp_dob`, `emp_doj`, `emp_dor`, `emp_mobileno`, `emp_amobileno`, `emp_paddress`, `emp_taddress`, `emp_salary`, `emp_office_email`, `emp_bank_details`, `emp_office_notes`, `emp_dept`, `emp_status`, `emp_qualification`, `emp_profile_img_path`, `emp_profile_img_name`, `emp_aadhar`, `emp_desig`) VALUES
(24, 'EMP34', 'sivakumar1', ' mani1', 'true', 'mythili1', '2022-05-22', '2022-05-23', '2022-05-23', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'sdsds', 'sdsdsd', 'Office', 'Working', 'MCA', '../assets/images/employee/', 'balaji.png', 44545454, ''),
(25, 'EMP25', 'Aravind', 'a', 'Married', 'subha', '2022-05-21', '2022-05-22', '2022-05-22', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'sdas', 'sdsds', 'Office', 'Working', 'MCA', '../assets/images/employee/', 'clay.png', 44545454, 'Engineer'),
(26, '', 'raj', 'dfd', 'true', 'fdfsf', '2022-05-26', '2022-05-26', '2022-05-26', 0, 0, 'sdfsdfsd', 'fsdfd', 0, 'sivakumar.pmani@gmail.com', 'ffds', 'fdfds', 'Technical', 'Working', 'MCA', '../assets/images/employee/', 'murali.png', 0, ''),
(27, 'EMP27', 'DDDDdd1w', 'DDd', 'married', 'DD', '2022-05-26', '2022-05-20', '2022-05-20', 0, 0, 'DD', 'DDd', 0, 'D', 'DDdd', 'DDdddd', 'Technical', 'Working', 'DDDD', '../assets/images/employee/', 'mohanbir.png', 0, ''),
(28, 'EMP28', 'ddd', 'dd', 'single', 'dddd', '2022-05-19', '2022-05-19', '2022-05-19', 0, 0, 'ddd', 'ddd', 0, 'sivakumar.pmani@gmail.com', 'dd', 'dd', 'Technical', 'Working', 'dd', '../assets/images/employee/', 'shanthi.png', 0, ''),
(29, 'EMP29', '', '', 'married', '', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', 0, '', '', '', 'Select Department', 'Working', '', '../assets/images/employee/', 'src.zip', 0, ''),
(30, 'EMP30', 'dsfsdfs', 'sdfdf', 'single', 'dfdf', '2022-05-28', '2022-05-27', '2022-05-27', 0, 0, 'sdfsdf', 'fsdfd', 5, 'sivakumar.pmani@gmail.com', 'efwef', 'wefwe', 'Technical', 'Working', 'ggg', '../assets/images/employee/', 'jaya.png', 0, 'Engineer'),
(31, 'EMP31', '', '', 'married', '', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', 0, '', '', '', 'Select Department', 'Working', '', '../assets/images/employee/', 'chetan.png', 0, ''),
(32, 'EMP32', '', '', 'married', '', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', 0, '', '', '', 'Technical', 'Working', '', '../assets/images/employee/', 'clay.png', 0, ''),
(33, 'EMP33', 'sivakumar', ' mani', 'single', 'mythili', '2022-05-01', '2022-05-14', '2022-05-14', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 'Office', 'Resigned', 'MCA', '../assets/images/employee/', '', 44545454, 'manager'),
(34, 'EMP34', 'Karthik', 'raja', 'single', 'banu', '2022-05-01', '2022-05-25', '2022-05-25', 2147483647, 2147483647, 'dfsdfdsf', 'ffsdfsdfsdffsfsdfs', 25000, 'sivakumar.pmani@gmail.com', 'Salary Account Details*', 'Office Notes Office Notes Office Notes', 'Technical', 'Working', 'BA', '../assets/images/employee/', 'sundar.png', 2147483647, ''),
(35, 'EMP35', 'dd', 'dd', 'single', 'dd', '2022-05-13', '2022-05-21', '2022-05-21', 5645645, 654646, 'Temperary address *', 'Temperary address *', 0, 'sivakumar.pmani@gmail.com', 'dd', 'dd', 'Technical', 'Resigned', 'MCA1', '../assets/images/employee/', 'viswanathan.png', 44545454, ''),
(36, 'EMP36', 'Vijay', 'Mani', 'Married', 'kalai', '2022-05-20', '2022-05-27', '2022-05-27', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', '2 2nd Street Arvkeeswarar Colony', 'Salary Account Details', 'Office', 'Working', 'MCA', '../assets/images/employee/', 'ayman.png', 2147483647, 'Engineer'),
(37, 'EMP37', 'sivakumar', ' mani', 'single', 'mythili', '2022-05-26', '2022-05-05', '2022-05-05', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 44444, 'sivakumar.pmani@gmail.com', 'dsfsdfsd', 'sddsfd', 'Office', 'Working', 'MCA', '../assets/images/employee/', 'mohanbir.png', 0, 'Managing Director'),
(38, 'EMP38', 'sivakumar', ' mani', 'Married', 'kalai', '2022-05-18', '2022-05-20', '2022-05-20', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 0, 'sivakumar.pmani@gmail.com', 'ddd', 'dd', 'Technical', 'Working', 'DDDD', '../assets/images/employee/', 'multilevel.zip', 2147483647, 'Engineer'),
(39, '', 'sivakumar', ' mani', 'Married', 'kalai', '2022-05-10', '2022-05-12', '2022-05-12', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'dd', 'ddd', 'Office', 'Working', 'MCA1', '../assets/images/employee/', 'profile_picture.png', 1000033333, 'Engineer'),
(40, '', 'sivakumar', ' mani', 'single', 'mythili', '2022-05-20', '2022-05-18', '2022-05-18', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 44444, 'sivakumar.pmani@gmail.com', 'ddd', 'dd', 'Office', 'Working', 'MCA1', '../assets/images/employee/', 'profile_picture.png', 2147483647, 'Engineer'),
(41, '', 'sivakumar', ' mani', 'Married', 'kalai', '2022-05-19', '2022-05-19', '2022-05-19', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'ddd', 'ddd', 'Technical', 'Working', 'MCA', '../assets/images/employee/', 'chetan.png', 44545454, 'Managing Director'),
(42, 'EMP42', 'sivakumar', 'raja', 'Married', 'kalai', '2022-05-26', '2022-05-20', '2022-05-20', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 546464, 'sivakumar.pmani@gmail.com', 'dd', 'ddd', 'Technical', 'Working', 'MCA', '../assets/images/employee/', 'balaji.png', 2147483647, 'Engineer'),
(43, 'EMP43', 'sivakumar', ' mani', 'Married', 'mythili', '2022-05-18', '2022-05-12', '2022-05-12', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 0, 'sivakumar.pmani@gmail.com', 'dd', 'dd', 'Technical', 'Working', 'MCA', '../assets/images/employee/', '', 44545454, 'Engineer'),
(44, 'EMP44', 'Karthikeyan', 'Raja', 'Married', 'Banu', '2022-05-05', '2022-05-28', '2022-05-28', 2147483647, 2147483647, '2 2nd Street Arkeeswarar Colony', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'dddd', 'dddd', 'Technical', 'Working', 'eee', '../assets/images/employee/', 'mohanbir.png', 44545454, 'Engineer'),
(45, 'EMP45', 'Kumaran', 'K', 'Married', 'Unknown', '2022-05-05', '2022-05-06', '2022-05-06', 2147483647, 2147483647, '09962543540', '2 2nd Street Arkeeswarar Colony', 25000, 'sivakumar.pmani@gmail.com', 'Salary Account Details*', 'Salary Account Details*', 'Office', 'Working', 'MCA', '../assets/images/employee/', 'dp.png', 1000033333, 'Engineer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
