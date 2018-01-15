<?php if ($show){

    $class="mostrar";


 }else{
    $class="ocultar";

}?>

<div id="student<?php echo $id?>" class="<?php echo $class ?>">
    <h3><?php echo __('registration.trans48') . ' ' . $id ?></h3>

    <div class="setmanes_acollida">
        <div class="setmanes">
            <?php if (count($centers)): ?>
            <p><?php echo __('registration.trans49')?>:</p>
            <div class="setmanes_preu<?php echo $id?>">
                <?php if($error) {?>
                <?php  include_partial('weeks', array('courses' => $courses,'id'=>$id,'centre'=>$center)); ?>
                <?php } ?>
            </div>
            <?php else: ?>
                <p><strong><?php echo __('registration.trans243') ?></strong></p>
            <?php endif ?>
        </div>
    </div>

    <div class="student_data">
    	
    	<div class="profile-image">
			<img id="profile-image<?php echo $id ?>" src="/images/summer_fun/profile-placeholder.png"/>
			<a id="link-profile-image<?php echo $id ?>" href=""><?php echo __('registration.trans194') ?></a>
			<a id="link-profile-help<?php echo $id ?>" href=""><?php echo __('registration.trans204') ?></a>
			<div id="profile-image-error<?php echo $id?>" class="error"><?php if ($sf_request->hasError('studentPhoto' . $id)): ?>&uarr; <?php echo $sf_request->getError('studentPhoto' . $id) ?> &uarr;<?php endif ?></div>
		</div>
    
        <?php include_partial('text_field', array('field_name' => 'studentName' . $id, 'field_label' => __('registration.trans160') . ":", 'obligatori' => true, 'class'=>'prova','size'=>50));?>
        <?php include_partial('text_field', array('field_name' => 'studentPrimerApellido' . $id, 'field_label' => __('registration.trans161')  . ":", 'obligatori' => true, 'class'=>'prova','size'=>50));?>
<?php if ($sf_user->getCulture() != 'fr'): ?>
        <?php include_partial('text_field', array('field_name' => 'studentSegundoApellido' . $id, 'field_label' => __('registration.trans162')  . ":", 'obligatori' => true, 'class'=>'prova','size'=>50));?>
<?php endif ?>

        <div class="student_field">

       <label><?php echo '*'.__('registration.trans53') ?></label>
            <?php echo input_date_tag('studentBirthDate' . $id, null, array('rich' => true, 'culture' => $sf_user->getCulture(), 'format' => 'd/m/Y')) ?><span> (<?php echo __('dd/mm/aaaa') ?>)</span>

        <?php if ($sf_request->hasError('studentBirthDate'.$id)): ?>
        <p class="validation-error">&uarr; <?php echo $sf_request->getError('studentBirthDate' .$id) ?> &uarr;</p>
        <?php endif ?>
        </div>
		
        <?php include_partial('text_field', array('field_name' => 'studentAddress' . $id, 'field_label' => __('registration.trans54'), 'obligatori' => true, 'class'=>'prova','size'=>50, 'help' => __('registration.trans163')));?>

        <?php include_partial('text_field', array('field_name' => 'studentZip' . $id, 'field_label' => __('registration.trans55'), 'obligatori' => true, 'class'=>'prova','size'=>15));?>

        <?php include_partial('text_field', array('field_name' => 'studentCity' . $id, 'field_label' => __('registration.trans16'), 'obligatori' => true, 'class'=>'prova','size'=>50));?>
<?php if ($sf_user->getCulture() != 'fr'): ?>
        <?php echo label_for("studentProvincia$id",  "*" . __("registration.trans165"), array('id' => 'labelProvincia')) ?>
        <?php include_partial("select_provincias", array('name' => "studentProvincia$id", 'provincias' => $provincias, 'id' => $id)); ?>
