<?php

/**
 * Subclass for representing a row from the 'week' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Week extends BaseWeek
{
    public function __toString()
    {
        if (!$this->getCulture()) {
            $user = sfContext::getInstance()->getUser();
            $this->setCulture($user->getCulture());
        }

        return 'Del ' . date("d/m/Y", $this->starts_at) . ' al ' . date("d/m/Y", $this->ends_at);
    }

    public function __call($name, $args)
    {
        return ThairaPropelTools::processI18nMethods($this, $name, $args);
    }

    public function getForCourse()
    {
        return  $this->getSummerFunCenter()->getCenterName() . ' (Del ' . date("d/m/Y", $this->starts_at) . ' al ' . date("d/m/Y", $this->ends_at) . ')';
    }
}
