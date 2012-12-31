<?php 

class Discover extends CI_Controller{

	function index(){
		$data['pageTitle'] = '浏览';
		$data['pageID'] = 'page-discover';

		// hot goals
		$userID = isset($_SESSION['valid_user_id'])? $_SESSION['valid_user_id']: -1;
		$this->load->model('Goal_model');
		$hotGoals = $this->Goal_model->get_hot_goals($userID);

		foreach($hotGoals as &$goal){
			// 截取定长的中文字符
			if(mb_strlen($goal->Content, 'utf8') > 45){
				$goal->Content = mb_substr(strip_tags($goal->Content), 0, 45, 'utf8'). '...';
			}
		}

		$data['hotGoals'] = $hotGoals;

		$this->load->view('header.php', $data);
		$this->load->view('discover/discover.php', $data);
		$this->load->view('footer.php');
	}
}

?>