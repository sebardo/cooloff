<?php

class myTools
{
    public static function _get_propel_object_list($object, $method, $options)
    {
        // get the lists of objects
        $through_class = _get_option($options, 'through_class');

        $peer_method = _get_option($options, 'peer_method', 'doSelect');

        $objects = myTools::getAllObjects($object, $through_class, NULL, $peer_method);
        $objects_associated = sfPropelManyToMany::getRelatedObjects($object, $through_class);
        $ids = array_map(create_function('$o', 'return $o->getPrimaryKey();'), $objects_associated);

        return array($objects, $objects_associated, $ids);
    }

    public static function getAllObjects($object, $middleClass, $criteria = null, $peer_method = 'doSelect')
    {
        if (null === $criteria)
        {
            $criteria = new Criteria();
        }

        $relatedClass = sfPropelManyToMany::getRelatedClass(get_class($object), $middleClass);

        //return call_user_func(array($relatedClass.'Peer', $peer_method), $criteria, $object);
        return call_user_func(array($relatedClass . 'Peer', $peer_method), $criteria);
    }
}