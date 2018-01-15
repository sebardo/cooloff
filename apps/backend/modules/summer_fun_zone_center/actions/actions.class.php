<?php

/**
 * summer_fun_zone_center actions.
 *
 * @package    kids
 * @subpackage summer_fun_zone_center
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class summer_fun_zone_centerActions extends autosummer_fun_zone_centerActions
{
	private $backend = null;

	public function validateEdit()
	{
		if ($this->getRequest()->getMethod() == sfRequest::POST) {
			return ThairaUploadsValidator::validate();
		}
		return true;
	}

	protected function getLabels()
	{
		$labels = parent::getLabels();
		$labels['thairaUploads{docs}'] = 'Documents';
		return $labels;
	}

	public function preExecute()
	{
		$user = $this->getUser();

		if (!$user->hasCredential('administrador')) {
            $this->backend = new myBackendSummerFun($this);
        }
	}

	protected function addFiltersCriteria($c)
	{
		$user = $this->getUser();
		if (!$user->hasCredential('administrador')) {
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}

		parent::addFiltersCriteria($c);
	}

}
