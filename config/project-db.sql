CREATE TABLE `project_db`.`participants` (
                                             `entity_id` INT NOT NULL AUTO_INCREMENT,
                                             `firstname` VARCHAR(255) NOT NULL,
                                             `lastname` VARCHAR(255) NOT NULL,
                                             `email` VARCHAR(125) NOT NULL,
                                             `position` VARCHAR(20) NOT NULL,
                                             `shares_amount` INT NOT NULL,
                                             `start_date` INT NOT NULL,
                                             `parent_id` INT NOT NULL,
                                             PRIMARY KEY (`entity_id`)
) ENGINE = InnoDB;

INSERT INTO `project_db`.`participants`(`entity_id`, `firstname`, `lastname`, `email`, `position`, `shares_amount`, `start_date`, `parent_id`)
VALUES (1,'Mike','Patterson','mike_pat@example.org','president', 10000, 1273449600, 0);