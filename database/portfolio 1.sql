-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2021 at 04:46 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`qid`, `uid`, `grad_year`, `grad_clg`, `grad_branch`, `inter_year`, `inter_clg`, `inter_branch`, `master_year`, `master_clg`, `master_branch`, `date`) VALUES
(10, 9, '2016-2019', 'SWC, Bhanjanagar', 'B.sc ', '2014-2016', 'SWC, Bhanjanagar', 'CHSE', '2019-2022', 'CET, Bhubaneswar', 'MCA', '2021-07-29 14:14:02');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `mobile`, `dob`, `age`, `domain`, `address`, `bio`, `programming`, `framework`, `pro1_title`, `pro2_title`, `pro3_title`, `pro1_link`, `pro2_link`, `pro3_link`, `cv`, `date`) VALUES
(9, 'manisha', 'patro', 'patromanisha372@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '7749957009', '09-12-1998', '22', 'Web Developer', 'Old market Street, Bhanjanagar', 'I am a  Front-end developer who cares deeply about user experience. Serious passion for UI design and new technologies.', 'Java , Python , C, HTML, CSS', 'Bootstrap, Django', 'Online-Voting-System', 'Extractive-Text-Summarization', 'FRIENDLY-MEDICO', 'https://github.com/bk9990546773/Voting-Sytem', 'https://github.com/C3Suryansu/Extractive-Text-Summarization', 'https://github.com/Ashishkumarpanda/FRIENDLY-MEDICO', '1627631046292mani.pdf', '2021-07-29 14:08:10');

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
  MODIFY `qid` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
