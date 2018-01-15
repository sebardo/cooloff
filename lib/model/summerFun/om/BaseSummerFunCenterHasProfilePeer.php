<?php


abstract class BaseSummerFunCenterHasProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'summer_fun_center_has_profile';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.SummerFunCenterHasProfile';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SUMMER_FUN_CENTER_ID = 'summer_fun_center_has_profile.SUMMER_FUN_CENTER_ID';

	
	const PROFILE_ID = 'summer_fun_center_has_profile.PROFILE_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('SummerFunCenterId', 'ProfileId', ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterHasProfilePeer::PROFILE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('summer_fun_center_id', 'profile_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('SummerFunCenterId' => 0, 'ProfileId' => 1, ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID => 0, SummerFunCenterHasProfilePeer::PROFILE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('summer_fun_center_id' => 0, 'profile_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/SummerFunCenterHasProfileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.SummerFunCenterHasProfileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SummerFunCenterHasProfilePeer::getTableMap();
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
		return str_replace(SummerFunCenterHasProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID);

		$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::PROFILE_ID);

	}

	const COUNT = 'COUNT(summer_fun_center_has_profile.SUMMER_FUN_CENTER_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT summer_fun_center_has_profile.SUMMER_FUN_CENTER_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
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
		$objects = SummerFunCenterHasProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SummerFunCenterHasProfilePeer::populateObjects(SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfilePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterHasProfilePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SummerFunCenterHasProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SummerFunCenterHasProfilePeer::getOMClass();
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
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinsfGuardUserProfile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
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

		SummerFunCenterHasProfilePeer::addSelectColumns($c);
		$startcol = (SummerFunCenterHasProfilePeer::NUM_COLUMNS - SummerFunCenterHasProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterHasProfilePeer::getOMClass();

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
										$temp_obj2->addSummerFunCenterHasProfile($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSummerFunCenterHasProfiles();
				$obj2->addSummerFunCenterHasProfile($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinsfGuardUserProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SummerFunCenterHasProfilePeer::addSelectColumns($c);
		$startcol = (SummerFunCenterHasProfilePeer::NUM_COLUMNS - SummerFunCenterHasProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserProfilePeer::addSelectColumns($c);

		$c->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterHasProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSummerFunCenterHasProfile($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSummerFunCenterHasProfiles();
				$obj2->addSummerFunCenterHasProfile($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$criteria->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
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

		SummerFunCenterHasProfilePeer::addSelectColumns($c);
		$startcol2 = (SummerFunCenterHasProfilePeer::NUM_COLUMNS - SummerFunCenterHasProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserProfilePeer::NUM_COLUMNS;

		$c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$c->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterHasProfilePeer::getOMClass();


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
					$temp_obj2->addSummerFunCenterHasProfile($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSummerFunCenterHasProfiles();
				$obj2->addSummerFunCenterHasProfile($obj1);
			}


					
			$omClass = sfGuardUserProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSummerFunCenterHasProfile($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initSummerFunCenterHasProfiles();
				$obj3->addSummerFunCenterHasProfile($obj1);
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
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptsfGuardUserProfile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterHasProfilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = SummerFunCenterHasProfilePeer::doSelectRS($criteria, $con);
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

		SummerFunCenterHasProfilePeer::addSelectColumns($c);
		$startcol2 = (SummerFunCenterHasProfilePeer::NUM_COLUMNS - SummerFunCenterHasProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserProfilePeer::NUM_COLUMNS;

		$c->addJoin(SummerFunCenterHasProfilePeer::PROFILE_ID, sfGuardUserProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterHasProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSummerFunCenterHasProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSummerFunCenterHasProfiles();
				$obj2->addSummerFunCenterHasProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfGuardUserProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SummerFunCenterHasProfilePeer::addSelectColumns($c);
		$startcol2 = (SummerFunCenterHasProfilePeer::NUM_COLUMNS - SummerFunCenterHasProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterHasProfilePeer::getOMClass();

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
					$temp_obj2->addSummerFunCenterHasProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSummerFunCenterHasProfiles();
				$obj2->addSummerFunCenterHasProfile($obj1);
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
		return SummerFunCenterHasProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfilePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterHasProfilePeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfilePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterHasProfilePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfilePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterHasProfilePeer', $values, $con);
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
			$comparison = $criteria->getComparison(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID);
			$selectCriteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $criteria->remove(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID), $comparison);

			$comparison = $criteria->getComparison(SummerFunCenterHasProfilePeer::PROFILE_ID);
			$selectCriteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $criteria->remove(SummerFunCenterHasProfilePeer::PROFILE_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfilePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterHasProfilePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(SummerFunCenterHasProfilePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SummerFunCenterHasProfilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SummerFunCenterHasProfile) {

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

			$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $vals[0], Criteria::IN);
			$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(SummerFunCenterHasProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SummerFunCenterHasProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SummerFunCenterHasProfilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SummerFunCenterHasProfilePeer::DATABASE_NAME, SummerFunCenterHasProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SummerFunCenterHasProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $summer_fun_center_id, $profile_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $summer_fun_center_id);
		$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $profile_id);
		$v = SummerFunCenterHasProfilePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseSummerFunCenterHasProfilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/SummerFunCenterHasProfileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.SummerFunCenterHasProfileMapBuilder');
}
