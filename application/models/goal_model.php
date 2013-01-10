<?php 

class Goal_model extends CI_Model{

// GET

	//获取单个目标
	function get_goal_by_ID($goalID){
		$query = "SELECT goals.*, users.Username, users.Sex AS UserSex\n"
				. "FROM goals, users\n"
				. "WHERE goals.GoalID = ?\n"
				. "AND goals.UserID = users.UserID";
		$result = $this->db->query($query, array($goalID));
		return $result->row();
	}

	// 获取某用户的所有目标
	function get_goals($userID, $isCreator){
		$query = "SELECT GoalID, Title, UserID, IsPublic, GoalIndex\n"
				. "FROM goals\n"
				. "WHERE UserID = ?\n";

		if(!$isCreator){
			$query .= "AND IsPublic = 1\n";
		}

		$query .= "ORDER BY GoalIndex ASC\n";
		
		$result = $this->db->query($query, array($userID));
		return $result->result();
	}

	// 获取某用户的目标总数
	function get_goals_num($userID, $isCreator){
		$query = "SELECT count(*) AS goalsNum FROM goals WHERE goals.UserID = ?\n";

		if(!$isCreator){
			$query .= "IsPublic = 1\n";
		}

		$result = $this->db->query($query, array($userID));
		$row = $result->row();
		return $row->goalsNum;
	}
	//获取热门目标
	function get_hot_goals($userID){
		$query = "SELECT goals.GoalID, goals.Title, goals.Content, users.UserID, users.Username\n"
			. "FROM goals, users\n"
			. "WHERE goals.UserID = users.UserID\n" 
			. "AND goals.isPublic = 1\n"
			. "AND goals.UserID != ?\n"
			. "AND goals.GoalID NOT IN\n"
				. "(SELECT GoalID FROM likes WHERE UserID = ?)\n"
			. "ORDER BY CreateTime DESC\n"
			. "LIMIT 0, 15";
		
		$result = $this->db->query($query, array($userID, $userID));
		return $result->result();
	}

	// 获取某user的goals的最大index
	function get_max_index($userID){
		$query = "SELECT MAX(GoalIndex) AS maxGoalIndex FROM goals WHERE UserID = ?";
		$result = $this->db->query($query, array($userID));
		$row = $result->row();
		return $row->maxGoalIndex;
	}

// NEW

	function new_goal($userID, $title, $content, $isPublic){
		$maxGoalIndex = $this->get_max_index($userID) + 1;
		$query = "INSERT INTO goals (UserID, Title, Content, IsPublic, GoalIndex) VALUES (?, ?, ?, ?, ?)";
		return $this->db->query($query, array($userID, $title, $content, $isPublic, $maxGoalIndex));
	}

// UPDATE

	function update_goal($goalID, $title, $content){
		$query = "UPDATE goals SET Title = ?, Content = ? WHERE GoalID = ?";
		return $this->db->query($query, array($title, $content, $goalID));
	}

	// 更改目标次序
	function change_goal_index($idArray, $indexArray){
		$isSucc = true;

		//echo microtime(). "<br>";

		for($i=0; $i<count($idArray); $i++){
			$query = "UPDATE goals SET GoalIndex = ? WHERE GoalID = ?";
			$isSucc = $isSucc && $this->db->query($query, array($idArray[$i], $indexArray[$i]));
		}

		//echo microtime(). "<br>";

		return $isSucc;
	}

	//放弃目标
	function drop_goal($goalID){
		$query = "DELETE FROM goals WHERE GoalID = ?";
		return $this->db->query($query, array($goalID));
	}

	function change_goal_lock($goalID, $isPublic){
		$setValue = $isPublic? 0: 1;
		$query = "UPDATE goals SET IsPublic = ? WHERE GoalID = ?";
		return $this->db->query($query, array($setValue, $goalID));
	}

}

?>