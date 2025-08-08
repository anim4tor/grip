<?php 
	session_start();
	$relpath = '../../';
	include_once($relpath . 'template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';

	$selected = '';
	$WORKOUT = '';
	$EXERC = array();

	if (isset($_REQUEST['data'])) {
		$selected = $_REQUEST['data'];
		if (isset($_REQUEST['w'])) {
			$WORKOUT = db_fetch_row('workouts',"id", $_REQUEST['w']);
		}
		$EXERC = db_fetch_row('exercises',"id", $selected);
		// $BODY = db_fetch_row('body',"id", $EXERC['body']);

		$newLift = array();
		$newLift['workout'] = $_REQUEST['w'];
		$newLift['exercise'] = $EXERC['id'];

		// add blank lift
		$newLift['id'] = db_insert_row('lifts', $newLift);

		// update workout lifts
		$wLifts = db_fetch_element('workouts','lifts',"id = {$newLift['workout']}");
		$wLifts = json_decode($wLifts, true);
		$wLifts[] = $newLift['id'];
		$wLifts = json_encode($wLifts);
		db_update_element('workouts','lifts', $wLifts, "id = {$WORKOUT['id']}");

		var_dump($WORKOUT);
		// var_dump($WORKOUT);
		header('Location: ' . $relpath .  'exercise.php?w=' . $WORKOUT['id'] . '&e=' . $newLift['id'] );
	}
	
?>
