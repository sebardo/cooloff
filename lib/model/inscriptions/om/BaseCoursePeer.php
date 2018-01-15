<?php


abstract class BaseCoursePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'course';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.Course';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'course.ID';

	
	const CREATED_AT = 'course.CREATED_AT';

	
	const STARTS_AT = 'course.STARTS_AT';

	
	const ENDS_AT = 'course.ENDS_AT';

	
	const PRICE = 'course.PRICE';

	
	const NUMBER_OF_PLACES = 'course.NUMBER_OF_PLACES';

	
	const SUMMER_FUN_CENTER_ID = 'course.SUMMER_FUN_CENTER_ID';

	
	const IS_REGISTRATION_OPEN = 'course.IS_REGISTRATION_OPEN';

	
	const EXCURSION_ID = 'course.EXCURSION_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'StartsAt', 'EndsAt', 'Price', 'NumberOfPlaces', 'SummerFunCenterId', 'IsRegistrationOpen', 'ExcursionId', ),
		BasePeer::TYPE_COLNAME => array (CoursePeer::ID, CoursePeer::CREATED_AT, CoursePeer::STARTS_AT, CoursePeer::ENDS_AT, CoursePeer::PRICE, CoursePeer::NUMBER_OF_PLACES, CoursePeer::SUMMER_FUN_CENTER_ID, CoursePeer::IS_REGISTRATION_OPEN, CoursePeer::EXCURSION_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'starts_at', 'ends_at', 'price', 'number_of_places', 'summer_fun_center_id', 'is_registration_open', 'excursion_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'StartsAt' => 2, 'EndsAt' => 3, 'Price' => 4, 'NumberOfPlaces' => 5, 'SummerFunCenterId' => 6, 'IsRegistrationOpen' => 7, 'ExcursionId' => 8, ),
		BasePeer::TYPE_COLNAME => array (CoursePeer::ID => 0, CoursePeer::CREATED_AT => 1, CoursePeer::STARTS_AT => 2, CoursePeer::ENDS_AT => 3, CoursePeer::PRICE => 4, CoursePeer::NUMBER_OF_PLACES => 5, CoursePeer::SUMMER_FUN_CENTER_ID => 6, CoursePeer::IS_REGISTRATION_OPEN => 7, CoursePeer::EXCURSION_ID => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'starts_at' => 2, 'ends_at' => 3, 'price' => 4, 'number_of_places' => 5, 'summer_fun_center_id' => 6, 'is_registration_open' => 7, 'excursion_id' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/CourseMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.CourseMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CoursePeer::getTableMap();
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
		return str_replace(CoursePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CoursePeer::ID);

		$criteria->addSelectColumn(CoursePeer::CREATED_AT);

		$criteria->addSelectColumn(CoursePeer::STARTS_AT);

		$criteria->addSelectColumn(CoursePeer::ENDS_AT);

		$criteria->addSelectColumn(CoursePeer::PRICE);

		$criteria->addSelectColumn(CoursePeer::NUMBER_OF_PLACES);

		$criteria->addSelectColumn(CoursePeer::SUMMER_FUN_CENTER_ID);

		$criteria->addSelectColumn(CoursePeer::IS_REGISTRATION_OPEN);

		$criteria->addSelectColumn(CoursePeer::EXCURSION_ID);

	}

	const COUNT = 'COUNT(course.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT course.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CoursePeer::doSelectRS($criteria, $con);
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
		$objects = CoursePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CoursePeer::populateObjects(CoursePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCoursePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseCoursePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CoursePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CoursePeer::getOMClass();
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
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = CoursePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinExcursion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);

		$rs = CoursePeer::doSelectRS($criteria, $con);
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

		CoursePeer::addSelectColumns($c);
		$startcol = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CoursePeer::getOMClass();

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
										$temp_obj2->addCourse($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCourses();
				$obj2->addCourse($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinExcursion(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CoursePeer::addSelectColumns($c);
		$startcol = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ExcursionPeer::addSelectColumns($c);

		$c->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CoursePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ExcursionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getExcursion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCourse($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCourses();
				$obj2->addCourse($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$criteria->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);

		$rs = CoursePeer::doSelectRS($criteria, $con);
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

		CoursePeer::addSelectColumns($c);
		$startcol2 = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		ExcursionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ExcursionPeer::NUM_COLUMNS;

		$c->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$c->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CoursePeer::getOMClass();


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
					$temp_obj2->addCourse($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCourses();
				$obj2->addCourse($obj1);
			}


					
			$omClass = ExcursionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getExcursion(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCourse($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCourses();
				$obj3->addCourse($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSummerFunCenter(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);

		$rs = CoursePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptExcursion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CoursePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CoursePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = CoursePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSummerFunCenter(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CoursePeer::addSelectColumns($c);
		$startcol2 = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ExcursionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ExcursionPeer::NUM_COLUMNS;

		$c->addJoin(CoursePeer::EXCURSION_ID, ExcursionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CoursePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ExcursionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getExcursion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCourse($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCourses();
				$obj2->addCourse($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptExcursion(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CoursePeer::addSelectColumns($c);
		$startcol2 = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CoursePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SummerFunCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSummerFunCenter(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCourse($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCourses();
				$obj2->addCourse($obj1);
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

    CoursePeer::addSelectColumns($c);
    $startcol = (CoursePeer::NUM_COLUMNS - CoursePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    CourseI18nPeer::addSelectColumns($c);

    $c->addJoin(CoursePeer::ID, CourseI18nPeer::ID);
    $c->add(CourseI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = CoursePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = CourseI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setCourseI18nForCulture($obj2, $culture);
      $obj2->setCourse($obj1);

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
		return CoursePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCoursePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCoursePeer', $values, $con);
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

		$criteria->remove(CoursePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseCoursePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCoursePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCoursePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCoursePeer', $values, $con);
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
			$comparison = $criteria->getComparison(CoursePeer::ID);
			$selectCriteria->add(CoursePeer::ID, $criteria->remove(CoursePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCoursePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCoursePeer', $values, $con, $ret);
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
			$affectedRows += CoursePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(CoursePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Course) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CoursePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += CoursePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = CoursePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/inscriptions/CourseI18n.php';

						$c = new Criteria();
			
			$c->add(CourseI18nPeer::ID, $obj->getId());
			$affectedRows += CourseI18nPeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/Inscription.php';

						$c = new Criteria();
			
			$c->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $obj->getId());
			$affectedRows += InscriptionPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Course $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CoursePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CoursePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CoursePeer::DATABASE_NAME, CoursePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CoursePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CoursePeer::DATABASE_NAME);

		$criteria->add(CoursePeer::ID, $pk);


		$v = CoursePeer::doSelect($criteria, $con);

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
			$criteria->add(CoursePeer::ID, $pks, Criteria::IN);
			$objs = CoursePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCoursePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/CourseMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.CourseMapBuilder');
}
