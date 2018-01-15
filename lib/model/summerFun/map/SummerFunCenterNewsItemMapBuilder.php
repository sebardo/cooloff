<?php



class SummerFunCenterNewsItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.SummerFunCenterNewsItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('summer_fun_center_news_item');
		$tMap->setPhpName('SummerFunCenterNewsItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('SUMMER_FUN_CENTER_ID', 'SummerFunCenterId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addColumn('PUBLISHED_AT', 'PublishedAt', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('IS_PUBLISHED', 'IsPublished', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} 
} 