<?php if ($show){

    $class="mostrar";


}else{
    $class="ocultar";

}?>

<div id="fathers<?php echo $id?>" class="<?php echo $class ?>">

<div class="father">
    <h3><?php echo __('registration.trans131')?></h3>

    <?php include_partial('text_field', array('field_name' => 'fatherName' . $id, 'field_label' => __('registration.trans160')  . ":", 'obligatori' => true, 'class_input'=>'widthParents'));?>
    <?php include_partial('text_field', array('field_name' => 'fatherPrimerApellido' . $id, 'field_label' => __('registration.trans161')  . ":", 'obligatori' => true, 'class_input'=>'widthParents'));?>
<?php if ($sf_user->getCulture() != 'fr'): ?>
    <?php include_partial('text_field', array('field_name' => 'fatherSegundoApellido' . $id, 'field_label' => __('registration.trans162')  . ":", 'obligatori' => false, 'class_input'=>'widthParents'));?>
<?php endif ?>
    <?php include_partial('text_field', array('field_name' => 'fatherPhone' . $id, 'field_label' => __('registration.trans66'), 'obligatori' => true, 'class_input'=>'widthParents'));?>
    <?php include_partial('text_field', array('field_name' => 'fatherDni' . $id, 'field_label' => __('registration.trans19'), 'obligatori' => true, 'class_input'=>'widthParents'));?>

    <?php include_partial('mail_field', array('field_name' => 'fatherMail' . $id, 'field_label' => __('registration.trans132'), 'obligatori' => true, 'class'=>'widthParents'));?>


    <?php if ($sf_request->hasError('mailPrincipal' .$id)): ?>
    <p class="validation-error" style="margin-left: 145px;">&uarr; <?php echo $sf_request->getError('mailPrincipal' .$id) ?> &uarr;</p>
    <?php endif ?>


</div>
<div class="mother">
    <h3><?php echo __('registration.trans131')?></h3>

    <?php include_partial('text_field', array('field_name' => 'motherName' . $id, 'field_label' => __('registration.trans160')  . ":", 'obligatori' => false, 'class_input'=>'widthParents'));?>
    <?php include_partial('text_field', array('field_name' => 'motherPrimerApellido' . $id, 'field_label' => __('registration.trans161')  . ":", 'obligatori' => false, 'class_input'=>'widthParents'));?>
<?php if ($sf_user->getCulture() != 'fr'): ?>
    <?php include_partial('text_field', array('field_name' => 'motherSegundoApellido' . $id, 'field_label' => __('registration.trans162')  . ":", 'obligatori' => false, 'class_input'=>'widthParents'));?>
<?php endif ?>
    <?php include_partial('text_field', array('field_name' => 'motherPhone' . $id, 'field_label' => __('registration.trans66'), 'obligatori' => false, 'class_input'=>'widthParents'));?>
    <?php include_partial('text_field', array('field_name' => 'motherDni' . $id, 'field_label' => __('registration.trans19'), 'obligatori' => false, 'class_input'=>'widthParents'));?>

    <?php include_partial('mail_field', array('field_name' => 'motherMail' . $id, 'field_label' => __('registration.trans132'), 'obligatori' => false, 'class'=>'widthParents'));?>
</div>

</div>