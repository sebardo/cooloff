<?php

    if ($summer_fun_center->getTitleCa() != null) {
        echo $summer_fun_center->getTitleCa();
    }
    elseif ($summer_fun_center->getTitleEs() != null) {
        echo $summer_fun_center->getTitleEs();
    }
    elseif ($summer_fun_center->getTitleIt()) {
        echo $summer_fun_center->getTitleIt();
    }
    else {
        echo $summer_fun_center->getTitleFr();
    }

?>


