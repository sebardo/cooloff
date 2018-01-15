<?php 
	if ($excursion->getDescripcionCa() != null) {
   		echo $excursion->getDescripcionCa();
	}
	else if ($excursion->getDescripcionEs() != null) {
   		echo $excursion->getDescripcionEs();
	}
	else if ($excursion->getDescripcionIt() != null) {
		echo $excursion->getDescripcionIt();
	}  
	else {
		echo "";
	}
?>


