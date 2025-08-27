<?php
	// Create a DateTime object for today
	$today = new DateTime();
	$workout['rest'] = 0;
	$next = new DateTime($workout['schedule']);
	$interval = $today->diff($next);
	$workout['rest'] = !$interval->invert ? $interval->days + 1 : 0;


	// Get the number of days from the DateInterval object

?>
<?= snippet('molecules/Workout/'.$workout['layout'], compact('workout')) ?>