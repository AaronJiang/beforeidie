<?php /* Smarty version Smarty-3.1.12, created on 2012-12-04 13:44:56
         compiled from "..\view\goal\new.tp" */ ?>
<?php /*%%SmartyHeaderCode:225625092389e5c3365-55689534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b380556e70dbf1c1b12830d20278285b1564333' => 
    array (
      0 => '..\\view\\goal\\new.tp',
      1 => 1354624931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '225625092389e5c3365-55689534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5092389e6abef7_81803631',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5092389e6abef7_81803631')) {function content_5092389e6abef7_81803631($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"新",'page'=>'page-new-goal'), 0);?>


<script type="text/javascript">


$(document).ready(function(){
	$('#goal-title').focus();
});

</script>


<h2 id="goal-title" contenteditable="true"></h2>

<div id="log-content" contenteditable="true"></div>	

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>