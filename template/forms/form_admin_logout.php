<?php
	session_start();

	$error = false;

	//
	unset($_SESSION['admin']);

	
	// what we need to return back to our form  
	$RETURN = array(  
	   'admin' => false,  
	   'error' => $error,
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
