function tinyHandleEventCallback(e) {
	// Disable paste
	if (e.type == 'paste') {
		alert('Por favor, utilitze el boton "Pegar como texto plano"');
		return false;
	}
	return true;
}

// Init tiny mce

tinyMCE.init({
	mode : 'textareas',
	editor_selector : 'rich',
	theme : 'advanced',
	language : 'es',
	skin : "o2k7",
	skin_variant : "silver",
	plugins : 'paste',
	paste_use_dialog : true,
	handle_event_callback : 'tinyHandleEventCallback',
	theme_advanced_buttons1 : 'bold, italic, numlist, bullist, link, unlink, |, removeformat, undo, redo, |, pastetext',
	theme_advanced_buttons2 : '',
	theme_advanced_buttons3 : '',
	theme_advanced_toolbar_location : 'top',
	theme_advanced_toolbar_align : 'left',
	theme_advanced_statusbar_location : 'bottom',
	theme_advanced_resizing : true,
	theme_advanced_resize_horizontal : false,
	cleanup : true,
	cleanup_on_startup : true,
	verify_html : true
});