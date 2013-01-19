<?php 

class Goal extends CI_Controller{

// page goal details

	// view
	function details($goalID = ''){
		auth_check('public');

		if($goalID == ''){
			show_404();
		}

		// goal
		$this->load->model('Goal_model');
		$goal = $this->Goal_model->get_goal_by_id($goalID);
		$data['goal'] = $goal;

		// pageinfo
		$data['pageTitle'] = $goal->Title. ' - '. $goal->Username;
		$data['pageID'] = 'page-goal-details';

		// isCreator
		if(isset($_SESSION['valid_user_id'])){
			$data['isCreator'] = ($goal->UserID == $_SESSION['valid_user_id']);

			// isLike
			if( ! $data['isCreator']){
				$this->load->model('Like_model');
				$data['isLike'] = $this->Like_model->check_is_like($goalID, $_SESSION['valid_user_id']);
				$data['currUserID'] = $_SESSION['valid_user_id'];
			}
		}
		else{
			$data['isCreator'] = FALSE;
		}

		$this->load->view('header.php', $data);
		$this->load->view('goal/details.php', $data);
		$this->load->view('footer.php');
	}

	function update_goal(){
		auth_check('private');

		$goalID = $this->input->post('goalID');
		$goalTitle = $this->input->post('goalTitle');
		$goalContent = $this->input->post('goalContent');

		$this->load->model('Goal_model');

		// check process auth
		$goalUserID = $this->Goal_model->get_user_by_goal($goalID);
		if($_SESSION['valid_user_id'] != $goalUserID){
			echo 0;
			return;
		}

		echo $this->Goal_model->update_goal($goalID, $goalTitle, $goalContent)? 1: 0;
	}

	function change_goal_like(){
		auth_check('private');

		$goalID = $this->input->post('goalID');
		$userID = $this->input->post('userID');
		$isLike = $this->input->post('isLike');

		// check process auth
		if($_SESSION['valid_user_id'] != $userID){
			echo 0;
			return;
		}

		$this->load->model('Like_model');
		echo $this->Like_model->change_goal_like($goalID, $userID, $isLike)? 1: 0;
	}

	function change_goal_lock(){
		auth_check('private');

		$goalID = $this->input->post('goalID');
		$isPublic = $this->input->post('isPublic');

		$this->load->model('Goal_model');

		// check process auth
		$goalUserID = $this->Goal_model->get_user_by_goal($goalID);
		if($_SESSION['valid_user_id'] != $goalUserID){
			echo 0;
			return;
		}

		echo $this->Goal_model->change_goal_lock($goalID, $isPublic)? 1: 0;		
	}


// page new goal

	// view
	function add(){
		auth_check('private');

		$data['pageTitle'] = '添加';
		$data['pageID'] = 'page-new-goal';

		// userID
		$userID = $_SESSION['valid_user_id'];
		$data['userID'] = $userID;

		// goalsNum
		$this->load->model('Goal_model');
		$data['isFull'] = ($this->Goal_model->get_goals_num($userID, true) >= 16);		

		$this->load->view('header.php', $data);
		$this->load->view('goal/add.php', $data);
		$this->load->view('footer.php');
	}

	function add_goal(){
		auth_check('private');
		
		$userID = $this->input->post('userID');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$isPublic = $this->input->post('isPublic');

		//echo $title. $content;
		//exit();

		if($_SESSION['valid_user_id'] != $userID){
			echo 0;
			return;
		}

		$this->load->model('Goal_model');
		echo $this->Goal_model->new_goal($userID, $title, $content, $isPublic)? 1: 0;
	}
}


?>