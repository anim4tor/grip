<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		// copy workout
		$W = db_fetch_row('workouts',"id", $_REQUEST['w']);
		$newW = array(
			'title' => $W['title'],
			'lifts' => ''
		);
		$newW['id'] = db_insert_row('workouts', $newW);

		// duplicate lifts
		$lifts = array();
		foreach (json_decode($W['lifts']) as $l) {
			
			$L = db_fetch_row('lifts',"id", $l);
			$newL = array(
				'workout' => $newW['id'],
				'exercise' => $L['exercise'],
				'mods' => $L['mods'],
				'sets' => ''
			);
			$newL['id'] = db_insert_row('lifts', $newL);
			$lifts[] = $newL['id'];

			// duplicate sets
			$sets = array();
			foreach (json_decode($L['sets']) as $s) {

				$S = db_fetch_row('sets',"id", $s);
				$newS = array(
					'lift' => $newL['id'],
					'workout' => $newW['id'],
					'type' => $S['type'],
					'weight' => $S['weight'],
					'goal' => $S['reps'],
				);
				$newS['id'] = db_insert_row('sets', $newS);
				$sets[] = $newS['id'];

			}

			// update lift sets ids
			db_update_element('lifts','sets', json_encode($sets), "id = {$newL['id']}");
			
		}

		// update workout lifts ids
		db_update_element('workouts','lifts', json_encode($lifts), "id = {$newW['id']}");


		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_REQUEST,
		   'new' => $newW['id']
		);


		if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
		{
		    // return data in json formate
			echo json_encode($RETURN);
		}
		else { 

			// echo json_encode($RETURN);
			?>

			<pre><?php print_r($RETURN) ?></pre>

			<?php
			// PHP fallback
			$_SESSION['RETURN'] = $RETURN;
			// echo $_SERVER['HTTP_REFERER'];

			// redirect back
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			header('Location: ' . $relpath .'workout.php?w=' . $newW['id']);

		}

	} else {
		echo("POST data validation failure");
	    return false;
	}


	
?>