<?php


abstract class BaseSchedule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $center_id;


	
	protected $id;

	
	protected $aSummerFunCenter;

	
	protected $collScheduleI18ns;

	
	protected $lastScheduleI18nCriteria = null;

	
	protected $collServiceHasSchedules;

	
	protected $lastServiceHasScheduleCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getCenterId()
	{

		return $this->center_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->center_id !== $v) {
			$this->center_id = $v;
			$this->modifiedColumns[] = SchedulePeer::CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SchedulePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->center_id = $rs->getInt($startcol + 0);

			$this->id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Schedule object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSchedule:delete:pre') as $callable)
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
			$con = Propel::getConnection(SchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchedulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSchedule:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSchedule:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSchedule:save:post') as $callable)
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


												
			if ($this->aSummerFunCenter !== null) {
				if ($this->aSummerFunCenter->isModified() || $this->aSummerFunCenter->getCurrentSummerFunCenterI18n()->isModified()) {
					$affectedRows += $this->aSummerFunCenter->save($con);
				}
				$this->setSummerFunCenter($this->aSummerFunCenter);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchedulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SchedulePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collScheduleI18ns !== null) {
				foreach($this->collScheduleI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServiceHasSchedules !== null) {
				foreach($this->collServiceHasSchedules as $referrerFK) {
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


												
			if ($this->aSummerFunCenter !== null) {
				if (!$this->aSummerFunCenter->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunCenter->getValidationFailures());
				}
			}


			if (($retval = SchedulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collScheduleI18ns !== null) {
					foreach($this->collScheduleI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServiceHasSchedules !== null) {
					foreach($this->collServiceHasSchedules as $referrerFK) {
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
		$pos = SchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCenterId();
				break;
			case 1:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCenterId(),
			$keys[1] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCenterId($value);
				break;
			case 1:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SchedulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCenterId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SchedulePeer::DATABASE_NAME);

		if ($this->isColumnModified(SchedulePeer::CENTER_ID)) $criteria->add(SchedulePeer::CENTER_ID, $this->center_id);
		if ($this->isColumnModified(SchedulePeer::ID)) $criteria->add(SchedulePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SchedulePeer::DATABASE_NAME);

		$criteria->add(SchedulePeer::ID, $this->id);

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

		$copyObj->setCenterId($this->center_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getScheduleI18ns() as $relObj) {
				$copyObj->addScheduleI18n($relObj->copy($deepCopy));
			}

			foreach($this->getServiceHasSchedules() as $relObj) {
				$copyObj->addServiceHasSchedule($relObj->copy($deepCopy));
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
			self::$peer = new SchedulePeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setCenterId(NULL);
		} else {
			$this->setCenterId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->center_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->center_id, $con);

			
		}
		return $this->aSummerFunCenter;
	}

	
	public function initScheduleI18ns()
	{
		if ($this->collScheduleI18ns === null) {
			$this->collScheduleI18ns = array();
		}
	}

	
	public function getScheduleI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseScheduleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collScheduleI18ns === null) {
			if ($this->isNew()) {
			   $this->collScheduleI18ns = array();
			} else {

				$criteria->add(ScheduleI18nPeer::ID, $this->getId());

				ScheduleI18nPeer::addSelectColumns($criteria);
				$this->collScheduleI18ns = ScheduleI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ScheduleI18nPeer::ID, $this->getId());

				ScheduleI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastScheduleI18nCriteria) || !$this->lastScheduleI18nCriteria->equals($criteria)) {
					$this->collScheduleI18ns = ScheduleI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastScheduleI18nCriteria = $criteria;
		return $this->collScheduleI18ns;
	}

	
	public function countScheduleI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseScheduleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ScheduleI18nPeer::ID, $this->getId());

		return ScheduleI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addScheduleI18n(ScheduleI18n $l)
	{
		$this->collScheduleI18ns[] = $l;
		$l->setSchedule($this);
	}

	
	public function initServiceHasSchedules()
	{
		if ($this->collServiceHasSchedules === null) {
			$this->collServiceHasSchedules = array();
		}
	}

	
	public function getServiceHasSchedules($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceHasSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceHasSchedules === null) {
			if ($this->isNew()) {
			   $this->collServiceHasSchedules = array();
			} else {

				$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->getId());

				ServiceHasSchedulePeer::addSelectColumns($criteria);
				$this->collServiceHasSchedules = ServiceHasSchedulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->getId());

				ServiceHasSchedulePeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceHasScheduleCriteria) || !$this->lastServiceHasScheduleCriteria->equals($criteria)) {
					$this->collServiceHasSchedules = ServiceHasSchedulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceHasScheduleCriteria = $criteria;
		return $this->collServiceHasSchedules;
	}

	
	public function countServiceHasSchedules($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceHasSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->getId());

		return ServiceHasSchedulePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceHasSchedule(ServiceHasSchedule $l)
	{
		$this->collServiceHasSchedules[] = $l;
		$l->setSchedule($this);
	}


	
	public function getServiceHasSchedulesJoinService($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceHasSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceHasSchedules === null) {
			if ($this->isNew()) {
				$this->collServiceHasSchedules = array();
			} else {

				$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->getId());

				$this->collServiceHasSchedules = ServiceHasSchedulePeer::doSelectJoinService($criteria, $con);
			}
		} else {
									
			$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->getId());

			if (!isset($this->lastServiceHasScheduleCriteria) || !$this->lastServiceHasScheduleCriteria->equals($criteria)) {
				$this->collServiceHasSchedules = ServiceHasSchedulePeer::doSelectJoinService($criteria, $con);
			}
		}
		$this->lastServiceHasScheduleCriteria = $criteria;

		return $this->collServiceHasSchedules;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getName()
  {
    $obj = $this->getCurrentScheduleI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentScheduleI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentScheduleI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ScheduleI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setScheduleI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setScheduleI18nForCulture(new ScheduleI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setScheduleI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addScheduleI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSchedule:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSchedule::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 