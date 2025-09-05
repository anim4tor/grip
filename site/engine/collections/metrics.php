<?php
return function () {
	$directoryPath = 'public/content/metrics';
	$metrics = [];

	// Check if the directory exists
	if (is_dir($directoryPath)) {
	    // Create a recursive directory iterator
	    $iterator = new RecursiveIteratorIterator(
	        new RecursiveDirectoryIterator($directoryPath, RecursiveDirectoryIterator::SKIP_DOTS)
	    );

	    // Loop through the iterator
	    foreach ($iterator as $file) {
	        // Check if the current item is a file with a .json extension
	        if ($file->isFile() && $file->getFilename() === 'metric.json') {
	            $filePath = $file->getRealPath();

	            // Read the JSON file content
	            $jsonContent = file_get_contents($filePath);

	            // Decode the JSON content into a PHP array
	            $data = json_decode($jsonContent, true); // `true` makes it an associative array

	            // Check for decoding errors
	            if (json_last_error() === JSON_ERROR_NONE) {
	                // Store the array data, using the file path as a key for reference
	                $data['dashboard'] = 'metric';
	                $metrics[] = $data;
	                // echo "Successfully read and decoded: " . $filePath . "\n";
	            } else {
	                echo "Error decoding JSON from file: " . $filePath . "\n";
	            }
	        }
	    }
	} else {
	    echo "Error: Directory not found.";
	}

	return $metrics;
};
