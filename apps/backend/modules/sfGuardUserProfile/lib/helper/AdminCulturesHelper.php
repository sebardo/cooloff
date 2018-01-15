<?php
use_helper('I18N');

function get_culture_name($culture) {
	$cultures = sfConfig::get('app_available_cultures');
	return (isset($cultures[$culture]) ? $cultures[$culture] : null);
}

function get_translated_available_cultures_array() {
	$cultures = sfConfig::get('app_available_cultures');
	foreach ($cultures as $i => $v) {
		$cultures[$i] = __($cultures[$i]);
	}
	return $cultures;
}