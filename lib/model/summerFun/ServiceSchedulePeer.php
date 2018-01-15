<?php

/**
 * Subclass for performing query and update operations on the 'service_schedule' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class ServiceSchedulePeer extends BaseServiceSchedulePeer
{
    public static function getServiceSchedulesByCenter($centerId)
    {
        $c = new Criteria();
        $c->add(ServicePeer::CENTER_ID, $centerId);

        return self::doSelectWithI18n($c);
    }

    public static function getServiceSchedulesByProfile()
    {
        $c = new Criteria();

        $user = sfContext::getInstance()->getUser();
        if (!$user->hasCredential('administrador')) {
            $c->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }

        return self::doSelectWithI18n($c);
    }

}
