<?php
if ($sf_params->get('action') == 'edit' || $sf_params->get('action') == 'create') {

	$items = InscriptionPeer::getIsPaidNames();

	for ($i = 0; $i < count($items); $i++) {
		$items[$i] = __($items[$i]);
	}

	echo select_tag('inscription[is_paid]', options_for_select($items, $inscription->getIsPaid()));
} else {
	echo __(InscriptionPeer::getIsPaidName($inscription->getIsPaid()));
}
?>