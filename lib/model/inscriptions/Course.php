<?php

/**
 * Subclass for representing a row from the 'course' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Course extends BaseCourse
{

   public function __toString()
    {
        if (!$this->getCulture()) {
            // Picks application default culture. Important for the backend app.
            $culture = sfConfig::get('sf_i18n_default_culture');
            $this->setCulture($culture);
        }

        $result = $this->getSummerFunCenter() . ' - ' . $this->getWeek();

        if ($this->getSchedule()) {
            $result .= ' - ' . $this->getSchedule();
        }

        return $result;
    }

    public  function getInscriptionsByCourse()
    {
        return InscriptionPeer::doSelectInscriptionsByCourse($this->getId());
    }

    public function __call($name, $args)
    {
        return ThairaPropelTools::processI18nMethods($this, $name, $args);
    }

    public function getWeek()
    {
        return sfContext::getInstance()->getI18N()->__('Del') . ' ' . $this->getStartsAt('d/m/Y') . ' ' . sfContext::getInstance()->getI18N()->__('al') . ' ' . $this->getEndsAt('d/m/Y');
    }

    public function getWeekWithSchedule()
    {
        $result = sfContext::getInstance()->getI18N()->__('Del') . ' ' . $this->getStartsAt('d/m/Y') . ' ' . sfContext::getInstance()->getI18N()->__('al') . ' ' . $this->getEndsAt('d/m/Y');
        if (!$this->getCulture()) {
            $user = sfContext::getInstance()->getUser();
            $this->setCulture($user->getCulture());
        }
        if ($this->getSchedule()) {
            $result .= ' - ' . $this->getSchedule();
        }

        return $result;
    }
}
