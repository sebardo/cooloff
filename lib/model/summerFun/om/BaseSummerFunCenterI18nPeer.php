<?php


abstract class BaseSummerFunCenterI18nPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'summer_fun_center_i18n';

	
	const CLASS_DEFAULT = 'lib.model.summerFun.SummerFunCenterI18n';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const TITLE = 'summer_fun_center_i18n.TITLE';

	
	const DESCRIPTION = 'summer_fun_center_i18n.DESCRIPTION';

	
	const TEXT_SHELTER = 'summer_fun_center_i18n.TEXT_SHELTER';

	
	const INSCRIPTION_CONFIRMATION_MAIL = 'summer_fun_center_i18n.INSCRIPTION_CONFIRMATION_MAIL';

	
	const INSCRIPTION_CONDITIONS_TERMS_PDF = 'summer_fun_center_i18n.INSCRIPTION_CONDITIONS_TERMS_PDF';

	
	const CUSTOM_QUESTION = 'summer_fun_center_i18n.CUSTOM_QUESTION';

	
	const RECIBO_DOMICILIADO_TXT = 'summer_fun_center_i18n.RECIBO_DOMICILIADO_TXT';

	
	const SECOND_PAYMENT_MAILING_BODY = 'summer_fun_center_i18n.SECOND_PAYMENT_MAILING_BODY';

	
	const SECOND_PAYMENT_MAILING_BODY_NO_TPV = 'summer_fun_center_i18n.SECOND_PAYMENT_MAILING_BODY_NO_TPV';

	
	const ID = 'summer_fun_center_i18n.ID';

	
	const CULTURE = 'summer_fun_center_i18n.CULTURE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Title', 'Description', 'TextShelter', 'InscriptionConfirmationMail', 'InscriptionConditionsTermsPdf', 'CustomQuestion', 'ReciboDomiciliadoTxt', 'SecondPaymentMailingBody', 'SecondPaymentMailingBodyNoTpv', 'Id', 'Culture', ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterI18nPeer::TITLE, SummerFunCenterI18nPeer::DESCRIPTION, SummerFunCenterI18nPeer::TEXT_SHELTER, SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL, SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF, SummerFunCenterI18nPeer::CUSTOM_QUESTION, SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT, SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY, SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV, SummerFunCenterI18nPeer::ID, SummerFunCenterI18nPeer::CULTURE, ),
		BasePeer::TYPE_FIELDNAME => array ('title', 'description', 'text_shelter', 'inscription_confirmation_mail', 'inscription_conditions_terms_pdf', 'custom_question', 'recibo_domiciliado_txt', 'second_payment_mailing_body', 'second_payment_mailing_body_no_tpv', 'id', 'culture', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Title' => 0, 'Description' => 1, 'TextShelter' => 2, 'InscriptionConfirmationMail' => 3, 'InscriptionConditionsTermsPdf' => 4, 'CustomQuestion' => 5, 'ReciboDomiciliadoTxt' => 6, 'SecondPaymentMailingBody' => 7, 'SecondPaymentMailingBodyNoTpv' => 8, 'Id' => 9, 'Culture' => 10, ),
		BasePeer::TYPE_COLNAME => array (SummerFunCenterI18nPeer::TITLE => 0, SummerFunCenterI18nPeer::DESCRIPTION => 1, SummerFunCenterI18nPeer::TEXT_SHELTER => 2, SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL => 3, SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF => 4, SummerFunCenterI18nPeer::CUSTOM_QUESTION => 5, SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT => 6, SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY => 7, SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV => 8, SummerFunCenterI18nPeer::ID => 9, SummerFunCenterI18nPeer::CULTURE => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('title' => 0, 'description' => 1, 'text_shelter' => 2, 'inscription_confirmation_mail' => 3, 'inscription_conditions_terms_pdf' => 4, 'custom_question' => 5, 'recibo_domiciliado_txt' => 6, 'second_payment_mailing_body' => 7, 'second_payment_mailing_body_no_tpv' => 8, 'id' => 9, 'culture' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/summerFun/map/SummerFunCenterI18nMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.summerFun.map.SummerFunCenterI18nMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SummerFunCenterI18nPeer::getTableMap();
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
		return str_replace(SummerFunCenterI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::TITLE);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::DESCRIPTION);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::TEXT_SHELTER);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::CUSTOM_QUESTION);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::ID);

		$criteria->addSelectColumn(SummerFunCenterI18nPeer::CULTURE);

	}

	const COUNT = 'COUNT(summer_fun_center_i18n.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT summer_fun_center_i18n.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SummerFunCenterI18nPeer::doSelectRS($criteria, $con);
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
		$objects = SummerFunCenterI18nPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SummerFunCenterI18nPeer::populateObjects(SummerFunCenterI18nPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18nPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SummerFunCenterI18nPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SummerFunCenterI18nPeer::getOMClass();
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
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterI18nPeer::ID, SummerFunCenterPeer::ID);

		$rs = SummerFunCenterI18nPeer::doSelectRS($criteria, $con);
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

		SummerFunCenterI18nPeer::addSelectColumns($c);
		$startcol = (SummerFunCenterI18nPeer::NUM_COLUMNS - SummerFunCenterI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SummerFunCenterPeer::addSelectColumns($c);

		$c->addJoin(SummerFunCenterI18nPeer::ID, SummerFunCenterPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterI18nPeer::getOMClass();

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
										$temp_obj2->addSummerFunCenterI18n($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSummerFunCenterI18ns();
				$obj2->addSummerFunCenterI18n($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SummerFunCenterI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SummerFunCenterI18nPeer::ID, SummerFunCenterPeer::ID);

		$rs = SummerFunCenterI18nPeer::doSelectRS($criteria, $con);
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

		SummerFunCenterI18nPeer::addSelectColumns($c);
		$startcol2 = (SummerFunCenterI18nPeer::NUM_COLUMNS - SummerFunCenterI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SummerFunCenterPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SummerFunCenterPeer::NUM_COLUMNS;

		$c->addJoin(SummerFunCenterI18nPeer::ID, SummerFunCenterPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SummerFunCenterI18nPeer::getOMClass();


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
					$temp_obj2->addSummerFunCenterI18n($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSummerFunCenterI18ns();
				$obj2->addSummerFunCenterI18n($obj1);
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
		return SummerFunCenterI18nPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterI18nPeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseSummerFunCenterI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSummerFunCenterI18nPeer', $values, $con);
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
			$comparison = $criteria->getComparison(SummerFunCenterI18nPeer::ID);
			$selectCriteria->add(SummerFunCenterI18nPeer::ID, $criteria->remove(SummerFunCenterI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(SummerFunCenterI18nPeer::CULTURE);
			$selectCriteria->add(SummerFunCenterI18nPeer::CULTURE, $criteria->remove(SummerFunCenterI18nPeer::CULTURE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSummerFunCenterI18nPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(SummerFunCenterI18nPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SummerFunCenterI18nPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SummerFunCenterI18n) {

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

			$criteria->add(SummerFunCenterI18nPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(SummerFunCenterI18nPeer::CULTURE, $vals[1], Criteria::IN);
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

	
	public static function doValidate(SummerFunCenterI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SummerFunCenterI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SummerFunCenterI18nPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SummerFunCenterI18nPeer::DATABASE_NAME, SummerFunCenterI18nPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SummerFunCenterI18nPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $culture, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(SummerFunCenterI18nPeer::ID, $id);
		$criteria->add(SummerFunCenterI18nPeer::CULTURE, $culture);
		$v = SummerFunCenterI18nPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseSummerFunCenterI18nPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/summerFun/map/SummerFunCenterI18nMapBuilder.php';
	Propel::registerMapBuilder('lib.model.summerFun.map.SummerFunCenterI18nMapBuilder');
}
