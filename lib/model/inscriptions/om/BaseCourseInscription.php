<?php


abstract class BaseCourseInscription extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $course_id;


	
	protected $inscription_id;

	
	protected $aCourse;

	
	protected $aInscription;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCourseId()
	{

		return $this->course_id;
	}

	
	public function getInscriptionId()
	{

		return $this->inscription_id;
	}

	
	public function setCourseId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->course_id !== $v) {
			$this->course_id = $v;
			$this->modifiedColumns[] = CourseInscriptionPeer::COURSE_ID;
		}

		if ($this->aCourse !== null && $this->aCourse->getId() !== $v) {
			$this->aCourse = null;
		}

	} 
	
	public function setInscriptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inscription_id !== $v) {
			$this->inscription_id = $v;
			$this->modifiedColumns[] = CourseInscriptionPeer::INSCRIPTION_ID;
		}

		if ($this->aInscription !== null && $this->aInscription->getId() !== $v) {
			$this->aInscription = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->course_id = $rs->getInt($startcol + 0);

			$this->inscription_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CourseInscription object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseInscription:delete:pre') as $callable)
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
			$con = Propel::getConnection(CourseInscriptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CourseInscriptionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCourseInscription:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCourseInscription:save:pre') as $callable)
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
			$con = Propel::getConnection(CourseInscriptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCourseInscription:save:post') as $callable)
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
				if ($this->aCourse->isModified()) {
					$affectedRows += $this->aCourse->save($con);
				}
				$this->setCourse($this->aCourse);
			}

			if ($this->aInscription !== null) {
				if ($this->aInscription->isModified()) {
					$affectedRows += $this->aInscription->save($con);
				}
				$this->setInscription($this->aInscription);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CourseInscriptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CourseInscriptionPeer::doUpdate($this, $con);
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

			if ($this->aInscription !== null) {
				if (!$this->aInscription->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInscription->getValidationFailures());
				}
			}


			if (($retval = CourseInscriptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CourseInscriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCourseId();
				break;
			case 1:
				return $this->getInscriptionId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CourseInscriptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCourseId(),
			$keys[1] => $this->getInscriptionId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CourseInscriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCourseId($value);
				break;
			case 1:
				$this->setInscriptionId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CourseInscriptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCourseId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInscriptionId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CourseInscriptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CourseInscriptionPeer::COURSE_ID)) $criteria->add(CourseInscriptionPeer::COURSE_ID, $this->course_id);
		if ($this->isColumnModified(CourseInscriptionPeer::INSCRIPTION_ID)) $criteria->add(CourseInscriptionPeer::INSCRIPTION_ID, $this->inscription_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CourseInscriptionPeer::DATABASE_NAME);

		$criteria->add(CourseInscriptionPeer::COURSE_ID, $this->course_id);
		$criteria->add(CourseInscriptionPeer::INSCRIPTION_ID, $this->inscription_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCourseId();

		$pks[1] = $this->getInscriptionId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCourseId($keys[0]);

		$this->setInscriptionId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setCourseId(NULL); 
		$copyObj->setInscriptionId(NULL); 
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
			self::$peer = new CourseInscriptionPeer();
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCourseInscription:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCourseInscription::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 