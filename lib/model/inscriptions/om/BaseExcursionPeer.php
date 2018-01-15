<?php


abstract class BaseExcursionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'excursion';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.Excursion';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'excursion.ID';

	
	const CREATED_AT = 'excursion.CREATED_AT';

	
	const UPDATED_AT = 'excursion.UPDATED_AT';

	
	const CENTRO_ID = 'excursion.CENTRO_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'CentroId', ),
		BasePeer::TYPE_COLNAME => array (ExcursionPeer::ID, ExcursionPeer::CREATED_AT, ExcursionPeer::UPDATED_AT, ExcursionPeer::CENTRO_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'centro_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'CentroId' => 3, ),
		BasePeer::TYPE_COLNAME => array (ExcursionPeer::ID => 0, ExcursionPeer::CREATED_AT => 1, ExcursionPeer::UPDATED_AT => 2, ExcursionPeer::CENTRO_ID => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'centro_id' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/ExcursionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.ExcursionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ExcursionPeer::getTableMap();
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
		return str_replace(ExcursionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ExcursionPeer::ID);

		$criteria->addSelectColumn(ExcursionPeer::CREATED_AT);

		$criteria->addSelectColumn(ExcursionPeer::UPDATED_AT);

		$criteria->addSelectColumn(ExcursionPeer::CENTRO_ID);

	}

	const COUNT = 'COUNT(excursion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT excursion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ExcursionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExcursionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ExcursionPeer::doSelectRS($criteria, $con);
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
		$objects = ExcursionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ExcursionPeer::populateObjects(ExcursionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursionPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseExcursionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ExcursionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ExcursionPeer::getOMClass();
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
			$criteria->addSelectColumn(ExcursionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExcursionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExcursionPeer::CENTRO_ID, SummerFunCenterPeer::ID);

		$rs = ExcursionPeer::doSelectRS($criteria, $con);
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

		ExcursionPeer::addSelectColumns($c);
		$startcol = (ExcursionPeer::NUM_COLUMNS - ExcursionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(ExcursionPeer::CENTRO_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExcursionPeer::getOMClass();

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
										$temp_obj2->addExcursion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initExcursions();
				$obj2->addExcursion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ExcursionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExcursionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExcursionPeer::CENTRO_ID, SummerFunCenterPeer::ID);

		$rs = ExcursionPeer::doSelectRS($criteria, $con);
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

		ExcursionPeer::addSelectColumns($c);
		$startcol2 = (ExcursionPeer::NUM_COLUMNS - ExcursionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(ExcursionPeer::CENTRO_ID, SummerFunCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExcursionPeer::getOMClass();


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
					$temp_obj2->addExcursion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initExcursions();
				$obj2->addExcursion($obj1);
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

    ExcursionPeer::addSelectColumns($c);
    $startcol = (ExcursionPeer::NUM_COLUMNS - ExcursionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    ExcursionI18nPeer::addSelectColumns($c);

    $c->addJoin(ExcursionPeer::ID, ExcursionI18nPeer::ID);
    $c->add(ExcursionI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = ExcursionPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = ExcursionI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setExcursionI18nForCulture($obj2, $culture);
      $obj2->setExcursion($obj1);

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
		return ExcursionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseExcursionPeer', $values, $con);
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

		$criteria->remove(ExcursionPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseExcursionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseExcursionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseExcursionPeer', $values, $con);
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
			$comparison = $criteria->getComparison(ExcursionPeer::ID);
			$selectCriteria->add(ExcursionPeer::ID, $criteria->remove(ExcursionPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseExcursionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseExcursionPeer', $values, $con, $ret);
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
			$affectedRows += ExcursionPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ExcursionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ExcursionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Excursion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ExcursionPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ExcursionPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ExcursionPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/inscriptions/Course.php';

						$c = new Criteria();
			
			$c->add(CoursePeer::EXCURSION_ID, $obj->getId());
			$affectedRows += CoursePeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/ExcursionI18n.php';

						$c = new Criteria();
			
			$c->add(ExcursionI18nPeer::ID, $obj->getId());
			$affectedRows += ExcursionI18nPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Excursion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ExcursionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ExcursionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ExcursionPeer::DATABASE_NAME, ExcursionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ExcursionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ExcursionPeer::DATABASE_NAME);

		$criteria->add(ExcursionPeer::ID, $pk);


		$v = ExcursionPeer::doSelect($criteria, $con);

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
			$criteria->add(ExcursionPeer::ID, $pks, Criteria::IN);
			$objs = ExcursionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseExcursionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/ExcursionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.ExcursionMapBuilder');
}
