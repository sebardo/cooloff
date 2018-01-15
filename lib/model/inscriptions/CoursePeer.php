<?php

/**
 * Subclass for performing query and update operations on the 'course' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class CoursePeer extends BaseCoursePeer
{
    public static function getCourseByCenter($id)
    {
        $start_date = mktime(0, 0, 0, 1, 1, date("Y"));
        $end_date = mktime(0, 0, 0, 12, 31, date("Y"));

        $c = new Criteria();
        $c->add(self::SUMMER_FUN_CENTER_ID, $id);
        $c->addJoin(self::EXCURSION_ID, ExcursionPeer::ID, 'LEFT JOIN');
        $c->add(CoursePeer::STARTS_AT, $start_date, CRITERIA::GREATER_EQUAL);
        $c->add(CoursePeer::ENDS_AT, $end_date, CRITERIA::LESS_EQUAL);
        $c->addAscendingOrderByColumn(CoursePeer::STARTS_AT);
        $c->addAscendingOrderByColumn(CourseI18nPeer::SCHEDULE);
        $courses = self::doSelectWithI18n($c);
        
        return $courses;
    }

    public static function retrieveByPKWithI18n($pk)
    {
        $c = new Criteria();
        $c->add(self::ID, $pk);
        $c->setLimit(1);
        $course = parent::doSelect($c);
        if ($course) {
            $course = $course[0];
            if (!$course->getCulture()) {
                $user = sfContext::getInstance()->getUser();
                $course->setCulture($user->getCulture());
            }
        }
        return ($course ? $course : null);
    }
    
	public static function getCourseByInscrptionId($pk)
	{
    	$c = new Criteria();
    	$c->addJoin(self::ID,InscriptionPeer::STUDENT_COURSE_INSCRIPTION);
    	$c->add(InscriptionPeer::ID, $pk);
    	$c->setLimit(1);
    	$course = parent::doSelectWithI18n($c);
    	
    	return ($course ? $course[0] : null);
	}

    public static function getPriceCourseByInscrptionId($pk)
    {
        $c = new Criteria();
        $c->addJoin(self::ID,InscriptionPeer::STUDENT_COURSE_INSCRIPTION);
        $c->add(InscriptionPeer::ID, $pk);
        $c->setLimit(1);
        $course = parent::doSelect($c);
        
        return ($course ? $course[0]->getPrice() : null);
    }
    
    public static function getCoursesByProfile()
    {
    	if (!sfContext::getInstance()->getUser()->getCulture()) {
    		$culture = sfConfig::get('sf_i18n_default_culture');
    		$this->setCulture($culture);
    	}
    	
    	$c = new Criteria();
    	$c->addJoin(self::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

    	$user = sfContext::getInstance()->getUser();
    	if (!$user->hasCredential('administrador')) {
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
    	}
    	
    	/*
    	$c->addJoin(self::WEEK_ID, WeekPeer::ID);
    	$c->addJoin(self::EXCURSION_ID, ExcursionPeer::ID, 'LEFT JOIN');
    	$c->add(WeekPeer::STARTS_AT,$start_date, CRITERIA::GREATER_EQUAL);
    	$c->add(WeekPeer::ENDS_AT,$end_date, CRITERIA::LESS_EQUAL);
    	$c->addAscendingOrderByColumn(WeekPeer::STARTS_AT);
    	$c->addAscendingOrderByColumn(CourseI18nPeer::SCHEDULE);
    	*/
    	
    	return self::doSelectWithI18n($c); 
    }

    public static function findAll()
    {
        $c = new Criteria();
        $course = parent::doSelectWithI18n($c);

        return ($course ? $course[0] : null);
    }

    public static function doSelectOrderBySartsAtAndProfile()
    {
        $c = new Criteria();
        $c->addDescendingOrderByColumn(CoursePeer::STARTS_AT);

        $user = sfContext::getInstance()->getUser();
        if (!$user->hasCredential('administrador'))
        {
            $c->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }

        return parent::doSelect($c);
    }

    public static function getArrayWeeksForInscriptionFilter()
    {
        $courses = self::doSelectOrderBySartsAtAndProfile();
        $result = array();

        foreach ($courses as $course) {
            $w = array();
            $w['id'] = $course->getId();
            $w['nombre'] = $course->getWeekWithSchedule();
            $w['centro'] = $course->getSummerFunCenterId();

            $result[] = $w;
        }

        return $result;
    }
}
