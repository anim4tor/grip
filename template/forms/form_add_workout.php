<?php 
	session_start();
	$relpath = '../../';
	include_once($relpath . 'template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';
	$WORKOUT = array();

	if (isset($_REQUEST['w'])) {
		$WORKOUT = db_fetch_row('workouts',"id", $_REQUEST['w']);
		// $WORKOUT['lifts'] = db_fetch_rows('lifts',"workout = {$WORKOUT['id']}");
		
	} else {
		$WORKOUT['id'] = db_insert_blank('workouts');
		header('Location: ' . $root.'/workout.php?w=' . $WORKOUT['id']);
	}
?>