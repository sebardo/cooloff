<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>

<body>
<?php
$module = $sf_params->get('module');
$action = $sf_params->get('action');

?>
  <?php include_partial('sfAdminDash/header') ?>

  <?php if ($module=='Inscription' && $action=='list' && false) {

      ?>  <a onclick="f = document.createElement('form'); document.body.appendChild(f); f.method = 'POST'; f.action = this.href; f.submit();return false;"  class="exportar" href="<?php echo isset($filters["csv-export-link"]) ?  $filters["csv-export-link"] : url_for('@export', array('id'=>'all' ))?>"> <?php echo __('Exportar') ?></a>

<input type="hidden" name="ids" value="<?php echo isset($filters["csv-export-link"]) ? $filters["csv-export-link"] : '' ?>" />


    <?php }
  ?>
  <?php echo $sf_data->getRaw('sf_content') ?>
  <?php include_partial('sfAdminDash/footer') ?>
</body>

</html>
