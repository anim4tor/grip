<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $params['id'] = $params['workout'];
  unset($params['workout']);
  
  // update workout
  $updateFunc = function($data, $params) {
    $data['start'] = time();

    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]); 

};

