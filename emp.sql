-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2021 at 11:14 AM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `aId` int NOT NULL,
  `uId` int NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`aId`, `uId`, `date`, `status`) VALUES
(21, 7, '2021-05-03', 'Present'),
(22, 7, '2021-05-06', 'Present'),
(24, 7, '2021-05-17', 'Absent'),
(25, 7, '2021-05-18', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rId` int NOT NULL,
  `uid` int NOT NULL,
  `mentorId` int NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rId`, `uid`, `mentorId`, `type`, `date`, `time`, `status`) VALUES
(33, 7, 4, 'Personal', '2021-05-03', '21:10:08', 'Accepted'),
(34, 7, 4, 'Personal', '2021-05-06', '21:16:08', 'Accepted'),
(35, 7, 4, 'Personal', '2021-05-17', '21:58:08', 'Rejected'),
(36, 7, 4, 'Checkin', '2021-05-18', '22:00:46', 'Rejected'),
(37, 7, 4, 'Checkout', '2021-05-18', '22:00:48', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uId` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int NOT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(30) NOT NULL,
  `mentor` int DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uId`, `name`, `email`, `number`, `Address`, `role`, `mentor`, `gender`, `password`, `rating`) VALUES
(2, 'Nayan Agrawal', 'nayan.agrawal@bigseptech.com', 1234567890, 'sdasfsdfs', 'Mentor', 2, 'Male', 'abb9c2c4f9586f38ac9e0dea0c7ef2b4', NULL),
(4, 'aniket', 'aniket@122.com', 1234567890, 'sdasfsdfs', 'Mentor', 2, 'Male', 'abb9c2c4f9586f38ac9e0dea0c7ef2b4', NULL),
(5, 'ankit', 'ankit@123.com', 1234567890, 'sdasfsdfs', 'Mentor', 4, 'Male', 'abb9c2c4f9586f38ac9e0dea0c7ef2b4', NULL),
(6, 'niket', 'niket@122.com', 1234567890, 'sdasfsdfs', 'employ', 4, 'Male', 'abb9c2c4f9586f38ac9e0dea0c7ef2b4', NULL),
(7, 'nimi', 'nimi@2233.com', 1234567890, 'sdasfsdfs', 'employ', 4, 'Male', 'abb9c2c4f9586f38ac9e0dea0c7ef2b4', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
