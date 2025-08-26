<?php
	// Create a DateTime object for today
	$today = new DateTime();

	// Create a DateTime object for the next Sunday
	$next = new DateTime('next '.$workout['weekdays'][0]);

	// Calculate the difference between the two dates
	$interval = $today->diff($next);

	// Get the number of days from the DateInterval object
	$workout['counter'] = $interval->days;

	$last = new DateTime();
	$last->setTimestamp($workout['logs'][count($workout['logs']) - 1]);
	$interval = $today->diff($last);
	$workout['rest'] = $workout['frequency'] - $interval->days;

?>
<?= snippet('molecules/Workout/'.$workout['layout'], compact('workout')) ?>