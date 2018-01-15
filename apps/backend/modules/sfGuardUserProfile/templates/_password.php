<?php
if ($sf_request->hasError('sf_guard_user{password}')) {
	echo '<div class="form-error">';
	echo form_error('sf_guard_user{password}', array('class' => 'form-error-msg'));
}

echo input_password_tag('sf_guard_user[password]', '', array('control_name' => 'sf_guard_user[password]'));

if ($sf_request->hasError('sf_guard_user{password}')) {
	echo '</div>';
}
?>
