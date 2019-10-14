CREATE TABLE `user` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `login` VARCHAR(50) NOT NULL DEFAULT '',
    `password` CHAR(32)
) ENGINE=MyISAM COLLATE utf8_unicode_ci;

CREATE TABLE `task` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(50) NOT NULL DEFAULT '',
    `description` VARCHAR(255) NOT NULL DEFAULT '',
    `date_completed` INT(11),
    `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1 - new, 2 - completed',
    INDEX idx_date_completed (date_completed),
    FULLTEXT idx_title (title),
    FULLTEXT idx_description (description)
) ENGINE=InnoDB COLLATE utf8_unicode_ci;
