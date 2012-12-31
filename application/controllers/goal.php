<?php 

class Goal extends CI_Controller{

// page goal details

	// view
	function details($goalID = ''){
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
		$this->load->model('Goal_model');
		echo $this->Goal_model->update_goal($_REQUEST['goalID'], $_REQUEST['goalTitle'], $_REQUEST['goalContent'])? 1: 0;
	}

	function change_goal_like(){
		$this->load->model('Like_model');
		echo $this->Like_model->change_goal_like($_REQUEST['goalID'], $_REQUEST['userID'], $_REQUEST['isLike'])? 1: 0;
	}

	function change_goal_lock(){
		$this->load->model('Goal_model');
		echo $this->Goal_model->change_goal_lock($_REQUEST['goalID'], $_REQUEST['isPublic'])? 1: 0;		
	}


// page new goal

	// view
	function add(){
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
		$this->load->model('Goal_model');
		echo $this->Goal_model->new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['content'], $_REQUEST['isPublic'])? 1: 0;
	}
}


?>