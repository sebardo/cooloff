<?php if ($inscription->getStudentPhoto()): ?>
<img id="image-student" src="<?php echo sfConfig::get('app_inscripcion_imagen_directorio_template') . $inscription->getStudentPhoto() ?>" alt="photo"/>
<div class="sf_admin_filters" style="padding-left:78px">
	<ul class="sf_admin_actions" style="text-align:left">
		<li><input id="rotate-image" type="button" value="<?php echo __('Girar foto') ?>" class="sf_admin_action_reset_filter"></li>
		<li><input id="upload-image" type="button" value="<?php echo __('Pujar foto') ?>" class="sf_admin_action_filter"></li>
	</ul>
</div>
<?php endif ?>

<script type="text/javascript">
var rotateUrl = '<?php echo url_for('Inscription/rotateImage') ?>';
</script>
