<?php use_helper('I18N') ?>

<div id="NotificationContainer">
	<div class="sfTMessageContainer sfTLock"> 
	  <?php echo image_tag('/sfAdminDashPlugin/images/icon_toolbar/lock48.png', array('alt' => 'credentials required', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
	  <div class="sfTMessageWrap">
	    <h1><?php echo __("Credentials Required") ?></h1>
	    <h5><?php echo __('This page is in a restricted area.') ?></h5>
	  </div>
	</div>
	
	<dl class="sfTMessageInfo">
	  <dt><?php echo __("You do not have the proper credentials to access this page") ?></dt>
	  <dd><?php echo __("Even though you are already logged in, this page requires special credentials that you currently don't have.") ?></dd>
	
	  <dt><?php echo __("How to access this page") ?></dt>
	  <dd><?php echo __("You must ask a site administrator to grant you some special credentials.") ?></dd>
	
	  <dt><?php echo __("What's next") ?></dt>
	  <dd>
	    <ul class="sfTIconList">
	      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)"><?php echo __('Back to previous page') ?></a></li>
	      <li class="sfTLinkMessage"><a href="<?php echo url_for('@sf_guard_signout') ?>"><?php echo __('Logout and enter again') ?></a></li>
	    </ul>
	  </dd>
	</dl>
</div>
