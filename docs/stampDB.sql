-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema e2395387
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema e2395387
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `e2395387` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `e2395387` ;

-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_aspect`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_aspect` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aspect` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_privilege` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `privilege` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(254) NOT NULL,
  `privilege_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pw2tp3_user_pw2tp3_privilege_idx` (`privilege_id` ASC),
  CONSTRAINT `fk_user_privilege`
    FOREIGN KEY (`privilege_id`)
    REFERENCES `e2395387`.`pw2tp3_privilege` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_customer` (
  `user_id` INT NOT NULL,
  INDEX `fk_pw2tp3_customer_pw2tp3_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_pw2tp3_customer_pw2tp3_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `e2395387`.`pw2tp3_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_stamp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_stamp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `origin` VARCHAR(45) NULL DEFAULT NULL,
  `year` SMALLINT NULL DEFAULT NULL,
  `image_link` VARCHAR(200) NULL,
  `customer_user_id` INT NOT NULL,
  `aspect_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pw2tp3_stamp_pw2tp3_customer1_idx` (`customer_user_id` ASC),
  INDEX `fk_pw2tp3_stamp_pw2tp3_aspect1_idx` (`aspect_id` ASC),
  CONSTRAINT `fk_pw2tp3_stamp_pw2tp3_customer1`
    FOREIGN KEY (`customer_user_id`)
    REFERENCES `e2395387`.`pw2tp3_customer` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pw2tp3_stamp_pw2tp3_aspect1`
    FOREIGN KEY (`aspect_id`)
    REFERENCES `e2395387`.`pw2tp3_aspect` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_stamp_has_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_stamp_has_category` (
  `stamp_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`stamp_id`, `category_id`),
  INDEX `fk_pw2tp3_stamp_has_pw2tp3_category_pw2tp3_category1_idx` (`category_id` ASC),
  INDEX `fk_pw2tp3_stamp_has_pw2tp3_category_pw2tp3_stamp1_idx` (`stamp_id` ASC),
  CONSTRAINT `fk_pw2tp3_stamp_has_pw2tp3_category_pw2tp3_stamp1`
    FOREIGN KEY (`stamp_id`)
    REFERENCES `e2395387`.`pw2tp3_stamp` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pw2tp3_stamp_has_pw2tp3_category_pw2tp3_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `e2395387`.`pw2tp3_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_staff` (
  `user_id` INT NOT NULL,
  INDEX `fk_pw2tp3_admin_pw2tp3_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_pw2tp3_admin_pw2tp3_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `e2395387`.`pw2tp3_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2395387`.`pw2tp3_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp3_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `date` DATETIME NOT NULL DEFAULT current_timestamp,
  `url_address` VARCHAR(200) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL DEFAULT 'guest',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
