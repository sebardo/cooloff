<?php

    $value = object_admin_double_list($inscription, 'getInscriptionServiceSchedule', array (
        'through_class' => 'InscriptionServiceSchedule',
        'peer_method'  => 'getServiceSchedulesByProfile',
    ),'myTools::_get_propel_object_list');

    echo $value ? $value : '&nbsp;';