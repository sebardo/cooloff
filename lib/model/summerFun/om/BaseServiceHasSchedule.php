<?php


abstract class BaseServiceHasSchedule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $service_id;


	
	protected $schedule_id;

	
	protected $aService;

	
	protected $aSchedule;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getServiceId()
	{

		return $this->service_id;
	}

	
	public function getScheduleId()
	{

		return $this->schedule_id;
	}

	
	public function setServiceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = ServiceHasSchedulePeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

	} 
	
	public function setScheduleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schedule_id !== $v) {
			$this->schedule_id = $v;
			$this->modifiedColumns[] = ServiceHasSchedulePeer::SCHEDULE_ID;
		}

		if ($this->aSchedule !== null && $this->aSchedule->getId() !== $v) {
			$this->aSchedule = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->service_id = $rs->getInt($startcol + 0);

			$this->schedule_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ServiceHasSchedule object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceHasSchedule:delete:pre') as $callable)
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
			$con = Propel::getConnection(ServiceHasSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ServiceHasSchedulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseServiceHasSchedule:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseServiceHasSchedule:save:pre') as $callable)
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
			$con = Propel::getConnection(ServiceHasSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseServiceHasSchedule:save:post') as $callable)
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

			if ($this->aSchedule !== null) {
				if ($this->aSchedule->isModified() || $this->aSchedule->getCurrentScheduleI18n()->isModified()) {
					$affectedRows += $this->aSchedule->save($con);
				}
				$this->setSchedule($this->aSchedule);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServiceHasSchedulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ServiceHasSchedulePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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

			if ($this->aSchedule !== null) {
				if (!$this->aSchedule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchedule->getValidationFailures());
				}
			}


			if (($retval = ServiceHasSchedulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServiceHasSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getServiceId();
				break;
			case 1:
				return $this->getScheduleId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServiceHasSchedulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getServiceId(),
			$keys[1] => $this->getScheduleId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServiceHasSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setServiceId($value);
				break;
			case 1:
				$this->setScheduleId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServiceHasSchedulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setServiceId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setScheduleId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServiceHasSchedulePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServiceHasSchedulePeer::SERVICE_ID)) $criteria->add(ServiceHasSchedulePeer::SERVICE_ID, $this->service_id);
		if ($this->isColumnModified(ServiceHasSchedulePeer::SCHEDULE_ID)) $criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->schedule_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServiceHasSchedulePeer::DATABASE_NAME);

		$criteria->add(ServiceHasSchedulePeer::SERVICE_ID, $this->service_id);
		$criteria->add(ServiceHasSchedulePeer::SCHEDULE_ID, $this->schedule_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getServiceId();

		$pks[1] = $this->getScheduleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setServiceId($keys[0]);

		$this->setScheduleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setServiceId(NULL); 
		$copyObj->setScheduleId(NULL); 
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
			self::$peer = new ServiceHasSchedulePeer();
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

	
	public function setSchedule($v)
	{


		if ($v === null) {
			$this->setScheduleId(NULL);
		} else {
			$this->setScheduleId($v->getId());
		}


		$this->aSchedule = $v;
	}


	
	public function getSchedule($con = null)
	{
		if ($this->aSchedule === null && ($this->schedule_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSchedulePeer.php';

			$this->aSchedule = SchedulePeer::retrieveByPK($this->schedule_id, $con);

			
		}
		return $this->aSchedule;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseServiceHasSchedule:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseServiceHasSchedule::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 