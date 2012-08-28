<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
	
	$userID = $_SESSION['valid_user_id'];
?>

<table id='table-account-details'>
	<tr>
		<td class='item-header'>用户：</td>
		<td>
			<?php echo $_SESSION['valid_user']; ?>
		</td>
	</tr>

	<tr>
		<td class='item-header'>头像：</td>
		<td>
			<img src='<?php echo get_user_profile($userID) ?>' />
			<span>
			<?php
				if(validate_gravatar($userID)){
					echo "<a title='在 Gravatar 上更换你的头像' 
							target='_blank' href='http://en.gravatar.com/emails/' 
							class='link-cmd'>更换</a>";
				} else {
					echo "<a title='在 Gravatar 上注册你的头像' 
							target='_blank' href='http://en.gravatar.com/' 
							class='link-cmd'>上传</a>";				
				}
			?>
			</span>
		</td>
	</tr>

	<tr>
		<td class='item-header'>邮箱：</td>
		<td>
			<?php echo get_email_by_id($userID); ?>
			<span><a href='account_change_email.php' class='link-cmd'>更换</a></span>
		</td>
	</tr>
	
	<tr>
		<td class='item-header'>密码：</td>
		<td>
			<span><a href='account_page_change_pwd.php' class='link-cmd'>更改</a></span>
		</td>
	</tr>
</table>


<?php
	require('footer.php');
?>