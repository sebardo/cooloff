<div id="header">
    <div class="logo">
        <h1>
            <?php echo image_link('summer_fun/logos/logo.png', '@index', array('alt' => 'Kidsandus'), array('title' => 'Kidsandus')); ?>
        </h1>
    </div>
    <div id="idiomes"><?php echo link_to("català", '@index_ca', array('title' => "versió en català")) ?> | <?php echo link_to("español", '@index_es', array('title' => "versión en español")) ?> | <?php echo link_to("english", '@index_en', array('title' => "english version")) ?> | <?php echo link_to("italiano", '@index_it', array('title' => "versione italiana")) ?></div>
    <?php //include_partial('global/navigation'); ?>
</div>