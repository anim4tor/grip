<?php 
return function ($kirby, $params) {
  $updateFunc = function($data, $params) {
    // update layout
    $data['layout'] = $params['layout'];
    return $data;
  };
  return $kirby->controller('update_'.$params['dashboard'], [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};

