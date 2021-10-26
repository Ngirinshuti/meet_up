-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 06:39 PM
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
  `id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `username`, `created_at`) VALUES
(1, 'Okay', 142, 'valentin', '2021-10-26 15:27:56'),
(2, 'Yeah`', 141, 'valentin', '2021-10-26 15:28:10'),
(3, 'Okay', 142, 'valentin', '2021-10-26 15:30:44'),
(4, 'hjsdhjjhdhjsd', 142, 'valentin', '2021-10-26 15:43:35'),
(5, 'Okay', 142, 'valentin', '2021-10-26 15:51:06'),
(6, 'Okay', 142, 'valentin', '2021-10-26 15:52:04'),
(7, 'dshjjhsd', 142, 'valentin', '2021-10-26 15:52:11'),
(8, 'khjdhjsdhj', 142, 'valentin', '2021-10-26 15:52:51'),
(9, 'jdjjs', 140, 'valentin', '2021-10-26 16:11:19'),
(10, 'Okay', 138, 'valentin', '2021-10-26 16:12:37'),
(11, 'Here we are', 139, 'valentin', '2021-10-26 16:14:09'),
(12, 'Okay', 142, 'valentin', '2021-10-26 16:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `comment_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`comment_id`, `username`) VALUES
(2, 'valentin'),
(4, 'valentin'),
(6, 'valentin'),
(7, 'valentin'),
(10, 'valentin'),
(11, 'valentin');

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendrequest`
--

INSERT INTO `friendrequest` (`sender`, `reciever`, `date`) VALUES
('valentin', 'Lissouba', '2021-10-25 20:35:26'),
('valentin', 'Makuza', '2021-10-25 21:54:29'),
('valentin', 'vava', '2021-10-25 20:32:24');

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
('Lissouba', 'vava'),
('Makuza', 'enzo'),
('Makuza', 'vava'),
('valentin', 'enzo'),
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
  `status` varchar(10) NOT NULL DEFAULT 'unread',
  `story_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `reciever`, `body`, `date_`, `status`, `story_id`) VALUES
(168, 'valentin', 'vava', 'Yeah!', '2021-10-25 22:11:51', 'unread', NULL),
(588, 'valentin', 'coder', 'Yeah', '2021-10-25 15:52:46', 'unread', NULL),
(720, 'valentin', 'coder', '.(:', '2021-10-25 22:20:29', 'unread', NULL),
(896, 'vava', 'enzo', 'Hi', '2021-10-24 15:01:48', 'unread', NULL),
(1173, 'vava', 'enzo', 'hello', '2021-10-17 19:08:20', 'read', NULL),
(1282, 'Lissouba', 'vava', 'hello valentin', '2021-10-18 11:52:53', 'read', NULL),
(1292, 'vava', 'Lissouba', 'yes bro', '2021-10-18 11:53:21', 'read', NULL),
(1333, 'valentin', 'coder', 'cool \n(: (:', '2021-10-25 22:20:50', 'unread', NULL),
(1824, 'vava', 'Lissouba', 'Go get them!', '2021-10-24 15:02:00', 'unread', NULL),
(2095, 'vava', 'Lissouba', 'YEah!', '2021-10-24 15:01:55', 'unread', NULL),
(2224, 'enzo', 'vava', 'hello vava', '2021-10-17 19:07:44', 'read', NULL),
(2649, 'valentin', 'coder', 'That works!', '2021-10-25 22:20:19', 'unread', NULL),
(2678, 'vava', 'valentin', 'Wowow', '2021-10-25 22:11:27', 'read', NULL),
(2964, 'valentin', 'coder', 'Hello, brother!', '2021-10-24 09:30:40', 'unread', NULL),
(3295, 'valentin', 'coder', 'Wowow', '2021-10-24 09:30:43', 'unread', NULL);

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
(137, 'Hey there', '', '', 'vava', '2021-10-24 19:44:57'),
(138, 'For our country!', '7489868.png', '', 'valentin', '2021-10-25 19:00:41'),
(139, '', '9706891.png', '', 'valentin', '2021-10-26 08:39:09'),
(140, '', '', '', 'valentin', '2021-10-26 08:39:20'),
(141, '', '4174936.jpg', '', 'valentin', '2021-10-26 09:23:15'),
(142, 'Oka', '', '', 'valentin', '2021-10-26 09:28:24');

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
('valentin', 138),
('valentin', 139),
('vava', 137);

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
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `expired` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `has_media` tinyint(4) DEFAULT 0,
  `media` varchar(300) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `username`, `image`, `description`, `expired`, `created_at`, `has_media`, `media`, `views`) VALUES
