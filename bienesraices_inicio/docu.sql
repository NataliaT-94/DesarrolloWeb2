-- CREATE DATABASE bienesRaices_crud; 

-- CREATE TABLE propiedades( 
--     id INT(11) NOT NULL AUTO_INCREMENT, 
--     titulo VARCHAR(45) NOT NULL, 
--     precio DECIMAL(10,2) NOT NULL, 
--     imagen VARCHAR(200) NOT NULL, 
--     descripcion LONGTEXT NOT NULL, 
--     habitaciones INT(1) NOT NULL, 
--     baño INT(1) NOT NULL, 
--     estacionamiento INT(1) NOT NULL, 
--     creado DATE NOT NULL, 
--     PRIMARY KEY (id) 
-- );

-- CREATE TABLE vendedores( 
--     id INT(11) NOT NULL AUTO_INCREMENT, 
--     nombre VARCHAR(45) NOT NULL, 
--     apellido VARCHAR(45) NOT NULL, 
--     telefono VARCHAR(10) NOT NULL, 
--     PRIMARY KEY (id) 
-- );

--------------------------------------------------------------------------
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bienesraices_crud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bienesraices_crud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bienesraices_crud` DEFAULT CHARACTER SET utf8 ;
USE `bienesraices_crud` ;

-- -----------------------------------------------------
-- Table `bienesraices_crud`.`vendedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienesraices_crud`.`vendedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `vendedorescol` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bienesraices_crud`.`propiedades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienesraices_crud`.`propiedades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `precio` DECIMAL(10,2) NULL,
  `imagen` VARCHAR(200) NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` LONGTEXT NULL,
  `habitaciones` INT(1) NULL,
  `baño` INT(1) NULL,
  `estacionamiento` INT(1) NULL,
  `creado` DATE NULL,
  `vendedores_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_propiedades_vendedores_idx` (`vendedores_id` ASC) VISIBLE,
  CONSTRAINT `fk_propiedades_vendedores`
    FOREIGN KEY (`vendedores_id`)
    REFERENCES `bienesraices_crud`.`vendedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bienesraices_crud`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienesraices_crud`.`table1` (
)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
