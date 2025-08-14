<?php

return function ($page, $kirby) {
  $id ??= param('id');
  $template ??= param('template');
  $data ??= param('data');

  $return = [
    'id' => $id,
    'template' => $template,
    'data' => $data,
  ];

  return $return;
};