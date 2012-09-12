<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	
	$goalID = $_REQUEST['goalID'];
	$goal = get_goal_by_ID($goalID);
	
		html_output_authed_header('鼓励 '. $goal['Title']. ' 的人们', 'page-goal-cheerers');
	
	echo "<p class='subtitle'>鼓励 <a href='goal_page_details.php?goalID=". $goal['GoalID']. "'>". $goal['Title']. "</a> 的人们：</p>";

	@$cheerers = get_goal_cheerers($goalID);
	
	foreach($cheerers as $cheerer){
		echo "<a href='person.php?userID=". $cheerer['UserID']. "'>"
				. "<img class='user-icon'
						src='". get_user_profile($cheerer['UserID']). "'
						title='". $cheerer['Username']. "' />"
			. "</a>";
	}
?>

<?php
	html_output_authed_footer();
?>