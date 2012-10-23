<?php /* Smarty version Smarty-3.1.12, created on 2012-10-23 10:15:57
         compiled from "..\view\dyn\singleDyns.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152595085fdecca4d96-19499748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d52e2debf31674a1ccb6fe6f31c2490dca7b944' => 
    array (
      0 => '..\\view\\dyn\\singleDyns.tpl',
      1 => 1350980154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152595085fdecca4d96-19499748',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5085fdecca92a6_08264461',
  'variables' => 
  array (
    'username' => 0,
    'userID' => 0,
    'isMe' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5085fdecca92a6_08264461')) {function content_5085fdecca92a6_08264461($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['username']->value)." 的动态",'page'=>'page-single-dynamics'), 0);?>



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


	//初始化翻页参数
	var userID = <?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
,
		pageIndex = 1,
		numPerPage = 20,
		isMe = <?php echo $_smarty_tpl->tpl_vars['isMe']->value;?>
;

		
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


<p class='subtitle'><a href="PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a> 的动态</p>

<div id='dyns'></div>
<div id='more-dyns'>更多动态</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>