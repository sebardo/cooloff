<?php

    $values = array();
    $values[1] = 1;
    $values[2] = 2;
    $values[3] = 3;
    $values[4] = 4;
    $values[5] = 5;
    $values[6] = 6;
    $values[7] = 7;
    $values[8] = 8;
    $values[9] = 9;
    $values[10] = 10;

echo select_tag('service_schedule[orden]', options_for_select($values, $service_schedule->getOrden()));