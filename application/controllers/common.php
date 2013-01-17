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
		auth_check('public');
		
		$feedbackSubject = $this->input->post('feedbackSubject');
		$feedbackContent = $this->input->post('feedbackContent');

		$mailSubject = 'Beforeidie-意见反馈';

		$mailContent .= "<h1 style='margin:0 0 10px 0;font-size:15px'>";

		if(isset($_SESSION['valid_user_id'])){
			$mailContent .= "<a href='". base_url('person'). "/". $_SESSION['valid_user_id']. "'>". $_SESSION['valid_user']. "</a> 说：";	
		}
		else{
			$mailContent .= "有人说：";
		}

		$mailContent .= "</h1>";

		if(trim($feedbackSubject) != ""){
			$mailContent .= "<p style='margin:0 0 10px 0;font-size:16px;font-weight:bold;font-family:微软雅黑;'>". $feedbackSubject. "</p>";
		}

		$mailContent .= "<p style='margin:0;'>". $feedbackContent. "</p>";

		@$this->smtp->sendmail('hustlzp@qq.com', $mailSubject, $mailContent);
		redirect_back();
	}
}

?>