DROP TABLE IF EXISTS `tbl_institute_header_template`;
CREATE TABLE `tbl_institute_header_template` (
  `id` int(10) NOT NULL,
  `header` varchar(100) DEFAULT NULL,
  `fields` text,
  `final_fields` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `institute_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
