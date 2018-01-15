<?php

/**
 * summer_fun_zone_news_item actions.
 *
 * @package    kids
 * @subpackage summer_fun_zone_news_item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class summer_fun_zone_news_itemActions extends autosummer_fun_zone_news_itemActions
{
    /**
     * @var myBackendSummerFun
     */
    private $backend = null;

    public function preExecute()
    {
    	$user = $this->getUser();
        // Si el usuari eś admin ok
        if ($user->hasCredential('administrador')) {
            return;
        }else $this->backend = new myBackendSummerFun($this);

    }

    public function validateEdit()
    {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            return ThairaUploadsValidator::validate();
        }
        return true;
    }

    protected function updateSummerFunCenterNewsItemFromRequest()
    {    	            	
        $user = $this->getUser();
		
    	$summer_fun_center_news_item = $this->getRequestParameter('summer_fun_center_news_item');       

        if (isset($summer_fun_center_news_item['summer_fun_center_id']))
	    {
			$this->summer_fun_center_news_item->setSummerFunCenterId($summer_fun_center_news_item['summer_fun_center_id']);
	    }        
        
        parent::updateSummerFunCenterNewsItemFromRequest();
    }
	
    protected function addFiltersCriteria($c)
    {    	
    	$user = $this->getUser();
    	
		// Si el usuari eś admin ok
		if (!$user->hasCredential('administrador')) {
			$c->addJoin(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
		}

		parent::addFiltersCriteria($c);
        
    }
}
