<?php

	include_once('setup.php');

	browser_check();

	$action = $_REQUEST['act'];

	switch($action){
	
	// page login
	
		// view
		case 'login':
			auth_check('login');
			$sm = new sm('account');
											
			// Cookie email
			$sm->assign('email', @base64_decode($_COOKIE['ue']));
			
			$sm->display('login.tp');
			break;

		case "plogin":
			auth_check('login');
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['password'];
			
			if(check_user_by_email($email, $pwd)){
				@session_start();
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
				
				//cookies
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（一个月）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（2天）

				redirect('Person', 'person');
			}
			elseif(check_unactive_user_by_email($email, $pwd)){
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
				redirect('Account', 'active', array('from' => 'unactive', 'email' => $email));
			}
			else{
				page_jump_back();
			}
			break;
			
	// page register
	
		// view
		case "register":
			auth_check('login');
			$sm = new sm('account');
										
			$sm->display('register.tp');	
			break;

		case "new_user":
			auth_check('login');
			$email = $_REQUEST['email'];
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
		
			new_user($username, $password, $email);
			send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）

			redirect('Account', 'active', array('from' => 'register', 'email' => $_REQUEST['email']));
			break;
	
	// page active
	
		// view
		case 'active':
			auth_check('login');
			$sm = new sm('account');

			// from
			$sm->assign('from', $_REQUEST['from']);

			// email
			$sm->assign('email', $_REQUEST['email']);

			$sm->display('active.tp');		
			break;

		case "send_active_email":
			auth_check('login');
			$email = $_REQUEST['email'];
			send_active_email($email);
			redirect('Account', 'active', array('from' => 'sended', 'email' => $email));
			break;

		case "active_account":
			auth_check('login');
			$activeCode = $_REQUEST['activeCode'];
			$email = $_REQUEST['email'];
			
			// 激活成功
			if($activeCode == gene_active_code($email)){
				active_account($email);
				follow_user(get_userid_by_email($email), 0);
				redirect('Account', 'active', array('from' => 'activeSucc', 'email' => $email));
			}
			// 激活失败
			else{
				redirect('Account', 'active', array('from' => 'activeError', 'email' => $email));
			}
			break;			
		
	// page forgor password
	
		// view
		case 'forgot_pwd':
			auth_check('login');
			$sm = new sm('account');
			
			// from
			$sm->assign('from', $_REQUEST['from']);
			
			$sm->display('forgot_pwd.tp');	
			break;

		case "send_reset_pwd_email":
			auth_check('login');
			$email = $_REQUEST['email'];
			send_reset_pwd_email($email);
			redirect('Account', 'forgot_pwd', array('from' => 'sended'));
			break;
		
	// page reset password

		// view
		case 'reset_pwd':
			auth_check('login');
			$sm = new sm('account');

			// email
			$sm->assign('email', $_REQUEST['email']);

			$sm->display('reset_pwd.tp');		
			break;

		case "verify_reset_code":
			auth_check('login');
			$email = $_REQUEST['email'];
			$resetCode = $_REQUEST['resetCode'];
			
			if($resetCode == gene_active_code($email)){
				redirect('Account', 'reset_pwd', array('email' => $email));
			}
			else{
				redirect('Account', 'forgot_pwd', array('from' => 'resetFailed', 'email' => $email));
			}
			break;

		case "reset_password":
			auth_check('login');
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['pwd'];
			
			$isReset = reset_pwd($email, $pwd);
			
			if($isReset){
				redirect('Account', 'forgot_pwd', array('from' => 'resetSucc'));
			}
			else{
				redirect('Account', 'forgot_pwd', array('from' => 'resetFailed'));		
			}
			break;

	// page account details
	
		// view
		case 'details':
			auth_check();
			$sm = new sm('account');
			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('user', get_user_by_id($userID));
			$sm->assign('hasGravatar', validate_gravatar($userID));

			$sm->display('details.tp');		
			break;

		case 'change_sex':
			auth_check();
			echo change_sex($_REQUEST['userID'], $_REQUEST['sex'])? 1: 0;
			break;
	
	// page account change password
	
		// view
		case 'change_pwd':
			auth_check();
			$sm = new sm('account');
			
			// userID
			@session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);
			
			$sm->display('change_pwd.tp');
			break;

		case "change_password":
			auth_check();
			$isExist = check_user_by_id($_REQUEST['userID'], $_REQUEST['originalPwd']);
			
			if($isExist){
				change_pwd($_REQUEST['userID'], $_REQUEST['newPwd']);
			}
			redirect('Account', 'details');
			break;
	}
	
?>