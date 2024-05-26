-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-05-2024 a las 09:43:59
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `forumdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account`
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
-- Estructura de tabla para la tabla `comment`
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
-- Estructura de tabla para la tabla `commentvote`
--

CREATE TABLE `commentvote` (
  `id` int(11) NOT NULL,
  `type` enum('UPVOTE','DOWNVOTE') DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `date_created`) VALUES
(4, 13, 'El usuario 18 ha dado like a tu publicación 29', '2024-05-25 05:35:03'),
(7, 13, 'El usuario 19 ha dado like a tu publicación 29', '2024-05-25 05:36:12'),
(15, 18, 'El usuario 18 ha dado like a tu publicación 39', '2024-05-25 07:41:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
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
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `image`, `createdAt`, `updatedAt`, `creatorId`, `SubgroupId`) VALUES
(29, 'hola', 'buenos dias', 'hola2024-05-02_21-24-26.jpeg', '2024-05-02 13:24:26', NULL, 13, 4),
(38, 'ihsidgfuisguydf', 'sdfguishdgufsdf', '2024-05-23_02-36-441mb2.jpeg', '2024-05-22 18:35:19', '2024-05-22 18:36:44', 18, 1),
(39, 'asdasdad', 'asdadsad', NULL, '2024-05-24 19:14:49', NULL, 18, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`) VALUES
(28, 18, 29),
(12, 18, 38),
(39, 18, 39),
(31, 19, 29),
(34, 19, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `response`
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
-- Estructura de tabla para la tabla `session`
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
-- Estructura de tabla para la tabla `subgroup`
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
-- Volcado de datos para la tabla `subgroup`
--

INSERT INTO `subgroup` (`id`, `name`, `description`, `image`, `createdAt`, `updatedAt`, `creatorId`) VALUES
(1, 'Agua limpia y Saneamiento', 'si', 'agua.png', '2024-03-13 09:00:08', '2024-05-03 11:22:15', 16),
(3, 'Energia Asequible y No Contaminante', '7', 'nose.png', '2024-04-25 21:43:12', '2024-05-03 11:22:20', 16),
(4, 'Vida Submarina', '14', 'vidamarina.png', '2024-04-25 21:43:12', '2024-05-03 11:22:25', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscription`
--

CREATE TABLE `subscription` (
  `userId` int(11) NOT NULL,
  `SubgroupId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
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
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `email`, `emailVerified`, `username`, `passwordHash`, `image`, `descripcion`, `coverImg`, `theme`, `code`, `admin_code`, `admin`) VALUES
(13, 'alberto', 'ambriz', 'jaguilar51@ucol.mx', NULL, 'betozzz', '$2y$10$seDgKj2yqrcwA.cNDeOtou1y0vgUTxZazB/Wf97to6ipqECvdr5zy', '2024-05-01_03-48-08teletubiev2.jpg', '', NULL, 1, NULL, NULL, 0),
(15, 'ajjajaj', 'genial ', 'hola@ucol.mx', NULL, 'armando', '$2y$10$cCktAHld350lwobbYLLwBO7MrX2HyX0826DIp/AEzFZirbFWHlkP2', 'userdefault.png', NULL, NULL, 1, NULL, NULL, 0),
(16, 'si', 'no', 's', NULL, 'sa', '$2y$10$RQNUMfAo3DeufciTSRP.f.imOwlVkOBN8HNFEm5sY2JjkYixT48UW', ' jlx', 'jgk', 'gfg', 0, 0, NULL, 0),
(17, 'Alan Adolfo San', 'Millan Ramos', 'asanmillan@ucol.mx', NULL, 'Alan', '$2y$10$RQNUMfAo3DeufciTSRP.f.imOwlVkOBN8HNFEm5sY2JjkYixT48UW', 'userdefault.png', NULL, NULL, 0, 7, 347821, 1),
(18, 'Alberto', 'Ambriz', 'jambriz0@ucol.mx', NULL, 'al.jsx', '$2y$10$.fVKEZR9XngAvtao5ECm/Ol1/M3AUHdjgsxWL8SSJlKJDiPaudvQe', 'userdefault.png', '', '2024-05-22_07-27-15descarga(3).jpg', 0, NULL, NULL, 1),
(19, 'Al', 'AC', 'albertpoambez@gmail.com', NULL, 'albertp', '$2y$10$uZHpC6v.PxMtAKrMCslkgO7Otn0VD3VwdqnqWdv73eqRAFWzOFa1u', 'userdefault.png', NULL, NULL, 0, NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider` (`provider`,`providerAccountId`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `postId` (`postId`);

--
-- Indices de la tabla `commentvote`
--
ALTER TABLE `commentvote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `SubgroupId` (`SubgroupId`);

--
-- Indices de la tabla `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorId` (`creatorId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indices de la tabla `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `subgroup`
--
ALTER TABLE `subgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subgroup_ibfk_1` (`creatorId`);

--
-- Indices de la tabla `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`userId`,`SubgroupId`),
  ADD KEY `SubgroupId` (`SubgroupId`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subgroup`
--
ALTER TABLE `subgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `post` (`id`);

--
-- Filtros para la tabla `commentvote`
--
ALTER TABLE `commentvote`
  ADD CONSTRAINT `commentvote_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commentvote_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`);

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`SubgroupId`) REFERENCES `subgroup` (`id`);

--
-- Filtros para la tabla `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Filtros para la tabla `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`);

--
-- Filtros para la tabla `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subgroup`
--
ALTER TABLE `subgroup`
  ADD CONSTRAINT `subgroup_ibfk_1` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`SubgroupId`) REFERENCES `subgroup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
