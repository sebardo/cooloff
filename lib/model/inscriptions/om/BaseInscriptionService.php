<?php


abstract class BaseInscriptionService extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $inscription_id;


	
	protected $service_schedule_id;


	
	protected $id;

	
	protected $aInscription;

	
	protected $aServiceSchedule;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getInscriptionId()
	{

		return $this->inscription_id;
	}

	
	public function getServiceScheduleId()
	{

		return $this->service_schedule_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setInscriptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inscription_id !== $v) {
			$this->inscription_id = $v;
			$this->modifiedColumns[] = InscriptionServicePeer::INSCRIPTION_ID;
		}

		if ($this->aInscription !== null && $this->aInscription->getId() !== $v) {
			$this->aInscription = null;
		}

	} 
	
	public function setServiceScheduleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_schedule_id !== $v) {
			$this->service_schedule_id = $v;
			$this->modifiedColumns[] = InscriptionServicePeer::SERVICE_SCHEDULE_ID;
		}

		if ($this->aServiceSchedule !== null && $this->aServiceSchedule->getId() !== $v) {
			$this->aServiceSchedule = null;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InscriptionServicePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->inscription_id = $rs->getInt($startcol + 0);

			$this->service_schedule_id = $rs->getInt($startcol + 1);

			$this->id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InscriptionService object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionService:delete:pre') as $callable)
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
			$con = Propel::getConnection(InscriptionServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InscriptionServicePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInscriptionService:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionService:save:pre') as $callable)
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
			$con = Propel::getConnection(InscriptionServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInscriptionService:save:post') as $callable)
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


												
			if ($this->aInscription !== null) {
				if ($this->aInscription->isModified()) {
					$affectedRows += $this->aInscription->save($con);
				}
				$this->setInscription($this->aInscription);
			}

			if ($this->aServiceSchedule !== null) {
				if ($this->aServiceSchedule->isModified() || $this->aServiceSchedule->getCurrentServiceScheduleI18n()->isModified()) {
					$affectedRows += $this->aServiceSchedule->save($con);
				}
				$this->setServiceSchedule($this->aServiceSchedule);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InscriptionServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InscriptionServicePeer::doUpdate($this, $con);
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


												
			if ($this->aInscription !== null) {
				if (!$this->aInscription->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInscription->getValidationFailures());
				}
			}

			if ($this->aServiceSchedule !== null) {
				if (!$this->aServiceSchedule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aServiceSchedule->getValidationFailures());
				}
			}


			if (($retval = InscriptionServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getInscriptionId();
				break;
			case 1:
				return $this->getServiceScheduleId();
				break;
			case 2:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInscriptionId(),
			$keys[1] => $this->getServiceScheduleId(),
			$keys[2] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setInscriptionId($value);
				break;
			case 1:
				$this->setServiceScheduleId($value);
				break;
			case 2:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInscriptionId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setServiceScheduleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InscriptionServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(InscriptionServicePeer::INSCRIPTION_ID)) $criteria->add(InscriptionServicePeer::INSCRIPTION_ID, $this->inscription_id);
		if ($this->isColumnModified(InscriptionServicePeer::SERVICE_SCHEDULE_ID)) $criteria->add(InscriptionServicePeer::SERVICE_SCHEDULE_ID, $this->service_schedule_id);
		if ($this->isColumnModified(InscriptionServicePeer::ID)) $criteria->add(InscriptionServicePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InscriptionServicePeer::DATABASE_NAME);

		$criteria->add(InscriptionServicePeer::ID, $this->id);

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

		$copyObj->setInscriptionId($this->inscription_id);

		$copyObj->setServiceScheduleId($this->service_schedule_id);


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
			self::$peer = new InscriptionServicePeer();
		}
		return self::$peer;
	}

	
	public function setInscription($v)
	{


		if ($v === null) {
			$this->setInscriptionId(NULL);
		} else {
			$this->setInscriptionId($v->getId());
		}


		$this->aInscription = $v;
	}


	
	public function getInscription($con = null)
	{
		if ($this->aInscription === null && ($this->inscription_id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';

			$this->aInscription = InscriptionPeer::retrieveByPK($this->inscription_id, $con);

			
		}
		return $this->aInscription;
	}

	
	public function setServiceSchedule($v)
	{


		if ($v === null) {
			$this->setServiceScheduleId(NULL);
		} else {
			$this->setServiceScheduleId($v->getId());
		}


		$this->aServiceSchedule = $v;
	}


	
	public function getServiceSchedule($con = null)
	{
		if ($this->aServiceSchedule === null && ($this->service_schedule_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseServiceSchedulePeer.php';

			$this->aServiceSchedule = ServiceSchedulePeer::retrieveByPK($this->service_schedule_id, $con);

			
		}
		return $this->aServiceSchedule;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInscriptionService:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInscriptionService::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 