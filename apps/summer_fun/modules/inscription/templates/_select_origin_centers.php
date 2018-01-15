<?php use_helper('Object'); ?>
<select name="<?php echo $name ?>" id="<?php echo $name ?>" class="origin_center">
    <option value="" selected><?php echo __('registration.trans6') ?></option>
    <?php foreach ($centers as $center): ?>
        <option value="<?php echo $center->getId() ?>"><?php echo $center->getName() ?></option>
    <?php endforeach ?>
</select>

