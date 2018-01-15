<html>
    <head>
        <style>
            p {
                font-family: "Arial";
                font-size: 12px;;
            }

            ul {
                margin-left: 50px;
                list-style-type: disc;
            }
        </style>
    </head>
    <body>
        <?php if ($inscription->getMethodPayment() == InscriptionPeer::METHOD_PAYMENT_TPV): ?>
            <?php echo $center->getSecondPaymentMailingBody() ?>
            <div>
                <?php echo url_for('@tpv_second_payment?inscriptionId=' . $inscription->getId(), true) ?>
            </div>
        <?php else: ?>
            <?php echo $center->getSecondPaymentMailingBodyNoTpv() ?>
        <?php endif ?>

        <?php echo image_tag($sf_user->getCulture() . '/logo.png', array('absolute' => true, 'width' => '205px;')) ?>

        <?php if ($sf_user->getCulture() == 'ca' || $sf_user->getCulture() == 'es'): ?>
            <p><?php echo __('T. (+34) 902 93 40 23, ') ?></p>
            <a href="mailto:info@kidsandus.es">info@kidsandus.es</a>
        <?php endif ?>
    </body>
</html>