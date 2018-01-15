<?php

/**
 * Subclass for representing a row from the 'thaira_uploads_file' table.
 *
 *
 *
 * @package plugins.thairaUploadsPlugin.lib.model
 */
class ThairaUploadsFile extends BaseThairaUploadsFile
{
	public function __call($name, $arguments) {
		return ThairaPropelTools::processI18nMethods($this, $name, $arguments);
	}

	public function delete($con = null) {
		// Delete the associated file
		$r = @unlink($this->getSystemPath());

		// Delete the thumbnails images
		if ($this->getId() !== null) {
			$thumbsPattern = sfConfig::get('app_thaira_uploads_thumbnails_dir');
			$thumbsPattern .= DIRECTORY_SEPARATOR . $this->getId() . '.*';
			foreach (glob($thumbsPattern) as $file) {
				@unlink($file);
				sfLogger::getInstance()->info('{thairaUploadsActions} deleted ' . $file);
			}
		}

		return parent::delete($con);
	}

	public function save($con = null) {
		// Ensure that have a extension assigned
		if (! $this->getExtension()) {
			$extension = ThairaMediaLibraryFilePeer::getFilenameExtension(
					$this->getFilename());
			$this->setExtension($extension);
		}

		// Ensure that have a rank assigned
		if (! $this->getRank()) {
			$c = new Criteria();
			$c->addDescendingOrderByColumn(ThairaUploadsFilePeer::RANK);
			$c->setLimit(1);
			$file = ThairaUploadsFilePeer::doSelectOne($c);
			if ($file) {
				$newRank = $file->getRank() + 1;
			} else {
				$newRank = 1;
			}
			$this->setRank($newRank);
			sfContext::getInstance()->getLogger()->info(
					"{ThairaUploadsFile} assigned new rank $newRank");
		}

		parent::save($con = null);
	}

	public function setFilename($v) {
		$this->setExtension(ThairaUploadsFilePeer::getFilenameExtension($v));
		parent::setFilename($v);
	}

	public function getDescription($nl2br = false) {
		$desc = parent::getDescription();
		if ($nl2br) {
			$desc = nl2br($desc);
		}
		return $desc;
	}

	public function getNext() {
		$c = new Criteria();
		$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, $this->getObjectClass());
		$c->add(ThairaUploadsFilePeer::OBJECT_ID, $this->getObjectId());
		$c->add(ThairaUploadsFilePeer::GROUP_NAME, $this->getGroupName());
		$c->add(ThairaUploadsFilePeer::RANK, $this->getRank(), Criteria::GREATER_THAN);
		$c->addAscendingOrderByColumn(ThairaUploadsFilePeer::RANK);
		$c->setLimit(1);
		return ThairaUploadsFilePeer::doSelectOne($c);
	}

	public function getPrev() {
		$c = new Criteria();
		$c->add(ThairaUploadsFilePeer::OBJECT_CLASS, $this->getObjectClass());
		$c->add(ThairaUploadsFilePeer::OBJECT_ID, $this->getObjectId());
		$c->add(ThairaUploadsFilePeer::GROUP_NAME, $this->getGroupName());
		$c->add(ThairaUploadsFilePeer::RANK, $this->getRank(), Criteria::LESS_THAN);
		$c->addDescendingOrderByColumn(ThairaUploadsFilePeer::RANK);
		$c->setLimit(1);
		return ThairaUploadsFilePeer::doSelectOne($c);
	}

	public function getWebPath() {
		$path = sfConfig::get('sf_relative_url_root')
				. sfConfig::get('app_thaira_uploads_upload_web_dir');
		if ($this->getPath()) {
			$path .=  '/' . $this->getPath();
		}
		$path .=  '/' . $this->getFilename();
		return $path;
	}

	public function getThumbWebPath($maxWidth = 48, $maxHeight = 48, $zoomEffect = false) {
		if (! $this->isImage()) {
			$type = $this->getType();
			$typesThumbs = sfConfig::get('app_thaira_uploads_types_thumbnails');
			if (isset($typesThumbs[$type])) {
				return sfConfig::get('sf_relative_url_root') . $typesThumbs[$type];
			} else {
				return sfConfig::get('sf_relative_url_root') . $typesThumbs['other'];
			}
		}

		if ($zoomEffect) {
			$subPath = '/' . $this->getId() . '.' . $maxWidth . '.' . $maxHeight
					. '.zoom.' . $this->getExtension();
		} else {
			$subPath = '/' . $this->getId() . '.' . $maxWidth . '.' . $maxHeight
					. '.' . $this->getExtension();
		}

		ThairaUploadsFilePeer::checkDirs();

		$systemPath = sfConfig::get('app_thaira_uploads_thumbnails_dir')
				. $subPath;

		$webPath = sfConfig::get('sf_relative_url_root')
				. sfConfig::get('app_thaira_uploads_thumbnails_web_dir')
				. $subPath;

		// Check if file exists
		if (! is_file($systemPath)) {
			// If no file to generate thumbnail returns the theorical
			// original file web path
			if (! is_file($this->getSystemPath())) {
				return $this->getWebPath();
			}

			// Generate the thumbnail
			if ($zoomEffect) {
				$thumb = new ThairaUploadsImage($this->getSystemPath());
				$thumb->generateZoomThumbnail($systemPath, $maxWidth, $maxHeight);
			} else {
				$thumb = new sfThumbnail($maxWidth, $maxHeight);
				$thumb->loadFile($this->getSystemPath());
				$thumb->save($systemPath);
			}

			if (! is_file($systemPath)) {
				return $this->getWebPath();
			} else {
				@chmod($systemPath, 0777);
			}
		}

		return $webPath;
	}

	public function getSystemPath() {
		if ($this->getIsPending()) {
			$path = $this->getPendingFilePath();
		} else {
			$path = sfConfig::get('app_thaira_uploads_upload_dir');
			if ($this->getPath()) {
				$path .= DIRECTORY_SEPARATOR . $this->getPath();
			}
			$path .= DIRECTORY_SEPARATOR . $this->getFilename();
		}
		return $path;
	}

	/**
	 * Select first type that this file pertains
	 * 
	 * @see ThairaUploadsFilePeer::getTypes
	 * @return string
	 */
	public function getType() {
		$types = $this->getTypes();
		$first = current($types);
		return $first;
	}

	public function getImageHeight() {
		return ThairaUploadsFilePeer::getImageHeight($this->getSystemPath());
	}

	public function getImageWidth() {
		return ThairaUploadsFilePeer::getImageWidth($this->getSystemPath());
	}

	public function getImageSize() {
		return ThairaUploadsFilePeer::getImageSize($this->getSystemPath());
	}

	/**
	 * Return all types that this file pertains
	 * 
	 * @return unknown_type
	 */
	public function getTypes() {
		$ext = $this->getExtension();
		return ThairaUploadsFilePeer::getTypes($ext);
	}

	public function isImage() {
		return ThairaUploadsFilePeer::isImageExtension($this->getExtension());
	}
}

if (ThairaUploadsTools::isTagsPluginAvailable()) {
	sfPropelBehavior::add('ThairaUploadsFile', array(
		'sfPropelActAsTaggableBehavior'
	));
}