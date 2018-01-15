<?php if (!isset($default)) $default=null;?>
<?php if (!isset($size)) $size=null;?>
<?php if (!isset($class)) $class=null;?>
<?php if (!isset($class_input)) $class_input=null;?>


<?php $obligat = ""; ?>
<?php if ($obligatori == true) $obligat = "*"; ?>

<div class="student_field">
<?php echo label_for($field_name, $obligat . $field_label, array('class'=>$class)) ?>

	<?php echo input_tag($field_name,$default, array('class' => $class_input,'size'=>$size)) ?>
	<?php if (isset($help)): ?>
	<span> (<?php echo $help ?>)</span>
	<?php endif ?>
	<?php if ($sf_request->hasError($field_name)): ?>
		<p class="validation-error">&uarr; <?php echo $sf_request->getError($field_name) ?> &uarr;</p>
	<?php endif ?>
</div>