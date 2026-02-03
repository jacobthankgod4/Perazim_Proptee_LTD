-- Reconstructed schema (best-effort inferred from code references)
-- NOTE: This is a best-effort reconstruction. Validate against app behavior.


SET FOREIGN_KEY_CHECKS=0;

-- Consolidated schema aligned with per-table migrations (Id / Id_in naming)
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

CREATE TABLE IF NOT EXISTS `property` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(255) NOT NULL,
  `Type` VARCHAR(64) DEFAULT NULL,
  `Status` VARCHAR(64) DEFAULT 'active',
  `Address` VARCHAR(255) DEFAULT NULL,
  `City` VARCHAR(128) DEFAULT NULL,
  `State` VARCHAR(128) DEFAULT NULL,
  `Zip_Code` VARCHAR(32) DEFAULT NULL,
  `Description` TEXT DEFAULT NULL,
  `Price` DECIMAL(20,2) DEFAULT 0.00,
  `Area` VARCHAR(64) DEFAULT NULL,
  `Ammenities` TEXT DEFAULT NULL,
  `Bedroom` INT DEFAULT NULL,
  `Bathroom` INT DEFAULT NULL,
  `Built_Year` INT DEFAULT NULL,
  `Images` TEXT DEFAULT NULL,
  `Video` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
);

CREATE TABLE IF NOT EXISTS `investment` (
  `Id_in` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest` DECIMAL(8,2) DEFAULT 0.00,
  `share_cost` DECIMAL(20,2) DEFAULT 0.00,
  `expected_inv` DECIMAL(20,2) DEFAULT 0.00,
  `current_inv` DECIMAL(20,2) DEFAULT 0.00,
  `property_id` INT UNSIGNED DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_in`),
  KEY `property_id_idx` (`property_id`)
);

CREATE TABLE IF NOT EXISTS `invest_now` (
  `Id_invest` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Usa_Id` INT UNSIGNED NOT NULL,
  `proptee_id` INT UNSIGNED DEFAULT NULL,
  `package_id` INT UNSIGNED DEFAULT NULL,
  `start_date` DATETIME DEFAULT NULL,
  `period` INT DEFAULT NULL,
  `interest` DECIMAL(8,2) DEFAULT 0.00,
  `share_cost` DECIMAL(20,2) DEFAULT 0.00,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_invest`),
  KEY `Usa_Id_idx` (`Usa_Id`),
  KEY `package_id_idx` (`package_id`)
);

CREATE TABLE IF NOT EXISTS `subscribers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Subscribers` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `sub_email_idx` (`Subscribers`)
);

SET FOREIGN_KEY_CHECKS=1;
-- Reconstructed best-effort schema for the project
-- NOTE: This is inferred from code references. Verify and adjust types/constraints against the running app.
-- Run: mysql -u user -p database_name < reconstructed_schema.sql

CREATE DATABASE IF NOT EXISTS `perazimp_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `perazimp_app`;

-- users table
CREATE TABLE IF NOT EXISTS `users` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `User_Type` VARCHAR(32) NOT NULL DEFAULT 'user',
  `Email` VARCHAR(255) NOT NULL,
  `Name` VARCHAR(255) DEFAULT NULL,
  `age` INT DEFAULT NULL,
  `gender` VARCHAR(16) DEFAULT NULL,
  `bank` VARCHAR(255) DEFAULT NULL,
  `Account` VARCHAR(128) DEFAULT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `account_activation_hash` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `ux_users_email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- property table
CREATE TABLE IF NOT EXISTS `property` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(255) NOT NULL,
  `Type` VARCHAR(64) DEFAULT NULL,
  `Status` VARCHAR(64) DEFAULT NULL,
  `Address` TEXT DEFAULT NULL,
  `City` VARCHAR(128) DEFAULT NULL,
  `State` VARCHAR(128) DEFAULT NULL,
  `Zip_Code` VARCHAR(32) DEFAULT NULL,
  `Description` TEXT DEFAULT NULL,
  `Price` DECIMAL(20,2) DEFAULT 0,
  `Area` DECIMAL(12,2) DEFAULT 0,
  `Ammenities` TEXT DEFAULT NULL,
  `Bedroom` INT DEFAULT NULL,
  `Bathroom` INT DEFAULT NULL,
  `Built_Year` INT DEFAULT NULL,
  `Images` TEXT DEFAULT NULL, -- comma-separated in app
  `Video` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- investment table (different investment packages per property)
CREATE TABLE IF NOT EXISTS `investment` (
  `Id_in` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest` DECIMAL(6,2) NOT NULL,
  `share_cost` DECIMAL(20,2) NOT NULL,
  `expected_inv` DECIMAL(20,2) DEFAULT 0,
  `current_inv` DECIMAL(20,2) DEFAULT 0,
  `property_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_in`),
  KEY `fk_investment_property` (`property_id`),
  CONSTRAINT `fk_investment_property` FOREIGN KEY (`property_id`) REFERENCES `property`(`Id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- invest_now table (user investments)
CREATE TABLE IF NOT EXISTS `invest_now` (
  `Id_invest` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Usa_Id` INT UNSIGNED NOT NULL,
  `period` INT DEFAULT NULL,
  `proptee_id` INT UNSIGNED DEFAULT NULL,
  `package_id` INT UNSIGNED DEFAULT NULL, -- references investment.Id_in
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_invest`),
  KEY `fk_investnow_user` (`Usa_Id`),
  KEY `fk_investnow_investment` (`package_id`),
  CONSTRAINT `fk_investnow_user` FOREIGN KEY (`Usa_Id`) REFERENCES `users`(`Id`) ON DELETE CASCADE,
  CONSTRAINT `fk_investnow_investment` FOREIGN KEY (`package_id`) REFERENCES `investment`(`Id_in`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- subscribers table (simple email list) -- adjust columns if app uses more
CREATE TABLE IF NOT EXISTS `subscribers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `ux_subscribers_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- packages table (if used; inferred)
CREATE TABLE IF NOT EXISTS `packages` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(20,2) DEFAULT 0,
  `description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add any additional inferred tables here after manual inspection and testing.

-- End of reconstructed schema
