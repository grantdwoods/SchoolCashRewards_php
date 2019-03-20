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
-- Database: `grantwoo_sp_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `userID` varchar(30) COLLATE utf8_bin NOT NULL,
  `hash` text COLLATE utf8_bin NOT NULL,
  `role` char(1) COLLATE utf8_bin NOT NULL,
  `intSchoolID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`userID`, `hash`, `role`, `intSchoolID`) VALUES
('admin1', '$2y$10$ubPmspQpy7xibhp3kjovdOPrrMsZSJWEPfCrcbMExwUuN2EXXMvg2', 'a', 897663),
('student1', '$2y$10$qCcp4ghlT5vou4Cp281mxuhPOCqWqJYmosnVUCItiZYuCDdrUGMZS', 's', 897663),
('student2', '$2y$10$AiVA.1AI3wlsQCGsNjxfm.PtXAEFJTagGliCKC3PIrh/xD8iID9ES', 's', 897663),
('student3', '$2y$10$T3R/ptpOaMNrDTtrJxhPFuOPEIIzK4gO8JFRAeNbBHGeoGNkVek4y', 's', 897663),
('student4', '$2y$10$Vo1fLwaeypCVVx9g5AH/5.Ae5uVBOwhMhYKxp3oXM0nRvUB4NPscO', 's', 897663),
('student5', '$2y$10$B3e/oY7AmI4EzHpfXx4HwuFwMIQ1Xvm.7LmDIR2Y/jWL.nVwlQdPO', 's', 897663),
('teacher1', '$2y$10$rzlzcTEE4sDzG9mPHX5Fr.Pdt/txEVUmcgjEiE7.e3gNlKiCkWQ1e', 't', 897663),
('teacher2', '$2y$10$p6hyOIYy5q2bwIY/aatZdumGgkueKZ1OSam53baOfhxJcHDARy74G', 't', 897663);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
