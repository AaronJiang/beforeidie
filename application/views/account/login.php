<script type='text/javascript'>

$(document).ready(function(){
	$("#form-login").validationEngine();

	<?php if($loginFailed): ?>
	$('#input-email').validationEngine('showPrompt', '用户名或密码错误', 'red', '', true);	
	<?php endif; ?>
});

</script>

<div id='form-wap'>
	<form id='form-login' action="<?= base_url('account/plogin') ?>" method='post'>
		<input type='text' class='validate[required, custom[email]]' id='input-email' value="<?= $email ?>" placeholder='邮箱' class='required' minlength="6" autocomplete='off' name='email' />
		
		<input type='password' class='validate[required]' id='login-pwd' placeholder='密码' class='required' minlength="6" autocomplete='off' name='password' />
		
		<div class='form-footer'>
			<a href="<?= base_url('discover') ?>">逛逛</a>
			<span class='link-gap'>/</span>
			<a href="<?= base_url('account/forgot_pwd/login') ?>">忘记密码</a>
			<span class='link-gap'>/</span>
			<a href="<?= base_url('account/register') ?>">注册</a>
			<input class="btn btn-large btn-primary" type='submit' value='登陆'>
		</div>
	</form>
</div>