<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $params['id'] = $params['workout'];
  unset($params['workout']);

  // render log array
  $log = $kirby->controller('get_workout', [ 'id' => $params['id'] ]);
  $log['id'] = time();
  $dt = new DateTime();
  $dt->setTimestamp($log['id']);
  $log['date'] = $dt->format('Y-m-d');
  $log['workout'] = $params['id'];
  $log['duration'] = 0;
  $params['log'] = $log['date'];
  unset($log['logs']);

  // create log file
  $file_path = 'public/content/log/'.$log['id'].'/workout.json';
  $directory = dirname($file_path);
  if (!is_dir($directory)) {
      if (!mkdir($directory, 0755, true)) {
          die('Failed to create log directories...');
      }
  }
  $success = file_put_contents($file_path, json_encode($log)) !== false ? true : false;
  
  // update workout
  $updateFunc = function($data, $params) {
    // add log
    $data['logs'] ??= [];
    $data['logs'][] = $params['log'];

    // clear workout set status
    foreach ($data['sets'] as $i => $exercise) {
      foreach ($exercise as $j => $set) {
        $data['sets'][$i][$j]['status'] = 0;
      }
    }

    // return updated data
    return $data;
  };
  $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]); 

  // update exercise

    // add log

  return [
    'success' => $success,
    'params' => $params,
    'path' => $file_path,
    'log' => $log,
  ];

};

