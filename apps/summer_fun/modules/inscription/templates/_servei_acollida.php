<?php if (isset($center)) { ?>
<div style="width:380px; height:20px; display:block;">

    <?php if ($center->getMorningShelter() ){?>

        <div class="acollida_mati">
            <?php echo checkbox_tag('studentServeiAcollidaMati'.$id, 1, false) ?>
            <span><?php echo __('registration.trans94') ?><?php echo $sf_user->getCulture() == 'fr' ? ' (8h15 à 9h)' : '' ?></span>
        </div>


    <?php } ?>


    <?php if ($center->getAfternoonShelter() ){?>
        <div class="acollida_tarde">
            <?php echo checkbox_tag('studentServeiAcollidaTarde'.$id, 1, false) ?>
            <span><?php echo __('registration.trans95') ?><?php echo $sf_user->getCulture() == 'fr' ? ' (16h30 à 18h)' : '' ?></span>
        </div>


    <?php } ?>

</div>
<?php if ($center->getHasShelterCharged()) {
?>
<div> <?php echo __('registration.trans106', array('%preu%'=>$center->getShelterPrice())); ?>
</div>
<?php

}

    echo $center->getTextShelter();
}?>
