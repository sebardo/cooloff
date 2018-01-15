<?php
$sort = $sf_user->getAttribute('sort', null, 'sf_admin/summer_fun_zone/sort');
$type = $sf_user->getAttribute('type', 'asc', 'sf_admin/summer_fun_zone/sort');

$url = url_for('summer_fun_zone/list?sort=title_ca&type=' . ($type == 'asc' ? 'desc' : 'asc'));
$title = __('Títol') . ($sort == 'title_ca' ? " ($type)" : '');
?>

<script type="text/javascript">
<!--
jQuery(function($) {
    $('#sf_admin_list_th_title_ca').html('<a href="<?php echo $url; ?>"><?php echo $title; ?></a>');
});
//-->
</script>