CREATE TABLE `tbl_applications_office` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `office_reason_for_closed` varchar(100) DEFAULT NULL,
  `office_company_name_board` varchar(150) DEFAULT NULL,
  `office_designation` varchar(150) DEFAULT NULL,
  `office_met_person` varchar(150) DEFAULT NULL,
  `office_met_person_designation` varchar(150) DEFAULT NULL,
  `office_department` varchar(150) DEFAULT NULL,
  `office_nature_of_company` varchar(150) DEFAULT NULL,
  `office_employment_years` int(4) DEFAULT NULL,
  `office_net_salary_amount` varchar(150) DEFAULT NULL,
  `office_tpc_for_applicant` varchar(150) DEFAULT NULL,
  `office_tpc_for_company` varchar(150) DEFAULT NULL,
  `office_landmark` varchar(150) DEFAULT NULL,
  `office_structure` varchar(1000) DEFAULT NULL,
  `office_remarks` varchar(1000) DEFAULT NULL,
  `office_status` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer',
  `office_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `office_not_reachable_remarks` text,
  `office_available_status` tinyint(1) DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted',
  `office_shifted_tenure` int(4) DEFAULT '0',
  `office_address` varchar(1000) DEFAULT NULL,
  `office_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `office_address_pincode` varchar(10) DEFAULT NULL,
  `office_address_trigger` varchar(1000) DEFAULT NULL,
  `office_address_lat` varchar(45) DEFAULT NULL,
  `office_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_office`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tbl_applications_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_applications_office` 
ADD COLUMN `created_by` INT(11) NULL AFTER `office_address_long`,
ADD COLUMN `created_on` datetime DEFAULT CURRENT_TIMESTAMP AFTER `created_by`,
ADD COLUMN `updated_by` int(11) DEFAULT NULL AFTER `created_on`,
ADD COLUMN `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `updated_by`,
ADD COLUMN `is_deleted` tinyint(1) DEFAULT '0' AFTER `updated_on`;

