-- Migration: create `invest_now` table
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
