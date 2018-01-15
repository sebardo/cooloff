<?php

/**
 * Default module for security actions.
 *
 * @package    thaira_plugins
 * @subpackage security
 * @author     Thaira SL
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class securityActions extends sfActions
{
	public function executeLogin()
	{
		$user = sfConfig::get('app_security_user', 'admin');
		$pass = sfConfig::get('app_security_pass', 'admin');
		$i18n = $this->getContext()->getI18N();

		if ($this->getRequestParameter('login') == $user && $this->getRequestParameter('password') == $pass) {
			// Autentica
			$this->getUser()->setAuthenticated(true);
			$this->getUser()->addCredential('admin');
			return $this->redirect('@homepage');
		} else {
			// Login error
			$this->getRequest()->setError('login', $i18n->__('Username or password is not valid.'));
			$this->forward('security', 'index');
		}
	}

	public function executeLogout()
	{
		$this->getUser()->clearCredentials();
		$this->getUser()->setAuthenticated(false);
		$this->redirect('@homepage');
	}

	public function executeSecure()
	{
	}
	
	public function executeIndex()
	{
	}
}
