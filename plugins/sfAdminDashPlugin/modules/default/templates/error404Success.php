<?php use_helper('I18N') ?>

<div id="NotificationContainer">
	<div class="sfTMessageContainer sfTAlert"> 
	  <?php echo image_tag('/sf/sf_default/images/icons/cancel48.png', array('alt' => 'page not found', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
	  <div class="sfTMessageWrap">
	    <h1><?php echo $message ?></h1>
	    <h5><?php echo __('The server returned a 404 response.') ?></h5>
	  </div>
	</div>
	
	<dl class="sfTMessageInfo">
	  <dt><?php echo __('Did you type the URL?') ?></dt>
	  <dd><?php echo __("You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization, etc.") ?></dd>

	  <?php if (sfConfig::get('app_default_templates_email_enabled')): ?>	
	  <dt><?php echo __('Did you follow a link from somewhere else at this site?') ?></dt>
	  <dd><?php echo __('If you reached this page from another part of this site, please email us at [[1]] so we can correct our mistake.',
	  		array('[1]' => mail_to(sfConfig::get('app_default_templates_404_email_1', 'test@test.es')))) ?>
	  </dd>
	
	  <dt><?php echo __('Did you follow a link from another site?') ?></dt>
	  <dd><?php echo __('Links from other sites can sometimes be outdated or misspelled. Email us at [[1]] where you came from and we can try to contact the other site in order to fix the problem.',
	  		array('[1]' => mail_to(sfConfig::get('app_default_templates_404_email_2', 'test@test.es')))) ?>
	  </dd>
	  <?php endif; ?>
	  
	  <dt><?php echo __("What's next") ?></dt>
	  <dd>
	    <ul class="sfTIconList">
	      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)"><?php echo __('Back to previous page') ?></a></li>
	      <li class="sfTLinkMessage"><?php echo link_to(__('Go to Homepage'), '@homepage') ?></li>
	    </ul>
	  </dd>
	</dl>
</div>