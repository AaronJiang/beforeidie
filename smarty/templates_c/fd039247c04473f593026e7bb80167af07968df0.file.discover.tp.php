<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 15:55:08
         compiled from "..\view\discover\discover.tp" */ ?>
<?php /*%%SmartyHeaderCode:52850913bcc8aed82-89630058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd039247c04473f593026e7bb80167af07968df0' => 
    array (
      0 => '..\\view\\discover\\discover.tp',
      1 => 1351165945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52850913bcc8aed82-89630058',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hotGoals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50913bcc9cc696_85060585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50913bcc9cc696_85060585')) {function content_50913bcc9cc696_85060585($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'发现','page'=>'page-discover'), 0);?>

 $_from = $_smarty_tpl->tpl_vars['hotGoals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value){
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Title'];?>
</a>
</p>
'><?php echo $_smarty_tpl->tpl_vars['goal']->value['Creator'];?>
<a></p>
</b> 规划</span>
</b> 记录</span>
</b> 鼓励</span>
<?php }} ?>