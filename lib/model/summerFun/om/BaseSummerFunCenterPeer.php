<?php


abstract class BaseSummerFunCenterPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'summer_fun_center';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.SummerFunCenter';

	
	const NUM_COLUMNS = 24;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'summer_fun_center.ID';

	
	const CREATED_AT = 'summer_fun_center.CREATED_AT';

	
	const UPDATED_AT = 'summer_fun_center.UPDATED_AT';

	
	const SUMMER_FUN_ZONE_ID = 'summer_fun_center.SUMMER_FUN_ZONE_ID';

	
	const MORNING_SHELTER = 'summer_fun_center.MORNING_SHELTER';

	
	const AFTERNOON_SHELTER = 'summer_fun_center.AFTERNOON_SHELTER';

	
	const TRANSFER_PAYMENT = 'summer_fun_center.TRANSFER_PAYMENT';

	
	const CASH_PAYMENT = 'summer_fun_center.CASH_PAYMENT';

	
	const TPV_PAYMENT = 'summer_fun_center.TPV_PAYMENT';

	
	const IS_REGISTRATION_OPEN = 'summer_fun_center.IS_REGISTRATION_OPEN';

	
	const ACCOUNT_NUMBER = 'summer_fun_center.ACCOUNT_NUMBER';

	
	const MAIL = 'summer_fun_center.MAIL';

	
	const WEEKS_DISCOUNT = 'summer_fun_center.WEEKS_DISCOUNT';

	
	const WEEKS_PERCENT_DISCOUNT = 'summer_fun_center.WEEKS_PERCENT_DISCOUNT';

	
	const BROTHERS_DISCOUNT = 'summer_fun_center.BROTHERS_DISCOUNT';

	
	const BROTHERS_PERCENT_DISCOUNT = 'summer_fun_center.BROTHERS_PERCENT_DISCOUNT';

	
	const SHOW_EXCURSION_WIDGET = 'summer_fun_center.SHOW_EXCURSION_WIDGET';

	
	const RECIBO_DOMICILIADO_PAYMENT = 'summer_fun_center.RECIBO_DOMICILIADO_PAYMENT';

	
	const SHOW_BECA_WIDGET = 'summer_fun_center.SHOW_BECA_WIDGET';

	
	const MERCHANT_CODE = 'summer_fun_center.MERCHANT_CODE';

	
	const MERCHANT_KEY = 'summer_fun_center.MERCHANT_KEY';

	
	const URL_TPV = 'summer_fun_center.URL_TPV';

	
	const SECOND_PAYMENT_MAILING_DATE = 'summer_fun_center.SECOND_PAYMENT_MAILING_DATE';

	
	const SECOND_PAYMENT_DATE = 'summer_fun_center.SECOND_PAYMENT_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'SummerFunZoneId', 'MorningShelter', 'AfternoonShelter', 'TransferPayment', 'CashPayment', 'TpvPayment', 'IsRegistrationOpen', 'AccountNumber', 'Mail', 'WeeksDiscount', 'WeeksPercentDiscount', 'BrothersDiscount', 'BrothersPercentDiscount', 'ShowExcursionWidget', 'ReciboDomiciliadoPayment', 'ShowBecaWidget', 'MerchantCode', 'MerchantKey', 'UrlTpv', 'SecondPaymentMailingDate', 'SecondPaymentDate', ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterPeer::ID, SummerFunCenterPeer::CREATED_AT, SummerFunCenterPeer::UPDATED_AT, SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, SummerFunCenterPeer::MORNING_SHELTER, SummerFunCenterPeer::AFTERNOON_SHELTER, SummerFunCenterPeer::TRANSFER_PAYMENT, SummerFunCenterPeer::CASH_PAYMENT, SummerFunCenterPeer::TPV_PAYMENT, SummerFunCenterPeer::IS_REGISTRATION_OPEN, SummerFunCenterPeer::ACCOUNT_NUMBER, SummerFunCenterPeer::MAIL, SummerFunCenterPeer::WEEKS_DISCOUNT, SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT, SummerFunCenterPeer::BROTHERS_DISCOUNT, SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT, SummerFunCenterPeer::SHOW_EXCURSION_WIDGET, SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT, SummerFunCenterPeer::SHOW_BECA_WIDGET, SummerFunCenterPeer::MERCHANT_CODE, SummerFunCenterPeer::MERCHANT_KEY, SummerFunCenterPeer::URL_TPV, SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE, SummerFunCenterPeer::SECOND_PAYMENT_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'summer_fun_zone_id', 'morning_shelter', 'afternoon_shelter', 'transfer_payment', 'cash_payment', 'tpv_payment', 'is_registration_open', 'account_number', 'mail', 'weeks_discount', 'weeks_percent_discount', 'brothers_discount', 'brothers_percent_discount', 'show_excursion_widget', 'recibo_domiciliado_payment', 'show_beca_widget', 'merchant_code', 'merchant_key', 'url_tpv', 'second_payment_mailing_date', 'second_payment_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'SummerFunZoneId' => 3, 'MorningShelter' => 4, 'AfternoonShelter' => 5, 'TransferPayment' => 6, 'CashPayment' => 7, 'TpvPayment' => 8, 'IsRegistrationOpen' => 9, 'AccountNumber' => 10, 'Mail' => 11, 'WeeksDiscount' => 12, 'WeeksPercentDiscount' => 13, 'BrothersDiscount' => 14, 'BrothersPercentDiscount' => 15, 'ShowExcursionWidget' => 16, 'ReciboDomiciliadoPayment' => 17, 'ShowBecaWidget' => 18, 'MerchantCode' => 19, 'MerchantKey' => 20, 'UrlTpv' => 21, 'SecondPaymentMailingDate' => 22, 'SecondPaymentDate' => 23, ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterPeer::ID => 0, SummerFunCenterPeer::CREATED_AT => 1, SummerFunCenterPeer::UPDATED_AT => 2, SummerFunCenterPeer::SUMMER_FUN_ZONE_ID => 3, SummerFunCenterPeer::MORNING_SHELTER => 4, SummerFunCenterPeer::AFTERNOON_SHELTER => 5, SummerFunCenterPeer::TRANSFER_PAYMENT => 6, SummerFunCenterPeer::CASH_PAYMENT => 7, SummerFunCenterPeer::TPV_PAYMENT => 8, SummerFunCenterPeer::IS_REGISTRATION_OPEN => 9, SummerFunCenterPeer::ACCOUNT_NUMBER => 10, SummerFunCenterPeer::MAIL => 11, SummerFunCenterPeer::WEEKS_DISCOUNT => 12, SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT => 13, SummerFunCenterPeer::BROTHERS_DISCOUNT => 14, SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT => 15, SummerFunCenterPeer::SHOW_EXCURSION_WIDGET => 16, SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT => 17, SummerFunCenterPeer::SHOW_BECA_WIDGET => 18, SummerFunCenterPeer::MERCHANT_CODE => 19, SummerFunCenterPeer::MERCHANT_KEY => 20, SummerFunCenterPeer::URL_TPV => 21, SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE => 22, SummerFunCenterPeer::SECOND_PAYMENT_DATE => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'summer_fun_zone_id' => 3, 'morning_shelter' => 4, 'afternoon_shelter' => 5, 'transfer_payment' => 6, 'cash_payment' => 7, 'tpv_payment' => 8, 'is_registration_open' => 9, 'account_number' => 10, 'mail' => 11, 'weeks_discount' => 12, 'weeks_percent_discount' => 13, 'brothers_discount' => 14, 'brothers_percent_discount' => 15, 'show_excursion_widget' => 16, 'recibo_domiciliado_payment' => 17, 'show_beca_widget' => 18, 'merchant_code' => 19, 'merchant_key' => 20, 'url_tpv' => 21, 'second_payment_mailing_date' => 22, 'second_payment_date' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/SummerFunCenterMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.SummerFunCenterMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SummerFunCenterPeer::getTableMap();
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
		return str_replace(SummerFunCenterPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SummerFunCenterPeer::ID);

		$criteria->addSelectColumn(SummerFunCenterPeer::CREATED_AT);

		$criteria->addSelectColumn(SummerFunCenterPeer::UPDATED_AT);

		$criteria->addSelectColumn(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID);

		$criteria->addSelectColumn(SummerFunCenterPeer::MORNING_SHELTER);

		$criteria->addSelectColumn(SummerFunCenterPeer::AFTERNOON_SHELTER);

		$criteria->addSelectColumn(SummerFunCenterPeer::TRANSFER_PAYMENT);

		$criteria->addSelectColumn(SummerFunCenterPeer::CASH_PAYMENT);

		$criteria->addSelectColumn(SummerFunCenterPeer::TPV_PAYMENT);

		$criteria->addSelectColumn(SummerFunCenterPeer::IS_REGISTRATION_OPEN);

		$criteria->addSelectColumn(SummerFunCenterPeer::ACCOUNT_NUMBER);

		$criteria->addSelectColumn(SummerFunCenterPeer::MAIL);

		$criteria->addSelectColumn(SummerFunCenterPeer::WEEKS_DISCOUNT);

		$criteria->addSelectColumn(SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT);

		$criteria->addSelectColumn(SummerFunCenterPeer::BROTHERS_DISCOUNT);

		$criteria->addSelectColumn(SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT);

		$criteria->addSelectColumn(SummerFunCenterPeer::SHOW_EXCURSION_WIDGET);

		$criteria->addSelectColumn(SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT);

		$criteria->addSelectColumn(SummerFunCenterPeer::SHOW_BECA_WIDGET);

		$criteria->addSelectColumn(SummerFunCenterPeer::MERCHANT_CODE);

		$criteria->addSelectColumn(SummerFunCenterPeer::MERCHANT_KEY);

		$criteria->addSelectColumn(SummerFunCenterPeer::URL_TPV);

		$criteria->addSelectColumn(SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE);

		$criteria->addSelectColumn(SummerFunCenterPeer::SECOND_PAYMENT_DATE);

	}

	const COUNT = 'COUNT(summer_fun_center.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT summer_fun_center.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SummerFunCenterPeer::doSelectRS($criteria, $con);
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
		$objects = SummerFunCenterPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SummerFunCenterPeer::populateObjects(SummerFunCenterPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SummerFunCenterPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SummerFunCenterPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSummerFunZone(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, SummerFunZonePeer::ID);

		$rs = SummerFunCenterPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSummerFunZone(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol = (SummerFunCenterPeer::NUM_COLUMNS - SummerFunCenterPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunZonePeer::addSelectColumns($c);

		$c->addJoin(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, SummerFunZonePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SummerFunZonePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSummerFunZone(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSummerFunCenter($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSummerFunCenters();
				$obj2->addSummerFunCenter($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, SummerFunZonePeer::ID);

		$rs = SummerFunCenterPeer::doSelectRS($criteria, $con);
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

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol2 = (SummerFunCenterPeer::NUM_COLUMNS - SummerFunCenterPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunZonePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunZonePeer::NUM_COLUMNS;

		$c->addJoin(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, SummerFunZonePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SummerFunZonePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSummerFunZone(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSummerFunCenter($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSummerFunCenters();
				$obj2->addSummerFunCenter($obj1);
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

    SummerFunCenterPeer::addSelectColumns($c);
    $startcol = (SummerFunCenterPeer::NUM_COLUMNS - SummerFunCenterPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    SummerFunCenterI18nPeer::addSelectColumns($c);

    $c->addJoin(SummerFunCenterPeer::ID, SummerFunCenterI18nPeer::ID);
    $c->add(SummerFunCenterI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = SummerFunCenterPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = SummerFunCenterI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setSummerFunCenterI18nForCulture($obj2, $culture);
      $obj2->setSummerFunCenter($obj1);

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
		return SummerFunCenterPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterPeer', $values, $con);
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

		$criteria->remove(SummerFunCenterPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseSummerFunCenterPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterPeer', $values, $con);
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
			$comparison = $criteria->getComparison(SummerFunCenterPeer::ID);
			$selectCriteria->add(SummerFunCenterPeer::ID, $criteria->remove(SummerFunCenterPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterPeer', $values, $con, $ret);
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
			$affectedRows += SummerFunCenterPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(SummerFunCenterPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SummerFunCenterPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SummerFunCenter) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SummerFunCenterPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += SummerFunCenterPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = SummerFunCenterPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/inscriptions/Week.php';

						$c = new Criteria();
			
			$c->add(WeekPeer::CENTRO_ID, $obj->getId());
			$affectedRows += WeekPeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/Course.php';

						$c = new Criteria();
			
			$c->add(CoursePeer::SUMMER_FUN_CENTER_ID, $obj->getId());
			$affectedRows += CoursePeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/Grupo.php';

						$c = new Criteria();
			
			$c->add(GrupoPeer::CENTRO_ID, $obj->getId());
			$affectedRows += GrupoPeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/Profesor.php';

						$c = new Criteria();
			
			$c->add(ProfesorPeer::CENTRO_ID, $obj->getId());
			$affectedRows += ProfesorPeer::doDelete($c, $con);

			include_once 'lib/model/inscriptions/Excursion.php';

						$c = new Criteria();
			
			$c->add(ExcursionPeer::CENTRO_ID, $obj->getId());
			$affectedRows += ExcursionPeer::doDelete($c, $con);

			include_once 'lib/model/summerFun/SummerFunCenterI18n.php';

						$c = new Criteria();
			
			$c->add(SummerFunCenterI18nPeer::ID, $obj->getId());
			$affectedRows += SummerFunCenterI18nPeer::doDelete($c, $con);

			include_once 'lib/model/summerFun/SummerFunCenterHasProfile.php';

						$c = new Criteria();
			
			$c->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $obj->getId());
			$affectedRows += SummerFunCenterHasProfilePeer::doDelete($c, $con);

			include_once 'lib/model/summerFun/SummerFunCenterNewsItem.php';

						$c = new Criteria();
			
			$c->add(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, $obj->getId());
			$affectedRows += SummerFunCenterNewsItemPeer::doDelete($c, $con);

			include_once 'lib/model/summerFun/Service.php';

						$c = new Criteria();
			
			$c->add(ServicePeer::CENTER_ID, $obj->getId());
			$affectedRows += ServicePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(SummerFunCenter $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SummerFunCenterPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SummerFunCenterPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SummerFunCenterPeer::DATABASE_NAME, SummerFunCenterPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SummerFunCenterPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SummerFunCenterPeer::DATABASE_NAME);

		$criteria->add(SummerFunCenterPeer::ID, $pk);


		$v = SummerFunCenterPeer::doSelect($criteria, $con);

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
			$criteria->add(SummerFunCenterPeer::ID, $pks, Criteria::IN);
			$objs = SummerFunCenterPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSummerFunCenterPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/SummerFunCenterMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.SummerFunCenterMapBuilder');
}
