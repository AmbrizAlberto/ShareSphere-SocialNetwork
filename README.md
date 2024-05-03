# Open Social Communication Platform (Web Forum) :globe_with_meridians:

## Project Overview
The Open Social Communication Platform is a web-based forum designed to foster an enriching exchange of information and perspectives within virtual communities. This digital interaction platform enables the posting and replying of messages by users within thematic threads, featuring user profiles and moderation systems to promote a constructive and inclusive participation environment. The forum's design emphasizes accessibility and interaction, ensuring a seamless user experience for all community members.

This project is aligned with the [UNESCO's Sustainable Development Goals (SDGs)](https://es.unesco.org/sdgs) :earth_americas:, focusing on:

- Clean Water and Sanitation
- Affordable and Clean Energy
- Life Below Water

These themes guide the forum's content and discussions, encouraging users to engage in meaningful dialogues about these critical global challenges.

## Technologies Utilized
The platform is built using a robust stack of web technologies to ensure a dynamic, responsive, and secure user experience. The key technologies include:

- HTML: Structuring the web content and layout.
- CSS: Styling the application to provide a visually appealing and intuitive user interface.
- JavaScript (JS): Enhancing interactivity and ensuring dynamic content delivery.
- PHP: Server-side scripting to handle application logic, user authentication, and interaction with the MySQL database.
- MySQL: Storing user data, forum threads, and posts securely and efficiently, ensuring data integrity and availability.

## Functionalities and Features

### Core Functionalities
1. Web Application Development: A highly interactive and accessible web forum service.
1. Data Storage System: Utilizes a local database for secure and reliable information storage.
1. Role-Based Access Control: Precise definition of roles, permissions, and interface visualization tailored to user needs.

### Database Design 
The database is structured to efficiently store and manage data related to users, posts, comments, and responses. It includes tables for user information, post content, comment details, and responses to comments. Each table is designed with appropriate primary and foreign keys to ensure data integrity and facilitate complex queries. More detailed information about each table and its elements will be provided in subsequent documentation.

![ERD_forumdb](https://github.com/JDAA4/Foro-Web-Equipo-1/assets/150212751/ef95a0f7-8c1d-410c-b98c-6009aadc6923)

The following descriptions provide detailed information about the structure and elements of the database tables:

- The `User` table is designed to store information about the users of the application. Each user has a unique `id` that auto-increments and serves as the primary key. The `name`, `email`, and `username` fields store the user's name, email address, and username, respectively. The `email` and `username` fields are unique to prevent duplicate entries. The `emailVerified` field stores the date and time when the user's email address was verified. The `passwordHash` field stores a hashed version of the user's password for security purposes. The `image` field can store a URL to the user's profile picture.

- The `Account` table is designed to store information about the user's account, particularly for third-party authentication providers. Each account also has a unique `id` that auto-increments and serves as the primary key. The `userId` field is a foreign key that links to the `id` of the `User` table, establishing a relationship between the two tables. The `type`, `provider`, and `providerAccountId` fields store information about the type of account, the name of the provider (e.g., Google, Facebook), and the account ID from the provider. The `refresh_token`, `access_token`, `expires_at`, `token_type`, `scope`, `id_token`, and `session_state` fields store information related to Auth tokens and sessions. The combination of `provider` and `providerAccountId` is unique to prevent duplicate entries. If a user is deleted, the corresponding account entries will also be deleted due to the `ON DELETE CASCADE` clause.

- `Session` table stores information about user sessions. Each session has a unique `id` that auto-increments and serves as the primary key. The `userId` field is a foreign key that links to the `id` of the `User` table, establishing a relationship between the two tables. The `expires` field stores the expiration date and time of the session. The `sessionToken` and `accessToken` fields store the session and access tokens, respectively. The `createdAt` and `updatedAt` fields store the date and time when the session was created and last updated, respectively. If a user is deleted, the corresponding session entries will also be deleted due to the `ON DELETE CASCADE` clause.

- The `Subgroup` table is designed to store information about subgroups within the application. Each subgroup also has a unique `id` that auto-increments and serves as the primary key. The `name` field stores the name of the subgroup, and the `description` field stores a description of the subgroup. The `image` field can store a URL to an image representing the subgroup. The `createdAt` and `updatedAt` fields store the date and time when the subgroup was created and last updated, respectively. The `creatorId` field is a foreign key that links to the `id` of the `User` table, indicating the user who created the subgroup.

- The `Subscription` table is designed to store information about user subscriptions to subgroups. The `userId` and `SubgroupId` fields are foreign keys that link to the `id` of the `User` and `Subgroup` tables, respectively, establishing a relationship between the tables. These two fields together form the primary key of the `Subscription` table, meaning that each combination of `userId` and `SubgroupId` must be unique. The `createdAt` and `updatedAt` fields store the date and time when the subscription was created and last updated, respectively.

- The `Post` table stores information about posts made within subgroups. Each post has a unique `id` that auto-increments and serves as the primary key. The `title` field stores the title of the post, and the `content` field stores the content of the post. The `image` field can store a URL to an image associated with the post. The `createdAt` and `updatedAt` fields store the date and time when the post was created and last updated, respectively. The `creatorId` and `SubgroupId` fields are foreign keys that link to the `id` of the `User` and `Subgroup` tables, respectively, indicating the user who created the post and the subgroup in which the post was made.

- `Comment` table stores comments made on posts. Each comment has a unique `id` that auto-increments and serves as the primary key. The `content` field stores the content of the comment, and the `image` field can store a URL to an image associated with the comment. The `createdAt` and `updatedAt` fields store the date and time when the comment was created and last updated, respectively. The `creatorId` and `postId` fields are foreign keys that link to the `id` of the `User` and `Post` tables, respectively, indicating the user who created the comment and the post on which the comment was made. The `replyToId` field can store the `id` of another comment to which this comment is a reply.

- `Response` table stores responses to comments. Each response has a unique `id` that auto-increments and serves as the primary key. The `content` field stores the content of the response, and the `image` field can store a URL to an image associated with the response. The `createdAt` and `updatedAt` fields store the date and time when the response was created and last updated, respectively. The `creatorId` and `commentId` fields are foreign keys that link to the `id` of the `User` and `Comment` tables, respectively, indicating the user who created the response and the comment to which the response was made.

- The `Vote` table is designed to store votes on posts and comments. Each vote has a unique `id` that auto-increments and serves as the primary key. The `type` field stores the type of vote, which can be either 'UPVOTE' or 'DOWNVOTE'. The `userId`, `postId`, and `commentId` fields are foreign keys that link to the `id` of the `User`, `Post`, and `Comment` tables, respectively, indicating the user who made the vote and the post or comment on which the vote was made. Each combination of `userId`, `postId`, and `commentId` must be unique.

- Specifically for votes on comments, the `CommentVote` table stores the vote type and foreign keys linking to the user and comment `id`s, similar to the `Vote` table.

## Specific Roles
- Site Administrator: Acts as the general moderator, author, and editor. Post-authentication, they access an admin panel for managing posts, users, and topics with capabilities to create, update, and delete entries. Additional functionalities include reviewing, approving, or rejecting posts.
- Registered User: Can draft new posts, comment on existing ones, and interact with other users' content. They have a personal module for managing their posts.
- Visitor: Access is limited to viewing posts. They see the most recent post in full and the titles of the next five posts chronologically.

## Getting Started

Instructions for setting up the project locally include:

1. Cloning the repository.
1. Setting up a local server environment (e.g., XAMPP for PHP and MySQL).
1. Configuring the database using the provided schema.
1. Running the application through a local server.
1. Contribution Guidelines

Contributors are encouraged to participate in the project by following the guidelines for submitting pull requests, reporting bugs, and suggesting enhancements. Contributions should aim to improve discussions around the selected SDGs and enhance the platform's functionality and user experience .

## License

The project is licensed under [NO LICENSE], offering open-source accessibility while ensuring credit and legal protection for contributors and maintainers.

## Contact and Team Members :busts_in_silhouette:

The development and maintenance of the Open Social Communication Platform are the results of collaborative efforts by a dedicated team of developers and contributors. For inquiries, support, or contributions, please feel free to reach out to any of our team members via their GitHub profiles.

- Ambriz Chávez José Alberto - GitHub: AmbrizAlberto
- Aguilar Ávalos José David - GitHub: JDAA4
- Casillas Sánchez Ramón Dalai - GitHub: rcasillas2
- García Gámez Marco Antonio - GitHub: mggmz
- García Rea Ulises Gerardo - GitHub: Uli19
- San Millan Ramos Alan Adolfo - GitHub: Alan-San-Millan

Our team is committed to fostering an open and collaborative environment. We welcome feedback, suggestions, and contributions to improve the platform and better serve our community's needs. For more detailed discussions, feature requests, or to report issues, please use the Issues and Discussions sections on our GitHub repository.
