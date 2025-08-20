<?php 
return function ($page, $params) {
  $success = false;
  $update = null;
  $file = 'public/content/workouts/'.$params['id'].'/workout.json';

  if (file_exists($file)) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    if (json_last_error() === JSON_ERROR_NONE) {
      // update json
      $update = array_merge($data, $params);
      $success = true;

    } else {
      $success = false;
      echo "Error decoding JSON from file: " . $file . "\n";
    }
  } else {
      $success = false;
      echo "The file $file does not exist";
  }

  if (file_put_contents($file, json_encode($update)) !== false) {
      $success = true;
      // echo "JSON data successfully saved to $file_path";
  } else {
      $success = false;
      // echo "Error: Could not write to file.";
  }
  
  return [
    'success' => $success,
    'params' => $params,
    'update' => $update,
    'path' => $file,
  ];

};

