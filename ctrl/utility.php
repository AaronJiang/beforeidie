<?php
	include_once('../model/data_funs.inc');
	
	// 浏览器检测
	function browser_check(){
		if(get_browser_type() == 'IE'){
			redirect('Public', 'browser_warning');
		}
	}

	// 登陆检测
	function auth_check($state = 'private'){

		switch($state){
			case 'private':
				@session_start();
				if(!is_auth()){
					if(isset($_COOKIE['ua']) && isset($_COOKIE['ue'])){
						$email = base64_decode($_COOKIE['ue']);
						$_SESSION['valid_user'] = get_username_by_email($email);
						$_SESSION['valid_user_id'] = get_userid_by_email($email);
					}
					else{
						redirect('Discover', 'discover');
					}
				}				
				break;

			case 'login':
				if(is_auth()){
					redirect('Person', 'person');
				}
				break;
		}

		header("Last-Modified: ". gmdate("D, d M Y H:i:s"). "GMT"); 
		header("Cache-Control: no-cache, must-revalidate");
	}
	
?>