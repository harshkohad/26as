

ALTER TABLE `tbl_institutes` 
CHANGE COLUMN `name` `name` VARCHAR(150) NOT NULL ,
ADD COLUMN `abbreviation` VARCHAR(45) NOT NULL AFTER `name`;