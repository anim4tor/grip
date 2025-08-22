<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['sets'] ??= [];
    $set['exercise'] = $params['exercise'];
    $set['rpe'] = 0;
    $set['reps'] = 0;
    $set['weight'] = 0.0;
    $data['sets'][] = $set;
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
