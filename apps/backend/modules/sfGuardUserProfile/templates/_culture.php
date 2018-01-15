<?php

use_helper('AdminCultures');

if ($type == 'edit') {
	echo select_tag('sf_guard_user_profile[culture]',
			options_for_select(
				get_translated_available_cultures_array(),
				$sf_guard_user_profile->getCulture()));
} elseif ($type = 'list') {
	switch ($sf_guard_user_profile->getCulture()) {
		case 'ca': echo image_tag("microsite/flags/ca.png", array("alt" => "Català", "width" => 16, "height" => 11)); break;
		case 'es': echo image_tag("microsite/flags/es.png", array("alt" => "Español", "width" => 16, "height" => 11)); break;
		case 'en': echo image_tag("microsite/flags/en.png", array("alt" => "English", "width" => 16, "height" => 11)); break;
		case 'eu': echo image_tag("microsite/flags/eu.png", array("alt" => "Euskera", "width" => 16, "height" => 11)); break;
		case 'it': echo image_tag("microsite/flags/it.png", array("alt" => "Italiano", "width" => 16, "height" => 11)); break;
	}
}