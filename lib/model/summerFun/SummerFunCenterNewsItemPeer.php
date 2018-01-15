<?php

/**
 * Subclass for performing query and update operations on the 'summer_fun_center_news_item' table.
 *
 *
 *
 * @package lib.model.summerFun
 */
class SummerFunCenterNewsItemPeer extends BaseSummerFunCenterNewsItemPeer
{
	public static function doSelectWithI18nByZoneId($id)
	{
		$c = new Criteria();
		$c->add(self::SUMMER_FUN_CENTER_ID, $id);
		$c->addDescendingOrderByColumn('published_at');
		return parent::doSelectWithI18n($c);
	}

	public static function retrieveByPKWithI18n($pk)
	{
		$c = new Criteria();
		$c->add(self::ID, $pk);
		$c->setLimit(1);
		$items = parent::doSelectWithI18n($c);
		return ($items ? $items[0] : null);
	}
}
