-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2017 at 08:29 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancetracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timeIn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `totalHours` float NOT NULL DEFAULT '0',
  `salaryToday` float NOT NULL DEFAULT '0',
  `isAbsent` tinyint(1) NOT NULL DEFAULT '0',
  `isOnLeave` tinyint(1) NOT NULL DEFAULT '0',
  `isOnPaidLeave` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `user_id`, `date`, `timeIn`, `timeOut`, `totalHours`, `salaryToday`, `isAbsent`, `isOnLeave`, `isOnPaidLeave`, `created`, `modified`) VALUES
(1, 1, '2017-07-07 03:50:20', '2017-07-07 07:43:11', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '2017-07-07 03:50:20', '2017-07-07 03:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('OJT','Trainee','Probationary','Regular') DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `dateHired` date DEFAULT NULL,
  `noOfAbsences` int(11) DEFAULT NULL,
  `hoursLate` float DEFAULT NULL,
  `contactNumber` int(11) DEFAULT NULL,
  `monthlyRate` float DEFAULT NULL,
  `scheduledTimeIn` time DEFAULT NULL,
  `scheduledTimeOut` time DEFAULT NULL,
  `OJT_hoursTotal` float DEFAULT NULL,
  `OJT_hoursRemaining` float DEFAULT NULL,
  `OJT_allowanceDaily` float DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `firstName`, `lastName`, `email`, `password`, `type`, `jobTitle`, `birthday`, `dateHired`, `noOfAbsences`, `hoursLate`, `contactNumber`, `monthlyRate`, `scheduledTimeIn`, `scheduledTimeOut`, `OJT_hoursTotal`, `OJT_hoursRemaining`, `OJT_allowanceDaily`, `created`, `modified`) VALUES
(1, '114331649460731421461', 'Francis', 'Yap', 'francisyap.utech@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-07-04 17:55:07', '2017-07-04 17:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
