
CREATE TABLE `tbl_applications_busi` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `busi_tpc_neighbor_1` varchar(150) DEFAULT NULL,
  `busi_tpc_neighbor_2` varchar(150) DEFAULT NULL,
  `busi_company_name_board` varchar(150) DEFAULT NULL,
  `busi_met_person` varchar(150) DEFAULT NULL,
  `busi_designation` varchar(150) DEFAULT NULL,
  `busi_designation_others` varchar(100) DEFAULT NULL,
  `busi_nature_of_business` varchar(150) DEFAULT NULL,
  `busi_staff_declared` int(11) DEFAULT NULL,
  `busi_staff_seen` int(11) DEFAULT NULL,
  `busi_years_in_business` int(11) DEFAULT NULL,
  `busi_type_of_business` tinyint(1) DEFAULT '1' COMMENT '1 : DIRECTORSHIP, 2 : PROPRIETOR, 3 : PARTNERSHIP',
  `busi_ownership_status` tinyint(1) DEFAULT '1' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other',
  `busi_ownership_status_text` varchar(150) DEFAULT NULL,
  `busi_area` int(11) DEFAULT NULL,
  `busi_locality` tinyint(1) DEFAULT '1' COMMENT '1 : Gala, 2 : Shopline, 3 : Compound, 4 : Resi, 5 : Commercial, 6 : Other',
  `busi_locality_text` varchar(150) DEFAULT NULL,
  `busi_locality_type` tinyint(1) DEFAULT '0',
  `busi_landmark_1` varchar(150) DEFAULT NULL,
  `busi_landmark_2` varchar(150) DEFAULT NULL,
  `busi_activity_seen` tinyint(1) DEFAULT '0' COMMENT '0 : Yes, 1 : No',
  `busi_structure` varchar(1000) DEFAULT NULL,
  `busi_remarks` varchar(1000) DEFAULT NULL,
  `busi_status` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer',
  `busi_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `busi_not_reachable_remarks` text,
  `busi_rented_owner_name` varchar(100) DEFAULT NULL,
  `busi_rent_amount` varchar(500) DEFAULT NULL,
  `busi_available_status` tinyint(1) DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted',
  `busi_shifted_tenure` int(4) DEFAULT '0',
  `busi_reason_for_closed` varchar(100) DEFAULT NULL,
  `busi_address` varchar(1000) DEFAULT NULL,
  `busi_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `busi_address_pincode` varchar(10) DEFAULT NULL,
  `busi_address_trigger` varchar(1000) DEFAULT NULL,
  `busi_address_lat` varchar(45) DEFAULT NULL,
  `busi_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_busi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_busi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

