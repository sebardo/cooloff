<div id="#{id}" class="thaira-uploads-uploader">
	<?php echo form_tag(url_for('thairaUploads/upload', true)
			. '?index=#{index}&uid=#{uid}', 'target=#{iframeId} multipart=true') ?>
		<?php echo input_file_tag('file') ?>
		<br />
		<?php echo submit_tag(ThairaUploadsTools::__('Upload')) ?>
		<?php echo button_to_function(ThairaUploadsTools::__('Cancel'), 'false') ?>
	<?php echo '</form>' ?>
	<iframe name="#{iframeId}" style="display:none"></iframe>
</div>