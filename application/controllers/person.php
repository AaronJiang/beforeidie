<?php 

class Person extends CI_Controller{

// page personal space

	// view
	function index($userID = ''){

		// 获取userID
		if($userID == ''){
			if(isset($_SESSION['valid_user_id'])){
				// 进入当前登陆用户的主页
				$userID = $_SESSION['valid_user_id'];
			} else {
				// 若未指定userID且未登录
				redirect('discover');
			}
		}

		//setcookie("ua", base64_encode("You are authed!"), time()-3600);

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
				$data['hasGravatar'] = $this->gravatar->check_gravatar($email);
			}
		} else {
			$data['isCreator'] = FALSE;
		}

		// goals
		$this->load->model('Goal_model');
		$data['goals'] = $this->Goal_model->get_goals($userID, $data['isCreator']);

		$this->load->view('header.php', $data);
		$this->load->view('person/person.php', $data);
		$this->load->view('footer.php');
	}

	function change_goal_index(){
		$idArray = explode("&", $_REQUEST['idArray']);
		$indexArray = explode("&", $_REQUEST['indexArray']);

		$this->load->model('Goal_model');
		echo $this->Goal_model->change_goal_index($idArray, $indexArray)? 1: 0;
	}

	function change_goal_lock(){
		$this->load->model('Goal_model');
		echo $this->Goal_model->change_goal_lock($_REQUEST['goalID'], $_REQUEST['isPublic'])? 1: 0;
	}
			
	function drop_goal(){
		$this->load->model('Goal_model');
		echo $this->Goal_model->drop_goal($_REQUEST['goalID'])? 1: 0;		
	}
}

?>