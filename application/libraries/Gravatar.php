<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Gravatar {

	
	function gene_gravatar_by_email($email){
		$hash = md5(strtolower(trim($email)));
		return "http://www.gravatar.com/avatar/". $hash;
	}

	function check_gravatar($email){
		$uri = $this->gene_gravatar_by_email($email). '?d=404';
		
		$headers = @get_headers($uri);
		
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		
		return $has_valid_avatar;
	}
}

/* End of file Someclass.php */