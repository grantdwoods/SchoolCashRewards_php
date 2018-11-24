-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2018 at 02:15 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalogremove`
--

CREATE TABLE `tblcatalogremove` (
  `intItemID` int(11) NOT NULL,
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `intSchoolID` int(11) NOT NULL,
  `intClassID` int(11) NOT NULL,
  `strClassName` varchar(50) COLLATE utf8_bin NOT NULL,
  `intClassCares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tblhistory`
--

CREATE TABLE `tblhistory` (
  `intSchoolID` int(11) NOT NULL,
  `strStudentID` varchar(30) COLLATE utf8_bin NOT NULL,
  `intItemID` int(11) NOT NULL,
  `dtmDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tblschool`
--

CREATE TABLE `tblschool` (
  `intSchoolID` int(11) NOT NULL,
  `strSchoolName` varchar(100) COLLATE utf8_bin NOT NULL,
  `strCashName` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbltakes`
--

CREATE TABLE `tbltakes` (
  `strStudentID` varchar(30) COLLATE utf8_bin NOT NULL,
  `intClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Table structure for table `tblteaches`
--

CREATE TABLE `tblteaches` (
  `strTeacherID` varchar(30) COLLATE utf8_bin NOT NULL,
  `intClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcalendar`
--
ALTER TABLE `tblcalendar`
  ADD PRIMARY KEY (`intSchoolID`,`strWeekday`,`strTime`);

--
-- Indexes for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  ADD PRIMARY KEY (`intSchoolID`,`intItemID`);

--
-- Indexes for table `tblcatalogremove`
--
ALTER TABLE `tblcatalogremove`
  ADD PRIMARY KEY (`intItemID`,`strTeacherID`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`intSchoolID`,`intClassID`);

--
-- Indexes for table `tblschool`
--
ALTER TABLE `tblschool`
  ADD PRIMARY KEY (`intSchoolID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`strStudentID`);

--
-- Indexes for table `tbltakes`
--
ALTER TABLE `tbltakes`
  ADD PRIMARY KEY (`strStudentID`,`intClassID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`strTeacherID`);

--
-- Indexes for table `tblteaches`
--
ALTER TABLE `tblteaches`
  ADD PRIMARY KEY (`strTeacherID`,`intClassID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
