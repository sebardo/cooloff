<?php
$i = $j = 0;
$hayExcursiones = false;
?>

<?php foreach ($courses as $clave => $course): ?>
    <?php $j++ ?>
    <div class="setmana">
        <?php if ($course->getIsRegistrationOpen()): ?>

            <?php $i++; ?>
            <?php echo checkbox_tag('week' .$i .'alumne' .$id ,  $course->getId() ) ?>
            <?php if (count($course->getInscriptionsByCourse()) < $course->getNumberOfPlaces()): ?>
                <input type="checkbox" name="<?php echo 'placesDisponiblesWeek' .$i .'alumne' .$id?>" id="<?php echo 'placesDisponiblesWeek' .$i .'alumne' . $id ?>" value="1" class="ocultar" checked>
            <?php endif ?>
            <?php
                $label = $course->getWeekWithSchedule() . ' - ' . __('registration.trans120') . $course->getPrice() .' €';
				if (count($course->getInscriptionsByCourse()) >= $course->getNumberOfPlaces()) {
                    $label .= ' ' . __('registration.trans252') . '*';
                }
            ?>
            <?php echo label_for('week' . $i .'alumne' . $id,  $label) ?>

            <?php include_partial('week_services', array('course' => $course, 'id' => $id, 'i' => $i)); ?>

            <?php if ($course->getExcursion()): ?>
                <?php
                    $course->getExcursion()->setCulture($sf_user->getCulture());
                    $hayExcursiones = true;
                ?>

                <div class="acollida-box">
                    <div class="title">
                        <strong>- <?php echo __('registration.trans193') . ": " ?></strong><?php echo trim($course->getExcursion()->getNombre()) ?>
                    </div>

                    <?php if (trim($course->getExcursion()->getDescripcion())): ?>
                        <div class="description"><?php echo trim($course->getExcursion()->getDescripcion()) ?></div>
                    <?php else: ?>
                        <div class="divider"></div>
                    <?php endif ?>
                </div>

            <?php endif ?>
            <?php if (count($course->getInscriptionsByCourse()) >= $course->getNumberOfPlaces()): ?>
                <div class="espera">* <?php echo __('registration.trans188') ?></div>
            <?php endif ?>

            <input type="text" name="preuSetmana<?php echo $i ?>" id="preuSetmana<?php echo $i ?>" value="<?php echo $course->getPrice()?>"  class="ocultar">

        <?php else: ?>

            <input type="checkbox" name="setmanaDisabled" id="setmanaDisabled" disabled>
            <?php echo label_for("setmana",  $course->getWeek()) ?>
            <span> <?php echo __('registration.trans122') ?>  </span>
            <p class="horari"> <?php if ($course->getSchedule()) echo $course->getSchedule() ?></p>

        <?php endif ?>
    </div>
    <?php if ($j < count($courses)): ?>
        <hr style="color:#EFEFEF; margin: 10px 0"/>
    <?php endif ?>
<?php endforeach ?>

<?php if ($sf_request->hasError('errorSetmanaStudent' . $id)): ?>
    <p class="validation-error"  style="margin-left:95px">&uarr; <?php echo $sf_request->getError('errorSetmanaStudent' .$id) ?> &uarr;</p>
<?php endif ?>

<input type="checkbox" name="nombreSetmanes" id="nombreSetmanes" value="<?php echo $i?>"  class="ocultar" checked>

<script type="text/javascript">
    $('#box-discount').toggle(false);
</script>

<?php if (isset($centre) && $centre->getWeeksDiscount() > 0 && $centre->getWeeksPercentDiscount() > 0): ?>
    <script type="text/javascript">
        $('#box-discount-weeks').text('<?php echo __("registration.trans181", array('[1]' => $centre->getWeeksDiscount(), '[2]' => $centre->getWeeksPercentDiscount())) ?>');
        $('#box-discount-weeks').toggle(true);
        $('#box-discount').toggle(true);
    </script>
<?php else: ?>
    <script type="text/javascript">
        $('#box-discount-weeks').toggle(false);
    </script>
<?php endif ?>

<?php if (isset($centre) && $centre->getBrothersDiscount() > 0 && $centre->getBrothersPercentDiscount() > 0): ?>
    <script type="text/javascript">
        $('#box-discount-brothers').text('<?php echo __("registration.trans178", array('[1]' => $centre->getBrothersDiscount(), '[2]' => $centre->getBrothersPercentDiscount())) ?>');
        $('#box-discount-brothers').toggle(true);
        $('#box-discount').toggle(true);
    </script>
<?php else: ?>
    <script type="text/javascript">
        $('#box-discount-brothers').toggle(false);
    </script>
<?php endif ?>

<?php if (isset($centre) && $centre->getShowExcursionWidget() && $hayExcursiones): ?>

    <div class="student_field">
        <input type="radio" name="studentExcursion<?php echo $id ?>" value="1"><span><?php echo __("registration.trans177") ?></span>
        <br/>
        <input type="radio" name="studentExcursion<?php echo $id ?>" value="0"><span><?php echo __("registration.trans192") ?></span>
    </div>

    <?php if ($sf_request->hasError('studentExcursion' . $id)): ?>
        <p class="validation-error" style="margin-left:113px;">&uarr; <?php echo $sf_request->getError('studentExcursion'.$id) ?> &uarr;</p>
    <?php endif ?>

<?php endif ?>

<?php if (isset($centre) && $centre->getCustomQuestion()): ?>
    <div class="student_field">
        <?php echo $centre->getCustomQuestion() ?>
        <br/>
        <input type="radio" name="studentCustomQuestion<?php echo $id ?>" value="1"><span><?php echo __("registration.trans170") ?></span>
        <input type="radio" name="studentCustomQuestion<?php echo $id ?>" value="0"><span><?php echo __("registration.trans60") ?></span>
    </div>

    <?php if ($sf_request->hasError('studentCustomQuestion' . $id)): ?>
        <p class="validation-error" style="margin-left:113px;">&uarr; <?php echo $sf_request->getError('studentCustomQuestion'.$id) ?> &uarr;</p>
    <?php endif ?>
<?php endif ?>

<script type="text/javascript">
    <?php if (isset($centre) && !$centre->getShowBecaWidget()): ?>
        $('div[id^=wbeca]').toggle(false);
        $('p[id^=wbecatext]').toggle(false);
    <?php else: ?>
        $('div[id^=wbeca]').toggle(true);
        $('p[id^=wbecatext]').toggle(true);
    <?php endif ?>
</script>