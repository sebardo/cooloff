<?php
use_helper('I18N');

include_partial('sfAdminDash/header_top');

$breadcrumb = sfAdminDash::getBreadcrumb($sf_request->getPathInfo());
$module_image_path = sfAdminDash::getItemImagePath($sf_request->getPathInfo());
$statusCode = $sf_context->getResponse()->getStatusCode();
$moduleName = $sf_context->getModuleName();
$actionName = $sf_context->getActionName();
$hasSpecialStatus = in_array($statusCode, array(403, 404));
$hasSpecialActions = in_array($actionName, array('disabled', 'unavailable'));
$username = (sfAdminDash::getProperty('logout_url') == 'security/logout')? 
	sfConfig::get('app_security_user') : $sf_user;
?>

<?php if (($moduleName == 'sfGuardAuth' && $actionName == 'signin')
		|| ($moduleName == 'security' && $actionName == 'index')
		|| $statusCode == 401 || $hasSpecialActions): ?>

<?php else: ?>
<div id='sf_admin_menu'>    
  <?php include_component('sfAdminDash', 'menu') ?>
  
  <?php if (sfAdminDash::getProperty('logout') && ($sf_user->isAuthenticated())): ?>
    <div id="logout">
      <?php echo __('Welcome ') . ($sf_user instanceof sfGuardSecurityUser ? $sf_user : 'Admin') . '&nbsp;' 
      . link_to(image_tag(sfAdminDash::getProperty('web_dir').'/images/icon_toolbar/exit16.png', 
      		array('alt' => __('Logout'), 'title' => __('Logout'))), 
      	sfAdminDash::getProperty('logout_url')); ?>
    </div>
  <?php endif; ?>
  <div class="clear"></div>
</div>

<div id='sf_admin_path'>
  <strong>
  	<a href='<?php echo url_for('@homepage') ?>'>
  		<?php echo sfAdminDash::getProperty('site') ?>
  	</a>
  </strong> /

  <?php if ($actionName != 'dashboard' && !$hasSpecialStatus && !$hasSpecialActions): ?>
    <?php echo __($breadcrumb['category']) ?> / 
    <?php echo __($breadcrumb['item']) ?> /  
    <strong><?php echo __($sf_context->getActionName()) ?></strong>
  <?php endif; ?>
</div>

<?php if (!$hasSpecialStatus && !$hasSpecialActions) { 
	echo image_tag($module_image_path, array('class' => 'module-image')); 
} ?>

<?php endif; ?>
