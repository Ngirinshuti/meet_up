-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 07:42 PM
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
-- Database: `websec`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `activation` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `fname`, `lname`, `email`, `username`, `password`, `activation`, `status`) VALUES
(26, 'ngirinshuti', 'prudent', 'prudentenri001@gmail.com', 'enzo', '7cd78c9b50e3531feb5493856586b1ac826008d8', '170839', 'Verified'),
(27, 'makuza', 'pascal', 'nsanzimanaofficial@gmail.com', 'makuza', '5e5d9434418a64369e715f7d7ea2c55c1432e328', '729221', 'not verified'),
(28, 'muragijimana', 'pascal', 'theo@gmail.com', 'theo', 'f2268afbe3b043b7b8a75e76f1d349ae65ead77e', '571514', 'not verified'),
(29, 'kabanda', 'derrick', 'derrickkabanda70@gmail.com', 'kabanda', 'e79b72c20a77e63073fbce44dd723b63cb58dd0b', '900349', 'not verified'),
(30, 'www', 'nawe', 'prudentenz001@gmail.com', 'admin', '5c75d5f8b3929955a990877220b21374a9f9f2fc', '743158', 'not verified');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `prid` int(200) NOT NULL,
  `email` text NOT NULL,
  `reset` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`prid`, `email`, `reset`, `token`, `expires`) VALUES
(1, 'uu', 'uuyu', 'fghjkhhgggg', '76'),
(17, 'lissoubapascal0@gmail.com', 'df865ecd3fdd0a71', '$2y$10$aGQUia3kGdaN.pY4GicSV.pH1rbLjGe9OTTLBbJy0KDVYXFSmfoFu', '1634026097'),
(19, 'nsanzimanaofficial@gmail.com', '8fa6944656b29342', '$2y$10$9e7qh1Ifx4YpFyuJTXX4M.CIB3oFXmfm4uYkO.z7gt6LK8oe250yS', '1634028230');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`prid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `prid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
