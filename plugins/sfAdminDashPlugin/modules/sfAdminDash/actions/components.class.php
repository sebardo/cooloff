<?php

class sfAdminDashComponents extends sfComponents
{
	public function executeDash()
	{
		$this->parseSettings();
		$user = $this->getUser();
		$user_culture = $user->getCulture();
		
		if (sfAdminDash::getProperty('logout_url') == 'sfGuardAuth/signout' && class_exists('sfGuardUserProfile')) {
			if ($user->getProfile()->getCulture()) {
				$user_culture = $user->getProfile()->getCulture();
			}
		}
		
		$user->setCulture($user_culture);
	}

	public function executeMenu()
	{
		$this->parseSettings();
	}

	public function executeDash_item()
	{
		$this->InitItem();
	}

	public function executeMenu_item()
	{
		$this->InitItem(sfAdminDash::getProperty('resize_mode'));
	}

	protected function parseSettings()
	{
		$this->items = sfAdminDash::getItems();
		$this->cats  = sfAdminDash::getCategories();
	}
	
	protected function InitItem($resize_mode = 'html')
	{
		$item = $this->item;
		$image = sfAdminDash::getProperty('default_image');

		if (array_key_exists('image', $item)) {
			$image = $item['image'];
		}

		$item['image'] = sfAdminDash::getProperty('image_dir');

		if ($resize_mode == 'thumbnail') {
			$item['image'] .= 'small/';
		}

		//if image isn't specified - use default
		if (!array_key_exists('image', $item)) {
			$item['image'] .= $image;
		} else {
			$item['image'] .= $image;
		}

		//if name isn't specified - use key
		if (!array_key_exists('name', $item)) {
			$item['name'] = $this->key;
		}

		//if url isn't specified - use key
		if (!array_key_exists('url', $item)) {
			$item['url'] = $this->key;
		}
		$this->item = $item;
	}
}