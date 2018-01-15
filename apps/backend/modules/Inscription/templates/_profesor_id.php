<?php

if ($type == 'edit')
{
	echo select_tag('inscription[profesor_id]', objects_for_select(
			ProfesorPeer::doSelectOrderByNombreAndProfile(),
	  'getId',
	  '__toString',
			$inscription->getProfesorId()));
}