<?php
	session_start(); 
	$relpath = '../../';
	include_once('../lib/_api.php');
	
	// validation vars
	$error = false;

	// validate POST data
	if(isset($_POST)) {

		$DATA = json_decode($_POST['data'], true);
		db_update_element('lifts', $DATA['column'], $DATA['value'], "id = {$DATA['lift']}");
		
		// what we need to return back to our form  
		$RETURN = array(  
		   'error' => $error, 
		   'post' => $_POST
		);

	    // return data in json formate
		echo json_encode($RETURN);


	} else {
		echo("POST data validation failure");
	    return false;
	}


	
?>