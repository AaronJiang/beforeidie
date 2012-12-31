<?php 

class Account extends CI_Controller{

// page login

	// view
	function login(){
		$data['pageTitle'] = '登陆';
		$data['pageID'] = 'page-login';

		// cookie email
		$data['email'] = @base64_decode($_COOKIE['ue']);

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/login.php', $data);
		$this->load->view('account/footer.php');
	}

	function plogin(){
		$email = $_REQUEST['email'];
		$pwd = $_REQUEST['password'];

		$this->load->model('Account_model');

		if( ! $this->Account_model->check_user_pwd_by_email($email, $pwd)){
			echo json_encode(array(array('input-email', false, '用户名或密码错误')));
		}
		else if( ! $this->Account_model->check_user_active($email, $pwd)){
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
			echo json_encode(array(array('input-email', false, '用户尚未激活')));
		}
		else{
			$userInfo = $this->Account_model->get_user_by_email($email);
			$_SESSION['valid_user'] = $userInfo->Username;
			$_SESSION['valid_user_id'] = $userInfo->UserID;
			
			//set cookies
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（一个月）
			setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（2天）

			// 完成ajax验证
			echo true;
		}
	}

// page register

	// view
	function register(){
		$data['pageTitle'] = '注册';
		$data['pageID'] = 'page-register';

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/register.php', $data);
		$this->load->view('account/footer.php');
	}

	function pregister(){
		$email = $_REQUEST['email'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		$this->load->model('Account_model');
		$isSucc = $this->Account_model->new_user($username, $password, $email);
		if($isSucc){
			$this->_send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
			redirect('account/active/register/'. $_REQUEST['email']);
		}
	}

	function check_email_repeat(){
		$email = $_REQUEST['fieldValue'];
		$this->load->model('Account_model');

		if($this->Account_model->check_email_repeat($email)){
			echo json_encode(array(array('email'), false));
		}
		else{
			echo json_encode(array(array('email'), true));
		}
	}

	function check_name_repeat(){
		$username = $_REQUEST['fieldValue'];
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
		$email = $_REQUEST['email'];
		$this->_send_active_email($email);
		redirect('account/active/sended/'. $email);
	}

	function active_account($email, $activeCode){
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
		$data['pageTitle'] = '忘记密码';
		$data['pageID'] = 'page-forgot-pwd';

		$data['from'] = $from;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/forgot_pwd.php', $data);
		$this->load->view('account/footer.php');
	}	

	function send_reset_pwd_email(){
		$email = $_REQUEST['email'];
		$this->_send_reset_pwd_email($email);
		redirect('account/forgot_pwd/sended');
		break;	
	}

// page reset password

	// view
	function reset_pwd($email){
		$data['pageTitle'] = '重置密码';
		$data['pageID'] = 'page-reset-pwd';

		$data['email'] = $email;

		$this->load->view('account/header.php', $data);
		$this->load->view('account/slogan.php');
		$this->load->view('account/reset_pwd.php', $data);
		$this->load->view('account/footer.php');		
	}

	function verify_reset_code($email, $reset_pwd_code){
		if($reset_pwd_code == $this->_gene_reset_pwd_code($email)){
			redirect('account/reset_pwd/'. $email);
		}
		else{
			redirect('account/forgot_pwd/resetFailed/'. $email);
		}		
	}

	function preset_pwd(){
		$this->load->model('Account_model');
		$isReset = $this->Account_model->change_pwd_by_email($_REQUEST['email'], $_REQUEST['pwd']);
		
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
		$data['pageTitle'] = '个人资料';
		$data['pageID'] = 'page-account-info';

		$userID = $_SESSION['valid_user_id'];
		$this->load->model('Account_model');

		$data['user'] = $this->Account_model->get_user_by_id($userID);
		$data['hasGravatar'] = $this->Account_model->check_gravatar($userID);

		$this->load->view('header.php', $data);
		$this->load->view('account/info.php', $data);
		$this->load->view('footer.php');
	}

	function change_sex(){
		$this->load->model('Account_model');
		echo $this->Account_model->change_sex($_REQUEST['userID'], $_REQUEST['sex'])? 1: 0;
	}

// page change password

	function change_pwd(){
		$data['pageTitle'] = '更改密码';
		$data['pageID'] = 'page-change-pwd';

		$data['userID'] = $_SESSION['valid_user_id'];

		$this->load->view('header.php', $data);
		$this->load->view('account/change_pwd.php', $data);
		$this->load->view('footer.php');
	}

	function check_pwd(){
		$userID = $_SESSION['valid_user_id'];
		$pwd = $_REQUEST['fieldValue'];
		
		$this->load->model('Account_model');
		if($this->Account_model->check_user_pwd_by_id($userID, $pwd)){
			echo json_encode(array(array('originalPwd'), true));
		}
		else{
			echo json_encode(array(array('originalPwd'), false));
		}
	}

	function pchange_pwd(){
		$this->load->model('Account_model');
		$this->Account_model->change_pwd_by_id($_REQUEST['userID'], $_REQUEST['newPwd']);
		redirect('account/info');
	}

// Utilities

	//发送激活邮件
	function _send_active_email($emailTo){

		$mailsubject = "Beforeidie-激活账户";

		//生成激活 Url
		$activeCode = $this->_gene_active_code($emailTo);
		$activeUrl = base_url('account/active_account/'. $emailTo. '/'. $activeCode);

		//邮件内容
		$mailbody = "<!DOCTYPE html><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
		$mailbody .= "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，激活你在Beforeidie上的账户：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
		$mailbody .= "</body></html>";
			
		//发送邮件
		$this->_send_email($emailTo, $mailsubject, $mailbody);
	}

	//生成激活码
	function _gene_active_code($email){
		$this->load->model('Account_model');
		$userInfo = $this->Account_model->get_user_by_email($email);
		return sha1($userInfo->UserID. $userInfo->Username. $email);
	}

	//发送密码重置邮件
	function _send_reset_pwd_email($emailTo){

		$mailsubject = "Beforeidie-重置密码";
		
		//生成激活 Url
		$activeCode = $this->_gene_reset_pwd_code($emailTo);

		$activeUrl = base_url('account/verify_reset_code/'. $emailTo. "/". $activeCode);

		//邮件内容
		$mailbody = "<!DOCTYPE html><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
		$mailbody .= "<h1 style='font-size:15px;font-family:微软雅黑;'>点击以下链接，重置你在Beforeidie上的账户密码：</h1>";
		$mailbody .= "<a href='". $activeUrl. "'>". $activeUrl. "</a>";
		$mailbody .= "</body></html>";
		
		//发送邮件
		$this->_send_email($emailTo, $mailsubject, $mailbody);		
	}

	//生成激活码
	function _gene_reset_pwd_code($email){
		$this->load->model('Account_model');
		$userInfo = $this->Account_model->get_user_by_email($email);
		return sha1($userInfo->UserID. $userInfo->Username. $email);
	}

	//发送邮件
	function _send_email($smtpemailto, $mailsubject, $mailbody){
		include_once('smtp.php');
		
		$smtpserver = "smtp.qq.com";
		$smtpserverport = 25;
		$smtpusermail = "hustlzp@qq.com";
		$smtpuser = "hustlzp@qq.com";
		$smtppass = "xiaowangzi";
		$mailtype = "HTML";

		$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
		$smtp->debug = FALSE;
		@$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);	
	}

}

?>