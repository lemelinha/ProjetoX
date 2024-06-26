-- MySQL Script generated by MySQL Workbench
-- Mon Jun 17 16:30:04 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_projetoX
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_projetoX` ;

-- -----------------------------------------------------
-- Schema db_projetoX
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_projetoX` DEFAULT CHARACTER SET utf8mb4 ;
USE `db_projetoX` ;

-- -----------------------------------------------------
-- Table `db_projetoX`.`tb_alternativa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_projetoX`.`tb_alternativa` ;

CREATE TABLE IF NOT EXISTS `db_projetoX`.`tb_alternativa` (
  `cd_alternativa` INT NOT NULL AUTO_INCREMENT,
  `nm_letra` CHAR(1) NOT NULL,
  `ds_enunciado` TEXT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`cd_alternativa`),
  INDEX `fk_tb_alternativa_tb_pergunta1_idx` (`id_pergunta` ASC) ,
  CONSTRAINT `fk_tb_alternativa_tb_pergunta1`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_projetoX`.`tb_pergunta` (`cd_pergunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_projetoX`.`tb_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_projetoX`.`tb_materia` ;

CREATE TABLE IF NOT EXISTS `db_projetoX`.`tb_materia` (
  `cd_materia` INT NOT NULL AUTO_INCREMENT,
  `nm_materia` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cd_materia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_projetoX`.`tb_pergunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_projetoX`.`tb_pergunta` ;

CREATE TABLE IF NOT EXISTS `db_projetoX`.`tb_pergunta` (
  `cd_pergunta` INT NOT NULL AUTO_INCREMENT,
  `nm_titulo` VARCHAR(80) NOT NULL,
  `ds_enunciado` TEXT NOT NULL,
  `id_materia` INT NOT NULL,
  `id_submateria` INT NOT NULL,
  `id_usuario_criador` INT NOT NULL,
  `ds_dissertativo_gabarito` TEXT NULL,
  `id_alternativa_gabarito` INT NULL,
  `dt_criacao` DATETIME NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`cd_pergunta`),
  INDEX `fk_tb_pergunta_tb_usuario1_idx` (`id_usuario_criador` ASC) ,
  INDEX `fk_tb_pergunta_tb_materia1_idx` (`id_materia` ASC) ,
  INDEX `fk_tb_pergunta_tb_alternativa1_idx` (`id_alternativa_gabarito` ASC) ,
  INDEX `fk_tb_pergunta_tb_submateria1_idx` (`id_submateria` ASC) ,
  CONSTRAINT `fk_tb_pergunta_tb_usuario1`
    FOREIGN KEY (`id_usuario_criador`)
    REFERENCES `db_projetoX`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pergunta_tb_materia1`
    FOREIGN KEY (`id_materia`)
    REFERENCES `db_projetoX`.`tb_materia` (`cd_materia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pergunta_tb_alternativa1`
    FOREIGN KEY (`id_alternativa_gabarito`)
    REFERENCES `db_projetoX`.`tb_alternativa` (`cd_alternativa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pergunta_tb_submateria1`
    FOREIGN KEY (`id_submateria`)
    REFERENCES `db_projetoX`.`tb_submateria` (`cd_submateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_projetoX`.`tb_submateria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_projetoX`.`tb_submateria` ;

CREATE TABLE IF NOT EXISTS `db_projetoX`.`tb_submateria` (
  `cd_submateria` INT NOT NULL AUTO_INCREMENT,
  `nm_submateria` VARCHAR(70) NOT NULL,
  `id_materia` INT NOT NULL,
  PRIMARY KEY (`cd_submateria`),
  INDEX `fk_tb_submateria_tb_materia1_idx` (`id_materia` ASC) ,
  CONSTRAINT `fk_tb_submateria_tb_materia1`
    FOREIGN KEY (`id_materia`)
    REFERENCES `db_projetoX`.`tb_materia` (`cd_materia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_projetoX`.`tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_projetoX`.`tb_usuario` ;

CREATE TABLE IF NOT EXISTS `db_projetoX`.`tb_usuario` (
  `cd_usuario` INT NOT NULL AUTO_INCREMENT,
  `nm_email` VARCHAR(255) NOT NULL,
  `nm_usuario` VARCHAR(50) NOT NULL,
  `cd_senha` VARCHAR(100) NOT NULL,
  `dt_criacao` DATETIME NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`cd_usuario`),
  UNIQUE INDEX `nm_email_UNIQUE` (`nm_email` ASC) ,
  UNIQUE INDEX `nm_usuario_UNIQUE` (`nm_usuario` ASC) )
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
