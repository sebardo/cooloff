
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- thaira_uploads_file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thaira_uploads_file`;


CREATE TABLE `thaira_uploads_file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`object_class` VARCHAR(100),
	`object_id` INTEGER,
	`group_name` VARCHAR(100),
	`is_pending` INTEGER,
	`pending_uid` VARCHAR(150),
	`pending_file_path` VARCHAR(255),
	`rank` INTEGER,
	`filename` VARCHAR(150),
	`extension` VARCHAR(20),
	`path` VARCHAR(255),
	`is_protected` INTEGER,
	`password` VARCHAR(100),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `thaira_uploads_file_object_class_index`(`object_class`),
	KEY `thaira_uploads_file_object_id_index`(`object_id`),
	KEY `thaira_uploads_file_group_name_index`(`group_name`),
	KEY `thaira_uploads_file_i1`(`object_class`, `object_id`, `group_name`, `rank`),
	KEY `thaira_uploads_file_i2`(`object_class`, `object_id`, `group_name`),
	KEY `thaira_uploads_file_i3`(`object_class`, `object_id`),
	KEY `thaira_uploads_file_i4`(`is_pending`, `pending_uid`),
	KEY `thaira_uploads_file_i5`(`is_pending`, `created_at`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- thaira_uploads_file_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thaira_uploads_file_i18n`;


CREATE TABLE `thaira_uploads_file_i18n`
(
	`title` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `thaira_uploads_file_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `thaira_uploads_file` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
