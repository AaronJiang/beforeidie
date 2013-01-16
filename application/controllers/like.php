<?php

class Like extends CI_Controller{

	function index(){
		auth_check('private');
		
		$data['pageTitle'] = '收藏';
		$data['pageID'] = 'page-like';

		$this->load->model('Like_model');
		$goals = $this->Like_model->get_likes($_SESSION['valid_user_id']);

		foreach ($goals as &$goal) {
			// 截取定长的中文字符
			if(mb_strlen($goal->Content, 'utf8') > 25){
				$goal->Content = mb_substr(strip_tags($goal->Content), 0, 25, 'utf8'). '...';
			}
		}
		$data['goals'] = $goals;

		$this->load->view('header.php', $data);
		$this->load->view('like/likes.php', $data);
		$this->load->view('footer.php');
	}

}

?>