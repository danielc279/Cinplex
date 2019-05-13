-- MySQL Script generated by MySQL Workbench
-- Sun May 12 17:25:46 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_cinema_booking
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_cinema_booking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_cinema_booking` DEFAULT CHARACTER SET utf8 ;
USE `db_cinema_booking` ;

-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_roles` (
  `id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_users` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(500) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `salt` VARCHAR(32) NOT NULL,
  `role_id` SMALLINT(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_users_tbl_roles1_idx` (`role_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_tbl_users_tbl_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `db_cinema_booking`.`tbl_roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_permissions` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `access` SMALLINT(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_user_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_user_details` (
  `user_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  `name` VARCHAR(500) NOT NULL,
  `surname` VARCHAR(500) NOT NULL,
  INDEX `fk_tbl_user_details_tbl_users1_idx` (`user_id` ASC),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  CONSTRAINT `fk_tbl_user_details_tbl_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_cinema_booking`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_login_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_login_sessions` (
  `user_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  `expiration` INT(11) NOT NULL,
  `sess_identifier` VARCHAR(100) NOT NULL,
  INDEX `fk_tbl_login_sessions_tbl_users1_idx` (`user_id` ASC),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  CONSTRAINT `fk_tbl_login_sessions_tbl_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_cinema_booking`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_login_attempts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_login_attempts` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attempts` TINYINT(1) NOT NULL,
  `ip_address` VARCHAR(50) NOT NULL,
  `lock` INT(11) NULL,
  `user_id` MEDIUMINT(8) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_login_attempts_tbl_users1_idx` (`user_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_tbl_login_attempts_tbl_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_cinema_booking`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_rating`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_rating` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_genre` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_movie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_movie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `release_date` DATETIME NOT NULL,
  `runtime` INT(10) NOT NULL,
  `tbl_rating_id` INT UNSIGNED NOT NULL,
  `tbl_genre_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_movie_tbl_rating1_idx` (`tbl_rating_id` ASC),
  INDEX `fk_tbl_movie_tbl_genre1_idx` (`tbl_genre_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_tbl_movie_tbl_rating1`
    FOREIGN KEY (`tbl_rating_id`)
    REFERENCES `db_cinema_booking`.`tbl_rating` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_movie_tbl_genre1`
    FOREIGN KEY (`tbl_genre_id`)
    REFERENCES `db_cinema_booking`.`tbl_genre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_room` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_no` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_showing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_showing` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tbl_movie_id` INT UNSIGNED NOT NULL,
  `tbl_room_id` INT UNSIGNED NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_showing_tbl_movie1_idx` (`tbl_movie_id` ASC),
  INDEX `fk_tbl_showing_tbl_room1_idx` (`tbl_room_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_tbl_showing_tbl_movie1`
    FOREIGN KEY (`tbl_movie_id`)
    REFERENCES `db_cinema_booking`.`tbl_movie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_showing_tbl_room1`
    FOREIGN KEY (`tbl_room_id`)
    REFERENCES `db_cinema_booking`.`tbl_room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_seat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_seat` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tbl_room_id` INT UNSIGNED NOT NULL,
  `seat_no` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_seat_tbl_room1_idx` (`tbl_room_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_tbl_seat_tbl_room1`
    FOREIGN KEY (`tbl_room_id`)
    REFERENCES `db_cinema_booking`.`tbl_room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cinema_booking`.`tbl_ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cinema_booking`.`tbl_ticket` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tbl_users_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  `tbl_showing_id` INT UNSIGNED NOT NULL,
  `tbl_seat_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_table1_tbl_users1_idx` (`tbl_users_id` ASC),
  INDEX `fk_tbl_ticket_tbl_showing1_idx` (`tbl_showing_id` ASC),
  INDEX `fk_tbl_ticket_tbl_seat1_idx` (`tbl_seat_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_table1_tbl_users1`
    FOREIGN KEY (`tbl_users_id`)
    REFERENCES `db_cinema_booking`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_ticket_tbl_showing1`
    FOREIGN KEY (`tbl_showing_id`)
    REFERENCES `db_cinema_booking`.`tbl_showing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_ticket_tbl_seat1`
    FOREIGN KEY (`tbl_seat_id`)
    REFERENCES `db_cinema_booking`.`tbl_seat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db_cinema_booking`.`tbl_roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_cinema_booking`;
INSERT INTO `db_cinema_booking`.`tbl_roles` (`id`, `name`) VALUES (1, 'Administrator');
INSERT INTO `db_cinema_booking`.`tbl_roles` (`id`, `name`) VALUES (2, 'Editor');
INSERT INTO `db_cinema_booking`.`tbl_roles` (`id`, `name`) VALUES (4, 'Subscriber');
INSERT INTO `db_cinema_booking`.`tbl_roles` (`id`, `name`) VALUES (8, 'Guest');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_cinema_booking`.`tbl_permissions`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_cinema_booking`;
INSERT INTO `db_cinema_booking`.`tbl_permissions` (`id`, `name`, `access`) VALUES (DEFAULT, 'BACKEND_ACCESS', 3);
INSERT INTO `db_cinema_booking`.`tbl_permissions` (`id`, `name`, `access`) VALUES (DEFAULT, 'ADD_USERS', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_cinema_booking`.`tbl_rating`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_cinema_booking`;
INSERT INTO `db_cinema_booking`.`tbl_rating` (`id`, `name`) VALUES (DEFAULT, 'G');
INSERT INTO `db_cinema_booking`.`tbl_rating` (`id`, `name`) VALUES (DEFAULT, 'PG');
INSERT INTO `db_cinema_booking`.`tbl_rating` (`id`, `name`) VALUES (DEFAULT, 'PG-13');
INSERT INTO `db_cinema_booking`.`tbl_rating` (`id`, `name`) VALUES (DEFAULT, 'R');
INSERT INTO `db_cinema_booking`.`tbl_rating` (`id`, `name`) VALUES (DEFAULT, 'NC-17');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_cinema_booking`.`tbl_genre`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_cinema_booking`;
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Action');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Adventure');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Comedy');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Crime Film');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Documentary');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Drama');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Horror');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Musical');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Romance');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Romantic Comedy');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Science Fiction');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Thriller');
INSERT INTO `db_cinema_booking`.`tbl_genre` (`id`, `name`) VALUES (DEFAULT, 'Western');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_cinema_booking`.`tbl_room`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_cinema_booking`;
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 1');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 2');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 3');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 4');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 5');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 6');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 7');
INSERT INTO `db_cinema_booking`.`tbl_room` (`id`, `room_no`) VALUES (DEFAULT, 'Room 8');

COMMIT;

