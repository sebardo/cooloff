<?php

/**
 * Mark the start of a block that should only be shown in the browser if JavaScript
 * is switched on.
 */
function if_javascript_ut8() {
	ob_start();
}

/**
 * Mark the end of a block that should only be shown in the browser if JavaScript
 * is switched on.
 */
function end_if_javascript_ut8() {
	$content = ob_get_clean();
	$content = str_replace(
		array("\r", "\n", "'"),
		array('\r', '\n', "\\'"),
		$content
	);
	echo javascript_tag("document.write('" . $content . "');");
}