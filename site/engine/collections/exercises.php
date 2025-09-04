<?php
return function () {
	$exercises = array(
	  array('id' => '1',	'name' => 'Squats',				'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4','13'],	'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '2',	'name' => 'Calv raises',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','1'],		'bw_factor' => '0.95',		'img' => ''),
	  array('id' => '3',	'name' => 'SLDL',				'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','2'],		'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '4',	'name' => 'Sissy squats',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.8',		'img' => ''),
	  array('id' => '5',	'name' => 'Pull ups',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '6',	'name' => 'Pull downs',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '7',	'name' => 'Chin ups',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '8',	'name' => 'Lat pullover',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '9',	'name' => 'Bent rows',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '10',	'name' => 'Cable rows',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '11',	'name' => 'Dumbell curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '12',	'name' => 'Barbell curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '13',	'name' => 'Cable curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '14',	'name' => 'Incline curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '15',	'name' => 'EZ curls',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '16',	'name' => 'Ring curls',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '17',	'name' => 'Hammer curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '18',	'name' => 'Preacher curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '19',	'name' => 'Push ups',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '20',	'name' => 'Push flyes',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '22',	'name' => 'Cable flyes',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '23',	'name' => 'Bench press',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '24',	'name' => 'Dumbell press',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '25',	'name' => 'Lateral raises',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '26',	'name' => 'Pike pushups',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '27',	'name' => 'Front raises',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '28',	'name' => 'Upright rows',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '29',	'name' => 'Face pulls',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '30',	'name' => 'Rear delt flyes',	'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '31',	'name' => 'Dips',				'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '32',	'name' => 'Push downs',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '36',	'name' => 'Bulgarian squats',	'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '35',	'name' => 'Pistol squats',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.7',		'img' => ''),
	  array('id' => '38',	'name' => 'Skull crushers',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '37',	'name' => 'Lunges',				'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','3'],		'bw_factor' => '0.4',		'img' => ''),
	  array('id' => '39',	'name' => 'Cross extensions',	'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '40',	'name' => 'Lat prayers',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '41',	'name' => 'Ring face pulls',	'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '42',	'name' => 'Ring skull crushers','tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '43',	'name' => 'Incline press',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '44',	'name' => 'Inverted rows',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0.6',		'img' => ''),
	  array('id' => '45',	'name' => 'Bench dips',			'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.5',		'img' => ''),
	  array('id' => '46',	'name' => 'Triceps dips',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','10'],		'bw_factor' => '0.9',		'img' => ''),
	  array('id' => '47',	'name' => 'Cable press',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','5'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '48',	'name' => 'Good mornings',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','2'],		'bw_factor' => '0.75',		'img' => ''),
	  array('id' => '49',	'name' => 'Overhead press',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','8'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '50',	'name' => 'Seated rows',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '51',	'name' => 'Concentration curls','tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '52',	'name' => 'Landmine rows',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','4'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '53',	'name' => 'Pelican curls',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','7'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '54',	'name' => 'Wrist flexion',		'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','11'],		'bw_factor' => '0',			'img' => ''),
	  array('id' => '55',	'name' => 'Reverse grip curls',	'tracking' => 'sets',  		 'mods' => '',		'bodypart' => ['2','11'],		'bw_factor' => '0',			'img' => '')
	);
	
	$file = 'public/content/exercises/data.json';
	$json = file_get_contents($file);
	// file_put_contents($file, json_encode($exercises));
	$exercises = json_decode($json, true);
	
	array_multisort(array_column($exercises, 'name'), SORT_ASC, $exercises);
	return $exercises;
};
