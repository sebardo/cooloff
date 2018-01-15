<?php


abstract class BaseWeekI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $morning_shelter_schedule;


	
	protected $afternoon_shelter_schedule;


	
	protected $shelter_description;


	
	protected $id;


	
	protected $culture;

	
	protected $aWeek;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getMorningShelterSchedule()
	{

		return $this->morning_shelter_schedule;
	}

	
	public function getAfternoonShelterSchedule()
	{

		return $this->afternoon_shelter_schedule;
	}

	
	public function getShelterDescription()
	{

		return $this->shelter_description;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function setMorningShelterSchedule($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->morning_shelter_schedule !== $v) {
			$this->morning_shelter_schedule = $v;
			$this->modifiedColumns[] = WeekI18nPeer::MORNING_SHELTER_SCHEDULE;
		}

	} 
	
	public function setAfternoonShelterSchedule($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->afternoon_shelter_schedule !== $v) {
			$this->afternoon_shelter_schedule = $v;
			$this->modifiedColumns[] = WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE;
		}

	} 
	
	public function setShelterDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->shelter_description !== $v) {
			$this->shelter_description = $v;
			$this->modifiedColumns[] = WeekI18nPeer::SHELTER_DESCRIPTION;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WeekI18nPeer::ID;
		}

		if ($this->aWeek !== null && $this->aWeek->getId() !== $v) {
			$this->aWeek = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = WeekI18nPeer::CULTURE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->morning_shelter_schedule = $rs->getString($startcol + 0);

			$this->afternoon_shelter_schedule = $rs->getString($startcol + 1);

			$this->shelter_description = $rs->getString($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->culture = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WeekI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWeekI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(WeekI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WeekI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWeekI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWeekI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(WeekI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWeekI18n:save:post') as $callable)
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


												
			if ($this->aWeek !== null) {
				if ($this->aWeek->isModified() || $this->aWeek->getCurrentWeekI18n()->isModified()) {
					$affectedRows += $this->aWeek->save($con);
				}
				$this->setWeek($this->aWeek);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WeekI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += WeekI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aWeek !== null) {
				if (!$this->aWeek->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWeek->getValidationFailures());
				}
			}


			if (($retval = WeekI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WeekI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getMorningShelterSchedule();
				break;
			case 1:
				return $this->getAfternoonShelterSchedule();
				break;
			case 2:
				return $this->getShelterDescription();
				break;
			case 3:
				return $this->getId();
				break;
			case 4:
				return $this->getCulture();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WeekI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getMorningShelterSchedule(),
			$keys[1] => $this->getAfternoonShelterSchedule(),
			$keys[2] => $this->getShelterDescription(),
			$keys[3] => $this->getId(),
			$keys[4] => $this->getCulture(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WeekI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setMorningShelterSchedule($value);
				break;
			case 1:
				$this->setAfternoonShelterSchedule($value);
				break;
			case 2:
				$this->setShelterDescription($value);
				break;
			case 3:
				$this->setId($value);
				break;
			case 4:
				$this->setCulture($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WeekI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setMorningShelterSchedule($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAfternoonShelterSchedule($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShelterDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCulture($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WeekI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(WeekI18nPeer::MORNING_SHELTER_SCHEDULE)) $criteria->add(WeekI18nPeer::MORNING_SHELTER_SCHEDULE, $this->morning_shelter_schedule);
		if ($this->isColumnModified(WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE)) $criteria->add(WeekI18nPeer::AFTERNOON_SHELTER_SCHEDULE, $this->afternoon_shelter_schedule);
		if ($this->isColumnModified(WeekI18nPeer::SHELTER_DESCRIPTION)) $criteria->add(WeekI18nPeer::SHELTER_DESCRIPTION, $this->shelter_description);
		if ($this->isColumnModified(WeekI18nPeer::ID)) $criteria->add(WeekI18nPeer::ID, $this->id);
		if ($this->isColumnModified(WeekI18nPeer::CULTURE)) $criteria->add(WeekI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WeekI18nPeer::DATABASE_NAME);

		$criteria->add(WeekI18nPeer::ID, $this->id);
		$criteria->add(WeekI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMorningShelterSchedule($this->morning_shelter_schedule);

		$copyObj->setAfternoonShelterSchedule($this->afternoon_shelter_schedule);

		$copyObj->setShelterDescription($this->shelter_description);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setCulture(NULL); 
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
			self::$peer = new WeekI18nPeer();
		}
		return self::$peer;
	}

	
	public function setWeek($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aWeek = $v;
	}


	
	public function getWeek($con = null)
	{
		if ($this->aWeek === null && ($this->id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseWeekPeer.php';

			$this->aWeek = WeekPeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aWeek;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWeekI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWeekI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 