<?php
	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];

	switch($action){

	// about
	
		// get view
		case "about":
			$sm = new sm('home');
			$sm->display('about.tp');
			break;
		
	// terms
		
		// get view
		case "terms":
			$sm = new sm('home');
			$sm->display('terms.tp');
			break;
	}

?>