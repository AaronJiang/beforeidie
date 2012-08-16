<?php
	require('header.php');
	require_once('data_funs.inc');
	
	$userID = $_REQUEST['userID'];
	
	$isMe = ($userID == $_SESSION['valid_user_id']);
	
	$isFollowed = check_is_followed($_SESSION['valid_user_id'], $userID);
?>

<script type='text/javascript'>

$(document).ready(function(){
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

	$("#cmd-leave-message").click(function(){
		$("#dialog-leave-message").dialog('open');
	});		
});
	
</script>

<!-- 留言对话框 -->
<div id='dialog-leave-message'>
	<form id='form-leave-message' action='message_proc.php' method='post'>
		<textarea name='message' id='message-content'></textarea>
		<input type='hidden' name='proc' value='leaveMessage'>
		<input type='hidden' name='posterID' value='<?php echo $_SESSION['valid_user_id']; ?>'>
		<input type='hidden' name='receiverID' value='<?php echo $userID; ?>'>
	</form>
</div>

<div id='person-page'>
	<!-- 用户信息 -->
	<div id='user-info-panel' class='clearfix'>
		<img id='user-profile' src='./imgs/gravatar-140.png' />
		<div id='user-info-wap'>
			<span id='user-name'> <?php echo get_username_by_id($userID); ?> </span>
		</div>
		<?php if(!$isMe){
			echo "<div id='user-cmd-wap'>";
			if(!$isFollowed){
				echo "<a href='follower_proc.php?proc=follow&followerID=". $_SESSION['valid_user_id']. "&followeeID=". $userID. "'>关注</a>";
			}
			else{
				echo "<a href='follower_proc.php?proc=disfollow&followerID=". $_SESSION['valid_user_id']. "&followeeID=". $userID. "'>取消关注</a>";		
			}
			echo "<a id='cmd-leave-message'>给他留言</a>";
			echo "</div>";
		} ?>
	</div>
	
	<!-- 用户的 Goals -->
	<div id='goals-panel'>
		<?php
		function goal_html_output($userID, $type){
			$goals = get_goals($userID, $type);
			foreach($goals as $goal){
				$goalID = $goal['GoalID'];
				echo "<div class='goal-item goal-item-". $type ."'>"
						."<p class='goal-title'><a href='goal_page_details.php?goalID=". $goalID. "'>". $goal['Title']. "</a></p>"
						."<p class='goal-reason'>". $goal['Reason']. "</p>"
						. "<div class='goal-num-wap'>"
							. "<span><b>". get_goal_steps_num($goalID). "</b> 规划</span>"
							. " | "
							. "<span><b>". get_goal_logs_num($goalID). "</b> 记录</span>"
							. " | "
							. "<span><b>". get_goal_cheers_num($goalID). "</b> 鼓励</span>"
						. "</div>";
						/*
						if($_REQUEST['userID'] != $_SESSION['valid_user_id']){	//若不是创建者
							echo "<div class='goal-cmd-wap'>"
									."<a class='goal-cmd'>鼓励</a>"
								. "</div>";
						}*/
				echo "</div>";
			}
		} ?>
		
		<ul id='goal-wap-header'>
			<li><a href='person.php?userID=<?php echo $userID ?>&goalType=now'>进行中 [<?php echo get_goal_num($userID, 'now'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=future'>待启动 [<?php echo get_goal_num($userID, 'future'); ?>]</a></li
			><li><a href='person.php?userID=<?php echo $userID ?>&goalType=finish'>已完成 [<?php echo get_goal_num($userID, 'finish'); ?>]</a></li>
		</ul>
		
		<div class='goal-wap'>
			<?php 
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';		
			goal_html_output($userID, $goalType) ?>
		</div>
	</div>

	<!-- 用户的额外信息 -->	
	<div id="personal-dynamics-panel">
	
		<!-- 动态 -->
		<div class='panel-header'>
			<div class='panel-title'>TA的动态</div>
			<div class='panel-cmd-wapper'>	
				<span>......（</span
				><span class='panel-cmd'>全部</span
				><span>）<span>
			</div>
		</div>
		
		<?php
		$dynamics = get_all_logs($userID);
		foreach($dynamics as $dyn){
			echo "<div class='dynamic-item'>"
					. "<p class='dynamic-goal-title'>在 <a href=goal_page_details.php?goalID=". $dyn['GoalID'] .">". $dyn['Title']. "</a> 中写道:</p>"
					. "<p class='dynamic-title'>". $dyn['LogTitle']. "</p>"
					. "<p class='dynamic-content'>". $dyn['LogContent']. "</p>"
					. "<p class='dynamic-time'>". $dyn['LogTime']. "</p>"
				. "</div>";
		}
		?>
		
		<!-- 关注他的人 -->	
		<div class='panel-header'>
			<div class='panel-title'>关注TA的人</div>
			<div class='panel-cmd-wapper'>	
				<span>......（</span
				><span class='panel-cmd'>全部</span
				><span>）<span>
			</div>
		</div>
		
		<?php 
		$followers = get_followers($userID);
		foreach($followers as $follower){
			echo "<a class='user-icon' href='person.php?userID=". $follower['UserID']. "' title='". $follower['Username']. "'>"
					. "<img src='./imgs/gravatar-140.png' />"
				. "</a>";
		}
		?>
		
		<!-- 他关注的人 -->

		<!-- 留言板 -->		
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
						. "<a href='person.php?userID='". $message['PosterID']. "'>". $message['Username']. "</a>："
						. $message['Message']
					. "</p>"
					. "<p class='message-time'>". $message['Time']. "</p>"
				. "</div>";
		}
		?>
	</div>
</div>
<?php
	require('footer.php');
?>