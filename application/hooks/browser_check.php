<?php 

function browser_check(){
	$agent = $_SERVER["HTTP_USER_AGENT"];

	if(strpos($agent, "MSIE")){
		header("Location: ". $config['base_url']. 'static/browser_warning.php');
		exit();
	}
}

?>