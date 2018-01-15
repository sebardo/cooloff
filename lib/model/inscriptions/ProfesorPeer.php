<?php

/**
 * Subclass for performing query and update operations on the 'profesor' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class ProfesorPeer extends BaseProfesorPeer
{
	public static function doSelectOrderByNombre()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn('nombre');
		
		return parent::doSelect($c);
	}
	
	public static function doSelectOrderByNombreAndProfile()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(ProfesorPeer::NOMBRE);
	
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
            $c->addJoin(ProfesorPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}
	
		return parent::doSelect($c);
	}
	
	public static function getArrayProfesores()
	{
		$profesores = self::doSelectOrderByNombreAndProfile();
		$p = array();
        $teachers = array();
		
		foreach ($profesores as $profesor){
			//$p[$profesor->getId()] = $profesor;

            $p['id'] = $profesor->getId();
            $p['nombre'] = $profesor;
            $p['centro'] = $profesor->getCentroId();

            $teachers[] = $p;
		}
	
		return $teachers;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
			$criteria->addJoin(ProfesorPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $criteria->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $criteria->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}
	
		return ProfesorPeer::populateObjects(ProfesorPeer::doSelectRS($criteria, $con));
	}
}
