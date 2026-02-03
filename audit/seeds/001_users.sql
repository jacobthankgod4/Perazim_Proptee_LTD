-- Seed: minimal admin user (change password hash before use)
INSERT INTO `users` (`User_Type`,`Email`,`Name`,`Password`,`status`) VALUES
('admin','admin@example.test','Administrator','$2y$12$examplebcrypthashreplaceit', 'active');
