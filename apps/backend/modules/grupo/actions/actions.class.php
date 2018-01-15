<?php

/**
 * grupo actions.
 *
 * @package    kids
 * @subpackage grupo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class grupoActions extends autogrupoActions
{
	protected function addFiltersCriteria($c)
	{
		$user = $this->getUser();
		if (!$user->hasCredential('administrador')) {
			$profile = $user->getProfile();
			$c->addJoin(GrupoPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $profile->getId());
		}
	
		parent::addFiltersCriteria($c);
	}
}
