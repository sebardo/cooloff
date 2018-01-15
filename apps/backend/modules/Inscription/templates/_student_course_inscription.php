<?php

if ($type == 'edit')
{
	echo select_tag('inscription[student_course_inscription]', objects_for_select(
			CoursePeer::getCoursesByProfile(),
	  'getId',
	  '__toString',
			$inscription->getStudentCourseInscription()));
}
else {
	echo $inscription->getCourse();
}

