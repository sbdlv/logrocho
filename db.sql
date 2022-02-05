/* DROP */
DROP TABLE IF EXISTS multimediaPincho;
DROP TABLE IF EXISTS multimediaBar;
DROP TABLE IF EXISTS multimediaReview;
DROP TABLE IF EXISTS review_user_likes;
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

CREATE TABLE `review_user_likes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `review_id` int,
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

ALTER TABLE `review_user_likes` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`allergen_id`) REFERENCES `allergen` (`id`);

ALTER TABLE `multimediaPincho` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`);


/* -------------------- */
/* - DATOS DE EJEMPLO - */
/* -------------------- */

/* BARES */
insert into bar (name, address, lon, lat, terrace) values ('Bar Zooxo', '98290 Schiller Drive', 68.26, 65.61, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Meevee', '55 Maple Wood Point', 14.21, 7.81, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Aibox', '67 Carey Crossing', 10.14, 62.14, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Eayo', '16 Glendale Crossing', 95.45, 16.28, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Abata', '19258 Lindbergh Court', 69.1, 20.15, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Trudeo', '482 Summerview Parkway', 75.66, 50.37, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Realblab', '1 Northview Court', 45.5, 6.66, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Zooveo', '95442 Old Shore Park', 60.95, 78.33, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Rhynoodle', '257 Gerald Pass', 10.61, 5.59, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Voolith', '10 Mcguire Junction', 76.35, 84.57, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Brightbean', '21993 Spohn Lane', 5.95, 80.92, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Eabox', '0 Melvin Parkway', 53.12, 23.01, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Abatz', '41723 Cody Park', 59.17, 36.57, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Podcat', '74 Troy Terrace', 35.49, 35.06, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Kazio', '49 Tennessee Junction', 33.09, 33.84, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Twitterbeat', '37 Bellgrove Terrace', 50.22, 43.72, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Abata', '32308 Leroy Alley', 28.8, 59.76, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Zoomdog', '0664 Westend Alley', 75.66, 13.53, false);
insert into bar (name, address, lon, lat, terrace) values ('Bar Fliptune', '84 Ridgeway Hill', 68.24, 4.56, true);
insert into bar (name, address, lon, lat, terrace) values ('Bar Twinte', '43 Lillian Drive', 99.3, 86.24, false);

/* USUARIOS */
insert into user (first_name, last_name, email, password, admin, created_date) values ('Admin', 'Logrocho', 'admin@logrocho.local', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Brnaba', 'Anfonsi', 'banfonsi0@mediafire.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Phylis', 'Nelthorp', 'pnelthorp1@amazon.de', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Kalina', 'Windsor', 'kwindsor2@exblog.jp', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Frankie', 'Brane', 'fbrane3@technorati.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Farlay', 'Poone', 'fpoone4@miitbeian.gov.cn', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Bertram', 'Waller', 'bwaller5@hibu.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Lethia', 'Matysik', 'lmatysik6@boston.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Zeb', 'Swannack', 'zswannack7@devhub.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Jakie', 'Speaks', 'jspeaks8@nature.com', SHA1('usuario123ABC'), false, NOW());
insert into user (first_name, last_name, email, password, admin, created_date) values ('Godfry', 'McArtan', 'gmcartan9@squidoo.com', SHA1('usuario123ABC'), false, NOW());

/* PINCHOS */
insert into pincho (bar_id, name) values (4, 'Bread - Rosemary Focaccia');
insert into pincho (bar_id, name) values (4, 'Truffle Shells - Semi - Sweet');
insert into pincho (bar_id, name) values (5, 'Bar Nature Valley');
insert into pincho (bar_id, name) values (1, 'Cherries - Fresh');
insert into pincho (bar_id, name) values (4, 'Wine - Zinfandel California 2002');
insert into pincho (bar_id, name) values (3, 'Arizona - Plum Green Tea');
insert into pincho (bar_id, name) values (1, 'Cabbage - Savoy');
insert into pincho (bar_id, name) values (1, 'Glass Clear 7 Oz Xl');
insert into pincho (bar_id, name) values (1, 'Sauce - Alfredo');
insert into pincho (bar_id, name) values (3, 'Mustard - Pommery');

/* RESEÑAS */
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (1, 'vel nulla eget eros elementum', 'volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim', 2, 1, 8, 4);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (4, 'faucibus accumsan odio curabitur convallis', 'egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero', 3, 9, 6, 4);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (5, 'lobortis sapien sapien', 'suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis', 1, 2, 10, 1);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (3, 'est phasellus sit amet', 'ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi', 3, 5, 4, 2);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (2, 'quis justo maecenas rhoncus aliquam', 'interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur', 2, 9, 9, 3);

/* LIKES */
insert into review_user_likes (user_id, review_id, isLike) values (5, 1, true);
insert into review_user_likes (user_id, review_id, isLike) values (5, 2, true);
insert into review_user_likes (user_id, review_id, isLike) values (5, 3, false);
insert into review_user_likes (user_id, review_id, isLike) values (5, 4, true);
insert into review_user_likes (user_id, review_id, isLike) values (1, 1, false);
insert into review_user_likes (user_id, review_id, isLike) values (1, 3, true);
insert into review_user_likes (user_id, review_id, isLike) values (1, 5, true);
insert into review_user_likes (user_id, review_id, isLike) values (2, 3, false);
insert into review_user_likes (user_id, review_id, isLike) values (4, 1, true);
insert into review_user_likes (user_id, review_id, isLike) values (4, 4, true);

/* ALÉRGENOS */
insert into allergen (name, img_path) values ("Cereales con gluten", "img/alergenos/Gluten.png");
insert into allergen (name, img_path) values ("Huevos", "img/alergenos/Huevos.png");
insert into allergen (name, img_path) values ("Lácteos", "img/alergenos/Lácteos.png");
insert into allergen (name, img_path) values ("Pescado", "img/alergenos/Pescado.png");
insert into allergen (name, img_path) values ("Moluscos", "img/alergenos/Moluscos.png");
insert into allergen (name, img_path) values ("Crustáceos", "img/alergenos/Crustaceos.png");
insert into allergen (name, img_path) values ("Cacahuetes", "img/alergenos/Cacahuetes.png");
insert into allergen (name, img_path) values ("Frutos secos", "img/alergenos/Frutos secos.png");
insert into allergen (name, img_path) values ("Soja", "img/alergenos/Soja.png");
insert into allergen (name, img_path) values ("Apio", "img/alergenos/Apio.png");
insert into allergen (name, img_path) values ("Mostaza", "img/alergenos/Mostaza.png");
insert into allergen (name, img_path) values ("Sésamo", "img/alergenos/Sésamo.png");
insert into allergen (name, img_path) values ("Altramuz", "img/alergenos/Altramuz.png");
insert into allergen (name, img_path) values ("Sulfitos", "img/alergenos/Sulfitos.png");