<?php endif ?>

        <div class="student_field">
            <?php echo label_for("origin_center",  __('registration.trans151')) ?>
            <?php include_partial('select_origin_centers', array('name' => 'studentOriginCenter'.$id, 'default' => __('default'), 'centers'=> $origin_centers,'id'=>$id)); ?>
        </div>


        <div class="student_field">
            <?php echo label_for("studentSchoolYear$id",  '*' . __('registration.trans168')) ?>
            <?php include_partial('completed_course', array('name' => 'studentSchoolYear' . $id)); ?>
            <?php echo label_for("studentSchoolYearOther$id",  __('Altre:'), array('class' => 'origin_center_label_altre')) ?>
            <?php echo input_tag("studentSchoolYearOther$id", null, array('class' => 'prova', 'style'=>'width:224px;')) ?>

            <?php if ($sf_request->hasError("studentSchoolYear$id")): ?>
                <p class="validation-error">&uarr; <?php echo $sf_request->getError("studentSchoolYear$id") ?> &uarr;</p>
            <?php endif ?>
        </div>

        <div class="student_field">
            <?php echo label_for("lastCoolOffYear$id",  '*' . __('registration.trans229') . ':') ?>
            <select name="lastCoolOffYear<?php echo $id ?>" id="lastCoolOffYear<?php echo $id ?>" class="origin_center">
                <option value="" selected><?php echo __('registration.trans239') ?></option>
                <?php foreach ($lastYears as $lastYear): ?>
                    <option value="<?php echo $lastYear ?>"><?php echo $lastYear ?></option>
                <?php endforeach ?>
                <option value="0"><?php echo __('registration.trans60') ?></option>
            </select>
        </div>

        <?php if ($sf_request->hasError("lastCoolOffYear$id")): ?>
            <p class="validation-error" style="margin-left:192px;">&uarr; <?php echo $sf_request->getError("lastCoolOffYear$id") ?> &uarr;</p>
        <?php endif ?>

        <div class="student_field" style="display: none">
			<label class="prova" for="isStudentKidAndUs<?php echo $id?>">*<?php echo __('registration.trans169' ) ?>:</label>
			<?php echo radiobutton_tag("isStudentKidAndUs$id", 1, true) ?><span><?php echo __('registration.trans170') ?></span>
        	<?php echo radiobutton_tag("isStudentKidAndUs$id", 0, false) ?><span><?php echo __('registration.trans60') ?></span>
		</div>

        <?php if ($sf_request->hasError('studentOriginCenter'.$id)): ?>
        <p class="validation-error" style="margin-left:192px;">&uarr; <?php echo $sf_request->getError('studentOriginCenter'.$id) ?> &uarr;</p>
        <?php endif ?>

<?php if ($sf_user->getCulture() != 'fr'): ?>
        <?php include_partial('text_field', array('field_name' => 'studentFriends' . $id, 'field_label' => __('registration.trans57'), 'obligatori' => false, 'class'=>'prova','class_input'=>'widthFriends'));?>
<?php endif ?>
        
        <div class="student-disability" style="display: none">
			<label class="prova" for="isStudentDisability<?php echo $id?>">*<?php echo __('registration.trans172') ?>:</label>
			<?php echo radiobutton_tag("isStudentDisability$id", 1, false) ?><span><?php echo __('registration.trans170') ?></span>
        	<?php echo radiobutton_tag("isStudentDisability$id", 0, true) ?><span><?php echo __('registration.trans60') ?></span>
        	<div id="box-student-disability-<?php echo $id ?>" style="margin-left:10px;visibility:hidden">
        		<div style="float:left">
	        		<label for="studentDisabilityLevel<?php echo $id ?>" class="auto"><?php echo __('registration.trans173' ) ?>:</label>
	        		<?php echo input_tag("studentDisabilityLevel$id", null, array('size' => '10')) ?> <span>&nbsp;%</span>
	        		<?php if ($sf_request->hasError('studentDisabilityLevel' . $id)): ?>
	        		<p class="validation-error" style="clear:both; margin-left:59px" >&uarr; <?php echo $sf_request->getError('studentDisabilityLevel' . $id) ?> &uarr;</p>
	        		<?php endif ?>
        		</div>
        		<div style="float:left">
	        		<label for="studentDisabilityComment<?php echo $id ?>" class="auto" style="margin-left:15px"><?php echo __('registration.trans174' ) ?>:</label>
	        		<?php echo input_tag("studentDisabilityComment$id", null, array('size' => '52')) ?>
	        		<?php if ($sf_request->hasError('studentDisabilityComment' . $id)): ?>
	        		<p class="validation-error" style="clear:both; margin-left:59px" >&uarr; <?php echo $sf_request->getError('studentDisabilityComment' . $id) ?> &uarr;</p>
	        		<?php endif ?>
        		</div>
        	</div>
		</div>
