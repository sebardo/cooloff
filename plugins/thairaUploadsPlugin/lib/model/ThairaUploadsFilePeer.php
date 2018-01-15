<?php

/**
 * Subclass for performing query and update operations on the 'thaira_uploads_file' table.
 *
 * 
 *
 * @package plugins.thairaUploadsPlugin.lib.model
 */ 
class ThairaUploadsFilePeer extends BaseThairaUploadsFilePeer
{
	public static function compare($a, $b) {
		if ($a->getRank() < $b->getRank()) {
			return -1;
		} elseif ($a->getRank() > $b->getRank()) {
			return 1;
		} else {
			return 0;
		}
	}

	public static function checkDirs() {
		if (! is_dir(sfConfig::get('app_thaira_uploads_thumbnails_dir'))) {
			$r = ThairaUploadsTools::mkdir(sfConfig::get('app_thaira_uploads_thumbnails_dir'), 0777);
			if (! $r) {
				throw new ThairaUploadsException(sprintf('Directory "%s" is not writable',
						sfConfig::get('app_thaira_uploads_thumbnails_dir')));
			}
		}
		if (! is_dir(sfConfig::get('app_thaira_uploads_pending_dir'))) {
			$r = ThairaUploadsTools::mkdir(sfConfig::get('app_thaira_uploads_pending_dir'), 0777);
			if (! $r) {
				throw new ThairaUploadsException(sprintf('Directory "%s" is not writable',
						sfConfig::get('app_thaira_uploads_pending_dir')));
			}
		}
	}

    public static function getFilenameExtension($filename) {
        $pos = strrpos($filename, '.');
        if ($pos !== false) {
            return strtolower(substr($filename, $pos + 1));
        } else {
            return '';
        }
    }

	/**
	 * @deprecated This code must be refactored to use ThairaUploadsImage 
	 */
    public static function getImageData($path, $checkExtension = true) {
    	// Check for getimagesize function
    	if (! function_exists('getimagesize')) {
    		throw new ThairaUploadsException('GD extension is not installed');
    	}
    	
    	// Is image?
    	if ($checkExtension) {
	    	$filename = basename($path);
	    	$ext = self::getFilenameExtension($filename);
	    	if (! self::isImageExtension($ext)) {
	    		return null;
	    	}
    	}
    	
    	return @ getimagesize($path);
    }

	/**
	 * @deprecated This code must be refactored to use ThairaUploadsImage 
	 */
    public static function getImageHeight($path, $checkExtension = true) {
    	$imgData = self::getImageData($path, $checkExtension);
    	if (! $imgData) {
    		return null;
    	} else {
    		return $imgData[1];
    	}
    }

	/**
	 * @deprecated This code must be refactored to use ThairaUploadsImage 
	 */
    public static function getImageWidth($path, $checkExtension = true) {
    	$imgData = self::getImageData($path, $checkExtension);
    	if (! $imgData) {
    		return null;
    	} else {
    		return $imgData[0];
    	}
    }

	/**
	 * @deprecated This code must be refactored to use ThairaUploadsImage 
	 */
	public static function getImageSize($path, $checkExtension = true) {
    	$imgData = self::getImageData($path, $checkExtension);
    	if (! $imgData) {
    		return null;
    	} else {
    		return array($imgData[0], $imgData[1]);
    	}
    }

    public static function getTypes($ext) {
        $typeExts = sfConfig::get('app_thaira_uploads_types_extensions');
        $types = array();
        foreach ($typeExts as $type => $exts) {
            if (in_array(strtolower($ext), $exts)) {
                $types[] = $type;
            }
        }
        $types[] = 'other';
        return $types;
    }

    public static function isImageExtension($ext) {
        $types = self::getTypes($ext);
    	return in_array('image', $types);
    }

    public static function isValidFilename($filename, $types = null) {
        return self::isValidExtension(self::getFilenameExtension($filename), $types);
    }

    public static function isValidExtension($ext, $types = null) {
    	if ($types) {
    		foreach (self::getTypes($ext) as $type) {
    			if (in_array($type, $types)) {
    				return true;
    			}
    		}
    		return false;
    	} else {
    		return self::getType($ext) != 'other';
    	}
    }
}
