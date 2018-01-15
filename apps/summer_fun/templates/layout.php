<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>

        <?php include_http_metas() ?>
        <?php include_metas() ?>

        <?php include_title() ?>

        <link rel="shortcut icon" href="/favicon.ico"/>
        <?php include_partial('global/analytics') ?>
    </head>
<body>
    <div id="background_wrap"></div>
    <div id="container">
        <?php include_partial('global/header'); ?>
        <?php echo $sf_data->getRaw('sf_content') ?>
        <?php include_partial('global/footer'); ?>
    </div>
    <script language="javascript">
        <!--
        //initCorners();
        jQuery(function ($) {
            $.supersized({
                slides: [{image: '/images/summer_fun/backgrounds/fons-home.jpg', title: ''}]
            });
        });
        //-->
    </script>
</body>
</html>
