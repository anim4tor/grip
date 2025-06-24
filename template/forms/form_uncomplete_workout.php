<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		$W = db_fetch_row('workouts',"id", $_REQUEST['w']);
		// update set reps & rirs
		
		// update set status
		db_update_element('workouts','completed', NULL, "id = {$W['id']}");
		db_update_element('workouts','status', 0, "id = {$W['id']}");

		// delete set
		// db_delete_row('sets', "id = {$SET['id']}");
		
		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_REQUEST,
		   'workout' => $W
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