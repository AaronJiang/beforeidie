<?php /* Smarty version Smarty-3.1.12, created on 2012-11-15 03:17:33
         compiled from "..\view\person\person.tp" */ ?>
<?php /*%%SmartyHeaderCode:4986509235e2350e62-48954490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1352945850,
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
    'isFollowed' => 0,
    'currUserID' => 0,
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
<?php if ($_valid && !is_callable('content_509235e26c2e46_48079691')) {function content_509235e26c2e46_48079691($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((string)$_smarty_tpl->tpl_vars['user']->value['Name'])." 的个人空间",'page'=>'page-person'), 0);?>


<div class='row'>

	<div class='span9'>
			
		<div id='user-info' class='clearfix'>
			<img class='avatar avatar-side' src='<?php echo $_smarty_tpl->tpl_vars['user']->value['Avatar'];?>
' />
			<div id='user-name'><?php echo $_smarty_tpl->tpl_vars['user']->value['Name'];?>
 的个人主页</div>
		
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
 记录 / <?php echo $_smarty_tpl->tpl_vars['goal']->value['cheersNum'];?>
 鼓励</div>
			</div>
			<?php } ?>
		</div>

	</div>

	<!-- 边栏 -->	
	<div class='span3'>
	
		<!-- 个人动态 -->
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'TA的动态','cmd'=>'全部','link'=>"PersonC.php?act=personal_dyns&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>

		
		<?php  $_smarty_tpl->tpl_vars['dyn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dyn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dyns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dyn']->key => $_smarty_tpl->tpl_vars['dyn']->value){
$_smarty_tpl->tpl_vars['dyn']->_loop = true;
?>

		<?php if ($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newLog'){?>
		<div class='dynamic-item clearfix'>
			<div class='dynamic-header'>
				在 <a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
' class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a> 中写到：
			</div>

			<?php if ($_smarty_tpl->tpl_vars['dyn']->value['LogTitle']!=''){?>
			<div class='dynamic-log-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogTitle'];?>
</div>
			<?php }?>
			<div class='dynamic-log-content'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['LogContent'];?>
</div>
			<div class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</div>
		</div>
		
		<?php }elseif($_smarty_tpl->tpl_vars['dyn']->value['Type']=='newGoal'){?>
		<div class='dynamic-item clearfix'>
			<div class='dynamic-header'>
				设立目标 <a href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalID'];?>
' class='dynamic-goal-title'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalTitle'];?>
</a>
			</div>
			<div class='dynamic-goal-reason'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['GoalReason'];?>
</div>
			<div class='dynamic-time'><?php echo $_smarty_tpl->tpl_vars['dyn']->value['Time'];?>
</div>
		</div>
		<?php }?>	

		<?php } ?>
		
		<!-- 关注TA的人 -->	
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'关注TA的人','cmd'=>"全部 / ".((string)$_smarty_tpl->tpl_vars['followersNum']->value),'link'=>"PersonC.php?act=followers&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>
			
			
		<?php  $_smarty_tpl->tpl_vars['follower'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['follower']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['follower']->key => $_smarty_tpl->tpl_vars['follower']->value){
$_smarty_tpl->tpl_vars['follower']->_loop = true;
?>
		<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['follower']->value['UserID'];?>
' title='<?php echo $_smarty_tpl->tpl_vars['follower']->value['Username'];?>
'>
			<img class='avatar avatar-multi' src='<?php echo $_smarty_tpl->tpl_vars['follower']->value['Avatar'];?>
' />
		</a>
		<?php } ?>
		
		<!-- TA关注的人 -->		
		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'TA关注的人','cmd'=>"全部 / ".((string)$_smarty_tpl->tpl_vars['followeesNum']->value),'link'=>"PersonC.php?act=followees&userID=".((string)$_smarty_tpl->tpl_vars['user']->value['ID'])), 0);?>
			
			
		<?php  $_smarty_tpl->tpl_vars['followee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['followee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['followee']->key => $_smarty_tpl->tpl_vars['followee']->value){
$_smarty_tpl->tpl_vars['followee']->_loop = true;
?>
		<a href='PersonC.php?act=person&userID=<?php echo $_smarty_tpl->tpl_vars['followee']->value['UserID'];?>
' title='<?php echo $_smarty_tpl->tpl_vars['followee']->value['Username'];?>
'>
			<img class='avatar avatar-multi' src='<?php echo $_smarty_tpl->tpl_vars['followee']->value['Avatar'];?>
' />
		</a>
		<?php } ?>
	</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>