<?php if ($sf_user->getCulture() != 'fr'): ?>
        <div class="student-card">
			<label for="studentNumTarjetaSanitaria<?php echo $id ?>"><?php echo '*' . __('registration.trans166') ?>:</label>
			<input type="text" size="20" id="studentNumTarjetaSanitaria<?php echo $id ?>" name="studentNumTarjetaSanitaria<?php echo $id ?>" style="margin-right:10px"></input>
			<label for="studentTarjetaSanitariaCompanyia<?php echo $id ?>" class="companyia"><?php echo __('registration.trans167') ?>:</label>
			<input type="text" id="studentTarjetaSanitariaCompanyia<?php echo $id ?>" name="studentTarjetaSanitariaCompanyia<?php echo $id ?>" size="30"></input>
		</div>
<?php endif ?>
		<?php if ($sf_request->hasError('studentNumTarjetaSanitaria'.$id)): ?>
        <p class="validation-error" style="margin-left:192px;">&uarr; <?php echo $sf_request->getError('studentNumTarjetaSanitaria'.$id) ?> &uarr;</p>
        <?php endif ?>

        <p><?php echo __('registration.trans59') ?></p>
        <div><?php echo radiobutton_tag('studentAllergies' . $id, 'false', true) ?><span><?php echo __('registration.trans60')?></span></div>
        <?php echo radiobutton_tag('studentAllergies' .$id, 'true', false) ?><span><?php echo __('registration.trans130')?></span>
        
        <?php echo input_tag('studentAllergiesDescription' . $id, null, array('class' => 'prova','style'=>'width:722px;')) ?>
        <?php if ($sf_request->hasError('studentAllergiesDescription' . $id)): ?>
        <p class="validation-error" >&uarr; <?php echo $sf_request->getError('studentAllergiesDescription' . $id) ?> &uarr;</p>
        <?php endif ?>

        <p><?php echo __('registration.trans190') ?>:</p>
        <div><?php echo radiobutton_tag('studentMeds' . $id, 0, true) ?><span><?php echo __('registration.trans60')?></span></div>
        <?php echo radiobutton_tag('studentMeds' . $id, 1, false) ?><span><?php echo __('registration.trans191')?>:</span>

        <?php echo input_tag('studentMedsDescription' . $id, null, array('class' => 'prova','style'=>'width:722px;')) ?>
        <?php if ($sf_request->hasError('studentMedsDescription' . $id)): ?>
            <p class="validation-error" style="margin-left:100px">&uarr; <?php echo $sf_request->getError('studentMedsDescription' . $id) ?> &uarr;</p>
        <?php endif ?>

        <p><?php echo __('registration.trans237') ?>:</p>
        <div><?php echo radiobutton_tag('studentIsVaccinated' . $id, 1, true) ?><span><?php echo __('registration.trans170')?></span></div>
        <?php echo radiobutton_tag('studentIsVaccinated' . $id, 0, false) ?><span><?php echo __('registration.trans60')?></span>

        <p><?php echo __('registration.trans238') ?></p>
        
        <p><?php echo __('registration.trans175') ?>:</p>
        <?php echo textarea_tag('studentComments' . $id, '',  array('class' => 'textAreaDisability', 'maxlength' => 500)) ?>
		
        <?php if ($sf_user->getCulture() != 'it' && (!isset($center) || $center->getShowBecaWidget()) && false): ?>
       		<div class="student-disability" id="wbeca<?php echo $id ?>">
				<label class="student_beca" for="isStudentBeca<?php echo $id?>">*<?php echo __('Sol·licita ajut econòmic, beca?') ?>:</label>
				<?php echo radiobutton_tag("isStudentBeca$id", 1, false) ?><span><?php echo __('registration.trans170') ?></span>
        		<?php echo radiobutton_tag("isStudentBeca$id", 0, true) ?><span><?php echo __('registration.trans60') ?></span>
        	</div>
        	<p id="wbecatext<?php echo $id ?>"><?php echo __("registration.trans176") ?></p>	
        <?php endif ?>
    </div>

    <div class="parents clear">

      <?php if  ($id == 1){ ?>

            <?php include_partial('fathers_fields' ,array ('id'=>$id,'show'=>1)) ?>


      <?php }else { ?>

                <div class="different_parents">
                    <?php echo checkbox_tag('student'.$id .'DifferentParents', 1, false) ?>
                    <p><?php echo __('registration.trans62') ?></p>
                </div>

                <?php include_partial('fathers_fields' ,array ('id'=>$id, 'show'=>$sf_user->getAttribute('differentParents'.$id))) ?>


      <?php } ?>




    </div>
</div>

<?php echo input_hidden_tag("studentPhoto$id", $photo) ?>