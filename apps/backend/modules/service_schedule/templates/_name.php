<?php
	if ($service_schedule->getNameCa() != null) {
        echo $service_schedule->getNameCa();
    }
    else if ($service_schedule->getNameEs() != null) {
        echo $service_schedule->getNameES();
    }
    else if ($service_schedule->getNameIt() != null) {
        echo $service_schedule->getNameIt();
    }
    else if ($service_schedule->getNameFr() != null) {
        echo $service_schedule->getNameFr();
    }
    else {
        echo "";
    }
?>