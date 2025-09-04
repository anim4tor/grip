<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {

    // update sets
    $data['sets'][$params['exercise']] = $params['sets'][$params['exercise']];
   
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
