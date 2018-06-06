
DROP TABLE IF EXISTS `tbl_application_paragraph`;
CREATE TABLE `tbl_application_paragraph` (
  `id` int(10) NOT NULL,
  `type_of_verification` int(10) NOT NULL,
  `door_status` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `paragraph` blob NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_by` int(10) NOT NULL,
  `deleted_by` int(10) NOT NULL,
  `is_deleted` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Indexes for table `tbl_application_paragraph`
--
ALTER TABLE `tbl_application_paragraph`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_application_paragraph`
--
ALTER TABLE `tbl_application_paragraph`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `acs`.`tbl_application_paragraph` 
CHANGE COLUMN `name` `name` VARCHAR(100) NOT NULL AFTER `id`,
CHANGE COLUMN `id` `id` INT(10) NOT NULL ,
CHANGE COLUMN `type_of_verification` `type_of_verification` TINYINT(1) NOT NULL COMMENT '1 : RESIDENCE VERIFICATION, 2 : BUSINESS VERIFICATION, 3 : OFFICE VERIFICATION, 4 : NOC (Business / Conditional), 5 : RESIDENCE/OFFICE VERIFICATION, 6 : BUILDER PROFILE, 7 : PROPERTY (APF), 8 : INDIVIDUAL PROPERTY, 9 : NOC (SOCIETY)' ,
CHANGE COLUMN `door_status` `door_status` TINYINT(1) NOT NULL COMMENT '1 : Available for Verification, 2 : Door Locked, 3 : Shifted, 4 : Door Locked & Shifted' ,
ADD COLUMN `paragraph_type` TINYINT(1) NULL DEFAULT 0 COMMENT '0 : Report, 1 : PDF' AFTER `name`;
