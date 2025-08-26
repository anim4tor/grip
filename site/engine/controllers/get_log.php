<?php
// get workout json
return function ($id) {
	$log = null;
	$file = 'public/content/log/'.$id.'/log.json';

	if (file_exists($file)) {
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $log = $data;
        } else {
            echo "Error decoding JSON from file: " . $file . "\n";
        }
	} else {
	    echo "The file $file does not exist";
	}

	return $log;
};
