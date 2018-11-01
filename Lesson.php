<?php

class Lesson
{
    private $class;
    private $day;
    private $period;
    private $subject;
    private $teacher;

    public function __construct()
    {
        // TODOCREATE TABLE IF NOT EXISTS `mydb`.`teachers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
    }
}