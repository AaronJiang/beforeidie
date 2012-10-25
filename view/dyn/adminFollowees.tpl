{include file='../header.tpl' title='管理我的关注' page='page-admin-followees'}

<p class='subtitle'>我的关注 ({$followeesNum})</p>

{foreach $followees as $fow}
<div class='followee-item clearfix'>
	<a href="PersonC.php?act=person&userID={$fow.UserID}">
		<img class='user-avatar' title="{$fow.Username}" src="{$fow.Avatar}" />
	</a>
		
	<div class='user-info'>
		<p class='user-name'><a href="PersonC.php?act=person&userID={$fow.UserID}">{$fow.Username}</a></p>
		<p class='goal-info'>
			<b>{$fow.GoalsNum['now']}</b> 进行
			&nbsp;|&nbsp;
			<b>{$fow.GoalsNum['future']}</b> 待启
			&nbsp;|&nbsp;
			<b>{$fow.GoalsNum['finish']}</b> 完成
		</p>
	</div>
	
	<div class='cmd-wap'>
		<a class='cmd' href="DynC.php?act=disfollow&followerID={$userID}&followeeID={$fow.UserID}">取消关注</a>
	</div>
</div>
{/foreach}

{include file='../footer.tpl'}