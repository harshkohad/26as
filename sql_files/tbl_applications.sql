ALTER TABLE `acs`.`tbl_applications` 
CHANGE COLUMN `builder_profile_type_of_office` `builder_profile_type_of_office` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Shopline, 2 : Commercial, 3 : Independent, 4 : Residential' ,
CHANGE COLUMN `property_apf_property_status` `property_apf_property_status` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Freshland, 2 : Redevelopment' ,
CHANGE COLUMN `indiv_property_property_type` `indiv_property_property_type` TINYINT(1) NULL DEFAULT NULL COMMENT '1 : Fresh Property, 2 : Old Sold Out' ,
CHANGE COLUMN `noc_soc_society_type` `noc_soc_society_type` TINYINT(1) NULL DEFAULT '1' COMMENT '1 : Housing, 2 : Mhada, 3 : Chawl Society' ,
ADD COLUMN `busi_activity_seen` TINYINT(1) NULL DEFAULT '0' COMMENT '0 : Yes, 1 : No' AFTER `busi_landmark_2`;
