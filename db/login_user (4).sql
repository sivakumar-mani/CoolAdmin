-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 07:30 PM
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
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userfname` varchar(100) NOT NULL,
  `userlname` varchar(100) NOT NULL,
  `userpassword` varchar(15) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `adminlevel` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`userid`, `username`, `userfname`, `userlname`, `userpassword`, `useremail`, `adminlevel`) VALUES
(1, 'saraswathy.m', 'Sivakumar ', 'Mani', 'Welcome@1', 'sivakumar.pmani@gmail.com', 1),
(2, 'siva.m', 'Karthikeyan', 'Raja', 'Welcome@1', 'sivakumar.pmani@gmail.com', 2),
(3, 'supervisor', 'Raja ', 'Mani', 'Welcome@1', 'raja.pmani@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `adminlevel` (`adminlevel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
