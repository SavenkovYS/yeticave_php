CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email CHAR(128),
    password CHAR(64),
    name CHAR(15),
    avatar CHAR(128),
    message TEXT
);
CREATE UNIQUE INDEX id ON users(id);
CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX name ON users(name);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(20)
);
CREATE UNIQUE INDEX id ON categories(id);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id CHAR(30),
    user_id INT,
    bets_id INT,
    name CHAR(100),
    price INT,
    step SMALLINT,
    img CHAR(50),
    description TEXT,
    create_ts CHAR(50),
    expire_ts CHAR(50),
    bets_number INT,
    is_open CHAR(3)
);
CREATE UNIQUE INDEX id ON lots(id);
CREATE INDEX category_id ON lots(category_id);
CREATE INDEX user_id ON lots(user_id);
CREATE INDEX price ON lots(price);
CREATE INDEX create_ts ON lots(create_ts);
CREATE INDEX expire_ts ON lots(expire_ts);
CREATE INDEX is_open ON lots(is_open);

CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    lots_id INT,
    price INT
);
CREATE UNIQUE INDEX id ON bets(id);
