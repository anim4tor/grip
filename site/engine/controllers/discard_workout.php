<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $params['id'] = $params['workout'];
  unset($params['workout']);

  // update workout
  $updateFunc = function($data, $params) {
    // clear log
    $data['start'] = false;

    // clear workout set status
    foreach ($data['sets'] as $i => $exercise) {
      foreach ($exercise as $j => $set) {
        $data['sets'][$i][$j]['status'] = 0;
      }
    }

    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]); 

};

