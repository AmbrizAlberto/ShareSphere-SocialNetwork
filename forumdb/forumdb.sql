-- phpMyAdmin SQL Dump
-- https://www.phpmyadmin.net/
-- 
-- Host: localhost
-- Generation Time: Feb 8, 2024 at 9:00 AM

-- PHP Version: x.x.x

/*
This SQL script creates the necessary tables for a forum database. 
The tables include:
- User: stores user information such as name, email, username, and password.
- Account: stores account information for user authentication.
- Session: stores session information for user login.
- VerificationRequest: (commented out) table for email verification requests.
- Subgroup: stores information about subgroups within the forum.
- Subscription: stores information about user subscriptions to subgroups.
- Post: stores information about forum posts.
- Comment: stores information about comments on forum posts.
- Vote: stores information about votes on forum posts and comments.
- CommentVote: stores information about votes on comments.
*/

-- "USER" TABLE (TABLA DE USUARIO)

CREATE TABLE `User` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `emailVerified` DATETIME,
    `username` VARCHAR(20) NOT NULL UNIQUE,
    `passwordHash` VARCHAR(60) NOT NULL,
    `image` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "ACCOUNT" TABLE (TABLA DE CUENTA)"

CREATE TABLE `Account` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userId` INT NOT NULL,
  `type` VARCHAR(20),
  `provider` VARCHAR(50),
  `providerAccountId` VARCHAR(50),
  `refresh_token` TEXT,
  `access_token` TEXT,
  `expires_at` INT,
  `token_type` VARCHAR(50),
  `scope` VARCHAR(50),
  `id_token` TEXT,
  `session_state` VARCHAR(50),
  UNIQUE(`provider`, `providerAccountId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "SESSION" TABLE (TABLA DE SESIÓN )" 

CREATE TABLE `Session` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userId` INT NOT NULL,
  `expires` DATETIME,
  `sessionToken` VARCHAR(50),
  `accessToken` VARCHAR(50),
  `createdAt` DATETIME,
  `updatedAt` DATETIME,
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "VERIFICATION_REQUEST TABLE (TABLA DE VERIFICATION_REQUEST)" --  
-- EN CASO DE QUE SE REQUIERA VERIFICAR EL CORREO ELECTRÓNICO --

/* 
CREATE TABLE `VerificationRequest` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `identifier` VARCHAR(50),
  `token` VARCHAR(50),
  `expires` DATETIME,
  `createdAt` DATETIME,
  `updatedAt` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; */


-- "SUBGROUP" TABLE (TABLA DE SUBGRUPO) 
CREATE TABLE `Subgroup` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` INT NOT NULL,
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- SUBSCRIPTION TABLE (TABLA DE SUBSCRIPCIÓN)

CREATE TABLE `Subscription` (
  `userId` INT NOT NULL,
  `SubgroupId` INT NOT NULL,
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`, `SubgroupId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "POST" TABLE (TABLA DE PUBLICACIÓN)--

CREATE TABLE `Post` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `content` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` INT NOT NULL,
  `SubgroupId` INT NOT NULL,
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 


-- "COMMENT" TABLE (TABLA DE COMENTARIOS) 

CREATE TABLE `Comment` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `content` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` INT NOT NULL,
  `postId` INT NOT NULL,
  `replyToId` INT, -- Corrected from 'replyToId' to `replyToId`
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "RESPONSE" TABLE (TABLA DE RESPUESTAS A COMENTARIOS) 

CREATE TABLE `Response` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `content` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` INT NOT NULL,
  `commentId` INT NOT NULL,
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "VOTE TABLE (TABLA DE VOTOS)"

CREATE TABLE `Vote` (
  `id` INT AUTO_INCREMENT,
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` INT NOT NULL,
  `postId` INT,
  `commentId` INT,
  PRIMARY KEY (`id`),
  UNIQUE (`userId`, `postId`, `commentId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "COMMENT VOTE TABLE (TABLA DE VOTOS DE COMENTARIOS)"

CREATE TABLE `CommentVote` (
  `id` INT AUTO_INCREMENT,
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` INT NOT NULL,
  `commentId` INT NOT NULL,
  PRIMARY KEY (`userId`, `commentId`), -- Composite primary key
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
