<?php


abstract class BaseTpv extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $centro_id;


	
	protected $merchant_code;


	
	protected $merchant_key;


	
	protected $url_tpv;


	
	protected $is_active = true;


	
	protected $id;

	
	protected $aSummerFunCenter;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCentroId()
	{

		return $this->centro_id;
	}

	
	public function getMerchantCode()
	{

		return $this->merchant_code;
	}

	
	public function getMerchantKey()
	{

		return $this->merchant_key;
	}

	
	public function getUrlTpv()
	{

		return $this->url_tpv;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setCentroId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->centro_id !== $v) {
			$this->centro_id = $v;
			$this->modifiedColumns[] = TpvPeer::CENTRO_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setMerchantCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->merchant_code !== $v) {
			$this->merchant_code = $v;
			$this->modifiedColumns[] = TpvPeer::MERCHANT_CODE;
		}

	} 
	
	public function setMerchantKey($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->merchant_key !== $v) {
			$this->merchant_key = $v;
			$this->modifiedColumns[] = TpvPeer::MERCHANT_KEY;
		}

	} 
	
	public function setUrlTpv($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_tpv !== $v) {
			$this->url_tpv = $v;
			$this->modifiedColumns[] = TpvPeer::URL_TPV;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = TpvPeer::IS_ACTIVE;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TpvPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->centro_id = $rs->getInt($startcol + 0);

			$this->merchant_code = $rs->getString($startcol + 1);

			$this->merchant_key = $rs->getString($startcol + 2);

			$this->url_tpv = $rs->getString($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->id = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tpv object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseTpv:delete:pre') as $callable)
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
			$con = Propel::getConnection(TpvPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TpvPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTpv:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseTpv:save:pre') as $callable)
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
			$con = Propel::getConnection(TpvPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTpv:save:post') as $callable)
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
					$pk = TpvPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TpvPeer::doUpdate($this, $con);
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


												
			if ($this->aSummerFunCenter !== null) {
				if (!$this->aSummerFunCenter->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunCenter->getValidationFailures());
				}
			}


			if (($retval = TpvPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TpvPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCentroId();
				break;
			case 1:
				return $this->getMerchantCode();
				break;
			case 2:
				return $this->getMerchantKey();
				break;
			case 3:
				return $this->getUrlTpv();
				break;
			case 4:
				return $this->getIsActive();
				break;
			case 5:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TpvPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCentroId(),
			$keys[1] => $this->getMerchantCode(),
			$keys[2] => $this->getMerchantKey(),
			$keys[3] => $this->getUrlTpv(),
			$keys[4] => $this->getIsActive(),
			$keys[5] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TpvPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCentroId($value);
				break;
			case 1:
				$this->setMerchantCode($value);
				break;
			case 2:
				$this->setMerchantKey($value);
				break;
			case 3:
				$this->setUrlTpv($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
			case 5:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TpvPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCentroId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMerchantCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMerchantKey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUrlTpv($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setId($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TpvPeer::DATABASE_NAME);

		if ($this->isColumnModified(TpvPeer::CENTRO_ID)) $criteria->add(TpvPeer::CENTRO_ID, $this->centro_id);
		if ($this->isColumnModified(TpvPeer::MERCHANT_CODE)) $criteria->add(TpvPeer::MERCHANT_CODE, $this->merchant_code);
		if ($this->isColumnModified(TpvPeer::MERCHANT_KEY)) $criteria->add(TpvPeer::MERCHANT_KEY, $this->merchant_key);
		if ($this->isColumnModified(TpvPeer::URL_TPV)) $criteria->add(TpvPeer::URL_TPV, $this->url_tpv);
		if ($this->isColumnModified(TpvPeer::IS_ACTIVE)) $criteria->add(TpvPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(TpvPeer::ID)) $criteria->add(TpvPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TpvPeer::DATABASE_NAME);

		$criteria->add(TpvPeer::ID, $this->id);

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

		$copyObj->setCentroId($this->centro_id);

		$copyObj->setMerchantCode($this->merchant_code);

		$copyObj->setMerchantKey($this->merchant_key);

		$copyObj->setUrlTpv($this->url_tpv);

		$copyObj->setIsActive($this->is_active);


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
			self::$peer = new TpvPeer();
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTpv:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTpv::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 