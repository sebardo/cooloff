<?php



class ThairaUploadsFileMapBuilder {

	
	const CLASS_NAME = 'plugins.thairaUploadsPlugin.lib.model.map.ThairaUploadsFileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('thaira_uploads_file');
		$tMap->setPhpName('ThairaUploadsFile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('OBJECT_CLASS', 'ObjectClass', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('GROUP_NAME', 'GroupName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('IS_PENDING', 'IsPending', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PENDING_UID', 'PendingUid', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('PENDING_FILE_PATH', 'PendingFilePath', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FILENAME', 'Filename', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('EXTENSION', 'Extension', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PATH', 'Path', 'string', CreoleTypes::VARCHAR, false, 255);
		
		$tMap->addColumn('IS_PROTECTED', 'IsProtected', 'boolean', CreoleTypes::BOOLEAN, false, null);
		
		$tMap->addColumn('PASSWORD', 'ObjectClass', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 