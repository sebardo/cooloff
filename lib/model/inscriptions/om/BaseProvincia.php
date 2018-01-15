<?php


abstract class BaseProvincia extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;

	
	protected $collInscriptions;

	
	protected $lastInscriptionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ProvinciaPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = ProvinciaPeer::NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Provincia object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseProvincia:delete:pre') as $callable)
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
			$con = Propel::getConnection(ProvinciaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProvinciaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProvincia:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseProvincia:save:pre') as $callable)
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
			$con = Propel::getConnection(ProvinciaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProvincia:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProvinciaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProvinciaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = ProvinciaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = ProvinciaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProvinciaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProvinciaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProvinciaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProvinciaPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProvinciaPeer::ID)) $criteria->add(ProvinciaPeer::ID, $this->id);
		if ($this->isColumnModified(ProvinciaPeer::NOMBRE)) $criteria->add(ProvinciaPeer::NOMBRE, $this->nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProvinciaPeer::DATABASE_NAME);

		$criteria->add(ProvinciaPeer::ID, $this->id);

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

		$copyObj->setNombre($this->nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new ProvinciaPeer();
		}
		return self::$peer;
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

				$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

				InscriptionPeer::addSelectColumns($criteria);
				$this->collInscriptions = InscriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

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

		$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

		return InscriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInscription(Inscription $l)
	{
		$this->collInscriptions[] = $l;
		$l->setProvincia($this);
	}


	
	public function getInscriptionsJoinCourse($criteria = null, $con = null)
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

				$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinCourse($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinCourse($criteria, $con);
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

				$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

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

				$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::STUDENT_PROVINCIA, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProvincia:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProvincia::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 