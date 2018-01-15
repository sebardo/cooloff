<?php
	if ($week->getCentroId() != null)
	{
		$summer_fun_center = SummerFunCenterPeer::doSelectOneById($week->getCentroId());

        if ($summer_fun_center) {
            if ($summer_fun_center->getTitleCa() != null) {
                echo $summer_fun_center->getTitleCa();
            }
            else if ($summer_fun_center->getTitleEs() != null) {
                echo $summer_fun_center->getTitleEs();
            }
            else {
                echo $summer_fun_center->getTitleIt();
            }
        }
	}
?>


