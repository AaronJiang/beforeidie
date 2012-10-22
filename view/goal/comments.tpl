<div class='comments-wap'>
	{foreach $log.comments as $comm}
	
	{* item *}
	<div class='comment-item clearfix'>
	
		{* avatar *}
		<a href="person.php?userID={$comm.PosterID}">
			<img class="comment-poster-profile"
				title="{$comm.Poster}"
				src="{$comm.Avatar}" />
		</a>

		{* main *}
		<div class='comment-main'>
					
			{* header *}
			<div class='comment-header'>
				{if $comm.IsRoot == 1}
				<a href="PersonC.php?act=person&userID={$comm.PosterID}">{$comm.Poster}</a>:{$comm.Comment}
				{else}
				<a href="PersonC.php?act=person&userID={$comm.PosterID}">{$comm.Poster}</a>:<a href="PersonC.php?act=person&userID={$comm.ReceiverID}">@{$comm.Receiver}</a>
				{$comm.Comment}
				{/if}
			</div>
					
			{* footer *}
			<div class='comment-footer'>
				<span class='comment-time'>{$comm.Time}</span>
				&nbsp;
				<span class='comment-cmd cmd-new-comment'
					data-log-id="{$log.LogID}"
					data-parent-comment-id="{$comm.CommentID}"
					data-poster-id="{$userID}"
					data-is-root='0'
					data-avatar-url="{$userAvatar}"
					>回复<span>
			</div>
		</div>
	</div>
	{/foreach}
</div>