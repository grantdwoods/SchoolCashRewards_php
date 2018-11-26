-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 10:38 PM
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
  `schoolID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`userID`, `hash`, `role`, `schoolID`) VALUES
('Bobby', '$2y$10$Lf.kAF0eQO0HJmhBRvonye5Qh9gPMKTENmi1PDAsB/.fh4bQdBd3S', 's', 1),
('Jake', '$2y$10$9zkLd29/V1F.cCKazFAxe.Sb./EwlylTSPf0.laZwBkmqbLG6P4PG', 's', 1),
('Jon', '$2y$10$AP8HBUsdhq7pntd8K6jGqeRDbsKwTpD5Lst6ARnYqL5dZF290RYAW', 'a', 2),
('JonMan', '$2y$10$SygowpWOR7Mx2ee3ivuwDeuj.bA8potoDQDvJPGE6WzPeS44CXxp.', 't', 2),
('Ryan', '$2y$10$SDNGs9c10L66JXMiA/qLi.pPY.81oqo8lH/p61/AdAnWUBqp/LYbu', 's', 1),
('Stan', '$2y$10$xSe30jGDnSgLdKL7OHqvsOw.LAX.H/mqF3zp6jxsNzGuUPHqHFJs2', 't', 1),
('Tim', '$2y$10$tlodmSm.XS08wENr5Cp8FuAmitXMzm6E0qTOFd2bBiD33qC7tl/sK', 't', 1),
('Timmy', '$2y$10$1qvS92J4kkIdiXKlmMmc5eiXlZHnFDUC76ryPnEq5SqVpABZvRoFe', 's', 1),
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
