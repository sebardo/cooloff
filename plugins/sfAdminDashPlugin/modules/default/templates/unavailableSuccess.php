<?php use_helper('I18N') ?>

<div id="NotificationContainer">
	<div class="sfTMessageContainer sfTAlert"> 
	  <?php echo image_tag('/sf/sf_default/images/icons/tools48.png', array('alt' => 'website unavailable', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
	  <div class="sfTMessageWrap">
	    <h1><?php echo __('Website Currently Unavailable') ?></h1>
	    <h5><?php echo __('This website has been temporarily disabled. Please try again later.') ?></h5>
	  </div>
	</div>
</div>