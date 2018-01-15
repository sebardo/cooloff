<?php


abstract class BaseInscriptionServiceSchedule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $inscription_id;


	
	protected $service_schedule_id;

	
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

	
	public function setInscriptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inscription_id !== $v) {
			$this->inscription_id = $v;
			$this->modifiedColumns[] = InscriptionServiceSchedulePeer::INSCRIPTION_ID;
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
			$this->modifiedColumns[] = InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID;
		}

		if ($this->aServiceSchedule !== null && $this->aServiceSchedule->getId() !== $v) {
			$this->aServiceSchedule = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->inscription_id = $rs->getInt($startcol + 0);

			$this->service_schedule_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InscriptionServiceSchedule object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedule:delete:pre') as $callable)
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
			$con = Propel::getConnection(InscriptionServiceSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InscriptionServiceSchedulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedule:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedule:save:pre') as $callable)
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
			$con = Propel::getConnection(InscriptionServiceSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInscriptionServiceSchedule:save:post') as $callable)
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
					$pk = InscriptionServiceSchedulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InscriptionServiceSchedulePeer::doUpdate($this, $con);
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


			if (($retval = InscriptionServiceSchedulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionServiceSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionServiceSchedulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInscriptionId(),
			$keys[1] => $this->getServiceScheduleId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionServiceSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionServiceSchedulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInscriptionId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setServiceScheduleId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InscriptionServiceSchedulePeer::DATABASE_NAME);

		if ($this->isColumnModified(InscriptionServiceSchedulePeer::INSCRIPTION_ID)) $criteria->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $this->inscription_id);
		if ($this->isColumnModified(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID)) $criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->service_schedule_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InscriptionServiceSchedulePeer::DATABASE_NAME);

		$criteria->add(InscriptionServiceSchedulePeer::INSCRIPTION_ID, $this->inscription_id);
		$criteria->add(InscriptionServiceSchedulePeer::SERVICE_SCHEDULE_ID, $this->service_schedule_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getInscriptionId();

		$pks[1] = $this->getServiceScheduleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setInscriptionId($keys[0]);

		$this->setServiceScheduleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setInscriptionId(NULL); 
		$copyObj->setServiceScheduleId(NULL); 
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
			self::$peer = new InscriptionServiceSchedulePeer();
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
    if (!$callable = sfMixer::getCallable('BaseInscriptionServiceSchedule:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInscriptionServiceSchedule::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 