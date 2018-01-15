<?php
if ($type == 'edit') {
		
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('course[summer_fun_center_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$course->getSummerFunCenterId()));
	
	}else {
	
		$value = object_select_tag($course, 'getSummerFunCenterId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'course[summer_fun_center_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}
elseif ($type == 'filter') {
	echo select_tag('filters[summer_fun_center_id]',
			options_for_select(SummerFunCenterPeer::getArrayCenters(),
					isset($filters['summer_fun_center_id']) ? $filters['summer_fun_center_id'] : null,
					'include_blank=true')
	          );
}

