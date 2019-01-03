-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2019 at 09:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grantwoo_sp_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcalendar`
--

CREATE TABLE `tblcalendar` (
  `intSchoolID` int(11) NOT NULL,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL,
  `strWeekday` varchar(15) COLLATE utf8_bin NOT NULL,
  `strTime` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblcalendar`
--

INSERT INTO `tblcalendar` (`intSchoolID`, `strTeacherID`, `strWeekday`, `strTime`) VALUES
(1, 'Jay', 'Monday', '14:45'),
(1, 'Stan', 'Monday', '14:30'),
(1, 'grant', 'Friday', '14:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalog`
--

CREATE TABLE `tblcatalog` (
  `intSchoolID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intCost` int(11) NOT NULL,
  `strDescription` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `strImageLocation` text COLLATE utf8_bin,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblcatalog`
--

INSERT INTO `tblcatalog` (`intSchoolID`, `intItemID`, `intCost`, `strDescription`, `strImageLocation`, `strTeacherID`) VALUES
(1, 1, 20, 'Gum', '..', 'STD'),
(1, 2, 40, 'Bracelet', '..', 'STD'),
(1, 3, 100, 'Toy Car', '..', 'STD'),
(1, 4, 5, 'Pencil', '..', 'STD'),
(1, 5, 10, 'Eraser', '..', 'STD'),
(1, 6, 500, 'Nap For Hour', '..', 'grant'),
(1, 7, 300, 'Extra Credit', '..', 'Tim'),
(1, 8, 200, 'iPod For Day', '..', 'grant'),
(1, 9, 200, 'Recess', '..', 'Jay'),
(1, 10, 600, 'Food In Class', '..', 'Stan');

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalogremove`
--

CREATE TABLE `tblcatalogremove` (
  `intItemID` int(11) NOT NULL,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblcatalogremove`
--

INSERT INTO `tblcatalogremove` (`intItemID`, `strTeacherID`) VALUES
(1, 'grant'),
(2, 'Tim'),
(3, 'Stan'),
(3, 'grant');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `intSchoolID` int(11) NOT NULL,
  `intClassID` int(11) NOT NULL,
  `strClassName` varchar(50) COLLATE utf8_bin NOT NULL,
  `intClassCoupons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`intSchoolID`, `intClassID`, `strClassName`, `intClassCoupons`) VALUES
(1, 10, 'Class', 20),
(1, 22, 'Tim\'s Class', 20),
(1, 25, 'Stan\'s Class', 0),
(1, 39, 'Jay\'s Class', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblhistory`
--

CREATE TABLE `tblhistory` (
  `intSchoolID` int(11) NOT NULL,
  `strStudentID` varchar(30) COLLATE utf8_bin NOT NULL,
  `dtmDate` datetime NOT NULL,
  `strComment` text COLLATE utf8_bin,
  `intAmount` int(11) NOT NULL,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblhistory`
--

INSERT INTO `tblhistory` (`intSchoolID`, `strStudentID`, `dtmDate`, `strComment`, `intAmount`, `strTeacherID`) VALUES
(1, 'Bobby', '2018-12-12 00:00:00', 'Harro', -10, 'grant'),
(1, 'Jack', '2018-12-31 00:00:00', 'Cleaning the classroom tables', 100, 'grant'),
(1, 'Jack', '2019-01-03 00:00:00', 'updated', -50, 'grant'),
(1, 'Jack', '2019-01-03 00:00:02', 'Cleaning the classroom tables', 100, 'grant'),
(1, 'Ryan', '2018-10-23 00:00:02', 'Cleaning', 100, 'grant');

-- --------------------------------------------------------

--
-- Table structure for table `tblschool`
--

CREATE TABLE `tblschool` (
  `intSchoolID` int(11) NOT NULL,
  `strSchoolName` varchar(100) COLLATE utf8_bin NOT NULL,
  `strCashName` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblschool`
--

INSERT INTO `tblschool` (`intSchoolID`, `strSchoolName`, `strCashName`) VALUES
(1, 'school1', 'schoolCash1');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `intSchoolID` int(11) NOT NULL,
  `strStudentID` varchar(30) COLLATE utf8_bin NOT NULL,
  `strFirstName` varchar(30) COLLATE utf8_bin NOT NULL,
  `strLastName` varchar(50) COLLATE utf8_bin NOT NULL,
  `intCoupons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`intSchoolID`, `strStudentID`, `strFirstName`, `strLastName`, `intCoupons`) VALUES
(1, 'Bobby', 'Bob', 'Babbin', 36),
(1, 'Jack', 'Jackal', 'Jones', 0),
(1, 'Jane', 'Plain', 'Jane', 0),
(1, 'Jill', 'Jillian', 'Jones', 0),
(1, 'Ryan', 'Rayanson', 'Rhonin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltakes`
--

CREATE TABLE `tbltakes` (
  `strStudentID` varchar(30) COLLATE utf8_bin NOT NULL,
  `intClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbltakes`
--

INSERT INTO `tbltakes` (`strStudentID`, `intClassID`) VALUES
('Bobby', 22),
('Jack', 10),
('Jane', 10),
('Jill', 10),
('Ryan', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `intSchoolID` int(11) NOT NULL,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL,
  `strFirstName` varchar(30) COLLATE utf8_bin NOT NULL,
  `strLastName` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`intSchoolID`, `strTeacherID`, `strFirstName`, `strLastName`) VALUES
(1, 'Jay', 'Jay', 'Jackson'),
(1, 'STD', 'n/a', 'n/a'),
(1, 'Stan', 'stan', 'man'),
(1, 'Tim', 'Tim', 'Timn'),
(1, 'grant', 'grant', 'woods');

-- --------------------------------------------------------

--
-- Table structure for table `tblteaches`
--

CREATE TABLE `tblteaches` (
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL,
  `intClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tblteaches`
--

INSERT INTO `tblteaches` (`strTeacherID`, `intClassID`) VALUES
('Jay', 39),
('Stan', 25),
('Tim', 22),
('grant', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcalendar`
--
ALTER TABLE `tblcalendar`
  ADD PRIMARY KEY (`intSchoolID`,`strWeekday`,`strTime`),
  ADD KEY `strTeacherID` (`strTeacherID`);

--
-- Indexes for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  ADD PRIMARY KEY (`intSchoolID`,`intItemID`),
  ADD KEY `strTeacherID` (`strTeacherID`);

--
-- Indexes for table `tblcatalogremove`
--
ALTER TABLE `tblcatalogremove`
  ADD PRIMARY KEY (`intItemID`,`strTeacherID`),
  ADD KEY `strTeacherID` (`strTeacherID`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`intSchoolID`,`intClassID`);

--
-- Indexes for table `tblhistory`
--
ALTER TABLE `tblhistory`
  ADD PRIMARY KEY (`strStudentID`,`dtmDate`),
  ADD KEY `intSchoolID` (`intSchoolID`);

--
-- Indexes for table `tblschool`
--
ALTER TABLE `tblschool`
  ADD PRIMARY KEY (`intSchoolID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`strStudentID`),
  ADD KEY `intSchoolID` (`intSchoolID`);

--
-- Indexes for table `tbltakes`
--
ALTER TABLE `tbltakes`
  ADD PRIMARY KEY (`strStudentID`,`intClassID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`strTeacherID`),
  ADD KEY `intSchoolID` (`intSchoolID`);

--
-- Indexes for table `tblteaches`
--
ALTER TABLE `tblteaches`
  ADD PRIMARY KEY (`strTeacherID`,`intClassID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcalendar`
--
ALTER TABLE `tblcalendar`
  ADD CONSTRAINT `tblcalendar_ibfk_1` FOREIGN KEY (`strTeacherID`) REFERENCES `tblteacher` (`strTeacherID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcalendar_ibfk_2` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  ADD CONSTRAINT `tblcatalog_ibfk_1` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcatalog_ibfk_2` FOREIGN KEY (`strTeacherID`) REFERENCES `tblteacher` (`strTeacherID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcatalogremove`
--
ALTER TABLE `tblcatalogremove`
  ADD CONSTRAINT `tblcatalogremove_ibfk_1` FOREIGN KEY (`strTeacherID`) REFERENCES `tblteacher` (`strTeacherID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD CONSTRAINT `tblclass_ibfk_1` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblhistory`
--
ALTER TABLE `tblhistory`
  ADD CONSTRAINT `tblhistory_ibfk_1` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblhistory_ibfk_2` FOREIGN KEY (`strStudentID`) REFERENCES `tblstudent` (`strStudentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD CONSTRAINT `tblstudent_ibfk_1` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltakes`
--
ALTER TABLE `tbltakes`
  ADD CONSTRAINT `tbltakes_ibfk_1` FOREIGN KEY (`strStudentID`) REFERENCES `tblstudent` (`strStudentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD CONSTRAINT `tblteacher_ibfk_1` FOREIGN KEY (`intSchoolID`) REFERENCES `tblschool` (`intSchoolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblteaches`
--
ALTER TABLE `tblteaches`
  ADD CONSTRAINT `tblteaches_ibfk_1` FOREIGN KEY (`strTeacherID`) REFERENCES `tblteacher` (`strTeacherID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
