<?php

if ($type == 'list') {
    echo $summer_fun_zone_center->getSummerFunZone();
} elseif ($type == 'filter') {
    if ($sf_user->hasCredential('admin')) {
        echo object_select_tag(isset($filters['summer_fun_zone_id']) ? $filters['summer_fun_zone_id'] : null, null, array (
            'include_blank' => true,
            'related_class' => 'SummerFunZone',
            'text_method' => '__toString',
            'control_name' => 'filters[summer_fun_zone_id]',
        ));
    } else {
        $zone = $sf_request->getAttribute('user_zone');
        echo $zone;
    }
}