<div id='form-wap'>
	
	<!-- jump from login -->
	<?php if($from == "login"): ?>
	<p id='account-message'>输入你的邮箱，我会把密码重置链接发过去哦！</p>
	
	<!-- already sended, so rm the form -->
	<?php elseif($from == "sended"): ?>
	<p id='account-message'>密码重置链接已发送，进入邮箱完成重置吧！</p>
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>

	<!-- sended failed -->
	<?php elseif($from == "unsended"): ?>
	<p id='account-message'>密码重置链接发送失败，输入你的邮箱再发一次吧！</p>

	<!-- reset failed -->
	<?php elseif($from == "resetFailed"): ?>
	<p id='account-message'>密码重置失败，请输入你的邮箱再发一次吧！</p>

	<!-- reset successfully, so rm the form -->
	<?php elseif($from == "resetSucc"): ?>
	<p id='account-message'>密码重置成功，马上 <a href="<?= base_url('account/login') ?>">登陆</a> 吧！</p>
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	
	<!-- endif -->
	<?php endif; ?>

	<?php if(validation_errors() != ''): ?>
	<div class="error-wap"><?= validation_errors(); ?></div>
	<?php endif; ?>

	<?= form_open('account/forgot_pwd/'. $from, array('id' => 'form-forgot-pwd')); ?>

		<input type='text' placeholder='邮箱' autocomplete='off' name='email' />
		
		<div class='form-footer'>
			<a href='<?= base_url('account/login') ?>'>登陆</a>
			<input class="btn btn-large btn-primary" type='submit' value='提交' />
		</div>
	</form>
</div>