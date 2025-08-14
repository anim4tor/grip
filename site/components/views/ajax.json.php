<?php

$html = '';
$html = snippet('templates/ajax/'. ucfirst($template) .'/'. $id , [ 'data' => $data ], true);

$json['id'] = $id;
$json['template'] = $template;
$json['data'] = $data;
$json['html'] = $html;

echo json_encode($json);