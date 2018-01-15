<?php if (!isset($size)) $size=null;?>
<?php $obligat = ""; ?>
<?php if ($obligatori == true) $obligat = "*"; ?>

<div class="student_field">

    <?php echo label_for($field_name, $obligat . $field_label) ?>

    <?php echo input_tag($field_name, null, array('class' => $class .' mail','size'=>$size)) ?>
    <?php if ($sf_request->hasError($field_name)): ?>
    <p class="validation-error">&uarr; <?php echo $sf_request->getError($field_name) ?> &uarr;</p>
    <?php endif ?>
    <div style="margin:10px 0;" >
    <?php echo label_for($field_name, $obligat . __('registration.trans153')) ?>
    <?php echo input_tag($field_name .'Validation', null, array('class' => $class .' mail','size'=>$size)) ?>
<!--    <span class="remail">--><?php //echo __('Re-introdueix l\'Email')?><!--</span>-->

    <?php if ($sf_request->hasError($field_name .'Validation')): ?>
    <p class="validation-error">&uarr; <?php echo $sf_request->getError($field_name .'Validation') ?> &uarr;</p>
    <?php endif ?>
</div>
    <div class="mail_principal">
         <?php echo checkbox_tag($field_name .'Principal', 1) ?>

        <div><?php echo $obligat.  __('registration.trans137') ?></div>
    </div>
</div>