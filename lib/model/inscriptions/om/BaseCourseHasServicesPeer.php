<?php


abstract class BaseCourseHasServicesPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'course_has_services';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.CourseHasServices';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const COURSE_ID = 'course_has_services.COURSE_ID';

	
	const SERVICE_ID = 'course_has_services.SERVICE_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CourseId', 'ServiceId', ),
		BasePeer::TYPE_COLNAME => array (CourseHasServicesPeer::COURSE_ID, CourseHasServicesPeer::SERVICE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('course_id', 'service_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CourseId' => 0, 'ServiceId' => 1, ),
		BasePeer::TYPE_COLNAME => array (CourseHasServicesPeer::COURSE_ID => 0, CourseHasServicesPeer::SERVICE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('course_id' => 0, 'service_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/CourseHasServicesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.CourseHasServicesMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CourseHasServicesPeer::getTableMap();
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
		return str_replace(CourseHasServicesPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CourseHasServicesPeer::COURSE_ID);

		$criteria->addSelectColumn(CourseHasServicesPeer::SERVICE_ID);

	}

	const COUNT = 'COUNT(course_has_services.COURSE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT course_has_services.COURSE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
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
		$objects = CourseHasServicesPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CourseHasServicesPeer::populateObjects(CourseHasServicesPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseHasServicesPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseCourseHasServicesPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CourseHasServicesPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CourseHasServicesPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCourse(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCourse(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CourseHasServicesPeer::addSelectColumns($c);
		$startcol = (CourseHasServicesPeer::NUM_COLUMNS - CourseHasServicesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CoursePeer::addSelectColumns($c);

		$c->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CourseHasServicesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCourseHasServices($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCourseHasServicess();
				$obj2->addCourseHasServices($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinService(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CourseHasServicesPeer::addSelectColumns($c);
		$startcol = (CourseHasServicesPeer::NUM_COLUMNS - CourseHasServicesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ServicePeer::addSelectColumns($c);

		$c->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CourseHasServicesPeer::getOMClass();

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
										$temp_obj2->addCourseHasServices($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCourseHasServicess();
				$obj2->addCourseHasServices($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);

		$criteria->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
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

		CourseHasServicesPeer::addSelectColumns($c);
		$startcol2 = (CourseHasServicesPeer::NUM_COLUMNS - CourseHasServicesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		ServicePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ServicePeer::NUM_COLUMNS;

		$c->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);

		$c->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CourseHasServicesPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCourseHasServices($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCourseHasServicess();
				$obj2->addCourseHasServices($obj1);
			}


					
			$omClass = ServicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getService(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCourseHasServices($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCourseHasServicess();
				$obj3->addCourseHasServices($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptCourse(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptService(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CourseHasServicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);

		$rs = CourseHasServicesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptCourse(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CourseHasServicesPeer::addSelectColumns($c);
		$startcol2 = (CourseHasServicesPeer::NUM_COLUMNS - CourseHasServicesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ServicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ServicePeer::NUM_COLUMNS;

		$c->addJoin(CourseHasServicesPeer::SERVICE_ID, ServicePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CourseHasServicesPeer::getOMClass();

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
					$temp_obj2->addCourseHasServices($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCourseHasServicess();
				$obj2->addCourseHasServices($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptService(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CourseHasServicesPeer::addSelectColumns($c);
		$startcol2 = (CourseHasServicesPeer::NUM_COLUMNS - CourseHasServicesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CoursePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CoursePeer::NUM_COLUMNS;

		$c->addJoin(CourseHasServicesPeer::COURSE_ID, CoursePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CourseHasServicesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CoursePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCourse(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCourseHasServices($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCourseHasServicess();
				$obj2->addCourseHasServices($obj1);
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
		return CourseHasServicesPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseHasServicesPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCourseHasServicesPeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseCourseHasServicesPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCourseHasServicesPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseHasServicesPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCourseHasServicesPeer', $values, $con);
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
			$comparison = $criteria->getComparison(CourseHasServicesPeer::COURSE_ID);
			$selectCriteria->add(CourseHasServicesPeer::COURSE_ID, $criteria->remove(CourseHasServicesPeer::COURSE_ID), $comparison);

			$comparison = $criteria->getComparison(CourseHasServicesPeer::SERVICE_ID);
			$selectCriteria->add(CourseHasServicesPeer::SERVICE_ID, $criteria->remove(CourseHasServicesPeer::SERVICE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCourseHasServicesPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCourseHasServicesPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(CourseHasServicesPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CourseHasServicesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CourseHasServices) {

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

			$criteria->add(CourseHasServicesPeer::COURSE_ID, $vals[0], Criteria::IN);
			$criteria->add(CourseHasServicesPeer::SERVICE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(CourseHasServices $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CourseHasServicesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CourseHasServicesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CourseHasServicesPeer::DATABASE_NAME, CourseHasServicesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CourseHasServicesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $course_id, $service_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CourseHasServicesPeer::COURSE_ID, $course_id);
		$criteria->add(CourseHasServicesPeer::SERVICE_ID, $service_id);
		$v = CourseHasServicesPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseCourseHasServicesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/CourseHasServicesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.CourseHasServicesMapBuilder');
}
