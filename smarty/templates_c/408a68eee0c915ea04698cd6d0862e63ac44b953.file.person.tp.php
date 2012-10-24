<?php /* Smarty version Smarty-3.1.12, created on 2012-10-24 10:28:43
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:203775087a4ae0f89e4-75152109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1351067321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203775087a4ae0f89e4-75152109',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5087a4ae3f51f9_29737171',
  'variables' => 
  array (
    'user' => 0,
    'isMe' => 0,
    'isFollowed' => 0,
    'currUserID' => 0,
    'goalsNum' => 0,
    'goals' => 0,
    'goal' => 0,
    'dyns' => 0,
    'dyn' => 0,
    'followersNum' => 0,
    'followers' => 0,
    'follower' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'followee' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5087a4ae3f51f9_29737171')) {function content_5087a4ae3f51f9_29737171($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Name'])." 的个人空间",'page'=>'page-person'), 0);?>


<div id='person-page'>

	<div id='main-panel'>
		
		<!-- User Info -->		
		<div id='user-info' class='clearfix'>
			<img id='user-avatar' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />
			
			<div id='user-info-wap'>
				<span id='user-name'><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
 的个人主页</span>
			</div>
		
			<?php if (!$_smarty_tpl->tpl_vars['isMe']->value){?>
			<div id='user-cmd-wap'>
				<?php if ($_smarty_tpl->tpl_vars['isFollowed']->value){?>
				<a class='isFollowed' href='DynC.php?act=disfollow&followerID=<?php echo $_smarty_tpl->tpl_vars['currUserID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
'>已关注</a>
				<?php }else{ ?>
				<a href='DynC.php?act=follow&followerID=<?php echo $_smarty_tpl->tpl_vars['currUserID']->value;?>
&followeeID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
'>关注</a>
				<?php }?>
			</div>
			<?php }?>
		</div>
	
		<!-- 用户的 Goals -->
		<ul id='goal-wap-header'>
			<li><a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
&goalType=now'>进行中 [<?php echo $_smarty_tpl->tpl_vars['goalsNum']->value['now'];?>
]</a></li>
			<li><a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
&goalType=future'>待启动 [<?php echo $_smarty_tpl->tpl_vars['goalsNum']->value['future'];?>
]</a></li>
			<li><a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['ID'];?>
&goalType=finish'>已完成 [<?php echo $_smarty_tpl->tpl_vars['goalsNum']->value['finish'];?>
]</a></li>
		</ul>
		
		<div class='goal-wap'>
			<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
			<div class='goal-item'>
				<p class='goal-title'>
					<a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
				</p>
				
				<p class='goal-reason'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>
				<div class='goal-num-wap'>
					<span><?php echo $_smarty_tpl->tpl_vars['goal']->value['stepsNum'];?>
 规划</span>
					<span>·</span>
					<span><?php echo $_smarty_tpl->tpl_vars['goal']->value['logsNum'];?>
 记录</span>
					<span>·</span> 
					<span><?php echo $_smarty_tpl->tpl_vars['goal']->value['cheersNum'];?>
 鼓励</span>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>

	<!-- 边栏 -->	
	<div id="sidebar-panel">
	
		<!-- 个人动态 -->
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'TA的动态','cmd'=>'全部','link'=>"DynC.php?act=singleDyns&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>

		
		<?php  $_smarty_tpl->tpl_vars['dyn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dyn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dyn']->key => $_smarty_tpl->tpl_vars['dyn']->value){
$_smarty_tpl->tpl_vars['dyn']->_loop = true;
?>
		<div class='dynamic-item clearfix'>

			
			<?php if ($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newLog'){?>
			<p class='dynamic-header'>
				<span>在</span>
				<a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
' class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
				<span>中写到：</span>
			</p>
			<?php if ($_smarty_tpl->tpl_vars['dyn']->value['LogTitle']!=''){?>
			<p class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</p>
			<?php }?>
			<p class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
</p>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
					
			
			<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newGoal'){?>
			<p class='dynamic-header'>
				<span>设立目标</span>
				<a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
' class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			</p>
			<p class='dynamic-goal-reason'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalReason'];?>
</p>
			<p class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</p>
			<?php }?>
			
		</div>
		<?php } ?>
		
		<!-- 关注TA的人 -->	
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'关注TA的人','cmd'=>"全部 (".((string)$_smarty_tpl->tpl_vars['followersNum']->value).")",'link'=>"DynC.php?act=followers&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>
			
			
		<?php  $_smarty_tpl->tpl_vars['follower'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['follower']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['follower']->key => $_smarty_tpl->tpl_vars['follower']->value){
$_smarty_tpl->tpl_vars['follower']->_loop = true;
?>
		<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['follower']->value['UserID'];?>
' title='<?php echo $_smarty_tpl->tpl_vars['follower']->value['Username'];?>
'>
			<img class='multi-user-profile' src='<?php echo $_smarty_tpl->tpl_vars['follower']->value['Avatar'];?>
' />
		</a>
		<?php } ?>
		
		<!-- TA关注的人 -->		
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'TA关注的人','cmd'=>"全部 (".((string)$_smarty_tpl->tpl_vars['followeesNum']->value).")",'link'=>"DynC.php?act=followees&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>
			
			
		<?php  $_smarty_tpl->tpl_vars['followee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['followee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['followee']->key => $_smarty_tpl->tpl_vars['followee']->value){
$_smarty_tpl->tpl_vars['followee']->_loop = true;
?>
		<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['followee']->value['UserID'];?>
' title='<?php echo $_smarty_tpl->tpl_vars['followee']->value['Username'];?>
'>
			<img class='multi-user-profile' src='<?php echo $_smarty_tpl->tpl_vars['followee']->value['Avatar'];?>
' />
		</a>
		<?php } ?>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>