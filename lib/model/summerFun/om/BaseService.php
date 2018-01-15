<?php


abstract class BaseService extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $center_id;


	
	protected $price = 0;

	
	protected $aSummerFunCenter;

	
	protected $collCourseHasServicess;

	
	protected $lastCourseHasServicesCriteria = null;

	
	protected $collServiceI18ns;

	
	protected $lastServiceI18nCriteria = null;

	
	protected $collServiceSchedules;

	
	protected $lastServiceScheduleCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCenterId()
	{

		return $this->center_id;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ServicePeer::ID;
		}

	} 
	
	public function setCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->center_id !== $v) {
			$this->center_id = $v;
			$this->modifiedColumns[] = ServicePeer::CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v || $v === 0) {
			$this->price = $v;
			$this->modifiedColumns[] = ServicePeer::PRICE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->center_id = $rs->getInt($startcol + 1);

			$this->price = $rs->getFloat($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Service object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseService:delete:pre') as $callable)
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ServicePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseService:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseService:save:pre') as $callable)
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
			$con = Propel::getConnection(ServicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseService:save:post') as $callable)
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
					$pk = ServicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ServicePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCourseHasServicess !== null) {
				foreach($this->collCourseHasServicess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServiceI18ns !== null) {
				foreach($this->collServiceI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServiceSchedules !== null) {
				foreach($this->collServiceSchedules as $referrerFK) {
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


			if (($retval = ServicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCourseHasServicess !== null) {
					foreach($this->collCourseHasServicess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServiceI18ns !== null) {
					foreach($this->collServiceI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServiceSchedules !== null) {
					foreach($this->collServiceSchedules as $referrerFK) {
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
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCenterId();
				break;
			case 2:
				return $this->getPrice();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCenterId(),
			$keys[2] => $this->getPrice(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCenterId($value);
				break;
			case 2:
				$this->setPrice($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ServicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCenterId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPrice($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		if ($this->isColumnModified(ServicePeer::ID)) $criteria->add(ServicePeer::ID, $this->id);
		if ($this->isColumnModified(ServicePeer::CENTER_ID)) $criteria->add(ServicePeer::CENTER_ID, $this->center_id);
		if ($this->isColumnModified(ServicePeer::PRICE)) $criteria->add(ServicePeer::PRICE, $this->price);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ServicePeer::DATABASE_NAME);

		$criteria->add(ServicePeer::ID, $this->id);

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

		$copyObj->setCenterId($this->center_id);

		$copyObj->setPrice($this->price);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCourseHasServicess() as $relObj) {
				$copyObj->addCourseHasServices($relObj->copy($deepCopy));
			}

			foreach($this->getServiceI18ns() as $relObj) {
				$copyObj->addServiceI18n($relObj->copy($deepCopy));
			}

			foreach($this->getServiceSchedules() as $relObj) {
				$copyObj->addServiceSchedule($relObj->copy($deepCopy));
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
			self::$peer = new ServicePeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setCenterId(NULL);
		} else {
			$this->setCenterId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->center_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->center_id, $con);

			
		}
		return $this->aSummerFunCenter;
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

				$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->getId());

				CourseHasServicesPeer::addSelectColumns($criteria);
				$this->collCourseHasServicess = CourseHasServicesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->getId());

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

		$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->getId());

		return CourseHasServicesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCourseHasServices(CourseHasServices $l)
	{
		$this->collCourseHasServicess[] = $l;
		$l->setService($this);
	}


	
	public function getCourseHasServicessJoinCourse($criteria = null, $con = null)
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

				$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->getId());

				$this->collCourseHasServicess = CourseHasServicesPeer::doSelectJoinCourse($criteria, $con);
			}
		} else {
									
			$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->getId());

			if (!isset($this->lastCourseHasServicesCriteria) || !$this->lastCourseHasServicesCriteria->equals($criteria)) {
				$this->collCourseHasServicess = CourseHasServicesPeer::doSelectJoinCourse($criteria, $con);
			}
		}
		$this->lastCourseHasServicesCriteria = $criteria;

		return $this->collCourseHasServicess;
	}

	
	public function initServiceI18ns()
	{
		if ($this->collServiceI18ns === null) {
			$this->collServiceI18ns = array();
		}
	}

	
	public function getServiceI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceI18ns === null) {
			if ($this->isNew()) {
			   $this->collServiceI18ns = array();
			} else {

				$criteria->add(ServiceI18nPeer::ID, $this->getId());

				ServiceI18nPeer::addSelectColumns($criteria);
				$this->collServiceI18ns = ServiceI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceI18nPeer::ID, $this->getId());

				ServiceI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceI18nCriteria) || !$this->lastServiceI18nCriteria->equals($criteria)) {
					$this->collServiceI18ns = ServiceI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceI18nCriteria = $criteria;
		return $this->collServiceI18ns;
	}

	
	public function countServiceI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceI18nPeer::ID, $this->getId());

		return ServiceI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceI18n(ServiceI18n $l)
	{
		$this->collServiceI18ns[] = $l;
		$l->setService($this);
	}

	
	public function initServiceSchedules()
	{
		if ($this->collServiceSchedules === null) {
			$this->collServiceSchedules = array();
		}
	}

	
	public function getServiceSchedules($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServiceSchedules === null) {
			if ($this->isNew()) {
			   $this->collServiceSchedules = array();
			} else {

				$criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->getId());

				ServiceSchedulePeer::addSelectColumns($criteria);
				$this->collServiceSchedules = ServiceSchedulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->getId());

				ServiceSchedulePeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceScheduleCriteria) || !$this->lastServiceScheduleCriteria->equals($criteria)) {
					$this->collServiceSchedules = ServiceSchedulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceScheduleCriteria = $criteria;
		return $this->collServiceSchedules;
	}

	
	public function countServiceSchedules($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServiceSchedulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->getId());

		return ServiceSchedulePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addServiceSchedule(ServiceSchedule $l)
	{
		$this->collServiceSchedules[] = $l;
		$l->setService($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getName()
  {
    $obj = $this->getCurrentServiceI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentServiceI18n()->setName($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentServiceI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentServiceI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentServiceI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ServiceI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setServiceI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setServiceI18nForCulture(new ServiceI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setServiceI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addServiceI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseService:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseService::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 