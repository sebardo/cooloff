
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- summer_fun_zone
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_zone`;


CREATE TABLE `summer_fun_zone`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_zone_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_zone_i18n`;


CREATE TABLE `summer_fun_zone_i18n`
(
	`title` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `summer_fun_zone_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `summer_fun_zone` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_center
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_center`;


CREATE TABLE `summer_fun_center`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`summer_fun_zone_id` INTEGER  NOT NULL,
	`morning_shelter` INTEGER default 0 NOT NULL,
	`afternoon_shelter` INTEGER default 0 NOT NULL,
	`transfer_payment` INTEGER default 0 NOT NULL,
	`cash_payment` INTEGER default 0 NOT NULL,
	`tpv_payment` INTEGER default 0 NOT NULL,
	`is_registration_open` INTEGER default 0 NOT NULL,
	`account_number` VARCHAR(255),
	`mail` VARCHAR(255),
	`weeks_discount` INTEGER(4),
	`weeks_percent_discount` DECIMAL(5,2) default 0,
	`brothers_discount` INTEGER(4),
	`brothers_percent_discount` DECIMAL(5,2) default 0,
	`show_excursion_widget` INTEGER default 0 NOT NULL,
	`recibo_domiciliado_payment` INTEGER default 0 NOT NULL,
	`show_beca_widget` INTEGER default 0 NOT NULL,
	`merchant_code` VARCHAR(255),
	`merchant_key` VARCHAR(255),
	`url_tpv` VARCHAR(255),
	`second_payment_mailing_date` DATE,
	`second_payment_date` DATE,
	PRIMARY KEY (`id`),
	INDEX `summer_fun_center_FI_1` (`summer_fun_zone_id`),
	CONSTRAINT `summer_fun_center_FK_1`
		FOREIGN KEY (`summer_fun_zone_id`)
		REFERENCES `summer_fun_zone` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_center_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_center_i18n`;


CREATE TABLE `summer_fun_center_i18n`
(
	`title` VARCHAR(255),
	`description` TEXT,
	`text_shelter` TEXT,
	`inscription_confirmation_mail` TEXT,
	`inscription_conditions_terms_pdf` VARCHAR(255),
	`custom_question` VARCHAR(255),
	`recibo_domiciliado_txt` VARCHAR(255),
	`second_payment_mailing_body` TEXT,
	`second_payment_mailing_body_no_tpv` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `summer_fun_center_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_center_has_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_center_has_profile`;


CREATE TABLE `summer_fun_center_has_profile`
(
	`summer_fun_center_id` INTEGER  NOT NULL,
	`profile_id` INTEGER  NOT NULL,
	PRIMARY KEY (`summer_fun_center_id`,`profile_id`),
	CONSTRAINT `summer_fun_center_has_profile_FK_1`
		FOREIGN KEY (`summer_fun_center_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE,
	INDEX `summer_fun_center_has_profile_FI_2` (`profile_id`),
	CONSTRAINT `summer_fun_center_has_profile_FK_2`
		FOREIGN KEY (`profile_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_center_news_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_center_news_item`;


CREATE TABLE `summer_fun_center_news_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`summer_fun_center_id` INTEGER  NOT NULL,
	`published_at` DATE,
	`is_published` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `summer_fun_center_news_item_FI_1` (`summer_fun_center_id`),
	CONSTRAINT `summer_fun_center_news_item_FK_1`
		FOREIGN KEY (`summer_fun_center_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- summer_fun_center_news_item_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `summer_fun_center_news_item_i18n`;


CREATE TABLE `summer_fun_center_news_item_i18n`
(
	`title` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `summer_fun_center_news_item_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `summer_fun_center_news_item` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service`;


CREATE TABLE `service`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`center_id` INTEGER  NOT NULL,
	`price` DECIMAL(14,2) default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `service_FI_1` (`center_id`),
	CONSTRAINT `service_FK_1`
		FOREIGN KEY (`center_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service_i18n`;


CREATE TABLE `service_i18n`
(
	`name` VARCHAR(255),
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `service_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `service` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service_schedule
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service_schedule`;


CREATE TABLE `service_schedule`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`orden` INTEGER,
	`service_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `service_schedule_FI_1` (`service_id`),
	CONSTRAINT `service_schedule_FK_1`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service_schedule_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service_schedule_i18n`;


CREATE TABLE `service_schedule_i18n`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `service_schedule_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `service_schedule` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- kids_and_us_center
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `kids_and_us_center`;


CREATE TABLE `kids_and_us_center`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
