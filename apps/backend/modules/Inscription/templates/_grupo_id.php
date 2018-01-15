<?php

if ($type == 'edit')
{
	$course = CoursePeer::getCourseByInscrptionId($inscription->getId());
	echo select_tag('inscription[grupo_id]', objects_for_select(
			GrupoPeer::doSelectOrderByNombreAndProfileAndCenter(isset($course) ? $course->getSummerFunCenterId() : null),
	  'getId',
	  '__toString',
			$inscription->getGrupoId(), 'include_blank=true'));
}