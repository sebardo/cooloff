<?php


abstract class BaseExcursionI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $nombre;


	
	protected $descripcion;


	
	protected $id;


	
	protected $culture;

	
	protected $aExcursion;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = ExcursionI18nPeer::NOMBRE;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = ExcursionI18nPeer::DESCRIPCION;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ExcursionI18nPeer::ID;
		}

		if ($this->aExcursion !== null && $this->aExcursion->getId() !== $v) {
			$this->aExcursion = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = ExcursionI18nPeer::CULTURE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->nombre = $rs->getString($startcol + 0);

			$this->descripcion = $rs->getString($startcol + 1);

			$this->id = $rs->getInt($startcol + 2);

			$this->culture = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ExcursionI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursionI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(ExcursionI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ExcursionI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseExcursionI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseExcursionI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(ExcursionI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseExcursionI18n:save:post') as $callable)
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


												
			if ($this->aExcursion !== null) {
				if ($this->aExcursion->isModified() || $this->aExcursion->getCurrentExcursionI18n()->isModified()) {
					$affectedRows += $this->aExcursion->save($con);
				}
				$this->setExcursion($this->aExcursion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ExcursionI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ExcursionI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aExcursion !== null) {
				if (!$this->aExcursion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aExcursion->getValidationFailures());
				}
			}


			if (($retval = ExcursionI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ExcursionI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNombre();
				break;
			case 1:
				return $this->getDescripcion();
				break;
			case 2:
				return $this->getId();
				break;
			case 3:
				return $this->getCulture();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExcursionI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNombre(),
			$keys[1] => $this->getDescripcion(),
			$keys[2] => $this->getId(),
			$keys[3] => $this->getCulture(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ExcursionI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNombre($value);
				break;
			case 1:
				$this->setDescripcion($value);
				break;
			case 2:
				$this->setId($value);
				break;
			case 3:
				$this->setCulture($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExcursionI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNombre($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCulture($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ExcursionI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExcursionI18nPeer::NOMBRE)) $criteria->add(ExcursionI18nPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(ExcursionI18nPeer::DESCRIPCION)) $criteria->add(ExcursionI18nPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(ExcursionI18nPeer::ID)) $criteria->add(ExcursionI18nPeer::ID, $this->id);
		if ($this->isColumnModified(ExcursionI18nPeer::CULTURE)) $criteria->add(ExcursionI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ExcursionI18nPeer::DATABASE_NAME);

		$criteria->add(ExcursionI18nPeer::ID, $this->id);
		$criteria->add(ExcursionI18nPeer::CULTURE, $this->culture);

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

		$copyObj->setNombre($this->nombre);

		$copyObj->setDescripcion($this->descripcion);


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
			self::$peer = new ExcursionI18nPeer();
		}
		return self::$peer;
	}

	
	public function setExcursion($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aExcursion = $v;
	}


	
	public function getExcursion($con = null)
	{
		if ($this->aExcursion === null && ($this->id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseExcursionPeer.php';

			$this->aExcursion = ExcursionPeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aExcursion;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseExcursionI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseExcursionI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 