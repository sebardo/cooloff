<?php

include_component('thairaUploads', 'selector', array(
    'object' => $summer_fun_center,
    'groupName' => 'docs',
    'savePath' => 'summer-fun/center/docs',
    'minRows' => 2,
    'stripFilenames' => true,
    'fields' => array(__('title'), 'is_protected', 'password'),
    'validation' => array(
        'types' => array('acrobat', 'word2003', 'word2007'),
        'types_msg' => 'Només es permeten documents',
        'max' => 15,
        'max_msg' => "No pot haver-hi més de 15 documents",
    )
));