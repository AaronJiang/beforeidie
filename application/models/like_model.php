<?php 

class Like_model extends CI_Controller{

// GET

	function get_likes($userID){
		$query = "SELECT goals.GoalID, goals.Title, goals.Content, users.UserID, users.Username\n"
				. "FROM likes, goals, users\n"
				. "WHERE likes.UserID = ?\n"
				. "AND likes.GoalID = goals.GoalID\n"
				. "AND goals.UserID = users.UserID";
		$result = $this->db->query($query, array($userID));
		return $result->result();
	}

	function get_likes_num($userID){
		$query = "SELECT COUNT(*) AS likesNum FROM likes WHERE UserID = ?";
		$result = $this->db->query($query, array($userID));
		$row = $result->row();
		return $row->likesNum;
	}

// CHECK

	function check_is_like($goalID, $userID){
		$query = "SELECT * FROM likes WHERE GoalID = ? AND UserID = ?";
		$result = $this->db->query($query, array($goalID, $userID));
		return ($result->num_rows() > 0);
	}

// UPDATE

	function change_goal_like($goalID, $userID, $isLike){
		if($isLike == 1){
			$query = "DELETE FROM likes WHERE GoalID = ? AND UserID = ?";
		}
		else{
			$query = "INSERT INTO likes (GoalID, UserID) VALUES (?, ?)";
		}
		return $this->db->query($query, array($goalID, $userID));
	}

	

}

?>