<?php 

function browser_check(){
	$agent = $_SERVER["HTTP_USER_AGENT"];

	if(strpos($agent, "MSIE")){
		$CFG =& load_class('Config', 'core');
		$base_url = $CFG->item('base_url');

		header("Location: ". $config['base_url']. 'static/browser_warning.php');
		exit();
	}
}

?>