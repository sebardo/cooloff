<?php

class ThairaUploadsSession {
	private $uid;

	private $objectClass;
	private $objectId;
	private $groupName;
	private $savePath;
	private $validation;
	private $imageAutoScale;
	private $stripFilenames;
	private $fields = array();

	private $files = array();
	/**
	 * @param string $uid
	 * @param object $object
	 * @return ThairaUploadsSession
	 */
	public static function getSessionByUid($uid) {
		$session = new ThairaUploadsSession();
		$user = sfContext::getInstance()->getUser();

		$session->uid = $uid;

		$info = $user->getAttribute($uid, null, 'ThairaUploadsSession');
		if ($info) {
			$session->objectClass = $info['objectClass'];
			$session->objectId = $info['objectId'];
			$session->groupName = $info['groupName'];
			$session->savePath = $info['savePath'];
			$session->validation = $info['validation'];
			$session->fields = $info['fields'];
			$session->imageAutoScale = $info['imageAutoScale'];
			$session->stripFilenames = $info['stripFilenames'];
		} else {
			throw new ThairaUploadsException('Bad UID');
		}

		return $session;
	}

	/**
	 * @param string $uid
	 * @param object $object
	 * @return ThairaUploadsSession
	 */
	public static function createSession($uid, $object, $groupName = null) {
		$session = new ThairaUploadsSession();
		$user = sfContext::getInstance()->getUser();

		$session->uid = $uid;
		$session->objectClass = get_class($object);
		$session->objectId = $object->getId();
		$session->groupName = $groupName;

		sfLogger::getInstance()->info('{ThairaUploadsSession} session created '
				. "uid:$uid objectClass:$session->objectClass "
				. "objectId:$session->objectId groupName:$groupName");

		return $session;
	}

	public static function genUid() {
		self::purgeAll();

		$user = sfContext::getInstance()->getUser();
		$uid = null;
		do {
			$uid = uniqid();
			$info = $user->getAttribute($uid, null, 'ThairaUploadsSession');
		} while ($info !== null);

		return $uid;
	}

