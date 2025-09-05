<?php 
return function ($kirby, $page, $params) {
  $success = false;

  $params['log'] = [];
  $params['log']['date'] = time();
  $params['log']['value'] = number_format(intval($params['number']) + intval($params['decimal'])/10, 1, '.', '');
  // update metric
  $updateFunc = function($data, $params) {
    // add log
    
    $data['logs'][] = $params['log'];
    $data['current'] = $params['log']['value'];
    $data['date'] = $params['log']['date'];

    // return updated data
    return $data;
  };
  return $kirby->controller('update_metric', [ 'params' => $params, 'updateFunc' => $updateFunc ]); 

  

};

