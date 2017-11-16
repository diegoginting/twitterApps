-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2017 at 03:08 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitterapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `user`, `email`, `status`, `time`) VALUES
(64, 'atangs', 'a@a.a', '', '2017-11-16 14:05:46'),
(65, 'atangs', 'a@a.a', 'hai', '2017-11-16 14:05:46'),
(66, 'atangs', 'a@a.a', 'kakaka', '2017-11-16 14:05:59'),
(67, 'bantuan a', 'b@b.b', '', '2017-11-16 14:11:47'),
(68, 'bantuan a', 'b@b.b', 'haloo', '2017-11-16 14:11:47'),
(69, 'bantuan a', 'b@b.b', 'mantaaf', '2017-11-16 14:11:47'),
(70, 'bantuan a', 'b@b.b', 'mantaaf', '2017-11-16 14:11:47'),
(71, 'cinta', 'c@c.c', '', '2017-11-16 14:12:54'),
(72, 'cinta', 'c@c.c', 'wuooop', '2017-11-16 14:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `foto`) VALUES
(26, 'a', 'a@a.a', '$2y$10$f.YWkITxy5gMFD1vEnLCEOOce63glrGlmeNvIaH6SEBEexW2x30W2', 'background-2551501_1920.jpg'),
(27, 'b', 'b@b.b', '$2y$10$qImkn21udsuUGXZ4sCppg.KYjEpEueTD0RLI78RpT.tQRLLUM8vC2', 'beach-1133813_1920.jpg'),
(28, 'c', 'c@c.c', '$2y$10$EXrSssMNoIycxMuFYBVxu.cFaU1a/0LMxYWc0d7XfuwamybaEjZxm', 'cafe.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
