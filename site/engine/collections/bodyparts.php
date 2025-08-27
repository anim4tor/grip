<?php
return function () {
	$bodyparts = [
		[	
			'id' => 0,
			'name' => 'Push',
		],
		[	
			'id' => 1,
			'name' => 'Pull',
		],
		[	
			'id' => 2,
			'name' => 'Full body',
		],
		[	
			'id' => 3,
			'name' => 'Upper body',
		],
		[	
			'id' => 4,
			'name' => 'Legs',
		],
		[	
			'id' => 5,
			'name' => 'Glutes',
		],
		[	
			'id' => 6,
			'name' => 'Back',
		],
		[	
			'id' => 7,
			'name' => 'Chest',
		],
		[	
			'id' => 8,
			'name' => 'Shoulders',
		],
		[	
			'id' => 9,
			'name' => 'Arms',
		],
		[	
			'id' => 10,
			'name' => 'Biceps',
		],
		[	
			'id' => 11,
			'name' => 'Triceps',
		],
		[	
			'id' => 12,
			'name' => 'Forearms',
		],
		[	
			'id' => 13,
			'name' => 'Quads',
		],
		[	
			'id' => 14,
			'name' => 'Hamstrings',
		],
		[	
			'id' => 15,
			'name' => 'Calves',
		],
	];

	$file = 'public/content/bodyparts/data.json';
	$json = file_get_contents($file);
	// file_put_contents($file, json_encode($bodyparts));

	return json_decode($json, true);
};
