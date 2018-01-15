<?php 
	if ($excursion->getNombreCa() != null) {
   		echo $excursion->getNombreCa();
	}
	else if ($excursion->getNombreEs() != null) {
   		echo $excursion->getNombreEs();
	}
	else if ($excursion->getNombreIt() != null) {
		echo $excursion->getNombreIt();
	}  
	else {
		echo "";
	}
?>


