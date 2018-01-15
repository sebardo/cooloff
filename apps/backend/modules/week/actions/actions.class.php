<?php

/**
 * week actions.
 *
 * @package    kids
 * @subpackage week
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class weekActions extends autoweekActions
{
	protected function addFiltersCriteria($c)
	{
		$user = $this->getUser();
		if (!$user->hasCredential('administrador')) {
            $c->addJoin(WeekPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }
	
		parent::addFiltersCriteria($c);
	}
}
