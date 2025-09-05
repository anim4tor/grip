<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $params['assisted'] ??= 0;
  $params['bw'] ??= 0;
  
  $updateFunc = function($data, $params) {
    // update status
    $data['sets'] ??= [];


    $data['sets'][$params['exercise']][$params['index']]['assisted'] = $params['assisted'];
    $data['sets'][$params['exercise']][$params['index']]['bw'] = $params['bw'];
    
    // $data['sets'][$params['exercise']][$params['index']] = array_merge($data['sets'][$params['exercise']][$params['index']], $params['sets'][$params['exercise']][$params['index']]);
    
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
