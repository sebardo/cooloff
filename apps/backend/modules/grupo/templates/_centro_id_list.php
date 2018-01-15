<?php
	if ($grupo->getCentroId() != null)
	{
        echo $grupo->getSummerFunCenter();

        /*
		$summer_fun_center = SummerFunCenterPeer::doSelectOneById($grupo->getCentroId());

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


