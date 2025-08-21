<?php 
return function ($kirby, $params) {
  $updateFunc = function($data, $params) {
    // update json
    $data['exercises'] ??= [];
    foreach (array_diff($params['exercises'], $data['exercises']) as $e) {
      array_push($data['exercises'], $e);
    }
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