(53, 'vava', '6969390', 'Hashye!', 0, '2021-10-24 19:22:05', 0, '', 1),
(54, 'valentin', '', 'what are u doing', 0, '2021-10-25 22:08:49', 0, '', 2),
(55, 'vava', '', 'Doing somthing cool', 0, '2021-10-26 07:45:12', 1, '1769599', 1);

-- --------------------------------------------------------

--
-- Table structure for table `story_views`
--

CREATE TABLE `story_views` (
  `story_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `story_views`
--

INSERT INTO `story_views` (`story_id`, `username`) VALUES
(53, 'vava'),
(54, 'valentin'),
(54, 'vava'),
(55, 'vava');

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
('ngirinshuti', 'prudent', 'prudentenri001@gmail.com', '2021-10-20', 'Male', 'enzo', '$2y$10$dbea5X8k6dJ8aNFNq74IeeCfJA2i5aFfp4GQ.7JhkoSq3b4euzsHS', 'Unknown', '615.png', 'Unknown', 'online', '500388', 1, ''),
('niyonsaba', 'pascal', 'niyopascalg@gmail.com', '1997-10-07', 'Male', 'Lissouba', 'e091dbf01fb1d6484fc5e69138b0ae89c1ce30b3', 'I am student', 'default.png', 'Rwanda', 'online', '433730', 0, ''),
('Nsanzimana', 'Emmanuel', 'nsanzimanaofficial@gmail.com', '2021-10-20', 'Male', 'Makuza', '4c8b3664cee92bd72dafa03a6513b984850a1b78', 'Unknown', 'default.png', 'Unknown', 'offline', '520666', 0, ''),
('ISHIMWE', 'Valentin', 'ishimwevalentin3@gmail.com', '0000-00-00', '', 'valentin', '$2y$10$hzYhxD7t3Q56GM5xR.0Y3.S.hWizI5cdd/H5rT5Y04w9Sb3v2fhHy', '', '476.jpg', 'Kenya', 'offline', '110085', 1, '$2y$10$rV2ib6ic5stYQRcPz/Y9TuXWwNUIfjB2IHNls62q5Cea1W3JuMgQO'),
('ishimwe', 'valentin', 'prudentenz001@gmail.com', '2021-10-20', 'Male', 'vava', '$2y$10$0.ER4L9nsmnE8mLXRr52ROPNxIgjXV3TrTbyfpOfUq1ahpIu4KPEe', 'w', '410.png', 'Unknown', 'offline', '530036', 1, ''),
('ISHIMWE', 'jsdjhsd', 'ishimwevalentin3@gmail.comw', '0000-00-00', '', 'yeahp', '$2y$10$1xjROiN4i/3aQhpa8QU6EO2qnMDv40fjPlinSipovCdoQCHU9kJTW', '', '', '', 'offline', '870581', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_comments` (`username`),
  ADD KEY `post_comments` (`post_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`comment_id`,`username`),
  ADD KEY `user_comment_likes` (`username`);

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
  ADD KEY `sender` (`sender`),
  ADD KEY `story_reply` (`story_id`);

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
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_stories` (`username`);

--
-- Indexes for table `story_views`
--
ALTER TABLE `story_views`
  ADD PRIMARY KEY (`story_id`,`username`),
  ADD KEY `story_viewer` (`username`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3342;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_comments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comments` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment_likes` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_reply` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `user_stories` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_views`
--
ALTER TABLE `story_views`
  ADD CONSTRAINT `story_viewed` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_viewer` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
