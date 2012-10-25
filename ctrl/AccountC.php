<?php

	include_once('setup.php');

	browser_check();

	$action = $_REQUEST['act'];
	
	switch($action){
		case 'p_login':
			$sm = new sm('account');

			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
											'goalsNum' => get_all_goals_num(),
											'logsNum' => get_all_logs_num()));
											
			// Cookie email
			$sm->assign('email', @base64_decode($_COOKIE['ue']));
			
			$sm->display('login.tp');
			break;

		case 'p_register':
			$sm = new sm('account');

			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));
										
			$sm->display('register.tp');	
			break;
			
		case 'p_active':
			$sm = new sm('account');
			
			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));

			// from
			$sm->assign('from', $_REQUEST['from']);

			// email
			$sm->assign('email', $_REQUEST['email']);

			$sm->display('active.tp');		
			break;

		case 'p_forgot_pwd':
			$sm = new sm('account');

			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));
			
			// from
			$sm->assign('from', $_REQUEST['from']);
			
			$sm->display('forgot_pwd.tp');	
			break;
			
		case 'p_reset_pwd':
			$sm = new sm('account');
			
			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));
										
			// email
			$sm->assign('email', $_REQUEST['email']);

			$sm->display('reset_pwd.tp');		
			break;
			
		case 'p_details':
			$sm = new sm('account');
			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('user', array('Name' => $_SESSION['valid_user'],
									'Avatar'=> get_gravatar($userID),
									'Email' => get_email_by_id($userID),
									'HasGravatar' => validate_gravatar($userID)));

			$sm->display('details.tp');		
			break;
			
		case 'p_change_pwd':
			$sm = new sm('account');
			
			// userID
			@session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);
			
			$sm->display('change_pwd.tp');		
			break;
		
		// account proc
		case "login":
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['password'];
			
			if(check_user_by_email($email, $pwd)){
				@session_start();
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
				
				//cookies
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（一个月）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（2天）

				redirect('Home', 'home');
			}
			elseif(check_unactive_user_by_email($email, $pwd)){
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
				redirect('Account.php', 'p_active', array('from' => 'unactive', 'email' => $email));
			}
			else{
				page_jump_back();
			}
			break;
			
		case "logout":
			session_start();
			session_destroy();

			//删除cookie
			setcookie("ua", base64_encode("You are authed!"), time()-3600);
			
			redirect('Account', 'p_login');
			break;
		
		case "register":
			$email = $_REQUEST['email'];
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
		
			new_user($username, $password, $email);
			send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）

			redirect('Account', 'p_active', array('from' => 'register', 'email' => $_REQUEST['email']));
			break;

		case "send_active_email":
			$email = $_REQUEST['email'];
			send_active_email($email);
			redirect('Account', 'p_active', array('from' => 'sended', 'email' => $email));
			break;
			
		case "active":
			$activeCode = $_REQUEST['activeCode'];
			$email = $_REQUEST['email'];
			
			// 激活成功
			if($activeCode == gene_active_code($email)){
				active_account($email);
				follow_user(get_userid_by_email($email), 0);
				redirect('Account', 'p_active', array('from' => 'activeSucc', 'email' => $email));
			}
			// 激活失败
			else{
				redirect('Account', 'p_active', array('from' => 'activeError', 'email' => $email));
			}
			break;
			
		case "send_reset_pwd_email":
			$email = $_REQUEST['email'];
			send_reset_pwd_email($email);
			redirect('Account', 'p_forgot_pwd', array('from' => 'sended'));
			break;
			
		case "verify_reset_code":
			$email = $_REQUEST['email'];
			$resetCode = $_REQUEST['resetCode'];
			
			if($resetCode == gene_active_code($email)){
				redirect('Account', 'p_reset_pwd', array('email' => $email));
			}
			else{
				redirect('Account', 'p_forgot_pwd', array('from' => 'resetFailed', 'email' => $email));
			}
			break;

		case "reset_pwd":
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['pwd'];
			
			$isReset = reset_pwd($email, $pwd);
			
			if($isReset){
				redirect('Account', 'p_forgot_pwd', array('from' => 'resetSucc'));
			}
			else{
				redirect('Account', 'p_forgot_pwd', array('from' => 'resetFailed'));		
			}
			break;
			
		case "change_pwd":
			$isExist = check_user_by_id($_REQUEST['userID'], $_REQUEST['originalPwd']);
			
			if($isExist){
				change_pwd($_REQUEST['userID'], $_REQUEST['newPwd']);
			}
			redirect('Account', 'p_details');
			break;
	}
	
?>