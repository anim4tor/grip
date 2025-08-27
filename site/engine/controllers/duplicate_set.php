<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['sets'] ??= [];
    $set = $data['sets'][$params['exercise']][$params['index']];
    $set['index'] = count($data['sets']) - 1;
    $data['sets'][$params['exercise']][] = $set;

    // reindex sets
    foreach ($data['sets'] as $i => $e) {
      $data['sets'][$i] = array_values($data['sets'][$i]);

      foreach ($data['sets'][$i] as $j => $s) {
        $data['sets'][$i][$j]['index'] = $j;
      }
    }

    // return data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
