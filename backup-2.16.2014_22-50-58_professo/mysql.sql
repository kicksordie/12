-- cPanel mysql backup
GRANT USAGE ON *.* TO 'professo'@'localhost' IDENTIFIED BY PASSWORD '*BB68B6E22A4B91FF39F10C4D7127C39845FB9EC1';
GRANT ALL PRIVILEGES ON `professo\_db`.* TO 'professo'@'localhost';
GRANT ALL PRIVILEGES ON `professo\_%`.* TO 'professo'@'localhost';
GRANT USAGE ON *.* TO 'professo_root'@'localhost' IDENTIFIED BY PASSWORD '*A0CE7D96E9A367D701F3CA6ACAEFDB0EBD9FBB7A';
GRANT ALL PRIVILEGES ON `professo\_db`.* TO 'professo_root'@'localhost';
