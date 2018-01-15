<?php

/**
 * Subclass for representing a row from the 'summer_fun_center_news_item' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunCenterNewsItem extends BaseSummerFunCenterNewsItem
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
}

sfPropelBehavior::add('SummerFunCenterNewsItem', array('thaira_uploads_behavior'));