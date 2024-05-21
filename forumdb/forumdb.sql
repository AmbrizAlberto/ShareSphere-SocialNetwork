-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 01:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `providerAccountId` varchar(50) DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `token_type` varchar(50) DEFAULT NULL,
  `scope` varchar(50) DEFAULT NULL,
  `id_token` text DEFAULT NULL,
  `session_state` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creatorId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `replyToId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentvote`
--

CREATE TABLE `commentvote` (
  `id` int(11) NOT NULL,
  `type` enum('UPVOTE','DOWNVOTE') DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creatorId` int(11) NOT NULL,
  `SubgroupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `image`, `createdAt`, `updatedAt`, `creatorId`, `SubgroupId`) VALUES
(29, 'hola', 'buenos dias', 'hola2024-05-02_21-24-26.jpeg', '2024-05-02 13:24:26', NULL, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creatorId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `sessionToken` varchar(50) DEFAULT NULL,
  `accessToken` varchar(50) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subgroup`
--

CREATE TABLE `subgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creatorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subgroup`
--

INSERT INTO `subgroup` (`id`, `name`, `description`, `image`, `createdAt`, `updatedAt`, `creatorId`) VALUES
(1, 'Agua limpia y Saneamiento', 'si', 'agua.png', '2024-03-13 09:00:08', '2024-05-03 11:22:15', 16),
(3, 'Energia Asequible y No Contaminante', '7', 'nose.png', '2024-04-25 21:43:12', '2024-05-03 11:22:20', 16),
(4, 'Vida Submarina', '14', 'vidamarina.png', '2024-04-25 21:43:12', '2024-05-03 11:22:25', 16);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `userId` int(11) NOT NULL,
  `SubgroupId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailVerified` datetime DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `passwordHash` varchar(60) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `coverImg` varchar(50) DEFAULT NULL,
  `theme` int(1) NOT NULL,
  `code` int(8) DEFAULT NULL,
  `admin_code` int(6) DEFAULT NULL,
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `email`, `emailVerified`, `username`, `passwordHash`, `image`, `descripcion`, `coverImg`, `theme`, `code`, `admin_code`, `admin`) VALUES
(13, 'alberto', 'ambriz', 'jaguilar51@ucol.mx', NULL, 'betozzz', '$2y$10$seDgKj2yqrcwA.cNDeOtou1y0vgUTxZazB/Wf97to6ipqECvdr5zy', '2024-05-01_03-48-08teletubiev2.jpg', '', NULL, 1, NULL, NULL, 0),
(15, 'ajjajaj', 'genial ', 'hola@ucol.mx', NULL, 'armando', '$2y$10$cCktAHld350lwobbYLLwBO7MrX2HyX0826DIp/AEzFZirbFWHlkP2', 'userdefault.png', NULL, NULL, 1, NULL, NULL, 0),
(16, 'si', 'no', 's', NULL, 'sa', '$2y$10$RQNUMfAo3DeufciTSRP.f.imOwlVkOBN8HNFEm5sY2JjkYixT48UW', ' jlx', 'jgk', 'gfg', 0, 0, NULL, 0),
(17, 'Alan Adolfo San', 'Millan Ramos', 'asanmillan@ucol.mx', NULL, 'Alan', '$2y$10$RQNUMfAo3DeufciTSRP.f.imOwlVkOBN8HNFEm5sY2JjkYixT48UW', 'userdefault.png', NULL, NULL, 0, 7, 347821, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `type` enum('UPVOTE','DOWNVOTE') DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `commentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider` (`provider`,`providerAccountId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `SubgroupId` (`SubgroupId`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `subgroup`
--
ALTER TABLE `subgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subgroup_ibfk_1` (`creatorId`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`userId`,`SubgroupId`),
  ADD KEY `SubgroupId` (`SubgroupId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`,`postId`,`commentId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `commentId` (`commentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subgroup`
--
ALTER TABLE `subgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `post` (`id`);

--
-- Constraints for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD CONSTRAINT `commentvote_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commentvote_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`SubgroupId`) REFERENCES `subgroup` (`id`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subgroup`
--
ALTER TABLE `subgroup`
  ADD CONSTRAINT `subgroup_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`SubgroupId`) REFERENCES `subgroup` (`id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
