-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2018 at 07:00 PM
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
  `school_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`userID`, `hash`, `role`, `school_id`) VALUES
('Jon', '$2y$10$AP8HBUsdhq7pntd8K6jGqeRDbsKwTpD5Lst6ARnYqL5dZF290RYAW', 't', 2),
('JonMan', '$2y$10$SygowpWOR7Mx2ee3ivuwDeuj.bA8potoDQDvJPGE6WzPeS44CXxp.', 't', 2),
('grant', '$2y$10$jVpBNDWol70NqwGY.q9PnuJf0K6KOeYGWZPNm3/p0bsaXfV9fIE.O', 'a', 1);

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
