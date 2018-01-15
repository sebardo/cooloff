<?php

pake_desc('Envia recordatorio de pago para pagos fraccionados');
pake_task('send-reminder-second-payment');

function run_send_reminder_second_payment($task, $args)
{
    echo file_get_contents('http://inscriptions.kidscooloff.com/payment/tpv/reminder/9$03sPsD21zSdesP');
}