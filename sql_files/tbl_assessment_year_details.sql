CREATE TABLE `dvsas`.`tbl_assessment_year_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `itr_request_id` INT(11) NULL,
  `assessment_year` VARCHAR(45) NULL,
  `image_url` TEXT NULL,
  `remarks` TEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NULL,
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` INT(11) NULL,
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '0 > active, 1 > deleted',
  PRIMARY KEY (`id`));
