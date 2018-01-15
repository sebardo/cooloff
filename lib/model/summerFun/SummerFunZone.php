<?php

/**
 * Subclass for representing a row from the 'summer_fun_zone' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunZone extends BaseSummerFunZone
{
    public function __call($name, $args)
    {
        return ThairaPropelTools::processI18nMethods($this, $name, $args);
    }

    public function __toString()
    {
        if (! $this->getCulture()) {
            // Picks application default culture. Important for the backend app.
            $culture = sfConfig::get('sf_i18n_default_culture');
            $this->setCulture($culture);
        }
        return (string) $this->getTitle();
    }

    public function getCentersWithI18n()
    {
        return SummerFunCenterPeer::doSelectWithI18nByZoneId($this->getId());
    }

    public function getNewsItemsWithI18n()
    {
        return SummerFunZoneNewsItemPeer::doSelectWithI18nByZoneId($this->getId());
    }
}


sfPropelBehavior::add('SummerFunZone', array('thaira_uploads_behavior'));