<?php

/**
 * @package    symfony
 * @subpackage sfPropelActAsSortableBehaviorPlugin
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 */
class sfPropelActAsSortableBehavior
{
	 

	protected static function getClassFromPeerClass($peerClass)
	{
		return substr($peerClass, 0, -4);
	}

	/**
	 * Returns an item from the list based on its position and optionally a key value, if its been set
	 *
	 * @param string peer class of the sortable objects
	 * @param integer position
	 * @param string keyValue an optional key to group by
	 * @param Connection an optional connection object
	 *
	 * @return mixed sortable object
	 **/
	public static function retrieveByPosition($peerClass, $position, $keyValue = null, $con = null)
	{
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.self::getClassFromPeerClass($peerClass).'_column', 'rank');
		$rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.self::getClassFromPeerClass($peerClass).'_key', null);

		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		$c = new Criteria;
		$c->add($rankColumnPhpName, $position);

		if (!is_null($keyColumnName))
		{
			$keyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $keyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
			$c->add($keyColumnPhpName, $keyValue);
		}

		return call_user_func(array($peerClass, 'doSelectOne'), $c, $con);
	}

	/**
	 * Returns the highest position of a class of sortable objects, optional by key value
	 *
	 * @param string peer class of the sortable objects
	 * @param string keyValue an optional key to group by
	 * @param Connection an optional connection object
	 *
	 * @return integer maximum position
	 **/
	public static function getMaxPosition($peerClass, $keyValue = null, $con = null)
	{
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.self::getClassFromPeerClass($peerClass).'_column', 'rank');
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.self::getClassFromPeerClass($peerClass).'_key', null);

		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		if (!is_null($keyColumnName))
		{
			$sql = sprintf('SELECT MAX(%s) AS max FROM %s WHERE %s = "%s"',
			$rankColumnName,
			constant("$peerClass::TABLE_NAME"),
			$keyColumnName,
			$keyValue
			);
		}
		else
		{
			$sql = sprintf('SELECT MAX(%s) AS max FROM %s',
			$rankColumnName,
			constant("$peerClass::TABLE_NAME")
			);
		}

		$rs = $con->prepareStatement($sql)->executeQuery();
		$rs->next();

		return $rs->getInt('max');
	}

	/**
	 * Returns an array of sortable objects ordered by position
	 *
	 * @param string peer class of the sortable objects
	 * @param string sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
	 * @param Criteria optional criteria object
	 * @param Connection an optional connection object
	 *
	 * @return array list of sortable objects
	 **/
	public static function doSelectOrderByPosition($peerClass, $order = Criteria::ASC, $criteria = null, $con = null)
	{
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.self::getClassFromPeerClass($peerClass).'_column', 'rank');
		$rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		if ($criteria === null)
		{
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->clearOrderByColumns();

		if($order == Criteria::ASC)
		{
			$criteria->addAscendingOrderByColumn($rankColumnPhpName);
		}
		else
		{
			$criteria->addDescendingOrderByColumn($rankColumnPhpName);
		}

		return call_user_func(array($peerClass, 'doSelect'), $criteria, $con);
	}

	/**
	 * Reorders a set of sortable objects based on a list of id/position
	 * Beware that there is no check made on the positions passed
	 * So incoherent positions will result in an incoherent list
	 *
	 * @param string peer class of the sortable objects
	 * @param array id/position pairs
	 * @param Connection an optional connection object
	 *
	 * @return Boolean true if the reordering took place, false if a database problem prevented it
	 **/
	public static function doSort($peerClass, $order, $con = null)
	{
		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
		try
		{
			$con->begin();

			foreach ($order as $id => $rank)
			{
				$item = call_user_func(array($peerClass, 'retrieveByPk'), $id);

				if(@self::getPosition($item) != $rank)
				{
					@self::setPosition($item, $rank);
					$item->save();
				}
			}

			$con->commit();
			return true;
		}
		catch (Exception $e)
		{
			$con->rollback();
			return false;
		}
	}

	/**
	 * Gets the position of a sortable object
	 *
	 * @param mixed sortable object
	 *
	 * @return integer position of the sortable object
	 **/
	public function getPosition($object)
	{
		return $object->getByName(sfConfig::get('propel_behavior_act_as_sortable_'.get_class($object).'_column', 'rank'), BasePeer::TYPE_FIELDNAME);
	}

	/**
	 * Sets the position of a sortable object
	 * Beware that there is no check made on the value passed
	 * If the position already exists, or if it is superior to the highest position + 1,
	 * the method does not throw any exception
	 *
	 * @param mixed sortable object
	 * @param integer position value
	 *
	 **/
	public function setPosition($object, $position)
	{
		return $object->setByName(sfConfig::get('propel_behavior_act_as_sortable_'.get_class($object).'_column', 'rank'), $position, BasePeer::TYPE_FIELDNAME);
	}

	/**
	 * Returns the next item in the list, i.e. the one for which position is immediately higher
	 * Optionally by a key value
	 *
	 * @param mixed sortable object
	 *
	 * @return mixed sortable object of the same class as the argument
	 **/
	public function getNext($object)
	{
		$class = get_class($object);
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		return self::retrieveByPosition(get_class($object).'Peer', self::getPosition($object) + 1, $keyValue);
	}

	/**
	 * Returns the previous item in the list, i.e. the one for which position is immediately lower
	 * Optionally by a key value
	 *
	 * @param mixed sortable object
	 *
	 * @return mixed sortable object of the same class as the argument
	 **/
	public function getPrevious($object)
	{
		$class = get_class($object);

		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		return self::retrieveByPosition(get_class($object).'Peer', self::getPosition($object) - 1, $keyValue);
	}

	/**
	 * Checks if the object is first in the list, i.e. if it has 1 for position
	 *
	 * @param mixed sortable object
	 *
	 * @return boolean True if the item is the first in the list
	 **/
	public function isFirst($object)
	{
		return self::getPosition($object) == 1;
	}

	/**
	 * Checks if the object is last in the list, i.e. if its position is the highest position
	 * Optionally by a key value
	 *
	 * @param mixed sortable object
	 *
	 * @return boolean True if the item is the last in the list
	 **/
	public function isLast($object)
	{
		$class = get_class($object);

		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		return self::getPosition($object) == self::getMaxPosition(get_class($object).'Peer', $keyValue);
	}

	/**
	 * Moves the object higher in the list, i.e. exchanges its position with the one of the previous object
	 *
	 * @param mixed sortable object
	 *
	 * @return mixed False if the object cannot be moved further up, an array of the swapped ranks otherwise
	 **/
	public function moveUp($object)
	{
		return self::isFirst($object) ? false : self::swapWith($object, self::getPrevious($object));
	}

	/**
	 * Moves the object lower in the list, i.e. exchanges its position with the one of the next object
	 *
	 * @param mixed sortable object
	 *
	 * @return mixed False if the object cannot be moved further down, an array of the swapped ranks otherwise
	 **/
	public function moveDown($object)
	{
		return self::isLast($object) ? false : self::swapWith($object, self::getNext($object));
	}

	/**
	 * Exchanges the position of the object with the one passed as argument
	 *
	 * @param mixed sortable object
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 * @return array the swapped ranks
	 *
	 * @throws Exception if the database cannot execute the two updates
	 **/
	public function swapWith($object, $item, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';
		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
		try
		{
			$con->begin();
			$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_column', 'rank');
			$oldRank = self::getPosition($object);
			$newRank = self::getPosition($item);
			self::setPosition($object, $newRank);
			$object->save();
			self::setPosition($item, $oldRank);
			$item->save();

			$con->commit();
			return array($oldRank, $newRank);
		}
		catch (Exception $e)
		{
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Moves the object to a new position, and shifts the position
	 * Of the objects inbetween the old and new position accordingly
	 * Optionally by key value
	 *
	 * @param mixed sortable object
	 * @param integer position value
	 * @param Connection an optional connection object
	 *
	 * @return integer the old object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function moveToPosition($object, $newPosition, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_column', 'rank');
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		$oldPosition = self::getPosition($object);
		if ($oldPosition == $newPosition) return $oldPosition;

		try
		{
			$con->begin();

			// Move the object away
			self::setPosition($object, self::getMaxPosition($peerClass, $keyValue) + 1);
			$object->save();

			// Shift the objects between the old and the new position
			if (!is_null($keyColumnName))
			{
				$query = sprintf('UPDATE %s SET %s = %s %s 1 WHERE %s BETWEEN ? AND ? AND %s = "%s"',
				constant("$peerClass::TABLE_NAME"),
				$rankColumnName,
				$rankColumnName,
				($oldPosition < $newPosition) ? '-' : '+',
				$rankColumnName,
				$keyColumnName,
				$keyValue
				);
			}
			else
			{
				$query = sprintf('UPDATE %s SET %s = %s %s 1 WHERE %s BETWEEN ? AND ?',
				constant("$peerClass::TABLE_NAME"),
				$rankColumnName,
				$rankColumnName,
				($oldPosition < $newPosition) ? '-' : '+',
				$rankColumnName
				);
			}

			$stmt = $con->prepareStatement($query);
			$stmt->setInt(1, min($oldPosition, $newPosition));
			$stmt->setInt(2, max($oldPosition, $newPosition));
			$stmt->executeQuery();

			// Move the object back in
			self::setPosition($object, $newPosition);
			$object->save();

			$con->commit();
			return $oldPosition;
		}
		catch (Exception $e)
		{
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Moves the object to the top of the list (i.e. gives it position 1),
	 * And shifts the position of the objects lower in the list accordingly
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 * @return integer the old object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function moveToTop($object, $con = null)
	{
		return self::moveToPosition($object, 1, $con);
	}

	/**
	 * Moves the object to the top of the list (i.e. gives it position maxPosition),
	 * And shifts the position of the objects higher in the list accordingly
	 * Optionally by key value
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 * @return integer the old object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function moveToBottom($object, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';

		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		return self::moveToPosition($object, self::getMaxPosition($peerClass, $keyValue), $con);
	}

	/**
	 * Inserts the object in the list at a given position,
	 * And shifts the position of the objects lower in the list accordingly
	 * Optionally by key value
	 *
	 * @param mixed sortable object
	 * @param integer position value
	 * @param Connection an optional connection object
	 *
	 * @return integer the new object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function insertAtPosition($object, $position, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_column', 'rank');
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);

		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		try
		{
			$con->begin();

			// Shift the objects with a position higher than the given position
			if (!is_null($keyColumnName))
			{
				$query = sprintf('UPDATE %s SET %s = %s + 1 WHERE %s >= ? AND %s = "%s"',
				constant("$peerClass::TABLE_NAME"),
				$rankColumnName,
				$rankColumnName,
				$rankColumnName,
				$keyColumnName,
				$keyValue
				);
			}
			else
			{
				$query = sprintf('UPDATE %s SET %s = %s + 1 WHERE %s >= ?',
				constant("$peerClass::TABLE_NAME"),
				$rankColumnName,
				$rankColumnName,
				$rankColumnName
				);
			}

			$stmt = $con->prepareStatement($query);
			$stmt->setInt(1, $position);
			$stmt->executeQuery();

			// Move the object in the list, at the given position
			self::setPosition($object, $position);
			$object->save();

			$con->commit();
			return $position;
		}
		catch (Exception $e)
		{
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Set the position of the object to the top of the list (i.e. gives it position 1),
	 * And shifts the position of the objects lower in the list accordingly
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 * @return integer the old object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function insertAtTop($object, $con = null)
	{
		return self::insertAtPosition($object, 1, $con);
	}

	/**
	 * Sets the position of the object to the top of the list (i.e. gives it position maxPosition+1)
	 * Optionally by key value
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 * @return integer the old object's position
	 *
	 * @throws Exception if the database cannot execute the position updates
	 **/
	public function insertAtBottom($object, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';

		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);
		else $keyValue = null;

		self::setPosition($object, self::getMaxPosition($peerClass, $keyValue)+1, $con);

		return $object->save($con);
	}

	/**
	 * Sets the position of a new object before saving it
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 **/
	public function preSave($object, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_column', 'rank');
		$rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (! is_null($keyColumnName)) {
			$keyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $keyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
		} else {
			$keyColumnPhpName = null;
		}
		
		// new records need to be initialized with position
		if ($object->isNew() && !$object->isColumnModified($rankColumnPhpName))
		{
			$newElementPosition = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_new_element_position', 'bottom');
			if ($newElementPosition == 'bottom')
			{
				self::insertAtBottom($object, $con);
			}
			else
			{
				self::insertAtTop($object, $con);
			}
		}
		
		if (!$object->isNew() && $object->isColumnModified($keyColumnPhpName)) {
			$currentPosition = 1;
			$oldCategoryPositions = array();
			$keyGetter = self::getCamelCaseName($keyColumnName);
			
			$savedObject = call_user_func(array($peerClass, 'retrieveByPK'), $object->getId());
			$oldCategoryId = call_user_func(array($savedObject, 'get' . $keyGetter), null);	// aixo peta
			$newCategoryId = call_user_func(array($object, 'get' . $keyGetter), null);
			$newCategoryMaxPosition = self::getMaxPosition($peerClass, $newCategoryId);

			// fer manualment el "getAllByRank"
			$oldCategoryItems = call_user_func(array($peerClass, 'getAllByRank'), $oldCategoryId);
			if ($oldCategoryItems) {
				foreach ($oldCategoryItems as $item) {
					if ($item->getId() !== $object->getId()) {
						$oldCategoryPositions[$item->getId()] = $currentPosition;
						$currentPosition++;
					}
				}
				
				self::doSort($peerClass, $oldCategoryPositions);
			}
			
			$object->setRank($newCategoryMaxPosition + 1);
		}
	}
	
	private static function getCamelCaseName($string)
	{
		// TODO: we could use sfInflector functions instead
		$camelCasedName = array();
		$allWords = explode('_', $string);
		foreach ($allWords as $word) {
			$camelCasedName[] = ucfirst($word);
		}
		
		return implode('', $camelCasedName);
	} 
	

	/**
	 * Decreases all the positions of the items of the same class with higher positions
	 * Optionally by key value
	 *
	 * @param mixed sortable object
	 * @param Connection an optional connection object
	 *
	 **/
	public function preDelete($object, $con = null)
	{
		$class = get_class($object);
		$peerClass = $class.'Peer';
		$rankColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_column', 'rank');
		$keyColumnName = sfConfig::get('propel_behavior_act_as_sortable_'.$class.'_key', null);

		if (!is_null($keyColumnName)) $keyValue = $object->getByName($keyColumnName, BasePeer::TYPE_FIELDNAME);

		if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

		if (!is_null($keyColumnName))
		{
			$query = sprintf('UPDATE %s SET %s = %s - 1 WHERE %s > ? AND %s = "%s"',
			constant("$peerClass::TABLE_NAME"),
			$rankColumnName,
			$rankColumnName,
			$rankColumnName,
			$keyColumnName,
			$keyValue
			);
		}
		else
		{
			$query = sprintf('UPDATE %s SET %s = %s - 1 WHERE %s > ?',
			constant("$peerClass::TABLE_NAME"),
			$rankColumnName,
			$rankColumnName,
			$rankColumnName
			);
		}

		$stmt = $con->prepareStatement($query);
		$stmt->setInt(1, self::getPosition($object));
		$stmt->executeQuery();
	}
}
