<?php
	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];

	switch($action){

	// page about
	
		// view
		case "about":
			$sm = new sm('home');
			$sm->display('about.tp');
			break;
	}

?>