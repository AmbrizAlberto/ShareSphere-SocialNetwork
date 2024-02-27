-- File created to test the database schema for the forum app.


--"USER" TABLE (TABLA DE USUARIO)--

CREATE TABLE `User` (
    `id` VARCHAR(36) PRIMARY KEY,
    `name` VARCHAR(50),
    `email` VARCHAR(100) UNIQUE,
    `emailVerified` DATETIME,
    `username` VARCHAR(20) UNIQUE,
    `passwordHash` VARCHAR(60) NOT NULL,
    `image` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--"ACCOUNT" TABLE (TABLA DE CUENTA)"--

CREATE TABLE `Account` (
  `id` VARCHAR(36) PRIMARY KEY,
  `userId` VARCHAR(36),
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


--"SESSION" TABLE (TABLA DE SESIÓN )" --

CREATE TABLE `Session` (
  `id` VARCHAR(36) PRIMARY KEY,
  `userId` VARCHAR(36),
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
  `id` VARCHAR(36) PRIMARY KEY,
  `identifier` VARCHAR(50),
  `token` VARCHAR(50),
  `expires` DATETIME,
  `createdAt` DATETIME,
  `updatedAt` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; */


-- "SUBGROUP" TABLE (TABLA DE SUBGRUPO) --
CREATE TABLE `Subgroup` (
  `id` VARCHAR(36) PRIMARY KEY,
  `name` VARCHAR(50),
  `description` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` VARCHAR(36),
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- SUBSCRIPTION TABLE (TABLA DE SUBSCRIPCIÓN)--

CREATE TABLE `Subscription` (
  `userId` VARCHAR(36),
  `SubgroupId` VARCHAR(36),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`, `SubgroupId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--"POST" TABLE (TABLA DE PUBLICACIÓN)--

CREATE TABLE `Post` (
  `id` VARCHAR(36) PRIMARY KEY,
  `title` VARCHAR(100),
  `content` TEXT,
  `image` VARCHAR(100),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` VARCHAR(36),
  `SubgroupId` VARCHAR(36),
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 


-- "COMMENT" TABLE (TABLA DE COMENTARIOS) --

CREATE TABLE `Comment` (
  `id` VARCHAR(36) PRIMARY KEY,
  `content` TEXT,
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` VARCHAR(36),
  `postId` VARCHAR(36),
  `replyToId` VARCHAR(36), -- Corrected from 'replyToId' to `replyToId`
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--"VOTE TABLE (TABLA DE VOTOS)"--

CREATE TABLE `Vote` (
  `id` VARCHAR(36),
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` VARCHAR(36),
  `postId` VARCHAR(36) NULL,
  `commentId` VARCHAR(36) NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`userId`, `postId`, `commentId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- "COMMENT VOTE TABLE (TABLA DE VOTOS DE COMENTARIOS)" --

CREATE TABLE `CommentVote` (
  `id` VARCHAR(36),
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` VARCHAR(36),
  `commentId` VARCHAR(36),
  PRIMARY KEY (`userId`, `commentId`), -- Composite primary key
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
