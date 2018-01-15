<?php

/**
 * Subclass for performing query and update operations on the 'week' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class WeekPeer extends BaseWeekPeer
{
    public static function doSelectOrderBySartsAt()
    {
        $c = new Criteria();
        $c->addDescendingOrderByColumn('starts_at');
        return parent::doSelect($c);
    }
    
    public static function doSelectOrderBySartsAtAndProfile()
    {
    	$c = new Criteria();
    	$c->addDescendingOrderByColumn(WeekPeer::STARTS_AT);
    
    	$user = sfContext::getInstance()->getUser();
    	if (!$user->hasCredential('administrador'))
    	{
            $c->addJoin(WeekPeer::CENTRO_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
    	}
    
    	return parent::doSelect($c);
    }

    public static function getArrayWeeks()
    {
        $weeks = self::doSelectOrderBySartsAtAndProfile();
		
        $w = array();
        
        foreach ($weeks as $week){
            $w[$week->getId()] = $week;
        }
		
        return $w;
    }

    public static function getArrayWeeksForInscriptionFilter()
    {
        $weeks = self::doSelectOrderBySartsAtAndProfile();
        $result = array();

        foreach ($weeks as $week) {
            $w = array();
            $w['id'] = $week->getId();
            $w['nombre'] = $week;
            $w['centro'] = $week->getCentroId();

            $result[] = $w;
        }

        return $result;
    }

    public static function doSelectOrderByCenter()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn('centro_id');

        return parent::doSelect($c);
    }
}
