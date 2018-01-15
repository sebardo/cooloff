<?php use_helper('Object') ?>

<div class="sf_admin_filters">
	<?php echo form_tag('accounting/list', array('method' => 'get')) ?>
		<fieldset>
    		<h2><?php echo __('filters') ?></h2>

	      	<div class="form-row form-row-top">
	        	<label for="filters_inscription_code" style="width:8em !important"><?php echo __('Codi inscripció:') ?></label>
	          	<div class="content">
	              	<?php echo input_tag('filters[inscription_code]', isset($filters['inscription_code']) ? $filters['inscription_code'] : null) ?>
	          	</div>

                <label for="filters_inscription_code" style="width:auto !important"><?php echo __('Activitat:') ?></label>
	          	<div class="content">
                    <?php echo select_tag('filters[student_course_inscription]', objects_for_select(CoursePeer::getCoursesByProfile(), 'getId', '__toString', isset($filters['student_course_inscription']) ? $filters['student_course_inscription'] : null, 'include_blank=true'), array('style' => 'min-width: 400px')); ?>
	          	</div>
	      	</div>
	      	
	      	<div class="form-row form-row-top">
     			
     			<label for="filters_father_dni" style="width:8em !important"><?php echo __('DNI:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[father_dni]', isset($filters['father_dni']) ? $filters['father_dni'] : null) ?>
          		</div>
     			
            	<label for="filters_father_name" style="width:auto !important"><?php echo __('Nom Tutor') ?>:</label>
          		<div class="content">
              		<?php echo input_tag('filters[father_name]', isset($filters['father_name']) ? $filters['father_name'] : null) ?>
          		</div>
          		
          		<label for="filters_father_primer_apellido" style="width:auto !important"><?php echo __('Cognom 1:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[father_primer_apellido]', isset($filters['father_primer_apellido']) ? $filters['father_primer_apellido'] : null) ?>
          		</div>
          		
          		<label for="filters_father_segundo_apellido" style="width:auto !important"><?php echo __('Cognom 2:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[father_segundo_apellido]', isset($filters['father_segundo_apellido']) ? $filters['father_segundo_apellido'] : null) ?>
          		</div>
          		
      		</div>
	      	
     		<div class="form-row form-row-top">
     			
            	<label for="filters_student_name" style="width:8em !important"><?php echo __('Nom Alumne:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[student_name]', isset($filters['student_name']) ? $filters['student_name'] : null) ?>
          		</div>
          		
          		<label for="filters_student_primer_apellido" style="width:auto !important"><?php echo __('Cognom 1:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[student_primer_apellido]', isset($filters['student_primer_apellido']) ? $filters['student_primer_apellido'] : null) ?>
          		</div>
          		
          		<label for="filters_student_segundo_apellido" style="width:auto !important"><?php echo __('Cognom 2:') ?></label>
          		<div class="content">
              		<?php echo input_tag('filters[student_segundo_apellido]', isset($filters['student_segundo_apellido']) ? $filters['student_segundo_apellido'] : null) ?>
          		</div>
          		
      		</div>
      		
      		<div class="form-row form-row-top">
          		<label for="filters_center" style="width:8em !important"><?php echo __('Centre Inscripció:') ?></label>
          		<div class="content">
		              <?php echo select_tag('filters[center]', options_for_select(SummerFunCenterPeer::getArrayCenters(), isset($filters['center']) ? $filters['center'] : null, 'include_blank=true')) ?>
          		</div>
	  		</div>
	  		
      		<div class="form-row form-row-top">
                <label for="filters_pagament" style="width:8em !important"><?php echo __('Pagament:') ?></label>
                <div class="content">
                    <?php

					$options = InscriptionPeer::getPaymentMethodFilterArray();

					for ($i = 0; $i < count($options); $i++) {
						$options[$i] = __($options[$i]);
					}

                    echo select_tag('filters[payment_method]', options_for_select($options, isset($filters['payment_method']) ? $filters['payment_method'] : null, array('include_blank' => true)));
                    ?>
                </div>

          		<label for="filters_pagament" style="width:auto !important"><?php echo __('Estat') ?>:</label>
          		<div class="content">
          			<?php 
          				$options = array(0 => __('Mostrar tots'), 1 => __('Mostrar pendents de pagament'));
          				echo select_tag('filters[pagament]', options_for_select($options, isset($filters['pagament']) ? $filters['pagament'] : null, array('include_blank' => false)));
          			?>
          		</div>

                <div class="content">
                    <?php echo input_date_range_tag('filters[payment_date]', isset($filters['payment_date']) ? $filters['payment_date'] : null, array('rich' => true, 'calendar_button_img' => '/sf/sf_admin/images/date.png', 'before' => ' ' . __('date_from') . ' ', 'middle' => ' ' . __('date_to') . ' ')) ?>
                </div>
	  		</div>
		</fieldset>
  		<ul class="sf_admin_actions">
    		<li><?php echo button_to(__('reset'), 'accounting/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    		<li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
    		<li><?php echo button_to(__('Exportar'), 'accounting/export', 'class=sf_admin_action_reset_filter sf_admin_action_excel') ?></li>
  		</ul>
	</form>
</div>
