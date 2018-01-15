<?php

/**
 * sfGuardUserProfile actions.
 *
 * @package    thaira_plugins
 * @subpackage sfGuardUserProfile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class sfGuardUserProfileActions extends autosfGuardUserProfileActions
{
	public $THAIRA_USER_ID = '1';

	public function executeList()
	{
	    $this->processSort();
	    $this->processFilters();
	    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/sf_guard_user_profile/filters');
	
	    if (! $this->getUser()->hasCredential('administrador'))
	    {
	    	$c = sfGuardUserProfilePeer::getExceptUserIdCriteria($this->THAIRA_USER_ID);
	    }
	    else
	    {
	    	$c = new Criteria();
	    }
	
	    $this->addSortCriteria($c);
	    $this->addFiltersCriteria($c);
	
	    // pager
	    $current_page = $this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/sf_guard_user_profile'));
	    $this->pager = sfGuardUserProfilePeer::getPager($c, $current_page);
	
	    // save page
	    if ($this->getRequestParameter('page'))
	    {
	    	$this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/sf_guard_user_profile');
	    }
	}

	public function executeEdit()
	{
		$profileId = $this->getRequestParameter('id');
		$this->redirectIf($profileId == $this->THAIRA_USER_ID && ! $this->getUser()->hasCredential('administrador'),'sfGuardAuth/secure');
	
	    $this->sf_guard_user = $this->getsfGuardUserOrCreate();
	    $this->getUser()->setAttribute("sf_guard_user", $this->sf_guard_user->toArray());
	
	    if ($this->getRequest()->getMethod() == sfRequest::POST)
	    {
    		$this->updatesfGuardUserFromRequest();
    		$this->savesfGuardUser($this->sf_guard_user);
	    }
	    
	    parent::executeEdit();
	}
	
	public function validateEdit() 
	{
		if ($this->getRequest()->getMethod() == sfRequest::POST) {

			if(!$this->getRequestParameter('id')) {
				
				$user = $this->getRequestParameter('associated_permissions');
				$sfGuardUser = $this->getRequestParameter('sf_guard_user');
				if(!$user) {
			    	$this->getRequest()->setError("sf_guard_user{permissions}", "Camp obligatori");
			    	return false;
			    }
			    if(!$sfGuardUser['password']) {
			    	$this->getRequest()->setError("sf_guard_user{password}", "Camp obligatori");
			    	return false;
			    }
			    
			}
		}
		return true;
	}
	
  protected function getLabels()
	{
	    $profileLabels = parent::getLabels();
	    $userLabels = array(
	        'sf_guard_user{username}' => 'Username:',
	        'sf_guard_user{password}' => 'Password:',
	        'sf_guard_user{password_bis}' => 'Password (again):',
	    	'sf_guard_user{permissions}' => 'Permissions:'
	    );
	
	    return array_merge($profileLabels, $userLabels);
	}

  protected function savesfGuardUserProfile($sf_guard_user_profile)
  {
    $sf_guard_user_profile->setUserId($this->sf_guard_user->getId());
    $sf_guard_user_profile->save();
  }

  protected function deletesfGuardUserProfile($sf_guard_user_profile)
  {
  	$sf_guard_user_id = $sf_guard_user_profile->getUserId();
  	sfGuardUserPeer::doDelete($sf_guard_user_id);
    $sf_guard_user_profile->delete();
  }

  protected function getsfGuardUserProfileOrCreate($id = 'id')
  {
  	// Cache variable
    static $sf_guard_user_profile = null;

    // If not cached retrieve it
    if (! $sf_guard_user_profile)
    {
      $sf_guard_user_profile = parent::getsfGuardUserProfileOrCreate($id);
    }

    return $sf_guard_user_profile;
  }

  /* ***** BORROWED FROM autosfGuardUser ***** */

  protected function savesfGuardUser($sf_guard_user)
  {
  	$sf_guard_user->save();

    // Update many-to-many for "permissions"
    $c = new Criteria();
    $c->add(sfGuardUserPermissionPeer::USER_ID, $sf_guard_user->getPrimaryKey());
    sfGuardUserPermissionPeer::doDelete($c);
    
    
    //Permissos microsite = 2
    $ids = $this->getRequestParameter('associated_permissions');
    if (is_array($ids))
    {

        if (in_array(1, $ids)) {
            $sf_guard_user->setRol('ROLE_ADMIN');
        }
        else {
            $sf_guard_user->setRol('ROLE_CENTER');
        }

        $sf_guard_user->save();

      foreach ($ids as $id)
      {
        $SfGuardUserPermission = new sfGuardUserPermission();
        $SfGuardUserPermission->setUserId($sf_guard_user->getPrimaryKey());
        $SfGuardUserPermission->setPermissionId($id);
        $SfGuardUserPermission->save();
      }
    }
  }
  
  protected function updatesfGuardUserFromRequest()
  {
    $sf_guard_user = $this->getRequestParameter('sf_guard_user');
    $sf_guard_user_profile = $this->getRequestParameter('sf_guard_user_profile');
  	if (isset($sf_guard_user_profile['email']))
    {
      $this->sf_guard_user->setUsername($sf_guard_user_profile['email']);
    }
    
    if (isset($sf_guard_user['password']) && ($sf_guard_user['password'] != '') && ($sf_guard_user['password'] == $sf_guard_user['password_bis']))
    {
      $this->sf_guard_user->setPassword($sf_guard_user['password']);
    }
  	if (isset($sf_guard_user['permissions']))
    {
      $this->sf_guard_user->setPermissions($sf_guard_user['permissions']);
    }
  }

  protected function getsfGuardUserOrCreate($id = 'id')
  {
    $sf_guard_user_profile = $this->getsfGuardUserProfileOrCreate();
    $sf_guard_user = $sf_guard_user_profile->getsfGuardUser();
    if (! $sf_guard_user)
    {
      $sf_guard_user = new sfGuardUser();
    }

    return $sf_guard_user;
  }
  protected function updatesfGuardUserProfileFromRequest()
  {
    $sf_guard_user_profile = $this->getRequestParameter('sf_guard_user_profile');
	$sf_guard_user = $this->getRequestParameter('sf_guard_user');
	
    if (isset($sf_guard_user['password']) && ($sf_guard_user['password'] != '') && ($sf_guard_user['password'] == $sf_guard_user['password_bis']))
    {
      $this->sf_guard_user_profile->setPass($sf_guard_user['password']);
    }
    
    parent::updatesfGuardUserProfileFromRequest();
  }
}
