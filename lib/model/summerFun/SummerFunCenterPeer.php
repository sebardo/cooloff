<?php

/**
 * Subclass for performing query and update operations on the 'summer_fun_center' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunCenterPeer extends BaseSummerFunCenterPeer
{

    public static function getTitleById($id){

        $object=SummerFunCenterPeer::doSelectOneById($id);
        if (isset($object)){
        return ($object ? $object->getTitle() : null);
        }
    }
    public static function doSelectAllByI18n()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(SummerFunCenterI18nPeer::TITLE);
        $centers = parent::doSelectWithI18n($c);
        return $centers;

    }
	public static function doSelectWithI18nByZoneId($zoneId)
	{
		$c = new Criteria();
		$c->add(self::SUMMER_FUN_ZONE_ID, $zoneId);
		return parent::doSelectWithI18n($c);
	}

	public static function doSelectOneByProfileId($id)
	{
		$c = new Criteria();
		$c->add(self::PROFILE_ID, $id);
		return parent::doSelectOne($c);
	}

    public static function doSelectOneByCourseId($id)
    {

        $c = new Criteria();
        $c->addJoin(self::ID, CoursePeer::SUMMER_FUN_CENTER_ID);
        $c->add(CoursePeer::ID, $id);
        $c->setLimit(1);
        $items = parent::doSelectWithI18n($c);
        return ($items ? $items[0] : null);

    }

    public static function doSelectOneById($id)
    {
        $c = new Criteria();
        $c->add(self::ID, $id);
        $c->setLimit(1);
        $items = parent::doSelectWithI18n($c);
        return ($items ? $items[0] : null);
    }


    public static function retrieveByPKWithI18n($pk)
	{
		$c = new Criteria();
		$c->add(self::ID, $pk);
		$c->setLimit(1);
		$center = parent::doSelectWithI18n($c);
		return ($center ? $center[0] : null);
	}

	public static function getCentersByProfile($id)
	{
		$c = new Criteria();

        // JOIN
        $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
        // WHERE
        $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $id);

		$centers = self::doSelectWithI18n($c);
		return $centers;
	}

    public static function getCentersIsRegistrationOpen()
    {
        $start_date = mktime(0, 0, 0, 1  , 1, date("Y"));
        $end_date = mktime(0, 0, 0, 12  , 31, date("Y"));
        $c = new Criteria();
        $c->add(self::IS_REGISTRATION_OPEN, '1');
        $c->addJoin(self::ID, CoursePeer::SUMMER_FUN_CENTER_ID);
        $c->add(CoursePeer::IS_REGISTRATION_OPEN, 1);
        $c->add(CoursePeer::STARTS_AT, $start_date, CRITERIA::GREATER_EQUAL);
        $c->add(CoursePeer::ENDS_AT, $end_date, CRITERIA::LESS_EQUAL);
        $c->setDistinct();
        $c->addAscendingOrderByColumn(SummerFunCenterI18nPeer::TITLE);
        $centers = self::doSelectWithI18n($c);
        return $centers;
    }
    
	public static function doSelectAllByI18nAndProfile()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(SummerFunCenterI18nPeer::TITLE);
        
        $user = sfContext::getInstance()->getUser();
        if (!$user->hasCredential('administrador')) {
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }
        
        $centers = parent::doSelectWithI18n($c);
        
        return $centers;
    }
    
    public static function getArrayCentrosFiltro()
    {
    	$centros = self::doSelectAllByI18nAndProfile();
    	$g = array();
    
    	foreach ($centros as $centro)
    	{
    		if ($centro->getTitleCa()) {
				$nombre = $centro->getTitleCa();
            } 
            elseif ($centro->getTitleEs()) {
                $nombre = $centro->getTitleEs();
            }
            elseif ($centro->getTitleIt()) {
            	$nombre = $centro->getTitleIt();
            }
            else {
                $nombre = $centro->getTitleFr();
            }
    		
    		$g[$centro->getId()] = $nombre;
    	}
    
    	return $g;
    }


    public static function getArrayCenters()
    {
        $centers= self::doSelectAllByI18nAndProfile();
        $c = array();

        foreach ($centers as $center)
        {
            if ($center->getTitleCa()) {
                $c[$center->getId()] = $center->getTitleCa();
            }
            elseif ($center->getTitleEs()) {
                $c[$center->getId()]=$center->getTitleEs();
            }
            elseif ($center->getTitleIt()) {
                $c[$center->getId()] = $center->getTitleIt();
            }
            else {
                $c[$center->getId()] = $center->getTitleFr();
            }
        }

        return $c;
    }

}
