<?php 

class Common extends CI_Controller{

	function logout(){
		@session_destroy();

		//删除cookie
		setcookie("ua", base64_encode("You are authed!"), time()-3600);
		redirect('discover');
	}
}

?>