<?php


abstract class BaseInscriptionServiceSchedulePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'inscription_service_schedule';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.InscriptionServiceSchedule';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const INSCRIPTION_ID = 'inscription_service_schedule.INSCRIPTION_ID';

	
	const SERVICE_SCHEDULE_ID = 'inscription_service_schedule.SERVICE_SCHEDULE_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('InscriptionId', 'ServiceScheduleId', ),
		BasePeer::TYPE_COLNAME => array (InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('inscription_id', 'service_schedule_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('InscriptionId' => 0, 'ServiceScheduleId' => 1, ),
		BasePeer::TYPE_COLNAME => array (InscriptionServiceSchedulePeer::INSCRIPTION_ID => 0, InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('inscription_id' => 0, 'service_schedule_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/InscriptionServiceScheduleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.InscriptionServiceScheduleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InscriptionServiceSchedulePeer::getTableMap();
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
		return str_replace(InscriptionServiceSchedulePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InscriptionServiceSchedulePeer::INSCRIPTION_ID);

		$criteria->addSelectColumn(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID);

	}

	const COUNT = 'COUNT(inscription_service_schedule.INSCRIPTION_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT inscription_service_schedule.INSCRIPTION_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
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
		$objects = InscriptionServiceSchedulePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InscriptionServiceSchedulePeer::populateObjects(InscriptionServiceSchedulePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedulePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServiceSchedulePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InscriptionServiceSchedulePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InscriptionServiceSchedulePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinInscription(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinServiceSchedule(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinInscription(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionServiceSchedulePeer::addSelectColumns($c);
		$startcol = (InscriptionServiceSchedulePeer::NUM_COLUMNS - InscriptionServiceSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InscriptionPeer::addSelectColumns($c);

		$c->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServiceSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InscriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInscription(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscriptionServiceSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptionServiceSchedules();
				$obj2->addInscriptionServiceSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinServiceSchedule(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionServiceSchedulePeer::addSelectColumns($c);
		$startcol = (InscriptionServiceSchedulePeer::NUM_COLUMNS - InscriptionServiceSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ServiceSchedulePeer::addSelectColumns($c);

		$c->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServiceSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServiceSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getServiceSchedule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInscriptionServiceSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptionServiceSchedules();
				$obj2->addInscriptionServiceSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$criteria->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
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

		InscriptionServiceSchedulePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServiceSchedulePeer::NUM_COLUMNS - InscriptionServiceSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InscriptionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InscriptionPeer::NUM_COLUMNS;

		ServiceSchedulePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ServiceSchedulePeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$c->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServiceSchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = InscriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInscription(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscriptionServiceSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServiceSchedules();
				$obj2->addInscriptionServiceSchedule($obj1);
			}


					
			$omClass = ServiceSchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getServiceSchedule(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInscriptionServiceSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptionServiceSchedules();
				$obj3->addInscriptionServiceSchedule($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptInscription(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptServiceSchedule(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServiceSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$rs = InscriptionServiceSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptInscription(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionServiceSchedulePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServiceSchedulePeer::NUM_COLUMNS - InscriptionServiceSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServiceSchedulePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServiceSchedulePeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServiceSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ServiceSchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getServiceSchedule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscriptionServiceSchedule($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServiceSchedules();
				$obj2->addInscriptionServiceSchedule($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptServiceSchedule(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InscriptionServiceSchedulePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServiceSchedulePeer::NUM_COLUMNS - InscriptionServiceSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InscriptionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InscriptionPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServiceSchedulePeer::INSCRIPTION_ID, InscriptionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServiceSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InscriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInscription(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInscriptionServiceSchedule($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServiceSchedules();
				$obj2->addInscriptionServiceSchedule($obj1);
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
		return InscriptionServiceSchedulePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedulePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionServiceSchedulePeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedulePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServiceSchedulePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedulePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionServiceSchedulePeer', $values, $con);
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
			$comparison = $criteria->getComparison(InscriptionServiceSchedulePeer::INSCRIPTION_ID);
			$selectCriteria->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $criteria->remove(InscriptionServiceSchedulePeer::INSCRIPTION_ID), $comparison);

			$comparison = $criteria->getComparison(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID);
			$selectCriteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $criteria->remove(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedulePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServiceSchedulePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(InscriptionServiceSchedulePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InscriptionServiceSchedulePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InscriptionServiceSchedule) {

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

			$criteria->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $vals[0], Criteria::IN);
			$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(InscriptionServiceSchedule $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InscriptionServiceSchedulePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InscriptionServiceSchedulePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InscriptionServiceSchedulePeer::DATABASE_NAME, InscriptionServiceSchedulePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InscriptionServiceSchedulePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $inscription_id, $service_schedule_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $inscription_id);
		$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $service_schedule_id);
		$v = InscriptionServiceSchedulePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseInscriptionServiceSchedulePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/InscriptionServiceScheduleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.InscriptionServiceScheduleMapBuilder');
}
