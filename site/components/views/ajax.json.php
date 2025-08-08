<?php

$html = '';
$html = snippet('templates/ajax/'. ucfirst($template) , [ 'id' => $id ], true);

$json['html'] = $html;

echo json_encode($json);