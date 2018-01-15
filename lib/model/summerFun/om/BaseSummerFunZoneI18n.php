<?php


abstract class BaseSummerFunZoneI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $title;


	
	protected $id;


	
	protected $culture;

	
	protected $aSummerFunZone;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = SummerFunZoneI18nPeer::TITLE;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SummerFunZoneI18nPeer::ID;
		}

		if ($this->aSummerFunZone !== null && $this->aSummerFunZone->getId() !== $v) {
			$this->aSummerFunZone = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = SummerFunZoneI18nPeer::CULTURE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->title = $rs->getString($startcol + 0);

			$this->id = $rs->getInt($startcol + 1);

			$this->culture = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunZoneI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunZoneI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunZoneI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunZoneI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunZoneI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunZoneI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunZoneI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunZoneI18n:save:post') as $callable)
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


												
			if ($this->aSummerFunZone !== null) {
				if ($this->aSummerFunZone->isModified() || $this->aSummerFunZone->getCurrentSummerFunZoneI18n()->isModified()) {
					$affectedRows += $this->aSummerFunZone->save($con);
				}
				$this->setSummerFunZone($this->aSummerFunZone);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SummerFunZoneI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunZoneI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aSummerFunZone !== null) {
				if (!$this->aSummerFunZone->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunZone->getValidationFailures());
				}
			}


			if (($retval = SummerFunZoneI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunZoneI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getTitle();
				break;
			case 1:
				return $this->getId();
				break;
			case 2:
				return $this->getCulture();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunZoneI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTitle(),
			$keys[1] => $this->getId(),
			$keys[2] => $this->getCulture(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunZoneI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setTitle($value);
				break;
			case 1:
				$this->setId($value);
				break;
			case 2:
				$this->setCulture($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunZoneI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTitle($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCulture($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunZoneI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunZoneI18nPeer::TITLE)) $criteria->add(SummerFunZoneI18nPeer::TITLE, $this->title);
		if ($this->isColumnModified(SummerFunZoneI18nPeer::ID)) $criteria->add(SummerFunZoneI18nPeer::ID, $this->id);
		if ($this->isColumnModified(SummerFunZoneI18nPeer::CULTURE)) $criteria->add(SummerFunZoneI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunZoneI18nPeer::DATABASE_NAME);

		$criteria->add(SummerFunZoneI18nPeer::ID, $this->id);
		$criteria->add(SummerFunZoneI18nPeer::CULTURE, $this->culture);

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

		$copyObj->setTitle($this->title);


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
			self::$peer = new SummerFunZoneI18nPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunZone($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aSummerFunZone = $v;
	}


	
	public function getSummerFunZone($con = null)
	{
		if ($this->aSummerFunZone === null && ($this->id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunZonePeer.php';

			$this->aSummerFunZone = SummerFunZonePeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aSummerFunZone;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunZoneI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunZoneI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 