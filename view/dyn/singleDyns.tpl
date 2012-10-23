{include file='../header.tpl' title="{$username} 的动态" page='page-single-dynamics'}

{literal}
<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type='text/javascript'>

$(document).ready(function(){

	//按需加载动态
	function load_dyns(userID, pageIndex, numPerPage, isMe, callback){
		var data = {
			'act': 'getSingleDyns',
			'userID': userID,
			'pageIndex': pageIndex,
			'numPerPage': numPerPage,
			'isMe': isMe
		};

		$.get('DynC.php', data, function(data){
			$('#dyns').append(data);
			$('#more-dyns').show();	
			callback();
		});	
	}
{/literal}

	//初始化翻页参数
	var userID = {$userID},
		pageIndex = 1,
		numPerPage = 20,
		isMe = {$isMe};

{literal}		
	//加载第一页
	$('#more-dyns').hide();
	load_dyns(userID, pageIndex, numPerPage, isMe, function(){
		if($('.dynamic-item').length < 5){
			$('#more-dyns').detach();
		}
		else{
			//加载更多动态
			$('#more-dyns').click(function(){
				pageIndex += 1;
				load_dyns(userID, pageIndex, numPerPage, isMe);
			});		
		}
	});
});

</script>
{/literal}

<p class='subtitle'><a href="PersonC.php?act=person&userID={$userID}">{$username}</a> 的动态</p>

<div id='dyns'></div>
<div id='more-dyns'>更多动态</div>

{include file='../footer.tpl'}