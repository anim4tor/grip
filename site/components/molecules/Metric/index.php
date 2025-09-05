<?php
	// Create a DateTime object for today
	$today = new DateTime();
	$last = new DateTime();
	$last->setTimestamp($metric['date'] ??= time());
	$interval = $today->diff($last);
	$ago = '';
	$ago .= $interval->s && $interval->i == 0 && $interval->h == 0 && $interval->d == 0 ? $interval->s . ' seconds ': null;
	$ago .= $interval->i && $interval->h == 0 && $interval->d == 0 ? $interval->i . ' minutes ': null;
	$ago .= $interval->h && $interval->d == 0 ? $interval->h . ' hours ': null;
	$ago .= $interval->d ? $interval->d . ' days ': null;
	$ago .= 'ago';
	$metric['ago'] = $ago;
?>
<?= snippet('molecules/Metric/'.$metric['layout'], compact('metric')) ?>