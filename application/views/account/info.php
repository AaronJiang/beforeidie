<script type="text/javascript">

$(document).ready(function(){

	// 修改性别
	$("#td-sex input").click(function(){
		var userID = $(this).attr('data-user-id'),
			sex = $(this).val();

		$.ajax({
			url: "<?= base_url('account/change_sex') ?>",
			type: 'POST',
			data: {
				async: false,
				userID: userID,
				sex: sex
			},
			success: function(isSucc){
				if(isSucc == 1){}
			}
		})
	});
});

</script>

<h3 class='page-title'>关于我</h3>

<table id='table-account-details'>
	<tr>
		<td class='item-header'>用户：</td>
		<td><?= $user->Username ?></td>
	</tr>

	<tr>
		<td class='item-header'>头像：</td>
		<td>
			<img class='avatar avatar-larger' src="<?= $user->AvatarUrl ?>" />
			
			<span>
			<?php if($hasGravatar): ?>
			(<a title='去 Gravatar 更换你的头像' 
				target='_blank'
				href='http://cn.gravatar.com/emails/' 
				class='btn btn-tiny btn-cmd'>更换</a>)
			<?php else: ?>
			(<a title='去 Gravatar 上传你的头像，全球通用哦，亲！' 
				target='_blank'
				href='http://cn.gravatar.com/' 
				class='btn btn-tiny btn-cmd'>上传</a>)			
			<?php endif; ?>
			</span>
		</td>
	</tr>

	<tr>
		<td class='item-header'>性别：</td>
		<td id="td-sex">
			<input type="radio" data-user-id="<?= $user->UserID ?>"
				<?php if($user->Sex == 'male'): ?>checked="checked"<?php endif; ?> name="sex" value="male" /> 男
			<input type="radio" data-user-id="<?= $user->UserID ?>"
				<?php if($user->Sex == 'female'): ?>checked="checked"<?php endif; ?> name="sex" value="female" id="radio-female"/> 女
		</td>
	</tr>

	<tr>
		<td class='item-header'>邮箱：</td>
		<td><?= $user->Email ?></td>
	</tr>
	
	<tr>
		<td class='item-header'>密码：</td>
		<td>
			<span>
				(<a title='更改密码' href="<?= base_url('account/change_pwd') ?>" class='btn btn-tiny btn-cmd'>更改</a>)
			</span>
		</td>
	</tr>
</table>