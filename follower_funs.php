<?php
	require_once('public_funs.php');
	
	//检查是否已经关注
	function check_is_followed($followerID, $followeeID){
		$query = "select * from followers where FollowerID = ". $followerID. " and FolloweeID = ". $followeeID;
		$result = db_exec($query);
		
		return ($result->num_rows > 0)? true: false;
	}
	
	//关注 Goal
	function follow_user($followerID, $followeeID){
		$query = "insert into followers (FollowerID, FolloweeID) values (". $followerID. ", ". $followeeID. ")";
		return db_exec($query);
	}
	
	//取消关注
	function disfollow_user($followerID, $followeeID){
		$query = "delete from followers where FollowerID = ". $followerID. " and FolloweeID = ". $followeeID;
		return db_exec($query);
	}
	
	//获取关注某 User 的用户
	function get_followers($followeeID, $num){
		$query = "SELECT users.Username, users.UserID\n"
				. "FROM users, followers\n"
				. "WHERE followers.FolloweeID = ". $followeeID. "\n"
				. "AND followers.FollowerID = users.UserID\n";
		
		if(isset($num)){
			$query .= "LIMIT 0, ". $num;
		}
		
		$result =db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;		
	}
	
	//获取关注某 User 的用户的数目
	function get_followers_num($followeeID){
		$query = "SELECT COUNT(*) as num\n"
				. "FROM followers\n"
				. "WHERE followers.FolloweeID = ". $followeeID. "\n";
		
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['num'];		
	}
	
	//获取某 User 所关注的用户
	function get_followees($followerID, $num){
		$query = "SELECT users.Username, users.UserID\n"
				. "FROM users, followers\n"
				. "WHERE followers.FollowerID = ". $followerID. "\n"
				. "AND followers.FolloweeID = users.UserID\n";
				
		if(isset($num)){
			$query .= "LIMIT 0, ". $num;
		}
		
		$result = db_exec($query);
		
		$array = array();
		while($row = $result->fetch_assoc()){
			array_push($array, $row);
		}
		
		return $array;
	}
	
	//获取某 User 所关注的用户的数目
	function get_followees_num($followerID){
		$query = "SELECT COUNT(*) as num\n"
				. "FROM followers\n"
				. "WHERE followers.FollowerID = ". $followerID. "\n";
		
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		
		return $row['num'];
	}
?>