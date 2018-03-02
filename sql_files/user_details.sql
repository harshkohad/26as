ALTER TABLE `tbl_user_details` ADD `role_id` VARCHAR(10) NOT NULL AFTER `last_login_ip`, ADD `institute_id` VARCHAR(10) NOT NULL AFTER `role_id`, ADD `loan_id` TEXT NOT NULL AFTER `institute_id`; 
