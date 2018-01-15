<?php


abstract class BaseCourse extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $starts_at;


	
	protected $ends_at;


	
	protected $price = 0;


	
	protected $number_of_places;


	
	protected $summer_fun_center_id;


	
	protected $is_registration_open = false;


	
	protected $excursion_id;

	
	protected $aSummerFunCenter;

	
	protected $aExcursion;

	
	protected $collCourseI18ns;

	
	protected $lastCourseI18nCriteria = null;

	
	protected $collCourseHasServicess;

	
	protected $lastCourseHasServicesCriteria = null;

	
	protected $collInscriptions;

	
	protected $lastInscriptionCriteria = null;

	
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

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getNumberOfPlaces()
	{

		return $this->number_of_places;
	}

	
	public function getSummerFunCenterId()
	{

		return $this->summer_fun_center_id;
	}

	
	public function getIsRegistrationOpen()
	{

		return $this->is_registration_open;
	}

	
	public function getExcursionId()
	{

		return $this->excursion_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CoursePeer::ID;
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
			$this->modifiedColumns[] = CoursePeer::CREATED_AT;
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
			$this->modifiedColumns[] = CoursePeer::STARTS_AT;
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
			$this->modifiedColumns[] = CoursePeer::ENDS_AT;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v || $v === 0) {
			$this->price = $v;
			$this->modifiedColumns[] = CoursePeer::PRICE;
		}

	} 
	
	public function setNumberOfPlaces($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->number_of_places !== $v) {
			$this->number_of_places = $v;
			$this->modifiedColumns[] = CoursePeer::NUMBER_OF_PLACES;
		}

	} 
	
	public function setSummerFunCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->summer_fun_center_id !== $v) {
			$this->summer_fun_center_id = $v;
			$this->modifiedColumns[] = CoursePeer::SUMMER_FUN_CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setIsRegistrationOpen($v)
	{

		if ($this->is_registration_open !== $v || $v === false) {
			$this->is_registration_open = $v;
			$this->modifiedColumns[] = CoursePeer::IS_REGISTRATION_OPEN;
		}

	} 
	
	public function setExcursionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->excursion_id !== $v) {
			$this->excursion_id = $v;
			$this->modifiedColumns[] = CoursePeer::EXCURSION_ID;
		}

		if ($this->aExcursion !== null && $this->aExcursion->getId() !== $v) {
			$this->aExcursion = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->starts_at = $rs->getDate($startcol + 2, null);

			$this->ends_at = $rs->getDate($startcol + 3, null);

			$this->price = $rs->getFloat($startcol + 4);

			$this->number_of_places = $rs->getInt($startcol + 5);

			$this->summer_fun_center_id = $rs->getInt($startcol + 6);

			$this->is_registration_open = $rs->getBoolean($startcol + 7);

			$this->excursion_id = $rs->getInt($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Course object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourse:delete:pre') as $callable)
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
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CoursePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCourse:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourse:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(CoursePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCourse:save:post') as $callable)
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

			if ($this->aExcursion !== null) {
				if ($this->aExcursion->isModified() || $this->aExcursion->getCurrentExcursionI18n()->isModified()) {
					$affectedRows += $this->aExcursion->save($con);
				}
				$this->setExcursion($this->aExcursion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CoursePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CoursePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCourseI18ns !== null) {
				foreach($this->collCourseI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCourseHasServicess !== null) {
				foreach($this->collCourseHasServicess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInscriptions !== null) {
				foreach($this->collInscriptions as $referrerFK) {
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

			if ($this->aExcursion !== null) {
				if (!$this->aExcursion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aExcursion->getValidationFailures());
				}
			}


			if (($retval = CoursePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCourseI18ns !== null) {
					foreach($this->collCourseI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCourseHasServicess !== null) {
					foreach($this->collCourseHasServicess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInscriptions !== null) {
					foreach($this->collInscriptions as $referrerFK) {
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
		$pos = CoursePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPrice();
				break;
			case 5:
				return $this->getNumberOfPlaces();
				break;
			case 6:
				return $this->getSummerFunCenterId();
				break;
			case 7:
				return $this->getIsRegistrationOpen();
				break;
			case 8:
				return $this->getExcursionId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CoursePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getStartsAt(),
			$keys[3] => $this->getEndsAt(),
			$keys[4] => $this->getPrice(),
			$keys[5] => $this->getNumberOfPlaces(),
			$keys[6] => $this->getSummerFunCenterId(),
			$keys[7] => $this->getIsRegistrationOpen(),
			$keys[8] => $this->getExcursionId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CoursePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPrice($value);
				break;
			case 5:
				$this->setNumberOfPlaces($value);
				break;
			case 6:
				$this->setSummerFunCenterId($value);
				break;
			case 7:
				$this->setIsRegistrationOpen($value);
				break;
			case 8:
				$this->setExcursionId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CoursePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStartsAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEndsAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNumberOfPlaces($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSummerFunCenterId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsRegistrationOpen($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setExcursionId($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CoursePeer::DATABASE_NAME);

		if ($this->isColumnModified(CoursePeer::ID)) $criteria->add(CoursePeer::ID, $this->id);
		if ($this->isColumnModified(CoursePeer::CREATED_AT)) $criteria->add(CoursePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CoursePeer::STARTS_AT)) $criteria->add(CoursePeer::STARTS_AT, $this->starts_at);
		if ($this->isColumnModified(CoursePeer::ENDS_AT)) $criteria->add(CoursePeer::ENDS_AT, $this->ends_at);
		if ($this->isColumnModified(CoursePeer::PRICE)) $criteria->add(CoursePeer::PRICE, $this->price);
		if ($this->isColumnModified(CoursePeer::NUMBER_OF_PLACES)) $criteria->add(CoursePeer::NUMBER_OF_PLACES, $this->number_of_places);
		if ($this->isColumnModified(CoursePeer::SUMMER_FUN_CENTER_ID)) $criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->summer_fun_center_id);
		if ($this->isColumnModified(CoursePeer::IS_REGISTRATION_OPEN)) $criteria->add(CoursePeer::IS_REGISTRATION_OPEN, $this->is_registration_open);
		if ($this->isColumnModified(CoursePeer::EXCURSION_ID)) $criteria->add(CoursePeer::EXCURSION_ID, $this->excursion_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CoursePeer::DATABASE_NAME);

		$criteria->add(CoursePeer::ID, $this->id);

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

		$copyObj->setPrice($this->price);

		$copyObj->setNumberOfPlaces($this->number_of_places);

		$copyObj->setSummerFunCenterId($this->summer_fun_center_id);

		$copyObj->setIsRegistrationOpen($this->is_registration_open);

		$copyObj->setExcursionId($this->excursion_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCourseI18ns() as $relObj) {
				$copyObj->addCourseI18n($relObj->copy($deepCopy));
			}

			foreach($this->getCourseHasServicess() as $relObj) {
				$copyObj->addCourseHasServices($relObj->copy($deepCopy));
			}

			foreach($this->getInscriptions() as $relObj) {
				$copyObj->addInscription($relObj->copy($deepCopy));
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
			self::$peer = new CoursePeer();
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

	
	public function setExcursion($v)
	{


		if ($v === null) {
			$this->setExcursionId(NULL);
		} else {
			$this->setExcursionId($v->getId());
		}


		$this->aExcursion = $v;
	}


	
	public function getExcursion($con = null)
	{
		if ($this->aExcursion === null && ($this->excursion_id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseExcursionPeer.php';

			$this->aExcursion = ExcursionPeer::retrieveByPK($this->excursion_id, $con);

			
		}
		return $this->aExcursion;
	}

	
	public function initCourseI18ns()
	{
		if ($this->collCourseI18ns === null) {
			$this->collCourseI18ns = array();
		}
	}

	
	public function getCourseI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCourseI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourseI18ns === null) {
			if ($this->isNew()) {
			   $this->collCourseI18ns = array();
			} else {

				$criteria->add(CourseI18nPeer::ID, $this->getId());

				CourseI18nPeer::addSelectColumns($criteria);
				$this->collCourseI18ns = CourseI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CourseI18nPeer::ID, $this->getId());

				CourseI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCourseI18nCriteria) || !$this->lastCourseI18nCriteria->equals($criteria)) {
					$this->collCourseI18ns = CourseI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCourseI18nCriteria = $criteria;
		return $this->collCourseI18ns;
	}

	
	public function countCourseI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCourseI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CourseI18nPeer::ID, $this->getId());

		return CourseI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCourseI18n(CourseI18n $l)
	{
		$this->collCourseI18ns[] = $l;
		$l->setCourse($this);
	}

	
	public function initCourseHasServicess()
	{
		if ($this->collCourseHasServicess === null) {
			$this->collCourseHasServicess = array();
		}
	}

	
	public function getCourseHasServicess($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCourseHasServicesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourseHasServicess === null) {
			if ($this->isNew()) {
			   $this->collCourseHasServicess = array();
			} else {

				$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->getId());

				CourseHasServicesPeer::addSelectColumns($criteria);
				$this->collCourseHasServicess = CourseHasServicesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->getId());

				CourseHasServicesPeer::addSelectColumns($criteria);
				if (!isset($this->lastCourseHasServicesCriteria) || !$this->lastCourseHasServicesCriteria->equals($criteria)) {
					$this->collCourseHasServicess = CourseHasServicesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCourseHasServicesCriteria = $criteria;
		return $this->collCourseHasServicess;
	}

	
	public function countCourseHasServicess($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCourseHasServicesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->getId());

		return CourseHasServicesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCourseHasServices(CourseHasServices $l)
	{
		$this->collCourseHasServicess[] = $l;
		$l->setCourse($this);
	}


	
	public function getCourseHasServicessJoinService($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCourseHasServicesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourseHasServicess === null) {
			if ($this->isNew()) {
				$this->collCourseHasServicess = array();
			} else {

				$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->getId());

				$this->collCourseHasServicess = CourseHasServicesPeer::doSelectJoinService($criteria, $con);
			}
		} else {
									
			$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->getId());

			if (!isset($this->lastCourseHasServicesCriteria) || !$this->lastCourseHasServicesCriteria->equals($criteria)) {
				$this->collCourseHasServicess = CourseHasServicesPeer::doSelectJoinService($criteria, $con);
			}
		}
		$this->lastCourseHasServicesCriteria = $criteria;

		return $this->collCourseHasServicess;
	}

	
	public function initInscriptions()
	{
		if ($this->collInscriptions === null) {
			$this->collInscriptions = array();
		}
	}

	
	public function getInscriptions($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptions === null) {
			if ($this->isNew()) {
			   $this->collInscriptions = array();
			} else {

				$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

				InscriptionPeer::addSelectColumns($criteria);
				$this->collInscriptions = InscriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

				InscriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
					$this->collInscriptions = InscriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInscriptionCriteria = $criteria;
		return $this->collInscriptions;
	}

	
	public function countInscriptions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

		return InscriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInscription(Inscription $l)
	{
		$this->collInscriptions[] = $l;
		$l->setCourse($this);
	}


	
	public function getInscriptionsJoinProvincia($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptions === null) {
			if ($this->isNew()) {
				$this->collInscriptions = array();
			} else {

				$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinProvincia($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinProvincia($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
	}


	
	public function getInscriptionsJoinGrupo($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptions === null) {
			if ($this->isNew()) {
				$this->collInscriptions = array();
			} else {

				$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
	}


	
	public function getInscriptionsJoinKidsAndUsCenter($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseInscriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInscriptions === null) {
			if ($this->isNew()) {
				$this->collInscriptions = array();
			} else {

				$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_COURSE_INSCRIPTION, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getSchedule()
  {
    $obj = $this->getCurrentCourseI18n();

    return ($obj ? $obj->getSchedule() : null);
  }

  public function setSchedule($value)
  {
    $this->getCurrentCourseI18n()->setSchedule($value);
  }

  protected $current_i18n = array();

  public function getCurrentCourseI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = CourseI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setCourseI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setCourseI18nForCulture(new CourseI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setCourseI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCourseI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCourse:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCourse::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 