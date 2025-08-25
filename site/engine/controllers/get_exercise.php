<?php
// get exercise json
return function ($kirby, $id, $workout) {
	$exercise = null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);

	$exercise['id'] = $id;
	$exercise['head'] = $kirby->controller('exercise', [ 'id' => $id ]);
	$workout['sets'] ??= [];
	$exercise['sets'] = $workout['sets'][$exercise['id']] ?? [];
	$progress = 0;
	$test = ['status' => 1];
	$progress = sizeof(array_filter($exercise['sets'], function ($set) use ($test) {
	    return count(array_intersect_assoc($test, $set)) == count($test);
	}));
	$exercise['progress'] = sizeof($exercise['sets']) > 0 ? $progress / sizeof($exercise['sets']) : 0;

	return $exercise;
};
