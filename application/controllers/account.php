<?php 

class Account extends CI_Controller{

// page login

	// view
	function login(){
		auth_check('login');

		$data['pageTitle'] = '登陆';
		$data['pageID'] = 'page-login';

		// cookie email
		$data['email'] = @base64_decode($_COOKIE['ue']);

		// if try login but failed, show the warning
		if(isset($_SESSION['login_failed']) AND $_SESSION['login_failed'] == TRUE){
			$data['loginFailed'] = TRUE;
			unset($_SESSION['login_failed']);
		}

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/login.php', $data);
		$this->load->view('account/footer.php');
	}

	function plogin(){
		auth_check('login');

		// re-check
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == FALSE){
			redirect_back();
		}

		$email = $this->input->post('email');
		$pwd = $this->input->post('password');

		$this->load->model('Account_model');
		
		// username or pwd error
		if( ! $this->Account_model->check_user_pwd_by_email($email, $pwd)){
			$_SESSION['login_failed'] = TRUE;
			redirect('account/login');
		}
		else if( ! $this->Account_model->check_user_active($email, $pwd)){
			setcookie("ue", base64_encode($email), time()+3600*24*30, '/');	//用户邮箱ue（1个月）
			redirect('account/active/unactive/'. $email);
		}
		else{
			if(isset($_SESSION['login_failed'])){
				unset($_SESSION['login_failed']);
			}

			$userInfo = $this->Account_model->get_user_by_email($email);
			$_SESSION['valid_user'] = $userInfo->Username;
			$_SESSION['valid_user_id'] = $userInfo->UserID;
			
			//set cookies
			setcookie("ue", base64_encode($email), time()+3600*24*30, '/');	//用户邮箱ue（一个月）
			setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2, '/');	//用户授权ua（2天）

			redirect('person');
		}
	}

// page register

	// view
	function register(){
		auth_check('login');

		$data['pageTitle'] = '注册';
		$data['pageID'] = 'page-register';

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/register.php', $data);
		$this->load->view('account/footer.php');
	}

	function pregister(){
		auth_check('login');

		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('Account_model');
		// 生成gravatar链接
		$gravatarUrl = $this->gravatar->gene_gravatar_by_email($email);
		$isSucc = $this->Account_model->new_user($username, $password, $email, $gravatarUrl);
		if($isSucc){
			$this->_send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
			redirect('account/active/register/'. $_REQUEST['email']);
		}
	}

	function check_email_repeat(){
		auth_check('login');

		$email = $this->input->get('fieldValue');
		$this->load->model('Account_model');

		if($this->Account_model->check_email_repeat($email)){
			echo json_encode(array(array('email'), false));
		}
		else{
			echo json_encode(array(array('email'), true));
		}
	}

	function check_name_repeat(){
		auth_check('login');

		$username = $this->input->get('fieldValue');
		$this->load->model('Account_model');

		if($this->Account_model->check_username_repeat($username)){
			echo json_encode(array(array('username'), false));
		}
		else{
			echo json_encode(array(array('username'), true));
		}
	}

// page active account

	// view
	function active($from, $email){
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
		$this->_send_active_email($email);
		redirect('account/active/sended/'. $email);
	}

	function active_account($email, $activeCode){
		auth_check('login');

		if($activeCode == $this->_gene_active_code($email)){
			$this->load->model('Account_model');
			$this->Account_model->active_account($email);
			redirect('account/active/activeSucc/'. $email);
		}
		else{
			redirect('account/active/activeError/'. $email);
		}	
	}

// page forgot password

	// view
	function forgot_pwd($from){
		auth_check('login');

		$data['pageTitle'] = '忘记密码';
		$data['pageID'] = 'page-forgot-pwd';

		$data['from'] = $from;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/forgot_pwd.php', $data);
		$this->load->view('account/footer.php');
	}	

	function send_reset_pwd_email(){
		auth_check('login');

		$email = $this->input->post('email');
		$this->_send_reset_pwd_email($email);
		redirect('account/forgot_pwd/sended');
		break;	
	}

