-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 01:27 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trafficdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL COMMENT 'admin = 1, traffic = 2, police = 3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `fname`, `mname`, `lname`, `level`) VALUES
('admin', 'd82494f05d6917ba02f7aaa29689ccb444bb73f20380876cb05d1f37537b7892', 'Admin', 'Gen', 'General Admin', 1),
('bonbon', '049d36c1a6b4cf8411ff9e13e0d375d1668f9c66827841c4842b7e9f42586843', 'Christian', 'De la cruz', 'Gasper', 3),
('traffic', '9238fc1664e7f0507100d9313810f4c1a4bdc1fa11f2bd670798a8a3250e2fbb', 'John froi', 'Adera', 'Dejaresco', 2);

-- --------------------------------------------------------

--
-- Table structure for table `endorser`
--

CREATE TABLE `endorser` (
  `endorser_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `endorser`
--

INSERT INTO `endorser` (`endorser_id`, `fname`, `mname`, `lname`, `contact`) VALUES
(6, 'haha', 'hahaha', 'hahaha', 'hahaha'),
(7, 'heheh', 'ehehe', 'heheh', 'hehehe');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `pen_id` int(12) NOT NULL,
  `vio_id` int(12) NOT NULL,
  `penalty` varchar(255) NOT NULL,
  `offense` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`pen_id`, `vio_id`, `penalty`, `offense`) VALUES
(9, 4, '1231', 'Offense 1'),
(10, 4, '1231', 'Offense 7'),
(11, 5, '1131', 'Offense 5'),
(12, 6, '5000', 'Offense 7');

-- --------------------------------------------------------

--
-- Table structure for table `violation`
--

CREATE TABLE `violation` (
  `vio_id` int(11) NOT NULL,
  `violation` varchar(255) NOT NULL,
  `no_offense` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violation`
--

INSERT INTO `violation` (`vio_id`, `violation`, `no_offense`) VALUES
(4, 'qqq', 123),
(5, 'asdasd', 11),
(6, 'test', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `violator`
--

CREATE TABLE `violator` (
  `v_id` int(12) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `ctc` int(12) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date_apprehend` date NOT NULL,
  `endorser_id` int(15) NOT NULL,
  `impound` varchar(255) NOT NULL,
  `chassis_no` varchar(255) NOT NULL,
  `engine_no` varchar(255) NOT NULL,
  `date_release` date NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `remarks` int(1) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator`
--

INSERT INTO `violator` (`v_id`, `fname`, `mname`, `lname`, `address`, `bday`, `pic`, `ctc`, `owner`, `date_apprehend`, `endorser_id`, `impound`, `chassis_no`, `engine_no`, `date_release`, `receipt_no`, `status`, `remarks`, `noted_by`, `gender`) VALUES
(1, 'qweqweqwe', 'asdsa', 'asdsad', 'qweqwe', '2018-09-13', '5b0fc400-a10c-47f2-9888-94a60a000006.jpg', 22222, 'qweqwe', '2018-09-13', 6, 'dqweqwe', 'qweqw', 'qweqwe', '2018-09-13', '123123213', 2, 1, '123123asdasd', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `violator_offense`
--

CREATE TABLE `violator_offense` (
  `violator_offense_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `pen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator_offense`
--

INSERT INTO `violator_offense` (`violator_offense_id`, `v_id`, `pen_id`) VALUES
(30, 1, 9),
(31, 1, 10),
(32, 1, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `endorser`
--
ALTER TABLE `endorser`
  ADD PRIMARY KEY (`endorser_id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`pen_id`),
  ADD KEY `vio_id` (`vio_id`);

--
-- Indexes for table `violation`
--
ALTER TABLE `violation`
  ADD PRIMARY KEY (`vio_id`),
  ADD UNIQUE KEY `violation` (`violation`);

--
-- Indexes for table `violator`
--
ALTER TABLE `violator`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `ctc` (`ctc`),
  ADD KEY `endorser_id` (`endorser_id`);

--
-- Indexes for table `violator_offense`
--
ALTER TABLE `violator_offense`
  ADD PRIMARY KEY (`violator_offense_id`),
  ADD KEY `v_id` (`v_id`),
  ADD KEY `pen_id` (`pen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `endorser`
--
ALTER TABLE `endorser`
  MODIFY `endorser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `pen_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `violation`
--
ALTER TABLE `violation`
  MODIFY `vio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `violator`
--
ALTER TABLE `violator`
  MODIFY `v_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `violator_offense`
--
ALTER TABLE `violator_offense`
  MODIFY `violator_offense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penalty`
--
ALTER TABLE `penalty`
  ADD CONSTRAINT `consViolation` FOREIGN KEY (`vio_id`) REFERENCES `violation` (`vio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `violator`
--
ALTER TABLE `violator`
  ADD CONSTRAINT `consEndorser` FOREIGN KEY (`endorser_id`) REFERENCES `endorser` (`endorser_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `violator_offense`
--
ALTER TABLE `violator_offense`
  ADD CONSTRAINT `pen_fk` FOREIGN KEY (`pen_id`) REFERENCES `penalty` (`pen_id`),
  ADD CONSTRAINT `violator_fk` FOREIGN KEY (`v_id`) REFERENCES `violator` (`v_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
