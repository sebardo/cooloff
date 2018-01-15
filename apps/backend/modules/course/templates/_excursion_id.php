<?php 
if ($type == 'edit') {
		echo select_tag('course[excursion_id]', objects_for_select(
		ExcursionPeer::doSelectByUser(),
		  'getId',
		  '__toString',
		$course->getExcursionId()));
}

elseif ($type == 'filter') {

	echo select_tag('filters[excursion_id]',
		    	options_for_select(ExcursionPeer::getArrayExcursions(),
		    		isset($filters['excursion_id']) ? $filters['excursion_id'] : null,
		    		'include_blank=true'), array()
		    );
}