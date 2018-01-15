<?php foreach ($course->getCourseHasServicess() as $courseService): ?>
    <?php $service = $courseService->getService(); ?>
    <?php $service->setCulture($sf_user->getCulture()) ?>
    <?php if (count($service->getServiceSchedules())): ?>
        <div class="acollida-box">
            <div class="title">
                <strong>- <?php echo $service->getName() ?></strong> (+<?php echo $service->getPrice() ?> &euro;):
            </div>

            <?php foreach ($service->getServiceSchedules() as $schedule): ?>
                <?php $schedule->setCulture($sf_user->getCulture()) ?>
                <?php echo checkbox_tag('week' . $i . 'student' . $id . 'service' . $service->getId() . 'schedule' . $schedule->getId(), 1) ?>
                <?php echo label_for('week' . $i . 'student' . $id . 'service' . $service->getId() . 'schedule' . $schedule->getId(), $schedule->getName(), array('class' => 'schedule')); ?>
            <?php endforeach ?>

            <?php if ($service->getDescription()): ?>
                <div class="description"><?php echo $service->getDescription() ?></div>
            <?php else: ?>
                <div class="divider"></div>
            <?php endif ?>
        </div>
    <?php endif ?>
<?php endforeach ?>

