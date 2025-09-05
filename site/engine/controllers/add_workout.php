<?php 
return function ($page, $params) {
  $success = false;

  // Init path and directory
  $file_path = 'public/content/workouts/'.$params['id'].'/workout.json';
  $directory = dirname($file_path);

  // Build add array
  $params['bodyparts'] ??= [];
  $params['title'] = empty($params['title']) ? $params['bodyparts'][0] : $params['title'];
  $params['weekdays'] ??= [];
  $params['superset'] ??= [];
  $params['sets'] ??= [];
  $params['frequency'] = $params['weekdays'][0] ?? 0 ? 7 : $params['frequency'];
  $params['start'] ??= false;
  $params['dashboard'] ??= 'workout';
  $params['key'] ??= 0;
  $params['logs'] ??= [];

  // Render schedule
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

  // Check if the directory exists and create it if it doesn't
  if (!is_dir($directory)) {
      if (!mkdir($directory, 0755, true)) {
          die('Failed to create directories...');
      }
  }

  // Save workout
  if (file_put_contents($file_path, json_encode($params)) !== false) {
      $success = true;
  } else {
      $success = false;
  }
  
  // Return 
  return [
    'success' => $success,
    'params' => $params,
    'path' => $file_path,
  ];

};

