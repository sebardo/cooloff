<?php


abstract class BasesfGuardUserProfile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_id;


	
	protected $pass;


	
	protected $name;


	
	protected $email;


	
	protected $culture;

	
	protected $asfGuardUser;

	
	protected $collSummerFunCenterHasProfiles;

	
	protected $lastSummerFunCenterHasProfileCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getPass()
	{

		return $this->pass;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ID;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setPass($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pass !== $v) {
			$this->pass = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PASS;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::CULTURE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->pass = $rs->getString($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->culture = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUserProfile object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfGuardUserProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:pre') as $callable)
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:post') as $callable)
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


												
			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserProfilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSummerFunCenterHasProfiles !== null) {
				foreach($this->collSummerFunCenterHasProfiles as $referrerFK) {
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


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = sfGuardUserProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSummerFunCenterHasProfiles !== null) {
					foreach($this->collSummerFunCenterHasProfiles as $referrerFK) {
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
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getPass();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getCulture();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getPass(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getCulture(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setPass($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setCulture($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPass($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCulture($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserProfilePeer::ID)) $criteria->add(sfGuardUserProfilePeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::USER_ID)) $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PASS)) $criteria->add(sfGuardUserProfilePeer::PASS, $this->pass);
		if ($this->isColumnModified(sfGuardUserProfilePeer::NAME)) $criteria->add(sfGuardUserProfilePeer::NAME, $this->name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL)) $criteria->add(sfGuardUserProfilePeer::EMAIL, $this->email);
		if ($this->isColumnModified(sfGuardUserProfilePeer::CULTURE)) $criteria->add(sfGuardUserProfilePeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		$criteria->add(sfGuardUserProfilePeer::ID, $this->id);

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

		$copyObj->setUserId($this->user_id);

		$copyObj->setPass($this->pass);

		$copyObj->setName($this->name);

		$copyObj->setEmail($this->email);

		$copyObj->setCulture($this->culture);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSummerFunCenterHasProfiles() as $relObj) {
				$copyObj->addSummerFunCenterHasProfile($relObj->copy($deepCopy));
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
			self::$peer = new sfGuardUserProfilePeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->asfGuardUser = $v;
	}


	
	public function getsfGuardUser($con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
						include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPeer.php';

			$this->asfGuardUser = sfGuardUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->asfGuardUser;
	}

	
	public function initSummerFunCenterHasProfiles()
	{
		if ($this->collSummerFunCenterHasProfiles === null) {
			$this->collSummerFunCenterHasProfiles = array();
		}
	}

	
	public function getSummerFunCenterHasProfiles($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterHasProfiles === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenterHasProfiles = array();
			} else {

				$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->getId());

				SummerFunCenterHasProfilePeer::addSelectColumns($criteria);
				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->getId());

				SummerFunCenterHasProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterHasProfileCriteria) || !$this->lastSummerFunCenterHasProfileCriteria->equals($criteria)) {
					$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterHasProfileCriteria = $criteria;
		return $this->collSummerFunCenterHasProfiles;
	}

	
	public function countSummerFunCenterHasProfiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->getId());

		return SummerFunCenterHasProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenterHasProfile(SummerFunCenterHasProfile $l)
	{
		$this->collSummerFunCenterHasProfiles[] = $l;
		$l->setsfGuardUserProfile($this);
	}


	
	public function getSummerFunCenterHasProfilesJoinSummerFunCenter($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterHasProfiles === null) {
			if ($this->isNew()) {
				$this->collSummerFunCenterHasProfiles = array();
			} else {

				$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->getId());

				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelectJoinSummerFunCenter($criteria, $con);
			}
		} else {
									
			$criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSummerFunCenterHasProfileCriteria) || !$this->lastSummerFunCenterHasProfileCriteria->equals($criteria)) {
				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelectJoinSummerFunCenter($criteria, $con);
			}
		}
		$this->lastSummerFunCenterHasProfileCriteria = $criteria;

		return $this->collSummerFunCenterHasProfiles;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfGuardUserProfile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfGuardUserProfile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 