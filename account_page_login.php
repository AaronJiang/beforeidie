<?php	require_once('html_helper.php');	require_once('data_funs.inc');	html_output_unauthed_header('登陆', 'page-login');	html_output_slogan();?><script type='text/javascript'>$(document).ready(function(){	$("#form-login").validationEngine();});</script><div id='form-wap'>	<form class='clearfix' id='form-login' action='account_proc.php' method='post'>		<input type='text' class='validate[required, custom[email]]' id='login-user' value='<?php echo @base64_decode($_COOKIE['ue']); ?>' placeholder='邮箱' class='required' minlength="6" autocomplete='off' name='email' />				<input type='password' class='validate[required]' id='login-pwd' placeholder='密码' class='required' minlength="6" autocomplete='off' name='password' />				<div class='form-footer'>			<a href='account_page_forgot_pwd.php?from=login'>忘记密码</a			><a href='account_page_register.php'>注册</a			><input type='submit' value='登陆'>		</div>				<input type='hidden' name='proc' value='login'>	</form></div><?php	html_output_unauthed_footer();?>