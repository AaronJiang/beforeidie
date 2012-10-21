<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	html_output_authed_header("我的Goals", 'page-home');
?>

<script type="text/javascript">

$(document).ready(function(){
	
	//滑出命令栏
	$('.goal-item').live("hover", function(event){
		if(event.type == 'mouseenter'){
			$(this).find('.goal-cmd-wap').animate({'bottom':'0px'}, 'fast');
		} 
		else if(event.type == 'mouseleave'){
			$(this).find('.goal-cmd-wap').animate({'bottom':'-32px'}, 'fast');
		};
	});
	
	//初始化 Goal 延迟对话框
	$('#dialog-delay').dialog({
		autoOpen: false,
		modal: true,
		width: 320,
		draggable: false,
		resizable: false,
		buttons: {
			'确认': function(){
				$('#form-delay-goal').submit();
			},
			'取消': function(){
				$(this).dialog('close');
			}
		}
	});
	
	//初始化 datapicker
	$('#goal-starttime').datepicker({
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true
	});	
	
	//弹出 Goal 延迟框
	$('.goal-cmd-delay').click(function(){
		//对话框标题
		var goalTitle = $(this).data('title');
		$('#dialog-delay').dialog('option', 'title', '推迟：' + goalTitle);
		
		//设置表单隐藏域 goalID 的值
		var goalID = $(this).data('goalid');
		$("#form-delay-goal input[name='goalID']").val(goalID);
	
		$('#dialog-delay').dialog('open');
	});
	
	//弹出放弃 Goal 警告框
	$('.goal-cmd-drop').click(function(){
		var goalTitle = $(this).data('title');
		var isSure = confirm('确定放弃目标：' + goalTitle + "?");
		if(!isSure){
			return false;
		}
	});
});
</script>

<?php
	$userID = $_SESSION['valid_user_id'];
	autostart_goals($userID);
?>

<ul id="goal-selector" class="clearfix">
	<li><a href="home.php?goalType=now" id="select-now">进 行 中 [<?php echo get_goals_num($userID, "now", true); ?>]</a></li>
	<li><a href="home.php?goalType=future" id="select-future">待 启 动 [<?php echo get_goals_num($userID, "future", true); ?>]</a></li>
	<li><a href="home.php?goalType=finish" id="select-finish">已 完 成 [<?php echo get_goals_num($userID, "finish", true); ?>]</a></li>
</ul>

<div id="content-goals">

<?php
	$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
	$goals = get_goals($userID, $goalType, true);
	
	//构造每一个 Goal 的 HTML 块
	foreach($goals as $goal){
		echo "<div class='goal-item goal-item-". $goalType. "'>"
				//Goal 详情
				. "<a class='goal-link' href='goal_page_details.php?goalID=". $goal['GoalID']. "'>"
					. "<p class='goal-title'>". stripslashes($goal['Title']). "</p>"
					. "<p class='goal-why'>". stripslashes($goal['Reason']). "</p>"
					. "<div class='goal-info-wap'>";
						if($goalType == 'future'){
							echo "<p class='goal-starttime'>将于 <b>". stripslashes($goal['StartTime']). "</b> 启动</p>";
						}
						elseif($goalType == 'finish'){
							echo "<p class='goal-endtime'>于 <b>". stripslashes($goal['EndTime']). "</b> 达成</p>";								
						}
						else {
							echo "<b>". get_goal_steps_num($goal['GoalID']). "</b> 计划"
								. " | "
								. "<b>". get_goal_logs_num($goal['GoalID']). "</b> 记录";
						}
					echo "</div>"
				. "</a>"
				
				//命令按钮
				. "<div class='goal-cmd-wap'>"
			 		. "<a class='goal-cmd goal-cmd-edit'
						href='goal_page_edit.php?goalID=". $goal['GoalID']. "'
						>编辑</a>";
					if($goalType == "now"){
						echo "<a class='goal-cmd goal-cmd-delay' 
								data-goalid='". $goal['GoalID']. "'
								data-title='". $goal['Title']. "'
								>推迟</a>";
					}
					else if($goalType == "future"){
						echo "<a class='goal-cmd goal-cmd-start'
								href='goal_proc.php?proc=start&goalID=". $goal['GoalID']. "'
								>启动</a>";
					}
					if($goalType != "finish"){
						echo "<a class='goal-cmd goal-cmd-drop'
								data-title='". $goal['Title']. "'
								href='goal_proc.php?proc=drop&goalID=". $goal['GoalID']. "'
								>放弃</a>";		
					}
				echo "</div>"
			. "</div>";
	}
?>

</div>

<div id='dialog-delay' title='推迟启动'>
	<form id='form-delay-goal' action='goal_proc.php' method='post'>
		<label for='goal-starttime'>启动时间：</label>
		<input type='text' name='startTime' autocomplete="off" id='goal-starttime' />
		<input type='hidden' name='goalID' value='' />
		<input type='hidden' name='proc' value='delay' />
	</form>
</div>

<?php
	html_output_authed_footer();
?>
