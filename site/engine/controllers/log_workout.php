<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $id = $params['workout'];
  $log = $kirby->controller('get_workout', [ 'id' => $id ]);
  $log['time'] = time();
  // $log['workout'] = $id;
  $file_path = 'public/content/log/'.$log['time'].'/workout.json';
  $directory = dirname($file_path);

  // Check if the directory exists and create it if it doesn't
  if (!is_dir($directory)) {
      // mkdir() with recursive flag set to true
      if (!mkdir($directory, 0755, true)) {
          die('Failed to create log directories...');
      }
  }

  if (file_put_contents($file_path, json_encode($log)) !== false) {
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

