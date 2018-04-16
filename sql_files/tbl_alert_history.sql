DROP TABLE IF EXISTS `tbl_alert_history`;
CREATE TABLE `tbl_alert_history` (
  `id` int(10) NOT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `user_ids` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_alert_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_alert_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_alert_history` ADD `is_all` VA
CHAR(10) NULL DEFAULT 'No' AFTER `is_deleted`; 