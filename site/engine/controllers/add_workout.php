<?php 
return function ($page, $params) {
  $success = false;

  $id = $params['id'];
  $file_path = 'public/content/workouts/'.$id.'/workout.json';
  $directory = dirname($file_path);
  $params['title'] = empty($params['title']) ? $params['bodypart'] : $params['title'];
  $params['weekdays'] ??= [];
  $frequency = $params['frequency'] > 1 ? 'Every ' . $params['frequency'] . ' days' : 'Every day';
  $frequency = $params['frequency'] == 7 ? 'Every week' : $frequency;
  $params['schedule'] = empty($params['weekdays']) ? $frequency : implode(', ', $params['weekdays']);
  $params['start'] ??= false;

  // Check if the directory exists and create it if it doesn't
  if (!is_dir($directory)) {
      // mkdir() with recursive flag set to true
      if (!mkdir($directory, 0755, true)) {
          die('Failed to create directories...');
      }
  }

  if (file_put_contents($file_path, json_encode($params)) !== false) {
      $success = true;
      // echo "JSON data successfully saved to $file_path";
  } else {
      $success = false;
      // echo "Error: Could not write to file.";
  }
  
  return [
    'success' => $success,
    'params' => $params,
    'path' => $file_path,
  ];

};

