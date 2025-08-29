<?php 
return function ($page, $params) {
  $success = false;

  $id = $params['id'];
  $file_path = 'public/content/workouts/'.$id.'/workout.json';
  $directory = dirname($file_path);
  $params['bodyparts'] ??= [];
  $params['title'] = empty($params['title']) ? $params['bodyparts'][0] : $params['title'];
  $params['weekdays'] ??= [];
  $params['superset'] ??= [];
  $params['frequency'] = $params['weekdays'][0] ?? 0 ? 7 : $params['frequency'];
  $params['start'] ??= false;
  $params['logs'] ??= [];

  $params['schedule'] = '';
  $today = new DateTime();
  if ($params['weekdays'][0] ?? 0) {
    $current = new DateTime($params['weekdays'][0] . ' this week');
    if ($today->format('Y-m-d') == $current->format('Y-m-d')) {
      $params['schedule'] = $today->format('Y-m-d');
    } else {
      $next = new DateTime('next '.$params['weekdays'][0]);
      $params['schedule'] = $next->format('Y-m-d');
    }
  } else {
    $params['schedule'] = $today->format('Y-m-d');
  }

  // $today = new DateTime();
  // $params['schedule']
  // $params['counter'] ??= false;

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

