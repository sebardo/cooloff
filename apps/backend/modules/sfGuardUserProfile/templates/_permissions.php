<?php
	$criteria = new Criteria();
	if (! $sf_user->getGuardUser()->getIsSuperAdmin()) {
  		$criteria->add(sfGuardPermissionPeer::NAME, 'thaira', Criteria::NOT_EQUAL);
  	}
  	$permissions = sfGuardPermissionPeer::doSelect($criteria);
  	$fpermissions = isset($filters['permissions']) ? $filters['permissions'] : array();
?>
<span class="permissions_filter">
<?php foreach ($permissions as $permission): ?>
  <div class="permissions_filter_group">
  <?php
    echo checkbox_tag('filters[permissions][]', 
      $permission->getId(), in_array($permission->getId(), $fpermissions));
  ?>
    <span class="permissions_filter_group_label">
    <?php echo $permission->getName(); ?>
    </span>
  </div>
<?php endforeach ?>
</span>
