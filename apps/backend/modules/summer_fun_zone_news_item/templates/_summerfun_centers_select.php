<?php
if ($type == 'edit') {
		
	if (!$sf_user->hasCredential('administrador')) {
		echo select_tag('summer_fun_center_news_item[summer_fun_center_id]', objects_for_select(
		SummerFunCenterPeer::getCentersByProfile($sf_user->getProfile()->getId()),
		  'getId',
		  '__toString',
		$summer_fun_center_news_item->getSummerFunCenterId()));
	
	}else {
	
		$value = object_select_tag($summer_fun_center_news_item, 'getSummerFunCenterId', array (
	  		'related_class' => 'SummerFunCenter',
	  		'control_name' => 'summer_fun_center_news_item[summer_fun_center_id]',
		)); echo $value ? $value : '&nbsp;';
	}
}