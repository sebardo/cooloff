<?php



class SummerFunCenterMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.SummerFunCenterMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('summer_fun_center');
		$tMap->setPhpName('SummerFunCenter');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('SUMMER_FUN_ZONE_ID', 'SummerFunZoneId', 'int', CreoleTypes::INTEGER, 'summer_fun_zone', 'ID', true, null);

		$tMap->addColumn('MORNING_SHELTER', 'MorningShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('AFTERNOON_SHELTER', 'AfternoonShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('TRANSFER_PAYMENT', 'TransferPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CASH_PAYMENT', 'CashPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('TPV_PAYMENT', 'TpvPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_REGISTRATION_OPEN', 'IsRegistrationOpen', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('ACCOUNT_NUMBER', 'AccountNumber', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MAIL', 'Mail', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('WEEKS_DISCOUNT', 'WeeksDiscount', 'int', CreoleTypes::INTEGER, false, 4);

		$tMap->addColumn('WEEKS_PERCENT_DISCOUNT', 'WeeksPercentDiscount', 'double', CreoleTypes::DECIMAL, false, 5);

		$tMap->addColumn('BROTHERS_DISCOUNT', 'BrothersDiscount', 'int', CreoleTypes::INTEGER, false, 4);

		$tMap->addColumn('BROTHERS_PERCENT_DISCOUNT', 'BrothersPercentDiscount', 'double', CreoleTypes::DECIMAL, false, 5);

		$tMap->addColumn('SHOW_EXCURSION_WIDGET', 'ShowExcursionWidget', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('RECIBO_DOMICILIADO_PAYMENT', 'ReciboDomiciliadoPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('SHOW_BECA_WIDGET', 'ShowBecaWidget', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('MERCHANT_CODE', 'MerchantCode', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MERCHANT_KEY', 'MerchantKey', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URL_TPV', 'UrlTpv', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SECOND_PAYMENT_MAILING_DATE', 'SecondPaymentMailingDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('SECOND_PAYMENT_DATE', 'SecondPaymentDate', 'int', CreoleTypes::DATE, false, null);

	} 
} 