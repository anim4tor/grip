<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	// include_once('../lib/_config.php');	

	// validation vars
	$error = false;
	
	// validate POST data
	if(isset($_POST)) {
		$add = $_POST;
	} else {
		echo("POST data validation failure");
	    return false;
	}

	// render result update
	$sets = array();
	foreach ($add['set'] as $i => $arr) {
		foreach ($arr as $j => $value) {
			$sets[$j][$i] = $value;
		}
	}
	$add['sets'] = $sets;  

	// create lift
	$lift = array();
	$lift['workout'] = $add['workout'];
	$lift['mods'] = $add['mods'];
	$lift['exercise'] = $add['exercise'];
	$lift['volume'] = $add['volume'];
	db_update_row('lifts', $lift, "id={$add['lift']}");
	$liftID = $add['lift'];

	$SETS = db_fetch_element('lifts','sets',"id = {$liftID}");

	// update sets
	$lift['sets'] = array();

	foreach ($sets as $key => $set) {
		$lift['sets'][] = $set['id'];
		db_update_row('sets', $set, "id = {$set['id']}");
	}

	$lift['sets'] = json_encode($lift['sets']);
	db_update_element('lifts','sets', $lift['sets'], "id = {$liftID}");

	// what we need to return back to our form  
	$RETURN = array(  
	   'error' => $error, 
	   // 'workout' => $workout,
	   'lift' => $lift,
	   'sets' => $sets,
	   'post' => $_POST,
	);


	if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
	{
	    // return data in json formate
		// echo json_encode($RETURN);
	}
	else { 

		// echo json_encode($RETURN);
		?>

		<!-- <pre><?php //print_r($RETURN) ?></pre> -->

		<?php
		// PHP fallback
		$_SESSION['RETURN'] = $RETURN;
		// echo $_SERVER['HTTP_REFERER'];
		// redirect back
		header('Location: ' . $root.'/workout.php?w=' . $add['workout']);

	}
	
?>