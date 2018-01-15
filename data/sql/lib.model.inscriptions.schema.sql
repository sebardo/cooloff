
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- week
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `week`;


CREATE TABLE `week`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`starts_at` DATE,
	`ends_at` DATE,
	`title` VARCHAR(255),
	`centro_id` INTEGER,
	`is_morning_shelter` INTEGER default 0 NOT NULL,
	`is_afternoon_shelter` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `week_FI_1` (`centro_id`),
	CONSTRAINT `week_FK_1`
		FOREIGN KEY (`centro_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- week_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `week_i18n`;


CREATE TABLE `week_i18n`
(
	`morning_shelter_schedule` VARCHAR(255),
	`afternoon_shelter_schedule` VARCHAR(255),
	`shelter_description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `week_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `week` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- course
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `course`;


CREATE TABLE `course`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`starts_at` DATE,
	`ends_at` DATE,
	`price` DECIMAL(14,2) default 0 NOT NULL,
	`number_of_places` INTEGER  NOT NULL,
	`summer_fun_center_id` INTEGER  NOT NULL,
	`is_registration_open` INTEGER default 0 NOT NULL,
	`excursion_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `course_FI_1` (`summer_fun_center_id`),
	CONSTRAINT `course_FK_1`
		FOREIGN KEY (`summer_fun_center_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE,
	INDEX `course_FI_2` (`excursion_id`),
	CONSTRAINT `course_FK_2`
		FOREIGN KEY (`excursion_id`)
		REFERENCES `excursion` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- course_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `course_i18n`;


CREATE TABLE `course_i18n`
(
	`schedule` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `course_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `course` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- course_has_services
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `course_has_services`;


CREATE TABLE `course_has_services`
(
	`course_id` INTEGER  NOT NULL,
	`service_id` INTEGER  NOT NULL,
	PRIMARY KEY (`course_id`,`service_id`),
	CONSTRAINT `course_has_services_FK_1`
		FOREIGN KEY (`course_id`)
		REFERENCES `course` (`id`),
	INDEX `course_has_services_FI_2` (`service_id`),
	CONSTRAINT `course_has_services_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- inscription
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `inscription`;


CREATE TABLE `inscription`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`inscription_code` INTEGER default 0,
	`student_name` VARCHAR(255),
	`student_primer_apellido` VARCHAR(255),
	`student_segundo_apellido` VARCHAR(255),
	`student_birth_date` DATE,
	`student_address` VARCHAR(255),
	`student_zip` VARCHAR(100),
	`student_city` VARCHAR(100),
	`student_school_year` VARCHAR(150),
	`student_friends` VARCHAR(255),
	`is_student_disability` INTEGER default 0 NOT NULL,
	`student_disability` VARCHAR(255),
	`student_allergies` INTEGER default 0 NOT NULL,
	`student_allergies_description` VARCHAR(255),
	`father_name` VARCHAR(255),
	`father_primer_apellido` VARCHAR(255),
	`father_segundo_apellido` VARCHAR(255),
	`father_phone` VARCHAR(255),
	`father_dni` VARCHAR(255),
	`father_mail` VARCHAR(255),
	`state` INTEGER default 0,
	`is_father_mail_main` INTEGER default 1 NOT NULL,
	`mother_name` VARCHAR(255),
	`mother_primer_apellido` VARCHAR(255),
	`mother_segundo_apellido` VARCHAR(255),
	`mother_phone` VARCHAR(255),
	`mother_dni` VARCHAR(255),
	`mother_mail` VARCHAR(255),
	`is_mother_mail_main` INTEGER default 1 NOT NULL,
	`split_payment` INTEGER default 0,
	`beca` INTEGER,
	`student_course_inscription` INTEGER  NOT NULL,
	`is_paid` INTEGER default 0,
	`method_payment` INTEGER default 0,
	`student_provincia` INTEGER,
	`student_num_tarjeta_sanitaria` VARCHAR(100),
	`student_tarjeta_sanitaria_companyia` VARCHAR(100),
	`is_student_kid_and_us` INTEGER,
	`student_disability_level` VARCHAR(10),
	`student_comments` TEXT,
	`grupo_id` INTEGER,
	`student_excursion` INTEGER,
	`price` DECIMAL(14,2),
	`discount` DECIMAL(14,2),
	`discountPercent` DECIMAL(5,2),
	`student_photo` VARCHAR(100),
	`inscription_num` INTEGER,
	`custom_question` VARCHAR(255),
	`custom_question_answer` INTEGER,
	`amount_beca` DECIMAL(14,2),
	`amount_first_payment` DECIMAL(14,2),
	`amount_second_payment` DECIMAL(14,2),
	`payment_date` DATE,
	`certificated` INTEGER,
	`certificatedName` VARCHAR(255),
	`tpv_suffix` INTEGER,
	`tpv_first_payment_response` VARCHAR(255),
	`tpv_second_payment_response` VARCHAR(255),
	`culture` VARCHAR(2),
	`is_payment_reminder_sent` INTEGER default 0,
	`kids_and_us_center_id` INTEGER  NOT NULL,
	`last_cooloff_year` VARCHAR(4),
	`email_confirmation_sent` INTEGER,
	`student_meds` INTEGER,
	`student_meds_description` VARCHAR(255),
	`is_vaccinated` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `inscription_FI_1` (`student_course_inscription`),
	CONSTRAINT `inscription_FK_1`
		FOREIGN KEY (`student_course_inscription`)
		REFERENCES `course` (`id`)
		ON DELETE CASCADE,
	INDEX `inscription_FI_2` (`student_provincia`),
	CONSTRAINT `inscription_FK_2`
		FOREIGN KEY (`student_provincia`)
		REFERENCES `provincia` (`id`),
	INDEX `inscription_FI_3` (`grupo_id`),
	CONSTRAINT `inscription_FK_3`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`),
	INDEX `inscription_FI_4` (`kids_and_us_center_id`),
	CONSTRAINT `inscription_FK_4`
		FOREIGN KEY (`kids_and_us_center_id`)
		REFERENCES `kids_and_us_center` (`id`)
		ON DELETE RESTRICT
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- inscription_service_schedule
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `inscription_service_schedule`;


CREATE TABLE `inscription_service_schedule`
(
	`inscription_id` INTEGER  NOT NULL,
	`service_schedule_id` INTEGER  NOT NULL,
	PRIMARY KEY (`inscription_id`,`service_schedule_id`),
	CONSTRAINT `inscription_service_schedule_FK_1`
		FOREIGN KEY (`inscription_id`)
		REFERENCES `inscription` (`id`)
		ON DELETE CASCADE,
	INDEX `inscription_service_schedule_FI_2` (`service_schedule_id`),
	CONSTRAINT `inscription_service_schedule_FK_2`
		FOREIGN KEY (`service_schedule_id`)
		REFERENCES `service_schedule` (`id`)
		ON DELETE RESTRICT
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- provincia
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `provincia`;


CREATE TABLE `provincia`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo`;


CREATE TABLE `grupo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255),
	`centro_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `grupo_FI_1` (`centro_id`),
	CONSTRAINT `grupo_FK_1`
		FOREIGN KEY (`centro_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- profesor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `profesor`;


CREATE TABLE `profesor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255),
	`centro_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `profesor_FI_1` (`centro_id`),
	CONSTRAINT `profesor_FK_1`
		FOREIGN KEY (`centro_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- grupo_has_profesor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo_has_profesor`;


CREATE TABLE `grupo_has_profesor`
(
	`grupo_id` INTEGER  NOT NULL,
	`profesor_id` INTEGER  NOT NULL,
	PRIMARY KEY (`grupo_id`,`profesor_id`),
	CONSTRAINT `grupo_has_profesor_FK_1`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`),
	INDEX `grupo_has_profesor_FI_2` (`profesor_id`),
	CONSTRAINT `grupo_has_profesor_FK_2`
		FOREIGN KEY (`profesor_id`)
		REFERENCES `profesor` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- excursion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `excursion`;


CREATE TABLE `excursion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`centro_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `excursion_FI_1` (`centro_id`),
	CONSTRAINT `excursion_FK_1`
		FOREIGN KEY (`centro_id`)
		REFERENCES `summer_fun_center` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- excursion_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `excursion_i18n`;


CREATE TABLE `excursion_i18n`
(
	`nombre` VARCHAR(255),
	`descripcion` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `excursion_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `excursion` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
