<div class="upload" id="<?php echo $id ?>">
	<div class="image-cont">
		<?php if($url): ?>
			<a href="<?php echo $url ?>" target="_blank">
				<img alt="" src="<?php echo $imgSrc ?>" />
			</a>
		<?php else: ?>
			<img alt="" src="<?php echo $imgSrc ?>" />
		<?php endif; ?>
	</div>
	<div class="title">
		<?php echo $title ?>
	</div>
	<div class="buttons">
		<?php echo button_to_function('<', '', 'class="move-left" title="' . ThairaUploadsTools::__('Move left') . '"') ?>
		<?php echo button_to_function('E', '', 'class="edit" title="' . ThairaUploadsTools::__('Edit') . '"') ?>
		<?php echo button_to_function('D', '', 'class="remove" title="' . ThairaUploadsTools::__('Remove') . '"') ?>
		<?php echo button_to_function('>', '', 'class="move-right" title="' . ThairaUploadsTools::__('Move right') . '"') ?>
	</div>
</div>