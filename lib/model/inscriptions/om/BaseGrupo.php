<?php


abstract class BaseGrupo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $centro_id;

	
	protected $aSummerFunCenter;

	
	protected $collInscriptions;

	
	protected $lastInscriptionCriteria = null;

	
	protected $collGrupoHasProfesors;

	
	protected $lastGrupoHasProfesorCriteria = null;

	
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
			$this->modifiedColumns[] = GrupoPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = GrupoPeer::NOMBRE;
		}

	} 
	
	public function setCentroId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->centro_id !== $v) {
			$this->centro_id = $v;
			$this->modifiedColumns[] = GrupoPeer::CENTRO_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->centro_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Grupo object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupo:delete:pre') as $callable)
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
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GrupoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGrupo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupo:save:pre') as $callable)
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
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGrupo:save:post') as $callable)
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
					$pk = GrupoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GrupoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInscriptions !== null) {
				foreach($this->collInscriptions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGrupoHasProfesors !== null) {
				foreach($this->collGrupoHasProfesors as $referrerFK) {
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


			if (($retval = GrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInscriptions !== null) {
					foreach($this->collInscriptions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGrupoHasProfesors !== null) {
					foreach($this->collGrupoHasProfesors as $referrerFK) {
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
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				return $this->getCentroId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getCentroId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				$this->setCentroId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCentroId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoPeer::ID)) $criteria->add(GrupoPeer::ID, $this->id);
		if ($this->isColumnModified(GrupoPeer::NOMBRE)) $criteria->add(GrupoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(GrupoPeer::CENTRO_ID)) $criteria->add(GrupoPeer::CENTRO_ID, $this->centro_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		$criteria->add(GrupoPeer::ID, $this->id);

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

		$copyObj->setCentroId($this->centro_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInscriptions() as $relObj) {
				$copyObj->addInscription($relObj->copy($deepCopy));
			}

			foreach($this->getGrupoHasProfesors() as $relObj) {
				$copyObj->addGrupoHasProfesor($relObj->copy($deepCopy));
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
			self::$peer = new GrupoPeer();
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

				$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

				InscriptionPeer::addSelectColumns($criteria);
				$this->collInscriptions = InscriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

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

		$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

		return InscriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInscription(Inscription $l)
	{
		$this->collInscriptions[] = $l;
		$l->setGrupo($this);
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

				$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinCourse($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinCourse($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
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

				$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinProvincia($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinProvincia($criteria, $con);
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

				$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		} else {
									
			$criteria->add(InscriptionPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastInscriptionCriteria) || !$this->lastInscriptionCriteria->equals($criteria)) {
				$this->collInscriptions = InscriptionPeer::doSelectJoinKidsAndUsCenter($criteria, $con);
			}
		}
		$this->lastInscriptionCriteria = $criteria;

		return $this->collInscriptions;
	}

	
	public function initGrupoHasProfesors()
	{
		if ($this->collGrupoHasProfesors === null) {
			$this->collGrupoHasProfesors = array();
		}
	}

	
	public function getGrupoHasProfesors($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseGrupoHasProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupoHasProfesors === null) {
			if ($this->isNew()) {
			   $this->collGrupoHasProfesors = array();
			} else {

				$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->getId());

				GrupoHasProfesorPeer::addSelectColumns($criteria);
				$this->collGrupoHasProfesors = GrupoHasProfesorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->getId());

				GrupoHasProfesorPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoHasProfesorCriteria) || !$this->lastGrupoHasProfesorCriteria->equals($criteria)) {
					$this->collGrupoHasProfesors = GrupoHasProfesorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoHasProfesorCriteria = $criteria;
		return $this->collGrupoHasProfesors;
	}

	
	public function countGrupoHasProfesors($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseGrupoHasProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->getId());

		return GrupoHasProfesorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupoHasProfesor(GrupoHasProfesor $l)
	{
		$this->collGrupoHasProfesors[] = $l;
		$l->setGrupo($this);
	}


	
	public function getGrupoHasProfesorsJoinProfesor($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseGrupoHasProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupoHasProfesors === null) {
			if ($this->isNew()) {
				$this->collGrupoHasProfesors = array();
			} else {

				$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->getId());

				$this->collGrupoHasProfesors = GrupoHasProfesorPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(GrupoHasProfesorPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastGrupoHasProfesorCriteria) || !$this->lastGrupoHasProfesorCriteria->equals($criteria)) {
				$this->collGrupoHasProfesors = GrupoHasProfesorPeer::doSelectJoinProfesor($criteria, $con);
			}
		}
		$this->lastGrupoHasProfesorCriteria = $criteria;

		return $this->collGrupoHasProfesors;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGrupo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGrupo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 