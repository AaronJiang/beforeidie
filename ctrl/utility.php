<?php
	include_once('../model/data_funs.inc');

	function get_log_comments_full($logID){
		$comments = get_log_comments($logID);
		
		foreach($comments as &$comm){
			// comment poster
			$comm['Poster'] = get_username_by_id($comm['PosterID']);
					
			// comment poster avatar
			$comm['Avatar'] = get_gravatar($comm['PosterID']);
					
			// comment receiver, receiverID
			if(!$comm['IsRoot']){
				$comm['ReceiverID'] = get_posterid_by_commentid($comm['ParentCommentID']);
				$comm['Receiver'] = get_username_by_id($comm['ReceiverID']);
			}
		}
		
		return $comments;
	}
	
?>