<?php 

class Account extends CI_Controller{

// page login

	function login(){		
		auth_check('login');

		$email = $this->input->post('email');
		$pwd = $this->input->post('password');
		
		switch($_SERVER['REQUEST_METHOD']){

		case 'GET':
			$this->_show_page_login();
			break;

		case 'POST':
			
			// format check
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			$this->form_validation->set_rules('password', '密码', 'required');

			if($this->form_validation->run() == FALSE){
				$this->_show_page_login();
			}
			else{
				// is exist
				$this->form_validation->set_rules('email', '', 'callback_user_pwd_check['. $pwd. ']');
				$this->form_validation->set_message('user_pwd_check', '邮箱或密码错误');
				
				if($this->form_validation->run() == FALSE){
					$this->_show_page_login();
				}
				else{
					// is active
					$this->form_validation->set_rules('email', '', 'callback_user_active_check['. $pwd. ']');

					if($this->form_validation->run() == FALSE){
						//用户邮箱ue（1个月）
						setcookie("ue", base64_encode($email), time()+3600*24*30, '/');	
						redirect('account/active/login/'. $email);
					}
					else{
						// success
						$this->load->model('Account_model');
						$userInfo = $this->Account_model->get_user_by_email($email);
						$_SESSION['valid_user'] = $userInfo->Username;
						$_SESSION['valid_user_id'] = $userInfo->UserID;
				
						//用户邮箱ue（一个月）, 用户授权ua（2天）
						setcookie("ue", base64_encode($email), time()+3600*24*30, '/');	
						setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2, '/');	

						redirect('person');
					}
				}	
			}
			break;
		}
	}

	function _show_page_login(){
		$data['pageTitle'] = '登陆';
		$data['pageID'] = 'page-login';

		// cookie email
		$data['email'] = @base64_decode($_COOKIE['ue']);
		
		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/login.php', $data);
		$this->load->view('account/footer.php');		
	}

	function user_pwd_check($email, $pwd){
		$this->load->model('Account_model');
		return $this->Account_model->check_user_pwd_by_email($email, $pwd);
	}

	function user_active_check($email){
		$this->load->model('Account_model');
		return $this->Account_model->check_user_active($email);
	}

// page register

	// view
	function register(){
		auth_check('login');

		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$repassword = $this->input->post('re-password');

		switch($_SERVER['REQUEST_METHOD']){

		case 'GET':
			$this->_show_page_register();
			break;

		case 'POST':
			// format check
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			$this->form_validation->set_rules('username', '用户名', 'required');
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]');
			$this->form_validation->set_rules('re-password', '重复密码', 'required|matches[password]');

			if($this->form_validation->run() == FALSE){
				$this->_show_page_register();
			}
			else{
				// check email and username unrepeat
				$this->form_validation->set_rules('email', '', 'callback_email_unrepeat_check');
				$this->form_validation->set_message('email_unrepeat_check', '邮箱已存在');

				$this->form_validation->set_rules('username', '', 'callback_username_unrepeat_check');
				$this->form_validation->set_message('username_unrepeat_check', '用户名已存在');

				if($this->form_validation->run() == FALSE){
					$this->_show_page_register();
				}
				else{
					// success
					$this->load->model('Account_model');
					$gravatarUrl = $this->gravatar->gene_gravatar_by_email($email);
					$isSucc = $this->Account_model->new_user($username, $password, $email, $gravatarUrl);
					
					if($isSucc){
						$this->_send_active_email($email);
						//用户邮箱ue（1个月）
						setcookie("ue", base64_encode($email), time()+3600*24*30, '/');
						redirect('account/active/register/'. $email);
					}
				}
			}
			break;
		}
	}

	function _show_page_register(){
		$data['pageTitle'] = '注册';
		$data['pageID'] = 'page-register';

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/register.php', $data);
		$this->load->view('account/footer.php');	
	}

	function email_unrepeat_check($email){
		$this->load->model('Account_model');
		return ! $this->Account_model->check_email_exist($email);
	}

	function username_unrepeat_check($username){
		$this->load->model('Account_model');
		return ! $this->Account_model->check_username_exist($username);
	}

