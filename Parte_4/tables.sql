CREATE DATABASE Quiz;

CREATE TABLE IF NOT EXISTS `quiz`.`User` (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `quiz`.`Questions` (
  `question_id` INT NOT NULL AUTO_INCREMENT,
  `question_type` VARCHAR(50) NOT NULL,
  `question_details` VARCHAR(50) NULL,
  `question_text` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`question_id`),
  UNIQUE INDEX `question_id_UNIQUE` (`question_id` ASC) VISIBLE);

CREATE TABLE IF NOT EXISTS `quiz`.`Options` (
  `option_id` INT NOT NULL AUTO_INCREMENT,
  -- `question_id_options` VARCHAR(50) NOT NULL,
  `correct_answer` TINYINT NOT NULL,
  `option_type` VARCHAR(50) NOT NULL,
  `option_text` VARCHAR(50) NOT NULL,
  `answer_choice` VARCHAR(50) NOT NULL,
  `Questions_question_id` INT NOT NULL,
  PRIMARY KEY (`option_id`, `Questions_question_id`),
  UNIQUE INDEX `option_id_UNIQUE` (`option_id` ASC) VISIBLE,
  INDEX `fk_Options_Questions_idx` (`Questions_question_id` ASC) VISIBLE,
  CONSTRAINT `fk_Options_Questions`
    FOREIGN KEY (`Questions_question_id`)
    REFERENCES `quiz`.`Questions` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB