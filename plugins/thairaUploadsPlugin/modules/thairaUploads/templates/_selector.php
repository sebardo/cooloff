<?php echo input_hidden_tag('thairaUploadsUids[]', $uid) ?>

<div class="thaira-uploads-selector"
		id="thaira-uploads-selector<?php echo $uid ?>">
	<div class="uploads" id="<?php echo 'uploads' . $uid ?>"
			style="<?php echo "min-height: {$selectorMinHeight}px; height: auto !important; height: {$selectorMinHeight}px;" ?>">
		<script type="text/javascript">
		<!--

		var config<?php echo $uid ?> = new thaira.uploads.Config({
			uid : '<?php echo $uid ?>',
			actionsUrl : '<?php echo url_for('thairaUploads/') ?>',

			uploadTemplate : <?php echo ThairaUploadsTools::newJsTemplate(get_partial(
					'thairaUploads/selector_upload',
					array('id' => '#{id}', 'title' => '#{title}',
						'url' => null, 'imgSrc' => '#{imgSrc}'))) ?>,

			editorTemplate : <?php echo ThairaUploadsTools::newJsTemplate(get_partial(
					'thairaUploads/selector_editor', array('fields' => $fields))) ?>,
			editorFields : <?php echo ThairaProjectTools::toJson($fields) ?>,

			validation : <?php echo ThairaProjectTools::toJson((array) $validation) ?>,

			i18n : {
				uploadRemoveAlertMsg : '<?php echo ThairaUploadsTools::__(
						'Are you sure you want to remove this item?') ?>',
				uploaderUploading : '<?php echo ThairaUploadsTools::__(
						'Uploading the file...') ?>'
			}
		});

		thaira.uploads.i18n.uploadRemoveAlertMsg = '<?php echo ThairaUploadsTools::__(
				'Are you sure you want to remove this item?') ?>';

		var uploadsManager<?php echo $uid ?> = new thaira.uploads.UploadsManager(
				config<?php echo $uid ?>);
		//-->
		</script>
		<?php foreach ($session->getFiles() as $i => $file): ?>
			<?php include_partial('thairaUploads/selector_upload', array(
					'id' => 'upload' . $uid . $i,
					'title' => $file->getTitle(),
					'is_protected' => $file->getIsProtected(),
					'password' => $file->getPassword(),
					'url' => $file->getWebPath(),
					'imgSrc' => $file->getThumbWebPath(80,70))); ?>
			<script type="text/javascript">
			<!--
			uploadsManager<?php echo $uid ?>.createAndAdd('<?php echo 'upload' . $uid . $i ?>',
					<?php echo $file->getId() ?>);
			//-->
			</script>
		<?php endforeach ?>
	</div>
	<div class="controls">
		<div class="operations">
			<?php echo button_to_function(ThairaUploadsTools::__('Add New File'),
					"uploadersManager{$uid}.generateAndAdd();",
					'class="button"') ?>
		</div>
		<div class="uploaders" id="<?php echo 'uploaders' . $uid ?>">
			
		</div>
	</div>
	<div class="editors">
		
	</div>
</div>

<script type="text/javascript">
<!--
var uploadersManager<?php echo $uid ?> = new thaira.uploads.UploadersManager('<?php echo $uid ?>',
		'<?php echo rawurlencode(get_partial('thairaUploads/selector_uploader')) ?>',
		uploadsManager<?php echo $uid ?>, config<?php echo $uid ?>);
//-->
</script>