<?php

/**
 * tpv actions.
 *
 * @package    kids
 * @subpackage tpv
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tpvActions extends sfActions
{
    /**
     * @param $paymentNumber Número de pago (1 o 2)
     * @throws sfError404Exception
     */
    private function preTpvPayment($paymentNumber, $inscriptionId = null)
    {
        if (!$inscriptionId) {
            $inscriptionId = $this->getRequestParameter('inscriptionId');
        }
        $inscription = InscriptionPeer::retrieveByPK($inscriptionId);
        $this->forward404Unless($inscription);

        if ($inscription->getMethodPayment() != InscriptionPeer::METHOD_PAYMENT_TPV) {
            $this->forward404('El método de pago no es TPV');
        }

        if ($paymentNumber == 1 && $inscription->getIsPaid() != InscriptionPeer::IS_PAID_TPV) {
            $this->forward404('Error: Primer pago con estado pagado');
        }

        if ($paymentNumber == 2 && $inscription->getIsPaid() == InscriptionPeer::IS_PAID_TPV) {
            $this->forward404('Error: Segundo pago sin primer pago confirmado');
        }

        $amount = $inscription->getPendingAmountFromAllInscriptions();
        if ($amount == 0) {
            $this->forward404('Error: No hay importe pendiente de pago');
        }

        if ($paymentNumber == 1 && $inscription->getSplitPayment()) {
            $amount = $amount / 2;
        }

        $this->amountToPay = number_format(round($amount, 2), 2);
        $this->amountToPay = str_replace('.', '', $this->amountToPay);
        $this->amountToPay = str_replace(',', '', $this->amountToPay);

        if ($inscription->getTpvSuffix()) {
            $inscription->setTpvSuffix($inscription->getTpvSuffix() + 1);
        }
        else {
            $inscription->setTpvSuffix(1);
        }

        $inscription->save();

        $this->merchantTransactionType = 0;
        $this->merchantCurrency = 978;
        $this->merchantTerminal = 1;
        $this->merchantCode = $inscription->getCourse()->getSummerFunCenter()->getMerchantCode();
        $this->merchantKey = $inscription->getCourse()->getSummerFunCenter()->getMerchantKey();
        $this->urlTpv = $inscription->getCourse()->getSummerFunCenter()->getUrlTpv();

        $this->urlResponse = $this->getController()->genUrl('@tpv_payment_notification?payment=' . $paymentNumber . '&number=' . $inscription->getId() . '-' . $inscription->getTpvSuffix(), true);
        $this->digest = sha1($this->amountToPay . $inscription->getId() . '-' . $inscription->getTpvSuffix() . $this->merchantCode . $this->merchantCurrency . $this->merchantTransactionType . $this->urlResponse . $this->merchantKey);
        $this->inscription = $inscription;
    }

    /**
     * Acción ejecutada trás finalizar la inscripción si se ha elegido como forma de pago TPV.
     * Se prepara el formulario que se enviará a la pasarela de pago y se le informa al usuario que se va a proceder al pago.
     * 
     * @throws sfError404Exception
     */

    public function executeLaunchPayment()
    {
        $this->preTpvPayment(1);
    }

    /**
     * Url callback para informar de la transacción al usuario
     * @throws sfError404Exception
     */

    public function executePaymentNotificationUser()
    {
        $inscription = InscriptionPeer::findByIdAndTpvSuffix($this->getRequestParameter('number'));

        if (!$inscription) {
            $this->forward404();
        }

        $this->status = $this->getRequestParameter('status');
        $this->payment = intval($this->getRequestParameter('payment'));

        if ($this->status == 'ko') {
            $this->preTpvPayment($this->payment, $inscription['id']);
        }
    }

    /**
     * Acción ejecutada por el TPV para confirmar o rechazar la transacción
     * @return string
     */

    public function executePaymentNotificationTpv()
    {
        //error_log('Recibiendo notificacion TPV ' . date('d/m/Y H:i:s'));
        //error_log(print_r($_POST, 1));

        $responseCodesOK = array("000", "001", "002", "099", "0000", "0001", "0002", "0099");
        $number = $this->getRequestParameter('number');
        $payment = $this->getRequestParameter('payment'); // 1 o 2 en función de si es el primer o el segundo pago.

        // error_log("POST params: " . print_r($_POST, 1));

        if ($number == $this->getRequestParameter('Ds_Order'))
        {
            $inscription = InscriptionPeer::findByIdAndTpvSuffix($number);
            if ($inscription)
            {
                // Get full object
                $inscription = InscriptionPeer::retrieveByPK($inscription['id']);

                $merchantCurrency = 978;
                $merchantCode = $inscription->getCourse()->getSummerFunCenter()->getMerchantCode();
                $merchantKey = $inscription->getCourse()->getSummerFunCenter()->getMerchantKey();

                $amount = $inscription->getPendingAmountFromAllInscriptions();

                if ($payment == 1 && $inscription->getSplitPayment()) {
                    $amount = $amount / 2;
                }

                $amount = number_format(round($amount, 2), 2);
                $amount = str_replace('.', '', $amount);
                $amount = str_replace(',', '', $amount);

                $signature = strtoupper(sha1($amount . $inscription->getId() . '-' . $inscription->getTpvSuffix() . $merchantCode . $merchantCurrency . $this->getRequestParameter('Ds_Response') . $merchantKey));

                if ($signature == $this->getRequestParameter('Ds_Signature'))
                {
                    if (in_array($this->getRequestParameter('Ds_Response'), $responseCodesOK)) {
                        $result = 'OK';
                    }
                    else {
                        $result = 'KO. Response KO: ' . $this->getRequestParameter('Ds_Response');
                    }
                }
                else {
                    $result = 'KO. Signature does not match';
                }

                $inscriptions = InscriptionPeer::retrieveByInscriptionNum($inscription->getInscriptionNum());
                $inscriptionsPdf = array();
                $emailsToSendPdf = array();
                $contInscription = 0;
                $contWeek = 1;
                $inscriptionCode = null;
                foreach ($inscriptions as $i)
                {
                    if ($payment == 1) {
                        // First payment
                        if ($result == 'OK') {

                            if (!isset($inscriptionCode) || $i->getInscriptionCode() != $inscriptionCode) {
                                $contInscription++;
                                $contWeek = 1;
                            }
                            else {
                                $contWeek++;
                            }

                            $inscriptionCode = $i->getInscriptionCode();

                            $inscriptionsPdf[$contInscription][$contWeek] = $i->getId();
                            if (!count($emailsToSendPdf)) {
                                if ($i->getIsFatherMailMain() && $i->getFatherMail()) {
                                    $emailsToSendPdf[1][1] = $i->getFatherMail();
                                }
                                if ($i->getIsMotherMailMain() && $i->getMotherMail()) {
                                    $emailsToSendPdf[1][2] = $i->getFatherMail();
                                }
                            }
                            $amount = $i->getPendingAmount();
                            if ($i->getSplitPayment()) {
                                $amount = $amount / 2;
                                $i->setIsPaid(1); // Pago 50%
                            }
                            else {
                                $i->setIsPaid(2); // Pago 100%
                            }
                            $i->setAmountFirstPayment($amount);
                        }

                        $i->setTpvFirstPaymentResponse($result);
                    }
                    else {
                        // Second payment
                        if ($result == 'OK') {
                            $i->setAmountSecondPayment($i->getPendingAmount());
                            $i->setIsPaid(2); // Marcamos como 100% pagado
                        }
                        $i->setTpvSecondPaymentResponse($result);
                    }

                    $i->save();
                }

                if (count($inscriptionsPdf) && count($emailsToSendPdf)) {
                    list($pdfGenerated, $idCentre) = util::generarPdf($inscriptionsPdf);
                    util::enviarPdf($pdfGenerated, $emailsToSendPdf, $idCentre);
                }
            }
            else {
                $result = 'KO. No inscription (id + TPV suffix) found: ' . $this->getRequestParameter('Ds_Order');
            }
        }
        else {
            $result = 'KO. Ds_Order does not match. Parameter: ' . $number . ' . Request: ' . $this->getRequestParameter('Ds_Order');
        }

        error_log('Resultado de la notificación: ' . $result);

        return sfView::NONE;
    }

    /**
     * Muestra la pantalla resumen del segundo pago
     */

    public function executeSecondPayment()
    {
        $this->preTpvPayment(2);

        $this->inscriptions = InscriptionPeer::retrieveByInscriptionNum($this->inscription->getInscriptionNum());
    }

    /**
     * Acción mailing para recordatorio del segundo pago
     */

    public function executeSecondPaymentTpvMailing()
    {
        if ($this->getRequestParameter('pass') != sfConfig::get('app_cron_key')) {
            $this->forward404();
        }

        $logFile = sfConfig::get('sf_log_dir') . DIRECTORY_SEPARATOR . 'TPV_MAILING_REMINDER.log';
        $log = fopen($logFile, "a");
        if (!$log) {
            throw new Exception("Unable to create log file");
        }
        fwrite($log, "######################################################\r\n");
        fwrite($log, "Inicio envio recordatorios segundo pago TPV " . date('d/m/Y') ."\r\n");


        $culture = $this->getUser()->getCulture();
        $inscriptions = InscriptionPeer::retrieveForSecondPaymentMailing();
        $processedInscriptions = array();

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = sfConfig::get('app_email_host');
        $mail->Port = sfConfig::get('app_email_port');
        $mail->Username = sfConfig::get('app_email_user');
        $mail->Password = sfConfig::get('app_email_password');
        $mail->FromName = 'Kids&Us';
        $mail->Subject = sfContext::getInstance()->getI18N()->__('Recordatorio segundo pago');
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50;
        $mail->IsHTML(true);

        sfLoader::loadHelpers('Partial');


        /** @var Inscription $inscription */
        foreach ($inscriptions as $inscription)
        {
            $course = CoursePeer::retrieveByPKWithI18n($inscription->getStudentCourseInscription());
            if ($course->getSummerFunCenter()->getSecondPaymentMailingDate() && $course->getSummerFunCenter()->getSecondPaymentMailingDate() != date('Y-m-d')) {
                continue;
            }

            if (!in_array($inscription->getInscriptionNum(), $processedInscriptions) &&
                $inscription->getPendingAmount() > 0 &&
                $inscription->getIsPaid() == 1 &&
                !$inscription->getIsPaymentReminderSent())
            {
                $this->getUser()->setCulture($inscription->getCulture() ? $inscription->getCulture() : 'ca');

                //$course = CoursePeer::retrieveByPKWithI18n($inscription->getStudentCourseInscription());
                if (!$course->getCulture()) {
                    $course->setCulture($this->getUser()->getCulture());
                }

                $mail->From = $course->getSummerFunCenter()->getMail() ? $course->getSummerFunCenter()->getMail() : 'info@kidsandus.es';
                $mail->AddReplyTo($mail->From, 'Kids&Us');

                $mail->Body = get_partial('tpv/second_payment_reminder_email', array('inscription' => $inscription, 'center' => $course->getSummerFunCenter()));
                $mail->AltBody = $mail->Body;

                $mail->ClearAddresses();

                if ($inscription->getFatherMail()) {
                    $mail->AddAddress($inscription->getFatherMail());
                }

                if ($inscription->getIsMotherMailMain() && $inscription->getMotherMail()) {
                    $mail->AddAddress($inscription->getMotherMail());
                }

                if ($mail->Send()) {
                    $inscription->setIsPaymentReminderSent(1);
                    $inscription->save();
                    fwrite($log, "Envio a {$inscription->getFatherMail()}. Inscripción número: {$inscription->getInscriptionCode()}\r\n");
                }

                array_push($processedInscriptions, $inscription->getInscriptionNum());
            }
        }

        fwrite($log, "Fin envios " . date('d/m/Y') ."\r\n");
        fwrite($log, "######################################################\r\n");

        $this->getUser()->setCulture($culture);

        return sfView::NONE;
    }

    /**
     * Acción mailing para recordatorio del segundo pago
     */

    public function executeAdjustSecondPayment()
    {
        if ($this->getRequestParameter('pass') != sfConfig::get('app_cron_key')) {
            $this->forward404();
        }

        $ids = array(385, 391, 414, 418, 426, 466, 486, 522, 525, 551, 597, 618, 645, 660, 667, 717, 724, 782, 796, 817, 894);

        foreach ($ids as $id)
        {
            $inscription = InscriptionPeer::retrieveByPK($id);
            if ($inscription) {
                $inscriptions = InscriptionPeer::retrieveByInscriptionNum($inscription->getInscriptionNum());
                foreach ($inscriptions as $inscription)
                {
                    $inscription->setTpvSecondPaymentResponse('OK. Ajuste manual');
                    $inscription->setAmountSecondPayment($inscription->getPendingAmount());
                    $inscription->setIsPaid(2); // Marcamos como 100% pagado

                    $inscription->save();
                }
            }
        }

        return sfView::NONE;
    }
}
