{\rtf1\ansi\ansicpg932\cocoartf1138\cocoasubrtf470
{\fonttbl\f0\fmodern\fcharset0 Courier;}
{\colortbl;\red255\green255\blue255;\red38\green38\blue38;\red246\green246\blue246;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\deftab720
\pard\pardeftab720\sl380

\f0\fs24 \cf2 \cb3 CREATE SCHEMA IF NOT EXISTS `alpaca` DEFAULT CHARACTER SET utf8 ;\
USE `alpaca` ;\
\
-- -----------------------------------------------------\
-- Table `alpaca`.`owner`\
-- -----------------------------------------------------\
CREATE  TABLE IF NOT EXISTS `alpaca`.`owner` (\
  `id` INT NOT NULL AUTO_INCREMENT ,\
  `name` VARCHAR(45) NOT NULL ,\
  `mail_address` VARCHAR(45) NOT NULL ,\
  `tel` VARCHAR(45) NOT NULL ,\
  `note` VARCHAR(45) NULL ,\
  PRIMARY KEY (`id`) )\
ENGINE = InnoDB DEFAULT CHARSET=utf8;\
\
\
-- -----------------------------------------------------\
-- Table `alpaca`.`hall`\
-- -----------------------------------------------------\
CREATE  TABLE IF NOT EXISTS `alpaca`.`hall` (\
  `id` INT NOT NULL AUTO_INCREMENT ,\
  `name` VARCHAR(45) NOT NULL ,\
  `address` VARCHAR(45) NOT NULL ,\
  `latlon` GEOMETRY NULL DEFAULT NULL ,\
  `img_path` VARCHAR(45) NULL DEFAULT NULL ,\
  `number_of_people` VARCHAR(45) NOT NULL ,\
  `area` INT NULL DEFAULT NULL ,\
  `wifi_wave` BIT NULL DEFAULT 0 ,\
  `mobile_wave` BIT NULL DEFAULT 0 ,\
  `travel_time` INT NULL DEFAULT NULL ,\
  `status` TINYINT(1) NULL DEFAULT true ,\
  `note` VARCHAR(256) NULL DEFAULT NULL ,\
  PRIMARY KEY (`id`) ,\
  INDEX `owner_id_idx` (`id` ASC) ,\
  CONSTRAINT `owner_id`\
    FOREIGN KEY (`id` )\
    REFERENCES `alpaca`.`owner` (`id` )\
    ON DELETE CASCADE\
    ON UPDATE CASCADE)\
ENGINE = InnoDB DEFAULT CHARSET=utf8;\
\
-- -----------------------------------------------------\
-- Table `alpaca`.`user`\
-- -----------------------------------------------------\
CREATE  TABLE IF NOT EXISTS `alpaca`.`user` (\
  `id` INT NOT NULL AUTO_INCREMENT ,\
  `name` VARCHAR(45) NOT NULL ,\
  `mail_address` VARCHAR(45) NOT NULL ,\
  `tel` VARCHAR(45) NOT NULL ,\
  `note` VARCHAR(45) NULL ,\
  PRIMARY KEY (`id`) )\
ENGINE = InnoDB DEFAULT CHARSET=utf8;\
\
\
-- -----------------------------------------------------\
-- Table `alpaca`.`plan`\
-- -----------------------------------------------------\
CREATE  TABLE IF NOT EXISTS `alpaca`.`plan` (\
  `id` INT NOT NULL AUTO_INCREMENT ,\
  `date_to` DATETIME NOT NULL ,\
  `date_from` DATETIME NOT NULL ,\
  `stricken_area` TINYINT(1) NOT NULL DEFAULT false ,\
  `bus` TINYINT(1) NOT NULL DEFAULT false ,\
  `town` TINYINT(1) NOT NULL DEFAULT false ,\
  PRIMARY KEY (`id`) ,\
  INDEX `hall_id_idx` (`id` ASC) ,\
  INDEX `user_id_idx` (`id` ASC) ,\
  CONSTRAINT `hall_id`\
    FOREIGN KEY (`id` )\
    REFERENCES `alpaca`.`hall` (`id` )\
    ON DELETE CASCADE\
    ON UPDATE CASCADE,\
  CONSTRAINT `user_id`\
    FOREIGN KEY (`id` )\
    REFERENCES `alpaca`.`user` (`id` )\
    ON DELETE CASCADE\
    ON UPDATE CASCADE)\
ENGINE = InnoDB DEFAULT CHARSET=utf8;\
}