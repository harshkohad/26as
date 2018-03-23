CREATE TABLE `tbl_notifications` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NULL,
  `message` TEXT NULL,
  `is_unread` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : unread, 1 : read',
  `notification_created_at` DATETIME NULL,
  `created_by` INT(11) NULL,
  `created_on` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` INT(11) NULL,
  `updated_on` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`));


ALTER TABLE `dvs`.`tbl_notifications` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;
