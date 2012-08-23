<?php
	require_once('public_funs.php');

	//增加留言
	function new_comment($comment, $posterID, $parentID, $isRoot){
		if(!get_magic_quotes_gpc()){
			$comment = addslashes($comment);
		}

		$query = "insert into comments (Comment, PosterID, ParentID, IsRoot) values\n"
				. "('". $comment. "', '". $posterID. "', '". $parentID. "', '". $isRoot. "')";

		return db_exec($query);
	}
?>