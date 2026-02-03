-- Migration: create `users` table
CREATE TABLE IF NOT EXISTS `users` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `User_Type` VARCHAR(50) DEFAULT 'user',
  `Email` VARCHAR(255) NOT NULL,
  `Name` VARCHAR(255) DEFAULT NULL,
  `age` INT DEFAULT NULL,
  `gender` VARCHAR(16) DEFAULT NULL,
  `bank` VARCHAR(128) DEFAULT NULL,
  `Account` VARCHAR(128) DEFAULT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `account_activation_hash` VARCHAR(255) DEFAULT NULL,
  `reset_token_hash` VARCHAR(255) DEFAULT NULL,
  `reset_token_expires_at` DATETIME DEFAULT NULL,
  `status` VARCHAR(32) DEFAULT 'active',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email_idx` (`Email`)
);
