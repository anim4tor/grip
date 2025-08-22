<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  unset($params['workout']);
  return $kirby->controller('update_workout', [ 'params' => $params ]);  

};
