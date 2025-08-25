<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['sets'] ??= [];
    $set['exercise'] = $params['exercise'];
    $set['index'] = $params['index'];
    $set['rpe'] = 0;
    $set['reps'] = 0;
    $set['weight'] = 0.0;
    $set['status'] = 0;
    $data['sets'][$params['exercise']][] = $set;
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
