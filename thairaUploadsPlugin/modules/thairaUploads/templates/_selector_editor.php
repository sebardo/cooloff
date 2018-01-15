<?php
$showLangSep = false;
if ((in_array('title', $fields) || in_array('description', $fields))
		&& count(sfConfig::get('app_thaira_uploads_cultures')) > 1) {
	$showLangSep = true;
}
?>

<div class="editor">
	<label>
		<b><?php echo ThairaUploadsTools::__('Filename') ?></b>
		<input name="filename" readonly="readonly" value="" class="disabled" />
	</label>

	<?php if ($showLangSep): ?>
	<hr />
	<?php endif ?>

	<label style="<?php echo (count(sfConfig
			::get('app_thaira_uploads_cultures')) == 1 ? 'display:none' : '') ?>">
		<b><?php echo ThairaUploadsTools::__('Language Selector') ?></b>
		<?php echo select_tag('langs', options_for_select(
				ThairaUploadsTools::getLangsOptionsForSelect(),
				sfConfig::get('app_thaira_uploads_default_culture')), 'size=3') ?>
	</label>

	<?php if (in_array('title', $fields)): ?>
		<label>
			<b><?php echo ThairaUploadsTools::__('Title') ?></b>
			<input name="title" value="" />
		</label>
	<?php endif ?>
	
	<?php if (in_array('is_protected', $fields)): ?>
		<label>
			<b><?php echo ThairaUploadsTools::__('Protected') ?></b>
			<input type="checkbox" name="is_protected" value="">
		</label>
	<?php endif ?>
	
	<?php if (in_array('password', $fields)): ?>
		<label>
			<b><?php echo ThairaUploadsTools::__('Password') ?></b>
			<input name="password" value="" />
		</label>
	<?php endif ?>

	<?php if (in_array('description', $fields)): ?>
		<label>
			<b><?php echo ThairaUploadsTools::__('Description') ?></b>
			<textarea name="description" rows="4" cols="10"></textarea>
		</label>
	<?php endif ?>

	<?php if ($showLangSep): ?>
	<hr />
	<?php endif ?>

	<?php if (in_array('tags', $fields)): ?>
		<label>
			<b><?php echo ThairaUploadsTools::__('Tags (coma separted)') ?></b>
			<input name="tags" value="" />
		</label>
	<?php endif ?>

	<div class="operations">
		<?php echo tag('input', 'type=button value="' . ThairaUploadsTools::__('Ok') . '"') ?>
		<?php echo tag('input', 'type=button value="' . ThairaUploadsTools::__('Cancel') . '"') ?>
	</div>
</div>