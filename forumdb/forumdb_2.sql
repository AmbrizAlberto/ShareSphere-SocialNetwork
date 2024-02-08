-- File created to test the database schema for the forum app.


--- "USER" TABLE (TABLA DE USUARIO) ---

CREATE TABLE `User` (
    `id` VARCHAR(255) PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE,
    `emailVerified` DATETIME,
    `username` VARCHAR(255) UNIQUE,
    `passwordHash` VARCHAR(60) NOT NULL,
    `image` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--- "ACCOUNT" TABLE (TABLA DE CUENTA)" ---

CREATE TABLE `Account` (
  `id` VARCHAR(255) PRIMARY KEY,
  `userId` VARCHAR(255),
  `type` VARCHAR(255),
  `provider` VARCHAR(255),
  `providerAccountId` VARCHAR(255),
  `refresh_token` TEXT,
  `access_token` TEXT,
  `expires_at` INT,
  `token_type` VARCHAR(255),
  `scope` VARCHAR(255),
  `id_token` TEXT,
  `session_state` VARCHAR(255),
  UNIQUE(`provider`, `providerAccountId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


---"SESSION" TABLE (TABLA DE SESIÓN )" ---

CREATE TABLE `Session` (
  `id` VARCHAR(255) PRIMARY KEY,
  `userId` VARCHAR(255),
  `expires` DATETIME,
  `sessionToken` VARCHAR(255),
  `accessToken` VARCHAR(255),
  `createdAt` DATETIME,
  `updatedAt` DATETIME,
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--- "VERIFICATION_REQUEST TABLE (TABLA DE VERIFICATION_REQUEST)" ---  EN CASO DE QUE SE REQUIERA 
VERIFICAR EL CORREO ELECTRÓNICO

/* 
CREATE TABLE `VerificationRequest` (
  `id` VARCHAR(255) PRIMARY KEY,
  `identifier` VARCHAR(255),
  `token` VARCHAR(255),
  `expires` DATETIME,
  `createdAt` DATETIME,
  `updatedAt` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; */

--- "SUBGROUP" TABLE (SUBGRUPO) ---
CREATE TABLE `Subgroup` (
  `id` VARCHAR(255) PRIMARY KEY,
  `name` VARCHAR(255),
  `description` TEXT,
  `image` VARCHAR(255),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  'creatorId' VARCHAR(255),
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--- SUBSCRIPTION TABLE (SUBSCRIPCIÓN) ---

CREATE TABLE `Subscription` (
  `id` VARCHAR(255) PRIMARY KEY,
  `userId` VARCHAR(255),
  `SubgroupId` VARCHAR(255),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`, `SubgroupId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--- "POST" TABLE (TABLA DE PUBLICACIÓN) ---

CREATE TABLA `Post` (
  `id` VARCHAR(255) PRIMARY KEY,
  `title` VARCHAR(255),
  `content` TEXT,
  `image` VARCHAR(255),
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` VARCHAR(255),
  `SubgroupId` VARCHAR(255),
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`SubgroupId`) REFERENCES `Subgroup`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 


--- "COMMENT" TABLE (TABLA DE COMENTARIOS) ---

CREATE TABLE `Comment` (
  `id` VARCHAR(255) PRIMARY KEY,
  `content` TEXT,
  `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creatorId` VARCHAR(255),
  `postId` VARCHAR(255),
  'replyToId' VARCHAR(255),
  FOREIGN KEY (`creatorId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--- "VOTE TABLE (TABLA DE VOTOS)" ---

CREATE TABLE `Vote` (
  `id` VARCHAR(255) PRIMARY KEY,
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` VARCHAR(255),
  `postId` VARCHAR(255),
  `commentId` VARCHAR(255),
/*  
 'commentId' is used to store the comment id when the vote is for a comment.
*/
  PRIMARY KEY (`userId`, `postId`, `commentId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`postId`) REFERENCES `Post`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--- "COMMENT VOTE TABLE (TABLA DE VOTOS DE COMENTARIOS)" ---

CREATE TABLE `CommentVote` (
  `id` VARCHAR(255) PRIMARY KEY,
  `type` ENUM('UPVOTE', 'DOWNVOTE'),
  `userId` VARCHAR(255),
  `commentId` VARCHAR(255),
  PRIMARY KEY (`userId`, `commentId`),
  FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
  FOREIGN KEY (`commentId`) REFERENCES `Comment`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

