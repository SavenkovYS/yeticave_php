CREATE TABLE categories (
    id CHAR(10) PRIMARY KEY,
    name CHAR(15)
);
CREATE UNIQUE INDEX id ON categories(id);

CREATE TABLE lots (
    id SMALLINT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(128),
    description	TEXT,
    price MEDIUMINT,
    step SMALLINT,
    create_ts INT,
    expire_ts BIGINT,
    img	CHAR(128),
    category_id	CHAR(20),
    user_id	SMALLINT,
    winner_id SMALLINT
);
CREATE UNIQUE INDEX id ON lots(id);
CREATE FULLTEXT INDEX lot_search ON lots(name, description);
CREATE INDEX price ON lots(price);
CREATE INDEX step ON lots(step);
CREATE INDEX create_ts ON lots(create_ts);
CREATE INDEX expire_ts ON lots(expire_ts);
CREATE INDEX category_id ON lots(category_id);
CREATE INDEX user_id ON lots(user_id);
CREATE INDEX winner_id ON lots(winner_id);

CREATE TABLE bets (
    id SMALLINT AUTO_INCREMENT PRIMARY KEY,
    create_ts INT,
    value MEDIUMINT,
    lot_id SMALLINT,
    user_id SMALLINT
);
CREATE UNIQUE INDEX id ON bets(id);
CREATE INDEX price ON bets(`value`);
CREATE INDEX lot_id ON bets(lot_id);
CREATE INDEX user_id ON bets(user_id);

CREATE TABLE users (
    id SMALLINT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(64),
    email CHAR(64),
    password CHAR(60),
    message CHAR(255),
    reg_ts INT,
    avatar CHAR(128)
);
CREATE UNIQUE INDEX id ON users(id);
CREATE UNIQUE INDEX email ON users(email);


-- -----------------------------------------------------
-- Schema yeticave
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `yeticave` DEFAULT CHARACTER SET utf8 ;
USE `yeticave` ;

-- -----------------------------------------------------
-- Table `yeticave`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yeticave`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(60) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    `avatar` VARCHAR(128) NULL,
    `message` TEXT NOT NULL,
    `reg_ts` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yeticave`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yeticave`.`categories` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yeticave`.`lots`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yeticave`.`lots` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `step` INT NOT NULL,
    `img` VARCHAR(124) NOT NULL,
    `description` TEXT NOT NULL,
    `create_ts` INT NULL,
    `expire_ts` INT NULL,
    `winner_id` INT NULL,
    `users_id` INT NOT NULL,
    `categories_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_lots_users_idx` (`users_id` ASC) VISIBLE,
    INDEX `fk_lots_categories1_idx` (`categories_id` ASC) VISIBLE,
    CONSTRAINT `fk_lots_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `yeticave`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_lots_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `yeticave`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yeticave`.`bets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yeticave`.`bets` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `value` INT NOT NULL,
    `create_ts` INT NOT NULL,
    `users_id` INT NOT NULL,
    `lots_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_bets_users1_idx` (`users_id` ASC) VISIBLE,
    INDEX `fk_bets_lots1_idx` (`lots_id` ASC) VISIBLE,
    CONSTRAINT `fk_bets_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `yeticave`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_bets_lots1`
    FOREIGN KEY (`lots_id`)
    REFERENCES `yeticave`.`lots` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;
