<?php


abstract class BaseServiceHasSchedulePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'service_has_schedule';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.ServiceHasSchedule';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SERVICE_ID = 'service_has_schedule.SERVICE_ID';

	
	const SCHEDULE_ID = 'service_has_schedule.SCHEDULE_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ServiceId', 'ScheduleId', ),
		BasePeer::TYPE_COLNAME => array (ServiceHasSchedulePeer::SERVICE_ID, ServiceHasSchedulePeer::SCHEDULE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('service_id', 'schedule_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ServiceId' => 0, 'ScheduleId' => 1, ),
		BasePeer::TYPE_COLNAME => array (ServiceHasSchedulePeer::SERVICE_ID => 0, ServiceHasSchedulePeer::SCHEDULE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('service_id' => 0, 'schedule_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/ServiceHasScheduleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.ServiceHasScheduleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ServiceHasSchedulePeer::getTableMap();
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
		return str_replace(ServiceHasSchedulePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ServiceHasSchedulePeer::SERVICE_ID);

		$criteria->addSelectColumn(ServiceHasSchedulePeer::SCHEDULE_ID);

	}

	const COUNT = 'COUNT(service_has_schedule.SERVICE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT service_has_schedule.SERVICE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
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
		$objects = ServiceHasSchedulePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ServiceHasSchedulePeer::populateObjects(ServiceHasSchedulePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceHasSchedulePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseServiceHasSchedulePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ServiceHasSchedulePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ServiceHasSchedulePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSchedule(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceHasSchedulePeer::addSelectColumns($c);
		$startcol = (ServiceHasSchedulePeer::NUM_COLUMNS - ServiceHasSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ServicePeer::addSelectColumns($c);

		$c->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServiceHasSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getService(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addServiceHasSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initServiceHasSchedules();
				$obj2->addServiceHasSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSchedule(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceHasSchedulePeer::addSelectColumns($c);
		$startcol = (ServiceHasSchedulePeer::NUM_COLUMNS - ServiceHasSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchedulePeer::addSelectColumns($c);

		$c->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServiceHasSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchedule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addServiceHasSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initServiceHasSchedules();
				$obj2->addServiceHasSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);

		$criteria->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
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

		ServiceHasSchedulePeer::addSelectColumns($c);
		$startcol2 = (ServiceHasSchedulePeer::NUM_COLUMNS - ServiceHasSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServicePeer::NUM_COLUMNS;

		SchedulePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchedulePeer::NUM_COLUMNS;

		$c->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);

		$c->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServiceHasSchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ServicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getService(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addServiceHasSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initServiceHasSchedules();
				$obj2->addServiceHasSchedule($obj1);
			}


					
			$omClass = SchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchedule(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addServiceHasSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initServiceHasSchedules();
				$obj3->addServiceHasSchedule($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSchedule(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServiceHasSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);

		$rs = ServiceHasSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceHasSchedulePeer::addSelectColumns($c);
		$startcol2 = (ServiceHasSchedulePeer::NUM_COLUMNS - ServiceHasSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchedulePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchedulePeer::NUM_COLUMNS;

		$c->addJoin(ServiceHasSchedulePeer::SCHEDULE_ID, SchedulePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServiceHasSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchedule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addServiceHasSchedule($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initServiceHasSchedules();
				$obj2->addServiceHasSchedule($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSchedule(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ServiceHasSchedulePeer::addSelectColumns($c);
		$startcol2 = (ServiceHasSchedulePeer::NUM_COLUMNS - ServiceHasSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServicePeer::NUM_COLUMNS;

		$c->addJoin(ServiceHasSchedulePeer::SERVICE_ID, ServicePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServiceHasSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getService(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addServiceHasSchedule($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initServiceHasSchedules();
				$obj2->addServiceHasSchedule($obj1);
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
		return ServiceHasSchedulePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceHasSchedulePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseServiceHasSchedulePeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseServiceHasSchedulePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseServiceHasSchedulePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceHasSchedulePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseServiceHasSchedulePeer', $values, $con);
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
			$comparison = $criteria->getComparison(ServiceHasSchedulePeer::SERVICE_ID);
			$selectCriteria->add(ServiceHasSchedulePeer::SERVICE_ID, $criteria->remove(ServiceHasSchedulePeer::SERVICE_ID), $comparison);

			$comparison = $criteria->getComparison(ServiceHasSchedulePeer::SCHEDULE_ID);
			$selectCriteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $criteria->remove(ServiceHasSchedulePeer::SCHEDULE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseServiceHasSchedulePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseServiceHasSchedulePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ServiceHasSchedulePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ServiceHasSchedulePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ServiceHasSchedule) {

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

			$criteria->add(ServiceHasSchedulePeer::SERVICE_ID, $vals[0], Criteria::IN);
			$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(ServiceHasSchedule $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ServiceHasSchedulePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ServiceHasSchedulePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ServiceHasSchedulePeer::DATABASE_NAME, ServiceHasSchedulePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ServiceHasSchedulePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $service_id, $schedule_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ServiceHasSchedulePeer::SERVICE_ID, $service_id);
		$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $schedule_id);
		$v = ServiceHasSchedulePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseServiceHasSchedulePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/ServiceHasScheduleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.ServiceHasScheduleMapBuilder');
}
