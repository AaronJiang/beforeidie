<?php
	require('header.php');
	require_once('data_funs.inc');
	
	$userID = $_REQUEST['userID'];
?>

<div id='person-page'>
	<!-- 用户信息 -->
	<div id='user-info'>
		<img src='./imgs/gravatar-140.png' />
		<span id='user-name'> <?php echo get_username_by_id($userID); ?> </span>
	</div>
	
	<!-- 用户的 Goals -->	
	<div class='goal-wap'>
		<?php $nows = get_goals($userID, 'now'); ?>
		<p class='goal-wap-header'>进行中 [<?php echo count($nows); ?>]</p>
	
		<?php
		foreach($nows as $now){
			echo "<div class='goal-item goal-item-now'>"
					."<p class='goal-title'>". $now['Title']. "</p>"
					."<p class='goal-reason'>". $now['Reason']. "</p>"
				. "</div>";
		} ?>
	</div>
	
	<div class='goal-wap'>
		<?php $futures = get_goals($userID, 'future'); ?>
		<p class='goal-wap-header'>待启动 [<?php echo count($futures); ?>]</p>

		<?php
		foreach($futures as $future){
			echo "<div class='goal-item goal-item-future'>"
					."<p class='goal-title'>". $future['Title']. "</p>"
					."<p class='goal-reason'>". $future['Reason']. "</p>"
				. "</div>";
		} ?>
	</div>
	
	<div class='goal-wap'>
		<?php $finishs = get_goals($userID, 'finish'); ?>
		<p class='goal-wap-header'>已完成 [<?php echo count($finishs); ?>]</p>

		<?php
		foreach($finishs as $finish){
			echo "<div class='goal-item goal-item-finish'>"
					."<p class='goal-title'>". $finish['Title']. "</p>"
					."<p class='goal-reason'>". $finish['Reason']. "</p>"
				. "</div>";
		} ?>
	</div>
	
	<!-- 用户的个人动态 -->	
	<div id="personal-dynamics">
		<?php $dynamics = get_all_logs($userID) ?>
		<p id='dynamic-header'>个人动态</p>
		
		<?php
		foreach($dynamics as $dyn){
			echo "<div class='dynamic-item'>"
				. "<p class='dynamic-goal-title'>在 <b>". $dyn['Title']. "</b> 中写道:"
				. "<p class='dynamic-content'>". $dyn['LogContent']. "</p>"
				. "<p class='dynamic-time'>". $dyn['LogTime']. "</p>"
				. "</div>";
		}
		?>
	</div>

<?php
	require('footer.php');
?>