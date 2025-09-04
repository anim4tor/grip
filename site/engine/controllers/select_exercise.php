<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['exercises'] ??= [];
    foreach (array_diff($params['exercises'], $data['exercises']) as $e) {
      array_push($data['exercises'], $e);
    }
    
    // update library
    unset($data['library']);
    foreach ($data['exercises'] as $e) {
      $data['library'][] = collection('Exercises')[array_search($e, array_column(collection('Exercises'), 'id'))];
    }
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};
