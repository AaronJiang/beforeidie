<?php /* Smarty version Smarty-3.1.12, created on 2012-11-10 15:34:43
         compiled from "..\view\goal\my_goals.tp" */ ?>
<?php /*%%SmartyHeaderCode:86855092389266ba61-86670242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff4ccf6f18376754a98af16d2527f0aabe8ef0da' => 
    array (
      0 => '..\\view\\goal\\my_goals.tp',
      1 => 1352557793,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86855092389266ba61-86670242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50923892839931_85815615',
  'variables' => 
  array (
    'goals' => 0,
    'goalType' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50923892839931_85815615')) {function content_50923892839931_85815615($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'我的Goals','page'=>'page-my-goals'), 0);?>
<script type="text/javascript">$(document).ready(function(){		//滑出命令栏	$('.goal-item').live("hover", function(event){		if(event.type == 'mouseenter'){			$(this).find('.goal-cmd-wap').animate({'bottom':'0px'}, 'fast');		} 		else if(event.type == 'mouseleave'){			$(this).find('.goal-cmd-wap').animate({'bottom':'-32px'}, 'fast');		};	});		//弹出放弃 Goal 警告框	$('.goal-cmd-drop').click(function(){		var goalTitle = $(this).data('title');		var isSure = confirm('确定放弃目标：' + goalTitle + "?");		if(!isSure){			return false;		}	});});</script><div id="content-goals">	<?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>	<div class='goal-item goal-item-<?php echo $_smarty_tpl->tpl_vars['goalType']->value;?>
'>			<!-- Goal info -->		<a class='goal-link' href='GoalC.php?act=details&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'>			<p class='goal-title'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</p>			<p class='goal-why'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>			<div class='goal-info-wap'>				<p><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['logsNum'];?>
</b> 记录</p>			</div>		</a>			<!-- 命令按钮 -->		<div class='goal-cmd-wap'>			<a class='goal-cmd goal-cmd-edit'				href="GoalC.php?act=edit&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
"				>编辑</a>			<a class='goal-cmd goal-cmd-drop'				data-title="<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
"				href="GoalC.php?act=drop_goal&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
"				>放弃</a>		</div>	</div>	<?php } ?>	</div><?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>