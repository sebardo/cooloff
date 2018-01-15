<?php


abstract class BaseWeekI18nPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'week_i18n';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.WeekI18n';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const MORNING_SHELTER_SCHEDULE = 'week_i18n.MORNING_SHELTER_SCHEDULE';

	
	const AFTERNOON_SHELTER_SCHEDULE = 'week_i18n.AFTERNOON_SHELTER_SCHEDULE';

	
	const SHELTER_DESCRIPTION = 'week_i18n.SHELTER_DESCRIPTION';

	
	const ID = 'week_i18n.ID';

	
	const CULTURE = 'week_i18n.CULTURE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('MorningShelterSchedule', 'AfternoonShelterSchedule', 'ShelterDescription', 'Id', 'Culture', ),
		BasePeer::TYPE_COLNAME => array (WeekI18nPeer::MORNING_SHELTER_SCHEDULE, WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE, WeekI18nPeer::SHELTER_DESCRIPTION, WeekI18nPeer::ID, WeekI18nPeer::CULTURE, ),
		BasePeer::TYPE_FIELDNAME => array ('morning_shelter_schedule', 'afternoon_shelter_schedule', 'shelter_description', 'id', 'culture', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('MorningShelterSchedule' => 0, 'AfternoonShelterSchedule' => 1, 'ShelterDescription' => 2, 'Id' => 3, 'Culture' => 4, ),
		BasePeer::TYPE_COLNAME => array (WeekI18nPeer::MORNING_SHELTER_SCHEDULE => 0, WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE => 1, WeekI18nPeer::SHELTER_DESCRIPTION => 2, WeekI18nPeer::ID => 3, WeekI18nPeer::CULTURE => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('morning_shelter_schedule' => 0, 'afternoon_shelter_schedule' => 1, 'shelter_description' => 2, 'id' => 3, 'culture' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/WeekI18nMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.WeekI18nMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WeekI18nPeer::getTableMap();
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
		return str_replace(WeekI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WeekI18nPeer::MORNING_SHELTER_SCHEDULE);

		$criteria->addSelectColumn(WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE);

		$criteria->addSelectColumn(WeekI18nPeer::SHELTER_DESCRIPTION);

		$criteria->addSelectColumn(WeekI18nPeer::ID);

		$criteria->addSelectColumn(WeekI18nPeer::CULTURE);

	}

	const COUNT = 'COUNT(week_i18n.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT week_i18n.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WeekI18nPeer::doSelectRS($criteria, $con);
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
		$objects = WeekI18nPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WeekI18nPeer::populateObjects(WeekI18nPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWeekI18nPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseWeekI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WeekI18nPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WeekI18nPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinWeek(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WeekI18nPeer::ID, WeekPeer::ID);

		$rs = WeekI18nPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinWeek(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WeekI18nPeer::addSelectColumns($c);
		$startcol = (WeekI18nPeer::NUM_COLUMNS - WeekI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		WeekPeer::addSelectColumns($c);

		$c->addJoin(WeekI18nPeer::ID, WeekPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WeekI18nPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WeekPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getWeek(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWeekI18n($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWeekI18ns();
				$obj2->addWeekI18n($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WeekI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WeekI18nPeer::ID, WeekPeer::ID);

		$rs = WeekI18nPeer::doSelectRS($criteria, $con);
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

		WeekI18nPeer::addSelectColumns($c);
		$startcol2 = (WeekI18nPeer::NUM_COLUMNS - WeekI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		WeekPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + WeekPeer::NUM_COLUMNS;

		$c->addJoin(WeekI18nPeer::ID, WeekPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WeekI18nPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = WeekPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getWeek(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWeekI18n($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initWeekI18ns();
				$obj2->addWeekI18n($obj1);
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
		return WeekI18nPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWeekI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWeekI18nPeer', $values, $con);
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


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseWeekI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseWeekI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWeekI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWeekI18nPeer', $values, $con);
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
			$comparison = $criteria->getComparison(WeekI18nPeer::ID);
			$selectCriteria->add(WeekI18nPeer::ID, $criteria->remove(WeekI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(WeekI18nPeer::CULTURE);
			$selectCriteria->add(WeekI18nPeer::CULTURE, $criteria->remove(WeekI18nPeer::CULTURE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseWeekI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseWeekI18nPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(WeekI18nPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WeekI18nPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof WeekI18n) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(WeekI18nPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(WeekI18nPeer::CULTURE, $vals[1], Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(WeekI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WeekI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WeekI18nPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WeekI18nPeer::DATABASE_NAME, WeekI18nPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WeekI18nPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $culture, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(WeekI18nPeer::ID, $id);
		$criteria->add(WeekI18nPeer::CULTURE, $culture);
		$v = WeekI18nPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseWeekI18nPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/WeekI18nMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.WeekI18nMapBuilder');
}
