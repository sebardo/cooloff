<?php use_helper('Object') ?>
<div class="sf_admin_filters">
    <?php echo form_tag('Inscription/list', array('method' => 'get')) ?>
        <fieldset>
            <h2><?php echo __('filters') ?></h2>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Centre Inscripció:') ?></label>
                <div class="content">
                    <?php echo select_tag('filters[centers]',
                        options_for_select(SummerFunCenterPeer::getArrayCenters(),
                            isset($filters['centers']) ? $filters['centers'] : null,
                            'include_blank=true')
                    ) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Centre de procedència:') ?></label>
                <div class="content">
                    <?php echo select_tag('filters[kids_and_us_center_id]',
                        options_for_select(KidsAndUsCenterPeer::getArrayCenters(),
                            isset($filters['kids_and_us_center_id']) ? $filters['kids_and_us_center_id'] : null,
                            'include_blank=true')
                    ) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_category"><?php echo __('Codi inscripció:') ?></label>
                <div class="content">
                    <?php echo input_tag('filters[inscription_code]', isset($filters['inscription_code']) ? $filters['inscription_code'] : null) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_category"><?php echo __('Nom:') ?></label>
                <div class="content">
                    <?php echo input_tag('filters[student_name]', isset($filters['student_name']) ? $filters['student_name'] : null) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_category"><?php echo __('Cognom 1:') ?></label>
                <div class="content">
                    <?php echo input_tag('filters[student_primer_apellido]', isset($filters['student_primer_apellido']) ? $filters['student_primer_apellido'] : null) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_category"><?php echo __('Cognom 2:') ?></label>

                <div class="content">
                    <?php echo input_tag('filters[student_segundo_apellido]', isset($filters['student_segundo_apellido']) ? $filters['student_segundo_apellido'] : null) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Estat inscripció:') ?></label>
                <div class="content">
                    <?php

                    $items = InscriptionPeer::getStatesNames();

                    for ($i = 0; $i < count($items); $i++) {
                        $items[$i] = __($items[$i]);
                    }

                    echo select_tag('filters[state]',
                        options_for_select($items,
                            isset($filters['state']) ? $filters['state'] : null,
                            'include_blank=true')
                    ) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Estat pagament:') ?></label>
                <div class="content">
                    <?php

                    $items = InscriptionPeer::getIsPaidNames();

                    for ($i = 0; $i < count($items); $i++) {
                        $items[$i] = __($items[$i]);
                    }

                        echo select_tag('filters[is_paid]',
                        options_for_select($items,
                            isset($filters['is_paid']) ? $filters['is_paid'] : null,
                            'include_blank=true')
                    ) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Forma de pagament:') ?></label>
                <div class="content">
                    <?php

                    $items = InscriptionPeer::getMethodPaymentNames();

                    for ($i = 0; $i < count($items); $i++) {
                        $items[$i] = __($items[$i]);
                    }

                    echo select_tag('filters[method_payment]',
                        options_for_select($items,
                            isset($filters['method_payment']) ? $filters['method_payment'] : null,
                            'include_blank=true')
                    ) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Setmanes:') ?></label>
                <div>
                    <?php $weeks = CoursePeer::getArrayWeeksForInscriptionFilter() ?>
                    <select id="filters_week" name="filters[week][]" multiple style="width:100%;min-height:150px">
                        <option value=""></option>
                        <?php foreach ($weeks as $week): ?>

                            <?php
                                $selected = '';
                                if (isset($filters['week'])) {
                                    foreach ($filters['week'] as $weekFilter) {
                                       if ($weekFilter == $week['id']) {
                                           $selected = 'selected';
                                           break;
                                       }
                                    }
                                }
                            ?>

                            <option value="<?php echo $week['id'] ?>" data-centro="<?php echo $week['centro'] ?>" <?php echo $selected ?>><?php echo $week['nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php //echo select_tag('filters[week]', options_for_select(WeekPeer::getArrayWeeks(), isset($filters['week']) ? $filters['week'] : null, 'include_blank=false'), array("multiple" => true, 'style' => 'width:100%;min-height:150px')) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Grup:') ?></label>
                <div class="content">
                    <?php $groups = GrupoPeer::getArrayGrupos() ?>
                    <select id="filters_grupo_id" name="filters[grupo_id]">
                        <option value=""></option>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?php echo $group['id'] ?>" data-centro="<?php echo $group['centro'] ?>" <?php echo isset($filters['grupo_id']) && $group['id'] == $filters['grupo_id'] ? 'selected' : '' ?>><?php echo $group['nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php //echo select_tag('filters[grupo_id]', options_for_select(GrupoPeer::getArrayGrupos(), isset($filters['grupo_id']) ? $filters['grupo_id'] : null, 'include_blank=true')) ?>
                </div>

                <label for="filters_advertisement_type" style="width: 7em !important; margin-top: 10px"><?php echo __('no_group') ?>:</label>
                <div class="content" style="margin-top: 14px;">
                    <input type="checkbox" name="filters[grupo_id_is_empty]" <?php echo isset($filters['grupo_id_is_empty']) ? 'checked' : '' ?>/>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_advertisement_type"><?php echo __('Professor:') ?></label>
                <div class="content">

                    <?php $teachers = ProfesorPeer::getArrayProfesores() ?>
                    <select id="filters_profesor_id" name="filters[profesor_id]">
                        <option value=""></option>
                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?php echo $teacher['id'] ?>" data-centro="<?php echo $teacher['centro'] ?>" <?php echo isset($filters['profesor_id']) && $teacher['id'] == $filters['profesor_id'] ? 'selected' : '' ?>><?php echo $teacher['nombre'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <?php //echo select_tag('filters[profesor_id]', options_for_select(ProfesorPeer::getArrayProfesores(), isset($filters['profesor_id']) ? $filters['profesor_id'] : null, 'include_blank=true')) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_is_student_disability"><?php echo __('Té alguna discapacitat?:') ?></label>
                <div class="content">
                    <?php echo select_tag('filters[is_student_disability]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['is_student_disability']) ? $filters['is_student_disability'] : null, array(
                        'include_custom' => __("yes or no"),
                    )), array()) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_student_allergies"><?php echo __('Té alguna al·lèrgia?:') ?></label>
                <div class="content">
                    <?php echo select_tag('filters[student_allergies]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['student_allergies']) ? $filters['student_allergies'] : null, array(
                        'include_custom' => __("yes or no"),
                    )), array()) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_student_allergies"><?php echo __('registration.vaccinated') ?>:</label>
                <div class="content">
                    <?php echo select_tag('filters[is_vaccinated]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['is_vaccinated']) ? $filters['is_vaccinated'] : null, array(
                        'include_custom' => __("yes or no"),
                    )), array()) ?>
                </div>
            </div>

            <div class="form-row">
                <label for="filters_student_allergies"><?php echo __('Data de naixement:') ?></label>
                <div class="content">
                    <?php echo input_date_range_tag('filters[student_birth_date]', isset($filters['student_birth_date']) ? $filters['student_birth_date'] : null, array('rich' => true, 'calendar_button_img' => '/sf/sf_admin/images/date.png')) ?>
                </div>
            </div>

            <input type="hidden" name="filters[csv-export]" value="true"/>
        </fieldset>
        <ul class="sf_admin_actions">
            <li><?php echo button_to(__('reset'), 'Inscription/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
            <li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
        </ul>
    </form>
</div>
