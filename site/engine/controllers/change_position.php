<?php 
return function ($kirby, $params) {
  $success = false;
  // update position
  $update = collection('Dashboard');
  function moveDashboard(array $array, $key, $dir) {
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

  $update = array_values(moveDashboard($update, $params['key'], $params['dir']));
  foreach ($update as $key => $item) {
    $item['key'] = $key;
    $kirby->controller('update_'.$item['dashboard'], [ 'params' => $item ]);  
  }

  return [
    'success' => $success,
    'params' => $params,
    'update' => $update
  ];
};

