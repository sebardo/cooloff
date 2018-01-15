<?php

    $range = range(2013, date('Y') - 1);
    $years = array();
    $years[0] = __('No');

    foreach ($range as $year)
    {
        $years[$year] = $year;
    }

    echo select_tag('inscription[last_cooloff_year]', options_for_select($years, $inscription->getLastCooloffYear()));