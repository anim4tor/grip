<?php
// get exercise json
return function ($id) {
	$exercise = null;
	$exercise = collection('Exercises')[array_search($id, array_column(collection('Exercises'), 'id'))];
	
	return $exercise;
};
