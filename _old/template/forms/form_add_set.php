<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	$newSet = array();
	
	// validate POST data
	if(isset($_REQUEST)) {

		$newSet['lift'] = $_REQUEST['l'];
		$newSet['workout'] = $_REQUEST['w'];

		// add blank set
		$newSet['id'] = db_insert_row('sets', $newSet);
		// $setID = db_insert_blank('sets');

		// update lift sets
		$liftSets = db_fetch_element('lifts','sets',"id = {$newSet['lift']}");
		$lift['sets'] = json_decode($liftSets, true);
		$lift['sets'][] = $newSet['id'];
		$lift['sets'] = json_encode($lift['sets']);
		db_update_element('lifts','sets', $lift['sets'], "id = {$newSet['lift']}");

		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'set' => $newSet,
		   'lift' => $lift['sets'],
		   'post' => $_POST,
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
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// header('Location: ' . $_SERVER['HTTP_REFERER'] .'?s=' . $add['workout'] );

		}

	} else {
		echo("POST data validation failure");
	    return false;
	}


	
?>