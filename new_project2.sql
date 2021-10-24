-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 04:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `p_id` int(255) NOT NULL,
  `commenter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_messages`
--

CREATE TABLE `deleted_messages` (
  `user` varchar(100) NOT NULL,
  `message_id` int(11) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend` varchar(100) NOT NULL,
  `partener` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend`, `partener`) VALUES
('Lissouba', 'enzo'),
('Lissouba', 'vava'),
('Makuza', 'enzo'),
('Makuza', 'vava'),
('valentin', 'vava'),
('vava', 'enzo');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `reciever`, `body`, `date_`, `status`) VALUES
(1173, 'vava', 'enzo', 'hello', '2021-10-17 19:08:20', 'read'),
(1282, 'Lissouba', 'vava', 'hello valentin', '2021-10-18 11:52:53', 'read'),
(1292, 'vava', 'Lissouba', 'yes bro', '2021-10-18 11:53:21', 'read'),
(2224, 'enzo', 'vava', 'hello vava', '2021-10-17 19:07:44', 'read'),
(2964, 'valentin', 'coder', 'Hello, brother!', '2021-10-24 09:30:40', 'unread'),
(3295, 'valentin', 'coder', 'Wowow', '2021-10-24 09:30:43', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `image`, `video`, `username`, `date`) VALUES
(74, 'ferrr', 'me.png', '', 'enzo', '2021-10-17 18:10:52'),
(78, ' i dont know', 'valentin.jpg', '', 'Lissouba', '2021-10-18 11:56:46'),
(88, 'hey', 'me.png', '', 'enzo', '2021-10-18 15:15:30'),
(90, 'Hey there!', '1a(17).jpg', '', 'vava', '2021-10-18 16:03:14'),
(91, 'HHEEY', '', 'New in Chrome 91_ File System Access API improvements, Google IO, and more.mp4', 'vava', '2021-10-18 16:10:12'),
(108, 'Yees', '', '7079347.mp4', 'vava', '2021-10-18 17:02:02'),
(109, 'Image post', '2993237.png', '', 'vava', '2021-10-18 17:11:59'),
(110, 'Testing', '', '3779109.mp4', 'vava', '2021-10-18 17:17:16'),
(111, '', '9445547.mp4', '', 'vava', '2021-10-18 18:46:26'),
(112, 'At macao', '7867926.jpg', '', 'vava', '2021-10-18 18:47:23'),
(113, '', '', '5307195.jpg', 'vava', '2021-10-18 18:56:56'),
(114, '', '', '2878993.mp4', 'vava', '2021-10-18 19:11:32'),
(115, '', '6935058.jpeg', '', 'vava', '2021-10-18 19:18:15'),
(116, '', '', '5869678.mp4', 'vava', '2021-10-18 19:21:19'),
(117, 'Hello, Guys!', '3436968.JPG', '', 'enzo', '2021-10-22 18:12:05'),
(118, 'So hey!', '', '', 'enzo', '2021-10-22 18:13:30'),
(119, 'Okay bro', '', '', 'valentin', '2021-10-24 12:28:55'),
(120, 'New post', '4691943.jpg', '', 'valentin', '2021-10-24 12:35:10'),
(121, 'Okay then', '1233450.jpg', '', 'valentin', '2021-10-24 12:36:26'),
(122, 'Video post', '', '9799880.mp4', 'vava', '2021-10-24 13:35:24'),
(123, 'Okamjdhjjasdha', '', '450197.mp4', 'vava', '2021-10-24 13:50:56'),
(124, 'Okamkdhjhjas', '', '', 'vava', '2021-10-24 13:51:23'),
(125, 'My video then', '', '1083292.mp4', 'valentin', '2021-10-24 14:16:37'),
(126, 'Heymsadkjjhkas', '', '', 'vava', '2021-10-24 14:16:57'),
(127, 'HAhhahaha', '5207611.jpeg', '', 'vava', '2021-10-24 14:17:34'),
(128, 'Okasyugasghas', '', '2349489.mp4', 'vava', '2021-10-24 14:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `username` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`username`, `post_id`) VALUES
('enzo', 74),
('valentin', 119),
('vava', 90);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `id` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `reset` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `expires` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(7) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `about` varchar(500) NOT NULL DEFAULT 'Unknown',
  `profile_pic` varchar(500) NOT NULL DEFAULT 'default.png',
  `address` varchar(100) DEFAULT 'Unknown',
  `status` varchar(10) NOT NULL DEFAULT 'offline',
  `code` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `remember_me` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `dob`, `sex`, `username`, `password`, `about`, `profile_pic`, `address`, `status`, `code`, `verified`, `remember_me`) VALUES
('Hero', 'Coder', 'ishimwedeveloper@gmail.com', '0000-00-00', '', 'coder', '$2y$10$t0TIqyRsKO.jtdSM9PyFnOeSW/IE7x/kYz8L2AUH70WlmOd7XgdrS', '', '', '', 'offline', '464455', 0, ''),
('ngirinshuti', 'prudent', 'prudentenri001@gmail.com', '2021-10-20', 'Male', 'enzo', '4c8b3664cee92bd72dafa03a6513b984850a1b78', 'Unknown', '615.png', 'Unknown', 'online', '500388', 0, ''),
('niyonsaba', 'pascal', 'niyopascalg@gmail.com', '1997-10-07', 'Male', 'Lissouba', 'e091dbf01fb1d6484fc5e69138b0ae89c1ce30b3', 'I am student', 'default.png', 'Rwanda', 'online', '433730', 0, ''),
('Nsanzimana', 'Emmanuel', 'nsanzimanaofficial@gmail.com', '2021-10-20', 'Male', 'Makuza', '4c8b3664cee92bd72dafa03a6513b984850a1b78', 'Unknown', 'default.png', 'Unknown', 'offline', '520666', 0, ''),
('ISHIMWE', 'Valentin', 'ishimwevalentin3@gmail.com', '0000-00-00', '', 'valentin', '$2y$10$hzYhxD7t3Q56GM5xR.0Y3.S.hWizI5cdd/H5rT5Y04w9Sb3v2fhHy', '', '629.JPG', 'Kenya', 'offline', '110085', 1, '$2y$10$n/3CUMIZDyGet0drJXgvceTH5J81kwEuWF6l/QslXd0voDBWNDnm6'),
('ishimwe', 'valentin', 'prudentenz001@gmail.com', '2021-10-20', 'Male', 'vava', '$2y$10$0.ER4L9nsmnE8mLXRr52ROPNxIgjXV3TrTbyfpOfUq1ahpIu4KPEe', 'w', '268.jpg', 'Unknown', 'online', '530036', 1, ''),
('ISHIMWE', 'jsdjhsd', 'ishimwevalentin3@gmail.comw', '0000-00-00', '', 'yeahp', '$2y$10$1xjROiN4i/3aQhpa8QU6EO2qnMDv40fjPlinSipovCdoQCHU9kJTW', '', '', '', 'offline', '870581', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD KEY `delete_message` (`message_id`),
  ADD KEY `userdeletedmessage` (`user`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`sender`,`reciever`),
  ADD KEY `reciever` (`reciever`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend`,`partener`),
  ADD KEY `partener` (`partener`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date_` (`date_`),
  ADD KEY `reciever` (`reciever`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`username`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`username`,`post_id`),
  ADD KEY `post_likes` (`post_id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3342;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD CONSTRAINT `delete_message` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userdeletedmessage` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD CONSTRAINT `friendrequest_ibfk_1` FOREIGN KEY (`reciever`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friendrequest_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`friend`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`partener`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `reciever` FOREIGN KEY (`reciever`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_liked_posts` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
