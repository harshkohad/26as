CREATE TABLE `tbl_applications_property_apf` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `property_apf_met_person` varchar(150) DEFAULT NULL,
  `property_apf_met_person_designation` varchar(150) DEFAULT NULL,
  `property_apf_property_status` tinyint(1) DEFAULT NULL COMMENT '1 : Freshland, 2 : Redevelopment',
  `property_apf_no_of_workers` int(11) DEFAULT NULL,
  `property_apf_mode_of_payment` varchar(150) DEFAULT NULL,
  `property_apf_construction_stock` varchar(150) DEFAULT NULL,
  `property_apf_total_flats` int(11) DEFAULT NULL,
  `property_apf_how_many_sold` int(11) DEFAULT NULL,
  `property_apf_total_shops` int(11) DEFAULT NULL,
  `property_apf_area` int(6) DEFAULT NULL,
  `property_apf_work_completed` varchar(150) DEFAULT NULL,
  `property_apf_possession` varchar(150) DEFAULT NULL,
  `property_apf_apf` varchar(150) DEFAULT NULL,
  `property_apf_delay_in_work` varchar(150) DEFAULT NULL,
  `property_apf_tpc` varchar(150) DEFAULT NULL,
  `property_apf_landmark` varchar(150) DEFAULT NULL,
  `property_apf_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `property_apf_not_reachable_remarks` text,
  `property_apf_address` varchar(1000) DEFAULT NULL,
  `property_apf_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `property_apf_address_pincode` varchar(10) DEFAULT NULL,
  `property_apf_address_trigger` varchar(1000) DEFAULT NULL,
  `property_apf_address_lat` varchar(45) DEFAULT NULL,
  `property_apf_address_long` varchar(45) DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_property_apf`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_property_apf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_applications_property_apf` 
ADD COLUMN `created_by` INT(11) NULL AFTER `property_apf_address_long`,
ADD COLUMN `created_on` datetime DEFAULT CURRENT_TIMESTAMP AFTER `created_by`,
ADD COLUMN `update_by` int(11) DEFAULT NULL AFTER `created_on`,
ADD COLUMN `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `update_by`,
ADD COLUMN `is_deleted` tinyint(1) DEFAULT '0' AFTER `updated_on`;

