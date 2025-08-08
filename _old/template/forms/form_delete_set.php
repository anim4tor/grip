<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		$SET = db_fetch_row('sets',"id", $_REQUEST['s']);

		// update lift sets
		$lSets = db_fetch_element('lifts','sets',"id = {$SET['lift']}");
		$lSets = json_decode($lSets, true);
		if(($key = array_search($SET['id'], $lSets)) !== false) {
		    unset($lSets[$key]);
		}
		$lSets = json_encode($lSets);
		db_update_element('lifts','sets', $lSets, "id = {$SET['lift']}");

		// delete set
		db_delete_row('sets', "id = {$SET['id']}");
		
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