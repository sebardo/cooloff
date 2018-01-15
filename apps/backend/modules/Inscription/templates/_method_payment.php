<?php
if ($sf_params->get('action') == 'edit' || $sf_params->get('action') == 'create') {

	$paymentMethods = InscriptionPeer::getMethodPaymentNames();

	for ($i = 0; $i < count($paymentMethods); $i++) {
		$paymentMethods[$i] = __($paymentMethods[$i]);
	}

	echo select_tag('inscription[method_payment]', options_for_select($paymentMethods, $inscription->getMethodPayment()));
} else {
	echo __(InscriptionPeer::getMethodPaymentName($inscription->getMethodPayment()));
}
?>