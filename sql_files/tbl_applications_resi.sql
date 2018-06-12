
CREATE TABLE `tbl_applications_resi` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `resi_society_name_plate` varchar(150) DEFAULT NULL,
  `resi_door_name_plate` varchar(150) DEFAULT NULL,
  `resi_tpc_neighbor_1` varchar(150) DEFAULT NULL,
  `resi_tpc_neighbor_2` varchar(150) DEFAULT NULL,
  `resi_met_person` varchar(150) DEFAULT NULL,
  `resi_relation` varchar(150) DEFAULT NULL,
  `resi_home_area` int(6) DEFAULT NULL,
  `resi_ownership_status` tinyint(1) DEFAULT '1' COMMENT '1 : Rented, 2 : Owned, 3 : Parental, 4 : Other',
  `resi_ownership_status_text` varchar(150) DEFAULT NULL,
  `resi_stay_years` int(4) DEFAULT NULL,
  `resi_total_family_members` int(3) DEFAULT NULL,
  `resi_working_members` int(3) DEFAULT NULL,
  `resi_locality` tinyint(1) DEFAULT '1' COMMENT '1 : Chawl , 2 : Residential, 3 : Bunglow, 4 : Others',
  `resi_locality_text` varchar(150) DEFAULT NULL,
  `resi_locality_type` tinyint(1) DEFAULT '0',
  `resi_landmark_1` varchar(150) DEFAULT NULL,
  `resi_landmark_2` varchar(150) DEFAULT NULL,
  `resi_structure` varchar(1000) DEFAULT NULL,
  `resi_market_feedback` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative',
  `resi_remarks` varchar(1000) DEFAULT NULL,
  `resi_status` tinyint(1) DEFAULT '0' COMMENT '0 : Positive, 1 : Negative, 2 : Credit Refer',
  `resi_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `resi_not_reachable_remarks` text,
  `resi_rented_owner_name` varchar(100) DEFAULT NULL,
  `resi_rent_amount` varchar(500) DEFAULT NULL,
  `resi_available_status` tinyint(1) DEFAULT '0' COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted',
  `resi_shifted_tenure` int(4) DEFAULT '0',
  `resi_address` varchar(1000) DEFAULT NULL,
  `resi_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `resi_address_pincode` varchar(10) DEFAULT NULL,
  `resi_address_trigger` varchar(1000) DEFAULT NULL,
  `resi_address_lat` varchar(45) DEFAULT NULL,
  `resi_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_resi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

