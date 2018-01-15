<?php


abstract class BaseExcursion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $centro_id;

	
	protected $aSummerFunCenter;

	
	protected $collCourses;

	
	protected $lastCourseCriteria = null;

	
	protected $collExcursionI18ns;

	
	protected $lastExcursionI18nCriteria = null;

	
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCentroId()
	{

		return $this->centro_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ExcursionPeer::ID;
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
			$this->modifiedColumns[] = ExcursionPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ExcursionPeer::UPDATED_AT;
		}

	} 
	
	public function setCentroId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->centro_id !== $v) {
			$this->centro_id = $v;
			$this->modifiedColumns[] = ExcursionPeer::CENTRO_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->centro_id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Excursion object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursion:delete:pre') as $callable)
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
			$con = Propel::getConnection(ExcursionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ExcursionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseExcursion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursion:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ExcursionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ExcursionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ExcursionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseExcursion:save:post') as $callable)
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
					$pk = ExcursionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ExcursionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCourses !== null) {
				foreach($this->collCourses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExcursionI18ns !== null) {
				foreach($this->collExcursionI18ns as $referrerFK) {
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


			if (($retval = ExcursionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCourses !== null) {
					foreach($this->collCourses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExcursionI18ns !== null) {
					foreach($this->collExcursionI18ns as $referrerFK) {
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
		$pos = ExcursionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getCentroId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExcursionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getCentroId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ExcursionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setCentroId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExcursionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCentroId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ExcursionPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExcursionPeer::ID)) $criteria->add(ExcursionPeer::ID, $this->id);
		if ($this->isColumnModified(ExcursionPeer::CREATED_AT)) $criteria->add(ExcursionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ExcursionPeer::UPDATED_AT)) $criteria->add(ExcursionPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ExcursionPeer::CENTRO_ID)) $criteria->add(ExcursionPeer::CENTRO_ID, $this->centro_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ExcursionPeer::DATABASE_NAME);

		$criteria->add(ExcursionPeer::ID, $this->id);

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

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setCentroId($this->centro_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCourses() as $relObj) {
				$copyObj->addCourse($relObj->copy($deepCopy));
			}

			foreach($this->getExcursionI18ns() as $relObj) {
				$copyObj->addExcursionI18n($relObj->copy($deepCopy));
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
			self::$peer = new ExcursionPeer();
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

	
	public function initCourses()
	{
		if ($this->collCourses === null) {
			$this->collCourses = array();
		}
	}

	
	public function getCourses($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourses === null) {
			if ($this->isNew()) {
			   $this->collCourses = array();
			} else {

				$criteria->add(CoursePeer::EXCURSION_ID, $this->getId());

				CoursePeer::addSelectColumns($criteria);
				$this->collCourses = CoursePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CoursePeer::EXCURSION_ID, $this->getId());

				CoursePeer::addSelectColumns($criteria);
				if (!isset($this->lastCourseCriteria) || !$this->lastCourseCriteria->equals($criteria)) {
					$this->collCourses = CoursePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCourseCriteria = $criteria;
		return $this->collCourses;
	}

	
	public function countCourses($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CoursePeer::EXCURSION_ID, $this->getId());

		return CoursePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCourse(Course $l)
	{
		$this->collCourses[] = $l;
		$l->setExcursion($this);
	}


	
	public function getCoursesJoinSummerFunCenter($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourses === null) {
			if ($this->isNew()) {
				$this->collCourses = array();
			} else {

				$criteria->add(CoursePeer::EXCURSION_ID, $this->getId());

				$this->collCourses = CoursePeer::doSelectJoinSummerFunCenter($criteria, $con);
			}
		} else {
									
			$criteria->add(CoursePeer::EXCURSION_ID, $this->getId());

			if (!isset($this->lastCourseCriteria) || !$this->lastCourseCriteria->equals($criteria)) {
				$this->collCourses = CoursePeer::doSelectJoinSummerFunCenter($criteria, $con);
			}
		}
		$this->lastCourseCriteria = $criteria;

		return $this->collCourses;
	}

	
	public function initExcursionI18ns()
	{
		if ($this->collExcursionI18ns === null) {
			$this->collExcursionI18ns = array();
		}
	}

	
	public function getExcursionI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseExcursionI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExcursionI18ns === null) {
			if ($this->isNew()) {
			   $this->collExcursionI18ns = array();
			} else {

				$criteria->add(ExcursionI18nPeer::ID, $this->getId());

				ExcursionI18nPeer::addSelectColumns($criteria);
				$this->collExcursionI18ns = ExcursionI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ExcursionI18nPeer::ID, $this->getId());

				ExcursionI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastExcursionI18nCriteria) || !$this->lastExcursionI18nCriteria->equals($criteria)) {
					$this->collExcursionI18ns = ExcursionI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExcursionI18nCriteria = $criteria;
		return $this->collExcursionI18ns;
	}

	
	public function countExcursionI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseExcursionI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExcursionI18nPeer::ID, $this->getId());

		return ExcursionI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addExcursionI18n(ExcursionI18n $l)
	{
		$this->collExcursionI18ns[] = $l;
		$l->setExcursion($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getNombre()
  {
    $obj = $this->getCurrentExcursionI18n();

    return ($obj ? $obj->getNombre() : null);
  }

  public function setNombre($value)
  {
    $this->getCurrentExcursionI18n()->setNombre($value);
  }

  public function getDescripcion()
  {
    $obj = $this->getCurrentExcursionI18n();

    return ($obj ? $obj->getDescripcion() : null);
  }

  public function setDescripcion($value)
  {
    $this->getCurrentExcursionI18n()->setDescripcion($value);
  }

  protected $current_i18n = array();

  public function getCurrentExcursionI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ExcursionI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setExcursionI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setExcursionI18nForCulture(new ExcursionI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setExcursionI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addExcursionI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseExcursion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseExcursion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 