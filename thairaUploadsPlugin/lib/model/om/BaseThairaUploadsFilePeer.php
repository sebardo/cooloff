<?php


abstract class BaseThairaUploadsFilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'thaira_uploads_file';

	
	const CLASS_DEFAULT = 'plugins.thairaUploadsPlugin.lib.model.ThairaUploadsFile';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'thaira_uploads_file.ID';

	
	const OBJECT_CLASS = 'thaira_uploads_file.OBJECT_CLASS';

	
	const OBJECT_ID = 'thaira_uploads_file.OBJECT_ID';

	
	const GROUP_NAME = 'thaira_uploads_file.GROUP_NAME';

	
	const IS_PENDING = 'thaira_uploads_file.IS_PENDING';

	
	const PENDING_UID = 'thaira_uploads_file.PENDING_UID';

	
	const PENDING_FILE_PATH = 'thaira_uploads_file.PENDING_FILE_PATH';

	
	const RANK = 'thaira_uploads_file.RANK';

	
	const FILENAME = 'thaira_uploads_file.FILENAME';

	
	const EXTENSION = 'thaira_uploads_file.EXTENSION';

	
	const PATH = 'thaira_uploads_file.PATH';
	
	
	const IS_PROTECTED = 'thaira_uploads_file.IS_PROTECTED';
	
	
	const PASSWORD = 'thaira_uploads_file.PASSWORD';

	
	const CREATED_AT = 'thaira_uploads_file.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ObjectClass', 'ObjectId', 'GroupName', 'IsPending', 'PendingUid', 'PendingFilePath', 'Rank', 'Filename', 'Extension', 'Path', 'IsProtected', 'Password', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (ThairaUploadsFilePeer::ID, ThairaUploadsFilePeer::OBJECT_CLASS, ThairaUploadsFilePeer::OBJECT_ID, ThairaUploadsFilePeer::GROUP_NAME, ThairaUploadsFilePeer::IS_PENDING, ThairaUploadsFilePeer::PENDING_UID, ThairaUploadsFilePeer::PENDING_FILE_PATH, ThairaUploadsFilePeer::RANK, ThairaUploadsFilePeer::FILENAME, ThairaUploadsFilePeer::EXTENSION, ThairaUploadsFilePeer::PATH, ThairaUploadsFilePeer::IS_PROTECTED, ThairaUploadsFilePeer::PASSWORD, ThairaUploadsFilePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'object_class', 'object_id', 'group_name', 'is_pending', 'pending_uid', 'pending_file_path', 'rank', 'filename', 'extension', 'path', 'is_protected', 'password', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ObjectClass' => 1, 'ObjectId' => 2, 'GroupName' => 3, 'IsPending' => 4, 'PendingUid' => 5, 'PendingFilePath' => 6, 'Rank' => 7, 'Filename' => 8, 'Extension' => 9, 'Path' => 10, 'IsProtected' => 11, 'PAssword' => 12, 'CreatedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (ThairaUploadsFilePeer::ID => 0, ThairaUploadsFilePeer::OBJECT_CLASS => 1, ThairaUploadsFilePeer::OBJECT_ID => 2, ThairaUploadsFilePeer::GROUP_NAME => 3, ThairaUploadsFilePeer::IS_PENDING => 4, ThairaUploadsFilePeer::PENDING_UID => 5, ThairaUploadsFilePeer::PENDING_FILE_PATH => 6, ThairaUploadsFilePeer::RANK => 7, ThairaUploadsFilePeer::FILENAME => 8, ThairaUploadsFilePeer::EXTENSION => 9, ThairaUploadsFilePeer::PATH => 10, ThairaUploadsFilePeer::IS_PROTECTED => 11, ThairaUploadsFilePeer::PASSWORD => 12, ThairaUploadsFilePeer::CREATED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'object_class' => 1, 'object_id' => 2, 'group_name' => 3, 'is_pending' => 4, 'pending_uid' => 5, 'pending_file_path' => 6, 'rank' => 7, 'filename' => 8, 'extension' => 9, 'path' => 10, 'is_protected' => 11, 'password' => 12, 'created_at' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/thairaUploadsPlugin/lib/model/map/ThairaUploadsFileMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.thairaUploadsPlugin.lib.model.map.ThairaUploadsFileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ThairaUploadsFilePeer::getTableMap();
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
		return str_replace(ThairaUploadsFilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ThairaUploadsFilePeer::ID);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::OBJECT_CLASS);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::OBJECT_ID);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::GROUP_NAME);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::IS_PENDING);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::PENDING_UID);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::PENDING_FILE_PATH);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::RANK);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::FILENAME);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::EXTENSION);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::PATH);
		
		$criteria->addSelectColumn(ThairaUploadsFilePeer::IS_PROTECTED);
		
		$criteria->addSelectColumn(ThairaUploadsFilePeer::PASSWORD);

		$criteria->addSelectColumn(ThairaUploadsFilePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(thaira_uploads_file.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT thaira_uploads_file.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThairaUploadsFilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThairaUploadsFilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ThairaUploadsFilePeer::doSelectRS($criteria, $con);
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
		$objects = ThairaUploadsFilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ThairaUploadsFilePeer::populateObjects(ThairaUploadsFilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThairaUploadsFilePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseThairaUploadsFilePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ThairaUploadsFilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ThairaUploadsFilePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
        $c = clone $c;
    if ($culture === null)
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    ThairaUploadsFilePeer::addSelectColumns($c);
    $startcol = (ThairaUploadsFilePeer::NUM_COLUMNS - ThairaUploadsFilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    ThairaUploadsFileI18nPeer::addSelectColumns($c);

    $c->addJoin(ThairaUploadsFilePeer::ID, ThairaUploadsFileI18nPeer::ID);
    $c->add(ThairaUploadsFileI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = ThairaUploadsFilePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = ThairaUploadsFileI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setThairaUploadsFileI18nForCulture($obj2, $culture);
      $obj2->setThairaUploadsFile($obj1);

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
		return ThairaUploadsFilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThairaUploadsFilePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThairaUploadsFilePeer', $values, $con);
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

		$criteria->remove(ThairaUploadsFilePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseThairaUploadsFilePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseThairaUploadsFilePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThairaUploadsFilePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThairaUploadsFilePeer', $values, $con);
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
			$comparison = $criteria->getComparison(ThairaUploadsFilePeer::ID);
			$selectCriteria->add(ThairaUploadsFilePeer::ID, $criteria->remove(ThairaUploadsFilePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseThairaUploadsFilePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseThairaUploadsFilePeer', $values, $con, $ret);
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
			$affectedRows += ThairaUploadsFilePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ThairaUploadsFilePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ThairaUploadsFilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ThairaUploadsFile) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ThairaUploadsFilePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ThairaUploadsFilePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ThairaUploadsFilePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'plugins/thairaUploadsPlugin/lib/model/ThairaUploadsFileI18n.php';

						$c = new Criteria();
			
			$c->add(ThairaUploadsFileI18nPeer::ID, $obj->getId());
			$affectedRows += ThairaUploadsFileI18nPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(ThairaUploadsFile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ThairaUploadsFilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ThairaUploadsFilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ThairaUploadsFilePeer::DATABASE_NAME, ThairaUploadsFilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ThairaUploadsFilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ThairaUploadsFilePeer::DATABASE_NAME);

		$criteria->add(ThairaUploadsFilePeer::ID, $pk);


		$v = ThairaUploadsFilePeer::doSelect($criteria, $con);

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
			$criteria->add(ThairaUploadsFilePeer::ID, $pks, Criteria::IN);
			$objs = ThairaUploadsFilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseThairaUploadsFilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/thairaUploadsPlugin/lib/model/map/ThairaUploadsFileMapBuilder.php';
	Propel::registerMapBuilder('plugins.thairaUploadsPlugin.lib.model.map.ThairaUploadsFileMapBuilder');
}
