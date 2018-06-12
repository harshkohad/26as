CREATE TABLE `tbl_applications_resi_office` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `resi_office_reason_for_closed` varchar(100) DEFAULT NULL,
  `resi_office_society_name_plate` varchar(150) DEFAULT NULL,
  `resi_office_door_name_plate` varchar(150) DEFAULT NULL,
  `resi_office_tpc_neighbor_1` varchar(150) DEFAULT NULL,
  `resi_office_tpc_neighbor_2` varchar(150) DEFAULT NULL,
  `resi_office_met_person` varchar(150) DEFAULT NULL,
  `resi_office_met_person_designation` varchar(150) DEFAULT NULL,
  `resi_office_relation` varchar(150) DEFAULT NULL,
  `resi_office_home_area` int(6) DEFAULT NULL,
  `resi_office_ownership_status` tinyint(1) DEFAULT '1' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other',
  `resi_office_ownership_status_text` varchar(150) DEFAULT NULL,
  `resi_office_stay_years` int(4) DEFAULT NULL,
  `resi_office_total_family_members` int(3) DEFAULT NULL,
  `resi_office_working_members` int(3) DEFAULT NULL,
  `resi_office_company_name_board` varchar(150) DEFAULT NULL,
  `resi_office_designation` varchar(150) DEFAULT NULL,
  `resi_office_department` varchar(150) DEFAULT NULL,
  `resi_office_nature_of_company` varchar(150) DEFAULT NULL,
  `resi_office_employment_years` int(4) DEFAULT NULL,
  `resi_office_net_salary_amount` varchar(150) DEFAULT NULL,
  `resi_office_tpc_for_applicant` varchar(150) DEFAULT NULL,
  `resi_office_tpc_for_company` varchar(150) DEFAULT NULL,
  `resi_office_locality` tinyint(1) DEFAULT '1' COMMENT '1 : Chawl , 2 : Residential, 3 : Bunglow, 4 : Others',
  `resi_office_locality_text` varchar(150) DEFAULT NULL,
  `resi_office_locality_type` tinyint(1) DEFAULT '0',
  `resi_office_landmark_1` varchar(150) DEFAULT NULL,
  `resi_office_landmark_2` varchar(150) DEFAULT NULL,
  `resi_office_structure` varchar(1000) DEFAULT NULL,
  `resi_office_market_feedback` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative',
  `resi_office_remarks` varchar(1000) DEFAULT NULL,
  `resi_office_status` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer',
  `resi_office_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `resi_office_not_reachable_remarks` text,
  `resi_office_rented_owner_name` varchar(100) DEFAULT NULL,
  `resi_office_rent_amount` varchar(500) DEFAULT NULL,
  `resi_office_available_status` tinyint(1) DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted',
  `resi_office_shifted_tenure` int(4) DEFAULT '0',
  `resi_office_address` varchar(1000) DEFAULT NULL,
  `resi_office_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `resi_office_address_pincode` varchar(10) DEFAULT NULL,
  `resi_office_address_trigger` varchar(1000) DEFAULT NULL,
  `resi_office_address_lat` varchar(45) DEFAULT NULL,
  `resi_office_address_long` varchar(45) DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `tbl_applications_resi_office`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_resi_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

