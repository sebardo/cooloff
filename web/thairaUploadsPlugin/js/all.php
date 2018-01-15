<?php

header('Content-Type: text/javascript');

$files = array(
	'main.js',
	'Config.js',
	'Upload.js',
	'Uploader.js',
	'UploadersManager.js',
	'UploadsManager.js',
	'Editor.js',
);

foreach ($files as $file) {
	readfile($file);
	echo "\n\n";
}