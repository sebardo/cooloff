<?php

class sfAdminDash {

	public static function getItems()
	{
		return self::getProperty('items');
	}

	public static function getCategories()
	{
		$categories = self::getProperty('categories');

		return self::getProperty('categories');
	}

	public static function getProperty($val)
	{
		return sfConfig::get('app_sf_admin_dash_'.$val);
	}

	public static function hasPermission($item, $user)
	{
		if (!$user->isAuthenticated())
		{
			return true;
		}

		if (!key_exists('credentials', $item))
		{
			return true;
		}

		if ($user->hasCredential($item['credentials']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public static function getBreadcrumb($current_url)
	{
		$breadcrumb = array();
		$url_array = explode('/', $current_url);
		$categories = self::getCategories();
		
		foreach ($categories as $category_key => $category) {
			$breadcrumb['category'] = $category_key;
			foreach ($category['items'] as $item_key => $item) {
				$breadcrumb['item'] = $item_key;
				if (in_array($url_array[1], explode('/', $item['url']))) {
					return $breadcrumb;
				}
			}
		}
		
		return null;
	}
	
	public static function getItemImagePath($current_url)
	{
		$image_path = sfAdminDash::getProperty('image_dir') . 'start_here.png';
		if ($current_url == '/') {
			return $image_path;
		}
		$url_array = explode('/', $current_url);
		$categories = self::getCategories();
		
		foreach ($categories as $category_key => $category) {
			foreach ($category['items'] as $item_key => $item) {
				if (in_array($url_array[1], explode('/', $item['url']))) {
					if (isset($item['image'])) {
						$image_path = $item['image'];
						return sfAdminDash::getProperty('image_dir') . $image_path;
					} else {
						return sfAdminDash::getProperty('image_dir')
								. sfAdminDash::getProperty('default_image');
					}
				}
			}
		}
		
		return $image_path;
	}

}