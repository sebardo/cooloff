<?php

class myBackendSummerFun
{
    private $userZone;

    public function __construct(sfActions $actions)
    {
        $user = $actions->getUser();

        // We ignore if user is an administrador
        if ($user->hasCredential('administrador')) {
            return;
        }

        $profile = $user->getProfile();
        $actions->forward404Unless($profile);
        
        $this->userCenter = SummerFunCenterPeer::getCentersByProfile($profile->getId());        
        $actions->forwardUnless($this->userCenter, 'sfGuardAuth', 'secure');
    }

    public function getUserCenter() { return $this->userCenter; }

    public function forceUserCenterValue($object)
    {
        // Force zone if we have an user zone
        if ($this->userCenter) {
            $object->setSummerFunCenterId($this->userCenter->getId());
        }
    }

    public function forceUserCenterFilter(array & $filters)
    {
        // Force zone filter if we have an user zone
        if ($this->userCenter) {
            $filters['summer_fun_center_id'] = $this->userCenter->getId();
        }


    }
}