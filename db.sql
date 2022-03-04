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
  `desc` varchar(255),
  `address` varchar(255),
  `lon` decimal(10,5),
  `lat` decimal(10,5),
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

-- CREATE TABLE `multimediaReview` (
--   `id` int PRIMARY KEY AUTO_INCREMENT,
--   `review_id` int,
--   `path` varchar(255),
--   `priority` int
-- );

CREATE TABLE `review_user_likes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `review_id` int,
  `isLike` boolean
);

ALTER TABLE `review_user_likes` ADD UNIQUE `unique_review_user_likes`(`user_id`, `review_id`);

CREATE TABLE `pincho` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `bar_id` int,
  `name` varchar(255),
  `desc` varchar(255),
  `price` decimal(10,2)
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

ALTER TABLE `review` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`) ON DELETE CASCADE;

-- ALTER TABLE `multimediaReview` ADD FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE;

ALTER TABLE `review_user_likes` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho` ADD FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`) ON DELETE CASCADE;

ALTER TABLE `pincho_allergen` ADD FOREIGN KEY (`allergen_id`) REFERENCES `allergen` (`id`) ON DELETE CASCADE;

ALTER TABLE `multimediaPincho` ADD FOREIGN KEY (`pincho_id`) REFERENCES `pincho` (`id`) ON DELETE CASCADE;


/* -------------------- */
/* - DATOS DE EJEMPLO - */
/* -------------------- */

/* BARES */
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Zooxo', 'Test desc', '98290 Schiller Drive', -2.4581448529224916, 42.45497158574761, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Meevee', 'Test desc', '55 Maple Wood Point', -2.42957713457907, 42.458059865912695, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Aibox', 'Test desc', '67 Carey Crossing', -2.4640639329694514, 42.46714202924158, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Eayo', 'Test desc', '16 Glendale Crossing', -2.4576295205180254, 42.458915016263425, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Abata', 'Test desc', '19258 Lindbergh Court', -2.4604556795732915, 42.454150446345366, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Trudeo', 'Test desc', '482 Summerview Parkway', -2.4750897792479147, 42.45781198017441, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Realblab', 'Test desc', '1 Northview Court', -2.4675254414065266, 42.46172472988175, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Zooveo', 'Test desc', '95442 Old Shore Park', -2.447487739744947, 42.46693164127969, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Rhynoodle', 'Test desc', '257 Gerald Pass', -2.463801884117186, 42.46166946652319, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Voolith', 'Test desc', '10 Mcguire Junction', -2.4799491015047836, 42.45443227822947, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Brightbean', 'Test desc', '21993 Spohn Lane', -2.4299045002714745, 42.450117559476084, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Eabox', 'Test desc', '0 Melvin Parkway', -2.458550461131404, 42.457081291704675, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Abatz', 'Test desc', '41723 Cody Park', -2.4564316021076293, 42.45441064262549, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Podcat', 'Test desc', '74 Troy Terrace', -2.4328893672592575, 42.46352427961426, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Kazio', 'Test desc', '49 Tennessee Junction', -2.468488812382514, 42.461068617174675, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Twitterbeat', 'Test desc', '37 Bellgrove Terrace', -2.47176681399925, 42.45376331174264, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Abata', 'Test desc', '32308 Leroy Alley', -2.4533311206907418, 42.458021825982975, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Zoomdog', 'Test desc', '0664 Westend Alley', -2.429335363023288, 42.46042959024284, false);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Fliptune', 'Test desc', '84 Ridgeway Hill', -2.474158962912898, 42.46242858836241, true);
insert into bar (name, `desc`, address, lon, lat, terrace) values ('Bar Twinte', 'Test desc', '43 Lillian Drive', -2.434441876938085, 42.45514057157795, false);

/* USUARIOS */
insert into user (first_name, last_name, email, password, admin, created_date) values ('Admin', 'Logrocho', 'admin@logrocho.local', SHA1('usuario123ABC'), true, NOW());
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
insert into pincho (bar_id, name, `desc`, price) values (4, 'Bread - Rosemary Focaccia', 'ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit', 1);
insert into pincho (bar_id, name, `desc`, price) values (4, 'Truffle Shells - Semi - Sweet', 'eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque', 2);
insert into pincho (bar_id, name, `desc`, price) values (5, 'Milk - Nature Valley', 'id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien', 2);
insert into pincho (bar_id, name, `desc`, price) values (1, 'Cherries - Fresh', 'tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (4, 'Wine - Zinfandel California 2002', 'donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (1, 'Cabbage - Savoy', 'aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (3, 'Arizona - Plum Green Tea', 'nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (1, 'Glass Clear - 7 Oz Xl', 'integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (1, 'Sauce - Alfredo', 'quis lectus suspendisse potenti in eleifend quam a odio in hac', 1.5);
insert into pincho (bar_id, name, `desc`, price) values (3, 'Mustard - Pommery', 'sapien non mi integer ac neque duis bibendum morbi non quam nec dui', 1.5);

/* RESEÑAS */
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (1, 'vel nulla eget eros elementum', 'volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim', 2, 1, 5, 4);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (4, 'faucibus accumsan odio curabitur convallis', 'egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero', 3, 3, 4, 4);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (5, 'lobortis sapien sapien', 'suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis', 1, 2, 5, 1);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (3, 'est phasellus sit amet', 'ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi', 3, 5, 4, 2);
insert into review (user_id, title, `desc`, presentation, texture, taste, pincho_id) values (2, 'quis justo maecenas rhoncus aliquam', 'interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur', 2, 5, 5, 3);

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

/* IMAGENES BAR */
-- insert into multimediaBar (bar_id, `path`) values 
-- (1, "img/pexels-photo-262047.jpeg"),
-- (1, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (2, "img/pexels-photo-262047.jpeg"),
-- (2, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (3, "img/pexels-photo-262047.jpeg"),
-- (4, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (4, "img/pexels-photo-262047.jpeg"),
-- (4, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (5, "img/pexels-photo-262047.jpeg"),
-- (5, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (6, "img/pexels-photo-262047.jpeg"),
-- (6, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (7, "img/pexels-photo-262047.jpeg"),
-- (7, "img/pexels-pixabay-262978.jpg");

-- insert into multimediaBar (bar_id, `path`) values 
-- (8, "img/pexels-photo-262047.jpeg"),
-- (8, "img/pexels-pixabay-262978.jpg");