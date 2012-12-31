<script type='text/javascript'>

$(document).ready(function(){
	$('#form-forgot-pwd').validationEngine();
});

</script>

<div id='form-wap'>
	
	<?php if($from == "login"): ?>
	<p id='account-message'>亲，输入你的邮箱，我们会把密码重置链接发过去哦！</p>
	
	<?php elseif($from == "sended"): ?>
	<p id='account-message'>亲，密码重置链接已发送，请进入邮箱完成重置操作吧！</p>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	
	<?php elseif($from == "resetError"): ?>
	<p id='account-message'>亲，密码重置失败，请输入你的邮箱再发一次吧！</p>

	<?php elseif($from == "resetSucc"): ?>
	<p id='account-message'>亲，密码重置成功，马上 <a href="<?= base_url('account/login') ?>">登陆</a> 吧！</p>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-forgot-pwd').detach();
		});
	</script>
	
	<?php endif; ?>

	<form id='form-forgot-pwd' action="<?= base_url('account/send_reset_pwd_email') ?>" method='post'>
		<input type='text' class='validate[required, custom[email]' placeholder='邮箱' autocomplete='off' name='email' />
		
		<div class='form-footer'>
			<a href='<?= base_url('account/login') ?>'>登陆</a>
			<input class="btn btn-large btn-primary" type='submit' value='提交' />
		</div>
	</form>
</div>