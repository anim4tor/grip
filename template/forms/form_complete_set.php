<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		$SET = db_fetch_row('sets',"id", $_REQUEST['s']);
		$W = db_fetch_row('workouts',"id", $SET['workout']);
		$REPS = $_REQUEST['data'];

		// update set reps & rirs
		
		// update set status
		db_update_element('sets','status', 1, "id = {$SET['id']}");
		db_update_element('sets','reps', $REPS, "id = {$SET['id']}");

		// start workout if first set
		$time = date('Y-m-d H:i:s', time());

		// update set status
		db_update_element('workouts','start', $time, "id = {$W['id']}");
		db_update_element('workouts','status', 2, "id = {$W['id']}");

		// delete set
		// db_delete_row('sets', "id = {$SET['id']}");
		
		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_REQUEST,
		   'set' => $SET
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
			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

	} else {
		echo("POST data validation failure");
	    return false;
	}


	
?>