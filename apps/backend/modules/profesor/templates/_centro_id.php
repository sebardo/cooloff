<?php
if ($type == 'edit') 
{
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('profesor[centro_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$profesor->getCentroId()));
	}
	else 
	{
		$value = object_select_tag($profesor, 'getCentroId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'profesor[centro_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}

