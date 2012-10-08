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
	
	//输出好友动态的 HTML 代码
	function html_output_dynamics_others($dyns, $userID){
	
		foreach($dyns as $dyn){
			echo "<div class='dynamic-item clearfix new-comment-parent'>";
			
			switch($dyn['type']){
			
			//发表新的 Log
			case 'newLog':
				html_output_dynamic_avatar($dyn);
				
				//content
				echo "<div class='dynamic-content-wap'>"
						//header
						. "<p class='dynamic-header'>"		
							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
							. " 在目标 "
							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
							. " 中写到："
						. "</p>";
						
						//log
						if($dyn['LogTitle'] != ""){
							echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";
						}
						echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"

						//footer
						. "<div class='dynamic-footer'>"
							. "<a class='small-cmd cmd-new-comment'
									data-poster-id='". $userID. "'
									data-log-id='". $dyn['LogID']. "'
									data-is-root='1'
									data-avatar-url='". get_user_profile($userID). "'
									>回复</a>"
							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"
						. "</div>"
					. "</div>";
					
					//comments
					html_output_comments($dyn['LogID']);
				break;
			
			//设立新的 Goal
			case 'newGoal':
				html_output_dynamic_avatar($dyn);
				
				echo "<div class='dynamic-content-wap'>" 
						. "<p class='dynamic-header'>"	
							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
							. " 设立了目标 "
							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
						. "</p>"
						. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"
						
						//footer
						. "<div class='dynamic-footer'>";
							$isCheered = check_goal_is_cheered($userID, $dyn['GoalID']);
							if(!$isCheered){
								echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $userID. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";
							}
							echo "<p class='dynamic-time'>". $dyn['Time']. "</p>"
						. "</div>"
					. "</div>";
				break;
			
			//完成目标
			case 'finishGoal':
				html_output_dynamic_avatar($dyn);
				
				echo "<div class='dynamic-content-wap'>" 
						. "<p class='dynamic-header'>"	
							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
							. " 完成了目标 "
							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
						. "</p>";
						
						//log
						if($dyn['LogTitle'] != ""){
							echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";
						}
						echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"
						
						//footer
						. "<div class='dynamic-footer'>";
							$isCheered = check_goal_is_cheered($userID, $dyn['GoalID']);
							if(!$isCheered){
								echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $userID. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";
							}
							echo "<p class='dynamic-time'>". $dyn['Time']. "</p>"
						. "</div>"
					. "</div>";
				break;
				
			//关注了他人
			case 'followOther':
				html_output_dynamic_avatar($dyn);
				
				echo "<div class='dynamic-content-wap'>"
						."<p class='dynamic-header'>"
							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
							. " 关注了 "
							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['FolloweeID']. "'>". $dyn['Followee']. "</a>"							
						. "</p>"
						
						. "<div class='dynamic-footer'>"
							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"
						. "</div>"
					. "</div>";
				break;
			}
			
			echo "</div>";
		}
	}

	//输出某人的动态
	function html_output_dynamics_single($dyns){
	
		@session_start();
		
		foreach($dyns as $dyn){
			echo "<div class='dynamic-item clearfix new-comment-parent'>"
					. "<img title='". $dyn['Poster']. "' class='user-avatar' src='". get_user_profile($dyn['PosterID']). "'>";
				
					//若为 Log 相关的动态
					if($dyn['type'] == 'newLog'){

						echo "<div class='dynamic-content'>"
							//header
							. "<p class='dynamic-header'>"
								. "<a class='username' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
								. " 在 "
								. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
								. " 中写到："
							. "</p>";
							
							//log content
							if($dyn['LogTitle'] != ""){
								echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";
							}
							echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"
								
							//footer
							. "<div class='dynamic-footer'>"
								. "<a class='small-cmd cmd-new-comment'
										data-poster-id='". $_SESSION['valid_user_id']. "'
										data-log-id='". $dyn['LogID']. "'
										data-is-root='1'
										data-avatar-url='". get_user_profile($_SESSION['valid_user_id']). "'
										>回复</a>"
								. "<p class='post-time'>". $dyn['Time']. "</p>"
							. "</div>"
						. "</div>";
							
						//comments
						html_output_comments($dyn['LogID']);
					}
					//若为 Goal 相关的动态
					else if($dyn['type'] == 'newGoal'){

						echo "<div class='dynamic-content'>"
						
							//header
							. "<p class='dynamic-header'>"
								. "<a class='username' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
								. " 设立目标 "
								. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
							. "</p>"
							
							//reason
							. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"
							
							//footer
							. "<div class='dynamic-footer'>";
								$isMe = ($_SESSION['valid_user_id'] == $dyn['GoalID']);
								$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $dyn['GoalID']);
								if(!$isCheered && !$isMe){
									echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $_SESSION['valid_user_id']. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";
								}
								echo "<p class='post-time'>". $dyn['Time']. "</p>"
							. "</div>"
							
						. "</div>";
					}
	
				echo "</div>";
		}	
	}	
	
	//输出与我相关的动态的 HTML 代码
	function html_output_dynamics_me($dyns){

		foreach($dyns as $dyn){
			echo "<div class='dynamic-item clearfix new-comment-parent'>";
			
			switch($dyn['type']){
			
			//若为针对 Goal 的评论		
			case 'newCommentOnMyLog':
	
				html_output_dynamic_avatar($dyn);

				echo "<div class='dynamic-content-wap'>"
					. "<div class='dynamic-header'>"
						. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>";
						if($dyn['CommentIsRoot']){
							echo " 评论了我的目标 "
							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>";
						}
						else{
							echo " 在我的目标 "
							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
							. " 中回复";
						}
						echo "："
					. "</div>"
					. "<div class='dynamic-log-wap'>"
						. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"
						. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"
					. "</div>"
					
				. "</div>";

				//回复
				html_output_comments($dyn['LogID']);
				
				break;
				
			//若为针对 Comment 的评论				
			case 'newCommentOnOtherLog':

				html_output_dynamic_avatar($dyn);
					
				echo "<div class='dynamic-content-wap'>"
					//header
					. "<div class='dynamic-header'>"
						. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
						. " 在目标 "
						. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
						. " 中回复："
					. "</div>"
						
					//log
					. "<div class='dynamic-log-wap'>"
						. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"
						. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"
					. "</div>"

				. "</div>";
					
				//Comments
				html_output_comments($dyn['LogID']);
				
				break;
				
			//若为鼓励			
			case 'newCheer':

				//avatar
				html_output_dynamic_avatar($dyn);
				
				echo "<div class='dynamic-content-wap'>"
					//header
					."<p class='dynamic-header'>"
						. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
						. " 鼓励了我的目标 "
						. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
					. "</p>"
					
					//footer
					. "<div class='dynamic-footer'>"
						. "<p class='dynamic-time'>". $dyn['Time']. "</p>"
					. "</div>"
				. "</div>";
				
				break;
				
			//若为关注				
			case 'newFollow':
				
				//avatar
				html_output_dynamic_avatar($dyn);
				
				echo "<div class='dynamic-content-wap'>"
					."<p class='dynamic-header'>"
						. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
						. " 关注了我"
					. "</p>"
					
					. "<div class='dynamic-footer'>"
						. "<p class='dynamic-time'>". $dyn['Time']. "</p>"
					. "</div>"		
				. "</div>";	
				break;
			}	
			
			echo "</div>";	
		}
	}
	
	//输出 Logs 的 HTML 代码
	function html_output_logs($logs, $isCreator){
		
		@session_start();
		
		if(count($logs) != 0){
			foreach($logs as $log){
				echo "<div class='log-item new-comment-parent'>";

					//标题和内容
					if($log['LogTitle'] != ''){
						echo "<p class='log-title'>". $log['LogTitle']. "</p>";			
					}
					echo "<p class='log-content'>". $log['LogContent']. "</p>";
				
					//操作按钮
					echo "<div class='log-cmd-time-wap'>"
						. "<a class='small-cmd cmd-new-comment' 
								data-log-id='". $log['LogID']. "'
								data-poster-id='". $_SESSION['valid_user_id']. "'
								data-is-root='1'
								data-avatar-url='". get_user_profile($_SESSION['valid_user_id']). "'
								>回复";

						if($log['commentsNum']){
							echo "(". $log['commentsNum']. ")";
						}
						echo "</a>";

						if($isCreator){
							echo "<a class='small-cmd log-cmd-edit' 
									data-log-id='". $log['LogID'] ."'>编辑</a>";
									
								if($log['TypeID'] != 0){
									echo "<a class='small-cmd log-cmd-delete'
											href='log_proc.php?proc=delete&logID=". $log['LogID']. "'>删除</a>";
								}
						}
						
						//时间
						echo "<p class='log-time'>". $log['LogTime']. "</p>"
					. "</div>";
				
					//回复
					html_output_comments($log['LogID']);
				echo "</div>";
			}
		}	
	}
	
	//输出 Comments
	function html_output_comments($logID){
		$comments = get_log_comments($logID);
		if(count($comments) == 0){
			return;
		}
		
		@session_start();
		
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
				. "<link rel='stylesheet' href='style/style.css' />"
				/*. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"*/
				. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
				. "<script type='text/javascript' src='js/jquery.validationEngine-zh_CN.js'></script>"
				. "<script type='text/javascript' src='js/jquery.validationEngine.js'></script>"
				. "<link rel='stylesheet' href='style/validationEngine.jquery.css' type='text/css'/>"
			. "</head>"
			
			. "<body id=". $bodyID. ">";
			
			//浏览器检测
			if(check_browser() == 'IE'){
				html_output_browser_warning();
			}
	}
	
	//输出未认证时的 HTML 尾
	function html_output_unauthed_footer(){
		echo "</body>"
			. "</html>";
	}

	//输出浏览器警告信息
	function html_output_browser_warning(){
		echo "<div id='browser-warning'>"
				. "<img src='imgs/confuse.png' />"
				. "<p>纳尼？亲，你还在使用 IE（或基于 IE 内核）的浏览器啊？那我可不能放你进去！</p>"
				. "<p>你可以：下载地球最好的浏览器 - <a target='_blank' href='http://www.google.cn/intl/zh-CN/chrome/browser/'>Chrome</a>，你会很快爱上它的极速与清爽！</p>"
				. "<p>或者：下载全中国最好的浏览器 - <a target='_blank' href='http://ie.sogou.com/'>搜狗浏览器</a>，并默认启用高速模式！</p>"
			. "</div>";
	}
	
	//输出认证后的 HTML 头
	function html_output_authed_header($title, $bodyID){
	
		//用户资格检测
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
					/*
					. "<meta http-equiv='Pragma' content='no-cache'>"
					. "<meta http-equiv= 'Expires' content='0'>"
					. "<meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate'>"
					. "<meta http-equiv='expires' CONTENT='Wed, 26 Feb 1997 08:21:57 GMT'>"
					*/
					. "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />"
					. "<title>". $title. "</title>"
					. "<link rel='stylesheet' href='style/jquery-ui-1.8.22.custom.css' />"	
					. "<link rel='stylesheet' href='style/style.css' />"
					/*. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"*/
					. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
					. "<script type='text/javascript' src='js/jquery.validationEngine-zh_CN.js'></script>"
					. "<script type='text/javascript' src='js/jquery.validationEngine.js'></script>"
					. "<link rel='stylesheet' href='style/validationEngine.jquery.css' type='text/css'/>"
					. "<script type='text/javascript' src='js/goal-feedback.js'></script>"
				. "</head>"
				
				. "<body id=". $bodyID. ">";
				
					//浏览器检测
					if(check_browser() == 'IE'){
						html_output_browser_warning();
					}
					
					//反馈框
					echo "<div id='feedback-panel'>"
						. "<div id='feedback-tag'></div>"
						. "<form action='feedback_proc.php'method='post' id='form-feedback'>"
							. "<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />"
							. "<textarea id='feedback-content' class='validate[required]' name='feedbackContent' rows='10' placeholder='意见内容'></textarea>"
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
				. "<span>在 <img id='logo' src='imgs/new.png' /> 设立了 <b>". get_all_goals_num() ."</b> 个目标，"
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