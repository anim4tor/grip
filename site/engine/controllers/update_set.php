<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {
    // update json
    $data['sets'] ??= [];
    $criteria = ["exercise" => $params['exercise'], "index" => $params['index']];
    // $set = array_search($criteria, $data['sets']);
    $results = array_filter($data['sets'], function ($set) use ($criteria) {
        return count(array_intersect_assoc($criteria, $set)) == count($criteria);
    });
    // $data['console'] = $results;
    $data['sets'][array_keys($results)[0]]['status'] = $params['status'];
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
