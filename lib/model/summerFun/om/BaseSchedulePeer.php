<?php


abstract class BaseSchedulePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'schedule';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.Schedule';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CENTER_ID = 'schedule.CENTER_ID';

	
	const ID = 'schedule.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CenterId', 'Id', ),
		BasePeer::TYPE_COLNAME => array (SchedulePeer::CENTER_ID, SchedulePeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('center_id', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CenterId' => 0, 'Id' => 1, ),
		BasePeer::TYPE_COLNAME => array (SchedulePeer::CENTER_ID => 0, SchedulePeer::ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('center_id' => 0, 'id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/ScheduleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.ScheduleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SchedulePeer::getTableMap();
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
		return str_replace(SchedulePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchedulePeer::CENTER_ID);

		$criteria->addSelectColumn(SchedulePeer::ID);

	}

	const COUNT = 'COUNT(schedule.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT schedule.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchedulePeer::doSelectRS($criteria, $con);
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
		$objects = SchedulePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SchedulePeer::populateObjects(SchedulePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchedulePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchedulePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchedulePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SchedulePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSummerFunCenter(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchedulePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = SchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSummerFunCenter(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchedulePeer::addSelectColumns($c);
		$startcol = (SchedulePeer::NUM_COLUMNS - SchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(SchedulePeer::CENTER_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SummerFunCenterPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSummerFunCenter(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSchedules();
				$obj2->addSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchedulePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = SchedulePeer::doSelectRS($criteria, $con);
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

		SchedulePeer::addSelectColumns($c);
		$startcol2 = (SchedulePeer::NUM_COLUMNS - SchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(SchedulePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SummerFunCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSummerFunCenter(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSchedules();
				$obj2->addSchedule($obj1);
			}

			$results[] = $obj1;
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

    SchedulePeer::addSelectColumns($c);
    $startcol = (SchedulePeer::NUM_COLUMNS - SchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    ScheduleI18nPeer::addSelectColumns($c);

    $c->addJoin(SchedulePeer::ID, ScheduleI18nPeer::ID);
    $c->add(ScheduleI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = SchedulePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = ScheduleI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setScheduleI18nForCulture($obj2, $culture);
      $obj2->setSchedule($obj1);

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
		return SchedulePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchedulePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchedulePeer', $values, $con);
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

		$criteria->remove(SchedulePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseSchedulePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchedulePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchedulePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchedulePeer', $values, $con);
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
			$comparison = $criteria->getComparison(SchedulePeer::ID);
			$selectCriteria->add(SchedulePeer::ID, $criteria->remove(SchedulePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchedulePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchedulePeer', $values, $con, $ret);
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
			$affectedRows += SchedulePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(SchedulePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SchedulePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Schedule) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchedulePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += SchedulePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = SchedulePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/summerFun/ScheduleI18n.php';

						$c = new Criteria();
			
			$c->add(ScheduleI18nPeer::ID, $obj->getId());
			$affectedRows += ScheduleI18nPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Schedule $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchedulePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchedulePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchedulePeer::DATABASE_NAME, SchedulePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchedulePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SchedulePeer::DATABASE_NAME);

		$criteria->add(SchedulePeer::ID, $pk);


		$v = SchedulePeer::doSelect($criteria, $con);

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
			$criteria->add(SchedulePeer::ID, $pks, Criteria::IN);
			$objs = SchedulePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSchedulePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/ScheduleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.ScheduleMapBuilder');
}