// page active account

	// view
	function active($from, $email = ''){
		auth_check('login');

		$data['pageTitle'] = '激活';
		$data['pageID'] = 'page-active-account';

		$data['from'] = $from;
		$data['email'] = $email;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/active.php', $data);
		$this->load->view('account/footer.php');
	}

	function send_active_email(){
		auth_check('login');

		$email = $this->input->post('email');

		// not empty & valid format & really unactive ?
		$this->form_validation->set_rules('email', '', 'required|valid_email');
		$this->form_validation->set_rules('email', '', 'callback_user_unactive_check');

		if($this->form_validation->run() == FALSE){
			redirect('account/active/activeError');
		}
		else{
			if($this->_send_active_email($email)){
				redirect('account/active/sended/'. $email);	
			}
			else{
				redirect('account/active/activeError/'. $email);	
			}
		}
	}

	function active_account($email, $activeCode){
		auth_check('login');

		$this->load->model('Account_model');
		$isSucc = 0;

		// not empty & really unactive & match & actived ?
		if( $email != ''
			AND $activeCode != ''
			AND $this->user_unactive_check($email)
			AND $activeCode == $this->_gene_active_code($email)
			AND $this->Account_model->active_account($email))
		{
			redirect('account/active/activeSucc/'. $email);
		}
		else{
			redirect('account/active/activeError/'. $email);
		}
	}

	function user_unactive_check($email){
		$this->load->model('Account_model');
		return $this->Account_model->check_user_unactive($email);
	}

// page forgot password

	// view
	function forgot_pwd($from){
		auth_check('login');

		switch($_SERVER['REQUEST_METHOD']){

		case 'GET':
			$this->_show_page_forgot_pwd($from);
			break;

		case 'POST':
			$email = $this->input->post('email');

			// format check
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			
			if($this->form_validation->run() == FALSE){
				$this->_show_page_forgot_pwd($from);
			}
			else{
				// if exist?
				$this->form_validation->set_rules('email', '', 'callback_email_exist_check');
				$this->form_validation->set_message('email_exist_check', '用户不存在');

				if($this->form_validation->run() == FALSE){
					$this->_show_page_forgot_pwd($from);
				}
				else{
					if($this->_send_reset_pwd_email($email)){
						redirect('account/forgot_pwd/sended');
					}
					else{
						redirect('account/forgot_pwd/unsended');
					}				
				}
			}
			break;
		}
	}

	function _show_page_forgot_pwd($from){
		$data['pageTitle'] = '忘记密码';
		$data['pageID'] = 'page-forgot-pwd';

		$data['from'] = $from;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/forgot_pwd.php', $data);
		$this->load->view('account/footer.php');		
	}

	function email_exist_check($email){
		$this->load->model('Account_model');
		return $this->Account_model->check_email_exist($email);
	}

// page reset password

	function verify_reset_code($email, $reset_pwd_code){
		auth_check('login');

		$this->load->model('Account_model');

		if( $email != ''
			AND $reset_pwd_code != ''
			AND $this->Account_model->check_email_exist($email)
			AND $reset_pwd_code == $this->_gene_reset_pwd_code($email))
		{
			redirect('account/reset_pwd/'. $email);
		}
		else{
			redirect('account/forgot_pwd/resetFailed/'. $email);
		}		
	}

	// view
	function reset_pwd($email = ''){
		auth_check('login');

		switch($_SERVER['REQUEST_METHOD']){

		case 'GET':
			$email = $this->encrypt->encode($email);
			$this->_show_page_reset_pwd($email);
			break;

		case 'POST':
			$email = $this->input->post('email');
			$pwd = $this->input->post('pwd');
			$repwd = $this->input->post('re-pwd');

			// format check
			$this->form_validation->set_rules('email', '邮箱', 'required');
			$this->form_validation->set_rules('pwd', '密码', 'required|min_length[6]');
			$this->form_validation->set_rules('re-pwd', '重复密码', 'required|matches[pwd]');

			if($this->form_validation->run() == FALSE){
				$this->_show_page_reset_pwd($email);
			}
			else{
				// email exist ?
				$this->form_validation->set_rules('email', '邮箱', 'callback_encrypt_email_exist_check');

				if($this->form_validation->run() == FALSE){
					redirect('account/forgot_pwd/resetFailed');
				}
				else{
					$this->load->model('Account_model');
					$email = $this->encrypt->decode($email);

					if($this->Account_model->change_pwd_by_email($email, $pwd)){
						redirect('account/forgot_pwd/resetSucc');
					}
					else{
						redirect('account/forgot_pwd/resetFailed');		
					}
				}
			}
			break;
		}
	}

	function _show_page_reset_pwd($email){
		$data['pageTitle'] = '重置密码';
		$data['pageID'] = 'page-reset-pwd';

		$data['email'] = $email;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/reset_pwd.php', $data);
		$this->load->view('account/footer.php');	
	}

	function encrypt_email_exist_check($email){
		$this->load->model('Account_model');
		$email = $this->encrypt->decode($email);
		return $this->Account_model->check_email_exist($email);	
	}

