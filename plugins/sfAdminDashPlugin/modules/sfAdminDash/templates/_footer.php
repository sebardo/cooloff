<br/><br/><br/>
<?php if (sfAdminDash::getProperty('has_ie6_warning')): 
echo '<!--[if lte IE 6]>' ?>
<script>
var msg1 = "<?php echo __("Did you know that your Internet Explorer is out of date?") ?>";
var msg2 = "<?php echo __("To get the best possible experience using our website we recommend that you upgrade to a newer version or other web browser. A list of the most popular web browsers can be found below.") ?>";
var msg3 = "<?php echo __("Just click on the icons to get to the download page") ?>";
</script>
<script src="/sfAdminDashPlugin/js/warning.js"></script>
<script>window.onload=function(){e("/sfAdminDashPlugin/images/ie6/")}</script>
<?php echo '<![endif]-->';
endif; ?>

<noscript>
  <div id="js_disabled" class="error">
    <?php echo __("Your browser's Javascript engine is disabled! Please enable it and reload this page before continuing.") ?>
  </div>
</noscript>

<div id='sf_admin_footer'>
  Copyright &copy; <?php echo date('Y') ?> <?php echo sfAdminDash::getProperty('site') ?>.
  <?php echo link_to(sfAdminDash::getProperty('site_url'), sfAdminDash::getProperty('site_url'), 'target=_blank') ?> 
  <?php echo __('All rights reserved')?>.
</div>
