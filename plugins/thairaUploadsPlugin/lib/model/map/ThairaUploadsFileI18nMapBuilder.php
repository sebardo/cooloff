<?php



class ThairaUploadsFileI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.thairaUploadsPlugin.lib.model.map.ThairaUploadsFileI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('thaira_uploads_file_i18n');
		$tMap->setPhpName('ThairaUploadsFileI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'thaira_uploads_file', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 