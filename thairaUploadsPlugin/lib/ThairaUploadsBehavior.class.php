<?php

class ThairaUploadsBehavior {

	public static function registerBehavior() {
		sfPropelBehavior::registerMethods('thaira_uploads_behavior', array(
				array('ThairaUploadsBehavior', 'getFile'),
				array('ThairaUploadsBehavior', 'getFiles'),
				array('ThairaUploadsBehavior', 'getFilesPager'),
		));

		sfPropelBehavior::registerHooks('thaira_uploads_behavior', array(
			':delete:pre' => array('ThairaUploadsBehavior', 'deletePre'),
			':save:post' => array('ThairaUploadsBehavior', 'savePost')
		));
	}

	public function deletePre($object, $con = null) {
		if (! $object->isNew()) {
			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, get_class($object));
			$c->add(ThairaUploadsFilePeer::OBJECT_ID, $object->getId());
			$files = ThairaUploadsFilePeer::doSelect($c);
			foreach ($files as $file) {
				$file->delete($con);
			}
		}
	}

	/**
	 * Returns the first ThairaUploadsFile of the specified group
	 *
	 * @param object $object
	 * @param string $groupName
	 * @param Criteria $c
	 * @param boolean $noCache
	 * @param PropelConnection $con
	 * @return ThairaUploadsFile The first file of group
	 */
	public function getFile($object, $groupName, Criteria $c = null, $con = null, $noCache = false) {
		$files = $this->getFiles($object, $groupName, $c, $con, $noCache);
		if (! empty($files)) {
			return $files[0];
		} else {
			return null;
		}
	}
	
	/**
	 * Returns an array of ThairaUploadsFile objects of the specified group
	 *
	 * @param object $object
	 * @param string $groupName
	 * @param Criteria $c
	 * @param boolean $noCache
	 * @param PropelConnection $con
	 * @return array Array of ThairaUploadsFile objects
	 */
	public function getFiles($object, $groupName, Criteria $c = null, $con = null, $noCache = false) {
		// Check the cache
		if (isset($object->_thairaUploadsCache[$groupName]) && ! $noCache) {
			return $object->_thairaUploadsCache[$groupName];
		}

		$objectClass = get_class($object);
		$objectId = $object->getId();

		if (! $c) {
			$c = new Criteria();
		}
		$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, $objectClass);
		$c->add(ThairaUploadsFilePeer::OBJECT_ID, $objectId);
		$c->add(ThairaUploadsFilePeer::GROUP_NAME, $groupName);
		$c->addAscendingOrderByColumn(ThairaUploadsFilePeer::RANK);

		$results = ThairaUploadsFilePeer::doSelectWithI18n($c);

		if (! isset($object->_thairaUploadsCache)) {
			$object->_thairaUploadsCache = array();
		}
		$object->_thairaUploadsCache[$groupName] = $results;

		return $results;
	}

	/**
	 * Create an unitialitzed sfPropelPager. You must call init method
	 * of pager object before use it. 
	 * 
	 * @param object $object
	 * @param string $groupName
	 * @param Criteria $c
	 * @return sfPropelPager
	 */
	public function getFilesPager($object, $groupName, Criteria $c = null) {
		$objectClass = get_class($object);
		$objectId = $object->getId();

		if (! $c) {
			$c = new Criteria();
		}
		$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, $objectClass);
		$c->add(ThairaUploadsFilePeer::OBJECT_ID, $objectId);
		$c->add(ThairaUploadsFilePeer::GROUP_NAME, $groupName);
		$c->addAscendingOrderByColumn(ThairaUploadsFilePeer::RANK);

		$pager = new sfPropelPager('ThairaUploadsFile');
		$pager->setCriteria($c);
		$pager->setPeerMethod('doSelectWithI18n');

		return $pager;
	}

	public function savePost($object, $con = null) {
		$log = sfLogger::getInstance();
		$log->info("{ThairaUploadsBehavior} savePost called");

		if (sfContext::getInstance()->getRequest()->hasAttribute('thairaUploadsSessions')) {
			$sessions = sfContext::getInstance()->getRequest()->getAttribute(
					'thairaUploadsSessions');

			if (! $con) {
				$con = Propel::getConnection(ThairaMediaLibraryFilePeer::DATABASE_NAME);
			}

			foreach ($sessions as $session) {
				$savePath = $session->getSystemSavePath();
				ThairaUploadsValidator::checkSavePath($savePath);

				$files = $session->getFiles();
				foreach ($files as $file) {
					if (! $file->getIsPending()) {
						continue;
					}

					$filename = $this->getNextValidFilename($savePath, $file,
							$session->getStripFilenames());
					$oldPath = $file->getSystemPath();
					$path = $savePath . DIRECTORY_SEPARATOR . $filename;

					try {
						// Update the object
						$file->setIsPending(false);
						$file->setObjectClass(get_class($object));
						$file->setObjectId($object->getId());
						$file->setGroupName($session->getGroupName());
						$file->setFilename($filename);
						$file->save($con);
	
						// Move the file
						$r = @ rename($oldPath, $path);
						if (! $r) {
							throw new Exception('Move error');
						}
					} catch (Exception $e) {
						// Is nothing to do... remove all
						$file->delete();
					}
				}
			}
		}
	}

	private function getNextValidFilename($savePath, $file, $stripFilenames) {
		$filename = $file->getFilename();

		$ext = $file->getExtension();
		$filepart = substr($filename, 0, (strlen($ext) + 1) * (-1));
		if ($stripFilenames) {
			$filepart = ThairaProjectTools::createStrippedName($filepart);
			$filename = $filepart . '.' . $ext;
		}

		$path = $savePath . DIRECTORY_SEPARATOR . $filename;

		$sufix = 1;
		while (is_file($path)) {
			$filename = $filepart . '-' . $sufix . '.' . $ext;
			$path = $savePath . DIRECTORY_SEPARATOR . $filename;
			$sufix++;
		}

		return $filename;
	}
}