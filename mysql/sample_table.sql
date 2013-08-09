/*
 * Change the schema name to the desirable
 */
CREATE  TABLE IF NOT EXISTS `mydb`.`subscriber` (
  `subscriberID` INT NOT NULL AUTO_INCREMENT ,
  `Email` VARCHAR(255) NOT NULL ,
  `Name` VARCHAR(100) NULL ,
  `Surname` VARCHAR(100) NULL ,
  `Ip` VARCHAR(16) NOT NULL ,
  `Agent` TEXT NOT NULL ,
  `DateCreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`subscriberID`) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC) )
ENGINE = MyISAM;