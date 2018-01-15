<div id="confirmation-inscription" <?php echo $status == 'ko' ? 'class="confirm-payment"' : '' ?>>
    <?php if ($status == 'ok'): ?>
        <?php if ($payment == 1): ?>
            <h2><?php echo __('registration.trans102') ?></h2>
            <p><?php echo __('registration.trans103') ?></p>
            <p><?php echo __("registration.trans207") ?></p>
            <p><?php echo __('registration.trans150') ?></p>
            <img src="/images/logo_pdf.jpg">
            <div id="final_line"></div>
            <a href="<?php echo url_for('@index_' .$sf_user->getCulture())?>" id="submit_step1"><?php echo __('registration.trans1') ?></a>
        <?php else: ?>
            <h2><?php echo __("registration.trans211") ?></h2>
            <p><?php echo __("registration.trans212") ?></p>
            <p><?php echo __('registration.trans150') ?></p>
            <img src="/images/logo_pdf.jpg">
            <div id="final_line"></div>
            <a href="<?php echo url_for('@index_' .$sf_user->getCulture())?>" id="submit_step1"><?php echo __('registration.trans1') ?></a>
        <?php endif ?>
    <?php else: ?>
        <h2><?php echo __('registration.trans208') ?></h2>
        <p><?php echo __("registration.trans209") ?></p>

        <form method="post" class="confirm-payment-form" action="<?php echo $urlTpv ?>">
            <input type="hidden" name="Ds_Merchant_Amount" value="<?php echo $amountToPay ?>"/>
            <input type="hidden" name="Ds_Merchant_Currency" value="<?php echo $merchantCurrency ?>"/>
            <input type="hidden" name="Ds_Merchant_Order" value="<?php echo $inscription->getId() . $inscription->getTpvSuffix() ?>"/>
            <input type="hidden" name="Ds_Merchant_MerchantCode" value="<?php echo $merchantCode ?>">
            <input type="hidden" name="Ds_Merchant_Terminal" value="<?php echo $merchantTerminal ?>">
            <input type="hidden" name="Ds_Merchant_TransactionType" value="<?php echo $merchantTransactionType ?>">
            <input type="hidden" name="Ds_Merchant_MerchantURL" value="<?php echo $urlResponse ?>">
            <input type="hidden" name="Ds_Merchant_UrlOK" value="<?php echo url_for('@user_payment_notification?status=ok&payment=' . $payment . '&number=' . $inscription->getId() . $inscription->getTpvSuffix(), true) ?>">
            <input type="hidden" name="Ds_Merchant_UrlKO" value="<?php echo url_for('@user_payment_notification?status=ko&payment=' . $payment . '&number=' . $inscription->getId() . $inscription->getTpvSuffix(), true) ?>">
            <input type="hidden" name="Ds_Merchant_MerchantSignature" value="<?php echo $digest ?>">
            <input type="submit" value="<?php echo __('registration.trans210') ?>"/>
        </form>
    <?php endif ?>
</div>

