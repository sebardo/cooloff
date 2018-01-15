<?php

use_helper('I18N', 'Form');

function permissions_check_list($name, $permissions, $allPermissions) {
	$html = array();
	
	$associatedIds = array();
	foreach ($permissions as $permission) {
		$associatedIds[] = $permission->getId();
	}
	
	$html[] = '<ul class="sf_admin_checklist">';
	foreach ($allPermissions as $permission) {
		$html[] = '<li>';
		$html[] = checkbox_tag(
				$name,
				$permission->getId(),
				in_array($permission->getId(), $associatedIds));
		$html[] = '<label for="'
				. get_id_from_name($name, $permission->getId()) . '">';
		$html[] = __($permission->getDescription());
		$html[] = '</label>';
		$html[] = '</li>';
	}
	$html[] = '</ul>';
	
	return implode("\n", $html);
}