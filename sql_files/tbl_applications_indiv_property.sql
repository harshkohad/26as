DROP TABLE IF EXISTS `tbl_applications_indiv_property`;
CREATE TABLE `tbl_applications_indiv_property` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `indiv_property_met_person` varchar(150) DEFAULT NULL,
  `indiv_property_met_person_designation` varchar(150) DEFAULT NULL,
  `indiv_property_property_confirmed` varchar(150) DEFAULT NULL,
  `indiv_property_previous_owner` varchar(150) DEFAULT NULL,
  `indiv_property_property_type` tinyint(1) DEFAULT NULL COMMENT '1 : Fresh Property, 2 : Old Sold Out',
  `indiv_property_area` int(6) DEFAULT NULL,
  `indiv_property_approx_market_value` varchar(150) DEFAULT NULL,
  `indiv_property_society_name_plate` varchar(150) DEFAULT NULL,
  `indiv_property_door_name_plate` varchar(150) DEFAULT NULL,
  `indiv_property_tpc` varchar(150) DEFAULT NULL,
  `indiv_property_landmark` varchar(150) DEFAULT NULL,
  `indiv_property_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `indiv_property_not_reachable_remarks` text,
  `indiv_property_address` varchar(1000) DEFAULT NULL,
  `indiv_property_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `indiv_property_address_pincode` varchar(10) DEFAULT NULL,
  `indiv_property_address_trigger` varchar(1000) DEFAULT NULL,
  `indiv_property_address_lat` varchar(45) DEFAULT NULL,
  `indiv_property_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_indiv_property`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tbl_applications_indiv_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_applications_indiv_property` 
ADD COLUMN `created_by` INT(11) NULL AFTER `indiv_property_address_long`,
ADD COLUMN `created_on` datetime DEFAULT CURRENT_TIMESTAMP AFTER `created_by`,
ADD COLUMN `updated_by` int(11) DEFAULT NULL AFTER `created_on`,
ADD COLUMN `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `updated_by`,
ADD COLUMN `is_deleted` tinyint(1) DEFAULT '0' AFTER `updated_on`;
