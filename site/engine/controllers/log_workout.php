<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $params['id'] = $params['workout'];
  unset($params['workout']);

  // render log array
  $log = $kirby->controller('get_workout', [ 'id' => $params['id'] ]);
  $log['end'] = time();
  $log['id'] = time();
  $dt = new DateTime();
  $dt->setTimestamp($log['id']);
  $log['date'] = $dt->format('Y-m-d');
  $log['workout'] = $params['id'];
  $log['bw'] = $kirby->controller('get_bodyweight')['current'];
  $log['duration'] = gmdate("i:s", $log['end'] - $log['start']);
  $params['log'] = $log['id'];
  unset($log['logs']);

  // create log file
  $file_path = 'public/content/log/'.$log['id'].'/log.json';
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
    $data['start'] = false;
    $data['logs'] ??= [];
    $data['sets'] ??= [];
    $data['exercises'] ??= [];
    $data['logs'][] = $params['log'];

    $data['schedule'] = '';
    $today = new DateTime();
    if ($data['weekdays'][0] ?? 0) {
      $data['schedule'] = $today->modify($data['weekdays'][0] .' next week')->format('Y-m-d');
    } else {
      $data['schedule'] = $today->modify('+'.$data['frequency'].' days')->format('Y-m-d');
    }

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

