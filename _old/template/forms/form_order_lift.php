<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_REQUEST)) {

		// $DATA = json_decode($_POST['data'], true);
		$LIFT = db_fetch_row('lifts',"id", $_REQUEST['l']);
		$WORKOUT = db_fetch_row('workouts',"id", $LIFT['workout']);
		$DIRECTION = $_REQUEST['d'];

		// update workout lifts
		$wLifts = json_decode($WORKOUT['lifts'], true);
		$index = array_search($LIFT['id'], $wLifts);
		$size = sizeof($wLifts);
		$item = $wLifts[ $index ];
		if ($DIRECTION == 'up') {
			echo 'move up';
			if ($index != 0) {
				$wLifts[ $index ] = $wLifts[ $index - 1 ];
				$wLifts[ $index - 1 ] = $item;
			}
			# code...
		} else {
			echo 'move down';

			if ($index != sizeof($wLifts)) {
				$wLifts[ $index ] = $wLifts[ $index + 1 ];
				$wLifts[ $index + 1 ] = $item;
			}
		}
		$wLifts = json_encode($wLifts);
		db_update_element('workouts','lifts', $wLifts, "id = {$WORKOUT['id']}");
		
		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_REQUEST,
		   'workout' => $WORKOUT,
		   'index' => $index,
		   'size' => $size,
		   'reorder' => $wLifts
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