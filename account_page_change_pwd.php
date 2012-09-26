<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	html_output_authed_header("更改密码", 'page-change-pwd');
?>

<script type='text/javascript'>

$(document).ready(function(){
	
	$('#form-change-pwd').validationEngine();
	
	$("#cancel-btn").click(function(){
		window.location = "account_page_details.php";
	});
});
</script>

<p class='subtitle'>更改密码</p>

<form id='form-change-pwd' action='account_proc.php' method='post'>
	<input type='password' class='validate[required]' autocomplete='off' placeholder='原密码' name='originalPwd' />
	
	<input type='password' class='validate[required, minSize[6]]' minlength='6' id='newPwd' autocomplete='off' placeholder='新密码' name='newPwd' />
	
	<input type='password' class='validate[required, equals[newPwd]]' autocomplete='off' equalto='#newPwd' placeholder='重复新密码' name='reNewPwd' />

	<div>
		<input type='submit' value='修改'>
		<input type='button' class='cancel' id='cancel-btn' value='取消'>
	</div>
	
	<input type='hidden' name='proc' value='change_pwd'>
	<input type='hidden' name='userID' value=<?php echo $_SESSION['valid_user_id']; ?>>
</form>

<?php
	html_output_authed_footer();
?>