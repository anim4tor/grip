<?php
return function () {
	$mods = array(
	  array('id' => '1','slug' => 'assisted','factor' => '-1'),
	  array('id' => '2','slug' => 'weighted','factor' => '1'),
	  array('id' => '3','slug' => 'unilateral','factor' => '2'),
	  array('id' => '4','slug' => 'diagonal','factor' => '1'),
	  array('id' => '5','slug' => 'crossover','factor' => '2'),
	  array('id' => '6','slug' => 'high','factor' => '1'),
	  array('id' => '7','slug' => 'low','factor' => '1'),
	  array('id' => '8','slug' => 'inclined','factor' => '1'),
	  array('id' => '9','slug' => 'declined','factor' => '1'),
	  array('id' => '10','slug' => 'deficit','factor' => '1'),
	  array('id' => '11','slug' => 'cable','factor' => '1'),
	  array('id' => '12','slug' => 'rings','factor' => '1'),
	  array('id' => '13','slug' => 'barbell','factor' => '1'),
	  array('id' => '14','slug' => 'dumbell','factor' => '2'),
	  array('id' => '16','slug' => 'band','factor' => '-1'),
	  array('id' => '17','slug' => 'bentover','factor' => '1'),
	  array('id' => '18','slug' => 'full-rom','factor' => '1'),
	  array('id' => '19','slug' => 'ropes','factor' => '1')
	);
	
	// $file = 'public/content/exercises/data.json';
	// $json = file_get_contents($file);
	// file_put_contents($file, json_encode($exercises));
	array_multisort(array_column($mods, 'slug'), SORT_ASC, $mods);
	return $mods;
};
