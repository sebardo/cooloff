<?php

class ThairaUploadsTools {
	public static function getLangsOptionsForSelect() {
		$options = array();
		$cultures = sfConfig::get('app_thaira_uploads_cultures');
		foreach ($cultures as $culture) {
			$info = new sfCultureInfo($culture);
			$options[$culture] = ucfirst($info->getNativeName());
		}
		return $options;
	}

	public static function isTagsPluginAvailable() {
		return class_exists('sfPropelActAsTaggableBehavior');
	}

	public static function newJsTemplate($content) {
		$content = str_replace(
			array("\r", "\n", "'"),
			array('\r', '\n', "\\'"),
			$content
		);
		return "new Template('$content')";
	}

	public static function __($string, $vars = null) {
		static $i18n;

		if (! $i18n) {
			$i18n = new ThairaUploadsI18nWrap();
		}

		return $i18n->__($string, $vars);
	}
	
	public static function mkdir($path, $mode) {
		// Calc the inexistent paths
		$paths = array();
		$tempPath = $path;
		while (! is_dir($tempPath)) {
			array_push($paths, $tempPath);
			$tempPath = dirname($tempPath);
		}
		
		// Create dirs recursively
		while (! empty($paths)) {
			$tempPath = array_pop($paths);
			$r = @ mkdir($tempPath);
			if (! $r) {
				return false;
			}
			@ chmod($tempPath, $mode);
		}
		return true;
	}
}