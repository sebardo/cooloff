<?php

use_helper('ImageCulture');

function link_to_i18n($name = '', $internal_uri = '', $options = array()) {
	if (strlen($internal_uri) > 0 && $internal_uri[0] == '@') {
		// Extract route name and query string
		$culture = sfContext::getInstance()->getUser()->getCulture();
		$queryString = '';
		$routeName = $internal_uri;

		$pos = strpos($internal_uri, '?');
		if ($pos > 0) {
			$routeName = substr($internal_uri, 0, $pos);
			$queryString = substr($internal_uri, $pos);
		}

		// Overwrite internal uri with i18n name
		$internal_uri = $routeName . '_' . $culture . $queryString;
	}

	// Call normal function
	return link_to($name, $internal_uri, $options);
}

function currentUrl($cultureSel, $arrayCulture)
{
	/*
	 * Si la ruta �s homepage (no t� cap _idioma) li concatenem sense tallar la cadena.
	 *
	 * Si la ruta actual t� par�metres la partir� en dos a partir de '?'
	 * eliminar� la cultura que tingui i li posar� la que li hem passat.
	 *
	 * Si la ruta actual no t� par�metres eliminar� la cultura que tingui i posar� la que volem
	 */
	$routeRequired = sfRouting::getInstance()->getCurrentInternalUri(true);

	if($routeRequired != "@homepage"){

		$parametres = stripos($routeRequired, '?');

		if($parametres > 0){
			$tok = explode("?", $routeRequired);
			$routeRequired = substr($tok[0], 0, strlen($tok[0])-2) . $cultureSel . "?" . $tok[1];
		}else $routeRequired = substr($routeRequired, 0, strlen($routeRequired)-2) . $cultureSel;

	}else $routeRequired = $routeRequired . "_" . $cultureSel;

	return $routeRequired;
}

function image_link($source, $internal_uri = '', $image_options = array(), $link_options = array())
{
    $image_options = _parse_attributes($image_options);
    $link_options = _parse_attributes($link_options);

    $alt = (isset($image_options['alt']) ? $image_options['alt'] : null);
    if ($alt) {
        $link_options['title'] = $alt;
    }

    $image_i18n = (isset($image_options['i18n']) ? $image_options['i18n'] : false);
    if ($image_i18n) {
        $img = image_culture_tag($source, $image_options);
    } else {
        $img = image_tag($source, $image_options);
    }

    $link_i18n = (isset($link_options['i18n']) ? $link_options['i18n'] : true);
    if ($link_i18n) {
        return link_to_i18n($img, $internal_uri, $link_options);
    } else {
        return link_to($img, $internal_uri, $link_options);
    }
}