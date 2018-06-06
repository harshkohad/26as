
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