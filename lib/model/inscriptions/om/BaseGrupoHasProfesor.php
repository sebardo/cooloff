<?php


abstract class BaseGrupoHasProfesor extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $grupo_id;


	
	protected $profesor_id;

	
	protected $aGrupo;

	
	protected $aProfesor;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getGrupoId()
	{

		return $this->grupo_id;
	}

	
	public function getProfesorId()
	{

		return $this->profesor_id;
	}

	
	public function setGrupoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->grupo_id !== $v) {
			$this->grupo_id = $v;
			$this->modifiedColumns[] = GrupoHasProfesorPeer::GRUPO_ID;
		}

		if ($this->aGrupo !== null && $this->aGrupo->getId() !== $v) {
			$this->aGrupo = null;
		}

	} 
	
	public function setProfesorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profesor_id !== $v) {
			$this->profesor_id = $v;
			$this->modifiedColumns[] = GrupoHasProfesorPeer::PROFESOR_ID;
		}

		if ($this->aProfesor !== null && $this->aProfesor->getId() !== $v) {
			$this->aProfesor = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->grupo_id = $rs->getInt($startcol + 0);

			$this->profesor_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GrupoHasProfesor object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupoHasProfesor:delete:pre') as $callable)
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
			$con = Propel::getConnection(GrupoHasProfesorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GrupoHasProfesorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGrupoHasProfesor:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupoHasProfesor:save:pre') as $callable)
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
			$con = Propel::getConnection(GrupoHasProfesorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGrupoHasProfesor:save:post') as $callable)
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


												
			if ($this->aGrupo !== null) {
				if ($this->aGrupo->isModified()) {
					$affectedRows += $this->aGrupo->save($con);
				}
				$this->setGrupo($this->aGrupo);
			}

			if ($this->aProfesor !== null) {
				if ($this->aProfesor->isModified()) {
					$affectedRows += $this->aProfesor->save($con);
				}
				$this->setProfesor($this->aProfesor);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GrupoHasProfesorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += GrupoHasProfesorPeer::doUpdate($this, $con);
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


												
			if ($this->aGrupo !== null) {
				if (!$this->aGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGrupo->getValidationFailures());
				}
			}

			if ($this->aProfesor !== null) {
				if (!$this->aProfesor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfesor->getValidationFailures());
				}
			}


			if (($retval = GrupoHasProfesorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoHasProfesorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getGrupoId();
				break;
			case 1:
				return $this->getProfesorId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoHasProfesorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGrupoId(),
			$keys[1] => $this->getProfesorId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoHasProfesorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setGrupoId($value);
				break;
			case 1:
				$this->setProfesorId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoHasProfesorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGrupoId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfesorId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoHasProfesorPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoHasProfesorPeer::GRUPO_ID)) $criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(GrupoHasProfesorPeer::PROFESOR_ID)) $criteria->add(GrupoHasProfesorPeer::PROFESOR_ID, $this->profesor_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoHasProfesorPeer::DATABASE_NAME);

		$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->grupo_id);
		$criteria->add(GrupoHasProfesorPeer::PROFESOR_ID, $this->profesor_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getGrupoId();

		$pks[1] = $this->getProfesorId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setGrupoId($keys[0]);

		$this->setProfesorId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setGrupoId(NULL); 
		$copyObj->setProfesorId(NULL); 
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
			self::$peer = new GrupoHasProfesorPeer();
		}
		return self::$peer;
	}

	
	public function setGrupo($v)
	{


		if ($v === null) {
			$this->setGrupoId(NULL);
		} else {
			$this->setGrupoId($v->getId());
		}


		$this->aGrupo = $v;
	}


	
	public function getGrupo($con = null)
	{
		if ($this->aGrupo === null && ($this->grupo_id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseGrupoPeer.php';

			$this->aGrupo = GrupoPeer::retrieveByPK($this->grupo_id, $con);

			
		}
		return $this->aGrupo;
	}

	
	public function setProfesor($v)
	{


		if ($v === null) {
			$this->setProfesorId(NULL);
		} else {
			$this->setProfesorId($v->getId());
		}


		$this->aProfesor = $v;
	}


	
	public function getProfesor($con = null)
	{
		if ($this->aProfesor === null && ($this->profesor_id !== null)) {
						include_once 'lib/model/inscriptions/om/BaseProfesorPeer.php';

			$this->aProfesor = ProfesorPeer::retrieveByPK($this->profesor_id, $con);

			
		}
		return $this->aProfesor;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGrupoHasProfesor:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGrupoHasProfesor::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 