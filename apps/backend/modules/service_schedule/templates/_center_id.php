<?php
if ($type == 'edit')
{
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('schedule[center_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()), 'getId', '__toString', $schedule->getCenterId()));
	}
	else
	{
		$value = object_select_tag($schedule, 'getCenterId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'schedule[center_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}
elseif ($type == 'list') {
    if ($schedule->getCenterId() != null) {
        echo $schedule->getSummerFunCenter();
    }
}
elseif ($type == 'filter') {
    echo select_tag('filters[center_id]', options_for_select(SummerFunCenterPeer::getArrayCentrosFiltro(), isset($filters['center_id']) ? $filters['center_id'] : null, 'include_blank=true'));
}

