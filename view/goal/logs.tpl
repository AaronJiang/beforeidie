{if $logsNum != 0}

	{foreach $logs as $log}
	<div class='log-item new-comment-parent'>

		{* 标题和内容 *}
		{if $log.LogTitle != ''}
		<p class='log-title'>{$log.LogTitle}</p>			
		{/if}
		<p class='log-content'>{$log.LogContent}</p>
				
		{* 操作按钮 *}
		<div class='log-cmd-time-wap'>
			<a class='small-cmd cmd-new-comment' 
				data-log-id="{$log.LogID}"
				data-poster-id="{$userID}"
				data-is-root='1'
				data-avatar-url="{$userAvatar}"
				>回复{if $log.commentsNum != 0}({$log.commentsNum}){/if}</a>

			{if $isCreator}
			<a class='small-cmd log-cmd-edit' 
				data-log-id="{$log.LogID}">编辑</a>
			{/if}
									
			{if $isCreator && {$log.TypeID} != 0}
			<a class='small-cmd log-cmd-delete'
				href="GoalC.php?act=deleteLog&logID={$log.LogID}">删除</a>
			{/if}
	
			{* 时间 *}
			<p class='log-time'>{$log.LogTime}</p>
		</div>
				
		{* 回复 *}
		{if $log.commentsNum != 0}
		<div class='comments-wap'>
			{foreach $log.comments as $comm}
			{include file='comments.tpl'}
			{/foreach}
		</div>
		{/if}
	</div>
	{/foreach}
	
{else}

	{* 提示用户添加记录 *}

{/if}