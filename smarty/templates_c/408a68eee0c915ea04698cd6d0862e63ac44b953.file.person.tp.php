<?php /* Smarty version Smarty-3.1.12, created on 2012-11-24 14:42:01
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:4986509235e2350e62-48954490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1353764520,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4986509235e2350e62-48954490',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509235e26c2e46_48079691',
  'variables' => 
  array (
    'user' => 0,
    'isMe' => 0,
    'followeesNum' => 0,
    'followersNum' => 0,
    'isFollowed' => 0,
    'currUserID' => 0,
    'goals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235e26c2e46_48079691')) {function content_509235e26c2e46_48079691($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Name'])." 的个人主页",'page'=>'page-person'), 0);?>


<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type='text/javascript'>



//获取 URL 中的参数
function getQueryStr(name) {
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 
	var r = window.location.search.substr(1).match(reg); 

	if (r != null) 
		return unescape(r[2]);

	return null; 
}

//按需加载动态
function load_dyns(dynType, userID, pageIndex, numPerPage, isMe, callback){
	var data = {
		'userID': userID,
		'pageIndex': pageIndex,
		'numPerPage': numPerPage,
		'isMe': isMe
	};

	if(dynType == 'followees'){
		data['act'] = 'get_dyns';
	} else if(dynType == 'aboutme'){
		data['act'] = 'get_about_me_dyns';
	}

	$.get('PersonC.php', data, function(data){
		$('#dyns').append(data);
		$('#more-dyns').show();	
		callback();
	});	
}

$(document).ready(function(){



	//初始化翻页参数
	var userID = <?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
,
		pageIndex = 1,
		numPerPage = 20,
		isMe = <?php echo $_smarty_tpl->tpl_vars['isMe']->value;?>
;



	//加载第一页
	$('#more-dyns').hide();

	//获取 URL 中的动态类型
	var dynType = getQueryStr('dynType')? getQueryStr('dynType'): 'followees';

	load_dyns(dynType, userID, pageIndex, numPerPage, isMe, function(){
		if($('.dynamic-item').length < 5){
			$('#more-dyns').detach();
		} else {
			//加载更多动态
			$('#more-dyns').click(function(){
				pageIndex += 1;
				load_dyns(userID, pageIndex, numPerPage, isMe);
			});		
		}
	});
});



</script>


<div class='row'>

	<div class='span9'>
			
		<div id='user-info-wap' class='clearfix'>
			<img class='avatar avatar-side' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />

			<div id="user-info">
				<h4 id='user-name'><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
 的个人主页</h4>
				<div id="follow-info-wap">
					<a href="PersonC.php?act=followees&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
"><b><?php echo $_smarty_tpl->tpl_vars['followeesNum']->value;?>
</b> 关注</a>
					<span> / </span>
					<a href="PersonC.php?act=followers&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
"><b><?php echo $_smarty_tpl->tpl_vars['followersNum']->value;?>
</b> 被关注</a>
				</div>
			</div>
		
			<?php if (!$_smarty_tpl->tpl_vars['isMe']->value){?>
			<div id='user-cmd-wap'>
				<?php if ($_smarty_tpl->tpl_vars['isFollowed']->value){?>
				<a class="btn btn-primary" href='DynC.php?act=disfollow_user&followerID=<?php echo $_smarty_tpl->tpl_vars['currUserID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
'>已关注</a>
				<?php }else{ ?>
				<a class="btn" href='PersonC.php?act=follow_user&followerID=<?php echo $_smarty_tpl->tpl_vars['currUserID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
'>关注</a>
				<?php }?>
			</div>
			<?php }?>
		</div>

		<div id='dynamic-sel-wap'>
			<a class='dynamic-sel' href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
&dynType=followees'>动态消息</a>
			<a class='dynamic-sel' href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
&dynType=aboutme'>与我相关</a>
		</div>

		<div id="dyns"></div>
		<div id="more-dyns">更多</div>
	</div>

	<!-- 边栏 -->	
	<div class='span3'>

		<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['isMe']->value){?><?php echo "我";?><?php }else{ ?><?php echo "TA";?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_tmp1."的目标"), 0);?>


		<div class='goal-wap'>
			<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
			<div class='goal-item'>
				<div>
					<a class='goal-title' href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
				</div>
				
				<div class='goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</div>
				<div class='goal-num-wap'><?php echo $_smarty_tpl->tpl_vars['goal']->value['logsNum'];?>
 记录</div>
			</div>
			<?php } ?>
		</div>
	</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>