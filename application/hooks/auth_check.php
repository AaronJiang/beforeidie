<?php

function auth_check(){

	$RTR =& load_class('Router', 'core');
	$class = $RTR->fetch_class();
	$method = $RTR->fetch_method();

	$CFG =& load_class('Config', 'core');
	$base_url = $CFG->item('base_url');

	// controller - account
	if($class == 'account')
	{
		// PRIVATE
		if($method == 'info' OR $method == 'change_pwd')	
		{	
			if( ! isset($_SESSION['valid_user_id']))
			{
				header('Location:'. $base_url. 'account/login');
				exit();
			}
		}
		// LOGIN
		else	
		{
			if(isset($_SESSION['valid_user_id']))	
			{	
				header('Location:'. $base_url. 'person');
				exit();
			}
		}
	}

	// controller - goal
	if($class == 'goal')
	{
		// PRIVATE
		if($method == 'add')
		{
			if( ! isset($_SESSION['valid_user_id']))
			{
				header('Location:'. $base_url. 'account/login');
				exit();
			}
		}
	}

}

?>
