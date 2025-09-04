<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  $updateFunc = function($data, $params) {

    // update sets
    $has_mods = !empty($params['mods'][$params['exercise']]) ? true : false;
    if ($has_mods) {
      $data['mods'][$params['exercise']] = $params['mods'][$params['exercise']];
    } else {
      unset($data['mods'][$params['exercise']]);
    }
   
    // return updated data
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);   

};
