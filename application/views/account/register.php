<div id='form-wap'>
	
	<?php if(validation_errors() != ''): ?>
	<div class="error-wap"><?= validation_errors(); ?></div>
	<?php endif; ?>

	<?= form_open('account/register', array('id'=>'form-register')) ?>

		<input type='text' title='你常用的邮箱' placeholder='邮箱' autocomplete='off' name='email' id='input-email' value="<?= set_value('email') ?>" />

		<input type='text' title='你的称呼' placeholder='称呼' autocomplete='off' name='username' id="input-username" value="<?= set_value('username') ?>" />

		<input type='password' title='设置密码，至少6位，建议数字和字母混合' id='pwd' placeholder='密码' autocomplete='off' name='password' value="<?= set_value('password') ?>" />
		
		<input type='password' title='重复一遍又不会怀孕！' placeholder='重复密码' autocomplete='off' name='re-password' value="<?= set_value('re-password') ?>" />
		
		<div class='form-footer'>
			<a href="<?= base_url('account/login') ?>">登陆</a>
			<input class="btn btn-primary btn-large" type='submit' value='注册'>
		</div>
	</form>

</div>