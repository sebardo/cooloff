<?php


abstract class BaseSummerFunCenterHasProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $summer_fun_center_id;


	
	protected $profile_id;

	
	protected $aSummerFunCenter;

	
	protected $asfGuardUserProfile;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSummerFunCenterId()
	{

		return $this->summer_fun_center_id;
	}

	
	public function getProfileId()
	{

		return $this->profile_id;
	}

	
	public function setSummerFunCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->summer_fun_center_id !== $v) {
			$this->summer_fun_center_id = $v;
			$this->modifiedColumns[] = SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setProfileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_id !== $v) {
			$this->profile_id = $v;
			$this->modifiedColumns[] = SummerFunCenterHasProfilePeer::PROFILE_ID;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getId() !== $v) {
			$this->asfGuardUserProfile = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->summer_fun_center_id = $rs->getInt($startcol + 0);

			$this->profile_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunCenterHasProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfile:delete:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunCenterHasProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunCenterHasProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfile:save:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunCenterHasProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunCenterHasProfile:save:post') as $callable)
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

			if ($this->asfGuardUserProfile !== null) {
				if ($this->asfGuardUserProfile->isModified()) {
					$affectedRows += $this->asfGuardUserProfile->save($con);
				}
				$this->setsfGuardUserProfile($this->asfGuardUserProfile);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SummerFunCenterHasProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunCenterHasProfilePeer::doUpdate($this, $con);
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

			if ($this->asfGuardUserProfile !== null) {
				if (!$this->asfGuardUserProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserProfile->getValidationFailures());
				}
			}


			if (($retval = SummerFunCenterHasProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterHasProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSummerFunCenterId();
				break;
			case 1:
				return $this->getProfileId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterHasProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSummerFunCenterId(),
			$keys[1] => $this->getProfileId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterHasProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSummerFunCenterId($value);
				break;
			case 1:
				$this->setProfileId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterHasProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSummerFunCenterId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfileId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunCenterHasProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID)) $criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->summer_fun_center_id);
		if ($this->isColumnModified(SummerFunCenterHasProfilePeer::PROFILE_ID)) $criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->profile_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunCenterHasProfilePeer::DATABASE_NAME);

		$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->summer_fun_center_id);
		$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->profile_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getSummerFunCenterId();

		$pks[1] = $this->getProfileId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setSummerFunCenterId($keys[0]);

		$this->setProfileId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setSummerFunCenterId(NULL); 
		$copyObj->setProfileId(NULL); 
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
			self::$peer = new SummerFunCenterHasProfilePeer();
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

	
	public function setsfGuardUserProfile($v)
	{


		if ($v === null) {
			$this->setProfileId(NULL);
		} else {
			$this->setProfileId($v->getId());
		}


		$this->asfGuardUserProfile = $v;
	}


	
	public function getsfGuardUserProfile($con = null)
	{
		if ($this->asfGuardUserProfile === null && ($this->profile_id !== null)) {
						include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';

			$this->asfGuardUserProfile = sfGuardUserProfilePeer::retrieveByPK($this->profile_id, $con);

			
		}
		return $this->asfGuardUserProfile;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunCenterHasProfile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunCenterHasProfile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 