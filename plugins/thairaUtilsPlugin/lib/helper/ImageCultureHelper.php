<?php

function image_culture_tag($source, $options)
{

	$culture = sfContext::getInstance()->getUser()->getCulture();
	$image_path = SF_ROOT_DIR . '/web/images/' . $culture . '/' . $source;

	if (file_exists($image_path)) return image_tag ($culture . '/' . $source, $options);
	else return $source;

}

function submit_image_culture_tag($source, $options)
{

	$culture = sfContext::getInstance()->getUser()->getCulture();
	$image_path = SF_ROOT_DIR . '/web/images/' . $culture . '/' . $source;

	if (file_exists($image_path)) return submit_image_tag ($culture . '/' . $source, $options);
	else return submit_tag($source, $options);

}