-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 07:42 PM
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
(10, 4, '2000', 'Offense 7'),
(11, 5, '3000', 'Offense 5'),
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
(4, 'qqq', 10),
(5, 'asdasd', 11),
(6, 'test', 6);

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
  `endorser_id` int(15) NOT NULL,
  `impound` varchar(255) NOT NULL,
  `chassis_no` varchar(255) NOT NULL,
  `engine_no` varchar(255) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator`
--

INSERT INTO `violator` (`v_id`, `fname`, `mname`, `lname`, `address`, `bday`, `pic`, `ctc`, `owner`, `endorser_id`, `impound`, `chassis_no`, `engine_no`, `noted_by`, `gender`) VALUES
(1, 'qweqweqwetestQE', 'asdsa', 'asdsad', 'qweqwe', '2018-09-13', '5b0fc400-a10c-47f2-9888-94a60a000006.jpg', 22222, 'qweqwe', 6, 'dqweqwe', 'qweqw', 'qweqwe', '123123asdasd', 'Male'),
(2, 'Christian', 'De la cruz', 'Gasper', 'Municipal Subd, Sagay City', '1994-06-06', 'download.jpg', 132465, 'Christian', 6, 'Ford Mustang', '112547', '554712', 'Laiza Javier', 'Female'),
(3, 'Testing', 'val', 'val testing', 'val testing', '1996-09-28', 'download (1).jpg', 11234, 'val testing', 7, 'val testing', 'val testingval testing', 'val testing', 'val testing', 'Male'),
(4, 'test stat', 'test stat', 'test stat', 'test stat', '1991-01-21', '220px-Seal_of_the_Philippines.svg.png', 22331451, 'test stat', 6, 'test stat', 'test stat', 'test stat', 'test stat', 'Female'),
(5, 'kim', 'jong', 'un', 'NK', '1974-10-29', '220px-Kim_and_Trump_standing_next_to_each_other_(cropped).jpg', 123441, 'kim jong un', 6, 'kinawat', '33214kka', '0kk8dsk', 'Xi Jinping', 'Male'),
(6, 'Vladimir', 'Igor', 'Putin', 'Russia', '1965-07-27', '170px-RIAN_archive_100306_Vladimir_Putin,_Federal_Security_Service_Director.jpg', 4431, 'Vladimir Putin', 7, 'Honda', '940-AB-1', '3901-23S-31', 'Donald Trump', 'Male');

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
  `date_released` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `violator_offense`
--

INSERT INTO `violator_offense` (`violator_offense_id`, `v_id`, `pen_id`, `date_apprehend`, `remarks`, `status`, `date_released`) VALUES
(65, 1, 10, '2018-02-15', 'Released', 'Settled', '2018-03-03'),
(66, 1, 12, '2018-07-17', 'Released', 'Settled', '2018-07-07'),
(67, 2, 11, '2018-04-10', 'Released', 'Settled', '2018-05-05'),
(68, 2, 12, '2018-05-03', 'Released', 'Settled', '2018-06-06'),
(72, 2, 10, '2018-03-15', 'Released', 'Settled', '2018-04-04'),
(73, 3, 10, '2018-08-01', 'Not Released', 'Settled', '2018-08-08'),
(74, 4, 11, '2018-03-03', 'Released', 'Settled', '2018-04-04'),
(75, 4, 12, '2018-04-04', 'Released', 'Settled', '2018-05-05'),
(76, 1, 11, '2018-04-05', 'Released', 'Settled', '2018-05-05'),
(77, 4, 9, '2018-01-01', 'Released', 'Settled', '2018-02-02'),
(78, 4, 10, '2018-02-02', 'Released', 'Settled', '2018-03-03'),
(79, 5, 9, '2018-05-20', 'Released', 'Settled', '2018-07-17'),
(80, 5, 10, '2018-07-20', 'Released', 'Not Settled', '2018-09-20'),
(81, 6, 11, '2013-05-04', 'Released', 'Settled', '2013-05-23'),
(82, 6, 12, '2018-08-02', 'Not Released', 'Not Settled', NULL);

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
  MODIFY `v_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `violator_offense`
--
ALTER TABLE `violator_offense`
  MODIFY `violator_offense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
