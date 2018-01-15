<?php

class ThairaUploadsI18nWrap {
	private $i18n = null;

	public function __construct() {
		$this->i18n = sfContext::getInstance()->getI18N();
	}

	public function __($string, $vars = null) {
		if ($this->i18n) {
			return $this->i18n->__($string, $vars, 'thaira_uploads_plugin');
		} else {
			return $string;
		}
	}
}