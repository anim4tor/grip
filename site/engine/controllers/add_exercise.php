<?php 
return function ($kirby, $params) {

  $success = false;

  // load
  $file = 'public/content/exercises/data.json';
  $json = file_get_contents($file);
  $exercises = json_decode($json, true);

  // change
  $add = $params;
  $id = end($exercises)['id'];
  do {
    $id++;
  } while (in_array($id, array_column($exercises, 'id')));
  $add['id'] = $id;
  $exercises[] = $add;

  // save
  if (file_put_contents($file, json_encode($exercises)) !== false) {
    $success = true;
  } else {
    $success = false;
  }

  return [
    'success' => $success,
    'params' => $params,
    'add' => $add,
    'path' => $file,
  ];

};
