<?php
if ($sf_params->get('action') == 'edit' || $sf_params->get('action') == 'create' || $sf_params->get('action') == 'filter')
{
	$items = InscriptionPeer::getStatesNames();

	for ($i = 0; $i < count($items); $i++) {
		$items[$i] = __($items[$i]);
	}
	echo select_tag('inscription[state]', options_for_select($items, $inscription->getState()));
} else {
	echo __(InscriptionPeer::getStateName($inscription->getState()));
}
?>