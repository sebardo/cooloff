<?php


abstract class BaseThairaUploadsFile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $object_class;


	
	protected $object_id;


	
	protected $group_name;


	
	protected $is_pending;


	
	protected $pending_uid;


	
	protected $pending_file_path;


	
	protected $rank;


	
	protected $filename;


	
	protected $extension;


	
	protected $path;
	
	
	protected $is_protected;
	
	
	
	protected $password;


	
	protected $created_at;

	
	protected $collThairaUploadsFileI18ns;

	
	protected $lastThairaUploadsFileI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getObjectClass()
	{

		return $this->object_class;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getGroupName()
	{

		return $this->group_name;
	}

	
	public function getIsPending()
	{

		return $this->is_pending;
	}
	
	public function getIsProtected()
	{

		return $this->is_protected;
	}
	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getPendingUid()
	{

		return $this->pending_uid;
	}

	
	public function getPendingFilePath()
	{

		return $this->pending_file_path;
	}

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getFilename()
	{

		return $this->filename;
	}

	
	public function getExtension()
	{

		return $this->extension;
	}

	
	public function getPath()
	{

		return $this->path;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::ID;
		}

	} 
	
	public function setObjectClass($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_class !== $v) {
			$this->object_class = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::OBJECT_CLASS;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::OBJECT_ID;
		}

	} 
	
	public function setGroupName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->group_name !== $v) {
			$this->group_name = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::GROUP_NAME;
		}

	} 
	
	public function setIsPending($v)
	{

		if ($this->is_pending !== $v) {
			$this->is_pending = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::IS_PENDING;
		}

	} 
	
	public function setIsProtected($v)
	{

		if ($this->is_protected !== $v) {
			$this->is_protected = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::IS_PROTECTED;
		}

	}
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::PASSWORD;
		}

	} 

	
	public function setPendingUid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pending_uid !== $v) {
			$this->pending_uid = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::PENDING_UID;
		}

	} 
	
	public function setPendingFilePath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pending_file_path !== $v) {
			$this->pending_file_path = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::PENDING_FILE_PATH;
		}

	} 
	
	public function setRank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::RANK;
		}

	} 
	
	public function setFilename($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->filename !== $v) {
			$this->filename = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::FILENAME;
		}

	} 
	
	public function setExtension($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->extension !== $v) {
			$this->extension = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::EXTENSION;
		}

	} 
	
	public function setPath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path !== $v) {
			$this->path = $v;
			$this->modifiedColumns[] = ThairaUploadsFilePeer::PATH;
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
			$this->modifiedColumns[] = ThairaUploadsFilePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->object_class = $rs->getString($startcol + 1);

			$this->object_id = $rs->getInt($startcol + 2);

			$this->group_name = $rs->getString($startcol + 3);

			$this->is_pending = $rs->getBoolean($startcol + 4);

			$this->pending_uid = $rs->getString($startcol + 5);

			$this->pending_file_path = $rs->getString($startcol + 6);

			$this->rank = $rs->getInt($startcol + 7);

			$this->filename = $rs->getString($startcol + 8);

			$this->extension = $rs->getString($startcol + 9);

			$this->path = $rs->getString($startcol + 10);
			
			$this->is_protected = $rs->getBoolean($startcol + 11);
			
			$this->password = $rs->getString($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ThairaUploadsFile object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseThairaUploadsFile:delete:pre') as $callable)
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
			$con = Propel::getConnection(ThairaUploadsFilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ThairaUploadsFilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseThairaUploadsFile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseThairaUploadsFile:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ThairaUploadsFilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ThairaUploadsFilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseThairaUploadsFile:save:post') as $callable)
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
					$pk = ThairaUploadsFilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ThairaUploadsFilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collThairaUploadsFileI18ns !== null) {
				foreach($this->collThairaUploadsFileI18ns as $referrerFK) {
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


			if (($retval = ThairaUploadsFilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collThairaUploadsFileI18ns !== null) {
					foreach($this->collThairaUploadsFileI18ns as $referrerFK) {
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
		$pos = ThairaUploadsFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getObjectClass();
				break;
			case 2:
				return $this->getObjectId();
				break;
			case 3:
				return $this->getGroupName();
				break;
			case 4:
				return $this->getIsPending();
				break;
			case 5:
				return $this->getPendingUid();
				break;
			case 6:
				return $this->getPendingFilePath();
				break;
			case 7:
				return $this->getRank();
				break;
			case 8:
				return $this->getFilename();
				break;
			case 9:
				return $this->getExtension();
				break;
			case 10:
				return $this->getPath();
				break;
			case 11:
				return $this->getIsProtected();
				break;
			case 12:
				return $this->getPassword();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThairaUploadsFilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getObjectClass(),
			$keys[2] => $this->getObjectId(),
			$keys[3] => $this->getGroupName(),
			$keys[4] => $this->getIsPending(),
			$keys[5] => $this->getPendingUid(),
			$keys[6] => $this->getPendingFilePath(),
			$keys[7] => $this->getRank(),
			$keys[8] => $this->getFilename(),
			$keys[9] => $this->getExtension(),
			$keys[10] => $this->getPath(),
			$keys[11] => $this->getIsProtected(),
			$keys[12] => $this->getPassword(),
			$keys[13] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThairaUploadsFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setObjectClass($value);
				break;
			case 2:
				$this->setObjectId($value);
				break;
			case 3:
				$this->setGroupName($value);
				break;
			case 4:
				$this->setIsPending($value);
				break;
			case 5:
				$this->setPendingUid($value);
				break;
			case 6:
				$this->setPendingFilePath($value);
				break;
			case 7:
				$this->setRank($value);
				break;
			case 8:
				$this->setFilename($value);
				break;
			case 9:
				$this->setExtension($value);
				break;
			case 10:
				$this->setPath($value);
				break;
			case 11:
				$this->setIsProtected($value);
				break;
			case 12:
				$this->setPassword($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThairaUploadsFilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setObjectClass($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setObjectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGroupName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsPending($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPendingUid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPendingFilePath($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRank($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFilename($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setExtension($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPath($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIsProtected($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPassword($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ThairaUploadsFilePeer::DATABASE_NAME);

		if ($this->isColumnModified(ThairaUploadsFilePeer::ID)) $criteria->add(ThairaUploadsFilePeer::ID, $this->id);
		if ($this->isColumnModified(ThairaUploadsFilePeer::OBJECT_CLASS)) $criteria->add(ThairaUploadsFilePeer::OBJECT_CLASS, $this->object_class);
		if ($this->isColumnModified(ThairaUploadsFilePeer::OBJECT_ID)) $criteria->add(ThairaUploadsFilePeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(ThairaUploadsFilePeer::GROUP_NAME)) $criteria->add(ThairaUploadsFilePeer::GROUP_NAME, $this->group_name);
		if ($this->isColumnModified(ThairaUploadsFilePeer::IS_PENDING)) $criteria->add(ThairaUploadsFilePeer::IS_PENDING, $this->is_pending);
		if ($this->isColumnModified(ThairaUploadsFilePeer::PENDING_UID)) $criteria->add(ThairaUploadsFilePeer::PENDING_UID, $this->pending_uid);
		if ($this->isColumnModified(ThairaUploadsFilePeer::PENDING_FILE_PATH)) $criteria->add(ThairaUploadsFilePeer::PENDING_FILE_PATH, $this->pending_file_path);
		if ($this->isColumnModified(ThairaUploadsFilePeer::RANK)) $criteria->add(ThairaUploadsFilePeer::RANK, $this->rank);
		if ($this->isColumnModified(ThairaUploadsFilePeer::FILENAME)) $criteria->add(ThairaUploadsFilePeer::FILENAME, $this->filename);
		if ($this->isColumnModified(ThairaUploadsFilePeer::EXTENSION)) $criteria->add(ThairaUploadsFilePeer::EXTENSION, $this->extension);
		if ($this->isColumnModified(ThairaUploadsFilePeer::PATH)) $criteria->add(ThairaUploadsFilePeer::PATH, $this->path);
		if ($this->isColumnModified(ThairaUploadsFilePeer::IS_PROTECTED)) $criteria->add(ThairaUploadsFilePeer::IS_PROTECTED, $this->is_protected);
		if ($this->isColumnModified(ThairaUploadsFilePeer::PASSWORD)) $criteria->add(ThairaUploadsFilePeer::PASSWORD, $this->password);
		if ($this->isColumnModified(ThairaUploadsFilePeer::CREATED_AT)) $criteria->add(ThairaUploadsFilePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ThairaUploadsFilePeer::DATABASE_NAME);

		$criteria->add(ThairaUploadsFilePeer::ID, $this->id);

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

		$copyObj->setObjectClass($this->object_class);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setGroupName($this->group_name);

		$copyObj->setIsPending($this->is_pending);

		$copyObj->setPendingUid($this->pending_uid);

		$copyObj->setPendingFilePath($this->pending_file_path);

		$copyObj->setRank($this->rank);

		$copyObj->setFilename($this->filename);

		$copyObj->setExtension($this->extension);

		$copyObj->setPath($this->path);
		
		$copyObj->setIsProtected($this->is_protected);
		
		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getThairaUploadsFileI18ns() as $relObj) {
				$copyObj->addThairaUploadsFileI18n($relObj->copy($deepCopy));
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
			self::$peer = new ThairaUploadsFilePeer();
		}
		return self::$peer;
	}

	
	public function initThairaUploadsFileI18ns()
	{
		if ($this->collThairaUploadsFileI18ns === null) {
			$this->collThairaUploadsFileI18ns = array();
		}
	}

	
	public function getThairaUploadsFileI18ns($criteria = null, $con = null)
	{
				include_once 'plugins/thairaUploadsPlugin/lib/model/om/BaseThairaUploadsFileI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThairaUploadsFileI18ns === null) {
			if ($this->isNew()) {
			   $this->collThairaUploadsFileI18ns = array();
			} else {

				$criteria->add(ThairaUploadsFileI18nPeer::ID, $this->getId());

				ThairaUploadsFileI18nPeer::addSelectColumns($criteria);
				$this->collThairaUploadsFileI18ns = ThairaUploadsFileI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThairaUploadsFileI18nPeer::ID, $this->getId());

				ThairaUploadsFileI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastThairaUploadsFileI18nCriteria) || !$this->lastThairaUploadsFileI18nCriteria->equals($criteria)) {
					$this->collThairaUploadsFileI18ns = ThairaUploadsFileI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastThairaUploadsFileI18nCriteria = $criteria;
		return $this->collThairaUploadsFileI18ns;
	}

	
	public function countThairaUploadsFileI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/thairaUploadsPlugin/lib/model/om/BaseThairaUploadsFileI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ThairaUploadsFileI18nPeer::ID, $this->getId());

		return ThairaUploadsFileI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThairaUploadsFileI18n(ThairaUploadsFileI18n $l)
	{
		$this->collThairaUploadsFileI18ns[] = $l;
		$l->setThairaUploadsFile($this);
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
    $obj = $this->getCurrentThairaUploadsFileI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentThairaUploadsFileI18n()->setTitle($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentThairaUploadsFileI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentThairaUploadsFileI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentThairaUploadsFileI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ThairaUploadsFileI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setThairaUploadsFileI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setThairaUploadsFileI18nForCulture(new ThairaUploadsFileI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setThairaUploadsFileI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addThairaUploadsFileI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseThairaUploadsFile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseThairaUploadsFile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 