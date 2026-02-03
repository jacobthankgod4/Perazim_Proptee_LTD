-- Migration: create `investment` table
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
