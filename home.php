<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
?>

<script type="text/javascript">

function arrangeBlocks(selector, hGap, vGap){
	var width = $(selector).first().outerWidth();

	//实现元素纵向排布
	var topArray = [0, 0, 0, 0],
		leftArray = [0, width+hGap, 2*(width+hGap), 3*(width+hGap)];
				
	$(selector).each(function(){
		//找到 topArray 中最小的、且最靠左的项的 index
		var minValue = 10000,
			minIndex = 0;
		
		$.each(topArray, function(index, entry){
			if(entry < minValue){
				minValue = entry;
				minIndex = index;
			}	
		});
		
		$(this).css({
			'top' : topArray[minIndex] + "px",
			'left' : leftArray[minIndex] + "px"
		});
		
		topArray[minIndex] += $(this).outerHeight() + vGap;
		
		//$(this).css({
		//	'top' : topArray[index % 5] + "px",
		//	'left' : leftArray[index % 5] + "px"
		//});
		//topArray[index % 5] += $(this).outerHeight() + 15;
	});
}

$(document).ready(function(){
	$('body').prop('id', 'page-goals');

	//排列区块
	arrangeBlocks('#content-goals .goal-item', 20, 15);
	
	//弹出命令栏
	$('.goal-item').live("hover",function(event){
		if(event.type == 'mouseenter'){
			$(this).find('.goal-cmd-wap').animate({'bottom':'0px'}, 'fast');
		} 
		else if(event.type == 'mouseleave'){
			$(this).find('.goal-cmd-wap').animate({'bottom':'-32px'}, 'fast');
		};
	});
	
	//初始化对话框
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
	
	//弹出对话框
	$('.goal-cmd-delay').click(function(){
		//对话框标题
		var goalTitle = $(this).data('title');
		$('#dialog-delay').dialog('option', 'title', '推迟：' + goalTitle);
		
		//设置表单隐藏域 goalID 的值
		var goalID = $(this).data('goalid');
		$("#form-delay-goal input[name='goalID']").val(goalID);
	
		$('#dialog-delay').dialog('open');
	});
});
</script>

<?php
	$userID = $_SESSION['valid_user_id'];
	autostart_goals($userID);
?>

<ul id="goal-selector" class="clearfix">
	<li><a href="home.php?goalType=now" id="select-now">进 行 中 [<?php echo get_goal_num($userID, "now"); ?>]</a></li>
	<li><a href="home.php?goalType=future" id="select-future">待 启 动 [<?php echo get_goal_num($userID, "future"); ?>]</a></li>
	<li><a href="home.php?goalType=finish" id="select-finish">已 完 成 [<?php echo get_goal_num($userID, "finish"); ?>]</a></li>
</ul>

<div id="content-goals">

<?php
	$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
	$results = get_goals($userID, $goalType);
	
	//构造每一个 Goal 的 HTML 块
	foreach($results as $row){
		echo "<div class='goal-item goal-item-". $goalType. "'>"
				//简要信息
				. "<a class='goal-link' href='goal_page_details.php?goalID=". $row['GoalID']. "'>"
					. "<p class='goal-title'>". stripslashes($row['Title']). "</p>"
					. "<p class='goal-why'>". stripslashes($row['Reason']). "</p>"
					. "<div class='goal-info-wap'>"
						. "<div>"
							. "<b>". get_goal_steps_num($row['GoalID']). "</b> 计划"
							. " | "
							. "<b>". get_goal_logs_num($row['GoalID']). "</b> 记录"
							. " | "
							. "<b>". get_goal_followers_num($row['GoalID']). "</b> 关注"
						. "</div>";
						if($goalType == 'future'){
							echo "<p class='goal-starttime'>将于 ". stripslashes($row['StartTime']). " 启动</p>";
						}
					echo "</div>"
				. "</a>"
				//命令按钮
				. "<div class='goal-cmd-wap'>"
			 		. "<a class='goal-cmd goal-cmd-edit' href='goal_page_edit.php?goalID=". $row['GoalID']. "'>编辑</a>";
					if($goalType == "now"){
						echo "<a class='goal-cmd goal-cmd-delay' data-goalid='". $row['GoalID']. "' data-title='". $row['Title']. "'>推迟</a>";
					}
					else if($goalType == "future"){
						echo "<a class='goal-cmd goal-cmd-start' href='goal_proc.php?proc=start&goalID=". $row['GoalID']. "'>启动</a>";
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
	require('footer.php');	
?>
