<?php
	require_once('html_helper.php');
	require_once('data_funs.inc');
	html_output_unauthed_header('激活', 'page-active-account');

	html_output_slogan();
	
	$from = $_REQUEST['from'];
	$email = $_REQUEST['email'];
?>

<div id='form-wap'>
	<?php
	
	switch($from){
		case "register":
		case "sended":
			echo "<p id='active-message'>亲，激活邮件已发送到你的邮箱，请进入邮箱激活账户吧！</p>";
			break;
			
		case "unactive":
			echo "<p id='active-message'>亲，你的账户尚未激活，请进入邮箱激活账户吧！</p>";
			break;
			
		case "activeError":
			echo "<p id='active-message'>亲，账户激活失败，请点击下方按钮重发一次激活邮件吧！</p>";
			break;
			
		case "activeSucc":
			echo "<p id='active-message'>亲，账户激活成功，马上 <a href='account_page_login.php'>登陆</a> 吧！</p>";
			exit;
	}
	
	?>

	<form action='account_proc.php' method='post'>
		<input type='hidden' value='send_active_email' name='proc'>
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