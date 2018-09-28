-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 09:57 PM
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
('testuser', '0918a12659e9514d4385fd88274d91f2d5e33f014d90e82c458f3149f67505d3', 'test user', 'test user', 'testuser', 1),
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
(9, 4, '500', 'Offense 1'),
(10, 4, '1000', 'Offense 2'),
(11, 5, '500', 'Offense 1'),
(12, 6, '1000', 'Offense 1'),
(13, 4, '1500', 'Offense 3'),
(14, 5, '1500', 'Offense 2'),
(15, 5, '3000', 'Offense 3'),
(16, 6, '2000', 'Offense 2'),
(17, 6, '4000', 'Offense 3');

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
(4, 'Reckless Driving', 3),
(5, 'No Helmet', 3),
(6, 'Drunk Driving', 3);

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
  `gender` varchar(10) NOT NULL,
  `noted_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator`
--

INSERT INTO `violator` (`v_id`, `fname`, `mname`, `lname`, `address`, `bday`, `pic`, `gender`, `noted_by`) VALUES
(5, 'Christian', 'De la Cruz', 'Gasper', 'Municipal Subd, Sagay City', '1994-06-06', 'download.jpg', 'Male', 'Laiza Layague Javier'),
(6, 'Laiza', 'Layague', 'Javier', 'San Agustin, Sagay city', '1998-11-10', '15894878_397329440603874_3237484684571525350_n.jpg', 'Female', 'Christian Gasper');

-- --------------------------------------------------------

--
-- Table structure for table `violator_offense`
--

CREATE TABLE `violator_offense` (
  `violator_offense_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `pen_id` int(11) NOT NULL,
  `date_apprehend` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  `ctc` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `endorser_id` int(11) DEFAULT NULL,
  `impound` varchar(255) DEFAULT NULL,
  `chassis_no` varchar(255) DEFAULT NULL,
  `engine_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator_offense`
--

INSERT INTO `violator_offense` (`violator_offense_id`, `v_id`, `pen_id`, `date_apprehend`, `remarks`, `status`, `date_released`, `ctc`, `owner`, `endorser_id`, `impound`, `chassis_no`, `engine_no`) VALUES
(1, 5, 9, '2018-09-24', 'Released', 'Settled', '2018-09-29', '135512', 'Laiza', 7, 'Mustang', 'BA-1342', 'BA-2123'),
(2, 5, 11, '2018-09-29', 'Not Released', 'Not Settled', NULL, '135512', 'Christian', 6, 'Ferrari', 'FE-4123', 'FE-1236'),
(3, 6, 11, '2018-09-12', 'Released', 'Settled', '2018-09-18', '113341', 'Bonbon', 7, 'Civic', 'CI-1231', 'CI-3921');

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
  ADD UNIQUE KEY `fname` (`fname`,`mname`,`lname`);

--
-- Indexes for table `violator_offense`
--
ALTER TABLE `violator_offense`
  ADD PRIMARY KEY (`violator_offense_id`),
  ADD KEY `v_id` (`v_id`),
  ADD KEY `pen_id` (`pen_id`),
  ADD KEY `endorser_id` (`endorser_id`);

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
  MODIFY `pen_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `violation`
--
ALTER TABLE `violation`
  MODIFY `vio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `violator`
--
ALTER TABLE `violator`
  MODIFY `v_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `violator_offense`
--
ALTER TABLE `violator_offense`
  MODIFY `violator_offense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penalty`
--
ALTER TABLE `penalty`
  ADD CONSTRAINT `consViolation` FOREIGN KEY (`vio_id`) REFERENCES `violation` (`vio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `violator_offense`
--
ALTER TABLE `violator_offense`
  ADD CONSTRAINT `endorser_id` FOREIGN KEY (`endorser_id`) REFERENCES `endorser` (`endorser_id`),
  ADD CONSTRAINT `pen_fk` FOREIGN KEY (`pen_id`) REFERENCES `penalty` (`pen_id`),
  ADD CONSTRAINT `violator_fk` FOREIGN KEY (`v_id`) REFERENCES `violator` (`v_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
