ALTER TABLE `acs`.`tbl_applications_verifiers` 
CHANGE COLUMN `mobile_user_status` `mobile_user_status` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : New, 1 : In progress, 2 : Completed, 3 : Revoked' ;


ALTER TABLE `acs`.`tbl_applications_verifiers_revoked` 
DROP COLUMN `is_deleted`,
DROP COLUMN `updated_on`,
DROP COLUMN `updated_by`,
DROP COLUMN `created_by`,
CHANGE COLUMN `assigned_for_the_day` `old_created_on` DATETIME NULL COMMENT '0 : Not asssigned for the day, 1 : Assigned for the day' ;
