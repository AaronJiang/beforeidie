<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	$userID = $_REQUEST['userID'];
	$username = get_username_by_id($userID);

	@html_output_authed_header($username. " 的动态", 'page-single-dynamics');
?>

<script type='text/javascript' src='js/goal-comment.js'></script>
	
<p class='subtitle'><?php echo $username ?> 的全部动态</p>
	
<?php
	$isMe = ($_SESSION['valid_user_id'] == $userID);
	
	$dyns = get_dynamics($userID, 10);

	foreach($dyns as $dyn){
		echo "<div class='dynamic-item clearfix'>"
				. "<img title='". $username. "' class='user-avatar' src='". get_user_profile($userID). "'>"
				
				. "<div class='dynamic-content'>";
					if($dyn['type'] == 'newLog'){
					//若为 Log 相关的动态
					
						echo  "<p class='dynamic-header'>"
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
							. "</div>";
							
							//comments
							html_output_comments($dyn['LogID']);
					}
					else if($dyn['type'] == 'newGoal'){
						//若为 Goal 相关的动态
						echo "<p class='dynamic-header'>"
								. "<a class='username' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
								. " 设立目标 "
								. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
							. "</p>"
							. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"
						
							//footer
							. "<div class='dynamic-footer'>";
								$isCheered = check_goal_is_cheered($_SESSION['valid_user_id'], $dyn['GoalID']);
								if(!$isCheered && !$isMe){
									echo "<a class='small-cmd' href='cheer_proc.php?proc=cheer&userID=". $_SESSION['valid_user_id']. "&goalID=". $dyn['GoalID']. "'>鼓励</a>";
								}
								echo "<p class='post-time'>". $dyn['Time']. "</p>"
							. "</div>";
					}

				echo "</div>"		
			. "</div>";
	}
		
	html_output_authed_footer();
?>