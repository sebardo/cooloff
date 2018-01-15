<?php
if ($type == 'edit') 
{
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('week[centro_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$week->getCentroId()));
	}
	else 
	{
		$value = object_select_tag($week, 'getCentroId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'week[centro_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}

