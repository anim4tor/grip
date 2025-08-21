<?php

return function ($page, $kirby) {
  if (get('form') && $kirby->request()->is('POST')) {
    $form = $kirby->controller(get('form'), [ 'kirby' => $kirby, 'params' => $kirby->request()->data() ]) ?? null;
    return [
      'form' => $form,
    ];
  }
  return;
};