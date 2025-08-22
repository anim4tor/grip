<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['exercises'] ??= [];
    foreach (array_intersect($params['exercises'], $data['exercises']) as $e) {
      unset($data['exercises'][array_search($e, $data['exercises'])]);
    }
    $data['exercises'] = array_values($data['exercises']);
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
