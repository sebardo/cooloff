<?php
use_helper('Date');

/**
 * Returns abbreviated day
 *
 * @param unknown_type $date
 * @return string
 */
function getDayCode($date)
{
	$culture = sfContext::getInstance()->getUser()->getCulture();
	$day_week = date('N', strtotime($date));

	$dia = array();
	/* spanish */
	$dia ['es'][1] = 'lu';
	$dia ['es'][2] = 'ma';
	$dia ['es'][3] = 'mi';
	$dia ['es'][4] = 'ju';
	$dia ['es'][5] = 'vi';
	$dia ['es'][6] = 'sa';
	$dia ['es'][7] = 'do';
	/* catalan */
	$dia ['ca'][1] = 'dl';
	$dia ['ca'][2] = 'dm';
	$dia ['ca'][3] = 'dc';
	$dia ['ca'][4] = 'dj';
	$dia ['ca'][5] = 'dv';
	$dia ['ca'][6] = 'ds';
	$dia ['ca'][7] = 'dg';
	/* english */
	$dia ['en'][1] = 'mo';
	$dia ['en'][2] = 'tu';
	$dia ['en'][3] = 'we';
	$dia ['en'][4] = 'th';
	$dia ['en'][5] = 'fr';
	$dia ['en'][6] = 'sa';
	$dia ['en'][7] = 'su';

	return $dia[$culture][$day_week];
}

function getActDate($full_datetime)
{
	$date_html = '';
	$culture = sfContext::getInstance()->getUser()->getCulture();
	
	$date_timestamp = strtotime($full_datetime);
	$full_date = date('Y-m-d', $date_timestamp);
	$day_code = getDayCode($full_date);
	$day_num = date('d', $date_timestamp);
	$month_num = date('m', $date_timestamp);
	$month_name = getLocalMonth($month_num, $culture);
	$time = date('H:i', $date_timestamp);
	
	if ($culture == CULTURE_CATALAN && ($month_num == 4 || $month_num == 8 || $month_num == 10)) {
		$month_prefix = " d'";
	} else {
		$month_prefix = ' de ';
	}

	$date_html .= $day_code . ' <strong>' . $day_num . $month_prefix . $month_name . '</strong> - ' . $time . 'h ';
	return $date_html;
}

function getLocalMonth($month_num, $culture)
{
	return format_date(mktime(0, 0, 0, $month_num, 1, date("Y")), 'MMMM', $culture);
//	setlocale(LC_TIME, $culture.'_ES');
//	return strftime("%B", mktime(0, 0, 0, $month_num, 1, date("Y")));
}

?>