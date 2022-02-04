/* DROP */
DROP TABLE IF EXISTS multimediaPincho;
DROP TABLE IF EXISTS multimediaBar;
DROP TABLE IF EXISTS multimediaReview;
DROP TABLE IF EXISTS review_user_likes;
DROP TABLE IF EXISTS review_user;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS pincho_allergen;
DROP TABLE IF EXISTS allergen;
DROP TABLE IF EXISTS pincho;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS bar;

/* CREATE */
CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `admin` boolean,
  `created_date` date,
  `img_path` varchar(255)
);

CREATE TABLE `bar` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `address` varchar(255),
  `lon` decimal,
  `lat` decimal,
  `terrace` boolean
);

CREATE TABLE `multimediaBar` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `bar_id` int,
  `path` varchar(255),
  `priority` int
);

CREATE TABLE `review` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `title` varchar(255),
  `desc` varchar(255),
  `presentation` tinyint,
  `texture` tinyint,
  `taste` tinyint,
  `pincho_id` int
);

CREATE TABLE `multimediaReview` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `review_id` int,
  `path` varchar(255),
  `priority` int
);

CREATE TABLE `review_user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `review_id` int
);

CREATE TABLE `review_user_likes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `isLike` boolean
);

CREATE TABLE `pincho` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `bar_id` int,
  `name` varchar(255)
);

CREATE TABLE `allergen` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `img_path` varchar(255)
);

CREATE TABLE `pincho_allergen` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pincho_id` int,
  `allergen_id` int
);

CREATE TABLE `multimediaPincho` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pincho_id` int,
  `path` varchar(255),
  `priority` int
);

ALTER TABLE `multimediaBar` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`) ON DELETE CASCADE;

ALTER TABLE `review` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `review` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);

ALTER TABLE `multimediaReview` ADD FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

ALTER TABLE `review_user` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `review_user` ADD FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

ALTER TABLE `review_user_likes` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`allergen_id`) REFERENCES `allergen` (`id`);

ALTER TABLE `multimediaPincho` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);