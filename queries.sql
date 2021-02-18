--Добавляем пользователей

INSERT INTO users (email, name, password, message, reg_ts)
VALUES ('ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Не связывайтесь со мной', 1582041782);
INSERT INTO users (email, name, password, message, reg_ts)
VALUES ('kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Никак', 1592496182);
INSERT INTO users (email, name, password, message, reg_ts)
VALUES ('warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'По телефону', 1586707382);

--Добавляем категории

INSERT INTO categories SET name = 'Доски и лыжи';
INSERT INTO categories SET name = 'Крепления';
INSERT INTO categories SET name = 'Ботинки';
INSERT INTO categories SET name = 'Одежда';
INSERT INTO categories SET name = 'Инструменты';
INSERT INTO categories SET name = 'Разное';

--Добавляем лоты

INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (1, 1, 1, '2014 Rossognol District Snowboard', 'Доски и лыжи', 10999, 1000, 'img/lot-1.jpg', 'Пока нет описания', 11, 'yes', null, null);
INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (2, 2, 2, 'DC Ply Mens 2016/2017 Snowboard', 'Доски и лыжи', 159999, 2000, 'img/lot-2.jpg', 'Пока нет описания', 22, 'no', null, null);
INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (3, 3, 3, 'Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления', 8000, 3000, 'img/lot-3.jpg', 'Пока нет описания', 33, 'yes', null, null);
INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (4, 1, 4, 'Ботинки для сноуборда DC Mutiny Charocal', 'Ботинки', 10999, 4000, 'img/lot-4.jpg', 'Пока нет описания', 44, 'no', null, null);
INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (5, 2, 5, 'Куртка для сноуборда DC Mutiny Charocal', 'Одежда', 7500, 5000, 'img/lot-5.jpg', 'Пока нет описания', 55, 'yes', null, null);
INSERT INTO lots (id, user_id, bets_id, name, category_id, price, step, img, description, bets_number, is_open, create_ts, expire_ts)
VALUES (6, 3, 6, 'Маска Oakley Canopy', 'Разное', 5400, 6000, 'img/lot-6.jpg', 'Пока нет описания', 66, 'no', null, null);

--Добавляем ставки

INSERT INTO bets SET price = 10999, user_id = 1, lots_id = 1;
INSERT INTO bets SET price = 159999, user_id = 2, lots_id = 2;
INSERT INTO bets SET price = 8000, user_id = 3, lots_id = 3;
INSERT INTO bets SET price = 10999, user_id = 1, lots_id = 4;
INSERT INTO bets SET price = 7500, user_id = 2, lots_id = 5;
INSERT INTO bets SET price = 5400, user_id = 3, lots_id = 6;
