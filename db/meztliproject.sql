CREATE SCHEMA IF NOT EXISTS `meztliproject` DEFAULT CHARACTER SET latin1 ;
USE `meztliproject` ;

-- -----------------------------------------------------
-- Table `meztliproject`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL DEFAULT NULL,
  `lastname` VARCHAR(45) NULL DEFAULT NULL,
  `mothersname` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` TEXT NULL DEFAULT NULL,
  `date_register` DATETIME NOT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`market`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`market` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maket_name` VARCHAR(50) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `date_register` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  `owner` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `owner` (`owner` ASC),
  CONSTRAINT `market_ibfk_1`
    FOREIGN KEY (`owner`)
    REFERENCES `meztliproject`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`branch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`branch` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_name` VARCHAR(70) NULL DEFAULT NULL,
  `addreess` TEXT NULL DEFAULT NULL,
  `num_out` VARCHAR(10) NULL DEFAULT NULL,
  `num_ins` VARCHAR(10) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `market_owner` BIGINT(20) UNSIGNED NOT NULL,
  `date_insert` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `market_owner` (`market_owner` ASC),
  CONSTRAINT `branch_ibfk_1`
    FOREIGN KEY (`market_owner`)
    REFERENCES `meztliproject`.`market` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`providers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`providers` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_name` VARCHAR(60) NULL DEFAULT NULL,
  `provider_rfc` VARCHAR(45) NULL DEFAULT NULL,
  `date_insert` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`payment_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`payment_types` (
  `id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `payment_name` VARCHAR(45) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`sellers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`sellers` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL DEFAULT NULL,
  `lastname` VARCHAR(45) NULL DEFAULT NULL,
  `mothersname` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` TEXT NOT NULL,
  `date_register` DATETIME NOT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  `owner` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `owner` (`owner` ASC),
  CONSTRAINT `sellers_ibfk_1`
    FOREIGN KEY (`owner`)
    REFERENCES `meztliproject`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`buy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`buy` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_buy` FLOAT NULL DEFAULT '0',
  `payment_type` TINYINT(4) NULL DEFAULT NULL,
  `date_buy` DATETIME NULL DEFAULT NULL,
  `update_buy` DATETIME NULL DEFAULT NULL,
  `buyer` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `provider` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `provider` (`provider` ASC),
  INDEX `payment_type` (`payment_type` ASC),
  INDEX `buyer` (`buyer` ASC),
  CONSTRAINT `buy_ibfk_1`
    FOREIGN KEY (`provider`)
    REFERENCES `meztliproject`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `buy_ibfk_2`
    FOREIGN KEY (`payment_type`)
    REFERENCES `meztliproject`.`payment_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `buy_ibfk_3`
    FOREIGN KEY (`buyer`)
    REFERENCES `meztliproject`.`sellers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`clients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`clients` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clientname` VARCHAR(45) NULL DEFAULT NULL,
  `lastname` VARCHAR(45) NULL DEFAULT NULL,
  `mothersname` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` TEXT NULL DEFAULT NULL,
  `rfc` VARCHAR(45) NULL DEFAULT NULL,
  `date_register` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`store` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_store` VARCHAR(70) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `branch` BIGINT(20) UNSIGNED NOT NULL,
  `date_inser` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `branch` (`branch` ASC),
  CONSTRAINT `store_ibfk_1`
    FOREIGN KEY (`branch`)
    REFERENCES `meztliproject`.`branch` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`products` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_code` TEXT NULL DEFAULT NULL,
  `product_name` VARCHAR(45) NULL DEFAULT NULL,
  `cuantity` INT(11) NULL DEFAULT NULL,
  `unit_price` FLOAT NULL DEFAULT '0',
  `sale_price` FLOAT NULL DEFAULT '0',
  `provider` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `date_insert` DATETIME NULL DEFAULT NULL,
  `date_update` DATETIME NULL DEFAULT NULL,
  `store` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `store` (`store` ASC),
  INDEX `provider` (`provider` ASC),
  CONSTRAINT `products_ibfk_1`
    FOREIGN KEY (`store`)
    REFERENCES `meztliproject`.`store` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `products_ibfk_2`
    FOREIGN KEY (`provider`)
    REFERENCES `meztliproject`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`detail_buy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`detail_buy` (
  `buy` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `product` INT(10) UNSIGNED NULL DEFAULT NULL,
  `cuantity` INT(11) NULL DEFAULT NULL,
  `amount` FLOAT NULL DEFAULT '0',
  INDEX `buy` (`buy` ASC),
  INDEX `product` (`product` ASC),
  CONSTRAINT `detail_buy_ibfk_1`
    FOREIGN KEY (`buy`)
    REFERENCES `meztliproject`.`buy` (`id`),
  CONSTRAINT `detail_buy_ibfk_2`
    FOREIGN KEY (`product`)
    REFERENCES `meztliproject`.`products` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`sale` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_sale` FLOAT NULL DEFAULT '0',
  `payment_type` TINYINT(4) NULL DEFAULT NULL,
  `date_sale` DATETIME NULL DEFAULT NULL,
  `update_sale` DATETIME NULL DEFAULT NULL,
  `seller` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `client` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `seller` (`seller` ASC),
  INDEX `payment_type` (`payment_type` ASC),
  INDEX `client` (`client` ASC),
  CONSTRAINT `sale_ibfk_1`
    FOREIGN KEY (`seller`)
    REFERENCES `meztliproject`.`sellers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `sale_ibfk_2`
    FOREIGN KEY (`payment_type`)
    REFERENCES `meztliproject`.`payment_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `sale_ibfk_3`
    FOREIGN KEY (`client`)
    REFERENCES `meztliproject`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `meztliproject`.`detail_sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meztliproject`.`detail_sale` (
  `sale` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `product` INT(10) UNSIGNED NULL DEFAULT NULL,
  `cuantity` FLOAT NULL DEFAULT '0',
  `amount` DATETIME NULL DEFAULT NULL,
  INDEX `sale` (`sale` ASC),
  INDEX `product` (`product` ASC),
  CONSTRAINT `detail_sale_ibfk_1`
    FOREIGN KEY (`sale`)
    REFERENCES `meztliproject`.`sale` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detail_sale_ibfk_2`
    FOREIGN KEY (`product`)
    REFERENCES `meztliproject`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
