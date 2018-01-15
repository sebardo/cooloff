<?php

/**
 * Subclass for representing a row from the 'excursion' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Excursion extends BaseExcursion
{
	public function __toString()
	{
		if (!$this->getCulture()) {
			
			if (sfContext::getInstance()->getUser()->getCulture())
			{
				$this->setCulture(sfContext::getInstance()->getUser()->getCulture());
			}
			else {
				// Picks application default culture. Important for the backend app.
				$culture = sfConfig::get('sf_i18n_default_culture');
				$this->setCulture($culture);
			}
		}
		return (string) $this->getNombre();
	}
	
	public function __call($name, $args)
	{
		return ThairaPropelTools::processI18nMethods($this, $name, $args);
	}
}
