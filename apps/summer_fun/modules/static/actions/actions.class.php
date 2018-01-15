<?php

/**
 * static actions.
 *
 * @package    kids
 * @subpackage static
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class staticActions extends sfActions
{
	public function executeRedirect()
	{
		$this->redirect('@index_' . $this->getUser()->getCulture(), 301);		
	}

	public function executeHomepage()
	{
		$url = "http://www.kidsandus.es";
		$culture = $this->getUser()->getCulture();
		
		if ($culture == "ca") $url .= "/ca/";
		elseif ($culture == "en") $url .= "/en/";
		elseif ($culture == "it") $url .= "/it/";
		elseif ($culture == "fr") $url .= "/fr/";

		$this->setVar('url_kids', $url);
	}

	public function executePartyTime()
	{
	}

	public function executeGames()
	{
	}

	public function executeTheater()
	{
	}
}
