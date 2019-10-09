CREATE TABLE `user` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `login` VARCHAR(50) NOT NULL DEFAULT '',
    `password` CHAR(32)
) ENGINE=MyISAM COLLATE utf8_unicode_ci;
