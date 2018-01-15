<?php


abstract class BaseServicePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'service';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.Service';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'service.ID';

	
	const CENTER_ID = 'service.CENTER_ID';

	
	const PRICE = 'service.PRICE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CenterId', 'Price', ),
		BasePeer::TYPE_COLNAME => array (ServicePeer::ID, ServicePeer::CENTER_ID, ServicePeer::PRICE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'center_id', 'price', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CenterId' => 1, 'Price' => 2, ),
		BasePeer::TYPE_COLNAME => array (ServicePeer::ID => 0, ServicePeer::CENTER_ID => 1, ServicePeer::PRICE => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'center_id' => 1, 'price' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/ServiceMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.ServiceMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ServicePeer::getTableMap();
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
		return str_replace(ServicePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ServicePeer::ID);

		$criteria->addSelectColumn(ServicePeer::CENTER_ID);

		$criteria->addSelectColumn(ServicePeer::PRICE);

	}

	const COUNT = 'COUNT(service.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT service.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ServicePeer::doSelectRS($criteria, $con);
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
		$objects = ServicePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ServicePeer::populateObjects(ServicePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServicePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseServicePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ServicePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ServicePeer::getOMClass();
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
			$criteria->addSelectColumn(ServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = ServicePeer::doSelectRS($criteria, $con);
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

		ServicePeer::addSelectColumns($c);
		$startcol = (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServicePeer::getOMClass();

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
										$temp_obj2->addService($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initServices();
				$obj2->addService($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ServicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ServicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = ServicePeer::doSelectRS($criteria, $con);
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

		ServicePeer::addSelectColumns($c);
		$startcol2 = (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ServicePeer::getOMClass();


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
					$temp_obj2->addService($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initServices();
				$obj2->addService($obj1);
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

    ServicePeer::addSelectColumns($c);
    $startcol = (ServicePeer::NUM_COLUMNS - ServicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    ServiceI18nPeer::addSelectColumns($c);

    $c->addJoin(ServicePeer::ID, ServiceI18nPeer::ID);
    $c->add(ServiceI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = ServicePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = ServiceI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setServiceI18nForCulture($obj2, $culture);
      $obj2->setService($obj1);

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
		return ServicePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServicePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseServicePeer', $values, $con);
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

		$criteria->remove(ServicePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseServicePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseServicePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseServicePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseServicePeer', $values, $con);
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
			$comparison = $criteria->getComparison(ServicePeer::ID);
			$selectCriteria->add(ServicePeer::ID, $criteria->remove(ServicePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseServicePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseServicePeer', $values, $con, $ret);
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
			$affectedRows += ServicePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ServicePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Service) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ServicePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ServicePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ServicePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/summerFun/ServiceI18n.php';

						$c = new Criteria();
			
			$c->add(ServiceI18nPeer::ID, $obj->getId());
			$affectedRows += ServiceI18nPeer::doDelete($c, $con);

			include_once 'lib/model/summerFun/ServiceSchedule.php';

						$c = new Criteria();
			
			$c->add(ServiceSchedulePeer::SERVICE_ID, $obj->getId());
			$affectedRows += ServiceSchedulePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Service $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ServicePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ServicePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ServicePeer::DATABASE_NAME, ServicePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ServicePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		$criteria->add(ServicePeer::ID, $pk);


		$v = ServicePeer::doSelect($criteria, $con);

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
			$criteria->add(ServicePeer::ID, $pks, Criteria::IN);
			$objs = ServicePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseServicePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/ServiceMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.ServiceMapBuilder');
}
