<?php


abstract class BaseInscriptionCenterConfigurationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'inscription_center_configuration';

	
	const CLASS_DEFAULT = 'lib.model.inscriptions.InscriptionCenterConfiguration';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'inscription_center_configuration.ID';

	
	const CREATED_AT = 'inscription_center_configuration.CREATED_AT';

	
	const MORNING_SHELTER = 'inscription_center_configuration.MORNING_SHELTER';

	
	const AFTERNOON_SHELTER = 'inscription_center_configuration.AFTERNOON_SHELTER';

	
	const TEXT_SHELTER = 'inscription_center_configuration.TEXT_SHELTER';

	
	const TRANSFER_PAYMENT = 'inscription_center_configuration.TRANSFER_PAYMENT';

	
	const CASH_PAYMENT = 'inscription_center_configuration.CASH_PAYMENT';

	
	const SUMMER_FUN_CENTER_ID = 'inscription_center_configuration.SUMMER_FUN_CENTER_ID';

	
	const IS_REGISTRATION_OPEN = 'inscription_center_configuration.IS_REGISTRATION_OPEN';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'MorningShelter', 'AfternoonShelter', 'TextShelter', 'TransferPayment', 'CashPayment', 'SummerFunCenterId', 'IsRegistrationOpen', ),
		BasePeer::TYPE_COLNAME => array (InscriptionCenterConfigurationPeer::ID, InscriptionCenterConfigurationPeer::CREATED_AT, InscriptionCenterConfigurationPeer::MORNING_SHELTER, InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER, InscriptionCenterConfigurationPeer::TEXT_SHELTER, InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT, InscriptionCenterConfigurationPeer::CASH_PAYMENT, InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'morning_shelter', 'afternoon_shelter', 'text_shelter', 'transfer_payment', 'cash_payment', 'summer_fun_center_id', 'is_registration_open', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'MorningShelter' => 2, 'AfternoonShelter' => 3, 'TextShelter' => 4, 'TransferPayment' => 5, 'CashPayment' => 6, 'SummerFunCenterId' => 7, 'IsRegistrationOpen' => 8, ),
		BasePeer::TYPE_COLNAME => array (InscriptionCenterConfigurationPeer::ID => 0, InscriptionCenterConfigurationPeer::CREATED_AT => 1, InscriptionCenterConfigurationPeer::MORNING_SHELTER => 2, InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER => 3, InscriptionCenterConfigurationPeer::TEXT_SHELTER => 4, InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT => 5, InscriptionCenterConfigurationPeer::CASH_PAYMENT => 6, InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID => 7, InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'morning_shelter' => 2, 'afternoon_shelter' => 3, 'text_shelter' => 4, 'transfer_payment' => 5, 'cash_payment' => 6, 'summer_fun_center_id' => 7, 'is_registration_open' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/inscriptions/map/InscriptionCenterConfigurationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.inscriptions.map.InscriptionCenterConfigurationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InscriptionCenterConfigurationPeer::getTableMap();
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
		return str_replace(InscriptionCenterConfigurationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::ID);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::CREATED_AT);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::MORNING_SHELTER);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::TEXT_SHELTER);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::CASH_PAYMENT);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID);

		$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN);

	}

	const COUNT = 'COUNT(inscription_center_configuration.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT inscription_center_configuration.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InscriptionCenterConfigurationPeer::doSelectRS($criteria, $con);
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
		$objects = InscriptionCenterConfigurationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InscriptionCenterConfigurationPeer::populateObjects(InscriptionCenterConfigurationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfigurationPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionCenterConfigurationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InscriptionCenterConfigurationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InscriptionCenterConfigurationPeer::getOMClass();
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
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = InscriptionCenterConfigurationPeer::doSelectRS($criteria, $con);
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

		InscriptionCenterConfigurationPeer::addSelectColumns($c);
		$startcol = (InscriptionCenterConfigurationPeer::NUM_COLUMNS - InscriptionCenterConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionCenterConfigurationPeer::getOMClass();

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
										$temp_obj2->addInscriptionCenterConfiguration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInscriptionCenterConfigurations();
				$obj2->addInscriptionCenterConfiguration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InscriptionCenterConfigurationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = InscriptionCenterConfigurationPeer::doSelectRS($criteria, $con);
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

		InscriptionCenterConfigurationPeer::addSelectColumns($c);
		$startcol2 = (InscriptionCenterConfigurationPeer::NUM_COLUMNS - InscriptionCenterConfigurationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InscriptionCenterConfigurationPeer::getOMClass();


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
					$temp_obj2->addInscriptionCenterConfiguration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInscriptionCenterConfigurations();
				$obj2->addInscriptionCenterConfiguration($obj1);
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
		return InscriptionCenterConfigurationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfigurationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionCenterConfigurationPeer', $values, $con);
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

		$criteria->remove(InscriptionCenterConfigurationPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInscriptionCenterConfigurationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionCenterConfigurationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfigurationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInscriptionCenterConfigurationPeer', $values, $con);
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
			$comparison = $criteria->getComparison(InscriptionCenterConfigurationPeer::ID);
			$selectCriteria->add(InscriptionCenterConfigurationPeer::ID, $criteria->remove(InscriptionCenterConfigurationPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfigurationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInscriptionCenterConfigurationPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(InscriptionCenterConfigurationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InscriptionCenterConfigurationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InscriptionCenterConfiguration) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InscriptionCenterConfigurationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(InscriptionCenterConfiguration $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InscriptionCenterConfigurationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InscriptionCenterConfigurationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InscriptionCenterConfigurationPeer::DATABASE_NAME, InscriptionCenterConfigurationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InscriptionCenterConfigurationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(InscriptionCenterConfigurationPeer::DATABASE_NAME);

		$criteria->add(InscriptionCenterConfigurationPeer::ID, $pk);


		$v = InscriptionCenterConfigurationPeer::doSelect($criteria, $con);

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
			$criteria->add(InscriptionCenterConfigurationPeer::ID, $pks, Criteria::IN);
			$objs = InscriptionCenterConfigurationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInscriptionCenterConfigurationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/inscriptions/map/InscriptionCenterConfigurationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.inscriptions.map.InscriptionCenterConfigurationMapBuilder');
}
