<?php
// get metric json
return function ($id) {
	$metric = null;
	$metric = collection('Metrics')[array_search($id, array_column(collection('Metrics'), 'metric'))];
	
	return $metric;
};
