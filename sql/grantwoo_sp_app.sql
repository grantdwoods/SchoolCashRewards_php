-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2019 at 09:33 PM
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
(897663, 150, 5, 'Pencils/Pens', 'http://localhost/SchoolCashRewards_php/catalogImages/pens-and-pencils.jpg', 'STD897663'),
(897663, 151, 5, 'Crayons', 'http://localhost/SchoolCashRewards_php/catalogImages/crayons.jpg', 'STD897663'),
(897663, 152, 50, 'Match Box', 'http://localhost/SchoolCashRewards_php/catalogImages/matchbox.jpg', 'STD897663'),
(897663, 153, 500, 'Connect Four', 'http://localhost/SchoolCashRewards_php/catalogImages/connect-four.jpg', 'STD897663'),
(897663, 154, 750, 'Battleship', 'http://localhost/SchoolCashRewards_php/catalogImages/battleship.jpg', 'STD897663'),
(897663, 155, 250, 'UNO', 'http://localhost/SchoolCashRewards_php/catalogImages/uno.jpg', 'STD897663'),
(897663, 156, 300, 'Puzzles', 'http://localhost/SchoolCashRewards_php/catalogImages/puzzle.jpg', 'STD897663'),
(897663, 157, 250, 'Farkle', 'http://localhost/SchoolCashRewards_php/catalogImages/farkle.jpg', 'STD897663'),
(897663, 158, 25, 'Goldfish crackers', 'http://localhost/SchoolCashRewards_php/catalogImages/goldfish.jpg', 'STD897663'),
(897663, 159, 25, 'Rice Crispy Treat', 'http://localhost/SchoolCashRewards_php/catalogImages/rice-krispie.jpg', 'STD897663'),
(897663, 160, 150, 'Lunch with teacher', '', 'STD897663'),
(897663, 161, 200, 'Teacher chair  for 1 day', '', 'STD897663'),
(897663, 162, 50, 'Wear a hat', '', 'STD897663'),
(897663, 163, 100, 'Skip a homework page', '', 'STD897663'),
(897663, 164, 50, '10min extra computer time', '', 'STD897663'),
(897663, 168, 50, 'Moral Support', NULL, 'admin1'),
(897663, 169, 26, 'Bouncy Ball', NULL, 'teacher1');

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
(150, 'admin1'),
(151, 'admin1'),
(152, 'admin1'),
(153, 'admin1'),
(155, 'admin1'),
(156, 'admin1'),
(157, 'admin1'),
(158, 'admin1'),
(160, 'admin1'),
(161, 'admin1'),
(162, 'admin1'),
(163, 'admin1'),
(164, 'admin1');

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
(897663, 46, 'Class One', 0),
(897663, 47, 'Class Two', 0),
(897663, 48, 'Ms. Brook\'s Class', 0);

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
(897663, 'HConklin', '2019-03-18 11:15:06', 'Helped clean up the cafeteria', 10, 'admin1');

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
(897663, 'The School', 'School Cash');

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
(897663, '241412', 'Student', '4124', 0),
(897663, 'HConklin', 'Harriet', 'Conklin', 10),
(897663, 'JFriday', 'Joseph', 'Friday', 0),
(897663, 'SFree', 'Stanley', 'Freeburg', 0),
(897663, 'SSnod', 'Stretch', 'Snodgrass', 0),
(897663, 'WDenton', 'Walter', 'Denton', 0),
(897663, 'student1', 'Student', 'One', 0),
(897663, 'student2', 'Student', 'Two', 0),
(897663, 'student3', 'Student', 'Three', 0),
(897663, 'student4', 'Student', 'Four', 0),
(897663, 'student5', 'Student ', 'Five', 0);

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
('HConklin', 48),
('JFriday', 48),
('SFree', 48),
('SSnod', 48),
('WDenton', 48),
('student2', 46),
('student3', 46),
('student4', 47),
('student5', 47);

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
(897663, 'STD897663', 'Standard', 'Catalog'),
(897663, 'admin1', 'Admin', 'One'),
(897663, 'teacher1', 'Teacher', 'One'),
(897663, 'teacher2', 'Teacher', 'Two');

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
('admin1', 48),
('teacher1', 46),
('teacher2', 47);

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
  ADD UNIQUE KEY `intItemID` (`intItemID`),
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
  ADD PRIMARY KEY (`intSchoolID`,`intClassID`),
  ADD UNIQUE KEY `intClassID` (`intClassID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  MODIFY `intItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `intClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
