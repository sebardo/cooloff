<?php use_helper('I18N') ?>

<div id="NotificationContainer">
	<div class="sfTMessageContainer sfTAlert"> 
	  <?php echo image_tag('/sf/sf_default/images/icons/disabled48.png', array('alt' => 'module disabled', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
	  <div class="sfTMessageWrap">
	    <h1><?php echo __('This Module is Unavailable') ?></h1>
	    <h5><?php echo __('This module has been disabled by a site administrator.') ?></h5>
	  </div>
	</div>
	<dl class="sfTMessageInfo">
	
	  <dt><?php echo __("What's next") ?></dt>
	  <dd>
	    <ul class="sfTIconList">
	      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)"><?php echo __('Back to previous page') ?></a></li>
	      <li class="sfTLinkMessage"><?php echo link_to(__('Go to Homepage'), '@homepage') ?></li>
	    </ul>
	  </dd>
	</dl>
</div>