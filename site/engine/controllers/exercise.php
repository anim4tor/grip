<?php
// get exercise json
return function ($id) {
	$exercise = null;
	// $file = 'public/content/exercises/'.$id.'/exercise.json';

	// if (file_exists($file)) {
    //     $json = file_get_contents($file);
    //     $data = json_decode($json, true);
    //     if (json_last_error() === JSON_ERROR_NONE) {
    //         $workout = $data;
    //     } else {
    //         echo "Error decoding JSON from file: " . $file . "\n";
    //     }
	// } else {
	//     echo "The file $file does not exist";
	// }

	$exercise = collection('Exercises')[array_search($id, array_column(collection('Exercises'), 'id'))];
	
	return $exercise;
};
