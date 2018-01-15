<form id="form-photo" action="<?php echo url_for('Inscription/uploadImage') ?>" enctype="multipart/form-data" method="post" style="display:none">
	<input type="file" id="studentPhoto" value="" name="studentPhoto" accept="image/*">
	<input type="hidden" name="id" value="<?php echo $inscription->getId() ?>">
</form>
