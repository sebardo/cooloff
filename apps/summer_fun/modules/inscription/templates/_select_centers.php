<?php use_helper('Object'); ?>
<select name="<?php echo $name ?>" id="<?php echo $name ?>">

    <option value="" selected>- <?php echo __('registration.trans63') ?> - </option>


    <?php foreach ($centers as $center){?>

        <?php if ($center->getTitle() != ''){ ?>

        <option value="<?php echo $center->getId() ?>"><?php echo $center->getTitle() ?></option>


        <?php } ?>
    <?php } ?>


</select>
<?php if ($sf_request->hasError('centre')): ?>
<p class="validation-error" style="margin-left:150px">&uarr; <?php echo $sf_request->getError('centre') ?> &uarr;</p>
<?php endif ?>
