<?php



class InscriptionMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.InscriptionMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('inscription');
		$tMap->setPhpName('Inscription');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('INSCRIPTION_CODE', 'InscriptionCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STUDENT_NAME', 'StudentName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STUDENT_PRIMER_APELLIDO', 'StudentPrimerApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STUDENT_SEGUNDO_APELLIDO', 'StudentSegundoApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STUDENT_BIRTH_DATE', 'StudentBirthDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('STUDENT_ADDRESS', 'StudentAddress', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STUDENT_ZIP', 'StudentZip', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('STUDENT_CITY', 'StudentCity', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('STUDENT_SCHOOL_YEAR', 'StudentSchoolYear', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('STUDENT_FRIENDS', 'StudentFriends', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_STUDENT_DISABILITY', 'IsStudentDisability', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('STUDENT_DISABILITY', 'StudentDisability', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STUDENT_ALLERGIES', 'StudentAllergies', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('STUDENT_ALLERGIES_DESCRIPTION', 'StudentAllergiesDescription', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_NAME', 'FatherName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_PRIMER_APELLIDO', 'FatherPrimerApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_SEGUNDO_APELLIDO', 'FatherSegundoApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_PHONE', 'FatherPhone', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_DNI', 'FatherDni', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FATHER_MAIL', 'FatherMail', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STATE', 'State', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_FATHER_MAIL_MAIN', 'IsFatherMailMain', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('MOTHER_NAME', 'MotherName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOTHER_PRIMER_APELLIDO', 'MotherPrimerApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOTHER_SEGUNDO_APELLIDO', 'MotherSegundoApellido', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOTHER_PHONE', 'MotherPhone', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOTHER_DNI', 'MotherDni', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOTHER_MAIL', 'MotherMail', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_MOTHER_MAIL_MAIN', 'IsMotherMailMain', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('SPLIT_PAYMENT', 'SplitPayment', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('BECA', 'Beca', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('STUDENT_COURSE_INSCRIPTION', 'StudentCourseInscription', 'int', CreoleTypes::INTEGER, 'course', 'ID', true, null);

		$tMap->addColumn('IS_PAID', 'IsPaid', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('METHOD_PAYMENT', 'MethodPayment', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('STUDENT_PROVINCIA', 'StudentProvincia', 'int', CreoleTypes::INTEGER, 'provincia', 'ID', false, null);

		$tMap->addColumn('STUDENT_NUM_TARJETA_SANITARIA', 'StudentNumTarjetaSanitaria', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('STUDENT_TARJETA_SANITARIA_COMPANYIA', 'StudentTarjetaSanitariaCompanyia', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('IS_STUDENT_KID_AND_US', 'IsStudentKidAndUs', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STUDENT_DISABILITY_LEVEL', 'StudentDisabilityLevel', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('STUDENT_COMMENTS', 'StudentComments', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('GRUPO_ID', 'GrupoId', 'int', CreoleTypes::INTEGER, 'grupo', 'ID', false, null);

		$tMap->addColumn('STUDENT_EXCURSION', 'StudentExcursion', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, false, 14);

		$tMap->addColumn('DISCOUNT', 'Discount', 'double', CreoleTypes::DECIMAL, false, 14);

		$tMap->addColumn('DISCOUNTPERCENT', 'Discountpercent', 'double', CreoleTypes::DECIMAL, false, 5);

		$tMap->addColumn('STUDENT_PHOTO', 'StudentPhoto', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('INSCRIPTION_NUM', 'InscriptionNum', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CUSTOM_QUESTION', 'CustomQuestion', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CUSTOM_QUESTION_ANSWER', 'CustomQuestionAnswer', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('AMOUNT_BECA', 'AmountBeca', 'double', CreoleTypes::DECIMAL, false, 14);

		$tMap->addColumn('AMOUNT_FIRST_PAYMENT', 'AmountFirstPayment', 'double', CreoleTypes::DECIMAL, false, 14);

		$tMap->addColumn('AMOUNT_SECOND_PAYMENT', 'AmountSecondPayment', 'double', CreoleTypes::DECIMAL, false, 14);

		$tMap->addColumn('PAYMENT_DATE', 'PaymentDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CERTIFICATED', 'Certificated', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CERTIFICATEDNAME', 'Certificatedname', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TPV_SUFFIX', 'TpvSuffix', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TPV_FIRST_PAYMENT_RESPONSE', 'TpvFirstPaymentResponse', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TPV_SECOND_PAYMENT_RESPONSE', 'TpvSecondPaymentResponse', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('IS_PAYMENT_REMINDER_SENT', 'IsPaymentReminderSent', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('KIDS_AND_US_CENTER_ID', 'KidsAndUsCenterId', 'int', CreoleTypes::INTEGER, 'kids_and_us_center', 'ID', true, null);

		$tMap->addColumn('LAST_COOLOFF_YEAR', 'LastCooloffYear', 'string', CreoleTypes::VARCHAR, false, 4);

		$tMap->addColumn('EMAIL_CONFIRMATION_SENT', 'EmailConfirmationSent', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STUDENT_MEDS', 'StudentMeds', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STUDENT_MEDS_DESCRIPTION', 'StudentMedsDescription', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_VACCINATED', 'IsVaccinated', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 