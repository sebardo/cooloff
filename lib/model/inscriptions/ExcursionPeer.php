<?php

/**
 * Subclass for performing query and update operations on the 'excursion' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class ExcursionPeer extends BaseExcursionPeer
{
	public static function doSelectByUser()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(ExcursionPeer::ID);
	
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
			$c->addJoin(ExcursionPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}
	
		return parent::doSelect($c);
	}
	
	public static function getArrayExcursions()
	{
		$excursions = self::doSelectByUser();
	
		$e = array();
	
		foreach ($excursions as $excursion){
			$e[$excursion->getId()] = $excursion;
		}
	
		return $e;
	}
}
