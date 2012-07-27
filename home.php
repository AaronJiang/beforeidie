<?php
	require('header.php');
	require_once('data_funs.inc');
?>

<script type="text/javascript">
	$('body').prop('id', 'page-starts');
</script>

<?php autostart_goals(); ?>

<ul id="goal-selector" class="clearfix">
	<li><a href="home.php?goalType=now" id="select-now">进 行 中 [<?php echo get_goal_num("now"); ?>]</a></li>
	<li><a href="home.php?goalType=future" id="select-future">待 启 动 [<?php echo get_goal_num("future"); ?>]</a></li>
	<li><a href="home.php?goalType=finish" id="select-finish">已 完 成 [<?php echo get_goal_num("finish"); ?>]</a></li>
</ul>

<div id="content-goals">

<?php
	$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
	$results = get_goals($goalType);
	
	//构造每一个 Goal 的 HTML 块
	foreach($results as $row){
		echo "<div class='goal-item goal-item-". $goalType. "'>";
		
		//简要信息
		echo "<a class='goal-link' href='goal_page_details.php?&goalID=". $row['GoalID']. "'>";
		echo "<p class='goal-title'>". stripslashes($row['Title']). "</p>";
		if($goalType == 'future'){
			echo "<p class='goal-starttime'>将于 ". stripslashes($row['StartTime']). " 启动</p>";
		}
		echo "<p class='goal-why'>". stripslashes($row['Reason']). "</p>";
		echo "</a>";
		
		
		//命令按钮
		echo "<div class='goal-cmd-wap'>";
		echo "<a class='goal-cmd goal-cmd-edit' href='goal_page_edit.php?goalID=". $row['GoalID']. "'>编辑</a>";
		if($goalType == "now"){
			echo "<a class='goal-cmd goal-cmd-delay' data-goalid='". $row['GoalID']. "' data-title='". $row['Title']. "'>推迟</a>";
		}
		else if($goalType == "future"){
			echo "<a class='goal-cmd goal-cmd-start' href='goal_proc.php?proc=start&goalID=". $row['GoalID']. "'>启动</a>";				
		}
		echo "</div>";
		
		echo "</div>";
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

<script type="text/javascript">

$(document).ready(function(){	
	//实现元素纵向排布
	var topArray = [0, 0, 0, 0, 0],
		leftArray = [0, 175, 350, 525, 700];
				
	$('#content-goals .goal-item').each(function(index, entry){
		$(this).css({
			'top' : topArray[index % 5] + "px",
			'left' : leftArray[index % 5] + "px"
		});
		topArray[index % 5] += $(this).outerHeight() + 15;
	});
	
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
		width: 325,
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
	require('footer.php');	
?>
