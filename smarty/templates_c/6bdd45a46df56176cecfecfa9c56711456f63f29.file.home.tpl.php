<?php /* Smarty version Smarty-3.1.12, created on 2012-10-21 16:06:50
         compiled from "..\view\home\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262625083561a969784-37903799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bdd45a46df56176cecfecfa9c56711456f63f29' => 
    array (
      0 => '..\\view\\home\\home.tpl',
      1 => 1350806809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262625083561a969784-37903799',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5083561aa8b7a7_37061988',
  'variables' => 
  array (
    'goalNum' => 0,
    'goals' => 0,
    'goalType' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083561aa8b7a7_37061988')) {function content_5083561aa8b7a7_37061988($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'我的Goals','page'=>'page-home'), 0);?>
<script type="text/javascript">$(document).ready(function(){		//滑出命令栏	$('.goal-item').live("hover", function(event){		if(event.type == 'mouseenter'){			$(this).find('.goal-cmd-wap').animate({'bottom':'0px'}, 'fast');		} 		else if(event.type == 'mouseleave'){			$(this).find('.goal-cmd-wap').animate({'bottom':'-32px'}, 'fast');		};	});		//初始化 Goal 延迟对话框	$('#dialog-delay').dialog({		autoOpen: false,		modal: true,		width: 320,		draggable: false,		resizable: false,		buttons: {			'确认': function(){				$('#form-delay-goal').submit();			},			'取消': function(){				$(this).dialog('close');			}		}	});		//初始化 datapicker	$('#goal-starttime').datepicker({		changeMonth: true,		changeYear: true,		showOtherMonths: true,		selectOtherMonths: true	});			//弹出 Goal 延迟框	$('.goal-cmd-delay').click(function(){		//对话框标题		var goalTitle = $(this).data('title');		$('#dialog-delay').dialog('option', 'title', '推迟：' + goalTitle);				//设置表单隐藏域 goalID 的值		var goalID = $(this).data('goalid');		$("#form-delay-goal input[name='goalID']").val(goalID);			$('#dialog-delay').dialog('open');	});		//弹出放弃 Goal 警告框	$('.goal-cmd-drop').click(function(){		var goalTitle = $(this).data('title');		var isSure = confirm('确定放弃目标：' + goalTitle + "?");		if(!isSure){			return false;		}	});});</script><ul id="goal-selector" class="clearfix">	<li><a href="HomeController.php?action=home&goalType=now">进 行 中 [<?php echo $_smarty_tpl->tpl_vars['goalNum']->value['now'];?>
]</a></li>	<li><a href="HomeController.php?action=home&goalType=future">待 启 动 [<?php echo $_smarty_tpl->tpl_vars['goalNum']->value['future'];?>
]</a></li>	<li><a href="HomeController.php?action=home&goalType=finish">已 完 成 [<?php echo $_smarty_tpl->tpl_vars['goalNum']->value['finish'];?>
]</a></li></ul><div id="content-goals"><?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>	<div class='goal-item goal-item-<?php echo $_smarty_tpl->tpl_vars['goalType']->value;?>
'>					<a class='goal-link' href='goal_page_details.php?goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'>			<p class='goal-title'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</p>			<p class='goal-why'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Reason'];?>
</p>			<div class='goal-info-wap'>				<?php if ($_smarty_tpl->tpl_vars['goalType']->value=='future'){?>				<p class='goal-starttime'>将于 <b><?php echo $_smarty_tpl->tpl_vars['goal']->value['StartTime'];?>
</b> 启动</p>				<?php }elseif($_smarty_tpl->tpl_vars['goalType']->value=='finish'){?>				<p class='goal-endtime'>于 <b><?php echo $_smarty_tpl->tpl_vars['goal']->value['EndTime'];?>
</b> 达成</p>											<?php }else{ ?>				<p><b><?php echo $_smarty_tpl->tpl_vars['goal']->value['stepsNum'];?>
</b> 计划 | <b><?php echo $_smarty_tpl->tpl_vars['goal']->value['logsNum'];?>
</b> 记录</p>				<?php }?>			</div>		</a>					<div class='goal-cmd-wap'>			<a class='goal-cmd goal-cmd-edit'				href='goal_page_edit.php?goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'				>编辑</a>			<?php if ($_smarty_tpl->tpl_vars['goalType']->value=="now"){?>			<a class='goal-cmd goal-cmd-delay' 				data-goalid='<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'				data-title='<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
'				>推迟</a>			<?php }elseif($_smarty_tpl->tpl_vars['goalType']->value=="future"){?>			<a class='goal-cmd goal-cmd-start'				href='goal_proc.php?proc=start&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'				>启动</a>			<?php }?>			<?php if ($_smarty_tpl->tpl_vars['goalType']->value!="finish"){?>			<a class='goal-cmd goal-cmd-drop'				data-title='<?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
'				href='goal_proc.php?proc=drop&goalID=<?php echo $_smarty_tpl->tpl_vars['goal']->value['GoalID'];?>
'				>放弃</a>				<?php }?>		</div>	</div><?php } ?>	</div><div id='dialog-delay' title='推迟启动'>	<form id='form-delay-goal' action='goal_proc.php' method='post'>		<label for='goal-starttime'>启动时间：</label>		<input type='text' name='startTime' autocomplete="off" id='goal-starttime' />		<input type='hidden' name='goalID' value='' />		<input type='hidden' name='proc' value='delay' />	</form></div><?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>