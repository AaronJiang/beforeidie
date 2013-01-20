<div id='form-wap'>
	<p id='account-message'>重置你的密码</p>

	<?php if(validation_errors() != ''): ?>
	<div class="error-wap"><?= validation_errors(); ?></div>
	<?php endif; ?>

	<?= form_open('account/reset_pwd/', array('id' => 'form-reset-pwd')) ?>

		<input type='password' id='newPwd' title='输入你的新密码，6-16位之间，建议数字和字母混合。' placeholder='新的密码' autocomplete='off' name='pwd' />
		
		<input type='password' title='重复一遍又不会怀孕！' placeholder='重复一遍' autocomplete='off' name='re-pwd' />

		<input type='hidden' name='email' value='<?= $email ?>'>

		<div class='form-footer'>
			<input class="btn btn-primary btn-large" type='submit' value='重置'>
		</div>
	</form>
</div>