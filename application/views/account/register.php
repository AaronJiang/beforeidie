<script type='text/javascript'>

$(document).ready(function(){

	// 验证邮箱是否已存在
	$.validationEngineLanguage.allRules.ajaxEmailRepeat = {
		"url": "<?= base_url('account/check_email_repeat') ?>",
		"alertTextOk": "* 此邮箱可以使用",
		"alertText": "* 此邮箱已存在",
		"alertTextLoad": "* 正在确认邮箱是否有他人使用..."
	};

	// 验证用户名是否已存在
	$.validationEngineLanguage.allRules.ajaxNameRepeat = {
		"url": "<?= base_url('account/check_name_repeat') ?>",
		"alertTextOk": "* 此名称可以使用",
		"alertText": "* 此名称已被他人使用",
		"alertTextLoad": "* 正在确认名称是否有他人使用..."
	};

	$("#form-register").validationEngine();
});

</script>

<div id='form-wap'>

	<form id='form-register' class='clearfix' action="<?= base_url('account/pregister') ?>" method='post'>
		<input type='text' title='你常用的邮箱' class='validate[required, custom[email], ajax[ajaxEmailRepeat]]' placeholder='邮箱' autocomplete='off' name='email' id='email' />

		<input type='text' title='你的称呼，亲！' class='validate[required, ajax[ajaxNameRepeat]]' placeholder='称呼' autocomplete='off' name='username' id="username" />

		<input type='password' title='设置密码，6-16位之间，建议数字和字母混合。' id='pwd' class='validate[required, minSize[6]]' placeholder='密码' autocomplete='off' name='password' />
		
		<input type='password' title='重复一遍又不会怀孕！' class='validate[required, equals[pwd]]' placeholder='重复密码' autocomplete='off' name='re-password' />
		
		<div class='form-footer'>
			<a href="<?= base_url('account/login') ?>">登陆</a>
			<input class="btn btn-primary btn-large" type='submit' value='注册'>
		</div>
	</form>

</div>