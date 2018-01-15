<?php


abstract class BaseInscriptionCenterConfiguration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $morning_shelter = false;


	
	protected $afternoon_shelter = false;


	
	protected $text_shelter;


	
	protected $transfer_payment = false;


	
	protected $cash_payment = false;


	
	protected $summer_fun_center_id;


	
	protected $is_registration_open = false;

	
	protected $aSummerFunCenter;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
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

	
	public function getMorningShelter()
	{

		return $this->morning_shelter;
	}

	
	public function getAfternoonShelter()
	{

		return $this->afternoon_shelter;
	}

	
	public function getTextShelter()
	{

		return $this->text_shelter;
	}

	
	public function getTransferPayment()
	{

		return $this->transfer_payment;
	}

	
	public function getCashPayment()
	{

		return $this->cash_payment;
	}

	
	public function getSummerFunCenterId()
	{

		return $this->summer_fun_center_id;
	}

	
	public function getIsRegistrationOpen()
	{

		return $this->is_registration_open;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::ID;
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
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::CREATED_AT;
		}

	} 
	
	public function setMorningShelter($v)
	{

		if ($this->morning_shelter !== $v || $v === false) {
			$this->morning_shelter = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::MORNING_SHELTER;
		}

	} 
	
	public function setAfternoonShelter($v)
	{

		if ($this->afternoon_shelter !== $v || $v === false) {
			$this->afternoon_shelter = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER;
		}

	} 
	
	public function setTextShelter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_shelter !== $v) {
			$this->text_shelter = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::TEXT_SHELTER;
		}

	} 
	
	public function setTransferPayment($v)
	{

		if ($this->transfer_payment !== $v || $v === false) {
			$this->transfer_payment = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT;
		}

	} 
	
	public function setCashPayment($v)
	{

		if ($this->cash_payment !== $v || $v === false) {
			$this->cash_payment = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::CASH_PAYMENT;
		}

	} 
	
	public function setSummerFunCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->summer_fun_center_id !== $v) {
			$this->summer_fun_center_id = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setIsRegistrationOpen($v)
	{

		if ($this->is_registration_open !== $v || $v === false) {
			$this->is_registration_open = $v;
			$this->modifiedColumns[] = InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->morning_shelter = $rs->getBoolean($startcol + 2);

			$this->afternoon_shelter = $rs->getBoolean($startcol + 3);

			$this->text_shelter = $rs->getString($startcol + 4);

			$this->transfer_payment = $rs->getBoolean($startcol + 5);

			$this->cash_payment = $rs->getBoolean($startcol + 6);

			$this->summer_fun_center_id = $rs->getInt($startcol + 7);

			$this->is_registration_open = $rs->getBoolean($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InscriptionCenterConfiguration object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfiguration:delete:pre') as $callable)
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
			$con = Propel::getConnection(InscriptionCenterConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InscriptionCenterConfigurationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfiguration:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseInscriptionCenterConfiguration:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(InscriptionCenterConfigurationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InscriptionCenterConfigurationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInscriptionCenterConfiguration:save:post') as $callable)
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
					$pk = InscriptionCenterConfigurationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InscriptionCenterConfigurationPeer::doUpdate($this, $con);
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


												
			if ($this->aSummerFunCenter !== null) {
				if (!$this->aSummerFunCenter->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunCenter->getValidationFailures());
				}
			}


			if (($retval = InscriptionCenterConfigurationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionCenterConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMorningShelter();
				break;
			case 3:
				return $this->getAfternoonShelter();
				break;
			case 4:
				return $this->getTextShelter();
				break;
			case 5:
				return $this->getTransferPayment();
				break;
			case 6:
				return $this->getCashPayment();
				break;
			case 7:
				return $this->getSummerFunCenterId();
				break;
			case 8:
				return $this->getIsRegistrationOpen();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionCenterConfigurationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getMorningShelter(),
			$keys[3] => $this->getAfternoonShelter(),
			$keys[4] => $this->getTextShelter(),
			$keys[5] => $this->getTransferPayment(),
			$keys[6] => $this->getCashPayment(),
			$keys[7] => $this->getSummerFunCenterId(),
			$keys[8] => $this->getIsRegistrationOpen(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InscriptionCenterConfigurationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMorningShelter($value);
				break;
			case 3:
				$this->setAfternoonShelter($value);
				break;
			case 4:
				$this->setTextShelter($value);
				break;
			case 5:
				$this->setTransferPayment($value);
				break;
			case 6:
				$this->setCashPayment($value);
				break;
			case 7:
				$this->setSummerFunCenterId($value);
				break;
			case 8:
				$this->setIsRegistrationOpen($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InscriptionCenterConfigurationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMorningShelter($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAfternoonShelter($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTextShelter($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTransferPayment($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCashPayment($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSummerFunCenterId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsRegistrationOpen($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InscriptionCenterConfigurationPeer::DATABASE_NAME);

		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::ID)) $criteria->add(InscriptionCenterConfigurationPeer::ID, $this->id);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::CREATED_AT)) $criteria->add(InscriptionCenterConfigurationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::MORNING_SHELTER)) $criteria->add(InscriptionCenterConfigurationPeer::MORNING_SHELTER, $this->morning_shelter);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER)) $criteria->add(InscriptionCenterConfigurationPeer::AFTERNOON_SHELTER, $this->afternoon_shelter);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::TEXT_SHELTER)) $criteria->add(InscriptionCenterConfigurationPeer::TEXT_SHELTER, $this->text_shelter);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT)) $criteria->add(InscriptionCenterConfigurationPeer::TRANSFER_PAYMENT, $this->transfer_payment);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::CASH_PAYMENT)) $criteria->add(InscriptionCenterConfigurationPeer::CASH_PAYMENT, $this->cash_payment);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID)) $criteria->add(InscriptionCenterConfigurationPeer::SUMMER_FUN_CENTER_ID, $this->summer_fun_center_id);
		if ($this->isColumnModified(InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN)) $criteria->add(InscriptionCenterConfigurationPeer::IS_REGISTRATION_OPEN, $this->is_registration_open);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InscriptionCenterConfigurationPeer::DATABASE_NAME);

		$criteria->add(InscriptionCenterConfigurationPeer::ID, $this->id);

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

		$copyObj->setMorningShelter($this->morning_shelter);

		$copyObj->setAfternoonShelter($this->afternoon_shelter);

		$copyObj->setTextShelter($this->text_shelter);

		$copyObj->setTransferPayment($this->transfer_payment);

		$copyObj->setCashPayment($this->cash_payment);

		$copyObj->setSummerFunCenterId($this->summer_fun_center_id);

		$copyObj->setIsRegistrationOpen($this->is_registration_open);


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
			self::$peer = new InscriptionCenterConfigurationPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setSummerFunCenterId(NULL);
		} else {
			$this->setSummerFunCenterId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->summer_fun_center_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->summer_fun_center_id, $con);

			
		}
		return $this->aSummerFunCenter;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInscriptionCenterConfiguration:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInscriptionCenterConfiguration::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 