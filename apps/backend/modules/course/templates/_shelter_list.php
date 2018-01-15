<?php

//echo $course->getSummerFunCenter();

if ($course->getScheduleCa()!=null){

    echo $course->getScheduleCa();

}else if ($course->getScheduleEs()!=null) {
    echo $course->getScheduleEs();

}else if ($course->getScheduleIt()!=null){

    echo   $course->getScheduleIt();

}

