<div id="confirmation-inscription" class="second-payment">
    <h2><?php echo __("registration.trans80") ?></h2>
    <p><?php echo __("registration.trans218") ?></p>

    <table>
        <thead>
            <tr>
                <th><?php echo __('registration.trans215') ?></th>
                <th><?php echo __('registration.trans220') ?></th>
                <th><?php echo __('registration.trans91') ?></th>
                <th><?php echo __('registration.trans221') ?></th>
                <th><?php echo __('registration.trans216') ?></th>
                <th><?php echo __('registration.trans217') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscriptions as $insc): ?>
                <tr>
                    <td><?php echo $insc->getInscriptionCode() ?></td>
                    <td><?php echo $insc->getFullStudentName() ?></td>
                    <td><?php echo $insc->getCourse()->getWeek() ?></td>
                    <td><?php echo $insc->getCourse()->getSummerFunCenter()->getCenterName() ?></td>
                    <td><?php echo $insc->getAmountFirstPayment() ?> €</td>
                    <td><?php echo $insc->getPendingAmount() ?> €</td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="total">
        <span><?php echo __("registration.trans219") ?>: <strong><?php echo $inscription->getPendingAmountFromAllInscriptions() ?> €</strong></span>
    </div>

    <form method="post" class="confirm-payment-form" action="<?php echo $urlTpv ?>" style="text-align: right; margin-top: 20px">
        <input type="hidden" name="Ds_Merchant_Amount" value="<?php echo $amountToPay ?>"/>
        <input type="hidden" name="Ds_Merchant_Currency" value="<?php echo $merchantCurrency ?>"/>
        <input type="hidden" name="Ds_Merchant_Order" value="<?php echo $inscription->getId() . '-' . $inscription->getTpvSuffix() ?>"/>
        <input type="hidden" name="Ds_Merchant_MerchantCode" value="<?php echo $merchantCode ?>">
        <input type="hidden" name="Ds_Merchant_Terminal" value="<?php echo $merchantTerminal ?>">
        <input type="hidden" name="Ds_Merchant_TransactionType" value="<?php echo $merchantTransactionType ?>">
        <input type="hidden" name="Ds_Merchant_MerchantURL" value="<?php echo $urlResponse ?>">
        <input type="hidden" name="Ds_Merchant_UrlOK" value="<?php echo url_for('@user_payment_notification?status=ok&payment=2&number=' . $inscription->getId() . '-' . $inscription->getTpvSuffix(), true) ?>">
        <input type="hidden" name="Ds_Merchant_UrlKO" value="<?php echo url_for('@user_payment_notification?status=ko&payment=2&number=' . $inscription->getId() . '-' . $inscription->getTpvSuffix(), true) ?>">
        <input type="hidden" name="Ds_Merchant_MerchantSignature" value="<?php echo $digest ?>">
        <input type="submit" value="<?php echo __('registration.trans210') ?>"/>
    </form>
</div>