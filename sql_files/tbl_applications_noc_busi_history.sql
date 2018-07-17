DROP TABLE IF EXISTS `tbl_applications_noc_busi_history`;
CREATE TABLE `tbl_applications_noc_busi_history` (
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
  `noc_address_long` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `tbl_applications_noc_busi_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_noc_busi_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
