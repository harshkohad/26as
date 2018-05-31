UPDATE tbl_applicant_photos
SET created_on = CURRENT_TIMESTAMP
WHERE created_on IS NULL;

UPDATE tbl_applicant_photos
SET updated_on = CURRENT_TIMESTAMP
WHERE updated_on IS NULL;

ALTER TABLE `acs`.`tbl_applicant_photos` 
CHANGE COLUMN `created_on` `created_on` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ;


ALTER TABLE `tbl_applicant_photos` CHANGE `updated_on` `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

