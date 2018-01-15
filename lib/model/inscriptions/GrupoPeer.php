<?php

/**
 * Subclass for performing query and update operations on the 'grupo' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class GrupoPeer extends BaseGrupoPeer
{
	public static function doSelectOrderByNombre()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn('nombre');
		
		return parent::doSelect($c);
	}
	
	public static function doSelectOrderByNombreAndProfileAndCenter($centerId)
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(GrupoPeer::NOMBRE);
	
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
            $c->addJoin(GrupoPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());

            if ($centerId) {
				$c->add(GrupoPeer::CENTRO_ID, $centerId);
			}
		}
	
		return parent::doSelect($c);
	}
	
	public static function doSelectOrderByNombreAndProfile()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(GrupoPeer::NOMBRE);
	
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador')) 
		{
            $c->addJoin(GrupoPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}
	
		return parent::doSelect($c);
	}
	
	public static function getArrayGrupos()
	{
		$grupos = self::doSelectOrderByNombreAndProfile();
		$g = array();
        $groups = array();
		
		foreach ($grupos as $grupo) {
			$g['id'] = $grupo->getId();
			$g['nombre'] = $grupo;
			$g['centro'] = $grupo->getCentroId();

            $groups[] = $g;
		}
	
		return $groups;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
			$criteria->addJoin(GrupoPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $criteria->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}
		
		return GrupoPeer::populateObjects(GrupoPeer::doSelectRS($criteria, $con));
	}
}
