-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 11:16 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securlydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `schoolid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `name`, `schoolid`) VALUES
(1, 'Rubin Soccer', 1),
(2, 'Rubin Baseball', 1),
(3, 'Rubin SoftBall', 1),
(4, 'Rubin Tennis', 1),
(5, 'Chelsey Football', 2),
(6, 'Chelsey Hockey', 2),
(7, 'Berkeley Squash', 3),
(8, 'Berkeley Swimming', 3),
(9, 'Berkeley Polo', 3),
(10, 'Stanford Tennis', 4),
(11, 'Stanford Poker', 4);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `adminid`) VALUES
(1, 'Mecklenburg', 1),
(2, 'Cabarrus', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kids`
--

CREATE TABLE `kids` (
  `emailid` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `schoolid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kids`
--

INSERT INTO `kids` (`emailid`, `name`, `schoolid`) VALUES
('abal@gmail.com', 'Arun Bal', 1),
('cbaker@gmail.com', 'Charley Baker', 3),
('cjohny@gmail.com', 'Chico Johny', 1),
('cwu@gmail.com', 'Cho Wu', 2),
('dbart@gmail.com', 'Drew Bart', 1),
('jbal@gmail.com', 'Jeevan Bal', 1),
('jken@gmail.com', 'John Ken', 1),
('jshaw@gmail.com', 'Joe Shaw', 2),
('jwalter@gmail.com', 'Joseph Walter', 1),
('kjon@gmail.com', 'Kim Jong', 4),
('mjoe@gmail.com', 'Mike Joe', 3),
('rchase@gmail.com', 'Robert Chase', 4),
('rpatel@gmail.com', 'Ram Patel', 3),
('rrahim@gmail.com', 'Ram Rahim', 2),
('sroy@gmail.com', 'Shameer Roy', 1),
('vaish@gmail.com', 'Vaishnavi', 3),
('vkrishna@gmail.com', 'Vamsee Krishna', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kidsclub`
--

CREATE TABLE `kidsclub` (
  `kidsemailid` varchar(30) NOT NULL,
  `clubid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kidsclub`
--

INSERT INTO `kidsclub` (`kidsemailid`, `clubid`) VALUES
('jwalter@gmail.com', 1),
('jken@gmail.com', 1),
('jbal@gmail.com', 1),
('abal@gmail.com', 1),
('jken@gmail.com', 2),
('sroy@gmail.com', 2),
('jwalter@gmail.com', 2),
('cjohny@gmail.com', 3),
('jwalter@gmail.com', 3),
('cjohny@gmail.com', 4),
('dbart@gmail.com', 4),
('rrahim@gmail.com', 5),
('jshaw@gmail.com', 5),
('vkrishna@gmail.com', 6),
('cwu@gmail.com', 6),
('cbaker@gmail.com', 7),
('vaish@gmail.com', 8),
('rpatel@gmail.com', 8),
('mjoe@gmail.com', 9),
('kjon@gmail.com', 10),
('rchase@gmail.com', 11);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `adminid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`adminid`, `name`, `password`) VALUES
(1, 'Anal Shah', 'shah123'),
(2, 'Tom Cruise', 'cruise123'),
(3, 'Dwayne Johnson', 'johnson123'),
(4, 'Vin Diesel', 'diesel123');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `adminid` int(11) NOT NULL,
  `queryid` enum('query1','query2','query3') NOT NULL,
  `queryvalue1` varchar(30) NOT NULL,
  `queryvalue2` varchar(30) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`adminid`, `queryid`, `queryvalue1`, `queryvalue2`, `datetime`) VALUES
(1, 'query1', 'jwalter@gmail.com', NULL, '2018-01-23 20:11:31'),
(1, 'query1', 'cwu@gmail.com', NULL, '2018-01-23 20:11:40'),
(1, 'query2', 'Rubin Soccer', NULL, '2018-01-23 20:11:44'),
(1, 'query2', 'Rubin', NULL, '2018-01-23 20:11:48'),
(1, 'query3', 'jwalter@gmail.com', 'dbart@gmail.com', '2018-01-23 20:12:08'),
(1, 'query1', 'cwu@gmail.com', NULL, '2018-01-23 20:12:24'),
(1, 'query1', 'jwalter@gmail.com', NULL, '2018-01-23 20:51:34'),
(1, 'query2', 'Rubin Baseball', NULL, '2018-01-23 20:52:13'),
(1, 'query3', 'abal@gmail.com', 'dbart@gmail.com', '2018-01-23 20:52:48'),
(1, 'query3', 'jwalter@gmail.com', 'rrahim@gmail.com', '2018-01-23 20:53:35'),
(1, 'query1', 'cwu@gmail.com', NULL, '2018-01-23 20:54:22'),
(1, 'query2', 'Rubin Soccer', NULL, '2018-01-23 20:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `districtid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `districtid`) VALUES
(1, 'Rubin Elementary', 1),
(2, 'Chelsey High', 1),
(3, 'Berkeley Middle', 2),
(4, 'Stanford School', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_schoolid` (`schoolid`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adminid` (`adminid`);

--
-- Indexes for table `kids`
--
ALTER TABLE `kids`
  ADD PRIMARY KEY (`emailid`),
  ADD KEY `fk_kids_schoolid` (`schoolid`);

--
-- Indexes for table `kidsclub`
--
ALTER TABLE `kidsclub`
  ADD KEY `fk_kidsclub_kidsemailid` (`kidsemailid`),
  ADD KEY `fk_kidsclub_clubid` (`clubid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD KEY `fk_query_adminid` (`adminid`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_districtid` (`districtid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_schoolid` FOREIGN KEY (`schoolid`) REFERENCES `school` (`id`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_adminid` FOREIGN KEY (`adminid`) REFERENCES `login` (`adminid`);

--
-- Constraints for table `kids`
--
ALTER TABLE `kids`
  ADD CONSTRAINT `fk_kids_schoolid` FOREIGN KEY (`schoolid`) REFERENCES `school` (`id`);

--
-- Constraints for table `kidsclub`
--
ALTER TABLE `kidsclub`
  ADD CONSTRAINT `fk_kidsclub_clubid` FOREIGN KEY (`clubid`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `fk_kidsclub_kidsemailid` FOREIGN KEY (`kidsemailid`) REFERENCES `kids` (`emailid`);

--
-- Constraints for table `query`
--
ALTER TABLE `query`
  ADD CONSTRAINT `fk_query_adminid` FOREIGN KEY (`adminid`) REFERENCES `login` (`adminid`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `fk_districtid` FOREIGN KEY (`districtid`) REFERENCES `district` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
