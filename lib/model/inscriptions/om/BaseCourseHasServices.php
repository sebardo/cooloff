<?php


abstract class BaseCourseHasServices extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $course_id;


	
	protected $service_id;

	
	protected $aCourse;

	
	protected $aService;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCourseId()
	{

		return $this->course_id;
	}

	
	public function getServiceId()
	{

		return $this->service_id;
	}

	
	public function setCourseId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->course_id !== $v) {
			$this->course_id = $v;
			$this->modifiedColumns[] = CourseHasServicesPeer::COURSE_ID;
		}

		if ($this->aCourse !== null && $this->aCourse->getId() !== $v) {
			$this->aCourse = null;
		}

	} 
	
	public function setServiceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->service_id !== $v) {
			$this->service_id = $v;
			$this->modifiedColumns[] = CourseHasServicesPeer::SERVICE_ID;
		}

		if ($this->aService !== null && $this->aService->getId() !== $v) {
			$this->aService = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->course_id = $rs->getInt($startcol + 0);

			$this->service_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CourseHasServices object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseHasServices:delete:pre') as $callable)
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
			$con = Propel::getConnection(CourseHasServicesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CourseHasServicesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCourseHasServices:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseHasServices:save:pre') as $callable)
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
			$con = Propel::getConnection(CourseHasServicesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCourseHasServices:save:post') as $callable)
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


												
			if ($this->aCourse !== null) {
				if ($this->aCourse->isModified() || $this->aCourse->getCurrentCourseI18n()->isModified()) {
					$affectedRows += $this->aCourse->save($con);
				}
				$this->setCourse($this->aCourse);
			}

			if ($this->aService !== null) {
				if ($this->aService->isModified() || $this->aService->getCurrentServiceI18n()->isModified()) {
					$affectedRows += $this->aService->save($con);
				}
				$this->setService($this->aService);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CourseHasServicesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CourseHasServicesPeer::doUpdate($this, $con);
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


												
			if ($this->aCourse !== null) {
				if (!$this->aCourse->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCourse->getValidationFailures());
				}
			}

			if ($this->aService !== null) {
				if (!$this->aService->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aService->getValidationFailures());
				}
			}


			if (($retval = CourseHasServicesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CourseHasServicesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCourseId();
				break;
			case 1:
				return $this->getServiceId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CourseHasServicesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCourseId(),
			$keys[1] => $this->getServiceId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CourseHasServicesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCourseId($value);
				break;
			case 1:
				$this->setServiceId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CourseHasServicesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCourseId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setServiceId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CourseHasServicesPeer::DATABASE_NAME);

		if ($this->isColumnModified(CourseHasServicesPeer::COURSE_ID)) $criteria->add(CourseHasServicesPeer::COURSE_ID, $this->course_id);
		if ($this->isColumnModified(CourseHasServicesPeer::SERVICE_ID)) $criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CourseHasServicesPeer::DATABASE_NAME);

		$criteria->add(CourseHasServicesPeer::COURSE_ID, $this->course_id);
		$criteria->add(CourseHasServicesPeer::SERVICE_ID, $this->service_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCourseId();

		$pks[1] = $this->getServiceId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCourseId($keys[0]);

		$this->setServiceId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setCourseId(NULL); 
		$copyObj->setServiceId(NULL); 
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
			self::$peer = new CourseHasServicesPeer();
		}
		return self::$peer;
	}

	
	public function setCourse($v)
	{


		if ($v === null) {
			$this->setCourseId(NULL);
		} else {
			$this->setCourseId($v->getId());
		}


		$this->aCourse = $v;
	}


	
	public function getCourse($con = null)
	{
		if ($this->aCourse === null && ($this->course_id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';

			$this->aCourse = CoursePeer::retrieveByPK($this->course_id, $con);

			
		}
		return $this->aCourse;
	}

	
	public function setService($v)
	{


		if ($v === null) {
			$this->setServiceId(NULL);
		} else {
			$this->setServiceId($v->getId());
		}


		$this->aService = $v;
	}


	
	public function getService($con = null)
	{
		if ($this->aService === null && ($this->service_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseServicePeer.php';

			$this->aService = ServicePeer::retrieveByPK($this->service_id, $con);

			
		}
		return $this->aService;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCourseHasServices:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCourseHasServices::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 