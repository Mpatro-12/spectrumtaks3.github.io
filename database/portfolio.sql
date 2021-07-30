-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 08:25 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manisha`
--

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `qid` int(7) NOT NULL,
  `uid` int(7) NOT NULL,
  `grad_year` varchar(20) NOT NULL,
  `grad_clg` text NOT NULL,
  `grad_branch` varchar(30) NOT NULL,
  `inter_year` varchar(20) NOT NULL,
  `inter_clg` text NOT NULL,
  `inter_branch` varchar(40) NOT NULL,
  `master_year` varchar(20) NOT NULL,
  `master_clg` text NOT NULL,
  `master_branch` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `fname` varchar(55) NOT NULL,
  `lname` varchar(55) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `age` varchar(2) NOT NULL,
  `domain` text NOT NULL,
  `address` text NOT NULL,
  `bio` text NOT NULL,
  `programming` text NOT NULL,
  `framework` text NOT NULL,
  `pro1_title` text NOT NULL,
  `pro2_title` text NOT NULL,
  `pro3_title` text NOT NULL,
  `pro1_link` text NOT NULL,
  `pro2_link` text NOT NULL,
  `pro3_link` text NOT NULL,
  `cv` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `qid` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
