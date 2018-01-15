<?php

/**
 * service_schedule actions.
 *
 * @package    kids
 * @subpackage service_schedule
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class service_scheduleActions extends autoservice_scheduleActions
{
    protected function addFiltersCriteria($c)
    {
        $user = $this->getUser();
        if (!$user->hasCredential('administrador')) {
            $c->addJoin(ServiceSchedulePeer::SERVICE_ID, ServicePeer::ID);
            // JOIN
            $c->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }

        parent::addFiltersCriteria($c);
    }
}
