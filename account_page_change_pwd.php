<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	html_output_authed_header("更改密码");
?>

<script type='text/javascript'>

$(document).ready(function(){
	$("#cancel-btn").click(function(){
		window.location = "account_page_details.php";
	});
});
</script>

<p class='subtitle'>更改密码</p>

<form action='account_proc.php' method='post'>
	<div>
		<input type='password' autocomplete='off' placeholder='原密码' name='originalPwd'>
	</div>

	<div>
		<input type='password' autocomplete='off' placeholder='新密码' name='newPwd'>
	</div>

	<div>
		<input type='password' autocomplete='off' placeholder='重复新密码' name='reNewPwd'>
	</div>
	
	<input type='submit' value='修改'>
	<input type='button' id='cancel-btn' value='取消'>
	
	<input type='hidden' name='proc' value='change_pwd'>
	<input type='hidden' name='userID' value=<?php echo $_SESSION['valid_user_id']; ?>>
</form>

<?php
	html_output_authed_footer();
?>