<?php

/**
 * Subclass for performing query and update operations on the 'summer_fun_zone' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunZonePeer extends BaseSummerFunZonePeer
{
    public static function doSelectWithI18nOrderedByTitle()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(SummerFunZoneI18nPeer::TITLE);
        return parent::doSelectWithI18n($c);
    }

    public static function doSelectOneByProfileId($id)
    {
        $c = new Criteria();
        $c->add(self::PROFILE_ID, $id);
        return parent::doSelectOne($c);
    }

    public static function retrieveByPKWithI18n($pk)
    {
        $c = new Criteria();
        $c->add(self::ID, $pk);
        $c->setLimit(1);
        $zones = parent::doSelectWithI18n($c);
        return ($zones ? $zones[0] : null);
    }


}
