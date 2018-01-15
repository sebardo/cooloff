<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
    public function __toString() {
        return $this->name;
    }

	public function getUsername() {
		$relatedUser = $this->getsfGuardUser();
		return ($relatedUser)? $relatedUser->getUsername() : null;
	}
}
