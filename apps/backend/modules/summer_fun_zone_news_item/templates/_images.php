<?php

include_component('thairaUploads', 'selector', array(
    'object' => $summer_fun_center_news_item,
    'groupName' => 'images',
    'savePath' => 'summer-fun/center-news/images',
    'minRows' => 2,
    'fields' => array('title'),
    'stripFilenames' => true,
    'imageAutoScale' => array(
        'max' => '800x600'
    ),
    'validation' => array(
        'types' => array('image'),
        'types_msg' => 'Només es permeten imatges',
    	'max' => 10,
        'max_msg' => "No pot haver-hi més de 10 imatges",
    )
));