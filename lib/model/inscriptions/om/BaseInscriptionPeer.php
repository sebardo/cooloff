<?php


abstract class BaseInscriptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'inscription';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.Inscription';

	
	const NUM_COLUMNS = 68;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'inscription.ID';

	
	const CREATED_AT = 'inscription.CREATED_AT';

	
	const INSCRIPTION_CODE = 'inscription.INSCRIPTION_CODE';

	
	const STUDENT_NAME = 'inscription.STUDENT_NAME';

	
	const STUDENT_PRIMER_APELLIDO = 'inscription.STUDENT_PRIMER_APELLIDO';

	
	const STUDENT_SEGUNDO_APELLIDO = 'inscription.STUDENT_SEGUNDO_APELLIDO';

	
	const STUDENT_BIRTH_DATE = 'inscription.STUDENT_BIRTH_DATE';

	
	const STUDENT_ADDRESS = 'inscription.STUDENT_ADDRESS';

	
	const STUDENT_ZIP = 'inscription.STUDENT_ZIP';

	
	const STUDENT_CITY = 'inscription.STUDENT_CITY';

	
	const STUDENT_SCHOOL_YEAR = 'inscription.STUDENT_SCHOOL_YEAR';

	
	const STUDENT_FRIENDS = 'inscription.STUDENT_FRIENDS';

	
	const IS_STUDENT_DISABILITY = 'inscription.IS_STUDENT_DISABILITY';

	
	const STUDENT_DISABILITY = 'inscription.STUDENT_DISABILITY';

	
	const STUDENT_ALLERGIES = 'inscription.STUDENT_ALLERGIES';

	
	const STUDENT_ALLERGIES_DESCRIPTION = 'inscription.STUDENT_ALLERGIES_DESCRIPTION';

	
	const FATHER_NAME = 'inscription.FATHER_NAME';

	
	const FATHER_PRIMER_APELLIDO = 'inscription.FATHER_PRIMER_APELLIDO';

	
	const FATHER_SEGUNDO_APELLIDO = 'inscription.FATHER_SEGUNDO_APELLIDO';

	
	const FATHER_PHONE = 'inscription.FATHER_PHONE';

	
	const FATHER_DNI = 'inscription.FATHER_DNI';

	
	const FATHER_MAIL = 'inscription.FATHER_MAIL';

	
	const STATE = 'inscription.STATE';

	
	const IS_FATHER_MAIL_MAIN = 'inscription.IS_FATHER_MAIL_MAIN';

	
	const MOTHER_NAME = 'inscription.MOTHER_NAME';

	
	const MOTHER_PRIMER_APELLIDO = 'inscription.MOTHER_PRIMER_APELLIDO';

	
	const MOTHER_SEGUNDO_APELLIDO = 'inscription.MOTHER_SEGUNDO_APELLIDO';

	
	const MOTHER_PHONE = 'inscription.MOTHER_PHONE';

	
	const MOTHER_DNI = 'inscription.MOTHER_DNI';

	
	const MOTHER_MAIL = 'inscription.MOTHER_MAIL';

	
	const IS_MOTHER_MAIL_MAIN = 'inscription.IS_MOTHER_MAIL_MAIN';

	
	const SPLIT_PAYMENT = 'inscription.SPLIT_PAYMENT';

	
	const BECA = 'inscription.BECA';

	
	const STUDENT_COURSE_INSCRIPTION = 'inscription.STUDENT_COURSE_INSCRIPTION';

	
	const IS_PAID = 'inscription.IS_PAID';

	
	const METHOD_PAYMENT = 'inscription.METHOD_PAYMENT';

	
	const STUDENT_PROVINCIA = 'inscription.STUDENT_PROVINCIA';

	
	const STUDENT_NUM_TARJETA_SANITARIA = 'inscription.STUDENT_NUM_TARJETA_SANITARIA';

	
	const STUDENT_TARJETA_SANITARIA_COMPANYIA = 'inscription.STUDENT_TARJETA_SANITARIA_COMPANYIA';

	
	const IS_STUDENT_KID_AND_US = 'inscription.IS_STUDENT_KID_AND_US';

	
	const STUDENT_DISABILITY_LEVEL = 'inscription.STUDENT_DISABILITY_LEVEL';

	
	const STUDENT_COMMENTS = 'inscription.STUDENT_COMMENTS';

	
	const GRUPO_ID = 'inscription.GRUPO_ID';

	
	const STUDENT_EXCURSION = 'inscription.STUDENT_EXCURSION';

	
	const PRICE = 'inscription.PRICE';

	
	const DISCOUNT = 'inscription.DISCOUNT';

	
	const DISCOUNTPERCENT = 'inscription.DISCOUNTPERCENT';

	
	const STUDENT_PHOTO = 'inscription.STUDENT_PHOTO';

	
	const INSCRIPTION_NUM = 'inscription.INSCRIPTION_NUM';

	
	const CUSTOM_QUESTION = 'inscription.CUSTOM_QUESTION';

	
	const CUSTOM_QUESTION_ANSWER = 'inscription.CUSTOM_QUESTION_ANSWER';

	
	const AMOUNT_BECA = 'inscription.AMOUNT_BECA';

	
	const AMOUNT_FIRST_PAYMENT = 'inscription.AMOUNT_FIRST_PAYMENT';

	
	const AMOUNT_SECOND_PAYMENT = 'inscription.AMOUNT_SECOND_PAYMENT';

	
	const PAYMENT_DATE = 'inscription.PAYMENT_DATE';

	
	const CERTIFICATED = 'inscription.CERTIFICATED';

	
	const CERTIFICATEDNAME = 'inscription.CERTIFICATEDNAME';

	
	const TPV_SUFFIX = 'inscription.TPV_SUFFIX';

	
	const TPV_FIRST_PAYMENT_RESPONSE = 'inscription.TPV_FIRST_PAYMENT_RESPONSE';

	
	const TPV_SECOND_PAYMENT_RESPONSE = 'inscription.TPV_SECOND_PAYMENT_RESPONSE';

	
	const CULTURE = 'inscription.CULTURE';

	
	const IS_PAYMENT_REMINDER_SENT = 'inscription.IS_PAYMENT_REMINDER_SENT';

	
	const KIDS_AND_US_CENTER_ID = 'inscription.KIDS_AND_US_CENTER_ID';

	
	const LAST_COOLOFF_YEAR = 'inscription.LAST_COOLOFF_YEAR';

	
	const EMAIL_CONFIRMATION_SENT = 'inscription.EMAIL_CONFIRMATION_SENT';

	
	const STUDENT_MEDS = 'inscription.STUDENT_MEDS';

	
	const STUDENT_MEDS_DESCRIPTION = 'inscription.STUDENT_MEDS_DESCRIPTION';

	
	const IS_VACCINATED = 'inscription.IS_VACCINATED';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'InscriptionCode', 'StudentName', 'StudentPrimerApellido', 'StudentSegundoApellido', 'StudentBirthDate', 'StudentAddress', 'StudentZip', 'StudentCity', 'StudentSchoolYear', 'StudentFriends', 'IsStudentDisability', 'StudentDisability', 'StudentAllergies', 'StudentAllergiesDescription', 'FatherName', 'FatherPrimerApellido', 'FatherSegundoApellido', 'FatherPhone', 'FatherDni', 'FatherMail', 'State', 'IsFatherMailMain', 'MotherName', 'MotherPrimerApellido', 'MotherSegundoApellido', 'MotherPhone', 'MotherDni', 'MotherMail', 'IsMotherMailMain', 'SplitPayment', 'Beca', 'StudentCourseInscription', 'IsPaid', 'MethodPayment', 'StudentProvincia', 'StudentNumTarjetaSanitaria', 'StudentTarjetaSanitariaCompanyia', 'IsStudentKidAndUs', 'StudentDisabilityLevel', 'StudentComments', 'GrupoId', 'StudentExcursion', 'Price', 'Discount', 'Discountpercent', 'StudentPhoto', 'InscriptionNum', 'CustomQuestion', 'CustomQuestionAnswer', 'AmountBeca', 'AmountFirstPayment', 'AmountSecondPayment', 'PaymentDate', 'Certificated', 'Certificatedname', 'TpvSuffix', 'TpvFirstPaymentResponse', 'TpvSecondPaymentResponse', 'Culture', 'IsPaymentReminderSent', 'KidsAndUsCenterId', 'LastCooloffYear', 'EmailConfirmationSent', 'StudentMeds', 'StudentMedsDescription', 'IsVaccinated', ),
		BasePeer::TYPE_COLNAME => array (InscriptionPeer::ID, InscriptionPeer::CREATED_AT, InscriptionPeer::INSCRIPTION_CODE, InscriptionPeer::STUDENT_NAME, InscriptionPeer::STUDENT_PRIMER_APELLIDO, InscriptionPeer::STUDENT_SEGUNDO_APELLIDO, InscriptionPeer::STUDENT_BIRTH_DATE, InscriptionPeer::STUDENT_ADDRESS, InscriptionPeer::STUDENT_ZIP, InscriptionPeer::STUDENT_CITY, InscriptionPeer::STUDENT_SCHOOL_YEAR, InscriptionPeer::STUDENT_FRIENDS, InscriptionPeer::IS_STUDENT_DISABILITY, InscriptionPeer::STUDENT_DISABILITY, InscriptionPeer::STUDENT_ALLERGIES, InscriptionPeer::STUDENT_ALLERGIES_DESCRIPTION, InscriptionPeer::FATHER_NAME, InscriptionPeer::FATHER_PRIMER_APELLIDO, InscriptionPeer::FATHER_SEGUNDO_APELLIDO, InscriptionPeer::FATHER_PHONE, InscriptionPeer::FATHER_DNI, InscriptionPeer::FATHER_MAIL, InscriptionPeer::STATE, InscriptionPeer::IS_FATHER_MAIL_MAIN, InscriptionPeer::MOTHER_NAME, InscriptionPeer::MOTHER_PRIMER_APELLIDO, InscriptionPeer::MOTHER_SEGUNDO_APELLIDO, InscriptionPeer::MOTHER_PHONE, InscriptionPeer::MOTHER_DNI, InscriptionPeer::MOTHER_MAIL, InscriptionPeer::IS_MOTHER_MAIL_MAIN, InscriptionPeer::SPLIT_PAYMENT, InscriptionPeer::BECA, InscriptionPeer::STUDENT_COURSE_INSCRIPTION, InscriptionPeer::IS_PAID, InscriptionPeer::METHOD_PAYMENT, InscriptionPeer::STUDENT_PROVINCIA, InscriptionPeer::STUDENT_NUM_TARJETA_SANITARIA, InscriptionPeer::STUDENT_TARJETA_SANITARIA_COMPANYIA, InscriptionPeer::IS_STUDENT_KID_AND_US, InscriptionPeer::STUDENT_DISABILITY_LEVEL, InscriptionPeer::STUDENT_COMMENTS, InscriptionPeer::GRUPO_ID, InscriptionPeer::STUDENT_EXCURSION, InscriptionPeer::PRICE, InscriptionPeer::DISCOUNT, InscriptionPeer::DISCOUNTPERCENT, InscriptionPeer::STUDENT_PHOTO, InscriptionPeer::INSCRIPTION_NUM, InscriptionPeer::CUSTOM_QUESTION, InscriptionPeer::CUSTOM_QUESTION_ANSWER, InscriptionPeer::AMOUNT_BECA, InscriptionPeer::AMOUNT_FIRST_PAYMENT, InscriptionPeer::AMOUNT_SECOND_PAYMENT, InscriptionPeer::PAYMENT_DATE, InscriptionPeer::CERTIFICATED, InscriptionPeer::CERTIFICATEDNAME, InscriptionPeer::TPV_SUFFIX, InscriptionPeer::TPV_FIRST_PAYMENT_RESPONSE, InscriptionPeer::TPV_SECOND_PAYMENT_RESPONSE, InscriptionPeer::CULTURE, InscriptionPeer::IS_PAYMENT_REMINDER_SENT, InscriptionPeer::KIDS_AND_US_CENTER_ID, InscriptionPeer::LAST_COOLOFF_YEAR, InscriptionPeer::EMAIL_CONFIRMATION_SENT, InscriptionPeer::STUDENT_MEDS, InscriptionPeer::STUDENT_MEDS_DESCRIPTION, InscriptionPeer::IS_VACCINATED, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'inscription_code', 'student_name', 'student_primer_apellido', 'student_segundo_apellido', 'student_birth_date', 'student_address', 'student_zip', 'student_city', 'student_school_year', 'student_friends', 'is_student_disability', 'student_disability', 'student_allergies', 'student_allergies_description', 'father_name', 'father_primer_apellido', 'father_segundo_apellido', 'father_phone', 'father_dni', 'father_mail', 'state', 'is_father_mail_main', 'mother_name', 'mother_primer_apellido', 'mother_segundo_apellido', 'mother_phone', 'mother_dni', 'mother_mail', 'is_mother_mail_main', 'split_payment', 'beca', 'student_course_inscription', 'is_paid', 'method_payment', 'student_provincia', 'student_num_tarjeta_sanitaria', 'student_tarjeta_sanitaria_companyia', 'is_student_kid_and_us', 'student_disability_level', 'student_comments', 'grupo_id', 'student_excursion', 'price', 'discount', 'discountPercent', 'student_photo', 'inscription_num', 'custom_question', 'custom_question_answer', 'amount_beca', 'amount_first_payment', 'amount_second_payment', 'payment_date', 'certificated', 'certificatedName', 'tpv_suffix', 'tpv_first_payment_response', 'tpv_second_payment_response', 'culture', 'is_payment_reminder_sent', 'kids_and_us_center_id', 'last_cooloff_year', 'email_confirmation_sent', 'student_meds', 'student_meds_description', 'is_vaccinated', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'InscriptionCode' => 2, 'StudentName' => 3, 'StudentPrimerApellido' => 4, 'StudentSegundoApellido' => 5, 'StudentBirthDate' => 6, 'StudentAddress' => 7, 'StudentZip' => 8, 'StudentCity' => 9, 'StudentSchoolYear' => 10, 'StudentFriends' => 11, 'IsStudentDisability' => 12, 'StudentDisability' => 13, 'StudentAllergies' => 14, 'StudentAllergiesDescription' => 15, 'FatherName' => 16, 'FatherPrimerApellido' => 17, 'FatherSegundoApellido' => 18, 'FatherPhone' => 19, 'FatherDni' => 20, 'FatherMail' => 21, 'State' => 22, 'IsFatherMailMain' => 23, 'MotherName' => 24, 'MotherPrimerApellido' => 25, 'MotherSegundoApellido' => 26, 'MotherPhone' => 27, 'MotherDni' => 28, 'MotherMail' => 29, 'IsMotherMailMain' => 30, 'SplitPayment' => 31, 'Beca' => 32, 'StudentCourseInscription' => 33, 'IsPaid' => 34, 'MethodPayment' => 35, 'StudentProvincia' => 36, 'StudentNumTarjetaSanitaria' => 37, 'StudentTarjetaSanitariaCompanyia' => 38, 'IsStudentKidAndUs' => 39, 'StudentDisabilityLevel' => 40, 'StudentComments' => 41, 'GrupoId' => 42, 'StudentExcursion' => 43, 'Price' => 44, 'Discount' => 45, 'Discountpercent' => 46, 'StudentPhoto' => 47, 'InscriptionNum' => 48, 'CustomQuestion' => 49, 'CustomQuestionAnswer' => 50, 'AmountBeca' => 51, 'AmountFirstPayment' => 52, 'AmountSecondPayment' => 53, 'PaymentDate' => 54, 'Certificated' => 55, 'Certificatedname' => 56, 'TpvSuffix' => 57, 'TpvFirstPaymentResponse' => 58, 'TpvSecondPaymentResponse' => 59, 'Culture' => 60, 'IsPaymentReminderSent' => 61, 'KidsAndUsCenterId' => 62, 'LastCooloffYear' => 63, 'EmailConfirmationSent' => 64, 'StudentMeds' => 65, 'StudentMedsDescription' => 66, 'IsVaccinated' => 67, ),
		BasePeer::TYPE_COLNAME => array (InscriptionPeer::ID => 0, InscriptionPeer::CREATED_AT => 1, InscriptionPeer::INSCRIPTION_CODE => 2, InscriptionPeer::STUDENT_NAME => 3, InscriptionPeer::STUDENT_PRIMER_APELLIDO => 4, InscriptionPeer::STUDENT_SEGUNDO_APELLIDO => 5, InscriptionPeer::STUDENT_BIRTH_DATE => 6, InscriptionPeer::STUDENT_ADDRESS => 7, InscriptionPeer::STUDENT_ZIP => 8, InscriptionPeer::STUDENT_CITY => 9, InscriptionPeer::STUDENT_SCHOOL_YEAR => 10, InscriptionPeer::STUDENT_FRIENDS => 11, InscriptionPeer::IS_STUDENT_DISABILITY => 12, InscriptionPeer::STUDENT_DISABILITY => 13, InscriptionPeer::STUDENT_ALLERGIES => 14, InscriptionPeer::STUDENT_ALLERGIES_DESCRIPTION => 15, InscriptionPeer::FATHER_NAME => 16, InscriptionPeer::FATHER_PRIMER_APELLIDO => 17, InscriptionPeer::FATHER_SEGUNDO_APELLIDO => 18, InscriptionPeer::FATHER_PHONE => 19, InscriptionPeer::FATHER_DNI => 20, InscriptionPeer::FATHER_MAIL => 21, InscriptionPeer::STATE => 22, InscriptionPeer::IS_FATHER_MAIL_MAIN => 23, InscriptionPeer::MOTHER_NAME => 24, InscriptionPeer::MOTHER_PRIMER_APELLIDO => 25, InscriptionPeer::MOTHER_SEGUNDO_APELLIDO => 26, InscriptionPeer::MOTHER_PHONE => 27, InscriptionPeer::MOTHER_DNI => 28, InscriptionPeer::MOTHER_MAIL => 29, InscriptionPeer::IS_MOTHER_MAIL_MAIN => 30, InscriptionPeer::SPLIT_PAYMENT => 31, InscriptionPeer::BECA => 32, InscriptionPeer::STUDENT_COURSE_INSCRIPTION => 33, InscriptionPeer::IS_PAID => 34, InscriptionPeer::METHOD_PAYMENT => 35, InscriptionPeer::STUDENT_PROVINCIA => 36, InscriptionPeer::STUDENT_NUM_TARJETA_SANITARIA => 37, InscriptionPeer::STUDENT_TARJETA_SANITARIA_COMPANYIA => 38, InscriptionPeer::IS_STUDENT_KID_AND_US => 39, InscriptionPeer::STUDENT_DISABILITY_LEVEL => 40, InscriptionPeer::STUDENT_COMMENTS => 41, InscriptionPeer::GRUPO_ID => 42, InscriptionPeer::STUDENT_EXCURSION => 43, InscriptionPeer::PRICE => 44, InscriptionPeer::DISCOUNT => 45, InscriptionPeer::DISCOUNTPERCENT => 46, InscriptionPeer::STUDENT_PHOTO => 47, InscriptionPeer::INSCRIPTION_NUM => 48, InscriptionPeer::CUSTOM_QUESTION => 49, InscriptionPeer::CUSTOM_QUESTION_ANSWER => 50, InscriptionPeer::AMOUNT_BECA => 51, InscriptionPeer::AMOUNT_FIRST_PAYMENT => 52, InscriptionPeer::AMOUNT_SECOND_PAYMENT => 53, InscriptionPeer::PAYMENT_DATE => 54, InscriptionPeer::CERTIFICATED => 55, InscriptionPeer::CERTIFICATEDNAME => 56, InscriptionPeer::TPV_SUFFIX => 57, InscriptionPeer::TPV_FIRST_PAYMENT_RESPONSE => 58, InscriptionPeer::TPV_SECOND_PAYMENT_RESPONSE => 59, InscriptionPeer::CULTURE => 60, InscriptionPeer::IS_PAYMENT_REMINDER_SENT => 61, InscriptionPeer::KIDS_AND_US_CENTER_ID => 62, InscriptionPeer::LAST_COOLOFF_YEAR => 63, InscriptionPeer::EMAIL_CONFIRMATION_SENT => 64, InscriptionPeer::STUDENT_MEDS => 65, InscriptionPeer::STUDENT_MEDS_DESCRIPTION => 66, InscriptionPeer::IS_VACCINATED => 67, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'inscription_code' => 2, 'student_name' => 3, 'student_primer_apellido' => 4, 'student_segundo_apellido' => 5, 'student_birth_date' => 6, 'student_address' => 7, 'student_zip' => 8, 'student_city' => 9, 'student_school_year' => 10, 'student_friends' => 11, 'is_student_disability' => 12, 'student_disability' => 13, 'student_allergies' => 14, 'student_allergies_description' => 15, 'father_name' => 16, 'father_primer_apellido' => 17, 'father_segundo_apellido' => 18, 'father_phone' => 19, 'father_dni' => 20, 'father_mail' => 21, 'state' => 22, 'is_father_mail_main' => 23, 'mother_name' => 24, 'mother_primer_apellido' => 25, 'mother_segundo_apellido' => 26, 'mother_phone' => 27, 'mother_dni' => 28, 'mother_mail' => 29, 'is_mother_mail_main' => 30, 'split_payment' => 31, 'beca' => 32, 'student_course_inscription' => 33, 'is_paid' => 34, 'method_payment' => 35, 'student_provincia' => 36, 'student_num_tarjeta_sanitaria' => 37, 'student_tarjeta_sanitaria_companyia' => 38, 'is_student_kid_and_us' => 39, 'student_disability_level' => 40, 'student_comments' => 41, 'grupo_id' => 42, 'student_excursion' => 43, 'price' => 44, 'discount' => 45, 'discountPercent' => 46, 'student_photo' => 47, 'inscription_num' => 48, 'custom_question' => 49, 'custom_question_answer' => 50, 'amount_beca' => 51, 'amount_first_payment' => 52, 'amount_second_payment' => 53, 'payment_date' => 54, 'certificated' => 55, 'certificatedName' => 56, 'tpv_suffix' => 57, 'tpv_first_payment_response' => 58, 'tpv_second_payment_response' => 59, 'culture' => 60, 'is_payment_reminder_sent' => 61, 'kids_and_us_center_id' => 62, 'last_cooloff_year' => 63, 'email_confirmation_sent' => 64, 'student_meds' => 65, 'student_meds_description' => 66, 'is_vaccinated' => 67, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/InscriptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.InscriptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InscriptionPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(InscriptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InscriptionPeer::ID);

		$criteria->addSelectColumn(InscriptionPeer::CREATED_AT);

		$criteria->addSelectColumn(InscriptionPeer::INSCRIPTION_CODE);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_NAME);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_PRIMER_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_SEGUNDO_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_BIRTH_DATE);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_ADDRESS);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_ZIP);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_CITY);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_SCHOOL_YEAR);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_FRIENDS);

		$criteria->addSelectColumn(InscriptionPeer::IS_STUDENT_DISABILITY);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_DISABILITY);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_ALLERGIES);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_ALLERGIES_DESCRIPTION);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_NAME);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_PRIMER_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_SEGUNDO_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_PHONE);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_DNI);

		$criteria->addSelectColumn(InscriptionPeer::FATHER_MAIL);

		$criteria->addSelectColumn(InscriptionPeer::STATE);

		$criteria->addSelectColumn(InscriptionPeer::IS_FATHER_MAIL_MAIN);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_NAME);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_PRIMER_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_SEGUNDO_APELLIDO);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_PHONE);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_DNI);

		$criteria->addSelectColumn(InscriptionPeer::MOTHER_MAIL);

		$criteria->addSelectColumn(InscriptionPeer::IS_MOTHER_MAIL_MAIN);

		$criteria->addSelectColumn(InscriptionPeer::SPLIT_PAYMENT);

		$criteria->addSelectColumn(InscriptionPeer::BECA);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_COURSE_INSCRIPTION);

		$criteria->addSelectColumn(InscriptionPeer::IS_PAID);

		$criteria->addSelectColumn(InscriptionPeer::METHOD_PAYMENT);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_PROVINCIA);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_NUM_TARJETA_SANITARIA);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_TARJETA_SANITARIA_COMPANYIA);

		$criteria->addSelectColumn(InscriptionPeer::IS_STUDENT_KID_AND_US);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_DISABILITY_LEVEL);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_COMMENTS);

		$criteria->addSelectColumn(InscriptionPeer::GRUPO_ID);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_EXCURSION);

		$criteria->addSelectColumn(InscriptionPeer::PRICE);

		$criteria->addSelectColumn(InscriptionPeer::DISCOUNT);

		$criteria->addSelectColumn(InscriptionPeer::DISCOUNTPERCENT);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_PHOTO);

		$criteria->addSelectColumn(InscriptionPeer::INSCRIPTION_NUM);

		$criteria->addSelectColumn(InscriptionPeer::CUSTOM_QUESTION);

		$criteria->addSelectColumn(InscriptionPeer::CUSTOM_QUESTION_ANSWER);

		$criteria->addSelectColumn(InscriptionPeer::AMOUNT_BECA);

		$criteria->addSelectColumn(InscriptionPeer::AMOUNT_FIRST_PAYMENT);

		$criteria->addSelectColumn(InscriptionPeer::AMOUNT_SECOND_PAYMENT);

		$criteria->addSelectColumn(InscriptionPeer::PAYMENT_DATE);

		$criteria->addSelectColumn(InscriptionPeer::CERTIFICATED);

		$criteria->addSelectColumn(InscriptionPeer::CERTIFICATEDNAME);

		$criteria->addSelectColumn(InscriptionPeer::TPV_SUFFIX);

		$criteria->addSelectColumn(InscriptionPeer::TPV_FIRST_PAYMENT_RESPONSE);

		$criteria->addSelectColumn(InscriptionPeer::TPV_SECOND_PAYMENT_RESPONSE);

		$criteria->addSelectColumn(InscriptionPeer::CULTURE);

		$criteria->addSelectColumn(InscriptionPeer::IS_PAYMENT_REMINDER_SENT);

		$criteria->addSelectColumn(InscriptionPeer::KIDS_AND_US_CENTER_ID);

		$criteria->addSelectColumn(InscriptionPeer::LAST_COOLOFF_YEAR);

		$criteria->addSelectColumn(InscriptionPeer::EMAIL_CONFIRMATION_SENT);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_MEDS);

		$criteria->addSelectColumn(InscriptionPeer::STUDENT_MEDS_DESCRIPTION);

		$criteria->addSelectColumn(InscriptionPeer::IS_VACCINATED);

	}

	const COUNT = 'COUNT(inscription.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT inscription.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InscriptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InscriptionPeer::populateObjects(InscriptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InscriptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InscriptionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCourse(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProvincia(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinKidsAndUsCenter(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCourse(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CoursePeer::addSelectColumns($c);

		$c->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscription($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProvincia(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProvinciaPeer::addSelectColumns($c);

		$c->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProvinciaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProvincia(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscription($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GrupoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscription($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinKidsAndUsCenter(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		KidsAndUsCenterPeer::addSelectColumns($c);

		$c->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = KidsAndUsCenterPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getKidsAndUsCenter(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscription($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$criteria->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$criteria->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol2 = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		ProvinciaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProvinciaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GrupoPeer::NUM_COLUMNS;

		KidsAndUsCenterPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + KidsAndUsCenterPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$c->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$c->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscription($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1);
			}


					
			$omClass = ProvinciaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProvincia(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscription($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptions();
				$obj3->addInscription($obj1);
			}


					
			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGrupo(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInscription($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initInscriptions();
				$obj4->addInscription($obj1);
			}


					
			$omClass = KidsAndUsCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getKidsAndUsCenter(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addInscription($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initInscriptions();
				$obj5->addInscription($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptCourse(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$criteria->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProvincia(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$criteria->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$criteria->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$criteria->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptKidsAndUsCenter(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$criteria->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$criteria->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = InscriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptCourse(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol2 = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProvinciaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProvinciaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		KidsAndUsCenterPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + KidsAndUsCenterPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$c->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProvinciaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProvincia(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGrupo(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptions();
				$obj3->addInscription($obj1);
			}

			$omClass = KidsAndUsCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getKidsAndUsCenter(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initInscriptions();
				$obj4->addInscription($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProvincia(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol2 = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		KidsAndUsCenterPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + KidsAndUsCenterPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$c->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGrupo(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptions();
				$obj3->addInscription($obj1);
			}

			$omClass = KidsAndUsCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getKidsAndUsCenter(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initInscriptions();
				$obj4->addInscription($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol2 = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		ProvinciaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProvinciaPeer::NUM_COLUMNS;

		KidsAndUsCenterPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + KidsAndUsCenterPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$c->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$c->addJoin(InscriptionPeer::KIDS_AND_US_CENTER_ID, KidsAndUsCenterPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1);
			}

			$omClass = ProvinciaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProvincia(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptions();
				$obj3->addInscription($obj1);
			}

			$omClass = KidsAndUsCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getKidsAndUsCenter(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initInscriptions();
				$obj4->addInscription($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptKidsAndUsCenter(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionPeer::addSelectColumns($c);
		$startcol2 = (InscriptionPeer::NUM_COLUMNS - InscriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		ProvinciaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProvinciaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);

		$c->addJoin(InscriptionPeer::STUDENT_PROVINCIA, ProvinciaPeer::ID);

		$c->addJoin(InscriptionPeer::GRUPO_ID, GrupoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptions();
				$obj2->addInscription($obj1);
			}

			$omClass = ProvinciaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProvincia(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptions();
				$obj3->addInscription($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGrupo(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInscription($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initInscriptions();
				$obj4->addInscription($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return InscriptionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(InscriptionPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInscriptionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InscriptionPeer::ID);
			$selectCriteria->add(InscriptionPeer::ID, $criteria->remove(InscriptionPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInscriptionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += InscriptionPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(InscriptionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(InscriptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Inscription) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InscriptionPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += InscriptionPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = InscriptionPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/inscriptions/InscriptionServiceSchedule.php';

						$c = new Criteria();
			
			$c->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $obj->getId());
			$affectedRows += InscriptionServiceSchedulePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Inscription $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InscriptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InscriptionPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(InscriptionPeer::DATABASE_NAME, InscriptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InscriptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(InscriptionPeer::DATABASE_NAME);

		$criteria->add(InscriptionPeer::ID, $pk);


		$v = InscriptionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(InscriptionPeer::ID, $pks, Criteria::IN);
			$objs = InscriptionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInscriptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/InscriptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.InscriptionMapBuilder');
}
