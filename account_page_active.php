<?php
	require_once('html_helper.php');
	require_once('data_funs.inc');
	html_output_unauthed_header('注册');

	html_output_slogan();
	
	$from = $_REQUEST['from'];
	$email = $_REQUEST['email'];
?>

<div id='form-wap'>
	<?php 
		if($from == 'register'){
			echo "<p id='active-message'>亲，激活邮件已发送到你的邮箱，请进入邮箱激活账户吧！</p>";
		}
		else{
			echo "<p id='active-message'>亲，你的账户尚未激活，请进入邮箱激活账户吧！</p>";
		} 
	?>
		
	<form action='account_proc.php' method='post'>
		<input type='hidden' value='active' name='proc'>
		<input type='hidden' value='<?php echo $email ?>' name='email'>
		
		<div class='form-footer'>
			<a href='account_page_login.php'>登陆</a
			><input type='submit' value='再发一次' />
		</div>
	</form>
</div>

<?php
	html_output_unauthed_footer();
?>