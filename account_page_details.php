<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
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
			<img src='./imgs/gravatar-140.png' />
			<span><a href='account_change_head_img.php' class='link-cmd'>更换</a></span>
		</td>
	</tr>

	<tr>
		<td class='item-header'>邮箱：</td>
		<td>
			<?php echo get_email($_SESSION['valid_user_id']); ?>
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