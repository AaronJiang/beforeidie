<?php	require('header.php');	require_once('data_funs.inc');	require_once('html_helper.php');		if(!is_auth()){		page_jump('account_page_login.php');	}?><script type='text/javascript'>$(document).ready(function(){	$('body').prop('id', 'page-dynamic');		//弹出回复框	$('.comment-cmd-new').click(function(){		var posterID = $(this).data('poster-id'),			logID = $(this).data('log-id'),			isRoot = $(this).data('is-root'),			parentCommentID = isRoot? 0: $(this).data('parent-comment-id'),			html = "";				//构建 HTML 块		html = "<div class='comment-new-form clearfix'>"			+ "<div class='comment-input' contenteditable='true'></div>"			+ "<span class='comment-submit'>发表</span>"			+ "</div>";					//插入DOM		$(html).appendTo($(this).parents('.dynamic-item'))				.find('.comment-input')				.focus() //聚焦				.blur(function(){	//失焦则从DOM中删除					if($.trim($(this).text()) == ""){						$(this).parent().detach();					}				})			.next()				.click(function(){	//提交回复					var comment = $(this).prev().text();					$.ajax({						url: 'comment_proc.php',						type: 'post',						data: {							'proc': 'new',							'comment': comment,							'posterID': posterID,							'logID': logID,							'parentCommentID': parentCommentID,							'isRoot': isRoot						}					});										//删除回复框					$(this).parent().detach();										//刷新页面					location.reload();				});	});});</script><div id='dynamic-panel'>	<div id='dynamic-type-wap'>		<a class='dynamic-type dynamic-type-others' href='dynamic.php?type=others'>好友动态</a		><a class='dynamic-type dynamic-type-me' href='dynamic.php?type=me'>与我相关</a>	</div>	<?php	$userID = $_SESSION['valid_user_id'];	$dynamicType = isset($_REQUEST['type'])? $_REQUEST['type']: 'others';		if($dynamicType == 'others'){		//好友动态		$dyns = get_followee_dynamics($userID);				foreach($dyns as $dyn){			echo "<div class='dynamic-item clearfix'>";						//若为 Log 相关的动态			switch($dyn['type']){						case 'newLog':				html_output_dynamic_avatar($dyn);								//content				echo "<div class='dynamic-content-wap'>"						//header						. "<p class='dynamic-header'>"									. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 在 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"							. " 中写到："						. "</p>";												//log						if($dyn['LogTitle'] != ""){							echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";						}						echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						//footer						. "<div class='dynamic-footer'>"						. "<a class='small-cmd comment-cmd-new'									data-poster-id='". $_SESSION['valid_user_id']. "'									data-log-id='". $dyn['LogID']. "'									data-is-root='1'>回复</a>"							. "<p class='dynamic-time'>". $dyn['Time']. "</p>"						. "</div>";												//comments						html_output_comments($dyn['LogID']);					echo "</div>";				break;						//若为 Goal 相关的动态							case 'newGoal':				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>" 						. "<p class='dynamic-header'>"								. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 设立目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"						. "</p>"						. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"					. "</div>"										. "<div class='dynamic-footer'>";						$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $dyn['GoalID']);						if(!$isCheered){							echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $_SESSION['valid_user_id']. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";						}						echo "<p class='dynamic-time'>". $dyn['Time']. "</p>"					. "</div>";				break;			}						echo "</div>";		}	}	else if($dynamicType == 'me'){		//与我相关		$dyns = get_dynamics_about_me($userID);		foreach($dyns as $dyn){			echo "<div class='dynamic-item clearfix'>";						switch($dyn['type']){						//若为针对 Goal 的评论					case 'newCommentOnGoal':					html_output_dynamic_avatar($dyn);									echo "<div class='dynamic-content-wap'>"						. "<div class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 评论了我的目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"							. "："						. "</div>"						. "<div class='dynamic-log-wap'>"							. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"							. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						. "</div>";						//回复						html_output_comments($dyn['LogID']);					echo "</div>";				break;							//若为针对 Comment 的评论							case 'newCommentOnComment':				html_output_dynamic_avatar($dyn);									echo "<div class='dynamic-content-wap'>"						//header						. "<div class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 在目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"							. " 中回复："						. "</div>"												//log						. "<div class='dynamic-log-wap'>"							. "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>"							. "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"						. "</div>";												//Comments						html_output_comments($dyn['LogID']);					echo "</div>";				break;							//若为鼓励						case 'newCheer':				//avatar				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>"						."<p class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 鼓励了我的目标 "							. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"						. "</p>"					. "</div>"					. "<div class='dynamic-footer'>"						. "<p class='dynamic-time'>". $dyn['Time']. "</p>"					. "</div>";				break;							//若为关注							case 'newFollow':								//avatar				html_output_dynamic_avatar($dyn);								echo "<div class='dynamic-content-wap'>"						."<p class='dynamic-header'>"							. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"							. " 关注了我"						. "</p>"					. "</div>"										. "<div class='dynamic-footer'>"						. "<p class='dynamic-time'>". $dyn['Time']. "</p>"					. "</div>";							break;			}							echo "</div>";			}	}?></div><div id='dynamic-sidebar-panel'>	<!-- 个人关注 -->	<div class='panel-header'>		<div class='panel-title'>我的关注</div		><div class='panel-cmd-wapper'>......（<span class='panel-cmd' id='cmd-add-log'>管理</span>）</div>	</div>		<?php 		$followees = get_followed_users($userID);				foreach($followees as $fow){			echo "<a title='". $fow['Username']. "' href='person.php?userID=". $fow['UserID'] ."'>"					. "<img class='multi-user-profile' src='". get_user_profile($fow['UserID']). "' />"				. "<a>";		}	?></div><?php	require('footer.php');?>