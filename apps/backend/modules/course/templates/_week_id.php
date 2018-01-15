<?php if ($type == 'filter'): ?>

<?php echo select_tag('filters[week_id]',
		    	options_for_select(WeekPeer::getArrayWeeks(),
		    		isset($filters['week_id']) ? $filters['week_id'] : null,
		    		'include_blank=true'), array()
		    ) ?>

<?php else: ?>


<?php echo select_tag('course[week_id]', objects_for_select(
		WeekPeer::doSelectOrderBySartsAtAndProfile(),
		  'getId',
		  'getForCourse',
		$course->getWeekId()));
?>

<?php endif ?>


