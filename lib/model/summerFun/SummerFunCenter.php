<?php

/**
 * Subclass for representing a row from the 'summer_fun_center' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunCenter extends BaseSummerFunCenter
{
	public function __call($name, $args)
	{
		return ThairaPropelTools::processI18nMethods($this, $name, $args);
	}

	public function __toString()
	{
		if (!$this->getCulture()) {
			// Picks application default culture. Important for the backend app.
			$culture = sfConfig::get('sf_i18n_default_culture');
			$this->setCulture($culture);
		}
		return (string) $this->getTitle();
	}

    public function getCenterName()
    {
        if ($this->__toString()) {
            return $this->__toString();
        }
        elseif ($this->getTitleEs()) {
            return $this->getTitleEs();
        }
        elseif ($this->getTitleCa()) {
            return $this->getTitleCa();
        }
        elseif ($this->getTitleIt()) {
            return $this->getTitleIt();
        }
        elseif ($this->getTitleFr()) {
            return $this->getTitleFr();
        }
        else {
            return '';
        }
    }

    public function getSecondPaymentMailingBody()
    {
        if (!$this->getCulture()) {
            $user = sfContext::getInstance()->getUser();
            $this->setCulture($user->getCulture());
        }

        return parent::getSecondPaymentMailingBody();
    }
}

sfPropelBehavior::add('SummerFunCenter', array('thaira_uploads_behavior'));
