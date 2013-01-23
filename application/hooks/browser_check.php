<?php 

function browser_check(){
	$agent = $_SERVER["HTTP_USER_AGENT"];

	// if ie
	if(strpos($agent, "MSIE") !== FALSE){

		$CFG =& load_class('Config', 'core');
		$base_url = $CFG->item('base_url');

		$result = eval('?>'. file_get_contents($base_url. 'static/browser_warning.html'). "<?php ");
		
		$OUT =& load_class('Output', 'core'); 
		$OUT->set_output($result);
	}
}

?>