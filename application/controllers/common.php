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

		$feedbackContent = $this->input->post('feedbackContent');

		// if both are empty, return
		if(trim($feedbackContent) == ""){
			redirect_back();
		}

		$mailSubject = 'Beforeidie-意见反馈';

		// content
		$mailContent = "<h1 style='margin:0 0 10px 0;font-size:15px'>";

		if(isset($_SESSION['valid_user_id'])){
			$mailContent .= "<a href='". base_url('person'). "/". $_SESSION['valid_user_id']. "'>". $_SESSION['valid_user']. "</a> 说：";	
		}
		else{
			$mailContent .= "有人说：";
		}

		$mailContent .= "</h1>";

		if(trim($feedbackContent) != ""){
			$mailContent .= "<p style='margin:0;'>". $feedbackContent. "</p>";			
		}
		// end content

		@$this->smtp->sendmail('hustlzp@qq.com', $mailSubject, $mailContent);
		redirect_back();
	}
}

?>