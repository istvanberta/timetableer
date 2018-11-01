CREATE TABLE IF NOT EXISTS `teachers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `abbrev` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `abbrev` VARCHAR(45) NOT NULL,
  `name_sk` VARCHAR(45) NULL,
  `name_hu` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `periods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `period` VARCHAR(45) NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `day` ENUM('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday') NOT NULL,
  `period` INT NOT NULL,
  `class` INT NOT NULL,
  `subject` INT NOT NULL,
  `teacher` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_period_idx` (`period` ASC),
  INDEX `fk_class_idx` (`class` ASC),
  INDEX `fk_subject_idx` (`subject` ASC),
  INDEX `fk_teacher_idx` (`teacher` ASC),
  CONSTRAINT `fk_period`
    FOREIGN KEY (`period`)
    REFERENCES `periods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class`
    FOREIGN KEY (`class`)
    REFERENCES `classes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject`
    FOREIGN KEY (`subject`)
    REFERENCES `subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher`
    FOREIGN KEY (`teacher`)
    REFERENCES `teachers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;