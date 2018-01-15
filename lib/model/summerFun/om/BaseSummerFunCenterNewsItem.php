<?php


abstract class BaseSummerFunCenterNewsItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $summer_fun_center_id;


	
	protected $published_at;


	
	protected $is_published = false;

	
	protected $aSummerFunCenter;

	
	protected $collSummerFunCenterNewsItemI18ns;

	
	protected $lastSummerFunCenterNewsItemI18nCriteria = null;

	
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

	
	public function getSummerFunCenterId()
	{

		return $this->summer_fun_center_id;
	}

	
	public function getPublishedAt($format = 'Y-m-d')
	{

		if ($this->published_at === null || $this->published_at === '') {
			return null;
		} elseif (!is_int($this->published_at)) {
						$ts = strtotime($this->published_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [published_at] as date/time value: " . var_export($this->published_at, true));
			}
		} else {
			$ts = $this->published_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsPublished()
	{

		return $this->is_published;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::ID;
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
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::UPDATED_AT;
		}

	} 
	
	public function setSummerFunCenterId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->summer_fun_center_id !== $v) {
			$this->summer_fun_center_id = $v;
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setPublishedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [published_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->published_at !== $ts) {
			$this->published_at = $ts;
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::PUBLISHED_AT;
		}

	} 
	
	public function setIsPublished($v)
	{

		if ($this->is_published !== $v || $v === false) {
			$this->is_published = $v;
			$this->modifiedColumns[] = SummerFunCenterNewsItemPeer::IS_PUBLISHED;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->summer_fun_center_id = $rs->getInt($startcol + 3);

			$this->published_at = $rs->getDate($startcol + 4, null);

			$this->is_published = $rs->getBoolean($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunCenterNewsItem object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterNewsItem:delete:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunCenterNewsItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunCenterNewsItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterNewsItem:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterNewsItem:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SummerFunCenterNewsItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SummerFunCenterNewsItemPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunCenterNewsItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunCenterNewsItem:save:post') as $callable)
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
					$pk = SummerFunCenterNewsItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunCenterNewsItemPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSummerFunCenterNewsItemI18ns !== null) {
				foreach($this->collSummerFunCenterNewsItemI18ns as $referrerFK) {
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


			if (($retval = SummerFunCenterNewsItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSummerFunCenterNewsItemI18ns !== null) {
					foreach($this->collSummerFunCenterNewsItemI18ns as $referrerFK) {
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
		$pos = SummerFunCenterNewsItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSummerFunCenterId();
				break;
			case 4:
				return $this->getPublishedAt();
				break;
			case 5:
				return $this->getIsPublished();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterNewsItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getSummerFunCenterId(),
			$keys[4] => $this->getPublishedAt(),
			$keys[5] => $this->getIsPublished(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterNewsItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSummerFunCenterId($value);
				break;
			case 4:
				$this->setPublishedAt($value);
				break;
			case 5:
				$this->setIsPublished($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterNewsItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSummerFunCenterId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPublishedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsPublished($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunCenterNewsItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::ID)) $criteria->add(SummerFunCenterNewsItemPeer::ID, $this->id);
		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::CREATED_AT)) $criteria->add(SummerFunCenterNewsItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::UPDATED_AT)) $criteria->add(SummerFunCenterNewsItemPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID)) $criteria->add(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, $this->summer_fun_center_id);
		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::PUBLISHED_AT)) $criteria->add(SummerFunCenterNewsItemPeer::PUBLISHED_AT, $this->published_at);
		if ($this->isColumnModified(SummerFunCenterNewsItemPeer::IS_PUBLISHED)) $criteria->add(SummerFunCenterNewsItemPeer::IS_PUBLISHED, $this->is_published);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunCenterNewsItemPeer::DATABASE_NAME);

		$criteria->add(SummerFunCenterNewsItemPeer::ID, $this->id);

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

		$copyObj->setSummerFunCenterId($this->summer_fun_center_id);

		$copyObj->setPublishedAt($this->published_at);

		$copyObj->setIsPublished($this->is_published);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSummerFunCenterNewsItemI18ns() as $relObj) {
				$copyObj->addSummerFunCenterNewsItemI18n($relObj->copy($deepCopy));
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
			self::$peer = new SummerFunCenterNewsItemPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setSummerFunCenterId(NULL);
		} else {
			$this->setSummerFunCenterId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->summer_fun_center_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->summer_fun_center_id, $con);

			
		}
		return $this->aSummerFunCenter;
	}

	
	public function initSummerFunCenterNewsItemI18ns()
	{
		if ($this->collSummerFunCenterNewsItemI18ns === null) {
			$this->collSummerFunCenterNewsItemI18ns = array();
		}
	}

	
	public function getSummerFunCenterNewsItemI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterNewsItemI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterNewsItemI18ns === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenterNewsItemI18ns = array();
			} else {

				$criteria->add(SummerFunCenterNewsItemI18nPeer::ID, $this->getId());

				SummerFunCenterNewsItemI18nPeer::addSelectColumns($criteria);
				$this->collSummerFunCenterNewsItemI18ns = SummerFunCenterNewsItemI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterNewsItemI18nPeer::ID, $this->getId());

				SummerFunCenterNewsItemI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterNewsItemI18nCriteria) || !$this->lastSummerFunCenterNewsItemI18nCriteria->equals($criteria)) {
					$this->collSummerFunCenterNewsItemI18ns = SummerFunCenterNewsItemI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterNewsItemI18nCriteria = $criteria;
		return $this->collSummerFunCenterNewsItemI18ns;
	}

	
	public function countSummerFunCenterNewsItemI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterNewsItemI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterNewsItemI18nPeer::ID, $this->getId());

		return SummerFunCenterNewsItemI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenterNewsItemI18n(SummerFunCenterNewsItemI18n $l)
	{
		$this->collSummerFunCenterNewsItemI18ns[] = $l;
		$l->setSummerFunCenterNewsItem($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle()
  {
    $obj = $this->getCurrentSummerFunCenterNewsItemI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentSummerFunCenterNewsItemI18n()->setTitle($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentSummerFunCenterNewsItemI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentSummerFunCenterNewsItemI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentSummerFunCenterNewsItemI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = SummerFunCenterNewsItemI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setSummerFunCenterNewsItemI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setSummerFunCenterNewsItemI18nForCulture(new SummerFunCenterNewsItemI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setSummerFunCenterNewsItemI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addSummerFunCenterNewsItemI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunCenterNewsItem:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunCenterNewsItem::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 