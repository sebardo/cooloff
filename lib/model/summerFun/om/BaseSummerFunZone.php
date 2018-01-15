<?php


abstract class BaseSummerFunZone extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collSummerFunZoneI18ns;

	
	protected $lastSummerFunZoneI18nCriteria = null;

	
	protected $collSummerFunCenters;

	
	protected $lastSummerFunCenterCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SummerFunZonePeer::ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = SummerFunZonePeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SummerFunZonePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunZone object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunZone:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunZonePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunZonePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunZone:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunZone:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SummerFunZonePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SummerFunZonePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunZonePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunZone:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SummerFunZonePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunZonePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSummerFunZoneI18ns !== null) {
				foreach($this->collSummerFunZoneI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSummerFunCenters !== null) {
				foreach($this->collSummerFunCenters as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = SummerFunZonePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSummerFunZoneI18ns !== null) {
					foreach($this->collSummerFunZoneI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSummerFunCenters !== null) {
					foreach($this->collSummerFunCenters as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunZonePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunZonePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunZonePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunZonePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunZonePeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunZonePeer::ID)) $criteria->add(SummerFunZonePeer::ID, $this->id);
		if ($this->isColumnModified(SummerFunZonePeer::CREATED_AT)) $criteria->add(SummerFunZonePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SummerFunZonePeer::UPDATED_AT)) $criteria->add(SummerFunZonePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunZonePeer::DATABASE_NAME);

		$criteria->add(SummerFunZonePeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSummerFunZoneI18ns() as $relObj) {
				$copyObj->addSummerFunZoneI18n($relObj->copy($deepCopy));
			}

			foreach($this->getSummerFunCenters() as $relObj) {
				$copyObj->addSummerFunCenter($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SummerFunZonePeer();
		}
		return self::$peer;
	}

	
	public function initSummerFunZoneI18ns()
	{
		if ($this->collSummerFunZoneI18ns === null) {
			$this->collSummerFunZoneI18ns = array();
		}
	}

	
	public function getSummerFunZoneI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunZoneI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunZoneI18ns === null) {
			if ($this->isNew()) {
			   $this->collSummerFunZoneI18ns = array();
			} else {

				$criteria->add(SummerFunZoneI18nPeer::ID, $this->getId());

				SummerFunZoneI18nPeer::addSelectColumns($criteria);
				$this->collSummerFunZoneI18ns = SummerFunZoneI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunZoneI18nPeer::ID, $this->getId());

				SummerFunZoneI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunZoneI18nCriteria) || !$this->lastSummerFunZoneI18nCriteria->equals($criteria)) {
					$this->collSummerFunZoneI18ns = SummerFunZoneI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunZoneI18nCriteria = $criteria;
		return $this->collSummerFunZoneI18ns;
	}

	
	public function countSummerFunZoneI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunZoneI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunZoneI18nPeer::ID, $this->getId());

		return SummerFunZoneI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunZoneI18n(SummerFunZoneI18n $l)
	{
		$this->collSummerFunZoneI18ns[] = $l;
		$l->setSummerFunZone($this);
	}

	
	public function initSummerFunCenters()
	{
		if ($this->collSummerFunCenters === null) {
			$this->collSummerFunCenters = array();
		}
	}

	
	public function getSummerFunCenters($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenters === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenters = array();
			} else {

				$criteria->add(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, $this->getId());

				SummerFunCenterPeer::addSelectColumns($criteria);
				$this->collSummerFunCenters = SummerFunCenterPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, $this->getId());

				SummerFunCenterPeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterCriteria) || !$this->lastSummerFunCenterCriteria->equals($criteria)) {
					$this->collSummerFunCenters = SummerFunCenterPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterCriteria = $criteria;
		return $this->collSummerFunCenters;
	}

	
	public function countSummerFunCenters($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, $this->getId());

		return SummerFunCenterPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenter(SummerFunCenter $l)
	{
		$this->collSummerFunCenters[] = $l;
		$l->setSummerFunZone($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle()
  {
    $obj = $this->getCurrentSummerFunZoneI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentSummerFunZoneI18n()->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentSummerFunZoneI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = SummerFunZoneI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setSummerFunZoneI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setSummerFunZoneI18nForCulture(new SummerFunZoneI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setSummerFunZoneI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addSummerFunZoneI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunZone:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunZone::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 