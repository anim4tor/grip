<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		$WORKOUT = db_fetch_row('workouts',"id", $_REQUEST['w']);
		$LIFT = db_fetch_row('lifts',"id", $_REQUEST['l']);

		// delete lift
		db_delete_row('lifts', "id = {$LIFT['id']}");

		// delete sets
		db_delete_row('sets', "lift = {$LIFT['id']}");
		
		// update workout lifts
		$wLifts = db_fetch_element('workouts','lifts',"id = {$WORKOUT['id']}");
		$wLifts = json_decode($wLifts, true);
		if(($key = array_search($LIFT['id'], $wLifts)) !== false) {
		    unset($wLifts[$key]);
		}
		$wLifts = json_encode($wLifts);
		db_update_element('workouts','lifts', $wLifts, "id = {$WORKOUT['id']}");

		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_REQUEST,
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
			echo $_SERVER['HTTP_REFERER'];

			// redirect back
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			header('Location: ' . $relpath .'/workout.php?w=' . $WORKOUT['id']);
			// header('Location: ' . $_SERVER['HTTP_REFERER'] .'?s=' . $add['workout'] );

		}

	} else {
		echo("POST data validation failure");
	    return false;
	}


	
?>