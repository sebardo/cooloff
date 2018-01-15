<?php


abstract class BaseWeek extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $starts_at;


	
	protected $ends_at;


	
	protected $title;


	
	protected $centro_id;


	
	protected $is_morning_shelter = false;


	
	protected $is_afternoon_shelter = false;

	
	protected $aSummerFunCenter;

	
	protected $collWeekI18ns;

	
	protected $lastWeekI18nCriteria = null;

	
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

	
	public function getStartsAt($format = 'Y-m-d')
	{

		if ($this->starts_at === null || $this->starts_at === '') {
			return null;
		} elseif (!is_int($this->starts_at)) {
						$ts = strtotime($this->starts_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [starts_at] as date/time value: " . var_export($this->starts_at, true));
			}
		} else {
			$ts = $this->starts_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEndsAt($format = 'Y-m-d')
	{

		if ($this->ends_at === null || $this->ends_at === '') {
			return null;
		} elseif (!is_int($this->ends_at)) {
						$ts = strtotime($this->ends_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ends_at] as date/time value: " . var_export($this->ends_at, true));
			}
		} else {
			$ts = $this->ends_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getCentroId()
	{

		return $this->centro_id;
	}

	
	public function getIsMorningShelter()
	{

		return $this->is_morning_shelter;
	}

	
	public function getIsAfternoonShelter()
	{

		return $this->is_afternoon_shelter;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WeekPeer::ID;
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
			$this->modifiedColumns[] = WeekPeer::CREATED_AT;
		}

	} 
	
	public function setStartsAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [starts_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->starts_at !== $ts) {
			$this->starts_at = $ts;
			$this->modifiedColumns[] = WeekPeer::STARTS_AT;
		}

	} 
	
	public function setEndsAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ends_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ends_at !== $ts) {
			$this->ends_at = $ts;
			$this->modifiedColumns[] = WeekPeer::ENDS_AT;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = WeekPeer::TITLE;
		}

	} 
	
	public function setCentroId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->centro_id !== $v) {
			$this->centro_id = $v;
			$this->modifiedColumns[] = WeekPeer::CENTRO_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setIsMorningShelter($v)
	{

		if ($this->is_morning_shelter !== $v || $v === false) {
			$this->is_morning_shelter = $v;
			$this->modifiedColumns[] = WeekPeer::IS_MORNING_SHELTER;
		}

	} 
	
	public function setIsAfternoonShelter($v)
	{

		if ($this->is_afternoon_shelter !== $v || $v === false) {
			$this->is_afternoon_shelter = $v;
			$this->modifiedColumns[] = WeekPeer::IS_AFTERNOON_SHELTER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->starts_at = $rs->getDate($startcol + 2, null);

			$this->ends_at = $rs->getDate($startcol + 3, null);

			$this->title = $rs->getString($startcol + 4);

			$this->centro_id = $rs->getInt($startcol + 5);

			$this->is_morning_shelter = $rs->getBoolean($startcol + 6);

			$this->is_afternoon_shelter = $rs->getBoolean($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Week object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWeek:delete:pre') as $callable)
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
			$con = Propel::getConnection(WeekPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WeekPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWeek:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWeek:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(WeekPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WeekPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWeek:save:post') as $callable)
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
					$pk = WeekPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WeekPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collWeekI18ns !== null) {
				foreach($this->collWeekI18ns as $referrerFK) {
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


			if (($retval = WeekPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWeekI18ns !== null) {
					foreach($this->collWeekI18ns as $referrerFK) {
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
		$pos = WeekPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStartsAt();
				break;
			case 3:
				return $this->getEndsAt();
				break;
			case 4:
				return $this->getTitle();
				break;
			case 5:
				return $this->getCentroId();
				break;
			case 6:
				return $this->getIsMorningShelter();
				break;
			case 7:
				return $this->getIsAfternoonShelter();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WeekPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getStartsAt(),
			$keys[3] => $this->getEndsAt(),
			$keys[4] => $this->getTitle(),
			$keys[5] => $this->getCentroId(),
			$keys[6] => $this->getIsMorningShelter(),
			$keys[7] => $this->getIsAfternoonShelter(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WeekPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStartsAt($value);
				break;
			case 3:
				$this->setEndsAt($value);
				break;
			case 4:
				$this->setTitle($value);
				break;
			case 5:
				$this->setCentroId($value);
				break;
			case 6:
				$this->setIsMorningShelter($value);
				break;
			case 7:
				$this->setIsAfternoonShelter($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WeekPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStartsAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEndsAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCentroId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsMorningShelter($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsAfternoonShelter($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WeekPeer::DATABASE_NAME);

		if ($this->isColumnModified(WeekPeer::ID)) $criteria->add(WeekPeer::ID, $this->id);
		if ($this->isColumnModified(WeekPeer::CREATED_AT)) $criteria->add(WeekPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WeekPeer::STARTS_AT)) $criteria->add(WeekPeer::STARTS_AT, $this->starts_at);
		if ($this->isColumnModified(WeekPeer::ENDS_AT)) $criteria->add(WeekPeer::ENDS_AT, $this->ends_at);
		if ($this->isColumnModified(WeekPeer::TITLE)) $criteria->add(WeekPeer::TITLE, $this->title);
		if ($this->isColumnModified(WeekPeer::CENTRO_ID)) $criteria->add(WeekPeer::CENTRO_ID, $this->centro_id);
		if ($this->isColumnModified(WeekPeer::IS_MORNING_SHELTER)) $criteria->add(WeekPeer::IS_MORNING_SHELTER, $this->is_morning_shelter);
		if ($this->isColumnModified(WeekPeer::IS_AFTERNOON_SHELTER)) $criteria->add(WeekPeer::IS_AFTERNOON_SHELTER, $this->is_afternoon_shelter);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WeekPeer::DATABASE_NAME);

		$criteria->add(WeekPeer::ID, $this->id);

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

		$copyObj->setStartsAt($this->starts_at);

		$copyObj->setEndsAt($this->ends_at);

		$copyObj->setTitle($this->title);

		$copyObj->setCentroId($this->centro_id);

		$copyObj->setIsMorningShelter($this->is_morning_shelter);

		$copyObj->setIsAfternoonShelter($this->is_afternoon_shelter);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getWeekI18ns() as $relObj) {
				$copyObj->addWeekI18n($relObj->copy($deepCopy));
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
			self::$peer = new WeekPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setCentroId(NULL);
		} else {
			$this->setCentroId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->centro_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->centro_id, $con);

			
		}
		return $this->aSummerFunCenter;
	}

	
	public function initWeekI18ns()
	{
		if ($this->collWeekI18ns === null) {
			$this->collWeekI18ns = array();
		}
	}

	
	public function getWeekI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseWeekI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWeekI18ns === null) {
			if ($this->isNew()) {
			   $this->collWeekI18ns = array();
			} else {

				$criteria->add(WeekI18nPeer::ID, $this->getId());

				WeekI18nPeer::addSelectColumns($criteria);
				$this->collWeekI18ns = WeekI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WeekI18nPeer::ID, $this->getId());

				WeekI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastWeekI18nCriteria) || !$this->lastWeekI18nCriteria->equals($criteria)) {
					$this->collWeekI18ns = WeekI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWeekI18nCriteria = $criteria;
		return $this->collWeekI18ns;
	}

	
	public function countWeekI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseWeekI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WeekI18nPeer::ID, $this->getId());

		return WeekI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWeekI18n(WeekI18n $l)
	{
		$this->collWeekI18ns[] = $l;
		$l->setWeek($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getMorningShelterSchedule()
  {
    $obj = $this->getCurrentWeekI18n();

    return ($obj ? $obj->getMorningShelterSchedule() : null);
  }

  public function setMorningShelterSchedule($value)
  {
    $this->getCurrentWeekI18n()->setMorningShelterSchedule($value);
  }

  public function getAfternoonShelterSchedule()
  {
    $obj = $this->getCurrentWeekI18n();

    return ($obj ? $obj->getAfternoonShelterSchedule() : null);
  }

  public function setAfternoonShelterSchedule($value)
  {
    $this->getCurrentWeekI18n()->setAfternoonShelterSchedule($value);
  }

  public function getShelterDescription()
  {
    $obj = $this->getCurrentWeekI18n();

    return ($obj ? $obj->getShelterDescription() : null);
  }

  public function setShelterDescription($value)
  {
    $this->getCurrentWeekI18n()->setShelterDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentWeekI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = WeekI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setWeekI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setWeekI18nForCulture(new WeekI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setWeekI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addWeekI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWeek:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWeek::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 