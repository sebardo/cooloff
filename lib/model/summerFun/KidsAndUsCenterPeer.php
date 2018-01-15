<?php

/**
 * Subclass for performing query and update operations on the 'kids_and_us_center' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class KidsAndUsCenterPeer extends BaseKidsAndUsCenterPeer
{
    public static function doSelectAll()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(KidsAndUsCenterPeer::NAME);

        return KidsAndUsCenterPeer::doSelect($c);
    }

    public static function getNameById($id)
    {
        $entity = KidsAndUsCenterPeer::doSelectById($id);

        return $entity ? $entity->getName() : '';
    }

    public static function doSelectById($id)
    {
        $c = new Criteria();
        $c->add(self::ID, $id);

        $entity = parent::doSelectOne($c);

        return $entity;
    }

    public static function getArrayCenters()
    {
        $centers= self::doSelectAll();
        $c = array();

        foreach ($centers as $center)
        {
            $c[$center->getId()] = $center->getName();
        }

        return $c;
    }
}
