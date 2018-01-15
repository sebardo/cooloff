<?php

/**
 * Subclass for representing a row from the 'service_schedule' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class ServiceSchedule extends BaseServiceSchedule
{
    public function __call($name, $args)
    {
        return ThairaPropelTools::processI18nMethods($this, $name, $args);
    }

    public function __toString()
    {
        $user = sfContext::getInstance()->getUser();
        if (!$this->getCulture()) {
            $this->setCulture($user->getCulture());
        }

        if (!$this->getService()->getCulture()) {
            $this->getService()->setCulture($user->getCulture());
        }

        return $this->getService()->getName() . ' (' . $this->getName() . ')';
    }
}
