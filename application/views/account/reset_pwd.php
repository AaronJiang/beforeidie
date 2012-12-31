<script type='text/javascript'>

$(document).ready(function(){
	$('#form-reset-pwd').validationEngine();	
});

</script>

<div id='form-wap'>
	<form id='form-reset-pwd' action="<?= base_url('account/preset_pwd') ?>" method='post'>
		<input type='password' id='newPwd' class='validate[required, minSize[6]]' title='输入你的新密码，6-16位之间，建议数字和字母混合。' placeholder='新的密码' autocomplete='off' name='pwd' />
		
		<input type='password' class='validate[required, equals[newPwd]]' title='重复一遍又不会怀孕！' placeholder='重复一遍' autocomplete='off' name='re-pwd' />

		<input type='hidden' name='email' value='<?= $email ?>'>
		
		<div class='form-footer'>
			<input class="btn btn-primary btn-large" type='submit' value='重置'>
		</div>
	</form>
</div>