<?php
return function () {
	$exercises = array(
	  array('id' => '1',	'name' => 'Squats',				'mods' => '',		'bodypart' => ['2','4','13'],		'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '2',	'name' => 'Calv raises',		'mods' => '',		'bodypart' => ['2','1'],		'bw_factor' => '0.95',		'img' => ''),
	  array('id' => '3',	'name' => 'SLDL',				'mods' => '',		'bodypart' => ['2','2'],		'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '4',	'name' => 'Sissy squats',		'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.8',		'img' => ''),
	  array('id' => '5',	'name' => 'Pull ups',			'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '6',	'name' => 'Pull downs',			'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '7',	'name' => 'Chin ups',			'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '8',	'name' => 'Lat pullover',		'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '9',	'name' => 'Bent rows',			'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '10',	'name' => 'Cable rows',			'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '11',	'name' => 'Dumbell curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '12',	'name' => 'Barbell curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '13',	'name' => 'Cable curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '14',	'name' => 'Incline curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '15',	'name' => 'EZ curls',			'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '16',	'name' => 'Ring curls',			'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '17',	'name' => 'Hammer curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '18',	'name' => 'Preacher curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '19',	'name' => 'Push ups',			'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '20',	'name' => 'Push flyes',			'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '22',	'name' => 'Cable flyes',		'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '23',	'name' => 'Bench press',		'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '24',	'name' => 'Dumbell press',		'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '25',	'name' => 'Lateral raises',		'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '26',	'name' => 'Pike pushups',		'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '27',	'name' => 'Front raises',		'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '28',	'name' => 'Upright rows',		'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '29',	'name' => 'Face pulls',			'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '30',	'name' => 'Rear delt flyes',	'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '31',	'name' => 'Dips',				'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '32',	'name' => 'Push downs',			'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '36',	'name' => 'Bulgarian squats',	'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '35',	'name' => 'Pistol squats',		'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '38',	'name' => 'Skull crushers',		'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '37',	'name' => 'Lunges',				'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.4',		'img' => ''),
	  array('id' => '39',	'name' => 'Cross extensions',	'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '40',	'name' => 'Lat prayers',		'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '41',	'name' => 'Ring face pulls',	'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '42',	'name' => 'Ring skull crushers','mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '43',	'name' => 'Incline press',		'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '44',	'name' => 'Inverted rows',		'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.6',		'img' => ''),
	  array('id' => '45',	'name' => 'Bench dips',			'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '46',	'name' => 'Triceps dips',		'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '47',	'name' => 'Cable press',		'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '48',	'name' => 'Good mornings',		'mods' => '',		'bodypart' => ['2','2'],		'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '49',	'name' => 'Overhead press',		'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '50',	'name' => 'Seated rows',		'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '51',	'name' => 'Concentration curls','mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '52',	'name' => 'Landmine rows',		'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '53',	'name' => 'Pelican curls',		'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '54',	'name' => 'Wrist flexion',		'mods' => '',		'bodypart' => ['2','11'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '55',	'name' => 'Reverse grip curls',	'mods' => '',		'bodypart' => ['2','11'],		'bw_factor' => '0',			'img' => '')
	);
	
	$file = 'public/content/exercises/data.json';
	$json = file_get_contents($file);
	// file_put_contents($file, json_encode($exercises));

	return json_decode($json, true);
};
