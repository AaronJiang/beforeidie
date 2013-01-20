<script type='text/javascript'>

$(document).ready(function(){	
	$("#cancel-btn").click(function(){
		window.location = "<?= base_url('account/info') ?>";
	});
});

</script>

<h3 class='page-title'>更改密码</h3>

<?php if(validation_errors() != ''): ?>
<div class="error-wap"><?= validation_errors(); ?></div>
<?php endif; ?>

<?= form_open('account/change_pwd', array('id' => 'form-change-pwd')) ?>

	<input type='password' autocomplete='off' placeholder='原密码' name='originalPwd' value="<?= set_value('originalPwd') ?>" />

	<input type='password' autocomplete='off' placeholder='新密码' name='newPwd' value="<?= set_value('newPwd') ?>" />

	<input type='password' autocomplete='off' placeholder='重复密码' name='reNewPwd' value="<?= set_value('reNewPwd') ?>" />

	<div>
		<input class="btn btn-primary" type='submit' value='修改'>
		<input class='btn' type='button' id='cancel-btn' value='取消'>
	</div>
</form>