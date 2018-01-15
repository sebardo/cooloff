<?php

/**
 * Subclass for representing a row from the 'schedule' table.
 *
 * 
 *
 * @package lib.model.summerFun
 */ 
class Schedule extends BaseSchedule
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
}
