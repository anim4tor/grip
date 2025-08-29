<?php
	// Create a DateTime object for today
	$today = new DateTime();
	$workout['rest'] = 0;
	$next = new DateTime($workout['schedule']);
	$interval = $today->diff($next);
	$workout['rest'] = !$interval->invert ? $interval->days + 1 : 0;
	$workout['ago'] ??= null;
	$last = new DateTime();
	if (!empty($workout['logs'])) {
		// code...
		$last->setTimestamp($workout['logs'][array_key_last($workout['logs'])]);
		$interval = $today->diff($last);
		$ago = '';
		$ago .= $interval->s && $interval->i == 0 && $interval->h == 0 && $interval->d == 0 ? $interval->s . ' seconds ': null;
		$ago .= $interval->i && $interval->h == 0 && $interval->d == 0 ? $interval->i . ' minutes ': null;
		$ago .= $interval->h && $interval->d == 0 ? $interval->h . ' hours ': null;
		$ago .= $interval->d ? $interval->d . ' days ': null;
		$ago .= 'ago';
		$workout['ago'] = $ago;
	}
	// $workout['last'] = $interval->days;
	// Get the number of days from the DateInterval object

?>
<?= snippet('molecules/Workout/'.$workout['layout'], compact('workout')) ?>