<script type='text/javascript'>

$(document).ready(function(){

	$.validationEngineLanguage.allRules.ajaxCheckPwd = {
		"url": "<?= base_url('account/check_pwd') ?>",
		"alertTextOk": "* 密码正确",
		"alertText": "* 密码不正确",
		"alertTextLoad": "* 正在验证密码..."
	};
	
	$('#form-change-pwd').validationEngine();
	
	$("#cancel-btn").click(function(){
		window.location = "<?= base_url('account/info') ?>";
	});
});
</script>

<h3 class='page-title'>更改密码</h3>

<form id='form-change-pwd' action="<?= base_url('account/pchange_pwd') ?>" method='post'>
	<input type='password' class='validate[required, ajax[ajaxCheckPwd]]' autocomplete='off' placeholder='原密码' name='originalPwd' id='originalPwd' />

	<input type='password' class='validate[required, minSize[6]]' minlength='6' id='newPwd' autocomplete='off' placeholder='新密码' name='newPwd' />

	<input type='password' class='validate[required, equals[newPwd]]' autocomplete='off' equalto='#newPwd' placeholder='重复新密码' name='reNewPwd' />

	<div>
		<input class="btn btn-primary" type='submit' value='修改'>
		<input class='btn' type='button' id='cancel-btn' value='取消'>
	</div>

	<input type='hidden' name='userID' value='<?= $userID ?>'>
</form>