<?php
	if ($profesor->getCentroId() != null)
	{
        echo $profesor->getSummerFunCenter();

        /*
		$summer_fun_center = SummerFunCenterPeer::doSelectOneById($profesor->getCentroId());

		if ($summer_fun_center->getTitleCa() != null) {
    		echo $summer_fun_center->getTitleCa();
		}
		else if ($summer_fun_center->getTitleEs() != null) {
    		echo $summer_fun_center->getTitleEs();
		}
		else {
    		echo $summer_fun_center->getTitleIt();
		}
        */
	}
?>


