<?php


abstract class BaseInscriptionServicePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'inscription_service';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.InscriptionService';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const INSCRIPTION_ID = 'inscription_service.INSCRIPTION_ID';

	
	const SERVICE_SCHEDULE_ID = 'inscription_service.SERVICE_SCHEDULE_ID';

	
	const ID = 'inscription_service.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('InscriptionId', 'ServiceScheduleId', 'Id', ),
		BasePeer::TYPE_COLNAME => array (InscriptionServicePeer::INSCRIPTION_ID, InscriptionServicePeer::SERVICE_SCHEDULE_ID, InscriptionServicePeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('inscription_id', 'service_schedule_id', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('InscriptionId' => 0, 'ServiceScheduleId' => 1, 'Id' => 2, ),
		BasePeer::TYPE_COLNAME => array (InscriptionServicePeer::INSCRIPTION_ID => 0, InscriptionServicePeer::SERVICE_SCHEDULE_ID => 1, InscriptionServicePeer::ID => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('inscription_id' => 0, 'service_schedule_id' => 1, 'id' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/InscriptionServiceMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.InscriptionServiceMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InscriptionServicePeer::getTableMap();
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
		return str_replace(InscriptionServicePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InscriptionServicePeer::INSCRIPTION_ID);

		$criteria->addSelectColumn(InscriptionServicePeer::SERVICE_SCHEDULE_ID);

		$criteria->addSelectColumn(InscriptionServicePeer::ID);

	}

	const COUNT = 'COUNT(inscription_service.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT inscription_service.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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
		$objects = InscriptionServicePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InscriptionServicePeer::populateObjects(InscriptionServicePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServicePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServicePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InscriptionServicePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InscriptionServicePeer::getOMClass();
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
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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

		InscriptionServicePeer::addSelectColumns($c);
		$startcol = (InscriptionServicePeer::NUM_COLUMNS - InscriptionServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InscriptionPeer::addSelectColumns($c);

		$c->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServicePeer::getOMClass();

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
										$temp_obj2->addInscriptionService($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptionServices();
				$obj2->addInscriptionService($obj1); 			}
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

		InscriptionServicePeer::addSelectColumns($c);
		$startcol = (InscriptionServicePeer::NUM_COLUMNS - InscriptionServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ServiceSchedulePeer::addSelectColumns($c);

		$c->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServicePeer::getOMClass();

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
										$temp_obj2->addInscriptionService($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptionServices();
				$obj2->addInscriptionService($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$criteria->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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

		InscriptionServicePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServicePeer::NUM_COLUMNS - InscriptionServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InscriptionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InscriptionPeer::NUM_COLUMNS;

		ServiceSchedulePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ServiceSchedulePeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$c->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServicePeer::getOMClass();


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
					$temp_obj2->addInscriptionService($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServices();
				$obj2->addInscriptionService($obj1);
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
					$temp_obj3->addInscriptionService($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInscriptionServices();
				$obj3->addInscriptionService($obj1);
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
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);

		$rs = InscriptionServicePeer::doSelectRS($criteria, $con);
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

		InscriptionServicePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServicePeer::NUM_COLUMNS - InscriptionServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServiceSchedulePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServiceSchedulePeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServicePeer::SERVICE_SCHEDULE_ID, ServiceSchedulePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServicePeer::getOMClass();

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
					$temp_obj2->addInscriptionService($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServices();
				$obj2->addInscriptionService($obj1);
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

		InscriptionServicePeer::addSelectColumns($c);
		$startcol2 = (InscriptionServicePeer::NUM_COLUMNS - InscriptionServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InscriptionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InscriptionPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionServicePeer::INSCRIPTION_ID, InscriptionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionServicePeer::getOMClass();

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
					$temp_obj2->addInscriptionService($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionServices();
				$obj2->addInscriptionService($obj1);
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
		return InscriptionServicePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServicePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionServicePeer', $values, $con);
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

		$criteria->remove(InscriptionServicePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInscriptionServicePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServicePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServicePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionServicePeer', $values, $con);
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
			$comparison = $criteria->getComparison(InscriptionServicePeer::ID);
			$selectCriteria->add(InscriptionServicePeer::ID, $criteria->remove(InscriptionServicePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInscriptionServicePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionServicePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(InscriptionServicePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InscriptionServicePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InscriptionService) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InscriptionServicePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(InscriptionService $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InscriptionServicePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InscriptionServicePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InscriptionServicePeer::DATABASE_NAME, InscriptionServicePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InscriptionServicePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(InscriptionServicePeer::DATABASE_NAME);

		$criteria->add(InscriptionServicePeer::ID, $pk);


		$v = InscriptionServicePeer::doSelect($criteria, $con);

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
			$criteria->add(InscriptionServicePeer::ID, $pks, Criteria::IN);
			$objs = InscriptionServicePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInscriptionServicePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/InscriptionServiceMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.InscriptionServiceMapBuilder');
}
