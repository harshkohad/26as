ALTER TABLE `acs`.`tbl_applications` 
CHANGE COLUMN `builder_profile_type_of_office` `builder_profile_type_of_office` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Shopline, 2 : Commercial, 3 : Independent, 4 : Residential' ,
CHANGE COLUMN `property_apf_property_status` `property_apf_property_status` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Freshland, 2 : Redevelopment' ,
CHANGE COLUMN `indiv_property_property_type` `indiv_property_property_type` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Fresh Property, 2 : Old Sold Out' ,
CHANGE COLUMN `noc_soc_society_type` `noc_soc_society_type` TINYINT(1) NULL DEFAULT '1' COMMENT '1 : Housing, 2 : Mhada, 3 : Chawl Society' ,
ADD COLUMN `busi_activity_seen` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Yes, 1 : No' AFTER `busi_landmark_2`;

ALTER TABLE `tbl_applications` ADD `alternate_mobile_no` INT(30) NOT NULL AFTER `mobile_no`; 

ALTER TABLE `tbl_applicant_profile` ADD `alternate_contact_no` VARCHAR(50) NULL DEFAULT NULL AFTER `mobile_no`; 
ALTER TABLE `tbl_applications` ADD `alternate_contact_no` VARCHAR(50) NULL DEFAULT NULL AFTER `mobile_no`; 

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `resi_ownership_status` `resi_ownership_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other' ,
CHANGE COLUMN `resi_locality` `resi_locality` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Chawl , 2 : Residential, 3 : Bunglow, 4 : Others' ,
CHANGE COLUMN `busi_type_of_business` `busi_type_of_business` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : DIRECTORSHIP, 2 : PROPRIETOR, 3 : PARTNERSHIP' ,
CHANGE COLUMN `busi_ownership_status` `busi_ownership_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other' ,
CHANGE COLUMN `resi_office_ownership_status` `resi_office_ownership_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other' ,
CHANGE COLUMN `resi_office_locality` `resi_office_locality` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Chawl , 2 : Residential, 3 : Bunglow, 4 : Others' ,
CHANGE COLUMN `builder_profile_type_of_office` `builder_profile_type_of_office` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Shopline, 2 : Commercial, 3 : Independent, 4 : Residential' ,
CHANGE COLUMN `property_apf_property_status` `property_apf_property_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Freshland, 2 : Redevelopment' ,
CHANGE COLUMN `indiv_property_property_type` `indiv_property_property_type` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Fresh Property, 2 : Old Sold Out' ,
CHANGE COLUMN `noc_soc_society_type` `noc_soc_society_type` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Housing, 2 : Mhada, 3 : Chawl Society' ;

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `busi_area` `busi_area` INT(11) NULL DEFAULT 0 ;

ALTER TABLE `acs`.`tbl_applications` 
CHANGE COLUMN `noc_status` `noc_status` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer' ;

ALTER TABLE `tbl_applications` ADD `company_name` VARCHAR(100) NULL DEFAULT NULL,ADD `address` VARCHAR(500) NULL DEFAULT NULL; 
ALTER TABLE `tbl_applications` ADD `busi_designation_others` VARCHAR(100) NULL DEFAULT NULL AFTER `busi_designation`; 

ALTER TABLE `tbl_applications` 
ADD COLUMN `date_of_birth` DATE NULL AFTER `last_name`;

ALTER TABLE `tbl_applications` 
ADD COLUMN `case_id` VARCHAR(100) NULL DEFAULT NULL AFTER `alternate_contact_no`,
ADD COLUMN `branch` VARCHAR(100) NULL DEFAULT NULL AFTER `case_id`;

ALTER TABLE `tbl_applications` 
ADD COLUMN `company_name` VARCHAR(100) NULL DEFAULT NULL AFTER `date_of_application`,
ADD COLUMN `address` VARCHAR(500) NULL DEFAULT NULL AFTER `company_name`;

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `company_name` `company_name` VARCHAR(100) NULL DEFAULT NULL AFTER `date_of_application`,
CHANGE COLUMN `address` `address` VARCHAR(500) NULL DEFAULT NULL AFTER `company_name`;


ALTER TABLE `tbl_applications_history` 
ADD COLUMN `previous_id` INT(10) NOT NULL AFTER `id`;

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `resi_total_family_members` `resi_total_family_members` INT(3) NULL DEFAULT 0 ;


ALTER TABLE `tbl_applications` 
CHANGE COLUMN `institute_id` `institute_id` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `loan_type_id` `loan_type_id` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `area_id` `area_id` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_home_area` `resi_home_area` INT(6) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_stay_years` `resi_stay_years` INT(4) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_working_members` `resi_working_members` INT(3) NULL DEFAULT 0 ,
CHANGE COLUMN `busi_staff_declared` `busi_staff_declared` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `busi_staff_seen` `busi_staff_seen` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `busi_years_in_business` `busi_years_in_business` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `busi_locality` `busi_locality` TINYINT(1) NULL DEFAULT 0 COMMENT '1 : Gala, 2 : Shopline, 3 : Compound, 4 : Resi, 5 : Commercial, 6 : Other' ,
CHANGE COLUMN `office_employment_years` `office_employment_years` INT(4) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_office_home_area` `resi_office_home_area` INT(6) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_office_stay_years` `resi_office_stay_years` INT(4) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_office_total_family_members` `resi_office_total_family_members` INT(3) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_office_working_members` `resi_office_working_members` INT(3) NULL DEFAULT 0 ,
CHANGE COLUMN `resi_office_employment_years` `resi_office_employment_years` INT(4) NULL DEFAULT 0 ,
CHANGE COLUMN `builder_profile_exsistence` `builder_profile_exsistence` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `builder_profile_staff` `builder_profile_staff` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `builder_profile_area` `builder_profile_area` INT(6) NULL DEFAULT 0 ,
CHANGE COLUMN `property_apf_no_of_workers` `property_apf_no_of_workers` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `property_apf_total_flats` `property_apf_total_flats` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `property_apf_how_many_sold` `property_apf_how_many_sold` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `property_apf_total_shops` `property_apf_total_shops` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `property_apf_area` `property_apf_area` INT(6) NULL DEFAULT 0 ,
CHANGE COLUMN `indiv_property_area` `indiv_property_area` INT(6) NULL DEFAULT 0 ,
CHANGE COLUMN `created_by` `created_by` INT(11) NULL DEFAULT 0 ,
CHANGE COLUMN `update_by` `update_by` INT(11) NULL DEFAULT 0 ;


ALTER TABLE `tbl_applications` 
ADD COLUMN `resi_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `resi_not_reachable_remarks`,
ADD COLUMN `resi_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `resi_rented_owner_name`;
ALTER TABLE `tbl_applications` 
ADD COLUMN `busi_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `busi_not_reachable_remarks`,
ADD COLUMN `busi_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `busi_rented_owner_name`;
ALTER TABLE `tbl_applications` 
ADD COLUMN `resi_office_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `resi_office_not_reachable_remarks`,
ADD COLUMN `resi_office_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `resi_office_rented_owner_name`;