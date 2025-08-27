<?php
// get exercise json
return function ($kirby, $workout, $exercise, $set) {
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$set = $workout['sets'][$exercise][$set];
	return $set;
};
