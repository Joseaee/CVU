
CREATE SCHEMA IF NOT EXISTS `cvu_bd` DEFAULT CHARACTER SET utf8 ;
USE `cvu_bd` ;

-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblSeccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblSeccion` (
  `idSeccion` VARCHAR(6) NOT NULL,
  `trayecto` INT NOT NULL,
  PRIMARY KEY (`idSeccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblPnf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblPnf` (
  `codigo` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblEstudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblEstudiante` (
  `cedula` VARCHAR(8) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `pnf` VARCHAR(10) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cedula`),
  INDEX `FK_EstudiantePNF_idx` (`pnf` ASC),
  CONSTRAINT `FK_EstudiantePNF`
    FOREIGN KEY (`pnf`)
    REFERENCES `cvu_bd`.`tblPnf` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblEleccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblEleccion` (
  `codigo` VARCHAR(28) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblDetalleEleccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblDetalleEleccion` (
  `codigo` VARCHAR(29) NOT NULL,
  `periodo` DATE NOT NULL,
  `horaApertura` TIME NOT NULL,
  `horaCierre` TIME NOT NULL,
  `idEleccion` VARCHAR(28) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  INDEX `FK_EleccionDetalles_idx` (`idEleccion` ASC),
  CONSTRAINT `FK_EleccionDetalles`
    FOREIGN KEY (`idEleccion`)
    REFERENCES `cvu_bd`.`tblEleccion` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblCandidato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblCandidato` (
  `codigo` VARCHAR(10) NOT NULL,
  `idEstudiante` VARCHAR(8) NOT NULL,
  `seccion` VARCHAR(6) NOT NULL,
  `eleccion` VARCHAR(10) NOT NULL,
  `fecha` DATE NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  INDEX `FK_candidatoSeccion_idx` (`seccion` ASC),
  INDEX `FK_candidatoEstudiante_idx` (`idEstudiante` ASC),
  INDEX `FK_candidatoEleccion_idx` (`eleccion` ASC),
  CONSTRAINT `FK_candidatoSeccion`
    FOREIGN KEY (`seccion`)
    REFERENCES `cvu_bd`.`tblSeccion` (`idSeccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_candidatoEstudiante`
    FOREIGN KEY (`idEstudiante`)
    REFERENCES `cvu_bd`.`tblEstudiante` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_candidatoEleccion`
    FOREIGN KEY (`eleccion`)
    REFERENCES `cvu_bd`.`tblDetalleEleccion` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblCentroVotacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblCentroVotacion` (
  `codigo` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `presidente` VARCHAR(45) NOT NULL,
  `secretario` VARCHAR(45) NOT NULL,
  `lugar` VARCHAR(45) NOT NULL,
  `idEleccion` VARCHAR(29) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  INDEX `FK_CentroEleccion_idx` (`idEleccion` ASC),
  CONSTRAINT `FK_CentroEleccion`
    FOREIGN KEY (`idEleccion`)
    REFERENCES `cvu_bd`.`tblDetalleEleccion` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblMesaTrabajo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblMesaTrabajo` (
  `codigo` VARCHAR(10) NOT NULL,
  `centroVotacion` VARCHAR(10) NOT NULL,
  `miembro` VARCHAR(45) NOT NULL,
  `horaApertura` TIME NOT NULL,
  `horaCierre` TIME NOT NULL,
  `conteo` INT NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`),
  INDEX `FK_CentroMesa_idx` (`centroVotacion` ASC),
  CONSTRAINT `FK_CentroMesa`
    FOREIGN KEY (`centroVotacion`)
    REFERENCES `cvu_bd`.`tblCentroVotacion` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblVotaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblVotaciones` (
  `codigo` VARCHAR(10) NOT NULL,
  `idMesa` VARCHAR(10) NOT NULL,
  `idCandidato` VARCHAR(10) NOT NULL,
  `conteo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `FK_VotacionesMesa_idx` (`idMesa` ASC),
  CONSTRAINT `FK_VotacionesMesa`
    FOREIGN KEY (`idMesa`)
    REFERENCES `cvu_bd`.`tblMesaTrabajo` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblEstudianteMesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblEstudianteMesa` (
  `idEstudiante` VARCHAR(10) NOT NULL,
  `idMesa` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idEstudiante`),
  INDEX `FK_MesaEstudiante_idx` (`idMesa` ASC),
  CONSTRAINT `FK_MesaEstudiante`
    FOREIGN KEY (`idMesa`)
    REFERENCES `cvu_bd`.`tblMesaTrabajo` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblRol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblRol` (
  `codigo` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Tabla `cvu_bd`.`tblUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cvu_bd`.`tblUsuario` (
  `cedula` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(20) NOT NULL,
  `apellido` VARCHAR(20) NOT NULL,
  `rol` VARCHAR(10) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cedula`),
  INDEX `FK_UsuarioRol_idx` (`rol` ASC),
  CONSTRAINT `FK_UsuarioRol`
    FOREIGN KEY (`rol`)
    REFERENCES `cvu_bd`.`tblRol` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

