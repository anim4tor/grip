<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {
    // update status
    $data['sets'] ??= [];
    $data['sets'][$params['exercise']][$params['index']]['dropset'] = $params['dropset'];
    
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
