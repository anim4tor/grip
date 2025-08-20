<?php
// get workout json
return function ($id) {
	$workout = null;
	$file = 'public/content/workouts/'.$id.'/workout.json';

	if (file_exists($file)) {
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $workout = $data;
        } else {
            echo "Error decoding JSON from file: " . $file . "\n";
        }
	} else {
	    echo "The file $file does not exist";
	}

	return $workout;
};
