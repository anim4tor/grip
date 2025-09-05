<?php
return function () {
	$workouts = collection('Workouts');
	$metrics = collection('Metrics');
	
	function array_sort($array, $on, $order = SORT_DESC) {usort($array, function ($a, $b) use ($on, $order) {switch ($order) {case SORT_ASC:return strcmp($a[$on], $b[$on]);case SORT_DESC:return strcmp($b[$on], $a[$on]);}});return $array;}

	$dashboard = array_merge($workouts, $metrics);
	$dashboard = array_sort($dashboard, 'key');
	array_multisort(array_column($dashboard, 'key'), SORT_ASC, $dashboard);
	
	return $dashboard;
};
