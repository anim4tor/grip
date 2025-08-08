<?php

session_start(); 
$relpath = '../../';
include_once('../lib/_api.php');
include_once('../lib/_config.php');	

	// validation vars
	$_SESSION['admin'] = array();
	$error = false;
	$error_msg = array();
	
	// validate POST data
	if(isset($_POST['login'])) {
		$login = $_POST['login'];
		if(empty($login)) {  
		   $error = true;  
		   $error_msg['login'] = array('feedback'=>'Nezadal jsi login administrátora.','field'=>'login');
		} 
	} else {
		$login = "";
	}
	
	// validate password
	if(isset($_POST['password'])) {
		$password = $_POST['password'];
		$pswd = md5($password);
		if(empty($pswd)) {  
		   $error = true;  
		   $error_msg['password'] = array('feedback'=>'Nezadal jsi heslo administrátora.','field'=>'password');
		} 
	} else {
		$pswd = "";
	}
	
	// validate admin credentials
	if(!$error) {
		if(valid_admin($login, $pswd)) {
			$_SESSION['admin']['valid'] = true;
			$_SESSION['admin']['name'] = $login;
			// $_SESSION['adminName'] = $login;		
		} else {
			$error = true;
			$error_msg['valid'] = array('feedback'=>'Neautorizovaný přístup.','field'=>'valid');
		} 
	}

	
	// what we need to return back to our form  
	$RETURN = array(  
	   'error' => $error, 
	   'error_msg' => $error_msg,
	   'login' => $login, 
	   'pswd' => $pswd,
	   'post' => $_POST,
	);


	if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
	{
	    // return data in json formate
		echo json_encode($RETURN);
	}
	else {

		echo json_encode($RETURN);
		
		// PHP fallback
		// print('<pre>Admin form: ');
		// print_r($RETURN);
		// print('</pre>');

		$_SESSION['RETURN'] = $RETURN;
		// echo $_SERVER['HTTP_REFERER'];
		// redirect back
		// header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

?>