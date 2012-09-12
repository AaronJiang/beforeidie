<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	$userID = $_REQUEST['userID'];
	$userName = get_username_by_id($userID);
	
	@html_output_authed_header($userName. " 的个人主页", 'page-person');	

	$isFollowed = check_is_followed($_SESSION['valid_user_id'], $userID);
	$isMe = ($userID == $_SESSION['valid_user_id']);
?>

<script type='text/javascript'>

$(document).ready(function(){

	var isMe = <?php echo $isMe? 1: 0; ?>;
	
	$("#cmd-leave-message").click(function(){
		$("#dialog-leave-message").dialog('open');
	});
	
	//初始化留言框
	$("#dialog-leave-message").dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		title: '给他留言',
		width: 430,
		buttons:{
			'留言': function(){
				$("#form-leave-message").submit();
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});
});

</script>

<div id='person-page'>
	
	<!-- 主框架 -->
	<div id='main-panel'>
		
		<!-- 用户信息 -->		
		<div id='user-info' class='clearfix'>
			<img id='user-avatar' src='<?php echo get_user_profile($userID); ?>' />
			<div id='user-info-wap'>
				<span id='user-name'><?php echo $userName ?> 的个人主页</span>
			</div>
			<?php if(!$isMe){
				echo "<div id='user-cmd-wap'>";
				if(!$isFollowed){
					echo "<a href='follower_proc.php?proc=follow&followerID=". $_SESSION['valid_user_id']. "&followeeID=". $userID. "'>关注</a>";
			}
				else{
					echo "<a class='isFollowed' href='follower_proc.php?proc=disfollow&followerID=". $_SESSION['valid_user_id']. "&followeeID=". $userID. "'>已关注</a>";		
					}
				echo "<a id='cmd-leave-message'>留言</a>";
				echo "</div>";
			} ?>
		</div>
	
		<!-- 用户的 Goals -->
		<ul id='goal-wap-header'>
			<li><a href='person.php?userID=<?php echo $userID ?>&goalType=now'>进行中 [<?php echo get_public_goal_num($userID, 'now'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=future'>待启动 [<?php echo get_public_goal_num($userID, 'future'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=finish'>已完成 [<?php echo get_public_goal_num($userID, 'finish'); ?>]</a></li>
		</ul>
		
		<div class='goal-wap'>
			<?php 
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';		
			html_output_person_goals($userID, $goalType) 
			?>
		</div>
	</div>

	<!-- 边栏 -->	
	<div id="sidebar-panel">
	
		<!-- 个人动态 -->
		<?php
		@html_out_panel_header('TA的动态', '全部', '', 'dynamic_page_single.php?userID='.$userID);
		
		$dyns = get_dynamics($userID, 3);
		
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
		?>
		
		<!-- 关注TA的人 -->	
		<?php
			$followers = get_followers($userID, 16);
			
			@html_out_panel_header('关注TA的人', '全部 ('.count($followers).')', '', 'follower_page_followers.php?followeeID='.$userID, $isCreator);
		
			foreach($followers as $follower){
				echo "<a href='person.php?userID=". $follower['UserID']. "' title='". $follower['Username']. "'>"
						. "<img class='multi-user-profile' src='". get_user_profile($follower['UserID']). "' />"
					. "</a>";
			}
		?>
		
		<!-- TA关注的人 -->		
		<?php
			$followees = get_followees($userID, 16);
			
			@html_out_panel_header('TA关注的人', '全部 ('.count($followees).')', '', 'follower_page_followees.php?followerID='.$userID, $isCreator);

			foreach($followees as $followee){
				echo "<a href='person.php?userID=". $followee['UserID']. "' title='". $followee['Username']. "'>"
						. "<img class='multi-user-profile' src='". get_user_profile($followee['UserID']). "' />"
					. "</a>";
			}	
		?>
	</div>

	<!-- 私信对话框 -->
	<div id='dialog-leave-message'>
		<form id='form-leave-message' action='message_proc.php' method='post'>
			<textarea name='message' id='message-content'></textarea>
			<input type='hidden' name='proc' value='new'>
			<input type='hidden' name='posterID' value='<?php echo $_SESSION['valid_user_id']; ?>'>
			<input type='hidden' name='receiverID' value='<?php echo $userID; ?>'>
		</form>
	</div>
	
</div>

<?php
	html_output_authed_footer();
?>