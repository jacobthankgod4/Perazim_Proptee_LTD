-- Migration: create `subscribers` table
CREATE TABLE IF NOT EXISTS `subscribers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Subscribers` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `sub_email_idx` (`Subscribers`)
);
