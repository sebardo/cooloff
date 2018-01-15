<?php 
if ($type == 'edit'){
	use_helper('Object');
	$userId = $sf_user->getAttribute('sf_guard_user[Id]');
	$sf_guard_user = ($userId)? sfGuardUserPeer::retrieveByPK($userId) : new sfGuardUser();
	
	$value = object_admin_check_list($sf_guard_user, 'getPermissions', array (
		  'control_name' => 'sf_guard_user[permissions]',
		  'through_class' => 'sfGuardUserPermission'));
	?>
	<div class="<?php if ($sf_request->hasError('sf_guard_user{permissions}')): ?> form-error<?php endif; ?>">
	<?php if ($sf_request->hasError('sf_guard_user{permissions}')): ?>
    <?php echo form_error('sf_guard_user{permissions}', array('class' => 'form-error-msg')) ?>
  	<?php endif;?>
	<?php echo $value ? $value : '&nbsp;';?>
	</div>
	<?php
} elseif($type == 'list') {
	$sf_guard_user = sfGuardUserPeer::retrieveByPK($sf_guard_user_profile->getUserId());
	foreach ($sf_guard_user->getPermissions() as $p){
		echo $p->getName() . '<br />';
	}
}
?>