// page reset password

	// view
	function reset_pwd($email){
		auth_check('login');

		$data['pageTitle'] = '重置密码';
		$data['pageID'] = 'page-reset-pwd';

		$data['email'] = $email;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/reset_pwd.php', $data);
		$this->load->view('account/footer.php');		
	}

	function verify_reset_code($email, $reset_pwd_code){
		auth_check('login');

		if($reset_pwd_code == $this->_gene_reset_pwd_code($email)){
			redirect('account/reset_pwd/'. $email);
		}
		else{
			redirect('account/forgot_pwd/resetFailed/'. $email);
		}		
	}

	function preset_pwd(){
		auth_check('login');

		$email = $this->input->post('email');
		$pwd = $this->input->post('pwd');

		$this->load->model('Account_model');
		$isReset = $this->Account_model->change_pwd_by_email($email, $pwd);
		
		if($isReset){
			redirect('account/forgot_pwd/resetSucc');
		}
		else{
			redirect('account/forgot_pwd/resetFailed');		
		}
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
		$data['hasGravatar'] = $this->gravatar->check_gravatar($userID);

		$this->load->view('header.php', $data);
		$this->load->view('account/info.php', $data);
		$this->load->view('footer.php');
	}

	function change_sex(){
		auth_check('private');

		$userID = $this->input->post('userID');
		$sex = $this->input->post('sex');

		// check process auth
		if($userID != $_SESSION['valid_user_id']){
			echo 0;
			return;
		}

		$this->load->model('Account_model');
		echo $this->Account_model->change_sex($userID, $sex)? 1: 0;
	}

// page change password

	function change_pwd(){
		auth_check('private');

		$data['pageTitle'] = '更改密码';
		$data['pageID'] = 'page-change-pwd';

		$data['userID'] = $_SESSION['valid_user_id'];

		$this->load->view('header.php', $data);
		$this->load->view('account/change_pwd.php', $data);
		$this->load->view('footer.php');
	}

	function check_pwd(){
		auth_check('private');

		$userID = $_SESSION['valid_user_id'];
		$pwd = $this->input->get('fieldValue');
		
		$this->load->model('Account_model');
		if($this->Account_model->check_user_pwd_by_id($userID, $pwd)){
			echo json_encode(array(array('originalPwd'), true));
		}
		else{
			echo json_encode(array(array('originalPwd'), false));
		}
	}

	function pchange_pwd(){
		auth_check('private');

		$userID = $this->input->post('userID');
		$newPwd = $this->input->post('newPwd');

		// check process auth
		if($userID != $_SESSION['valid_user_id']){
			redirect('account/info');
		}

		$this->load->model('Account_model');
		$this->Account_model->change_pwd_by_id($userID, $newPwd);
		redirect('account/info');
	}

// Utilities

	//发送激活邮件
	function _send_active_email($emailTo){
		auth_check('login');

		$mailsubject = "Beforeidie-激活账户";

		//生成激活 Url
		$activeCode = $this->_gene_active_code($emailTo);
		$activeUrl = base_url('account/active_account/'. $emailTo. '/'. $activeCode);

		//邮件内容
		$mailbody .= "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，激活你在Beforeidie上的账户：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
			
		//发送邮件
		@$this->smtp->sendmail($emailTo, $mailsubject, $mailbody);
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
		$mailbody = "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，重置你在Beforeidie上的账户密码：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
		
		//发送邮件
		@$this->smtp->sendmail($emailTo, $mailsubject, $mailbody);
	}

	//生成激活码
	function _gene_reset_pwd_code($email){
		auth_check('login');

		$this->load->model('Account_model');
		$userInfo = $this->Account_model->get_user_by_email($email);
		return sha1($userInfo->UserID. $userInfo->Username. $email);
	}
}

?>