<div id='form-wap'>
	
	<?php if($from == 'register' OR $from == 'sended'): ?>
	<p id='account-message'>亲，激活邮件已发送到你的邮箱，请进入邮箱激活账户吧！</p>
	
	<?php elseif($from == 'unactive'): ?>
	<p id='account-message'>亲，你的账户尚未激活，请进入邮箱激活账户吧！</p>
			
	<?php elseif($from == 'activeError'): ?>
	<p id='account-message'>亲，账户激活失败，请点击下方按钮再发一次激活邮件吧！</p>

	<?php elseif($from == 'activeSucc'): ?>
	<!-- 移除下方的发送表单 -->
	<script type='text/javascript'>
		$(document).ready(function(){
			$('#form-send-active-email').detach();
		});
	</script>
	<p id='account-message'>亲，账户激活成功，马上 <a href="<?= base_url('account/login') ?>">登陆</a> 吧！</p>
	
	<?php endif; ?>

	<form id='form-send-active-email' action="<?= base_url('account/send_active_email/') ?>" method='post'>
		<div class='form-footer'>
			<a href="<?= base_url('account/login') ?>">登陆</a>
			<input class="btn btn-large btn-primary" type='submit' value='再发一次' />
		</div>

		<input type='hidden' value='<?= $email ?>' name='email' />
	</form>
</div>