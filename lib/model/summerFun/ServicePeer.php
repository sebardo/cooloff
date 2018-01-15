<?php

/**
 * Subclass for performing query and update operations on the 'service' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class ServicePeer extends BaseServicePeer
{
    public static function getServicesByCenter($centerId)
    {
        $c = new Criteria();
        $c->add(ServicePeer::CENTER_ID, $centerId);

        return self::doSelectWithI18n($c);
    }

    public static function getServicesByProfile()
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

    public static function getArrayFiltro()
    {
        $entities = self::getServicesByProfile();
        $result = array();

        foreach ($entities as $entity)
        {
            if ($entity->getNameCa()) {
                $name = $entity->getNameCa();
            }
            elseif ($entity->getNameEs()) {
                $name = $entity->getNameEs();
            }
            elseif ($entity->getNameIt()) {
                $name = $entity->getNameIt();
            }
            else {
                $name = $entity->getNameFr();
            }

            $result[$entity->getId()] = $name;
        }

        return $result;
    }
}
