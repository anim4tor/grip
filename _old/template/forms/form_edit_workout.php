<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	// include_once('../lib/_config.php');	

	// validation vars
	$error = false;
	$update = array();

	// validate POST data
	if(isset($_POST)) {
		$update = $_POST;
	} else {
		echo("POST data validation failure");
	    return false;
	}

	if(!isset($update['lifts'])) {
		$update['lifts'] = '[]';
	} else {
		$update['lifts'] = json_encode($update['lifts']);
	}

	// $update['volume'] =  calc_volume($_POST['id']);
	// $bodyparts = array();
	// $update['bodyparts'] = json_encode($bodyparts);

	// $update['schedule'] = $update['date'] .' '.$update['time'];
	// unset($update['date']);
	// unset($update['time']);
	$v = 0;
	foreach ($_POST['lifts'] as $l) {
		$s = number_format(calc_lift_score($l),0,'','');
		$v += $s;
		// var_dump($volume);
		db_update_row('lifts', array('volume' => $s), "id={$l}");
	}
	$update['volume'] = $v;
	$update['schedule'] = $update['schedule']['year'] . '-' . $update['schedule']['month'] . '-' . $update['schedule']['day'];
	db_update_row('workouts', $update, "id={$update['id']}");

	// what we need to return back to our form  
	$RETURN = array(  
	   'error' => $error, 
	   'update' => $update, 
	   'post' => $_POST,
	   'volume' => $v
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
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		// header('Location: ' . $root.'/coach.php');

	}
	
?>