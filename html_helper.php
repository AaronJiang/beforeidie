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
						. "<span class='comment-cmd cmd-new-comment'
								data-log-id='". $logID . "'
								data-parent-comment-id='". $comm['CommentID']. "'
								data-poster-id='". $_SESSION['valid_user_id']. "'
								data-is-root='0'
								data-avatar-url='". get_user_profile($_SESSION['valid_user_id']). "'
								>回复<span>"
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
	
	//输出未认证时的 HTML 头
	function html_output_unauthed_header($title, $bodyID){
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"
			. "<html xmlns='http://www.w3.org/1999/xhtml'>"
			. "<head>"
				. "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />"
				. "<title>". $title. "</title>"
				. "<link rel='stylesheet' href='style/jquery-ui-1.8.22.custom.css' />"	
				. "<link rel='stylesheet/less' href='style/style.less' />"
				. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"		
				. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery.validate-1.9.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
			. "</head>"
			. "<body id=". $bodyID. ">";
	}
	
	//输出未认证时的 HTML 尾
	function html_output_unauthed_footer(){
		echo "</body>"
			. "</html>";
	}

	//输出认证后的 HTML 头
	function html_output_authed_header($title, $bodyID){	
		session_start();
	
		if(!is_auth()){
			if(isset($_COOKIE['ua']) && isset($_COOKIE['ue'])){
				$email = base64_decode($_COOKIE['ue']);
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
			}
			else{
				page_jump('account_page_login.php');
			}
		}

		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"
			. "<html xmlns='http://www.w3.org/1999/xhtml'>"
				. "<head>"
					. "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />"
					. "<title>". $title. "</title>"
					. "<link rel='stylesheet' href='style/jquery-ui-1.8.22.custom.css' />"	
					. "<link rel='stylesheet/less' href='style/style.less' />"
					. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"					
					. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery.validate-1.9.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
					. "<script type='text/javascript' src='js/goal-feedback.js'></script>"
				. "</head>"
				
				. "<body id=". $bodyID. ">"
					. "<div id='feedback-panel'>"
						. "<div id='feedback-tag'></div>"
						. "<form action='feedback_proc.php'method='post' id='form-give-feedback'>"
							. "<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />"
							. "<textarea id='feedback-content' name='feedbackContent' rows='10' placeholder='意见内容'></textarea>"
							. "<input id='submit-feedback' type='submit' value='发送'>"
						. "</form>"
					. "</div>"
					
					. "<div id='header'>"
						. "<div id='header-wap'>"
							. "<a id='logo-link' href='home.php'></a>"
			
							. "<ul id='nav' class='clearfix'>"
								. "<li><a id='nav-goals' href='home.php'>我的Goals</a></li>"
								. "<li><a id='nav-dynamic' href='dynamic_page_followees.php'>动态</a></li>"
								. "<li><a id='nav-person' href='person.php?userID=". $_SESSION['valid_user_id']. "'>个人主页</a></li>"		
								. "<li><a id='nav-newgoal' href='goal_page_new.php'>新建</a></li>"
								. "<li><a id='nav-discover' href='discover.php'>发现</a></li>"
							. "</ul>"
				
							. "<div id='account-info'>"
								. "<span><a href='account_page_details.php'>". $_SESSION['valid_user']. "的账号</a></span>"
								. "<span><a href='account_proc.php?proc=logout'>退出</a></span>"
							. "</div>"
						. "</div>"
					. "</div>"
		
					. "<div id='content-wap' class='clearfix'>";
	}
	
	//输出认证后的 HTML 尾
	function html_output_authed_footer(){
		echo "</div>"	
			. "<div id='footer'>"
				. "<a href='about.php'>Goal是什么</a>"
				. "<a href='terms.php'>条款与隐私</a>"
				. "<span>©2012 hustlzp.com, all rights reserved.</p>"
			. "</div>"
		. "</body>"
		. "</html>";
	}

	//输出登陆页面的标语
	function html_output_slogan(){
		echo "<p id='login-slogan'>"
				. "<span>已经有 <b>". get_all_users_num() ."</b> 位用户，</span>"
				. "<span>在 <img id='logo' src='imgs/new.png' /> 建立了 <b>". get_all_goals_num() ."</b> 个梦想，"
				. "</span><span>写下了 <b>". get_all_logs_num() ."</b> 条记录</span>"
			. "<p>";	
	}	

	//输出个人页面的 Goals
	function html_output_person_goals($userID, $type){
		$goals = get_goals($userID, $type, false);
		foreach($goals as $goal){
			$goalID = $goal['GoalID'];
			echo "<div class='goal-item'>"
					."<p class='goal-title'><a href='goal_page_details.php?goalID=". $goalID. "'>". $goal['Title']. "</a></p>"
					."<p class='goal-reason'>". $goal['Reason']. "</p>"
					. "<div class='goal-num-wap'>"
						. "<span>". get_goal_steps_num($goalID). " 规划</span>"
						. " · "
						. "<span>". get_goal_logs_num($goalID). " 记录</span>"
						. " · "
						. "<span>". get_goal_cheers_num($goalID). " 鼓励</span>"
					. "</div>";
			echo "</div>";
		}
	}
	
?>