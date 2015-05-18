-- LinuxPerformanceAnalysis

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


CREATE SCHEMA IF NOT EXISTS `LinuxPerformanceAnalysis` DEFAULT CHARACTER SET utf8 ;
USE `LinuxPerformanceAnalysis` ;

-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`kernel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`kernel` (
  `id_kernel` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `tag_version` VARCHAR(45) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_kernel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`user` (
  `id_user` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'number of user, used like id',
  `user` VARCHAR(16) NOT NULL COMMENT 'username, that is used for login',
  `password` VARCHAR(64) NOT NULL COMMENT 'user password for login, use md5 encode.',
  `first_name` VARCHAR(45) NOT NULL COMMENT 'first name of the user',
  `last_name` VARCHAR(45) NOT NULL COMMENT 'last name of the user',
  `email` VARCHAR(45) NOT NULL COMMENT 'contact email for the user',
  `host_directory` VARCHAR(256) NOT NULL COMMENT 'Each user must have a directory',
  `active` INT(1) NOT NULL COMMENT '1 or 0 , if the user is active or not',
  `level` CHAR(1) NOT NULL COMMENT 'level of the user, 1 for admin 2 for others',
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`patch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`patch` (
  `id_patch` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id of the patch',
  `name` VARCHAR(45) NOT NULL COMMENT 'The name of the patch',
  `upload_date` VARCHAR(45) NOT NULL COMMENT 'The date that the patch was uploaded',
  `status` VARCHAR(15) NOT NULL COMMENT 'Rejected|Tested|Standby',
  `id_user` INT(11) NOT NULL COMMENT 'Owner of the patch',
  PRIMARY KEY (`id_patch`),
  INDEX `id_user` (`id_user` ASC),
  CONSTRAINT `patch_ibfk_1`
    FOREIGN KEY (`id_user`)
    REFERENCES `LinuxPerformanceAnalysis`.`user` (`id_user`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`tool`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`tool` (
  `id_tool` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `download_repo` VARCHAR(45) NULL DEFAULT NULL,
  `version` VARCHAR(45) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_tool`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`test`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`test` (
  `id_test` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `command` VARCHAR(45) NULL DEFAULT NULL,
  `id_tool` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_test`),
  INDEX `fk_tool_idx` (`id_tool` ASC),
  CONSTRAINT `fk_tool`
    FOREIGN KEY (`id_tool`)
    REFERENCES `LinuxPerformanceAnalysis`.`tool` (`id_tool`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LinuxPerformanceAnalysis`.`job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LinuxPerformanceAnalysis`.`job` (
  `id_job` INT(11) NOT NULL AUTO_INCREMENT,
  `id_patch` INT(11) NOT NULL,
  `id_test` INT(11) NOT NULL,
  `id_kernel` INT(11) NOT NULL,
  `date_submitted` DATE NOT NULL,
  `date_finished` DATE NULL DEFAULT NULL,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_job`),
  INDEX `fk_patch_idx` (`id_patch` ASC),
  INDEX `fk_test_idx` (`id_test` ASC),
  INDEX `fk_kernel_idx` (`id_kernel` ASC),
  CONSTRAINT `fk_kernel`
    FOREIGN KEY (`id_kernel`)
    REFERENCES `LinuxPerformanceAnalysis`.`kernel` (`id_kernel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_patch`
    FOREIGN KEY (`id_patch`)
    REFERENCES `LinuxPerformanceAnalysis`.`patch` (`id_patch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_test`
    FOREIGN KEY (`id_test`)
    REFERENCES `LinuxPerformanceAnalysis`.`test` (`id_test`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
