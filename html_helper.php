<?php
	require_once('public_funs.php');
	require_once('data_funs.inc');

	//输出动态 Poster's avatar HTML 代码
	function html_output_dynamic_avatar($dyn){
		echo "<a href='person.php?userID=". $dyn['PosterID']. "'>"
				. "<img class='dynamic-poster-profile' 
						title='". $dyn['Poster']. "' 
						src='". get_user_profile($dyn['PosterID']). "' />"
			. "</a>";
	}
	
	//输出 Comments
	function html_output_comments($logID){
		$comments = get_log_comments($logID);
		if(count($comments) == 0){
			return;
		}
		echo "<div class='comments-wap'>";
		foreach($comments as $comm){
			$posterID = $comm['PosterID'];
			$poster = get_username_by_id($comm['PosterID']);
			
			//item
			echo "<div class='comment-item clearfix'>"
				//avatar
				. "<a href='person.php?userID=". $comm['PosterID']. "'>"
					. "<img class='comment-poster-profile'
							title='". $poster. "'
							src='". get_user_profile($comm['PosterID']). "'/>"
				. "</a>"
								
				//main
				. "<div class='comment-main'>"
					//header
					. "<div class='comment-header'>";
						if($comm['IsRoot']){
							echo "<a href='person.php?userID=". $posterID. "'>". $poster. "</a>"
								. " : "
								. $comm['Comment'];
						}
						else {
							$receiverID = get_posterid_by_commentid($comm['ParentCommentID']);
							$receiver = get_username_by_id($receiverID);
							echo "<a href='person.php?userID=". $posterID. "'>". $poster. "</a>"
								. " : "
								. "<a href='person.php?userID=". $receiverID. "'>@". $receiver. "</a> "
								. $comm['Comment'];
						}
					echo "</div>"
					
					//footer
					. "<div class='comment-footer'>"
						. "<span class='comment-time'>". $comm['Time']. "</span>"
						. "&nbsp;"
						. "<span class='comment-cmd comment-cmd-new'
								data-log-id='". $logID . "'
								data-parent-comment-id='". $comm['CommentID']. "'
								data-poster-id='". $_SESSION['valid_user_id']. "'
								data-is-root='0'>回复<span>"
					. "</div>"	//end-footer
				. "</div>"	//end-main
			. "</div>";	//end-item
		}
		echo "</div>";	//end-comments
	}
	
	//输出 Panel Header
	function html_out_panel_header($title, $cmd, $cmdID, $cmdUrl, $isAuth){
		echo "<div class='panel-header'>";
		echo " <div class='panel-title'>". $title. "</div>";
		
		if(isset($cmd)){
			//若未授权，则不输出命令
			if(isset($isAuth) && !$isAuth){
				echo "</div>";
				return;
			}
			
			echo "<div class='panel-cmd-wapper'>";		
			echo "<span class='panel-underline'>_ _ _</span>";
			echo "<a class='panel-cmd' id='". $cmdID. "'";
			
			if(trim($cmdUrl) != ""){
				echo "href='". $cmdUrl. "'";
			}
			
			echo ">". $cmd. "</a>";
			echo "</div>";
		}
		
		echo "</div>";
	}
?>