<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	public static function addFilterUsersWithSpecialPermissionCriteria($c)
	{
		// Get users with special permission permission
		$c2 = new Criteria();
		$c2->addJoin(sfGuardUserPeer::ID, sfGuardUserPermissionPeer::USER_ID);
		$c2->addJoin(sfGuardUserPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID);
		$c2->add(sfGuardPermissionPeer::NAME, sfGuardPermissionPeer::SPECIAL_PERMISSION_NAME);
		$users = sfGuardUserPeer::doSelect($c2);

		// Create filter list
		$filteredIds = array();
		foreach ($users as $user) {
			$filteredIds[] = $user->getId();
		}

		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->add(sfGuardUserPeer::ID, $filteredIds, Criteria::NOT_IN);
	}

	public static function retrieveByUserId($userId) {
		$c = new Criteria();
		$c->add(self::USER_ID, $userId);
		return self::doSelectOne($c);
	}

	/**
	 * Returns custom a sfPropelPager
	 * @param Criteria $criteria
	 * @param integer $page_num
	 * @return sfPropelPager
	 */
	public static function getPager($criteria, $page_num) {
		$pager = new sfPropelPager('sfGuardUserProfile', 25);
		$pager->setCriteria($criteria);
		$pager->setPage($page_num);
		$pager->setPeerMethod('doSelectJoinsfGuardUser');
		$pager->init();
	  
		return $pager;
	}
	
	public static function checkMail($email) {
		
		$c = new Criteria();
		$c->add(self::EMAIL, $email);
		$check = self::doCount($c);
		
		if($check > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public static function getProfileByEmail($email) {
	
		$c = new Criteria();
		$c->add(self::EMAIL, $email);
		return self::doSelectOne($c);
		
	}
	
	public static function getAll() {
	
		$c = new Criteria();
		$c->addDescendingOrderByColumn(self::NAME);
		return self::doSelect($c);
		
	}
}
