<div id='form-wap'>

	<?php if(validation_errors() != ''): ?>
	<div class="error-wap"><?= validation_errors(); ?></div>
	<?php endif; ?>

	<?= form_open('account/login', array('id'=>'form-login')); ?>

		<input type='text' id='input-email' value="<?= $email ?>" placeholder='邮箱' autocomplete='off' name='email' />

		<input type='password' id='input-pwd' placeholder='密码' autocomplete='off' name='password' />
		
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