<?php
	if ($service->getNameCa() != null) {
        echo $service->getNameCa();
    }
    else if ($service->getNameEs() != null) {
        echo $service->getNameES();
    }
    else if ($service->getNameIt() != null) {
        echo $service->getNameIt();
    }
    else if ($service->getNameFr() != null) {
        echo $service->getNameFr();
    }
    else {
        echo "";
    }
?>