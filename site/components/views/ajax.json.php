<?php

$data ??= null;
if($data) {
	parse_str($data, $data);	
	$keys = array_keys($data);
	extract($data);
}

$html = '';
$html = $data ? snippet('templates/ajax/'. ucfirst($template) .'/'. $id , compact($keys), true) : snippet('templates/ajax/'. ucfirst($template) .'/'. $id, [ 'data' => $data ], true);

$json['html'] = $html;
$json['template'] = $template;
$json['id'] = $id;
$json['data'] = $data;

echo json_encode($json);