<?php 

class Common extends CI_Controller{

	function logout(){
		auth_check('private');

		@session_destroy();

		//删除cookie
		setcookie("ua", base64_encode("You are authed!"), time()-3600, '/');
		redirect('discover');
	}


	function send_feedback(){
		auth_check('private');

		$feedbackContent = $this->input->post('feedbackContent');

		// if empty, jump back
		if(trim($feedbackContent) == ""){
			redirect_back();
		}

		$mailSubject = 'Beforeidie-意见反馈';

		$mailContent = "<h1 style='margin:0 0 10px 0;font-size:15px'>";
		$mailContent .= "<a href='". base_url('person'). "/". $_SESSION['valid_user_id']. "'>". $_SESSION['valid_user']. "</a> 说：";
		$mailContent .= "</h1>";
		$mailContent .= "<p style='margin:0;'>". $feedbackContent. "</p>";

		@$this->smtp->sendmail('hustlzp@qq.com', $mailSubject, $mailContent);
		redirect_back();
	}
}

?>