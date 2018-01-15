<?php 
$web_dir = sfAdminDash::getProperty('web_dir');
$theme = sfAdminDash::getProperty('theme');
use_stylesheet($web_dir.'/css/default.css', 'first');
if ($theme != 'default') {
	use_stylesheet($web_dir.'/css/'.$theme.'.css', 'first');
}

if (sfAdminDash::getProperty('include_jquery')) {
	use_javascript(sfAdminDash::getProperty('web_dir').'/js/jquery-1.3.1.min.js', 'first');
}
use_javascript(sfAdminDash::getProperty('web_dir').'/js/sf_admin_dash', 'first');
?>

<div id='sf_admin_theme_header'>
  <span id="title"><?php echo sfAdminDash::getProperty('site') ?></span>
  <span id="subtitle">
    <a href='<?php echo url_for('@homepage') ?>'>
      <?php echo __('Administration') ?>
    </a>
  </span>
</div>