// page account details

	// view
	function info(){
		auth_check('private');

		$data['pageTitle'] = '个人资料';
		$data['pageID'] = 'page-account-info';

		$userID = $_SESSION['valid_user_id'];
		$this->load->model('Account_model');

		$data['user'] = $this->Account_model->get_user_by_id($userID);

		$this->load->view('header.php', $data);
		$this->load->view('account/info.php', $data);
		$this->load->view('footer.php');
	}

	function change_sex(){
		auth_check('private');

		$userID = $this->input->post('userID');
		$sex = $this->input->post('sex');

		// himself & sex correct ?
		if( $userID != $_SESSION['valid_user_id']
			OR ($sex != 'male' AND $sex != 'female'))
		{
			echo 0;
			return;
		}

		$this->load->model('Account_model');
		echo $this->Account_model->change_sex($userID, $sex)? 1: 0;
	}

// page change password

	function change_pwd(){
		auth_check('private');

		switch($_SERVER['REQUEST_METHOD']){

		case 'GET':
			$this->_show_page_change_pwd();
			break;

		case 'POST':
			// format check
			$this->form_validation->set_rules('originalPwd', '原密码', 'required');
			$this->form_validation->set_rules('newPwd', '密码', 'required|min_length[6]');
			$this->form_validation->set_rules('reNewPwd', '重复密码', 'required|matches[newPwd]');

			if($this->form_validation->run() == FALSE){
				$this->_show_page_change_pwd();
			}
			else{
				// password check
				$this->form_validation->set_rules('originalPwd', '', 'callback_userid_pwd_check');
				$this->form_validation->set_message('userid_pwd_check', '原密码错误');

				if($this->form_validation->run() == FALSE){
					$this->_show_page_change_pwd();
				}
				else{
					$userID = $_SESSION['valid_user_id'];
					$newPwd = $this->input->post('newPwd');
					$this->load->model('Account_model');
					if($this->Account_model->change_pwd_by_id($userID, $newPwd)){
						redirect('account/info');
					}
				}
			}
			break;
		}
	}

	function _show_page_change_pwd(){
		$data['pageTitle'] = '更改密码';
		$data['pageID'] = 'page-change-pwd';

		$this->load->view('header.php', $data);
		$this->load->view('account/change_pwd.php', $data);
		$this->load->view('footer.php');	
	}

	function userid_pwd_check($pwd){
		$userID = $_SESSION['valid_user_id'];
		$this->load->model('Account_model');
		return $this->Account_model->check_user_pwd_by_id($userID, $pwd);
	}

// Email Utilities

	//发送激活邮件
	function _send_active_email($emailTo){
		auth_check('login');

		$mailsubject = "Beforeidie-激活账户";

		//生成激活 Url
		$activeCode = $this->_gene_active_code($emailTo);
		$activeUrl = base_url('account/active_account/'. $emailTo. '/'. $activeCode);

		//邮件内容
		$mailbody = "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，激活你在Beforeidie上的账户：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
			
		//发送邮件
		return @$this->smtp->sendmail($emailTo, $mailsubject, $mailbody);
	}

	//生成激活码
	function _gene_active_code($email){
		auth_check('login');

		$this->load->model('Account_model');
		$userInfo = $this->Account_model->get_user_by_email($email);
		return sha1($userInfo->UserID. $userInfo->Username. $email);
	}

	//发送密码重置邮件
	function _send_reset_pwd_email($emailTo){
		auth_check('login');

		$mailsubject = "Beforeidie-重置密码";
		
		//生成激活 Url
		$activeCode = $this->_gene_reset_pwd_code($emailTo);

		$activeUrl = base_url('account/verify_reset_code/'. $emailTo. "/". $activeCode);

		//邮件内容
		$mailbody = "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，重置你在Beforeidie上的密码：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
		
		//发送邮件
		return @$this->smtp->sendmail($emailTo, $mailsubject, $mailbody);
	}

	//生成密码重置码
	function _gene_reset_pwd_code($email){
		auth_check('login');

		$this->load->model('Account_model');
		$userInfo = $this->Account_model->get_user_by_email($email);
		return sha1($userInfo->UserID. $email. $userInfo->Username);
	}
}

?>