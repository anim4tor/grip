<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {
    // update status
    $data['sets'] ??= [];
    $data['sets'][$params['exercise']][$params['index']]['status'] = $params['status'];
    
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
