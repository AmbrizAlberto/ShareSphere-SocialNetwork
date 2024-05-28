-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 16:39:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `comment`) VALUES
(13, 44, 18, 'Graciasss', '2024-05-28 04:56:09', NULL),
(14, 44, 18, 'Ahora podre cuidar mejor el agua', '2024-05-28 04:56:25', NULL),
(15, 46, 18, 'Interesante', '2024-05-28 04:58:07', NULL);

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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) DEFAULT NULL,
  `reactor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `date_created`, `post_id`, `reactor_id`) VALUES
(43, 20, 'El usuario ing_pancho ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:39:16', NULL, 20),
(44, 20, 'El usuario ing_pancho ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 04:39:19', NULL, 20),
(45, 20, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:40:40', NULL, 21),
(46, 20, 'El usuario holasoybeto ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 04:40:41', NULL, 21),
(48, 20, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:40:50', NULL, 21),
(49, 21, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 04:45:09', NULL, 21),
(50, 21, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 04:47:04', NULL, 21),
(51, 20, 'El usuario holasoybeto ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 04:47:09', NULL, 21),
(53, 20, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:47:16', NULL, 21),
(54, 20, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:47:17', NULL, 21),
(55, 21, 'El usuario holasoybeto ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 04:47:19', NULL, 21),
(56, 21, 'El usuario holasoybeto ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 04:47:21', NULL, 21),
(57, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 04:47:47', NULL, 18),
(58, 21, 'El usuario al.jsx ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 04:47:49', NULL, 18),
(59, 20, 'El usuario al.jsx ha dado like a tu publicación \"&iquest;Qu&eacute; es la Vida Marina?\"', '2024-05-28 04:47:50', NULL, 18),
(60, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 04:47:53', NULL, 18),
(63, 21, 'El usuario al.jsx ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 04:57:53', NULL, 18),
(78, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:13', NULL, 18),
(79, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:14', NULL, 18),
(80, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 05:28:25', NULL, 18),
(81, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 05:28:28', NULL, 18),
(82, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 05:28:31', NULL, 18),
(83, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:36', NULL, 18),
(84, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:39', NULL, 18),
(85, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:40', NULL, 18),
(86, 20, 'El usuario al.jsx ha dado like a tu publicación \"Recomendaciones para el cuidado del agua\"', '2024-05-28 05:28:47', NULL, 18),
(87, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 05:29:07', NULL, 18),
(88, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 05:36:57', NULL, 18),
(89, 21, 'El usuario al.jsx ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 05:37:04', NULL, 18),
(90, 21, 'El usuario al.jsx ha dado like a tu publicación \"&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?\"', '2024-05-28 05:38:13', NULL, 18),
(91, 18, 'El usuario al.jsx ha dado like a tu publicación \"Hola Post\"', '2024-05-28 06:49:47', NULL, 18),
(92, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 09:23:06', 47, 18),
(93, 21, 'El usuario al.jsx ha dado like a tu publicación \"Algas y plantas marina\"', '2024-05-28 14:31:47', 47, 18);

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
(43, 'Las Hidroelectricas', 'Esto pudiera resultar obvio, pero sin agua no podr&iacute;amos vivir. Todos los ciclos bioqu&iacute;micos y f&iacute;sicos de nuestro planeta involucran el agua de una forma u otra. Est&aacute; en los oc&eacute;anos que componen dos tercios de nuestro planeta, en el vapor de agua de nuestra atm&oacute;sfera y en densas capas de hielo en los polos, que operan como enormes aires acondicionados para mantener el clima estable.', 'LasHidroelectricas2024-05-28_06-32-08.jpeg', '2024-05-27 22:32:08', NULL, 18, 1),
(44, 'Recomendaciones para el cuidado del agua', 'Atender las fugas de agua en el sanitario. Una p&eacute;rdida de agua de esta naturaleza significa el sacrificio en vano de 100 a 1.000 litros de agua diariamente.\r\nCerrar los grifos que no se utilizan. Al ba&ntilde;arnos, lavarnos las manos, cepillarnos los dientes u otras actividades cotidianas, podemos cerrar el grifo y volverlo a abrir, en lugar de dejar el agua correr sin darle uso.\r\nEmplear agua reciclada para regar las plantas. En la medida de lo posible, no destine aguas limpias para el mantenimiento de las plantas, especialmente si se trata de c&eacute;spedes o largas extensiones vegetales.', 'Recomendacionesparaelcuidadodelagua2024-05-28_06-35-28.jpeg', '2024-05-27 22:35:28', '2024-05-27 22:35:58', 20, 1),
(45, '&iquest;Qu&eacute; es la Vida Marina?', 'La vida marina, la conforman las plantas, los animales y otros organismos que viven en el agua salada de los mares y oc&eacute;anos, o el agua salobre de los estuarios costeros. En un nivel fundamental, la vida marina ayuda a determinar la naturaleza misma de nuestro planeta. Los organismos marinos producen gran parte del ox&iacute;geno que respiramos. Las costas est&aacute;n en parte conformadas y protegidas por la vida marina, y algunos organismos marinos incluso ayudan a crear nuevas tierras.', NULL, '2024-05-27 22:38:01', '2024-05-27 22:39:09', 20, 4),
(46, '&iquest;En qu&eacute; consiste el ODS sobre Energ&iacute;a Asequible?', 'El Objetivo de Desarrollo Sostenible n&uacute;mero 7 tiene como objetivo primordial asegurar que todos tengan acceso a una fuente de energ&iacute;a asequible, segura, sostenible y moderna. Para lograrlo, es esencial incrementar notablemente la eficiencia energ&eacute;tica a nivel global y aumentar significativamente la proporci&oacute;n de energ&iacute;as renovables en la matriz energ&eacute;tica.', '2024-05-28_06-44-45energia.jpg', '2024-05-27 22:44:14', '2024-05-27 22:44:45', 21, 3),
(47, 'Algas y plantas marina', 'Las algas y las plantas microsc&oacute;picas proporcionan h&aacute;bitats importantes para la vida, a veces actuando como lugares de escondite y b&uacute;squeda de alimento para las formas larvarias de peces e invertebrados m&aacute;s grandes. Las algas se encuentran muy difundidas en los oc&eacute;anos y adoptan formas diversas. Las algas fotosint&eacute;ticas microsc&oacute;picas contribuyen con una mayor proporci&oacute;n de la producci&oacute;n fotosint&eacute;tica del mundo que la de todos los bosques terrestres combinados. La mayor parte del nicho ocupado por subplantas en la tierra en realidad est&aacute; ocupado por algas macrosc&oacute;picas en el oc&eacute;ano, tales como Sargassum y algas marinas, que crean bosques de algas marinas.', NULL, '2024-05-27 22:46:21', NULL, 21, 1);

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
(114, 18, 43),
(123, 18, 44),
(127, 18, 46),
(130, 18, 47),
(81, 20, 44),
(80, 20, 45),
(89, 21, 43),
(88, 21, 44),
(91, 21, 45),
(92, 21, 46),
(93, 21, 47);

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
(18, 'Alberto', 'Ambriz', 'jambriz0@ucol.mx', NULL, 'al.jsx', '$2y$10$.fVKEZR9XngAvtao5ECm/Ol1/M3AUHdjgsxWL8SSJlKJDiPaudvQe', 'userdefault.png', '', '2024-05-22_07-27-15descarga(3).jpg', 1, NULL, NULL, 1),
(20, 'Pancho', 'Diaz', 'albertpoambez@gmail.com', NULL, 'ing_pancho', '$2y$10$v9XYo..05cyFdTjl9AQLAOXiCk3SGYqkipxm2W/rRgw6GOeijOf32', 'userdefault.png', NULL, NULL, 0, NULL, 59277867, 0),
(21, 'Alberto', 'Ambriz', 'albertpoambez1@gmail.com', NULL, 'holasoybeto', '$2y$10$nlXAGq1W1L6DPPyPbjrY2.bKNzktEnoRs6/Moh7FRVQfu8.Zu.I.G', 'userdefault.png', NULL, NULL, 0, NULL, 55998376, 0);

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
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
