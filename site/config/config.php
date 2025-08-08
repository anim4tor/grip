<?php

return [
    'debug'  => true,
    'panel.install' => true,
    'home' => 'workouts',
    'routes' => function ($kirby) {
      return [
          [
              'pattern' => ['/modal/(:any)/(:any)'],
              'action' => function ($template, $id) {
                $host = explode('.',$_SERVER['HTTP_HOST']);
                $test = array_pop($host) == 'test' ? true : false;
                $eq = $test ? ';' : ':';
                return go("ajax.json/template{$eq}{$template}/id{$eq}{$id}");
              }
          ],
       
      ];
    },
];
