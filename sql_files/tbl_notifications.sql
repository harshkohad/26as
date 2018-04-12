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

ALTER TABLE `dvs`.`tbl_notifications` 
ADD COLUMN `application_id` INT(11) NULL AFTER `is_unread`;

ALTER TABLE `dvs`.`tbl_notifications` 
ADD COLUMN `is_sent` TINYINT(1) NULL DEFAULT 0 AFTER `notification_created_at`;

ALTER TABLE `dvs`.`tbl_notifications` 
ADD COLUMN `type` TINYINT(1) NULL DEFAULT 0 AFTER `is_sent`;

ALTER TABLE `dvs`.`tbl_notifications` 
CHANGE COLUMN `type` `type` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Notification, 1 : Alert' ;

