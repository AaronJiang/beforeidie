<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');
	html_output_authed_header("个人资料");
	
	$userID = $_SESSION['valid_user_id'];
?>

<p class='subtitle'>个人资料</p>

<table id='table-account-details'>
	<tr>
		<td class='item-header'>用户：</td>
		<td>
			<?php echo $_SESSION['valid_user']; ?>
			<span><a href='account_page_change_username.php' class='small-cmd'>更改</a></span>
		</td>
	</tr>

	<tr>
		<td class='item-header'>头像：</td>
		<td>
			<img src='<?php echo get_user_profile($userID) ?>' />
			<span>
			<?php
				if(validate_gravatar($userID)){
					echo "<a title='在 Gravatar 更换你的头像' 
							target='_blank' href='http://en.gravatar.com/emails/' 
							class='small-cmd'>更换</a>";
				} else {
					echo "<a title='在 Gravatar 上传你的头像，全球认证哦，亲！' 
							target='_blank' href='http://en.gravatar.com/' 
							class='small-cmd'>上传</a>";				
				}
			?>
			</span>
		</td>
	</tr>

	<tr>
		<td class='item-header'>邮箱：</td>
		<td>
			<?php echo get_email_by_id($userID); ?>
		</td>
	</tr>
	
	<tr>
		<td class='item-header'>密码：</td>
		<td>
			<span><a href='account_page_change_pwd.php' class='small-cmd'>更改</a></span>
		</td>
	</tr>
</table>


<?php
	html_output_authed_footer();
?>