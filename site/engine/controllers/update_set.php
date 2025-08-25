<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {
    // update status
    $data['sets'] ??= [];
    // $criteria = ["exercise" => $params['exercise'], "index" => $params['index']];
    // $results = array_filter($data['sets'], function ($set) use ($criteria) {
    //     return count(array_intersect_assoc($criteria, $set)) == count($criteria);
    // });
    $data['sets'][$params['exercise']][$params['index']]['status'] = $params['status'];
    
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
