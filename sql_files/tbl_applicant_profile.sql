ALTER TABLE `tbl_applicant_profile` ADD `company_name` VARCHAR(100) NULL DEFAULT NULL AFTER `is_deleted`; 
ALTER TABLE `acs`.`tbl_applicant_profile` 
ADD COLUMN `company_name` VARCHAR(100) NULL AFTER `bank_statement_type`;

ALTER TABLE `acs`.`tbl_applicant_profile` 
CHANGE COLUMN `created_on` `created_on` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ;
