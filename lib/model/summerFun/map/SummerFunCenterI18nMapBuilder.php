<?php



class SummerFunCenterI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.SummerFunCenterI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('summer_fun_center_i18n');
		$tMap->setPhpName('SummerFunCenterI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TEXT_SHELTER', 'TextShelter', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSCRIPTION_CONFIRMATION_MAIL', 'InscriptionConfirmationMail', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSCRIPTION_CONDITIONS_TERMS_PDF', 'InscriptionConditionsTermsPdf', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CUSTOM_QUESTION', 'CustomQuestion', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RECIBO_DOMICILIADO_TXT', 'ReciboDomiciliadoTxt', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SECOND_PAYMENT_MAILING_BODY', 'SecondPaymentMailingBody', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SECOND_PAYMENT_MAILING_BODY_NO_TPV', 'SecondPaymentMailingBodyNoTpv', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 