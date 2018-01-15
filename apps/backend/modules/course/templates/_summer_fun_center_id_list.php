<?php

//echo $course->getSummerFunCenter();

if ($course->getSummerFunCenterId())
{
    $summer_fun_center=SummerFunCenterPeer::doSelectOneById($course->getSummerFunCenterId());

    if ($summer_fun_center)
    {
        if ($summer_fun_center->getTitleCa()) {
            echo $summer_fun_center->getTitleCa();
        }
        else if ($summer_fun_center->getTitleEs()) {
            echo $summer_fun_center->getTitleEs();
        }
        else {
            echo $summer_fun_center->getTitleIt();
        }
    }
}
?>


