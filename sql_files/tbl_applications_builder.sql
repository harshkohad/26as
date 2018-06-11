CREATE TABLE `tbl_applications_builder_profile` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `builder_profile_company_name_board` varchar(150) DEFAULT NULL,
  `builder_profile_met_person` varchar(150) DEFAULT NULL,
  `builder_profile_met_person_designation` varchar(150) DEFAULT NULL,
  `builder_profile_exsistence` int(11) DEFAULT NULL,
  `builder_profile_current_projects` varchar(1000) DEFAULT NULL,
  `builder_profile_previous_projects` varchar(1000) DEFAULT NULL,
  `builder_profile_staff` int(11) DEFAULT NULL,
  `builder_profile_area` int(6) DEFAULT NULL,
  `builder_profile_type_of_office` tinyint(1) DEFAULT NULL COMMENT '1 : Shopline, 2 : Commercial, 3 : Independent, 4 : Residential',
  `builder_profile_tpc_neighbor_1` varchar(150) DEFAULT NULL,
  `builder_profile_tpc_neighbor_2` varchar(150) DEFAULT NULL,
  `builder_profile_landmark_1` varchar(150) DEFAULT NULL,
  `builder_profile_landmark_2` varchar(150) DEFAULT NULL,
  `builder_profile_is_reachable` tinyint(1) DEFAULT '0' COMMENT '0 : Reachable, 1 : Not-reachable',
  `builder_profile_not_reachable_remarks` text,
  `builder_profile_address` varchar(1000) DEFAULT NULL,
  `builder_profile_address_verification` tinyint(1) DEFAULT '0' COMMENT '0 : Do not Send for Verification , 1: Send for Verification',
  `builder_profile_address_pincode` varchar(10) DEFAULT NULL,
  `builder_profile_address_trigger` varchar(1000) DEFAULT NULL,
  `builder_profile_address_lat` varchar(45) DEFAULT NULL,
  `builder_profile_address_long` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_applications_builder_profile`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_applications_builder_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

