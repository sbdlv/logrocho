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