	public static function purgeAll() {
		$log = sfLogger::getInstance();
		$log->info('{ThairaUploadsSession} checking purge...');

		$minTime = time() - sfConfig::get('app_thaira_uploads_purge_time');

		// Check if is necessary purge
		$path = sfConfig::get('app_thaira_uploads_pending_dir')
				. DIRECTORY_SEPARATOR . '.last_clean_touch';
		if (! is_file($path) || filemtime($path) <= $minTime) {
			// Purge files of pending dir
			$log->info('{ThairaUploadsSession} purging pending dir');
			$globPath = sfConfig::get('app_thaira_uploads_pending_dir')
					. DIRECTORY_SEPARATOR . '*';
			foreach (glob($globPath) as $file) {
				$log->info(sprintf('{ThairaUploadsSession} mtime:%d mintime:%d',
						filemtime($file), $minTime));
				if (basename($file) != '.last_clean_touch'
						&& filemtime($file) <= $minTime) {
					@ unlink($file);
					$log->info('{ThairaUploadsSession} purged:' . $file);
				}
			}

			// Purge files objects
			$log->info('{ThairaUploadsSession} purging file objects');
			$timestamp = date('Y-m-d H:i:s', $minTime);
			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::CREATED_AT, $timestamp, Criteria::LESS_EQUAL);
			$c->add(ThairaUploadsFilePeer::IS_PENDING, true);
			$files = ThairaUploadsFilePeer::doSelect($c);
			foreach ($files as $file) {
				$log->info('{ThairaUploadsSession} purged:' . $file->getId());
				$file->delete();
			}

			// Purge session data
			$user = sfContext::getInstance()->getUser();
			$vars = $user->getAttributeHolder();
			$infos = $vars->getAll('ThairaUploadsSession');
			foreach ($infos as $uid => $info) {
				if ($info['updatedAt'] <= $minTime) {
					$log->info('{ThairaUploadsSession} purged session:' . $uid);
					$vars->remove($uid, 'ThairaUploadsSession');
				}
			}

			// Touch file
			if (! is_file($path)) {
				ThairaUploadsFilePeer::checkDirs();
				$f = fopen($path, 'w');
				fclose($f);
				@ chmod($path, 0777);
			}else {
				$f = fopen($path, 'w');
				fclose($f);
			}
		}
	}

	private function __construct() {

	}

	public function initialize($onlySession = false) {
		$culture = sfConfig::get('app_thaira_uploads_default_culture');

		// Get pending files
		$c = new Criteria();
		$c->add(ThairaUploadsFilePeer::IS_PENDING, true);
		$c->add(ThairaUploadsFilePeer::PENDING_UID, $this->uid);
		$c->addAscendingOrderByColumn(ThairaUploadsFilePeer::RANK);
		$this->files = ThairaUploadsFilePeer::doSelectWithI18n($c, $culture);

		if ($this->objectId && ! $onlySession) {
			// Get object files
			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, $this->objectClass);
			$c->add(ThairaUploadsFilePeer::OBJECT_ID, $this->objectId);
			$c->add(ThairaUploadsFilePeer::GROUP_NAME, $this->groupName);
			$c->addAscendingOrderByColumn(ThairaUploadsFilePeer::RANK);
			$files = ThairaUploadsFilePeer::doSelectWithI18n($c, $culture);

			$this->files = array_merge($this->files, $files);
			usort($this->files, array('ThairaUploadsFilePeer', 'compare'));
		}
	}

	public function save() {
		$user = sfContext::getInstance()->getUser();
		$info = array();

		$info['objectClass'] = $this->objectClass;
		$info['objectId'] = $this->objectId;
		$info['groupName'] = $this->groupName;
		$info['savePath'] = $this->savePath;
		$info['validation'] = $this->validation;
		$info['fields'] = $this->fields;
		$info['imageAutoScale'] = $this->imageAutoScale;
		$info['stripFilenames'] = $this->stripFilenames;
		$info['updatedAt'] = time();

		$user->setAttribute($this->uid, $info, 'ThairaUploadsSession');

		sfLogger::getInstance()->info('{ThairaUploadsSession} session saved '
				. "uid:$this->uid objectClass:$info[objectClass] "
				. "objectId:$info[objectId] groupName:$info[groupName]");
	}

	function doImageAutoScale($path) {
		if (! is_null($this->imageAutoScale)) {
			if (! is_array($this->imageAutoScale)) {
				throw new ThairaUploadsException('imageAutoScale parameter must be an array');
			}

			// Get image dimensions and check if is an image
			$imgDims = ThairaUploadsFilePeer::getImageSize($path, false);
			if (! $imgDims) {
				return;
			}

			$scale = false;
			$scaleWidth = 0;
			$scaleHeight = 0;

			$min = (isset($this->imageAutoScale['min']) ? $this->imageAutoScale['min'] : null);
			if ($min) {
				list($w, $h) = $this->parseDimension($min);
				if ($imgDims[0] < $w || $imgDims[1] < $h) {
					$scale = true;
					$scaleWidth = $w;
					$scaleHeight = $h;
				}
			}

			$max = (isset($this->imageAutoScale['max']) ? $this->imageAutoScale['max'] : null);
			if ($max && ! $scale) {
				list($w, $h) = $this->parseDimension($max);
				if ($imgDims[0] > $w || $imgDims[1] > $h) {
					$scale = true;
					$scaleWidth = $w;
					$scaleHeight = $h;
				}
			}

			if ($scale) {
				// Scale the file
				$thumb = new sfThumbnail($scaleWidth, $scaleHeight);
				$thumb->loadFile($path);
				$thumb->save($path);
			}
		}
	}

	function getFields() {
		return $this->fields;
	}

	public function getFiles() {
		return $this->files;
	}
	
	public function getFormFieldName() {
		$inflector = new sfInflector();
		$object = $inflector->underscore($this->objectClass);
		$groupName = $this->groupName;
		return "{$object}[{$groupName}]";
	}
	
	function getGroupName() {
		return $this->groupName;
	}

	function getObjectClass() {
		return $this->objectClass;
	}

	function getObjectId() {
		return $this->objectId;
	}

	function getSavePath() {
		return $this->savePath;
	}

	function getStripFilenames() {
		return $this->stripFilenames;
	}

	function getSystemSavePath() {
		if ($this->getSavePath()) {
			return sfConfig::get('app_thaira_uploads_upload_dir')
					. DIRECTORY_SEPARATOR . $this->getSavePath();
		} else {
			return sfConfig::get('app_thaira_uploads_upload_dir');
		}
	}
	
	public function getValidationFieldName() {
		$inflector = new sfInflector();
		$object = $inflector->underscore($this->objectClass);
		$groupName = $this->groupName;
		return "{$object}{{$groupName}}";
	}

	function getValidation() {
		return $this->validation;
	}

	public function hasField($field) {
		return in_array($field, $this->fields);
	}

	function filterFields($fields) {
		// If exist field 'tags' and tagsPlugin is not avilable remove
		// the field
		if (in_array('tags', $fields)
				&& ! ThairaUploadsTools::isTagsPluginAvailable()) {
			$fields = array_filter($fields,
					create_function('$v', 'return $v != "tags";'));
		}
		return $fields;
	}

	function setFields($fields) {
		$this->fields = $fields;
	}

	function setImageAutoScale($dimensions) {
		$this->imageAutoScale = $dimensions;
	}

	function setSavePath($value) {
		$this->savePath = $value;
	}

	function setStripFilenames($value) {
		$this->stripFilenames = $value;
	}

	function setValidation($value) {
		$this->validation = $value;

		// Initialize the messages
		if (isset($this->validation['dimensions'])
				&& ! isset($this->validation['dimensions_msg'])) {
			$this->validation['dimensions_msg'] = 'Invalid image dimensions';
		}
		if (isset($this->validation['min'])
				&& ! isset($this->validation['min_msg'])) {
			$this->validation['min_msg'] =
					sprintf('The minimum number of uploads is %d', $this->validation['min']);
		}
		if (isset($this->validation['max'])
				&& ! isset($this->validation['max_msg'])) {
			$this->validation['max_msg'] =
					sprintf('The maximum number of uploads is %d', $this->validation['max']);
		}
		if (isset($this->validation['max_size'])
				&& ! isset($this->validation['max_size_msg'])) {
			$this->validation['max_size_msg'] =
					sprintf('The maximum allowed size is %d', $this->validation['max_size']);
		}
		if (isset($this->validation['types'])
				&& ! isset($this->validation['types_msg'])) {
			$this->validation['types_msg'] = 'The uploaded file is an invalid type';
		}
	}

	function validateDimensions($path) {
		if (isset($this->validation['dimensions'])) {
			$dimensions = $this->validation['dimensions'];
			$size = ThairaUploadsFilePeer::getImageSize($path, false);
			if (! $size) {
				return;
			}
			list($width, $height) = $size;

			$min = (isset($dimensions['min']) ? $dimensions['min'] : null);
			if ($min) {
				list($w, $h) = $this->parseDimension($min);
				if ($width < $w || $height < $h) {
					throw new ThairaUploadsException($this->validation['dimensions_msg']);
				}
			}

			$max = (isset($dimensions['max']) ? $dimensions['max'] : null);
			if ($max) {
				list($w, $h) = $this->parseDimension($max);
				if ($width > $w || $height > $h) {
					throw new ThairaUploadsException($this->validation['dimensions_msg']);
				}
			}

			$aspect = (isset($dimensions['aspect']) ? $dimensions['aspect'] : null);
			if ($aspect) {
				list($w, $h) = $this->parseDimension($aspect);
				if ($width / $height != $w / $h) {
					throw new ThairaUploadsException($this->validation['dimensions_msg']);
				}
			}
		}
	}

	function validateMin() {
		if (isset($this->validation['min']) && count($this->files)
				< $this->validation['min']) {
			throw new ThairaUploadsException($this->validation['min_msg']);
		}
	}

	function validateMax() {
		if (isset($this->validation['max']) && count($this->files)
				> $this->validation['max']) {
			throw new ThairaUploadsException($this->validation['max_msg']);
		}
	}

	function validateSize($size) {
		if (isset($this->validation['max_size']) && $size > $this->validation['max_size']) {
			throw new ThairaUploadsException($this->validation['max_size_msg']);
		}
	}

	function validateType($filename) {
		if (isset($this->validation['types']) && ! ThairaUploadsFilePeer
				::isValidFilename($filename, $this->validation['types'])) {
			throw new ThairaUploadsException($this->validation['types_msg']);
		}
	}

	private function parseDimension($dimension) {
		$r = explode('x', strtolower($dimension));
		if ($r[0] == '*') {
			$r[0] = PHP_INT_MAX;
		}
		if ($r[1] == '*') {
			$r[1] = PHP_INT_MAX;
		}
		if (count($r) != 2 || ! is_numeric($r[0]) || ! is_numeric($r[1])) {
			throw new ThairaUploadsException("Invalid dimension param: $dimension");
		}
		return $r;
	}
}