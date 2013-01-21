<?php 

class Person extends CI_Controller{

// page personal space

	// view
	function index($userID = ''){
		auth_check('public');

		// 获取userID
		if($userID == ''){
			if(isset($_SESSION['valid_user_id'])){
				// 进入当前登陆用户的主页
				$userID = $_SESSION['valid_user_id'];
			}
			else{
				// 若未指定userID且未登录
				redirect('discover');
			}
		}

		$this->load->model('Account_model');
		$user = $this->Account_model->get_user_by_id($userID);

		// pageinfo
		$data['pageTitle'] = $user->Username;
		$data['pageID'] = 'page-person';

		// userinfo
		$data['user'] = $user;

		// isCreator
		if(isset($_SESSION['valid_user_id'])){
			$data['isCreator'] = ($userID == $_SESSION['valid_user_id']);

			if($data['isCreator']){
				$email = $this->Account_model->get_email_by_id($userID);
			}
		}
		else{
			$data['isCreator'] = FALSE;
		}
	
		// goals
		$this->load->model('Goal_model');
		$data['goals'] = $this->Goal_model->get_goals($userID, $data['isCreator']);

		$this->load->view('header.php', $data);
		$this->load->view('person/person.php', $data);
		$this->load->view('footer.php');
	}

	// ajax
	function change_goal_index(){
		auth_check('private');

		$idArray = explode("&", $this->input->post('idArray'));
		$indexArray = explode("&", $this->input->post('indexArray'));

		$this->load->model('Goal_model');

		// not empty / count match / id check
		if( count($idArray) <= 1
			OR count($idArray) != count($indexArray)
			OR $_SESSION['valid_user_id'] != $this->Goal_model->get_user_by_goal($idArray[0]))
		{
			echo 0;
			return;
		}

		echo $this->Goal_model->change_goal_index($idArray, $indexArray)? 1: 0;
	}

	// ajax
	function change_goal_lock(){
		auth_check('private');

		$goalID = $this->input->post('goalID');
		$isPublic = $this->input->post('isPublic');

		$this->load->model('Goal_model');

		// id check
		if( $_SESSION['valid_user_id'] != $this->Goal_model->get_user_by_goal($goalID)
			OR ($isPublic != 0 AND $isPublic != 1))
		{
			echo 0;
			return;
		}

		echo $this->Goal_model->change_goal_lock($goalID, $isPublic)? 1: 0;
	}
			
	function drop_goal(){
		auth_check('private');
		
		$goalID = $this->input->post('goalID');

		$this->load->model('Goal_model');

		// check process auth
		$goalUserID = $this->Goal_model->get_user_by_goal($goalID);
		if($_SESSION['valid_user_id'] != $goalUserID){
			echo 0;
			return;
		}

		echo $this->Goal_model->drop_goal($goalID)? 1: 0;		
	}
}

?>