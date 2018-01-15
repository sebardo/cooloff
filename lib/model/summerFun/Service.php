<?php

/**
 * Subclass for representing a row from the 'service' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class Service extends BaseService
{
    public function __call($name, $args)
    {
        return ThairaPropelTools::processI18nMethods($this, $name, $args);
    }

    public function __toString()
    {
        if (!$this->getCulture()) {
            $user = sfContext::getInstance()->getUser();
            $this->setCulture($user->getCulture());
        }

        return $this->getName();
    }

    public function getServiceSchedules($criteria = null, $con = null)
    {
        include_once 'lib/model/summerFun/om/BaseServiceSchedulePeer.php';
        if ($criteria === null) {
            $criteria = new Criteria();
        }
        elseif ($criteria instanceof Criteria)
        {
            $criteria = clone $criteria;
        }

        if ($this->collServiceSchedules === null) {
            if ($this->isNew()) {
                $this->collServiceSchedules = array();
            } else {

                $criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->getId());
                $criteria->addAscendingOrderByColumn(ServiceSchedulePeer::ORDEN);

                ServiceSchedulePeer::addSelectColumns($criteria);
                $this->collServiceSchedules = ServiceSchedulePeer::doSelect($criteria, $con);
            }
        } else {
            if (!$this->isNew()) {


                $criteria->add(ServiceSchedulePeer::SERVICE_ID, $this->getId());
                $criteria->addAscendingOrderByColumn(ServiceSchedulePeer::ORDEN);

                ServiceSchedulePeer::addSelectColumns($criteria);
                if (!isset($this->lastServiceScheduleCriteria) || !$this->lastServiceScheduleCriteria->equals($criteria)) {
                    $this->collServiceSchedules = ServiceSchedulePeer::doSelect($criteria, $con);
                }
            }
        }
        $this->lastServiceScheduleCriteria = $criteria;
        return $this->collServiceSchedules;
    }

}
