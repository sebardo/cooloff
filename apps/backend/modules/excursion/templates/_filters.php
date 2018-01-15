<?php use_helper('Object') ?>

<div class="sf_admin_filters">
	<?php echo form_tag('excursion/list', array('method' => 'get')) ?>
		<fieldset>
    		<h2><?php echo __('filters') ?></h2>
      		<div class="form-row">
          		<label for="filters_advertisement_type"><?php echo __('Centre:') ?></label>
          		<div class="content">
              		<?php echo select_tag('filters[centro_id]', options_for_select(SummerFunCenterPeer::getArrayCentrosFiltro(), isset($filters['centro_id']) ? $filters['centro_id'] : null, 'include_blank=true')) ?>
          		</div>
      		</div>
		</fieldset>
  		<ul class="sf_admin_actions">
    		<li><?php echo button_to(__('reset'), 'excursion/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    		<li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
  		</ul>
	</form>
</div>