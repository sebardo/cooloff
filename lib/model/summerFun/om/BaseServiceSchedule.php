<?php


abstract class BaseServiceSchedule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $orden;


	
	protected $service_id;

	
	protected $aService;

	
	protected $collInscriptionServiceSchedules;

	
	protected $lastInscriptionServiceScheduleCriteria = null;

	
	protected $collServiceScheduleI18ns;

	
	protected $lastServiceScheduleI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getOrden()
	{

		return $this->orden;
	}

	
	public function getServiceId()
	{

		return $this->service_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ServiceSchedulePeer::ID;
		}

	} 
	
	public function setOrden($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->orden !== $v) {
			$this->orden = $v;
			$this->modifiedColumns[] = ServiceSchedulePeer::ORDEN;
		}

	} 
	
	public function setServiceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = ServiceSchedulePeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->orden = $rs->getInt($startcol + 1);

			$this->service_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ServiceSchedule object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceSchedule:delete:pre') as $callable)
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
			$con = Propel::getConnection(ServiceSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ServiceSchedulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseServiceSchedule:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceSchedule:save:pre') as $callable)
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
			$con = Propel::getConnection(ServiceSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseServiceSchedule:save:post') as $callable)
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


												
			if ($this->aService !== null) {
				if ($this->aService->isModified() || $this->aService->getCurrentServiceI18n()->isModified()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServiceSchedulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ServiceSchedulePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInscriptionServiceSchedules !== null) {
				foreach($this->collInscriptionServiceSchedules as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServiceScheduleI18ns !== null) {
				foreach($this->collServiceScheduleI18ns as $referrerFK) {
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


												
			if ($this->aService !== null) {
				if (!$this->aService->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aService->getValidationFailures());
				}
			}


			if (($retval = ServiceSchedulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInscriptionServiceSchedules !== null) {
					foreach($this->collInscriptionServiceSchedules as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServiceScheduleI18ns !== null) {
					foreach($this->collServiceScheduleI18ns as $referrerFK) {
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
		$pos = ServiceSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getOrden();
				break;
			case 2:
				return $this->getServiceId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServiceSchedulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrden(),
			$keys[2] => $this->getServiceId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServiceSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setOrden($value);
				break;
			case 2:
				$this->setServiceId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServiceSchedulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrden($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setServiceId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServiceSchedulePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServiceSchedulePeer::ID)) $criteria->add(ServiceSchedulePeer::ID, $this->id);
		if ($this->isColumnModified(ServiceSchedulePeer::ORDEN)) $criteria->add(ServiceSchedulePeer::ORDEN, $this->orden);
		if ($this->isColumnModified(ServiceSchedulePeer::SERVICE_ID)) $criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServiceSchedulePeer::DATABASE_NAME);

		$criteria->add(ServiceSchedulePeer::ID, $this->id);

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

		$copyObj->setOrden($this->orden);

		$copyObj->setServiceId($this->service_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInscriptionServiceSchedules() as $relObj) {
				$copyObj->addInscriptionServiceSchedule($relObj->copy($deepCopy));
			}

			foreach($this->getServiceScheduleI18ns() as $relObj) {
				$copyObj->addServiceScheduleI18n($relObj->copy($deepCopy));
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
			self::$peer = new ServiceSchedulePeer();
		}
		return self::$peer;
	}

	
	public function setService($v)
	{


		if ($v === null) {
			$this->setServiceId(NULL);
		} else {
			$this->setServiceId($v->getId());
		}


		$this->aService = $v;
	}


	
	public function getService($con = null)
	{
		if ($this->aService === null && ($this->service_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseServicePeer.php';

			$this->aService = ServicePeer::retrieveByPK($this->service_id, $con);

			
		}
		return $this->aService;
	}

	
	public function initInscriptionServiceSchedules()
	{
		if ($this->collInscriptionServiceSchedules === null) {
			$this->collInscriptionServiceSchedules = array();
		}
	}

	
	public function getInscriptionServiceSchedules($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionServiceSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptionServiceSchedules === null) {
			if ($this->isNew()) {
			   $this->collInscriptionServiceSchedules = array();
			} else {

				$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->getId());

				InscriptionServiceSchedulePeer::addSelectColumns($criteria);
				$this->collInscriptionServiceSchedules = InscriptionServiceSchedulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->getId());

				InscriptionServiceSchedulePeer::addSelectColumns($criteria);
				if (!isset($this->lastInscriptionServiceScheduleCriteria) || !$this->lastInscriptionServiceScheduleCriteria->equals($criteria)) {
					$this->collInscriptionServiceSchedules = InscriptionServiceSchedulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInscriptionServiceScheduleCriteria = $criteria;
		return $this->collInscriptionServiceSchedules;
	}

	
	public function countInscriptionServiceSchedules($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionServiceSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->getId());

		return InscriptionServiceSchedulePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInscriptionServiceSchedule(InscriptionServiceSchedule $l)
	{
		$this->collInscriptionServiceSchedules[] = $l;
		$l->setServiceSchedule($this);
	}


	
	public function getInscriptionServiceSchedulesJoinInscription($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionServiceSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptionServiceSchedules === null) {
			if ($this->isNew()) {
				$this->collInscriptionServiceSchedules = array();
			} else {

				$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->getId());

				$this->collInscriptionServiceSchedules = InscriptionServiceSchedulePeer::doSelectJoinInscription($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->getId());

			if (!isset($this->lastInscriptionServiceScheduleCriteria) || !$this->lastInscriptionServiceScheduleCriteria->equals($criteria)) {
				$this->collInscriptionServiceSchedules = InscriptionServiceSchedulePeer::doSelectJoinInscription($criteria, $con);
			}
		}
		$this->lastInscriptionServiceScheduleCriteria = $criteria;

		return $this->collInscriptionServiceSchedules;
	}

	
	public function initServiceScheduleI18ns()
	{
		if ($this->collServiceScheduleI18ns === null) {
			$this->collServiceScheduleI18ns = array();
		}
	}

	
	public function getServiceScheduleI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceScheduleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceScheduleI18ns === null) {
			if ($this->isNew()) {
			   $this->collServiceScheduleI18ns = array();
			} else {

				$criteria->add(ServiceScheduleI18nPeer::ID, $this->getId());

				ServiceScheduleI18nPeer::addSelectColumns($criteria);
				$this->collServiceScheduleI18ns = ServiceScheduleI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceScheduleI18nPeer::ID, $this->getId());

				ServiceScheduleI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceScheduleI18nCriteria) || !$this->lastServiceScheduleI18nCriteria->equals($criteria)) {
					$this->collServiceScheduleI18ns = ServiceScheduleI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceScheduleI18nCriteria = $criteria;
		return $this->collServiceScheduleI18ns;
	}

	
	public function countServiceScheduleI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceScheduleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceScheduleI18nPeer::ID, $this->getId());

		return ServiceScheduleI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceScheduleI18n(ServiceScheduleI18n $l)
	{
		$this->collServiceScheduleI18ns[] = $l;
		$l->setServiceSchedule($this);
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
    $obj = $this->getCurrentServiceScheduleI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentServiceScheduleI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentServiceScheduleI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ServiceScheduleI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setServiceScheduleI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setServiceScheduleI18nForCulture(new ServiceScheduleI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setServiceScheduleI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addServiceScheduleI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseServiceSchedule:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseServiceSchedule::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 