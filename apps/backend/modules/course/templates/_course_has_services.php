<?php

    $value = object_admin_double_list($course, 'getCourseHasServices', array (
        'through_class' => 'CourseHasServices',
        'peer_method'  => 'getServicesByProfile',
        ),'myTools::_get_propel_object_list');

    echo $value ? $value : '&nbsp;';