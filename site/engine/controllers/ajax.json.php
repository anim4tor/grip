<?php

return function ($page, $kirby) {
  $id = param('id');
  $template = param('template');

  $return = [
    'id' => $id,
    'template' => $template,
  ];

  return $return;
};