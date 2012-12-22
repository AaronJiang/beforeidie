<?php
	include_once('../model/data_funs.inc');

	// 构建完整的评论信息
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
	
	// 浏览器检测
	function browser_check(){
		if(get_browser_type() == 'IE'){
			redirect('Public', 'browser_warning');
		}
	}

	// 登陆检测
	function auth_check(){
		session_start();
		if(!is_auth()){
			if(isset($_COOKIE['ua']) && isset($_COOKIE['ue'])){
				$email = base64_decode($_COOKIE['ue']);
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
			}
			else{
				redirect('Account', 'login');
			}
		}

		header("Last-Modified: ". gmdate("D, d M Y H:i:s"). "GMT"); 
		header("Cache-Control: no-cache, must-revalidate");
	}
	
?>