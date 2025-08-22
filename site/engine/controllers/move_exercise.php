<?php 
return function ($kirby, $params) {
  $params['id'] = $params['workout'];
  $updateFunc = function($data, $params) {
    // update json
    $data['exercises'] ??= [];
    function moveExercise(array $array, $key, $dir) {
        $keys = array_keys($array);
        $values = array_values($array);
        
        // Find the current position of the key
        $index = array_search($key, $keys);
        
        // Swap the key-value pair with the one after it
        $new_keys = $keys;
        $new_values = $values;

        if ($dir == 'up') {

          // If the key is not found or is already the first element, return the original array
          if ($index === false || $index === 0 ) {
              return $array;
          }
          list($new_keys[$index], $new_keys[$index - 1]) = array($keys[$index - 1], $keys[$index]);
          list($new_values[$index], $new_values[$index - 1]) = array($values[$index - 1], $values[$index]);

        } elseif ($dir == 'down') {

          // If the key is not found or is the last element, return the original array
          if ($index === false || $index === count($keys) - 1) {
              return $array;
          }
          list($new_keys[$index], $new_keys[$index + 1]) = array($keys[$index + 1], $keys[$index]);
          list($new_values[$index], $new_values[$index + 1]) = array($values[$index + 1], $values[$index]);

        }

        return array_combine($new_keys, $new_values);
    }

    $data['exercises'] = array_values(moveExercise($data['exercises'], $params['key'], $params['dir']));
    return $data;
  };
  return $kirby->controller('update_workout', [ 'params' => $params, 'updateFunc' => $updateFunc ]);  

};

