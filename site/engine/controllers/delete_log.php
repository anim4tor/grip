<?php 
return function ($kirby, $params) {

  // delete log
  function deleteDirectory($dir) {
      if (!file_exists($dir)) {
          return true;
      }

      if (!is_dir($dir)) {
          return unlink($dir);
      }

      foreach (scandir($dir) as $item) {
          if ($item == '.' || $item == '..') {
              continue;
          }

          if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
              return false;
          }
      }

      return rmdir($dir);
  }

  // Example usage:
  $folderToDelete = 'public/content/log/'.$params['id'];

  if (deleteDirectory($folderToDelete)) {
      $success = true;
  } else {
      $success = false;
      die('An error occurred while trying to delete the folder.');
  }

  return [
    'success' => $success,
    'params' => $params,
  ];

};
