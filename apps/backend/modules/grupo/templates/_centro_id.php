<?php
if ($type == 'edit') 
{
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('grupo[centro_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$grupo->getCentroId()));
	}
	else 
	{
		$value = object_select_tag($grupo, 'getCentroId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'grupo[centro_id]',
		)); echo $value ? $value : '&nbsp;';		
	}
}

