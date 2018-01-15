<?php

/**
 * service actions.
 *
 * @package    kids
 * @subpackage service
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class serviceActions extends autoserviceActions
{
    protected function addFiltersCriteria($c)
    {
        $user = $this->getUser();
        if (!$user->hasCredential('administrador')) {
            $c->addJoin(ServicePeer::CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }

        parent::addFiltersCriteria($c);
    }

    public function executeAddSchedule()
    {
        $entity = new ServiceSchedule();
        $entity->setServiceId($this->getRequestParameter('id'));
        $entity->save();

        $this->redirect('service_schedule/edit?id=' . $entity->getId());
    }
}
