<?php
	require_once('public_funs.php');

	//增加留言
	function new_comment($comment, $posterID, $logID, $parentCommentID, $isRoot){
		if(!get_magic_quotes_gpc()){
			$comment = addslashes($comment);
		}

		$query = "INSERT INTO comments (Comment, PosterID, LogID, ParentCommentID, IsRoot) VALUES\n"
				. "('". $comment. "', '". $posterID. "', '". $logID. "', '". $parentCommentID. "', '". $isRoot. "')";

		return db_exec($query);
	}
	
	//获取某 Log 的所有 Comments
	function get_log_comments($logID){
		$query = "SELECT * FROM comments\n"
				. "WHERE comments.LogID = ". $logID. "\n"
				. "ORDER BY comments.Time asc";
				
		$result = db_exec($query);
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		
		return $rows;
	}
	
	//获取某 Log 的回复总数
	function get_log_comments_num($logID){
		$query = "SELECT count(*) as num FROM comments WHERE LogID = ". $logID;
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['num'];
	}
	
	//获取回复人
	function get_posterid_by_commentid($commentID){
		$query = "SELECT PosterID FROM comments WHERE CommentID = ". $commentID;
		$result = db_exec($query);
		$row = $result->fetch_assoc();
		return $row['PosterID'];
	}
?>