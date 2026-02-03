-- Migration: add foreign key constraints inferred from code
SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `investment` 
  ADD CONSTRAINT `fk_investment_property` FOREIGN KEY (`property_id`) REFERENCES `property`(`Id`) ON DELETE SET NULL;

ALTER TABLE `invest_now`
  ADD CONSTRAINT `fk_invest_now_user` FOREIGN KEY (`Usa_Id`) REFERENCES `users`(`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_invest_now_package` FOREIGN KEY (`package_id`) REFERENCES `investment`(`Id_in`) ON DELETE SET NULL;

SET FOREIGN_KEY_CHECKS=1;
