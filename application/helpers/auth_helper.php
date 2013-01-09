<?php

// 权限检测及处理
function auth_check($state = 'private'){

	if( ! isset($_SESSION['valid_user_id'])
		AND isset($_COOKIE['ua'])
		AND isset($_COOKIE['ue']))
	{
		$email = base64_decode($_COOKIE['ue']);

		$CI = &get_instance();
		$CI->load->model('Account_model');
		$userInfo = $CI->Account_model->get_user_by_email($email);

		$_SESSION['valid_user'] = $userInfo->Username;
		$_SESSION['valid_user_id'] = $userInfo->UserID;
	}

	switch($state){
		// 私有页面/操作，只有登录用户才可进入
		case 'private':
			// 若未登录，则跳转浏览页面
			if( ! isset($_SESSION['valid_user_id'])){
				redirect('discover');
			}		
			break;

		case 'login':
			// 若已登录，则进入个人首页
			if(isset($_SESSION['valid_user_id'])){
				redirect('person');
			}
			break;

		case 'public':
			break;
	}
}



 ?>