<?php

class ThairaProjectTools {
    public static function createStrippedName($string) {
        // Translate chars with accents
        $string = strtr($string, array(
            'à' => 'a', 'á' => 'a', 'è' => 'e', 'é' => 'e',
            'í' => 'i', 'ò' => 'o', 'ó' => 'o', 'ú' => 'u',
            'À' => 'a', 'Á' => 'a', 'È' => 'e', 'É' => 'e',
            'Í' => 'i', 'Ò' => 'o', 'Ó' => 'o', 'Ú' => 'u','ñ' => 'n','Ñ' => 'n'
        ));

        $string = preg_replace('/[^\w]/i', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        $string = preg_replace('/^-*/', '', $string);
        $string = preg_replace('/-*$/', '', $string);

        $string = strtolower($string);

        return $string;
    }

    /**
     * Do a basic transformation of an associative array to JSON string.
     * Currently supported types are: boolean, strings, numbers and arrays.
     *
     * @param array An associative array
     * @return string JSON
     */
    public static function toJson($array) {
    	$numericOnly = true;

    	$arrayItems = array();
    	$objectItems = array();

		foreach ($array as $k => $v) {
			if ($numericOnly && ! is_numeric($k)) {
				$numericOnly = false;
			}

			if (is_null($v)) {
				$v = 'null';
			} elseif (is_array($v) || is_object($v)) {
				$v = self::toJson($v);
			} elseif (is_bool($v)) {
				$v = $v ? 'true' : 'false';
			} elseif (is_numeric($v)) {
				// do nothing
			} elseif (is_string($v)) {
				$v = '"' . str_replace(array("\n", "\r"), '\\n', addslashes($v))  . '"';
			}
			$arrayItems[] = $v;
			$objectItems[$k] = "\"$k\":$v";
		}

		if ($numericOnly) {
			return '([' . implode(',', $arrayItems) . '])';
		} else {
			return '({' . implode(',', $objectItems) . '})';
		}
	}
}