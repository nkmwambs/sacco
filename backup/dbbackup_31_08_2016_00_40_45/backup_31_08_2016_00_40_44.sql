#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '2',
  `active` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`, `active`, `authentication_key`) VALUES (1, 'Nicodemus Karisa', 'nkmwambs@gmail.com', '@Compassion123', 1, 'yes', '');
INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`, `active`, `authentication_key`) VALUES (2, 'Joyce Cherono', 'JCherono@ke.ci.org', '123456789', 2, 'yes', '');


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0e5294cc3ad270b16bce4e25793aac21851210de', '::1', 1472580397, '__ci_last_regenerate|i:1472580130;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('20b57547057ed7e3fdd1b22f55454f19002b548b', '::1', 1472581205, '__ci_last_regenerate|i:1472581201;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4274c558a4b2249652c4c1999ab7be9144a2964a', '::1', 1472582680, '__ci_last_regenerate|i:1472582522;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('623f02aef6ba400954bfcb4a01018b9334c5df18', '::1', 1472580802, '__ci_last_regenerate|i:1472580543;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('83742520a04e0cd1b15a3e62d9a7bab988259c76', '::1', 1472582124, '__ci_last_regenerate|i:1472581878;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('aabe9cf870264b784fc3bce1443b7d0a0811df9d', '::1', 1472584240, '__ci_last_regenerate|i:1472584024;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b8f8b8467544b7fdd2eb8909a9be5386e58abd73', '::1', 1472581855, '__ci_last_regenerate|i:1472581561;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c8c38ea63a1490a157e3709c9551fb74b689761f', '::1', 1472581089, '__ci_last_regenerate|i:1472580878;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e3bb5b6180854813dac79ec8025dd9348fa64b1a', '::1', 1472583428, '__ci_last_regenerate|i:1472583209;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f4b87fac815677aede827f896ffe767ec905c7ca', '::1', 1472583989, '__ci_last_regenerate|i:1472583717;admin_login|s:1:\"1\";admin_id|s:1:\"1\";login_user_id|s:1:\"1\";name|s:16:\"Nicodemus Karisa\";login_type|s:5:\"admin\";');


#
# TABLE STRUCTURE FOR: department
#

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `department` (`department_id`, `name`) VALUES (5, 'Program Implementation');
INSERT INTO `department` (`department_id`, `name`) VALUES (6, 'Program Communication');
INSERT INTO `department` (`department_id`, `name`) VALUES (7, 'Ministry Services');
INSERT INTO `department` (`department_id`, `name`) VALUES (8, 'Africa Regional');


#
# TABLE STRUCTURE FOR: document
#

DROP TABLE IF EXISTS `document`;

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: extra_payments
#

DROP TABLE IF EXISTS `extra_payments`;

CREATE TABLE `extra_payments` (
  `extra_payments_id` int(100) NOT NULL AUTO_INCREMENT,
  `payment_date` date NOT NULL,
  `loans_id` varchar(20) NOT NULL,
  `extra_pay` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`extra_payments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (1, '2016-06-04', '14', '50000.00', 'transfered', '2016-06-04 13:45:17');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (3, '2016-06-04', '14', '15000.00', 'transfered', '2016-06-04 13:45:21');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (4, '2016-06-04', '14', '130000.00', 'transfered', '2016-06-04 13:45:24');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (5, '2016-06-04', '16', '125000.00', 'transfered', '2016-06-04 13:45:28');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (6, '2016-06-04', '17', '16000.00', 'transfered', '2016-06-04 13:45:32');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (7, '2016-06-04', '17', '75000.00', 'transfered', '2016-06-04 13:45:35');
INSERT INTO `extra_payments` (`extra_payments_id`, `payment_date`, `loans_id`, `extra_pay`, `status`, `timestamp`) VALUES (8, '2016-06-04', '17', '45000.00', 'transfered', '2016-06-04 13:45:39');


#
# TABLE STRUCTURE FOR: guarantors
#

DROP TABLE IF EXISTS `guarantors`;

CREATE TABLE `guarantors` (
  `guarantors_id` int(50) NOT NULL AUTO_INCREMENT,
  `member_id` int(50) NOT NULL,
  `loans_id` int(50) NOT NULL,
  `share_guaranteed` int(50) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`guarantors_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (16, 7, 14, 130000, 'freed', '2016-05-19 01:13:03');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (17, 8, 14, 220000, 'freed', '2016-08-24 23:34:22');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (19, 1, 0, 0, 'requested', '2016-05-11 22:39:26');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (20, 1, 0, 0, 'requested', '2016-05-11 22:39:51');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (21, 10, 16, 150000, 'freed', '2016-05-19 13:49:20');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (25, 8, 4, 40000, 'freed', '2016-05-19 01:13:49');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (26, 10, 17, 400000, 'accepted', '2016-06-01 13:01:04');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (29, 7, 19, 50000, 'accepted', '2016-06-02 04:34:56');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (30, 8, 19, 15000, 'accepted', '2016-06-02 04:35:50');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (31, 9, 21, 100000, 'accepted', '2016-06-06 22:13:10');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (52, 8, 115, 100000, 'accepted', '2016-08-25 11:18:08');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (53, 10, 115, 100000, 'accepted', '2016-08-25 11:18:57');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (55, 11, 115, 200000, 'accepted', '2016-08-25 11:40:29');
INSERT INTO `guarantors` (`guarantors_id`, `member_id`, `loans_id`, `share_guaranteed`, `status`, `timestamp`) VALUES (56, 9, 124, 0, 'requested', '2016-08-30 16:24:55');


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `phrase_id` int(50) NOT NULL AUTO_INCREMENT,
  `phrase` longtext NOT NULL,
  `english` longtext NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (1, 'manage_language', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (2, 'dashboard', 'Dashboard');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (3, 'members', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (4, 'admit_member', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (5, 'admit_bulk_member', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (6, 'student_information', 'Member Information');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (7, 'departments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (8, 'shares', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (9, 'loans_and_shares', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (10, 'process_loan', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (11, 'apply_loan', 'Apply Loan');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (12, 'extra_loan_payments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (13, 'payment_schedule', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (14, 'loan_types', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (15, 'transactions', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (16, 'reports', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (17, 'shares_report', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (18, 'loans_report', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (19, 'guarantors_report', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (20, 'interest_report', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (21, 'noticeboard', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (22, 'message', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (23, 'settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (24, 'general_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (25, 'sms_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (26, 'language_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (27, 'loans_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (28, 'email_templates', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (29, 'activity', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (30, 'account', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (31, 'edit_profile', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (32, 'change_password', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (33, 'edit_phrase', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (34, 'language_list', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (35, 'add_phrase', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (36, 'add_language', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (37, 'update_phrase', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (38, 'language', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (39, 'option', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (40, 'delete_language', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (41, 'phrase', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (42, 'value_required', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (43, 'delete', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (44, 'cancel', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (45, 'Ok', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (46, 'back', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (47, 'incomplete_applications', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (48, 'submitted_applications', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (49, 'deferred_loans', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (50, 'declined_applications', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (51, 'active_loans', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (52, 'name', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (53, 'application_date', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (54, 'loan_applied', 'Loan Advanced');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (55, 'period_in_months', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (56, 'monthly_repayments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (57, 'total_member_shares', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (58, 'share_guaranteed', 'Loan Guaranteed');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (59, 'share_guaranteed_deficit', 'Loan Guaranteed Deficit');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (60, 'options', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (61, 'view_application', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (62, 'Delete_application', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (63, 'loan_id', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (64, 'loan_balance', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (65, 'loan_repayment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (66, 'loan_statement', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (67, 'loan_schedule', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (68, 'edit_scheduled_extra_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (69, 'add_loan_schedule', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (70, 'delete_loan_schedule', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (71, 'add_guarantor', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (72, 'admit_student', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (73, 'active_members', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (74, 'inactive_members', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (75, 'photo', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (76, 'roll', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (77, 'loan_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (78, 'monthly_share_rate', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (79, 'member_deductions', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (80, 'total_shares', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (81, 'guaranteed_shares', 'Committed Shares');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (82, 'member_value', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (83, 'edit', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (84, 'deactivate_member', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (85, 'share_statement', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (86, 'change_share_rate', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (87, 'share_contribution', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (88, 'add_loan', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (89, 'normal_loan', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (90, 'emergency_loan', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (91, 'guaranteed', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (92, 'pay_loan', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (93, 'information', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (94, 'payment_month', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (95, 'payment_date', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (96, 'scheduled_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (97, 'scheduled_extra_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (98, 'one_time_extra_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (99, 'excess_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (100, 'pay', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (101, 'loan_repayment_successful', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (102, 'system_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (103, 'system_name', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (104, 'system_title', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (105, 'address', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (106, 'phone', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (107, 'paypal_email', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (108, 'currency', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (109, 'system_email', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (110, 'text_align', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (111, 'save', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (112, 'update_product', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (113, 'file', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (114, 'install_update', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (115, 'theme_settings', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (116, 'default', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (117, 'select_theme', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (118, 'select_a_theme_to_make_changes', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (119, 'upload_logo', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (120, 'upload', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (121, 'add_student', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (122, 'addmission_form', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (123, 'birthday', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (124, 'gender', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (125, 'select', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (126, 'male', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (127, 'female', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (128, 'department', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (129, 'select_department', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (130, 'membership_date', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (131, 'email', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (132, 'password', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (133, 'member_name', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (134, 'scheduled_number_of_payments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (135, 'actual_number_of_payments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (136, 'total_early_payments', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (137, 'total_interest', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (138, 'beginning_balance', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (139, 'extra_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (140, 'total_payment', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (141, 'interest', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (142, 'ending_balance', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (143, 'system_reset', 'System Reset & Back Up');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (144, 'manage_profile', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (145, 'admit_administrator', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (146, 'manage_administrators', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (147, 'active', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (148, 'back_up', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES (149, 'restore', '');


#
# TABLE STRUCTURE FOR: last_seen
#

DROP TABLE IF EXISTS `last_seen`;

CREATE TABLE `last_seen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `last_seen` (`id`, `user_id`, `message_id`) VALUES (1, 1, 30);
INSERT INTO `last_seen` (`id`, `user_id`, `message_id`) VALUES (2, 2, 32);


#
# TABLE STRUCTURE FOR: loan_comments
#

DROP TABLE IF EXISTS `loan_comments`;

CREATE TABLE `loan_comments` (
  `loan_comments_id` int(100) NOT NULL AUTO_INCREMENT,
  `loans_id` int(100) NOT NULL,
  `comment_code` int(5) NOT NULL COMMENT '1 = Reject Reason, 2 = Defer Reason',
  `comment` varchar(200) NOT NULL,
  `comment_by` int(10) NOT NULL,
  `next_action_date` date NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_comments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `loan_comments` (`loan_comments_id`, `loans_id`, `comment_code`, `comment`, `comment_by`, `next_action_date`, `stamp`) VALUES (1, 115, 1, 'Payslips and Employers letter missing', 1, '0000-00-00', '2016-08-28 19:39:32');
INSERT INTO `loan_comments` (`loan_comments_id`, `loans_id`, `comment_code`, `comment`, `comment_by`, `next_action_date`, `stamp`) VALUES (2, 115, 2, 'Funds Availability', 1, '2016-08-31', '2016-08-28 20:08:51');
INSERT INTO `loan_comments` (`loan_comments_id`, `loans_id`, `comment_code`, `comment`, `comment_by`, `next_action_date`, `stamp`) VALUES (3, 115, 1, 'Payslips and Employers letter missing not yet uploaded', 1, '0000-00-00', '2016-08-28 20:32:22');


#
# TABLE STRUCTURE FOR: loan_decline_reason
#

DROP TABLE IF EXISTS `loan_decline_reason`;

CREATE TABLE `loan_decline_reason` (
  `loan_decline_reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL,
  `loan_id` int(50) NOT NULL,
  `reason` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_decline_reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: loan_purpose
#

DROP TABLE IF EXISTS `loan_purpose`;

CREATE TABLE `loan_purpose` (
  `loan_purpose_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `loans_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  PRIMARY KEY (`loan_purpose_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (16, 'Land Purchase', 22, 550000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (17, 'School Fees', 22, 50000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (18, '', 25, 0);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (19, '', 113, 0);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (24, 'Land Purchase', 116, 600000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (25, 'Land Purchase', 117, 600000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (26, 'Land Purchase', 118, 600000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (27, 'Land Purchase', 119, 600000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (29, 'Land Purchase', 115, 600000);
INSERT INTO `loan_purpose` (`loan_purpose_id`, `name`, `loans_id`, `amount`) VALUES (33, 'Land', 17, 500000);


#
# TABLE STRUCTURE FOR: loan_security
#

DROP TABLE IF EXISTS `loan_security`;

CREATE TABLE `loan_security` (
  `loan_security_id` int(100) NOT NULL AUTO_INCREMENT,
  `loans_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  PRIMARY KEY (`loan_security_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (4, 22, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (5, 25, '1', 650000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (6, 113, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (11, 116, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (12, 117, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (13, 118, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (14, 119, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (16, 115, '1', 200000);
INSERT INTO `loan_security` (`loan_security_id`, `loans_id`, `name`, `amount`) VALUES (20, 17, '1', 295500);


#
# TABLE STRUCTURE FOR: loan_settings
#

DROP TABLE IF EXISTS `loan_settings`;

CREATE TABLE `loan_settings` (
  `loan_settings_id` int(100) NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(20) NOT NULL,
  `interest_rate` double NOT NULL,
  `guarantee_required` varchar(5) NOT NULL,
  `max_loan_life` int(5) NOT NULL,
  `loan_limit_by_amount` int(10) NOT NULL,
  `loan_limit_by_ratio` int(5) NOT NULL,
  `preferred_limit_setting` varchar(50) NOT NULL,
  `active` varchar(5) NOT NULL DEFAULT 'yes',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `loan_settings` (`loan_settings_id`, `loan_type`, `interest_rate`, `guarantee_required`, `max_loan_life`, `loan_limit_by_amount`, `loan_limit_by_ratio`, `preferred_limit_setting`, `active`, `timestamp`) VALUES (1, 'normal', '0.12', 'yes', 60, 0, 3, 'loan_limit_by_ratio', 'yes', '2016-08-18 22:15:04');
INSERT INTO `loan_settings` (`loan_settings_id`, `loan_type`, `interest_rate`, `guarantee_required`, `max_loan_life`, `loan_limit_by_amount`, `loan_limit_by_ratio`, `preferred_limit_setting`, `active`, `timestamp`) VALUES (2, 'emergency', '0.12', 'no', 12, 50000, 0, 'loan_limit_by_amount', 'yes', '2016-08-18 22:15:15');
INSERT INTO `loan_settings` (`loan_settings_id`, `loan_type`, `interest_rate`, `guarantee_required`, `max_loan_life`, `loan_limit_by_amount`, `loan_limit_by_ratio`, `preferred_limit_setting`, `active`, `timestamp`) VALUES (3, 'investment', '0.21', 'yes', 64, 0, 6, 'loan_limit_by_ratio', 'no', '2016-08-18 22:15:28');


#
# TABLE STRUCTURE FOR: loans
#

DROP TABLE IF EXISTS `loans`;

CREATE TABLE `loans` (
  `loans_id` int(100) NOT NULL AUTO_INCREMENT,
  `last_history_id` int(100) NOT NULL,
  `member_id` int(10) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `monthly_income` int(100) NOT NULL,
  `monthly_expenditure` int(100) NOT NULL,
  `loan_date` longtext NOT NULL,
  `proposed_date` date NOT NULL,
  `loan_type` varchar(20) NOT NULL,
  `details` longtext NOT NULL,
  `principle` decimal(10,2) NOT NULL DEFAULT '0.00',
  `top_up` decimal(10,2) NOT NULL DEFAULT '0.00',
  `repayment_period` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sched_pay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extra_pay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(10) NOT NULL DEFAULT 'new',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (14, 1, 10, '', '', '', '', '2016-11-05', 0, 0, '2016-05-11', '0000-00-00', 'normal', 'Personal', '350000.00', '0.00', 24, '0.12', '16475.72', '0.00', 'inactive', '2016-06-04 13:46:43');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (15, 2, 7, '', '', '', '', '2016-11-05', 0, 0, '2016-05-12', '0000-00-00', 'normal', 'Personal', '150000.00', '0.00', 24, '0.12', '7061.02', '0.00', 'inactive', '2016-06-04 13:46:49');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (16, 9, 7, '', '', '', '', '2016-11-05', 0, 0, '2016-05-18', '0000-00-00', 'normal', 'Home Finishing', '138420.03', '11000.00', 36, '0.12', '4597.53', '0.00', 'inactive', '2016-06-04 13:46:52');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (17, 10, 8, '4', 'Test', 'Tes', 'Tes', '2016-11-05', 160000, 120000, '2016-05-19', '2016-09-01', 'normal', 'Purchase of Land', '500000.00', '400000.00', 36, '0.12', '13914.60', '0.00', 'active', '2016-08-30 16:23:14');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (18, 0, 7, '', '', '', '', '2016-11-05', 0, 0, '', '0000-00-00', 'normal', 'Conversion', '280000.00', '0.00', 24, '0.12', '13180.57', '5000.00', 'active', '2016-06-04 15:10:47');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (19, 0, 10, '', '', '', '', '2016-11-05', 0, 0, '', '0000-00-00', 'normal', 'Conversion', '350000.00', '0.00', 24, '0.12', '16475.72', '0.00', 'active', '2016-06-04 13:47:03');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (20, 0, 12, '', '', '', '', '2016-11-05', 0, 0, '', '0000-00-00', 'normal', 'Personal', '350000.00', '0.00', 36, '0.12', '11625.01', '5000.00', 'active', '2016-06-04 13:47:07');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (21, 0, 13, '', '', '', '', '2016-06-06', 0, 0, '2016-06-06', '0000-00-00', 'normal', 'Conversion', '260000.00', '0.00', 24, '0.12', '10846.88', '0.00', 'active', '2016-06-06 22:39:26');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (108, 0, 11, '', '', '', '', '0000-00-00', 0, 0, '', '0000-00-00', '', '', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 'new', '2016-08-25 02:31:57');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (115, 0, 14, '287465354268', 'Charles Nthia', 'Barclays Bank', 'Ngong', '2016-08-29', 156000, 102000, '2016-08-29', '2016-09-01', 'normal', '', '600000.00', '0.00', 48, '0.12', '12530.65', '5600.00', 'active', '2016-08-29 23:56:20');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (122, 0, 14, '', '', '', '', '0000-00-00', 0, 0, '', '0000-00-00', '', '', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 'new', '2016-08-30 16:16:41');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (123, 0, 11, '', '', '', '', '0000-00-00', 0, 0, '', '0000-00-00', '', '', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 'new', '2016-08-30 16:17:26');
INSERT INTO `loans` (`loans_id`, `last_history_id`, `member_id`, `account_number`, `account_name`, `bank_name`, `branch_name`, `application_date`, `monthly_income`, `monthly_expenditure`, `loan_date`, `proposed_date`, `loan_type`, `details`, `principle`, `top_up`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (124, 0, 8, '4', 'Test', 'Tes', 'Tes', '0000-00-00', 160000, 120000, '', '2016-09-01', 'normal', '', '500000.00', '0.00', 36, '0.12', '13914.60', '0.00', 'new', '2016-08-30 16:23:14');


#
# TABLE STRUCTURE FOR: loans_history
#

DROP TABLE IF EXISTS `loans_history`;

CREATE TABLE `loans_history` (
  `loans_history_id` int(100) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `application_date` date NOT NULL,
  `loan_date` longtext NOT NULL,
  `loan_type` varchar(20) NOT NULL,
  `details` longtext NOT NULL,
  `principle` int(50) NOT NULL,
  `other_loans` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_loan` decimal(10,2) NOT NULL,
  `repayment_period` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sched_pay` decimal(10,2) NOT NULL,
  `extra_pay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(10) NOT NULL DEFAULT 'new',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loans_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (1, 10, '2016-11-05', '', 'normal', 'Personal', 350000, '0.00', '0.00', 24, '0.12', '16475.72', '0.00', 'submitted', '2016-06-04 13:47:19');
INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (2, 7, '2016-11-05', '', 'normal', 'Personal', 150000, '0.00', '0.00', 24, '0.12', '7061.02', '0.00', 'submitted', '2016-06-04 13:47:22');
INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (9, 7, '2016-11-05', '', 'normal', 'Home Finishing', 11000, '138822.35', '149822.35', 36, '0.12', '4976.25', '0.00', 'submitted', '2016-06-04 13:47:24');
INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (10, 8, '2016-11-05', '', 'normal', 'Purchase of Land', 400000, '0.00', '400000.00', 36, '0.12', '13285.72', '0.00', 'submitted', '2016-06-04 13:47:26');
INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (11, 7, '2016-06-10', '', 'normal', 'College Fees', 100000, '0.00', '0.00', 36, '0.12', '3321.43', '0.00', 'new', '2016-06-10 19:40:02');
INSERT INTO `loans_history` (`loans_history_id`, `member_id`, `application_date`, `loan_date`, `loan_type`, `details`, `principle`, `other_loans`, `total_loan`, `repayment_period`, `rate`, `sched_pay`, `extra_pay`, `status`, `timestamp`) VALUES (12, 8, '2016-11-05', '', 'emergency', 'School Fees', 30000, '0.00', '30000.00', 24, '0.12', '1412.20', '0.00', 'new', '2016-06-04 13:47:30');


#
# TABLE STRUCTURE FOR: message
#

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext NOT NULL,
  `message` longtext NOT NULL,
  `sender` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: message_thread
#

DROP TABLE IF EXISTS `message_thread`;

CREATE TABLE `message_thread` (
  `message_thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reciever` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: messages
#

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (1, 2, 1, 'Hello', '1', '2016-08-09 17:43:59');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (2, 1, 2, 'Fine Betty. How are you doing?', '1', '2016-08-09 17:44:19');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (3, 2, 1, 'Cool', '1', '2016-08-09 17:44:58');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (4, 1, 2, 'Karibu sana', '1', '2016-08-09 17:46:01');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (5, 2, 1, 'Are you done with the MFR?', '1', '2016-08-09 17:48:04');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (6, 1, 2, 'Yes. Mpaka nime submit', '1', '2016-08-09 17:48:27');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (7, 2, 1, 'Ni sawa', '1', '2016-08-09 17:50:24');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (8, 1, 2, 'Umeenda?', '1', '2016-08-09 17:53:25');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (9, 1, 2, 'Hey', '1', '2016-08-09 17:56:13');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (10, 2, 1, 'Yes', '1', '2016-08-09 17:56:31');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (11, 1, 2, 'Oops! I forgot this!', '1', '2016-08-09 17:58:34');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (12, 0, 1, 'What?', '0', '2016-08-09 17:59:09');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (13, 1, 2, 'Sema sasa!', '1', '2016-08-10 11:13:50');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (14, 2, 1, 'Niko poa!', '1', '2016-08-10 11:14:16');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (15, 1, 2, 'Cool', '1', '2016-08-10 11:14:35');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (16, 2, 1, 'Did u managed?', '1', '2016-08-10 11:14:56');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (17, 1, 2, 'Yes', '1', '2016-08-10 11:15:09');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (18, 2, 1, 'Fantastic', '1', '2016-08-10 11:15:59');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (19, 1, 2, ':-(', '1', '2016-08-12 11:55:40');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (20, 1, 2, ':-)', '1', '2016-08-12 11:55:49');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (21, 2, 1, ':-`', '1', '2016-08-12 11:56:20');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (22, 2, 1, ':-)\'', '1', '2016-08-12 11:56:32');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (23, 1, 2, ':-`', '1', '2016-08-12 11:58:49');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (24, 1, 2, ':-,', '1', '2016-08-12 11:59:03');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (25, 1, 2, ':-|', '1', '2016-08-12 11:59:18');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (26, 1, 2, ':-\\', '1', '2016-08-12 11:59:27');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (27, 2, 1, 'kiss', '1', '2016-08-12 12:05:10');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (28, 2, 1, ':kiss', '1', '2016-08-12 12:05:14');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (29, 1, 2, 'Hello', '1', '2016-08-12 12:43:19');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (30, 1, 1, 'Hey', '1', '2016-08-12 13:09:45');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (31, 1, 2, 'Hello', '1', '2016-08-12 15:11:01');
INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `time`) VALUES (32, 1, 2, 'See', '1', '2016-08-12 15:11:26');


#
# TABLE STRUCTURE FOR: noticeboard
#

DROP TABLE IF EXISTS `noticeboard`;

CREATE TABLE `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: position_in_sacco
#

DROP TABLE IF EXISTS `position_in_sacco`;

CREATE TABLE `position_in_sacco` (
  `position_in_sacco_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`position_in_sacco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `position_in_sacco` (`position_in_sacco_id`, `name`) VALUES (1, 'Member');
INSERT INTO `position_in_sacco` (`position_in_sacco_id`, `name`) VALUES (2, 'Official');


#
# TABLE STRUCTURE FOR: repayment
#

DROP TABLE IF EXISTS `repayment`;

CREATE TABLE `repayment` (
  `repayment_id` int(100) NOT NULL AUTO_INCREMENT,
  `pmt` int(5) NOT NULL DEFAULT '0',
  `loans_id` int(100) NOT NULL,
  `repayment_date` date NOT NULL,
  `beg_bal` decimal(10,2) NOT NULL,
  `sched_pay` decimal(10,2) NOT NULL,
  `extra_pay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `princ` decimal(10,2) NOT NULL,
  `intr` decimal(10,2) NOT NULL,
  `end_bal` decimal(10,2) NOT NULL,
  `approval` varchar(10) NOT NULL DEFAULT 'pending',
  `transacted` varchar(10) NOT NULL DEFAULT 'No',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`repayment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (1, 1, 14, '2014-04-04', '350000.00', '16475.72', '0.00', '12975.72', '3500.00', '337024.28', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (2, 2, 14, '2014-04-04', '337024.28', '16475.72', '0.00', '13105.48', '3370.24', '323918.80', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (3, 3, 14, '2014-04-04', '323918.80', '16475.72', '0.00', '13236.53', '3239.19', '310682.27', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (4, 4, 14, '2015-04-04', '310682.27', '16475.72', '14000.00', '27368.90', '3106.82', '283313.37', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (5, 5, 14, '2015-05-04', '283313.37', '16475.72', '0.00', '13642.59', '2833.13', '269670.78', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (6, 6, 14, '2015-05-04', '269670.78', '16475.72', '50000.00', '63779.01', '2696.71', '205891.77', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (9, 7, 14, '2016-05-04', '205891.77', '16475.72', '0.00', '14416.80', '2058.92', '191474.97', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (10, 8, 14, '2016-05-04', '191474.97', '16475.72', '15000.00', '29560.97', '1914.75', '161914.00', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (11, 9, 14, '2016-05-04', '161914.00', '16475.72', '0.00', '14856.58', '1619.14', '147057.42', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (25, 10, 14, '2016-05-04', '147057.42', '16475.72', '130000.00', '145005.15', '1470.57', '2052.27', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (28, 1, 15, '2016-05-04', '150000.00', '7061.02', '0.00', '5561.02', '1500.00', '144438.98', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (29, 2, 15, '2016-05-04', '144438.98', '7061.02', '0.00', '5616.63', '1444.39', '138822.35', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (30, 3, 15, '2016-05-04', '138822.35', '7061.02', '0.00', '5672.80', '1388.22', '133149.55', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (31, 4, 15, '2016-06-04', '133149.55', '7061.02', '0.00', '5729.52', '1331.50', '127420.03', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (32, 1, 16, '2016-06-04', '138420.03', '4597.53', '0.00', '3213.33', '1384.20', '135206.70', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (33, 2, 16, '2016-06-04', '135206.70', '4597.53', '125000.00', '128245.46', '1352.07', '6961.24', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (40, 3, 16, '2016-06-04', '6961.24', '4597.53', '0.00', '4527.92', '69.61', '2433.32', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (41, 11, 14, '2016-06-04', '2052.27', '2072.79', '0.00', '2052.27', '20.52', '0.00', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (42, 1, 17, '2016-06-04', '400000.00', '13285.72', '0.00', '9285.72', '4000.00', '390714.28', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (43, 2, 17, '2016-06-04', '390714.28', '13285.72', '16000.00', '25378.58', '3907.14', '365335.70', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (44, 3, 17, '2016-06-04', '365335.70', '13285.72', '0.00', '9632.36', '3653.36', '355703.34', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (45, 4, 17, '2016-06-04', '355703.34', '13285.72', '0.00', '9728.69', '3557.03', '345974.65', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (46, 5, 17, '2016-06-04', '345974.65', '13285.72', '75000.00', '84825.97', '3459.75', '261148.68', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (47, 6, 17, '2016-06-04', '261148.68', '13285.72', '0.00', '10674.23', '2611.49', '250474.45', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (48, 7, 17, '2016-06-04', '250474.45', '13285.72', '0.00', '10780.98', '2504.74', '239693.47', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (51, 8, 17, '2016-06-04', '239693.47', '13285.72', '45000.00', '55888.79', '2396.93', '183804.68', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (52, 4, 16, '2016-06-04', '2433.32', '2457.65', '0.00', '2433.32', '24.33', '0.00', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (53, 9, 17, '2016-06-04', '183804.68', '13285.72', '0.00', '11447.67', '1838.05', '172357.01', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (54, 10, 17, '2016-06-04', '172357.01', '13285.72', '45000.00', '56562.15', '1723.57', '115794.86', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (61, 11, 17, '2016-06-04', '115794.86', '13285.72', '10000.00', '22127.77', '1157.95', '93667.09', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (62, 12, 17, '2016-07-04', '93667.09', '13285.72', '10000.00', '22349.05', '936.67', '71318.04', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (63, 13, 17, '2016-07-04', '71318.04', '13285.72', '5000.00', '17572.54', '713.18', '53745.50', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (127, 1, 20, '2016-07-04', '350000.00', '11625.01', '5000.00', '13125.01', '3500.00', '336874.99', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (128, 2, 20, '2016-07-04', '336874.99', '11625.01', '5000.00', '13256.26', '3368.75', '323618.73', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (159, 14, 17, '2016-07-04', '53745.50', '13285.72', '5000.00', '17748.27', '537.46', '35997.24', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (160, 1, 18, '2016-08-10', '280000.00', '13180.57', '5000.00', '15380.57', '2800.00', '264619.43', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (161, 2, 18, '2016-08-08', '264619.43', '13180.57', '5000.00', '15534.38', '2646.19', '249085.05', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (162, 15, 17, '2016-08-29', '35997.23', '13285.72', '5000.00', '17925.75', '359.97', '18071.48', 'approved', 'Yes', '2016-08-30 15:04:28');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (163, 16, 17, '2016-08-30', '118071.48', '13914.60', '0.00', '12733.89', '1180.71', '105337.59', 'approved', 'No', '2016-08-30 21:28:10');
INSERT INTO `repayment` (`repayment_id`, `pmt`, `loans_id`, `repayment_date`, `beg_bal`, `sched_pay`, `extra_pay`, `princ`, `intr`, `end_bal`, `approval`, `transacted`, `timestamp`) VALUES (164, 1, 115, '2016-08-30', '600000.00', '12530.65', '5600.00', '12130.65', '6000.00', '587869.35', 'approved', 'No', '2016-08-30 21:30:33');


#
# TABLE STRUCTURE FOR: security
#

DROP TABLE IF EXISTS `security`;

CREATE TABLE `security` (
  `security_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`security_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `security` (`security_id`, `name`) VALUES (1, 'Shares');
INSERT INTO `security` (`security_id`, `name`) VALUES (2, 'Land');
INSERT INTO `security` (`security_id`, `name`) VALUES (3, 'Car');
INSERT INTO `security` (`security_id`, `name`) VALUES (4, 'House');


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (1, 'system_name', 'Compasco Sacco Ltd');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (2, 'system_title', 'Compasco');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (3, 'address', 'Karen');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (4, 'phone', '0711808071');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (5, 'paypal_email', 'admin@compassionkenya.com');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (6, 'currency', 'Kes.');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (7, 'system_email', 'admin@compassionkenya.com');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (20, 'active_sms_service', 'disabled');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (11, 'language', 'english');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (12, 'text_align', 'left-to-right');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (13, 'clickatell_user', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (14, 'clickatell_password', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (15, 'clickatell_api_id', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (16, 'skin_colour', 'black');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (17, 'twilio_account_sid', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (18, 'twilio_auth_token', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (19, 'twilio_sender_phone_number', '');


#
# TABLE STRUCTURE FOR: share_rate
#

DROP TABLE IF EXISTS `share_rate`;

CREATE TABLE `share_rate` (
  `share_rate_id` int(100) NOT NULL AUTO_INCREMENT,
  `member_id` int(100) NOT NULL,
  `monthly_share_rate` int(100) NOT NULL,
  `approved` varchar(10) NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`share_rate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (1, 7, 20000, 'approved', '2016-05-10 21:03:54');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (2, 10, 28500, 'approved', '2016-05-10 21:03:59');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (3, 8, 25000, 'approved', '2016-05-31 11:45:43');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (4, 9, 25000, 'approved', '2016-05-10 21:04:22');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (5, 11, 15000, 'approved', '2016-05-29 15:17:10');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (6, 12, 10000, 'approved', '2016-06-03 13:26:55');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (7, 13, 8000, 'approved', '2016-06-04 13:55:10');
INSERT INTO `share_rate` (`share_rate_id`, `member_id`, `monthly_share_rate`, `approved`, `timestamp`) VALUES (8, 14, 8000, 'approved', '2016-06-13 21:24:19');


#
# TABLE STRUCTURE FOR: shares
#

DROP TABLE IF EXISTS `shares`;

CREATE TABLE `shares` (
  `shares_id` int(100) NOT NULL AUTO_INCREMENT,
  `member_id` int(100) NOT NULL,
  `details` longtext NOT NULL,
  `amount` int(100) NOT NULL,
  `sharemonth` date NOT NULL,
  `transacted` varchar(5) NOT NULL DEFAULT 'No',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shares_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (3, 7, 'Share contribution for February 2016', 75000, '2014-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (4, 7, 'Share contribution for April 2016', 65000, '2014-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (5, 8, 'Share contribution for March 2016', 18500, '2014-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (6, 10, 'Bulk share contribution', 75000, '2015-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (7, 9, 'FY16 Contribution', 125600, '2015-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (8, 10, 'Bulk share contribution', 460000, '2015-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (9, 10, 'Additional Shares', 33000, '2015-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (10, 8, 'May 2016', 12000, '2015-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (11, 9, 'May 2016', 25000, '2016-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (12, 8, 'Additional Shares', 215000, '2016-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (13, 8, 'June 2016', 25000, '2016-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (14, 8, 'June 2016', 25000, '2016-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (19, 11, 'June 2016', 650000, '2016-05-02', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (20, 13, 'June 2016', 8000, '2016-06-06', 'Yes', '2016-08-30 14:48:57');
INSERT INTO `shares` (`shares_id`, `member_id`, `details`, `amount`, `sharemonth`, `transacted`, `timestamp`) VALUES (21, 14, 'July 2016', 200000, '2016-06-10', 'Yes', '2016-08-30 14:48:57');


#
# TABLE STRUCTURE FOR: student
#

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_number` int(20) NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(5) NOT NULL,
  `position_employed` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `terms_of_service` int(5) NOT NULL,
  `membershipdate` date NOT NULL,
  `position_in_sacco` int(5) NOT NULL,
  `active` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `withdrawaldate` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (7, 'Nicodemus Karisa', '1983-12-22', 'male', '80 00502 Malindi', 0, '0711808072', 'nkarisa1983@gmail.com', '@Compassion123', 'CCS056', 7, '', '', 0, '2016-02-18', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (8, 'James Mulandi', '1979-06-12', 'male', '1945 Karen', 0, '0720648480', 'jmulandi1@gmail.com', '@Compassion123', 'CCS048', 5, '', '', 0, '2016-02-23', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (9, 'Joyce Cherono', '1985-08-08', 'female', '1945 Karen', 0, '0723654321', 'JCherono@ke.ci.org', '@Compassion123\n', 'CCS045', 0, '', '', 0, '2016-02-23', 0, 'no', '18/05/2016', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (10, 'Leah Bett', '1978-07-11', 'female', '1945 Karen', 0, '0723763489', 'lbett2001@gmail.com', '@Compassion123', 'CCS017', 5, '', '', 0, '2016-02-23', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (11, 'Esther Nganga', '1965-08-02', 'female', '1945 Karen', 0, '0720648488', 'enganga@gmail.com', '@Compassion123', 'CCS020', 7, '', '', 0, '2016-02-23', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (12, 'Peter Mutuku', '1981-02-03', '', '1945 Karen', 0, '0720648489', 'pmutuku@ke.ci.org', '123456789', 'CC078', 6, '', '', 0, '2016-02-23', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (13, 'Elly Chengo', '1986-10-14', 'male', '1945 Karen', 0, '0720648488', 'EChengo@ke.ci.org', '123456789', 'CC088', 5, '', '', 0, '2016-02-07', 0, 'yes', '', '');
INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `address`, `id_number`, `phone`, `email`, `password`, `roll`, `department_id`, `position_employed`, `payroll_number`, `terms_of_service`, `membershipdate`, `position_in_sacco`, `active`, `withdrawaldate`, `authentication_key`) VALUES (14, 'Charles N Nthia', '2016-06-13', 'male', '1945 Karen', 23353108, '0720255973', 'cnithia@gmail.com', '123456789', 'CC094', 7, 'Trainer', 'KE645', 1, '2013-05-28', 1, 'yes', '', '');


#
# TABLE STRUCTURE FOR: system
#

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `system_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `set_to` varchar(50) NOT NULL,
  PRIMARY KEY (`system_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `system` (`system_id`, `name`, `set_to`) VALUES (1, 'self_guaranteeing', 'no');


#
# TABLE STRUCTURE FOR: terms_of_service
#

DROP TABLE IF EXISTS `terms_of_service`;

CREATE TABLE `terms_of_service` (
  `terms_of_service_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`terms_of_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `terms_of_service` (`terms_of_service_id`, `name`) VALUES (1, 'Permanent');
INSERT INTO `terms_of_service` (`terms_of_service_id`, `name`) VALUES (2, 'Contract');
INSERT INTO `terms_of_service` (`terms_of_service_id`, `name`) VALUES (3, 'Volunteer');


#
# TABLE STRUCTURE FOR: transaction
#

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `transaction_id` int(100) NOT NULL AUTO_INCREMENT,
  `transaction_header_id` int(10) NOT NULL,
  `transaction_type_id` int(100) NOT NULL,
  `amount` int(20) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (1, 1, 3, 75000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (2, 1, 4, 65000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (3, 1, 5, 18500, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (4, 1, 6, 75000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (5, 1, 7, 125600, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (6, 1, 8, 460000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (7, 1, 9, 33000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (8, 1, 10, 12000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (9, 1, 11, 25000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (10, 1, 12, 215000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (11, 1, 13, 25000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (12, 1, 14, 25000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (13, 1, 19, 650000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (14, 1, 20, 8000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (15, 1, 21, 200000, '2016-08-30 14:48:57');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (16, 3, 1, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (17, 3, 2, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (18, 3, 3, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (19, 3, 4, 30476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (20, 3, 5, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (21, 3, 6, 66476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (22, 3, 9, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (23, 3, 10, 31476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (24, 3, 11, 16476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (25, 3, 25, 146476, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (26, 3, 28, 7061, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (27, 3, 29, 7061, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (28, 3, 30, 7061, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (29, 3, 31, 7061, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (30, 3, 32, 4598, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (31, 3, 33, 129598, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (32, 3, 40, 4598, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (33, 3, 41, 2073, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (34, 3, 42, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (35, 3, 43, 29286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (36, 3, 44, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (37, 3, 45, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (38, 3, 46, 88286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (39, 3, 47, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (40, 3, 48, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (41, 3, 51, 58286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (42, 3, 52, 2458, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (43, 3, 53, 13286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (44, 3, 54, 58286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (45, 3, 61, 23286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (46, 3, 62, 23286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (47, 3, 63, 18286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (48, 3, 127, 16625, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (49, 3, 128, 16625, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (50, 3, 159, 18286, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (51, 3, 160, 18181, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (52, 3, 161, 18181, '2016-08-30 15:04:28');
INSERT INTO `transaction` (`transaction_id`, `transaction_header_id`, `transaction_type_id`, `amount`, `stamp`) VALUES (53, 3, 162, 18286, '2016-08-30 15:04:28');


#
# TABLE STRUCTURE FOR: transaction_header
#

DROP TABLE IF EXISTS `transaction_header`;

CREATE TABLE `transaction_header` (
  `transaction_header_id` int(100) NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(50) NOT NULL,
  `account` varchar(50) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_header_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `transaction_header` (`transaction_header_id`, `transaction_type`, `account`, `stamp`) VALUES (1, 'shares', 'CR', '2016-08-30 14:48:57');
INSERT INTO `transaction_header` (`transaction_header_id`, `transaction_type`, `account`, `stamp`) VALUES (3, 'repayment', 'CR', '2016-08-30 15:04:28');


