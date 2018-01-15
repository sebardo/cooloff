<div id="confirmation-inscription" class="launch-payment">
    <p><?php echo image_tag("spin.gif", array('width' => 56)); ?></p>
    <p><?php echo __('registration.trans213') ?></p>
    <p><?php echo __('registration.trans214') ?></p>

    <form method="post" class="confirm-payment-form" action="<?php echo $urlTpv ?>" id="payment-form">
        <input type="hidden" name="Ds_Merchant_Amount" value="<?php echo $amountToPay ?>"/>
        <input type="hidden" name="Ds_Merchant_Currency" value="<?php echo $merchantCurrency ?>"/>
        <input type="hidden" name="Ds_Merchant_Order" value="<?php echo $inscription->getId() . '-' . $inscription->getTpvSuffix() ?>"/>
        <input type="hidden" name="Ds_Merchant_MerchantCode" value="<?php echo $merchantCode ?>">
        <input type="hidden" name="Ds_Merchant_Terminal" value="<?php echo $merchantTerminal ?>">
        <input type="hidden" name="Ds_Merchant_TransactionType" value="<?php echo $merchantTransactionType ?>">
        <input type="hidden" name="Ds_Merchant_MerchantURL" value="<?php echo $urlResponse ?>">
        <input type="hidden" name="Ds_Merchant_UrlOK" value="<?php echo url_for('@user_payment_notification?status=ok&payment=1&number=' . $inscription->getId() . '-' . $inscription->getTpvSuffix(), true) ?>">
        <input type="hidden" name="Ds_Merchant_UrlKO" value="<?php echo url_for('@user_payment_notification?status=ko&payment=1&number=' . $inscription->getId() . '-' . $inscription->getTpvSuffix(), true) ?>">
        <input type="hidden" name="Ds_Merchant_MerchantSignature" value="<?php echo $digest ?>">
    </form>
</div>

<script type="text/javascript">

    jQuery(function($) {
        timer = setInterval(function() { launchForm() }, 4000);
    });

    function launchForm()
    {
        clearInterval(timer);
        $('#payment-form').submit();
    }

</script>


