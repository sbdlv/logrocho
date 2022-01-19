CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) UNIQUE,
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `admin` boolean,
  `created_date` date
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
  `path` varchar(255)
);

CREATE TABLE `review` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `title` varchar(255),
  `desc` varchar(255),
  `presentation` tinyint,
  `texture` tinyint,
  `taste` tinyint,
  `pincho` int
);

CREATE TABLE `multimediaReview` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `review_id` int,
  `path` varchar(255)
);

CREATE TABLE `review_user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `review_id` int
);

CREATE TABLE `pincho` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `bar_id` int,
  `name` varchar(255)
);

CREATE TABLE `allergen` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `pincho_allergen` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pincho_id` int,
  `allergen_id` int
);

CREATE TABLE `multimediaPincho` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pincho_id` int,
  `path` varchar(255)
);

ALTER TABLE `multimediaBar` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`);

ALTER TABLE `review` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `review` ADD FOREIGN KEY (`pincho`) REFERENCES `pincho` (`id`);

ALTER TABLE `multimediaReview` ADD FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

ALTER TABLE `review_user` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `review_user` ADD FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

ALTER TABLE `pincho` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`);

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`allergen_id`) REFERENCES `allergen` (`id`);

ALTER TABLE `multimediaPincho` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);
