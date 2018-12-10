CREATE TABLE `dvsas`.`tbl_itr_request` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pan_card_number` VARCHAR(45) NULL,
  `itr_request_status` TINYINT(1) NULL DEFAULT 0 COMMENT '0 - new, 1 - inprogress, 2 = completed',
  `assessment_years` TEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NULL,
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` INT(11) NULL,
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '0 > active, 1 > deleted',
  PRIMARY KEY (`id`));

ALTER TABLE `dvsas`.`tbl_itr_request` 
ADD COLUMN `unique_id` VARCHAR(45) NULL AFTER `assessment_years`;
  