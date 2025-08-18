<?php

return [
    'debug'  => true,
    'panel.install' => true,
    'home' => 'dashboard',
    'routes' => function ($kirby) {
      return [
          [
              'pattern' => ['/modal/(:any)/(:any)','/dialog/(:any)/(:any)'],
              'action' => function ($template, $id) {
                $host = explode('.',$_SERVER['HTTP_HOST']);
                $test = array_pop($host) == 'test' ? true : false;
                $eq = $test ? ';' : ':';
                return go("ajax.json/template{$eq}{$template}/id{$eq}{$id}");
              }
          ],
          // [
          //     'pattern' => ['/form/(:any)'],
          //     'method' => 'POST',
          //     'action' => function ($template) {
          //       $host = explode('.',$_SERVER['HTTP_HOST']);
          //       $test = array_pop($host) == 'test' ? true : false;
          //       $eq = $test ? ';' : ':';
          //       return go("form.json/template{$eq}{$template}");
          //     }
          // ],
      ];
    },
];
