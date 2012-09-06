<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	$userID = $_REQUEST['userID'];
	
	session_start();
	$isMe = ($userID == $_SESSION['valid_user_id']);
	
	$userName = $isMe? "我": get_username_by_id($userID);
	
	@html_output_authed_header($userName. "的个人主页");	

	$isFollowed = check_is_followed($_SESSION['valid_user_id'], $userID);
?>

<script type='text/javascript'>

$(document).ready(function(){
	var isMe = <?php echo $isMe? 1: 0; ?>;
	
	if(isMe){
		$('body').prop('id', 'page-person');
	}
	
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
	<div id='main-panel'>
		<!-- 用户信息 -->
		<div id='user-info' class='clearfix'>
			<img id='user-profile' src='<?php echo get_user_profile($userID); ?>' />
			<div id='user-info-wap'>
				<span id='user-name'> <?php echo $userName ?>的个人主页</span>
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
			goal_html_output($userID, $goalType) ?>
		</div>
	</div>

	<!-- 用户的额外信息 -->	
	<div id="sidebar-panel">
	
		<!-- 动态 -->
		<?php
		@html_out_panel_header('TA的动态', '全部', '', 'dynamic_page_single.php?userID='.$userID, $isCreator);
		
		$dyns = get_dynamics($userID);
		
		foreach($dyns as $dyn){
			echo "<div class='dynamic-item clearfix'>";

			if($dyn['type'] == 'newLog'){
				//若为 Log 相关的动态
				echo  "<p class='dynamic-header'>"
							. " 在 "
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
						//. "<a class='dynamic-goal-creater' href='person.php?userID=". $dyn['PosterID']. "'>". $dyn['Poster']. "</a>"
						. " 设立目标 "
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
			@html_out_panel_header('关注TA的人', '全部', '', 'follower_page_followers.php?followeeID='.$userID, $isCreator);
		
			$followers = get_followers($userID);
			
			foreach($followers as $follower){
				echo "<a href='person.php?userID=". $follower['UserID']. "' title='". $follower['Username']. "'>"
						. "<img class='multi-user-profile' src='". get_user_profile($follower['UserID']). "' />"
					. "</a>";
			}
		?>
		
		<!-- TA关注的人 -->		
		<?php
			@html_out_panel_header('TA关注的人', '全部', '', 'follower_page_followees.php?followerID='.$userID, $isCreator);
			
			$followees = get_followees($userID);
			
			foreach($followees as $followee){
				echo "<a href='person.php?userID=". $followee['UserID']. "' title='". $followee['Username']. "'>"
						. "<img class='multi-user-profile' src='". get_user_profile($followee['UserID']). "' />"
					. "</a>";
			}	
		?>
		
		<!-- 留言板 -->
		<!--
		<div class='panel-header'>
			<div class='panel-title'>留言板</div>
			<div class='panel-cmd-wapper'>	
				<span>......（</span
				><span class='panel-cmd'>全部</span
				><span>）<span>
			</div>
		</div>
		
		<?php
		$messages = get_user_messages($userID);
		foreach($messages as $message){
			echo "<div class='message-item'>"
					. "<p class='message-content'>"
						. "<a href='person.php?userID=". $message['PosterID']. "'>". $message['Username']. "</a>："
						. $message['Message']
					. "</p>"
					. "<p class='message-time'>". $message['Time']. "</p>"
				. "</div>";
		}
		?>
		-->
	</div>
</div>

<!-- 留言对话框 -->
<div id='dialog-leave-message'>
	<form id='form-leave-message' action='message_proc.php' method='post'>
		<textarea name='message' id='message-content'></textarea>
		<input type='hidden' name='proc' value='new'>
		<input type='hidden' name='posterID' value='<?php echo $_SESSION['valid_user_id']; ?>'>
		<input type='hidden' name='receiverID' value='<?php echo $userID; ?>'>
	</form>
</div>

<?php
	html_output_authed_footer();
?>