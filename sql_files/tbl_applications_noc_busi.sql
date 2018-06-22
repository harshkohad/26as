DROP TABLE IF EXISTS `tbl_applications_noc_busi`;
CREATE TABLE `tbl_applications_noc_busi` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `noc_structure` varchar(1000) DEFAULT NULL,
  `noc_status` varchar(45) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer',
  `noc_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `noc_not_reachable_remarks` text,
  `noc_soc_chairman_name` varchar(200) DEFAULT NULL,
  `noc_soc_secretary_name` varchar(200) DEFAULT NULL,
  `noc_soc_tresurer_name` varchar(200) DEFAULT NULL,
  `noc_address` varchar(1000) DEFAULT NULL,
  `noc_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `noc_address_pincode` varchar(10) DEFAULT NULL,
  `noc_address_trigger` varchar(1000) DEFAULT NULL,
  `noc_address_lat` varchar(45) DEFAULT NULL,
  `noc_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_noc_busi`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tbl_applications_noc_busi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_applications_noc_busi` 
ADD COLUMN `created_by` INT(11) NULL AFTER `noc_address_long`,
ADD COLUMN `created_on` datetime DEFAULT CURRENT_TIMESTAMP AFTER `created_by`,
ADD COLUMN `updated_by` int(11) DEFAULT NULL AFTER `created_on`,
ADD COLUMN `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `updated_by`,
ADD COLUMN `is_deleted` tinyint(1) DEFAULT '0' AFTER `updated_on`;