ALTER TABLE `tbl_applications` 
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

ALTER TABLE `tbl_applications` 
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
CHANGE COLUMN `updated_by` `updated_by` INT(11) NULL DEFAULT 0 ;


ALTER TABLE `tbl_applications` 
ADD COLUMN `resi_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `resi_not_reachable_remarks`,
ADD COLUMN `resi_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `resi_rented_owner_name`;
ALTER TABLE `tbl_applications` 
ADD COLUMN `busi_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `busi_not_reachable_remarks`,
ADD COLUMN `busi_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `busi_rented_owner_name`;
ALTER TABLE `tbl_applications` 
ADD COLUMN `resi_office_rented_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `resi_office_not_reachable_remarks`,
ADD COLUMN `resi_office_rent_amount` VARCHAR(500) NULL DEFAULT NULL AFTER `resi_office_rented_owner_name`;


ALTER TABLE `tbl_applications` ADD `pan_first_name` VARCHAR(50) NULL DEFAULT NULL AFTER `noc_soc_address_long`; 
ALTER TABLE `tbl_applications` ADD `pan_last_name` VARCHAR(50) NULL DEFAULT NULL AFTER `pan_first_name`; 


ALTER TABLE `tbl_applications` ADD `pan_middle_name` VARCHAR(50) NULL DEFAULT NULL AFTER `pan_last_name`; 
ALTER TABLE `tbl_applications` ADD `pan_address` TEXT NULL DEFAULT NULL AFTER `pan_middle_name`; 
ALTER TABLE `tbl_applications` ADD `pan_pan_no` VARCHAR(15) NULL DEFAULT NULL AFTER `pan_address`; 
ALTER TABLE `tbl_applications` ADD `pan_dob` datetime NOT NULL AFTER `pan_pan_no`; 
ALTER TABLE `tbl_applications` ADD `pan_date_of_issue` datetime NOT NULL AFTER `pan_dob`; 
ALTER TABLE `tbl_applications` ADD `pan_is_complete` int(10) NULL AFTER `pan_date_of_issue`; 


ALTER TABLE `tbl_applications` ADD `ac_first_name` VARCHAR(50) NULL DEFAULT NULL AFTER `pan_is_complete`; 
ALTER TABLE `tbl_applications` ADD `ac_last_name` VARCHAR(50) NULL DEFAULT NULL AFTER `ac_first_name`; 
ALTER TABLE `tbl_applications` ADD `ac_middle_name` VARCHAR(50) NULL DEFAULT NULL AFTER `ac_last_name`; 
ALTER TABLE `tbl_applications` ADD `ac_aadhar_no` VARCHAR(50) NULL DEFAULT NULL AFTER `ac_middle_name`; 
ALTER TABLE `tbl_applications` ADD `ac_dob` datetime NOT NULL AFTER `ac_aadhar_no`; 
ALTER TABLE `tbl_applications` ADD `ac_address` TEXT NULL DEFAULT NULL AFTER `ac_dob`; 
ALTER TABLE `tbl_applications` ADD `ac_mobile_no` int(15) NULL AFTER `ac_address`; 
ALTER TABLE `tbl_applications` ADD `ac_is_complete` int(15) NULL AFTER `ac_mobile_no`; 

ALTER TABLE `tbl_applications` ADD `passport_first_name` VARCHAR(50) NULL DEFAULT NULL AFTER `ac_is_complete`; 
ALTER TABLE `tbl_applications` ADD `passport_last_name` VARCHAR(50) NULL DEFAULT NULL AFTER `passport_first_name`; 
ALTER TABLE `tbl_applications` ADD `passport_middle_name` VARCHAR(50) NULL DEFAULT NULL AFTER `passport_last_name`; 
ALTER TABLE `tbl_applications` ADD `passport_passport_no` VARCHAR(50) NULL DEFAULT NULL AFTER `passport_middle_name`; 
ALTER TABLE `tbl_applications` ADD `passport_address` TEXT NULL DEFAULT NULL AFTER `passport_passport_no`; 
ALTER TABLE `tbl_applications` ADD `passport_validity` datetime NOT NULL AFTER `passport_address`; 
ALTER TABLE `tbl_applications` ADD `passport_date_of_issue` datetime NOT NULL AFTER `passport_validity`; 
ALTER TABLE `tbl_applications` ADD `passport_is_complete` int(5) NULL AFTER `passport_date_of_issue`; 

ALTER TABLE `tbl_applications` ADD `electricity_name` varchar(50) NULL DEFAULT NULL AFTER `passport_is_complete`; 
ALTER TABLE `tbl_applications` ADD `electricity_address` varchar(500) NULL DEFAULT NULL AFTER `electricity_name`; 
ALTER TABLE `tbl_applications` ADD `electricity_is_complete` varchar(50) NULL DEFAULT NULL AFTER `electricity_address`; 

ALTER TABLE `tbl_applications` ADD `telephone_is_complete` int(50) NULL AFTER `electricity_is_complete`; 
ALTER TABLE `tbl_applications` ADD `telephone_mobile_no` int(15) NULL AFTER `telephone_is_complete`; 
ALTER TABLE `tbl_applications` ADD `telephone_amount` int(15) NULL AFTER `telephone_mobile_no`; 
ALTER TABLE `tbl_applications` ADD `telephone_name` varchar(100) NULL DEFAULT NULL AFTER `telephone_amount`; 
ALTER TABLE `tbl_applications` ADD `telephone_address` varchar(500) NULL DEFAULT NULL AFTER `telephone_name`; 

ALTER TABLE `tbl_applications` ADD `voter_first_name` varchar(50) NULL DEFAULT NULL AFTER `telephone_address`; 
ALTER TABLE `tbl_applications` ADD `voter_last_name` varchar(50) NULL DEFAULT NULL AFTER `voter_first_name`; 
ALTER TABLE `tbl_applications` ADD `voter_middle_name` varchar(50) NULL DEFAULT NULL AFTER `voter_last_name`; 
ALTER TABLE `tbl_applications` ADD `voter_address` TEXT NULL DEFAULT NULL AFTER `voter_middle_name`; 
ALTER TABLE `tbl_applications` ADD `voter_voter_id_no` int(15) NULL AFTER `voter_address`; 
ALTER TABLE `tbl_applications` ADD `voter_is_complete` int(10) NULL AFTER `voter_voter_id_no`; 

ALTER TABLE `tbl_applications` ADD `driving_is_complete` int(10) NULL AFTER `voter_is_complete`; 
ALTER TABLE `tbl_applications` ADD `driving_name` varchar(100) NULL DEFAULT NULL AFTER `driving_is_complete`; 
ALTER TABLE `tbl_applications` ADD `driving_driving_license_number` varchar(20) NULL DEFAULT NULL AFTER `driving_name`; 
ALTER TABLE `tbl_applications` ADD `driving_validity` datetime NULL AFTER `driving_driving_license_number`; 
ALTER TABLE `tbl_applications` ADD `driving_date_of_issue` datetime NULL AFTER `driving_validity`; 

ALTER TABLE `tbl_applications` ADD `company_id_is_complete` int(10) NULL AFTER `driving_date_of_issue`; 
ALTER TABLE `tbl_applications` ADD `company_id_name` varchar(100) NULL DEFAULT NULL AFTER `company_id_is_complete`;  
ALTER TABLE `tbl_applications` ADD `company_id_designation` varchar(100) NULL DEFAULT NULL AFTER `company_id_name`;  

ALTER TABLE `tbl_applications` ADD `shop_act_is_complete` int(10) NULL AFTER `company_id_designation`; 
ALTER TABLE `tbl_applications` ADD `shop_act_name` varchar(50) NULL DEFAULT NULL AFTER `shop_act_is_complete`; 
ALTER TABLE `tbl_applications` ADD `shop_act_shop_act_no` varchar(50) NULL DEFAULT NULL AFTER `shop_act_name`; 
ALTER TABLE `tbl_applications` ADD `shop_act_address` TEXT NULL DEFAULT NULL AFTER `shop_act_shop_act_no`; 
ALTER TABLE `tbl_applications` ADD `shop_act_from_date` datetime NULL AFTER `shop_act_address`; 
ALTER TABLE `tbl_applications` ADD `shop_act_till_date` datetime NULL AFTER `shop_act_from_date`; 

ALTER TABLE `tbl_applications` ADD `gst_name` TEXT NULL DEFAULT NULL AFTER `shop_act_till_date`; 
ALTER TABLE `tbl_applications` ADD `gst_is_complete` int NULL AFTER `gst_name`; 
ALTER TABLE `tbl_applications` ADD `gst_gst_no` int(10) NULL AFTER `gst_is_complete`; 
ALTER TABLE `tbl_applications` ADD `gst_address` TEXT NULL DEFAULT NULL AFTER `gst_gst_no`; 

ALTER TABLE `tbl_applications` ADD `rent_aggeement_met_name` VARCHAR(100) NULL DEFAULT NULL AFTER `gst_address`; 
ALTER TABLE `tbl_applications` ADD `rent_aggeement_owner_name` VARCHAR(100) NULL DEFAULT NULL AFTER `rent_aggeement_met_name`; 
ALTER TABLE `tbl_applications` ADD `rent_aggeement_rent_amount` INT(10) NULL AFTER `rent_aggeement_owner_name`; 
ALTER TABLE `tbl_applications` ADD `rent_aggeement_deposit_amount` INT(10) NULL AFTER `rent_aggeement_rent_amount`; 
ALTER TABLE `tbl_applications` ADD `rent_aggeement_is_complete` INT(10) NULL AFTER `rent_aggeement_deposit_amount`; 
ALTER TABLE `tbl_applications` ADD `rent_aggeement_validity` DATETIME NULL AFTER `rent_aggeement_is_complete`; 

ALTER TABLE `tbl_applications` ADD `seller_is_complete` INT(10) NULL AFTER `rent_aggeement_validity`; 
ALTER TABLE `tbl_applications` ADD `seller_name` VARCHAR(100) NULL DEFAULT NULL AFTER `seller_is_complete`; 
ALTER TABLE `tbl_applications` ADD `seller_purchaser_name` VARCHAR(100) NULL DEFAULT NULL AFTER `seller_name`; 
ALTER TABLE `tbl_applications` ADD `seller_address` TEXT NULL DEFAULT NULL AFTER `seller_purchaser_name`; 

ALTER TABLE `tbl_applications` ADD `oc_cc_plan_cts_no` INT(10) NULL AFTER `seller_address`; 
ALTER TABLE `tbl_applications` ADD `oc_cc_plan_is_complete` INT(10) NULL AFTER `oc_cc_plan_cts_no`; 
ALTER TABLE `tbl_applications` ADD `oc_cc_plan_issuing_authority` VARCHAR(100) NULL DEFAULT NULL AFTER `oc_cc_plan_is_complete`; 
ALTER TABLE `tbl_applications` ADD `oc_cc_plan_signature` VARCHAR(100) NULL DEFAULT NULL AFTER `oc_cc_plan_issuing_authority`; 

ALTER TABLE `tbl_applications` ADD `ocr_receipt_builder_name` VARCHAR(100) NULL DEFAULT NULL AFTER `oc_cc_plan_signature`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_met_person` VARCHAR(100) NULL DEFAULT NULL AFTER `ocr_receipt_builder_name`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_designation` VARCHAR(100) NULL DEFAULT NULL AFTER `ocr_receipt_met_person`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_signature` VARCHAR(100) NULL DEFAULT NULL AFTER `ocr_receipt_designation`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_tpc` VARCHAR(100) NULL DEFAULT NULL AFTER `ocr_receipt_signature`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_landmark` VARCHAR(200) NULL DEFAULT NULL AFTER `ocr_receipt_tpc`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_amount` INT(10) NULL AFTER `ocr_receipt_landmark`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_receipt_no` INT(10) NULL AFTER `ocr_receipt_amount`; 
ALTER TABLE `tbl_applications` ADD `ocr_receipt_is_complete` INT(10) NULL AFTER `ocr_receipt_receipt_no`; 

