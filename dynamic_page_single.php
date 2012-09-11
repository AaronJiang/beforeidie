<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	$userID = $_REQUEST['userID'];
	$username = get_username_by_id($userID);

	@html_output_authed_header($username. " 的动态", 'page-single-dynamics');
	
	echo "<p class='subtitle'>". $username. " 的动态：</p>";
	
	$dyns = get_dynamics($userID, 10);

	foreach($dyns as $dyn){
		echo "<div class='dynamic-item clearfix'>";

		if($dyn['type'] == 'newLog'){
			//若为 Log 相关的动态
			echo  "<p class='dynamic-header'>"
					. "在 "
					. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
					. " 中写到："
				. "</p>";
				if($dyn['LogTitle'] != ""){
					echo "<p class='dynamic-log-title'>". $dyn['LogTitle']. "</p>";
				}
				echo "<p class='dynamic-log-content'>". $dyn['LogContent']. "</p>"
			. "<p class='dynamic-time'>". $dyn['Time']. "</p>";
		}
		else if($dyn['type'] == 'newGoal'){
			//若为 Goal 相关的动态
			echo "<p class='dynamic-header'>"	
					. "设立目标 "
					. "<a href='goal_page_details.php?goalID=". $dyn['GoalID']. "' class='dynamic-goal-title'>". $dyn['GoalTitle']. "</a>"
				. "</p>"
				. "<p class='dynamic-goal-reason'>". $dyn['GoalReason']. "</p>"
				. "<p class='dynamic-time'>". $dyn['Time']. "</p>";
		}
			
		echo "</div>";
	}
		
	html_output_authed_footer();
?>