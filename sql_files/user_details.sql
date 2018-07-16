ALTER TABLE `tbl_user_details` ADD `role_id` VARCHAR(100) NOT NULL AFTER `last_login_ip`, ADD `institute_id` int(10) AFTER `role_id`, ADD `loan_id` int(10) AFTER `institute_id`; 

ALTER TABLE `tbl_user_details` CHANGE `institute_id` `institute_id` VARCHAR(30) NULL DEFAULT NULL; 
ALTER TABLE `tbl_user_details` CHANGE `loan_id` `loan_id` VARCHAR(30) NULL DEFAULT NULL; 