ALTER TABLE `tbl_applications` ADD `noc_soc_chairman_name` VARCHAR(200) NULL DEFAULT NULL AFTER `noc_not_reachable_remarks`; 
ALTER TABLE `tbl_applications` ADD `noc_soc_secretary_name` VARCHAR(200) NULL DEFAULT NULL AFTER `noc_soc_chairman_name`; 
ALTER TABLE `tbl_applications` ADD `noc_soc_tresurer_name` VARCHAR(200) NULL DEFAULT NULL AFTER `noc_soc_secretary_name`;

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `telephone_address` `telephone_address` TEXT NULL DEFAULT NULL ;

ALTER TABLE `tbl_applications` ADD `resi_available_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted' AFTER `resi_rent_amount`; 
ALTER TABLE `tbl_applications` ADD `resi_shifted_tenure` INT(4) NULL DEFAULT 0 AFTER `resi_available_status`;
ALTER TABLE `tbl_applications` ADD `busi_available_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted' AFTER `busi_rent_amount`;
ALTER TABLE `tbl_applications` ADD `busi_shifted_tenure` INT(4) NULL DEFAULT 0 AFTER `busi_available_status`;
ALTER TABLE `tbl_applications` ADD `busi_reason_for_closed` varchar(100) NULL DEFAULT NULL AFTER `busi_shifted_tenure`;
ALTER TABLE `tbl_applications` ADD `office_available_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted' AFTER `office_not_reachable_remarks`;
ALTER TABLE `tbl_applications` ADD `office_shifted_tenure` INT(4) NULL DEFAULT 0 AFTER `office_available_status`;
ALTER TABLE `tbl_applications` ADD `office_reason_for_closed` varchar(100) NULL DEFAULT NULL AFTER `busi_shifted_tenure`;
ALTER TABLE `tbl_applications` ADD `resi_office_available_status` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted' AFTER `resi_office_rent_amount`;
ALTER TABLE `tbl_applications` ADD `resi_office_shifted_tenure` INT(4) NULL DEFAULT 0 AFTER `resi_office_available_status`;
ALTER TABLE `tbl_applications` ADD `resi_office_reason_for_closed` varchar(100) NULL DEFAULT NULL AFTER `busi_shifted_tenure`;
ALTER TABLE `tbl_applications` ADD `resi_locality_type` TINYINT(1) NULL DEFAULT '0' AFTER `resi_locality_text`;
ALTER TABLE `tbl_applications` ADD `busi_locality_type` TINYINT(1) NULL DEFAULT '0' AFTER `busi_locality_text`;
ALTER TABLE `tbl_applications` ADD `resi_office_locality_type` TINYINT(1) NULL DEFAULT '0' AFTER `resi_office_locality_text`;

ALTER TABLE `tbl_applications` 
DROP COLUMN `company_is_complete`;

ALTER TABLE `tbl_applications` 
CHANGE COLUMN `telephone_is_complete` `telephone_is_complete` INT(50) NULL DEFAULT NULL AFTER `telephone_address`;
CHANGE COLUMN `driving_is_complete` `driving_is_complete` INT(10) NULL DEFAULT NULL AFTER `driving_date_of_issue`,
CHANGE COLUMN `company_id_is_complete` `company_id_is_complete` INT(10) NULL DEFAULT NULL AFTER `company_id_designation`,
CHANGE COLUMN `shop_act_is_complete` `shop_act_is_complete` INT(10) NULL DEFAULT NULL AFTER `shop_act_till_date`,
CHANGE COLUMN `gst_is_complete` `gst_is_complete` INT(11) NULL DEFAULT NULL AFTER `gst_address`,
CHANGE COLUMN `rent_aggeement_validity` `rent_aggeement_validity` DATETIME NULL DEFAULT NULL AFTER `rent_aggeement_deposit_amount`,
CHANGE COLUMN `seller_is_complete` `seller_is_complete` INT(10) NULL DEFAULT NULL AFTER `seller_address`,
CHANGE COLUMN `oc_cc_plan_is_complete` `oc_cc_plan_is_complete` INT(10) NULL DEFAULT NULL AFTER `oc_cc_plan_signature`;

ALTER TABLE `tbl_applications` ADD `pan_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `pan_is_complete`;
ALTER TABLE `tbl_applications` ADD `ac_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `ac_is_complete`;
ALTER TABLE `tbl_applications` ADD `passport_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `passport_is_complete`;
ALTER TABLE `tbl_applications` ADD `electricity_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `electricity_is_complete`;
ALTER TABLE `tbl_applications` ADD `telephone_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `telephone_is_complete`;
ALTER TABLE `tbl_applications` ADD `voter_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `voter_is_complete`;
ALTER TABLE `tbl_applications` ADD `driving_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `driving_is_complete`;
ALTER TABLE `tbl_applications` ADD `company_id_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `company_id_is_complete`;
ALTER TABLE `tbl_applications` ADD `shop_act_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `shop_act_is_complete`;
ALTER TABLE `tbl_applications` ADD `gst_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `gst_is_complete`;
ALTER TABLE `tbl_applications` ADD `rent_agreement_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `rent_aggeement_is_complete`;
ALTER TABLE `tbl_applications` ADD `seller_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `seller_is_complete`;
ALTER TABLE `tbl_applications` ADD `oc_cc_plan_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `oc_cc_plan_is_complete`;
ALTER TABLE `tbl_applications` ADD `ocr_receipt_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Positive, 1 : Negative' AFTER `ocr_receipt_is_complete`;


ALTER TABLE `tbl_applications` 
CHANGE COLUMN `rent_aggeement_met_name` `rent_agreement_met_name` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_owner_name` `rent_agreement_owner_name` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_rent_amount` `rent_agreement_rent_amount` INT(10) NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_deposit_amount` `rent_agreement_deposit_amount` INT(10) NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_validity` `rent_agreement_validity` DATETIME NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_is_complete` `rent_agreement_is_complete` INT(10) NULL DEFAULT NULL ,
CHANGE COLUMN `rent_aggeement_feedback` `rent_agreement_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Positive, 2 : Negative' ,
CHANGE COLUMN `seller_name` `sale_agreement_seller_name` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `seller_purchaser_name` `sale_agreement_purchaser_name` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `seller_address` `sale_agreement_address` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `seller_is_complete` `sale_agreement_is_complete` INT(10) NULL DEFAULT NULL ,
CHANGE COLUMN `seller_aggeement_feedback` `sale_agreement_feedback` TINYINT(1) NULL DEFAULT '0' COMMENT '1 : Positive, 2 : Negative' ;

ALTER TABLE `tbl_applications` CHANGE COLUMN `pan_is_complete` `pan_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `ac_is_complete` `ac_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `passport_is_complete` `passport_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `electricity_is_complete` `electricity_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `telephone_is_complete` `telephone_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `voter_is_complete` `voter_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `driving_is_complete` `driving_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `company_id_is_complete` `company_id_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `shop_act_is_complete` `shop_act_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `gst_is_complete` `gst_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `rent_agreement_is_complete` `rent_agreement_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `sale_agreement_is_complete` `sale_agreement_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `oc_cc_plan_is_complete` `oc_cc_plan_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
ALTER TABLE `tbl_applications` CHANGE COLUMN `ocr_receipt_is_complete` `ocr_receipt_is_complete` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Not verified, 1 : Verified' ;
