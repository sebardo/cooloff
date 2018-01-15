<?php

class ThairaPropelTools {
    /**
     * For process i18n methods with auto setting of language. Ie. for process
     * a call to the getTitle() of the i18n related object just call getTitleEn()
     * and the English language will be setted as current language and returned
     * the corresponding result of getTitle()
     *
     * @param string Object class name
     * @param string Method name
     * @param array $args
     * @return mixed
     */
    public static function processI18nMethods($obj, $name, $args) {
        $class = get_class($obj);
        $callable = sfMixer::getCallable("Base$class:$name");
        if (! $callable) {
            if (strpos($name, 'get') === 0 || strpos($name, 'set') === 0) {
                // Get the language code (2 last chars)
                $culture = strtolower(substr($name, -2));
                $function = substr($name, 0, -2);

                // Assert function exist
	            if (!method_exists($obj, $function)) {
	            	throw new Exception("Method $name not exist in class $class");
	            }

	            $obj->setCulture($culture);
                return call_user_func_array(array($obj, $function), $args);
            } else {
                throw new sfException(sprintf(
                        'Call to undefined method Base%s::%s', $class, $name));
            }
        } else {
            array_unshift($args, $obj);
            return call_user_func_array($callable, $args);
        }
    }

    public static function splitWords($string, $likePattern = false) {
    	// Trim spaces
    	$string = trim($string);

    	// Convert multiple spaces
    	if ($likePattern) {
    		// Escape the % signs (\\\\ = \: php + sql strings escaping)
    		$string = str_replace('%', '\\\\%', $string);
    		// Wrap words with pattern
    		$string = '%' . preg_replace('/\\s+/', '% %', $string) . '%';
    	} else {
	    	$string = preg_replace('/\\s+/', ' ', $string);
    	}

    	// Split the words
    	return explode(' ', trim($string));
    }

    public static function newObject($rs, & $offset, $class,
            $culture = null) {
        $obj = new $class;
        $offset = $obj->hydrate($rs, $offset);
        if ($culture) {
            $obj->setCulture($culture);
        }
        return $obj;
    }

    public static function newObjectI18n($rs, & $offset, $class, $object,
            $culture) {
        $obj = new $class;
        $offset = $obj->hydrate($rs, $offset);
        call_user_func(array($object, "set{$class}ForCulture"), $obj, $culture);
        return $obj;
    }

    /**
     * @todo Refactor and document addManyToOneObjects
     */
    public static function addManyToOneObjects($results, $destObject, $objects) {
        $existObjects = array();
        $mainClass = get_class($destObject);

        foreach ($results as $result) {
            foreach ($objects as $i => $object) {
                if (isset($existObjects[$i])) {
                    continue;
                }

                $class = get_class($object);
                $temp = call_user_func(array($result, "get$class"));

                if ($temp->getPrimaryKey() === $object->getPrimaryKey()) {
                    $existObjects[$i] = true;
                    call_user_func(array($temp, "add$mainClass"), $destObject);
                }
            }
        }
        foreach ($objects as $i => $object) {
            if (! isset($existObjects[$i])) {
                call_user_func(array($object, "init{$mainClass}s"));
                call_user_func(array($object, "add$mainClass"), $destObject);
            }
        }
    }

    public static function filterUniqueObject(& $objectsList, $object) {
        if (! $objectsList) {
            $objectsList[] = $object;
        }
        $found = false;
        foreach ($objectsList as $result) {
            if ($result->getPrimaryKey() === $object->getPrimaryKey()) {
                $object = $result;
                $found = true;
                break;
            }
        }
        if (! $found) {
            $objectsList[] = $object;
        }
        return $object;
    }
}
