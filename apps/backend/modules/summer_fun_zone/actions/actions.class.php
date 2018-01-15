<?php

/**
 * summer_fun_zone actions.
 *
 * @package    kids
 * @subpackage summer_fun_zone
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class summer_fun_zoneActions extends autosummer_fun_zoneActions
{

    public function validateEdit()
    {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            return ThairaUploadsValidator::validate();
        }
        return true;
    }

    protected function addSortCriteria($c)
    {
        if ($sortColumn = $this->getUser()->getAttribute('sort', null, 'sf_admin/summer_fun_zone/sort')) {
            if ($sortColumn == 'title_ca') {
                $c->addJoin(SummerFunZonePeer::ID, SummerFunZoneI18nPeer::ID);
                if ($this->getUser()->getAttribute('type', null, 'sf_admin/summer_fun_zone/sort') == 'asc') {
                    $c->addAscendingOrderByColumn(SummerFunZoneI18nPeer::TITLE);
                } else {
                    $c->addDescendingOrderByColumn(SummerFunZoneI18nPeer::TITLE);
                }
            } else {
                parent::addSortCriteria($c);
            }
        }

    }
}
