<?php	require_once('data_funs.inc');	require_once('html_helper.php');	html_output_authed_header("动态", 'page-followees-dynamics');?><script type='text/javascript' src='js/goal-comment.js'></script><div id='main-panel'>	<div id='dynamic-sel-wap'>		<a class='dynamic-sel dynamic-sel-others' href='?type=others'>好友动态</a		><a class='dynamic-sel dynamic-sel-me' href='?type=me'>与我相关</a>	</div>	<?php	$userID = $_SESSION['valid_user_id'];	$dynamicType = isset($_REQUEST['type'])? $_REQUEST['type']: 'others';		if($dynamicType == 'others'){		//好友动态		$dyns = get_followee_dynamics($userID);				foreach($dyns as $dyn){			echo "<div class='dynamic-item clearfix'>";						//发表新的 Log			switch($dyn['type']){						case 'newLog':				html_output_dynamic_avatar($dyn);								//content				echo "<div class='dynamic-content-wap'>"						//header						. "<p class='dynamic-header'>"									. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 在目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"							. " 中写到："						. "</p>";												//log						if($dyn['LogTitle'] != ""){							echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";						}						echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						//footer						. "<div class='dynamic-footer'>"							. "<a class='small-cmd cmd-new-comment'									data-poster-id='". $_SESSION['valid_user_id']. "'									data-log-id='". $dyn['LogID']. "'									data-is-root='1'									data-avatar-url='". get_user_profile($_SESSION['valid_user_id']). "'									>回复</a>"							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>";												//comments						html_output_comments($dyn['LogID']);					echo "</div>";				break;						//设立新的 Goal							case 'newGoal':				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>" 						. "<p class='dynamic-header'>"								. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 设立了目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"						. "</p>"						. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"												//footer						. "<div class='dynamic-footer'>";							$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $dyn['GoalID']);							if(!$isCheered){								echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $_SESSION['valid_user_id']. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";							}							echo "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>"					. "</div>";				break;						case 'finishGoal':				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>" 						. "<p class='dynamic-header'>"								. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 完成了目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"						. "</p>";												//log						if($dyn['LogTitle'] != ""){							echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";						}						echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"												//footer						. "<div class='dynamic-footer'>";							$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $dyn['GoalID']);							if(!$isCheered){								echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $_SESSION['valid_user_id']. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";							}							echo "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>"					. "</div>";				break;							//关注了他人			case 'followOther':				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>"						."<p class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 关注了 "							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['FolloweeID']. "'>". $dyn['Followee']. "</a>"													. "</p>"												. "<div class='dynamic-footer'>"							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>"					. "</div>";				break;			}						echo "</div>";		}	}	else if($dynamicType == 'me'){		//与我相关		$dyns = get_dynamics_about_me($userID);		foreach($dyns as $dyn){			echo "<div class='dynamic-item clearfix'>";						switch($dyn['type']){						//若为针对 Goal 的评论					case 'newCommentOnMyLog':					html_output_dynamic_avatar($dyn);									echo "<div class='dynamic-content-wap'>"						. "<div class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>";							if($dyn['CommentIsRoot']){								echo " 评论了我的目标 "								. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>";							}							else{								echo " 在我的目标 "								. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"								. " 中回复";							}							echo "："						. "</div>"						. "<div class='dynamic-log-wap'>"							. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"							. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						. "</div>";												//回复						html_output_comments($dyn['LogID']);					echo "</div>";				break;							//若为针对 Comment 的评论							case 'newCommentOnOtherLog':				html_output_dynamic_avatar($dyn);									echo "<div class='dynamic-content-wap'>"						//header						. "<div class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 在目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"							. " 中回复："						. "</div>"												//log						. "<div class='dynamic-log-wap'>"							. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"							. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						. "</div>";												//Comments						html_output_comments($dyn['LogID']);					echo "</div>";				break;							//若为鼓励						case 'newCheer':				//avatar				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>"						."<p class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 鼓励了我的目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"						. "</p>"						. "<div class='dynamic-footer'>"							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>"					. "</div>";				break;							//若为关注							case 'newFollow':								//avatar				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>"						."<p class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 关注了我"						. "</p>"											. "<div class='dynamic-footer'>"							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>"							. "</div>";					break;			}							echo "</div>";			}	}?></div><div id='sidebar-panel'>		<?php		$followees_num = get_followees_num($userID);				@html_out_panel_header('我的关注', '管理 ('.$followees_num.')', '', 'follower_page_admin_followees.php?followerID='.$userID);				$followees = get_followees($userID, 16);				foreach($followees as $fow){			echo "<a title='". $fow['Username']. "' href='person.php?userID=". $fow['UserID'] ."'>"					. "<img class='multi-user-profile' src='". get_user_profile($fow['UserID']). "' />"				. "<a>";		}	?></div><?php	html_output_authed_footer();?>