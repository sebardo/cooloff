<?php
if ($type == 'edit') 
{
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('excursion[centro_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$excursion->getCentroId()));
	}
	else 
	{
		$value = object_select_tag($excursion, 'getCentroId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'excursion[centro_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}

