-- MySQL Script generated by MySQL Workbench
-- Wed Jul  1 18:48:49 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bd_jevents
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_jevents
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_jevents` DEFAULT CHARACTER SET utf8 ;
USE `bd_jevents` ;

-- -----------------------------------------------------
-- Table `bd_jevents`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_jevents`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nomeUsuario` VARCHAR(255) NOT NULL,
  `emailUsuario` VARCHAR(255) NOT NULL,
  `loginUsuario` VARCHAR(255) NOT NULL,
  `senhaUsuario` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_jevents`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_jevents`.`Evento` (
  `idEvento` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idUsuario_Responsavel` INT NOT NULL,
  `dataEvento` DATETIME NOT NULL,
  `observacoesEvento` TEXT NOT NULL,
  PRIMARY KEY (`idEvento`),
  INDEX `idUsuarioE_idx` (`idUsuario` ASC),
  INDEX `idUsuarioR_idx` (`idUsuario_Responsavel` ASC),
  CONSTRAINT `idUsuarioE`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `bd_jevents`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idUsuarioR`
    FOREIGN KEY (`idUsuario_Responsavel`)
    REFERENCES `bd_jevents`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;