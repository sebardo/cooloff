ALTER TABLE `course` engine=myisam;
ALTER TABLE `summer_fun_center` engine=myisam;
ALTER TABLE `kids_and_us_center` engine=myisam;
ALTER TABLE `sf_guard_user` engine=myisam;
ALTER TABLE `inscription` ADD `is_vaccinated` INTEGER;
/* old definition: (`week_id`)
   new definition: (`summer_fun_center_id`) */
ALTER TABLE `course` DROP INDEX course_FI_1,        ADD  INDEX `course_FI_1` (`summer_fun_center_id`);
/* old definition: (`summer_fun_center_id`)
   new definition: (`excursion_id`) */
ALTER TABLE `course` DROP INDEX course_FI_2,        ADD  INDEX `course_FI_2` (`excursion_id`);
ALTER TABLE `course` DROP INDEX course_FI_3;
ALTER TABLE `course` DROP `week_id`;
ALTER TABLE `course` DROP `profile_id`;
/* old definition: varchar(7) collate utf8_bin not null
   new definition: varchar(7)  not null */
ALTER TABLE `course_i18n` CHANGE `culture` `culture` varchar(7)  not null;
/* old definition: int(11) not null default '0'
   new definition: integer default 0 */
ALTER TABLE `inscription` CHANGE `is_paid` `is_paid` integer default 0;
/* old definition: int(11) not null default '0'
   new definition: integer default 0 */
ALTER TABLE `inscription` CHANGE `state` `state` integer default 0;
/* old definition: int(11) not null default '0'
   new definition: integer default 0 */
ALTER TABLE `inscription` CHANGE `method_payment` `method_payment` integer default 0;
ALTER TABLE `inscription` DROP `shelter`;
/* old definition: int(11) not null default '0'
   new definition: integer default 0 */
ALTER TABLE `inscription` CHANGE `inscription_code` `inscription_code` integer default 0;
/* old definition: decimal(14,2) default '0.00'
   new definition: decimal(14,2) */
ALTER TABLE `inscription` CHANGE `amount_beca` `amount_beca` decimal(14,2);
/* old definition: decimal(14,2) default '0.00'
   new definition: decimal(14,2) */
ALTER TABLE `inscription` CHANGE `amount_first_payment` `amount_first_payment` decimal(14,2);
/* old definition: decimal(14,2) default '0.00'
   new definition: decimal(14,2) */
ALTER TABLE `inscription` CHANGE `amount_second_payment` `amount_second_payment` decimal(14,2);
DROP TABLE `post`;
DROP TABLE `post_comment`;
DROP TABLE `post_image`;
DROP TABLE `post_translation`;
ALTER TABLE `summer_fun_center` DROP INDEX summer_fun_center_FI_2;
ALTER TABLE `summer_fun_center` DROP `profile_id`;
ALTER TABLE `summer_fun_center` DROP `shelter_price`;
ALTER TABLE `summer_fun_center` DROP `has_shelter_charged`;
/* old definition: varchar(7) collate utf8_bin not null
   new definition: varchar(7)  not null */
ALTER TABLE `summer_fun_center_i18n` CHANGE `culture` `culture` varchar(7)  not null;
/* old definition: varchar(7) collate utf8_bin not null
   new definition: varchar(7)  not null */
ALTER TABLE `summer_fun_center_news_item_i18n` CHANGE `culture` `culture` varchar(7)  not null;
/* old definition: varchar(7) collate utf8_bin not null
   new definition: varchar(7)  not null */
ALTER TABLE `summer_fun_zone_i18n` CHANGE `culture` `culture` varchar(7)  not null;
/* old definition: int(11) default '0'
   new definition: integer */
ALTER TABLE `thaira_uploads_file` CHANGE `is_protected` `is_protected` integer;
DROP TABLE `upload`;
DROP TABLE `upload_translation`;
